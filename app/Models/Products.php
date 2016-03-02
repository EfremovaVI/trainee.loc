<?php
/**
 * Class Products
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Models;

use Cgi\Module\EOrm\EntityAbstract;

class Products extends EntityAbstract
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        // generation of data array c the name of the fields
        // in the database table
        $this->getFieldsName();
    }

    /**
     * Returns the table name in the database
     */
    public function getTableName()
    {
        return 'products';
    }

    /**
     * @param array $post
     *
     * @return bool
     */
    public function validateData()
    {
        if (
            (strlen($_POST['Product']['name']) <= (int)VALUE_TEXT)
            && (strlen($_POST['Product']['sku']) <= (int)VALUE_VARCHAR)
            && ((int)$_POST['Product']['status'] < 2)
            && (strlen($_POST['Product']['description']) <= (int)VALUE_TEXT)
            && ((float)$_POST['Product']['price'] >= 0)
        ) {
            return true;
        } else {
            return false;
        }
    }
}