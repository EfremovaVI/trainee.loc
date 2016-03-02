<?php
/**
 * Class Category
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Models;

use Cgi\Module\EOrm\EntityAbstract;
use Cgi\Module\Url\Url;

class Category extends EntityAbstract
{
    /**
     * Category constructor.
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
    protected function getTableName()
    {
        return 'category';
    }

    /**
     * Modify data before saving or update
     */
    protected function updateData()
    {
        // action = 0 - modify data before saving
        if ($this->_action == 0) {
            $this->_data['url_key'] = Url::getUrl($this->_data['name']);
        }
    }
}