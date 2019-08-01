<?php
namespace UtilityClasses;

use \utilityClasses\Utils; //import this Utils class to use for initializing the language session variable

class EntryPoint
{
    private $route;
    private $method;
    private $routes;

    public function __construct(string $route, string $method, \UtilityClasses\Routes $routes)
    {
        $this->route = $route;
        $this->routes = $routes;
        $this->method = $method;
        $this->checkUrl();
    }

    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateFileName, $variables = [])
    {
        extract($variables);

        ob_start();
        if ($templateFileName) {
            include __DIR__ . '/../../templates/' . $templateFileName;
        }
        return ob_get_clean();
    }

    public function run()
    {
        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../public/locale/english/layout.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../public/locale/spanish/layout.json';
            $lang = 'spanish';
        }
        $layoutContent = file_get_contents($path);
        $layoutContent = json_decode($layoutContent, true);

        $routes = $this->routes->getRoutes();

        $authentication = $this->routes->getAuthentication();

        if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
            header('location: /login/error');
        } else {
            $controller = $routes[$this->route][$this->method]['controller'];
            $action = $routes[$this->route][$this->method]['action'];

            $page = $controller->$action();

            $title = $page['title'];
            $loggedIn = $authentication->isLoggedIn();



            if (isset($page['variables'])) {
                $output = $this->loadTemplate($page['template'], $page['variables']);
            } else {
                $output = $this->loadTemplate($page['template']);
            }
//            phpinfo();die;
            echo $this->loadTemplate('layout.html.php', [
                'loggedIn' => $loggedIn,
                'output' => $output,
                'title' => $title,
                'language' => $lang,
                'layoutContent' => $layoutContent
            ]);
        }
    }
}