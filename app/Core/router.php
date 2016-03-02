<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi;

use Cgi\Module\Info\Info;

class Router
{
    /**
     * Start routing
     */
    public static function start()
    {
        $nameController = 'Site';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $nameController = $routes[1];
        }

        if (!empty($routes[2])) {
            $action = explode('?', $routes[2]);
            $actionName = $action[0];
        }

        $nameController = ucfirst($nameController) . 'Controller';
        $actionName =  $actionName . 'Action';

        if (!file_exists('app/Controllers/' . $nameController . '.php')) {
            Info::getPageNotFound();
        }

        $nameController = 'Cgi\Controllers\\' . $nameController;
        $controller = new $nameController;
        $controller->beforeAction();
        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Info::getPageNotFound();
        }
    }

    /**
     *  Error page 404
     */
    public function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}