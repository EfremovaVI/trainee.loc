<?php
/**
 * Default controller
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Controllers;


use Cgi\Core\AController;

class SiteController extends AController
{
    /**
     * Default page
     */
    public function indexAction()
    {
    }

    /**
     * Error page
     */
    public function errorAction()
    {
        $this->view->generate('errorView.php', 'template.php');
    }
}