<?php
namespace BwwClasses\Controllers;

use \utilityClasses\Authentication;
use \utilityClasses\DatabaseTable;

class MyAccount
{
    private $usersTable;
    private $authentication;

    public function __construct(DatabaseTable $usersTable, Authentication $authentication)
    {
        $this->usersTable = $usersTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return ['template' => 'myaccount.html.php',
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
        return ['template' => 'registersuccess.html.php',
            'title' => 'Registration Successful'];
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
        return ['template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['fname'] . ' ' . $accountInfo[0]['lname'] . "'s Account",
            'variables' => [
                'loggedIn' => $loggedIn,
                'fname' => $accountInfo[0]['fname'],
                'lname' => $accountInfo[0]['lname'],
                'email' => $accountInfo[0]['email'],
                'changePassword' => true,
                'displayMainMenu' => false],
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
                return ['template' => 'myaccount.html.php',
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
                $accountData['firstanswer'] = $accountInfo[0]['firstanswer'];
                $accountData['secondanswer'] = $accountInfo[0]['secondanswer'];
                $accountData['thirdanswer'] = $accountInfo[0]['thirdanswer'];
                $this->usersTable->save($accountData);
                // $this->authentication->login($accountData['email'], $accountData['password']);
                header('Location: /myaccount/passwordchangesuccess');
            }
        }
    }

    private function changeEmail()
    {

    }

    private function changeUserName()
    {

    }

    public function renderPasswordChangeSuccess()
    {
        $user = $this->authentication->getUser();
        $accountInfo = $this->usersTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return ['template' => 'passwordchangesuccess.html.php',
            'title' => 'Password change successful',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }

    public function renderPasswordRecovery()
    {
        return ['template' => 'passwordrecovery.html.php',
            'title' => "Password recovery form",
        ];
    }

    public function recoverPassword()
    {
        $user = $_POST['user'];
        $tempPw = $this->authentication->recoverPassWord($user['email'], $user['firstanswer'], $user['secondanswer'], $user['thirdanswer']);
        if ($tempPw != false) {
            //instead of redirecting to login/success render a page showing the new tempPw and telling the user to change it
            // header('location: /login/success');
            return ['template' => 'recoverpasswordsuccess.html.php',
            'title' => 'Password recovery successful',
            'variables' => [
                'tempPw' => $tempPw,
            ],
        ];
        } else {
            return ['template' => 'passwordrecovery.html.php',
                'title' => 'Password recovery form - Errors',
                'variables' => [
                    'error' => 'One or more of your entries was incorrect.  Please try again.',
                ],
            ];
        }
    }

    public function home()
	{
		$title = "BWW Apps - home";
		$loggedIn = $this->authentication->isLoggedIn();
		return ['template' => 'home.html.php',
		'title' => $title,
		'variables' => [
			'loggedIn' => $loggedIn
		]
	];
	}
}