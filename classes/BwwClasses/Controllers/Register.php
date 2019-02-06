<?php
namespace BwwClasses\Controllers;

use \utilityClasses\DatabaseTable;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register
{
    private $usersTable;
    private $usersVerifyTable;
    private $mailTable;

    public function __construct(DatabaseTable $usersTable, DatabaseTable $usersVerifyTable, DatabaseTable $mailTable)
    {
		$this->usersTable = $usersTable;
        $this->usersVerifyTable = $usersVerifyTable;
        $this->mailTable = $mailTable;
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
			$to = (string) $userData['email'];
			$subject = "Activation Code For bwwapps.com";
            $message = "Your Activation Code is " . $code . "";
            $id = 1;
            $apiVal = $this->mailTable->findById($id);
            $apiData = $apiVal['api_val'];

            //using PHPMailer to send mail thru Gmail is limited to 99 emails per day.
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = 'brian.w.worsham';
            $mail->Password = $apiData;
            $mail->SetFrom('no-reply@bwwapps.com');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AddAddress($to);

            $mail->Send();

			$_SESSION['email'] = $to;
			// $_SESSION['message'] = $message;
			header('Location: /user/registerverifycode');

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
				'email' => $_SESSION['email']
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
                $this->usersVerifyTable->delete($verifyData[0]['id']);
				// $_SESSION['email'] = null;
				// $_SESSION['message'] = null;
                header('Location: /user/registersuccess');
            }
        }
    }
}
