<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Controllers;

use Cgi\Core\AController;
use Cgi\Models\Products;
use Cgi\Module\Info\Info;
use Cgi\Module\Magento\ImportMagento;
use Cgi\Module\Pagination\Pagination;

class ProductsController extends AController
{
    /**
     * Main products page
     */
    function indexAction()
    {
        $pagination = new Pagination();

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : null;

        if(isset($_GET['sort'])){
            $order   = isset($_GET['order']) ? $_GET['order'] : '';
            $allowed = array("name", "price");
            $key     = array_search($_GET['sort'],$allowed);
            $order   = ($order == 'DESC') ? 'DESC' : 'ASC';
            $sort = ' ORDER BY ' . $allowed[$key] . ' ' . $order;
        } else {
            $sort = '';
        }

        $collection = $pagination->getData(5, $currentPage, 'products', $sort);

        $this->view->generate(
            'ProductsView.php', 'template.php', $collection,
            $messages = null, $pagination->createLinks()
        );
    }

    /**
     * Import products on the magento
     */
    function importAction()
    {
        $messages = [];
        $importMagento = new ImportMagento;

        if (isset($_POST['Import']['url'])) {
            if (!$importMagento->getDataApi($_POST['Import']['url'])) {
                $messages[] = Info::getMessages('Incorrect url');
            } else {
                $messages[] = Info::getMessages('Import successful');
                $messages[] = Info::getMessages('Export start');
            }
        }
        $this->view->generate(
            'ImportView.php', 'template.php',
            $data = null, $messages
        );
    }

    /**
     * Products form edit page
     */
    function editAction()
    {
        $messages = [];

        $product = new Products();
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            if(empty($product->load($id))){
                Info::getPageNotFound();
                return false;
            }
        } else {
            Info::getPageNotFound();
            return false;
        }

        if (isset($_POST['Product'])) {
            if (!$product->validateData()) {
                $messages[] = Info::getMessages('Incorrect data');
            } else {
                foreach($_POST['Product'] as $key=>$data){
                    if($key == 'last_updated'){
                        $product->_data[$key] = date('Y-m-d H:i:s');
                    } else {
                        $product->_data[$key] = $data;
                    }
                }
                $product->save();
            }
        }
        $this->view->generate(
            'ProductsEditView.php', 'template.php', $product, $messages
        );
    }
}