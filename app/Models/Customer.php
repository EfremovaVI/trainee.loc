<?php
/**
 * Class Customer
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Models;

use Cgi\Module\EOrm\EntityAbstract;

class Customer extends EntityAbstract
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
    protected function getTableName()
    {
        return 'user';
    }

    /**
     * Modify data before saving or update
     */
    protected function updateData()
    {
        // action = 0 - modify data before saving
        if ($this->_action == 0) {
            // update field data in creation_date
            $this->_data['creation_date'] = date('Y-m-d H:i:s');
        }
    }
}