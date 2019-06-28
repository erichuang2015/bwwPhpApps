<?php
namespace UtilityClasses;

use Birke\Rememberme\Authenticator;
use Birke\Rememberme\Storage\FileStorage;
use \utilityClasses\DatabaseTable;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Authentication
{
    private $users; // $users is the users table
    private $usersVerifyTable;
    private $mailTable;
    private $usernameColumn;
    private $passwordColumn;

    private $storagePath;
    private $storage;
    private $rememberMe;
    private $loginResult;

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn, DatabaseTable $usersVerifyTable, DatabaseTable $mailTable)
    {
        session_start();
        $this->users = $users;
        $this->usersVerifyTable = $usersVerifyTable;
        $this->mailTable = $mailTable;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;

        // Initialize RememberMe Library with file storage
        $this->storagePath = dirname(__FILE__) . "/../../tokens/";
        // $newDirName = __DIR__ . '/../../../public/uploads/' . $newName;
        if (!is_writable($this->storagePath) || !is_dir($this->storagePath)) {
            die("'$this->storagePath' does not exist or is not writable by the web server.\n" .
                "To run the example, please create the directory and give it the correct permissions.");
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

        if (!empty($user) && $user[0][$this->passwordColumn] === $_SESSION['password']) { //getting error for undefined index password here
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

    public function recoverPassWord($email)
    {
        $email = strtolower($email);

        $user = $this->users->find($this->usernameColumn, $email);

        if (!empty($user)) { //If true then the user is in fact registered with the provided email
            $token = substr(md5(mt_rand()), 0, 15); // generate a random tokencode to send with url so the user can click it and navigate to password reset page
            $userData = [];
            $userData['id'] = '';
            $userData['fname'] = (string)$user[0]['fname'];
            $userData['lname'] = (string)$user[0]['lname'];
            $userData['email'] = strtolower($user[0]['email']);
            $userData['password'] = (string)$user[0]['password'];
            $userData['verifycode'] = (string)$token;
            $this->usersVerifyTable->save($userData);


            $to = (string)$email;
            $subject = "Password Reset Request for bwwapps.com";
            $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $url = $url . "reset?token=" . $token; // This is passwordrecoveryreset.html.php
            $message = "<span><b>Attention: </b> You or someone on your behalf requested to reset your password for " . $_SERVER['HTTP_HOST'] . ".  If you did not request this you can safely disregard and delete this email.  However, if you do wish to reset your password please click the following link to be taken to password reset page: </span><a href='" . $url . "'>password reset</a>.";

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

            return true;
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