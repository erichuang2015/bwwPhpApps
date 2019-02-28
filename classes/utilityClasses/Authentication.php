<?php
namespace UtilityClasses;

use Birke\Rememberme\Authenticator;
use Birke\Rememberme\Storage\FileStorage;

class Authentication
{
    private $users; // $users is the users table
    private $usernameColumn;
    private $passwordColumn;

    private $storagePath;
    private $storage;
    private $rememberMe;
    private $loginResult;

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn)
    {
        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;

        // Initialize RememberMe Library with file storage
        $this->storagePath = dirname(__FILE__) . "/../../tokens/";
        // $newDirName = __DIR__ . '/../../../public/uploads/' . $newName;
        if (!is_writable($this->storagePath) || !is_dir($this->storagePath)) {
            die(
                "'$this->storagePath' does not exist or is not writable by the web server.\n" .
                "To run the example, please create the directory and give it the correct permissions."
            );
        }
        $this->storage = new FileStorage($this->storagePath);
        $this->rememberMe = new Authenticator($this->storage);

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
        $this->loginResult = $this->rememberMe->login();
        if ($this->loginResult->isSuccess()) {
            $_SESSION['username'] = $this->loginResult->getCredential();
            // print_r($_SESSION['username']); die;
            // There is a chance that an attacker has stolen the login token, so we store
            // the fact that the user was logged in via RememberMe (instead of login form)
            $_SESSION['remembered_by_cookie'] = true;
            // print_r("remembered by cookie"); die;
            return true;
        }
        if ($this->loginResult->hasPossibleManipulation()) {
            // render_template("cookie_was_stolen");
            exit();
        }
        // Log out when tokens have expired and user is still logged in with remember me
        // This state can happen in two cases:
        // a) The triples were cleared after an attack or a "global logout"
        // b) The triples have expired
        if ($this->loginResult->isExpired() && !empty($_SESSION['username']) && !empty($_SESSION['remembered_by_cookie'])) {
            $this->rememberMe->clearCookie();
            unset($_SESSION['username']);
            unset($_SESSION['remembered_by_cookie']);
            // render_template('login', 'You were logged out because the "Remember Me" cookie was no longer valid.');
            exit;
        }
        if ($this->loginResult->isExpired() && !empty($_SESSION['username'])) {
            // Do rate limiting here. Lots of requests for non-existing triplets can be an indicator of a brute force attack
            sleep(5);
        }

        //old session management below:
        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

        if (!empty($user) && $user[0][$this->passwordColumn] === $_SESSION['password']) {//getting error for undefined index password here
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
