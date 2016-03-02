<?php
/**
 * Create url
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Info;

use Cgi\View;

class Info
{
    public static function getMessages($type)
    {
        $messages = require 'Messages.php';
        if(array_key_exists($type, $messages)){
            return $messages[$type];
        } else {
            return null;
        }
    }

    public static function getPageNotFound()
    {
        $view = new View();
        $view->generate('errorView.php', 'template.php');
    }
}