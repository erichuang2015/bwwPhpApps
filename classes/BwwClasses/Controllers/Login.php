<?php

namespace BwwClasses\Controllers;

use Birke\Rememberme\Authenticator;
use Birke\Rememberme\Storage\FileStorage;
use \utilityClasses\Utils; //import this Utils class to use for initializing the language session variable

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
            die("'$this->storagePath' does not exist or is not writable by the web server.\n" .
                "To run the example, please create the directory and give it the correct permissions.");
        }
        $this->storage = new FileStorage($this->storagePath);
        $this->rememberMe = new Authenticator($this->storage);
    }

    public function loginForm()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/login.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/login.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        return [
            'template' => 'login.html.php',
            'title' => $content['title'], // notice the title also comes from the content file
            'variables' => [
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ]
        ];
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
            return [
                'template' => 'login.html.php',
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
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/loginerror.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/loginerror.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        return [
            'template' => 'loginerror.html.php',
            'title' => $content['title'], // notice the title also comes from the content file
            'variables' => [
                'content' => $content, //all the strings on the page
                'language' => $lang //add the language variable to the page for the hidden input value
            ]
        ];
    }

    public function logout()
    {
        $loggedIn = $this->authentication->isLoggedIn();
        $this->storage->cleanAllTriplets($_SESSION['username']);
        $_SESSION = [];
        session_destroy(); //can't access session language var after session destroy has been called
        $this->rememberMe->clearCookie();
        return [
            'template' => 'logout.html.php',
            'title' => 'You have been logged out',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }

    public function processUserRequest()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            $page = $this->changeLanguage($_POST);
            return $page;
        } else {
            $this->processLogin();
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

    public function changeLanguageFromErrorPg()
    {
        if (isset($_POST['english'])) {
            $_SESSION['language'] = 'english';
        } else {
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->loginForm();
        return $page;
    }
}