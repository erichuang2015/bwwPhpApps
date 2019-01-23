<?php
namespace UtilityClasses;

class Authentication
{
    private $users; // $users is the users table
    private $usernameColumn;
    private $passwordColumn;
    // need recovery question vars

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn)
    { // need recovery question params
        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
        // need recovery question vars
    }

    public function login($username, $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));

        if (!empty($user) && password_verify($password, $user[0][$this->passwordColumn])) {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0][$this->passwordColumn];
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

        if (!empty($user) && $user[0][$this->passwordColumn] === $_SESSION['password']) {
            return true;
        } else {
            return false;
        }
    }

    //if logged it it returns all the data for the user in the user table
    public function getUser()
    {
        if ($this->isLoggedIn()) {
            return $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
        } else {
            return false;
        }
    }

    public function recoverPassWord($email, $firstAnswer, $secondAnswer, $thirdAnswer)
    {
        $email = strtolower($email);
        $firstAnswer = strtolower($firstAnswer);
        $secondAnswer = strtolower($secondAnswer);
        $thirdAnswer = strtolower($thirdAnswer);

		$user = $this->users->find($this->usernameColumn, $email);
		// print_r($user[0]['id']); die;

        //Need to replace this if block with checking of the security answers
        if (!empty($user) && password_verify($firstAnswer, $user[0]['firstanswer']) && password_verify($secondAnswer, $user[0]['secondanswer']) && password_verify($thirdAnswer, $user[0]['thirdanswer'])) {
            // Generate a new temp password
            $tempPassword = $this->random_password();
            $tempPasswordHashed = password_hash($tempPassword, PASSWORD_DEFAULT);
			// Update the db with the new $tempPassword

            $accountInfo = $this->users->find('id', $user[0]['id']);
            $accountData['id'] = (int) $user[0]['id'];
            $accountData['fname'] = $accountInfo[0]['fname'];
            $accountData['lname'] = $accountInfo[0]['lname'];
            $accountData['email'] = $accountInfo[0]['email'];
            $accountData['password'] = $tempPasswordHashed;
            $accountData['firstanswer'] = $accountInfo[0]['firstanswer'];
            $accountData['secondanswer'] = $accountInfo[0]['secondanswer'];
            $accountData['thirdanswer'] = $accountInfo[0]['thirdanswer'];
            $this->users->save($accountData);

            session_regenerate_id();
            $_SESSION['username'] = $email;
            $_SESSION['password'] = $tempPasswordHashed;
            return $tempPassword;
        } else {
            return false;
        }
    }

    public function random_password($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
}
