<?php
namespace Ijdb\Controllers;

use \Ninja\Authentication;
use \Ninja\DatabaseTable;

class MyAccount
{
    private $authorsTable;
    private $authentication;

    public function __construct(DatabaseTable $authorsTable, Authentication $authentication)
    {
        $this->authorsTable = $authorsTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        $user = $this->authentication->getUser();
        $accountInfo = $this->authorsTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return ['template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['name'] . "'s Account",
            'variables' => [
                'loggedIn' => $loggedIn,
                'username' => $accountInfo[0]['name'],
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
        $accountInfo = $this->authorsTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return ['template' => 'myaccount.html.php',
            'title' => $accountInfo[0]['name'] . "'s Account",
            'variables' => [
                'loggedIn' => $loggedIn,
                'username' => $accountInfo[0]['name'],
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
            $accountInfo = $this->authorsTable->find('id', $user['id']);
            $isTheOldPwValid = password_verify($oldPassword, $accountInfo[0]['password']);
            if ($isTheOldPwValid == false || $newPassword1 != $newPassword2) {
                $errors[] = 'Invalid input.  Please try again.';
                $valid = false;
                return ['template' => 'myaccount.html.php',
                    'title' => $accountInfo[0]['name'] . "'s Account - Change Password",
                    'variables' => [
                        'loggedIn' => $loggedIn,
                        'username' => $accountInfo[0]['name'],
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
                $accountData['name'] = $accountInfo[0]['name'];
                $accountData['email'] = $accountInfo[0]['email'];
                $accountData['password'] = $newPassword1;
                $this->authorsTable->save($accountData);
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
        $accountInfo = $this->authorsTable->find('id', $user['id']);
        $loggedIn = $this->authentication->isLoggedIn();
        return ['template' => 'passwordchangesuccess.html.php',
            'title' => 'Password change successful',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }
}
