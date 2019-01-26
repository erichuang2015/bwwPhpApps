<?php
namespace BwwClasses\Controllers;

use \utilityClasses\DatabaseTable;
// require_once('/../vendor/phpmailer/phpmailer/src/PHPMailer.php');

// include __DIR__ . '/../../includes/DatabaseConnection.php';


class Register
{
    private $usersTable;
    private $usersVerifyTable;

    public function __construct(DatabaseTable $usersTable, DatabaseTable $usersVerifyTable)
    {
		// include __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
		// require_once( __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/PHPMailer.php');
		$this->usersTable = $usersTable;
        $this->usersVerifyTable = $usersVerifyTable;
    }

    public function registrationForm()
    {
        return ['template' => 'register.html.php',
            'title' => 'Register an account'];
    }

    public function success()
    {
        return ['template' => 'registersuccess.html.php',
            'title' => 'Registration Successful'];
    }

    public function storeUserData()
    {
        $user = $_POST['user'];
		// print_r($user); die;
        //Assume the data is valid to begin with
        $valid = true;
		$errors = [];
		$userData = [];
		$userData['id'] = '';
        //But if any of the fields have been left blank, set $valid to false
        if (empty($user['fname'])) {
            $valid = false;
            $errors[] = 'First name cannot be blank';
		}
		else{
			$userData['fname'] = $user['fname'];
		}

        if (empty($user['lname'])) {
            $valid = false;
            $errors[] = 'Last name cannot be blank';
		}
		else{
			$userData['lname'] = $user['lname'];
		}

        if (empty($user['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        } else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'Invalid email address';
        } else { //if the email is not blank and valid:
            //convert the email to lowercase
            $userData['email'] = strtolower($user['email']);

            //search for the lowercase version of `$user['email']`
            if (count($this->usersTable->find('email', $user['email'])) > 0) {
                $valid = false;
                $errors[] = 'That email address is already registered';
            }
        }

        if (empty($user['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        }

        if (empty($user['firstanswer'])) {
            $valid = false;
            $errors[] = 'You must provide an answer for the first recovery question.';
        } else {
            //convert the answer to lowercase
            $user['firstanswer'] = strtolower($user['firstanswer']);
        }

        if (empty($user['secondanswer'])) {
            $valid = false;
            $errors[] = 'You must provide an answer for the second recovery question.';
        } else {
            //convert the answer to lowercase
            $user['secondanswer'] = strtolower($user['secondanswer']);
        }

        if (empty($user['thirdanswer'])) {
            $valid = false;
            $errors[] = 'You must provide an answer for the third recovery question.';
        } else {
            //convert the answer to lowercase
            $user['thirdanswer'] = strtolower($user['thirdanswer']);
        }

        //If $valid is still true, no fields were blank and the data can be added
        if ($valid == true) {
            //Hash the password and recovery question answers before saving it in the database
            $userData['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $userData['firstanswer'] = password_hash($user['firstanswer'], PASSWORD_DEFAULT);
            $userData['secondanswer'] = password_hash($user['secondanswer'], PASSWORD_DEFAULT);
            $userData['thirdanswer'] = password_hash($user['thirdanswer'], PASSWORD_DEFAULT);

            $code = substr(md5(mt_rand()), 0, 15); // generate a random code to send user so they can validate their email address before registering
            $userData['verifycode'] = (string) $code;

            //When submitted, the $user variable now contains a lowercase value for email and recover question answers
			//and a hashed password and recovery question answers
			// print_r($userData); die;
            $this->usersVerifyTable->save($userData);

            // $message = "Your Activation Code is " . $code . "";
            // $to = (string) $userData['email'];
			// $_SESSION['email'] = $to;

			// $this->renderVerifyCode($message);

			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "brian.w.worsham@gmail.com";
			$to = (string) $userData['email'];
			$subject = "Activation Code For bwwapps.com";
			$message = "Your Activation Code is " . $code . "";
			$headers = "From:" . $from;
			$mailStatus = mail($to,$subject,$message, $headers);
			// print_r($mailStatus);die;
			// echo "The email message was sent.";
			$_SESSION['email'] = $to;
			$_SESSION['message'] = $message;
			header('Location: /user/registerverifycode');

            // $subject = "Activation Code For bwwapps.com";
            // $from = 'brian.w.worsham@hotmail.com';
            // // $body = 'Your Activation Code is ' . $code . ' Please Click On This link <a href="verification.php">Verify.php?id=' . $db_id . '&code=' . $code . '</a>to activate your account.';
            // $headers = "From:" . $from;
			// mail($to, $subject, $message, $headers);
            // $mail = new \vendor\phpmailer\phpmailer\src\PHPMailer();
            // $mail->CharSet = "utf-8";
            // $mail->IsSMTP();
			// // enable SMTP authentication
            // $mail->SMTPAuth = true;
			// // GMAIL username
            // $mail->Username = "brian.w.worsham@gmail.com";
			// // GMAIL password
            // $mail->Password = "153756Pw";
            // $mail->SMTPSecure = "ssl";
			// // sets GMAIL as the SMTP server
            // $mail->Host = "smtp.gmail.com";
			// // set the SMTP port for the GMAIL server
            // $mail->Port = "465";
            // $mail->From = 'brian.w.worsham@gmail.com';
            // $mail->FromName = 'Brian Worsham';
            // $mail->AddAddress($to, $user['fname']);
            // $mail->Subject = 'Activation Code For bwwapps.com';
            // $mail->IsHTML(true);
            // $mail->Body = "Your Activation Code is " . $code . "";
            // if ($mail->Send()) {
            //     header('Location: /user/registerverifycode');
            // } else {
            //     echo "Mail Error - >" . $mail->ErrorInfo;
            // }

        } else {
            //If the data is not valid, show the form again
            return ['template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'user' => $user,
                ],
            ];
        }
    }

    public function renderVerifyCode()
    {
		// print_r('renderVerifyCode called'); die;
		// print_r($message); die;
        return ['template' => 'registerverifycode.html.php',
            'title' => 'Register - Verification Code',
            'variables' => [
				'message' => $_SESSION['message']
            ],
        ];
    }

    public function registerUser()
    {
		$activationCode = $_POST['activationCode'];
		// print_r($activationCode); die;
        //Assume the data is valid to begin with
        $valid = true;
        $errors = [];

        //But if any of the fields have been left blank, set $valid to false
        if (empty($activationCode)) {
            $valid = false;
            $errors[] = 'The activation code cannot be blank';

            return ['template' => 'registerverifycode.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                ],
            ];
        } else {
			$verifyData = $this->usersVerifyTable->find('email', $_SESSION['email']);
			// print_r($verifyData['verifycode']); die;
            $user = [];
            if ($verifyData[0]['verifycode'] == $activationCode) {
                $user['fname'] = $verifyData[0]['fname'];
                $user['lname'] = $verifyData[0]['lname'];
                $user['email'] = $verifyData[0]['email'];
                $user['password'] = $verifyData[0]['password'];
                $user['firstanswer'] = $verifyData[0]['firstanswer'];
                $user['secondanswer'] = $verifyData[0]['secondanswer'];
                $user['thirdanswer'] = $verifyData[0]['thirdanswer'];
                $this->usersTable->save($user);
                $this->usersVerifyTable->delete('id', $verifyData[0]['id']);
				// $_SESSION['email'] = null;
				// $_SESSION['message'] = null;
                header('Location: /user/registersuccess');
            }
        }
    }
}
