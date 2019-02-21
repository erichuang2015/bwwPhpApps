<?php
namespace BwwClasses\Controllers;

use Birke\Rememberme\Authenticator;
use Birke\Rememberme\Storage\FileStorage;

class Login
{
    private $authentication;
    private $storagePath;
    private $storage;
    private $rememberMe;
    private $loginResult;

    public function __construct(\utilityClasses\Authentication $authentication)
    {
        $this->authentication = $authentication;
        // Initialize RememberMe Library with file storage
        $this->storagePath = dirname(__FILE__) . "/../../../tokens/";
        // $newDirName = __DIR__ . '/../../../public/uploads/' . $newName;
        if (!is_writable($this->storagePath) || !is_dir($this->storagePath)) {
            die(
                "'$this->storagePath' does not exist or is not writable by the web server.\n" .
                "To run the example, please create the directory and give it the correct permissions."
            );
        }
        $this->storage = new FileStorage($this->storagePath);
        $this->rememberMe = new Authenticator($this->storage);

        // $this->loginResult = $this->rememberMe->login();
        // if ($this->loginResult->isSuccess()) {
        //     $_SESSION['username'] = $this->loginResult->getCredential();
        //     // print_r($_SESSION['username']); die;
        //     // There is a chance that an attacker has stolen the login token, so we store
        //     // the fact that the user was logged in via RememberMe (instead of login form)
        //     $_SESSION['remembered_by_cookie'] = true;
        //     // print_r("remembered by cookie"); die;
        //     return;
        // }
        // if ($this->loginResult->hasPossibleManipulation()) {
        //     // render_template("cookie_was_stolen");
        //     exit();
        // }
        // // Log out when tokens have expired and user is still logged in with remember me
        // // This state can happen in two cases:
        // // a) The triples were cleared after an attack or a "global logout"
        // // b) The triples have expired
        // if ($this->loginResult->isExpired() && !empty($_SESSION['username']) && !empty($_SESSION['remembered_by_cookie'])) {
        //     $this->rememberMe->clearCookie();
        //     unset($_SESSION['username']);
        //     unset($_SESSION['remembered_by_cookie']);
        //     // render_template('login', 'You were logged out because the "Remember Me" cookie was no longer valid.');
        //     exit;
        // }
        // if ($this->loginResult->isExpired() && !empty($_SESSION['username'])) {
        //     // Do rate limiting here. Lots of requests for non-existing triplets can be an indicator of a brute force attack
        //     sleep(5);
        // }
    }

    public function loginForm()
    {
        return ['template' => 'login.html.php', 'title' => 'Log In'];
    }

    public function processLogin()
    {
        if ($this->authentication->login($_POST['email'], $_POST['password'])) {

            //This may be better done in the authentication class
            // session_regenerate_id();
            $_SESSION['username'] = $_POST['email'];
            // If the user wants to be remembered, create Rememberme cookie
            if (!empty($_POST['rememberme'])) {
                $this->rememberMe->createCookie($_POST['email']);
            } else {
                $this->rememberMe->clearCookie();
            }
            //The above may be better done in the authentication class

            header('location: /login/success');
        } else {
            return ['template' => 'login.html.php',
                'title' => 'Log In',
                'variables' => [
                    'error' => 'Invalid username/password.',
                ],
            ];
        }
    }

    public function success()
    {
        return ['template' => 'loginsuccess.html.php', 'title' => 'Login Successful'];
    }

    public function error()
    {
        return ['template' => 'loginerror.html.php', 'title' => 'You are not logged in'];
    }

    public function logout()
    {
        $loggedIn = $this->authentication->isLoggedIn();
        $this->storage->cleanAllTriplets($_SESSION['username']);
        $_SESSION = [];
        session_destroy();
        $this->rememberMe->clearCookie();
        return ['template' => 'logout.html.php',
            'title' => 'You have been logged out',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }
}
