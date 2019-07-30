<?php
namespace BwwClasses\Controllers;

use \utilityClasses\Utils; //import this Utils class to use for initializing the language session variable

class About
{
    public function __construct()
    {
    }

    public function render()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if($_SESSION['language'] == 'english'){
            $path = __DIR__ . '/../../../public/locale/english/about.json';
            $lang = 'english';
        }else{
            $path = __DIR__ . '/../../../public/locale/spanish/about.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);
        return [
            'template' => 'about.html.php',
            'title' => $content['title'], // notice the title also comes from the content file
            'variables' => [
                'content' => $content,//all the strings on the page
                'language' => $lang//add the language variable to the page for the hidden input value
            ]
        ];
    }

    //Called by post
    public function changeLanguage(){
        if(isset($_POST['english'])){
            $_SESSION['language'] = 'english';
        }
        else{
            $_SESSION['language'] = 'spanish';
        }
        $page = $this->render();
        return $page;
    }
}