<?php

namespace BwwClasses\Controllers;

use \utilityClasses\DatabaseTable;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use \utilityClasses\Utils;

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
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/register.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/register.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        return [
            'template' => 'register.html.php',
            'title' => $content['title'],
            'variables' => [
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ]
        ];
    }

    public function success()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/registersuccess.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/registersuccess.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $query = parse_url($url, PHP_URL_QUERY);
        $queryCode = [];
        parse_str($query, $queryCode);
        $verifyData = $this->usersVerifyTable->find('email', $_SESSION['email']);
        $token = (string) $verifyData[0]['verifycode'];
        if ($queryCode['verifycode'] == $token) {
            $this->registerUser($verifyData);
            return [
                'template' => 'registersuccess.html.php',
                'title' => $content['title'],
                'variables' => [
                    'content' => $content, //all the strings on the page
                    'language' => $lang //add the language variable to the page for the hidden input value
                ]
            ];
        } else {
            $errorTxt = 'Your account could not be validated';
            return [
                'template' => 'registersuccess.html.php',
                'title' => $content['title'],
                'errors' => $errorTxt,
                'variables' => [
                    'content' => $content, //all the strings on the page
                    'language' => $lang //add the language variable to the page for the hidden input value
                ]
            ];
        }
    }

    public function storeUserData()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            if (isset($_POST['english'])) {
                $_SESSION['language'] = 'english';
            } else {
                $_SESSION['language'] = 'spanish';
            }
            $page = $this->registrationForm();
            return $page;
        }

        $user = $_POST['user'];
        //Assume the data is valid to begin with
        $valid = true;
        $errors = [];
        $userData = [];
        $userData['id'] = '';
        //But if any of the fields have been left blank, set $valid to false
        if (empty($user['fname'])) {
            $valid = false;
            $errors[] = 'First name cannot be blank';
        } else {
            $userData['fname'] = $user['fname'];
        }

        if (empty($user['lname'])) {
            $valid = false;
            $errors[] = 'Last name cannot be blank';
        } else {
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
        $pattern = '/^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$/';
        if (empty($user['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        } else if (!preg_match($pattern, $user['password'])) {
            $valid = false;
            $errors[] = 'Please enter a valid password';
        }

        //If $valid is still true, no fields were blank and the data can be added
        if ($valid == true) {
            //Hash the password and recovery question answers before saving it in the database
            $userData['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

            $code = substr(md5(mt_rand()), 0, 15); // generate a random code to send user so they can validate their email address before registering
            $userData['verifycode'] = (string) $code;
            //When submitted, the $user variable now contains a lowercase value for email
            //and a hashed password

            $this->usersVerifyTable->save($userData);
            $to = (string) $userData['email'];
            $subject = "Email account verfication for bwwapps.com";
            $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $url = $url . "success?verifycode=" . $code;
            $message = "<span>Click the following confirmation link to activate your bwwapps account: </span><a href='" . $url . "'>Confirm email</a>.  Or copy and paste the link into the <b>same browser</b> that you used to register your with.";

            $id = 1;
            $apiVal = $this->mailTable->findById($id);
            $apiData = $apiVal['api_val']; //The api_val is required to be able to use PHPMailer with gmail below

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
            header('Location: /user/registerverifycode');
        } else {
            //If the data is not valid, show the form again
            return [
                'template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'user' => $user,
                ],
            ];
        }
    }

    public function renderConfirmationEmailNotification()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/registerverifycode.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/registerverifycode.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        return [
            'template' => 'registerverifycode.html.php',
            'title' => $content['title'],
            'variables' => [
                'email' => $_SESSION['email'],
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ]
        ];
    }

    public function registerUser($verifyData)
    {
        // if (isset($_POST['english']) || isset($_POST['spanish'])) {
        //     if (isset($_POST['english'])) {
        //         $_SESSION['language'] = 'english';
        //     } else {
        //         $_SESSION['language'] = 'spanish';
        //     }
        //     $page = $this->renderConfirmationEmailNotification();
        //     return $page;
        // }

        //Assume the data is valid to begin with
        $valid = true;
        $errors = [];

        //But if any of the fields have been left blank, set $valid to false
        if (empty($verifyData)) {
            $valid = false;
            $errors[] = 'Something went wrong.  Your account could not be validated.  Please try again.';

            return [
                'template' => 'registerverifycode.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                ],
            ];
        } else {
            $user = [];
            $user['fname'] = $verifyData[0]['fname'];
            $user['lname'] = $verifyData[0]['lname'];
            $user['email'] = $verifyData[0]['email'];
            $user['password'] = $verifyData[0]['password'];
            $this->usersTable->save($user);
            $this->usersVerifyTable->delete($verifyData[0]['id']);
//            header('Location: /user/registersuccess');
            return;
        }
    }
}