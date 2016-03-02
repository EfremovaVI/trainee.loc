<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Core;

abstract class AController
{

    public $model;
    public $view;

    /**
     * AController constructor.
     */
    function __construct()
    {
        $this->view = new View();
    }

    /**
     * @return mixed
     */
    abstract public function indexAction();

    /**
     *
     */
    public function beforeAction()
    {
        if (empty($_SESSION['isAuth'])) {
            if ($_SERVER['REQUEST_URI'] != '/customer/login') {
                header('Location: /customer/login');
            }
        } else {
            if ($_SERVER['REQUEST_URI'] == '/') {
                header('Location: /products/index');
            }
        }
    }
}