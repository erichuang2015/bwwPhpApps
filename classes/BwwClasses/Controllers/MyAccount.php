<?php

namespace BwwClasses\Controllers;

use \utilityClasses\Authentication;
use \utilityClasses\DatabaseTable;
use \utilityClasses\Utils; //import this Utils class to use for initializing the language session variable

class MyAccount
{
    private $usersTable;
    private $usersVerifyTable;
    private $authentication;

    public function __construct(DatabaseTable $usersTable, Authentication $authentication, DatabaseTable $usersVerifyTable)
    {
        $this->usersTable = $usersTable;
        $this->usersVerifyTable = $usersVerifyTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return [
            'template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['fname'] . " " . $accountInfo[0]['lname'] . "'s Account",
            'variables' => [
                'loggedIn' => $loggedIn,
                // 'username' => $accountInfo[0]['name'],
                'fname' => $accountInfo[0]['fname'],
                'lname' => $accountInfo[0]['lname'],
                'email' => $accountInfo[0]['email'],
                'displayMainMenu' => true,
            ],
        ];
    }

    public function success()
    {
        return [
            'template' => 'registersuccess.html.php',
            'title' => 'Registration Successful'
        ];
    }

    public function processUserRequest()
    {
        if (isset($_POST['changepassword'])) {
            header('Location: /myaccount/changepassword');
        } else if (isset($_POST['changeemail'])) {
            $this->changeEmail();
        } else if (isset($_POST['changeusername'])) {
            $this->changeUserName();
        }
    }

    public function renderChangePassword()
    {
        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return [
            'template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['fname'] . ' ' . $accountInfo[0]['lname'] . "'s Account",
            'variables' => [
                'loggedIn' => $loggedIn,
                'fname' => $accountInfo[0]['fname'],
                'lname' => $accountInfo[0]['lname'],
                'email' => $accountInfo[0]['email'],
                'changePassword' => true,
                'displayMainMenu' => false
            ],
        ];
    }

    public function changePassword()
    {
        if (isset($_POST['newpassword1']) && isset($_POST['newpassword2']) && isset($_POST['oldpassword'])) {
            $oldPassword = $_POST['oldpassword'];
            $newPassword1 = $_POST['newpassword1'];
            $newPassword2 = $_POST['newpassword2'];
            $valid = true;
            $errors = [];
            $user = $this->authentication->getUser();
            $loggedIn = $this->authentication->isLoggedIn();
            $accountInfo = $this->usersTable->find('id', $user['id']);
            $isTheOldPwValid = password_verify($oldPassword, $accountInfo[0]['password']);
            if ($isTheOldPwValid == false || $newPassword1 != $newPassword2) {
                $errors[] = 'Invalid input.  Please try again.';
                $valid = false;
                return [
                    'template' => 'myaccount.html.php',
                    'title' => $accountInfo[0]['fname'] . " " . $accountInfo[0]['lname'] . "'s Account - Change Password",
                    'variables' => [
                        'loggedIn' => $loggedIn,
                        'fname' => $accountInfo[0]['fname'],
                        'lname' => $accountInfo[0]['lname'],
                        'email' => $accountInfo[0]['email'],
                        'changePassword' => true,
                        'displayMainMenu' => false,
                        'errors' => $errors,
                        'changePassword' => true,
                    ],
                ];
            } else {
                $newPassword1 = password_hash($newPassword1, PASSWORD_DEFAULT);
                $accountData['id'] = (int) $user['id'];
                $accountData['fname'] = $accountInfo[0]['fname']; // update this to use lname and fname and pw recovery questions
                $accountData['lname'] = $accountInfo[0]['lname'];
                $accountData['email'] = $accountInfo[0]['email'];
                $accountData['password'] = $newPassword1;
                $this->usersTable->save($accountData);
                header('Location: /myaccount/passwordchangesuccess');
            }
        }
    }

    public function renderReplaceLostPassword()
    {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $queryCode);

        $verifyData = $this->usersVerifyTable->find('verifycode', $queryCode['token']);
        $token = (string) $verifyData[0]['verifycode'];
        if ($token) {
            return [
                'template' => 'passwordrecoveryreset.html.php',
                'title' => 'Create your new password'
            ];
        } else {
            //Todo: test this by inputting an invalid token, and make sure it renders as expected
            $errorTxt = 'Your account could not be validated';
            return [
                'template' => 'passwordrecoveryreset.html.php',
                'title' => 'Create your new password',
                'errors' => $errorTxt
            ];
        }
    }

    public function renderPasswordChangeSuccess()
    {
        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return [
            'template' => 'passwordchangesuccess.html.php',
            'title' => 'Password change successful',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }

    public function renderPasswordRecovery()
    {
        return [
            'template' => 'passwordrecovery.html.php',
            'title' => "Password recovery form",
        ];
    }

    public function recoverPassword()
    {
        if (!empty($_POST['user'])) {
            $user = $_POST['user']; // contains the user supplied email
        }

        $tempPw = $this->authentication->recoverPassWord($user['email']);
        if ($tempPw != false) {
            return [
                'template' => 'recoverpasswordemailsent.html.php',
                'title' => 'Password recovery email sent',
                'variables' => [
                    'email' => $user['email'],
                ],
            ];
        } else {
            return [
                'template' => 'passwordrecovery.html.php',
                'title' => 'Password recovery form - Errors',
                'variables' => [
                    'error' => 'One or more of your entries was incorrect.  Please try again.',
                ],
            ];
        }
    }

    public function home()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if($_SESSION['language'] == 'english'){
            $homePath = __DIR__ . '/../../../public/locale/english/home.json';
            $lang = 'english';
        }else{
            $homePath = __DIR__ . '/../../../public/locale/spanish/home.json';
            $lang = 'spanish';
        }
        $homeContent = file_get_contents($homePath);
        $homeContent = json_decode($homeContent, true);

        $loggedIn = $this->authentication->isLoggedIn();
        return [
            'template' => 'home.html.php',
            'title' => $homeContent['title'],
            'variables' => [
                'loggedIn' => $loggedIn,
                'content' => $homeContent,
                'language' => $lang//add the language variable to the page for the hidden input value
            ]
        ];
    }

    public function changeHomePageLanguage(){
        if(isset($_POST['english'])){
            $_SESSION['language'] = 'english';
        }
        else{
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->home();
        return $page;
    }

    //This function takes user input to create the replacement password after the user has requested to create a new password because they forgot their old one
    public function createNewPassword()
    {
        $valid = true;
        $loggedIn = $this->authentication->isLoggedIn();
        $errors = [];
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $pattern = '/^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$/';
        if (empty($_POST['newpassword'])) {
            $valid = false;
            $errors[] = 'Please enter a valid password';
        } else if (!preg_match($pattern, $_POST['newpassword'])) {
            $valid = false;
            $errors[] = 'Please enter a valid password';
        }
        if ($valid) {
            $newPassWord = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
            $query = parse_url($url, PHP_URL_QUERY);
            parse_str($query, $queryCode);
            $verifyData = $this->usersVerifyTable->find('verifycode', $queryCode['token']);
            $userData = $this->usersTable->find('email', $verifyData[0]['email']);
            $user = [];
            $user['id'] = $userData[0]['id'];
            $user['fname'] = $userData[0]['fname'];
            $user['lname'] = $userData[0]['lname'];
            $user['email'] = $userData[0]['email'];
            $user['password'] = $newPassWord;
            $this->usersTable->save($user);
            $this->usersVerifyTable->delete($verifyData[0]['id']);
            return [
                'template' => 'passwordresetsuccess.html.php',
                'title' => 'Password Reset Successful',
                'variables' => [
                    'loggedIn' => $loggedIn
                ]
            ];
        } else {
            //return page with errors
            return [
                'template' => 'passwordrecoveryreset.html.php',
                'title' => 'Password recovery form - Error',
                'variables' => [
                    'errors' => $errors,
                ]
            ];
        }
    }
}