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
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/myaccount.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/myaccount.json';
            $lang = 'spanish';
        }
        $content = file_get_contents($path);
        $content = json_decode($content, true);

        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();

        return [
            'template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['fname'] . " " . $accountInfo[0]['lname'] . $content['title'], // notice the title also comes from the content file
            'variables' => [
                'loggedIn' => $loggedIn,
                'fname' => $accountInfo[0]['fname'],
                'lname' => $accountInfo[0]['lname'],
                'email' => $accountInfo[0]['email'],
                'displayMainMenu' => true,
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

        return [
            'template' => 'registersuccess.html.php',
            'title' => $content['title'],
            'content' => $content, //all the strings on the page
            'language' => $lang //add the language variable to the page for the hidden input value
        ];
    }

    public function processUserRequest()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            $page = $this->changeLanguage($_POST);
            return $page;
        } else if (isset($_POST['changepassword'])) {
            header('Location: /myaccount/changepassword');
        } else if (isset($_POST['changeemail'])) {
            $this->changeEmail();
        } else if (isset($_POST['changeusername'])) {
            $this->changeUserName();
        }
    }

    public function renderChangePassword()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/myaccount.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/myaccount.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);


        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();

        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return [
            'template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['fname'] . " " . $accountInfo[0]['lname'] . $content['title'], // notice the title also comes from the content file
            'variables' => [
                'loggedIn' => $loggedIn,
                'fname' => $accountInfo[0]['fname'],
                'lname' => $accountInfo[0]['lname'],
                'email' => $accountInfo[0]['email'],
                'changePassword' => true,
                'displayMainMenu' => false,
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ],
        ];
    }

    public function determineChangeLanguageOrPassword()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            $page = $this->changeLanguage($_POST);
            return $page;
        } else if (isset($_POST['newpassword1']) && isset($_POST['newpassword2']) && isset($_POST['oldpassword'])) {
            $this->changePassword($_POST['newpassword1'], $_POST['newpassword2'], $_POST['oldpassword']);
        }
    }

    public function determineChangeLanguageOrRecoverPassword()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            if (isset($post['english'])) {
                $_SESSION['language'] = 'english';
            } else {
                $_SESSION['language'] = 'spanish';
            }
            $page = $this->renderPasswordRecovery();
            return $page;
        } else {
            $this->recoverPassword($_POST);
        }
    }

    public function changePassword($newPassword1, $newPassword2, $oldPassword)
    {
        if (isset($newPassword1) && isset($newPassword2) && isset($oldPassword)) {
            $valid = true;
            $errors = [];
            $user = $this->authentication->getUser();
            $loggedIn = $this->authentication->isLoggedIn();
            $accountInfo = $this->usersTable->find('id', $user['id']);
            $isTheOldPwValid = password_verify($oldPassword, $accountInfo[0]['password']);
            if ($isTheOldPwValid == false || $newPassword1 != $newPassword2) {
                $errors[] = 'Invalid input.  Please try again.';
                $valid = false;

                Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
                $lang = '';
                //Add the proper set of strings depending on if Spanish or English is requested
                if ($_SESSION['language'] == 'english') {
                    $path = __DIR__ . '/../../../public/locale/english/myaccount.json';
                    $lang = 'english';
                } else {
                    $path = __DIR__ . '/../../../public/locale/spanish/myaccount.json';
                    $lang = 'spanish';
                }

                $content = file_get_contents($path);
                $content = json_decode($content, true);

                return [
                    'template' => 'myaccount.html.php',
                    'title' => $accountInfo[0]['fname'] . " " . $accountInfo[0]['lname'] . $content['changePwTitle'],
                    'variables' => [
                        'loggedIn' => $loggedIn,
                        'fname' => $accountInfo[0]['fname'],
                        'lname' => $accountInfo[0]['lname'],
                        'email' => $accountInfo[0]['email'],
                        'changePassword' => true,
                        'displayMainMenu' => false,
                        'errors' => $errors,
                        'changePassword' => true,
                        'content' => $content, //all the strings on the page
                        'language' => $lang //add the language variable to the page for the hidden input value
                    ],
                ];
            } else {
                $newPassword1 = password_hash($newPassword1, PASSWORD_DEFAULT);
                $accountData['id'] = (int)$user['id'];
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
        $verifyData = $this->usersVerifyTable->find('verifycode', $queryCode['token']);//Todo: figure out why $verifyData is null after this statement runs; it seems the DB does not get populated with the verify code before this runs
        $token = (string)$verifyData[0]['verifycode'];

        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/passwordrecoveryreset.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/passwordrecoveryreset.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        if ($token) {
            return [
                'template' => 'passwordrecoveryreset.html.php',
                'title' => $content['title'], // notice the title also comes from the content file
                'variables' => [
                    'content' => $content, //all the strings on the page
                    'language' => $lang //add the language variable to the page for the hidden input value
                ]
            ];
        } else {
            //Todo: test this by inputting an invalid token, and make sure it renders as expected
            $errorTxt = 'Your account could not be validated';
            return [
                'template' => 'passwordrecoveryreset.html.php',
                'title' => $content['title'], // notice the title also comes from the content file
                'errors' => $errorTxt,
                'variables' => [
                    'content' => $content, //all the strings on the page
                    'language' => $lang //add the language variable to the page for the hidden input value
                ]
            ];
        }
    }

    public function renderPasswordChangeSuccess()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/passwordchangesuccess.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/passwordchangesuccess.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();

        return [
            'template' => 'passwordchangesuccess.html.php',
            'title' => $content['title'],
            'variables' => [
                'loggedIn' => $loggedIn,
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ],
        ];
    }

    /**
     * @return array $page: this is is the passwordchangesuccess page and it's variables
     */
    public function changeLanguageFromPasswordSuccess()
    {
        if (isset($_POST['english'])) {
            $_SESSION['language'] = 'english';
        } else {
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->renderPasswordChangeSuccess();
        return $page;
    }

    public function renderPasswordRecovery()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/passwordrecovery.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/passwordrecovery.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        return [
            'template' => 'passwordrecovery.html.php',
            'title' => $content['title'],
            'variables' => [
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ],
        ];
    }

    public function recoverPassword($post)
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';

        $tempPw = false;
        if (!empty($post['user'])) {
            $_SESSION['user'] = $post['user']; // contains the user supplied email
            $user = $post['user']; // contains the user supplied email
            $tempPw = $this->authentication->recoverPassWord($user['email']);
        }

        if ($tempPw != false) {
            header('Location: /myaccount/recoverpasswordemailsent');
        } else {
            //Add the proper set of strings depending on if Spanish or English is requested
            if ($_SESSION['language'] == 'english') {
                $path = __DIR__ . '/../../../public/locale/english/passwordrecovery.json';
                $lang = 'english';
            } else {
                $path = __DIR__ . '/../../../public/locale/spanish/passwordrecovery.json';
                $lang = 'spanish';
            }
            $content = file_get_contents($path);
            $content = json_decode($content, true);
            return [
                'template' => 'passwordrecovery.html.php',
                'title' => $content['title'] + " - Errors",
                'variables' => [
                    'error' => 'One or more of your entries was incorrect.  Please try again.',
                    'content' => $content,
                    'language' => $lang//add the language variable to the page for the hidden input value
                ],
            ];
        }
    }

    public function renderRecoverPwEmailSent()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/recoverpasswordemailsent.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/recoverpasswordemailsent.json';
            $lang = 'spanish';
        }
        $content = file_get_contents($path);
        $content = json_decode($content, true);
        $user = $_SESSION['user'];
        return [
            'template' => 'recoverpasswordemailsent.html.php',
            'title' => $content['title'],
            'variables' => [
                'email' => $user['email'],
                'content' => $content,
                'language' => $lang//add the language variable to the page for the hidden input value
            ],
        ];
    }

    public function changeRecoveryPwEmailSentLanguage()
    {
        if (isset($_POST['english'])) {
            $_SESSION['language'] = 'english';
        } else {
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->renderRecoverPwEmailSent();
        return $page;
    }

    public function home()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $homePath = __DIR__ . '/../../../public/locale/english/home.json';
            $lang = 'english';
        } else {
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

    public function changeHomePageLanguage()
    {
        if (isset($_POST['english'])) {
            $_SESSION['language'] = 'english';
        } else {
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->home();
        return $page;
    }

    public function determineCreateNewPasswordOrChangeLang()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            if (isset($post['english'])) {
                $_SESSION['language'] = 'english';
            } else {
                $_SESSION['language'] = 'spanish';
            }
            $page = $this->renderReplaceLostPassword();
            return $page;
        } else {
            $this->createNewPassword($_POST);
        }
    }

    //This function takes user input to create the replacement password after the user has requested to create a new password because they forgot their old one
    public function createNewPassword($post)
    {
        $valid = true;
        $loggedIn = $this->authentication->isLoggedIn();
        $errors = [];
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $pattern = '/^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$/';
        if (empty($post['newpassword'])) {
            $valid = false;
            $errors[] = 'Please enter a valid password';
        } else if (!preg_match($pattern, $post['newpassword'])) {
            $valid = false;
            $errors[] = 'Please enter a valid password';
        }
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        if ($valid) {
            $newPassWord = password_hash($post['newpassword'], PASSWORD_DEFAULT);
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

            //Add the proper set of strings depending on if Spanish or English is requested
            if ($_SESSION['language'] == 'english') {
                $path = __DIR__ . '/../../../public/locale/english/passwordresetsuccess.json';
                $lang = 'english';
            } else {
                $path = __DIR__ . '/../../../public/locale/spanish/passwordresetsuccess.json';
                $lang = 'spanish';
            }

            $content = file_get_contents($path);
            $content = json_decode($content, true);

            return [
                'template' => 'passwordresetsuccess.html.php',
                'title' => $content['title'],
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'content' => $content,
                    'language' => $lang//add the language variable to the page for the hidden input value
                ]
            ];
        } else {
            //Add the proper set of strings depending on if Spanish or English is requested
            if ($_SESSION['language'] == 'english') {
                $path = __DIR__ . '/../../../public/locale/english/passwordrecoveryreset.json';
                $lang = 'english';
            } else {
                $path = __DIR__ . '/../../../public/locale/spanish/passwordrecoveryreset.json';
                $lang = 'spanish';
            }

            $content = file_get_contents($path);
            $content = json_decode($content, true);
            //return page with errors
            return [

                'template' => 'passwordrecoveryreset.html.php',
                'title' => $content['errorTitle'],
                'variables' => [
                    'errors' => $errors,
                    'content' => $content,
                    'language' => $lang//add the language variable to the page for the hidden input value
                ]
            ];
        }
    }

    public function changeLanguage($post)
    {
        $args = func_get_args();
        if (isset($post['english'])) {
            $_SESSION['language'] = 'english';
        } else {
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->loginForm();
        return $page;
    }
}