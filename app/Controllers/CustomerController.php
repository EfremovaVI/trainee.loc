<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Controllers;

use Cgi\Core\AController;
use Cgi\Models\Customer;

class CustomerController extends AController
{
    /**
     *
     */
    function indexAction()
    {
    }

    /**
     * Customer authorization in system
     *
     * @return bool
     */
    public function loginAction()
    {
        $user = new Customer();

        $messages = null;
        if (empty($_SESSION['isAuth']) && isset($_POST['Auth'])) {
            $messages = "<span style='color:red;'> E-mail or password"
                . " is not correct </span>";
        }

        if (isset($_POST['Auth'])) {
            $auth = $user->findByAttribute(
                [
                    'email'    => $_POST['Auth']['email'],
                    'password' => $_POST['Auth']['password']
                ]
            );
            if ($auth) {
                $_SESSION['isAuth'] = true;
                $_SESSION['login'] = $user->get('first_name')
                    . ' ' . $user->get('last_name');
                header('Location: /products/index');
            }
        } else {
            $_SESSION['isAuth'] = false;
        }
        $this->view->generate('LoginView.php', 'template.php', $data=null, $messages);
    }
}