<?php
namespace UtilityClasses;

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

        $routes = $this->routes->getRoutes();

        $authentication = $this->routes->getAuthentication();

        if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
            header('location: /login/error');
        } else {
            $controller = $routes[$this->route][$this->method]['controller'];
            $action = $routes[$this->route][$this->method]['action'];

            $page = $controller->$action(); //this is throwing an exception

            $title = $page['title'];
            $loggedIn = $authentication->isLoggedIn();

            if (isset($page['variables'])) {
                $output = $this->loadTemplate($page['template'], $page['variables']);

            } else {
                $output = $this->loadTemplate($page['template']);
            }
            echo $this->loadTemplate('layout.html.php', [
                'loggedIn' => $loggedIn,
                'output' => $output,
                'title' => $title,
            ]);
        }
    }
}
