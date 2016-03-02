<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\EOrm;

use Cgi\Connection;
use Cgi\Module\Log\LogFile;

abstract class EntityAbstract implements EntityInterface
{
    private $_conn = null;
    private $_log = null;
    protected $_loadStatus;
    protected $_pkFieldName;
    protected $_id;

    //$_action = 0 - create;
    //$_action = 1 - update;
    protected $_action;

    public $_field = [];
    public $_data = [];

    /**
     * Returns the table name in the database
     */
    abstract protected function getTableName();

    /**
     * Modify data before saving or update
     */
    protected function updateData()
    {
    }

    /**
     * @return \PDO
     */
    protected function getConnection()
    {
        if (null === $this->_conn) {
            try {
                $this->_conn = Connection::getInstance()->getConnection();
                $this->_conn->setAttribute(
                    \PDO::ATTR_ERRMODE,
                    \PDO::ERRMODE_EXCEPTION
                );
            } catch (\PDOException $e) {
                $this->setLog()->error($e->getMessage());
            }
        }
        return $this->_conn;
    }

    /**
     * @return LogFile|null
     */
    protected function setLog()
    {
        if (null === $this->_log) {
            $this->_log = new LogFile();
        }
        return $this->_log;
    }

    /**
     * Returns the data array with names of fields in the database
     * Returns the field name of the primary key in the database
     */
    public function getFieldsName()
    {
        try {
            $fields = $this->getConnection()
                ->query('SHOW COLUMNS FROM ' . $this->getTableName());

            foreach ($fields as $row) {
                if ($row['Key'] == 'PRI') {
                    $this->_pkFieldName = $row['Field'];
                }
                if ($row['Key'] != 'PRI') {
                    $this->_field[] = $row['Field'];
                }
            }
            return $this->_field;
        } catch (\PDOException $e) {
            $this->setLog()->error($e->getMessage());
        }
        return false;
    }

    /**
     * Returns the attribute data based on the primary key of the previously
     * downloaded object.
     *
     * @param $attribute
     *
     * @return bool
     */
    public function get($attribute)
    {
        if (!empty($this->_data) && array_key_exists($attribute, $this->_data)) {
            return $this->_data[$attribute];
        } else {
            return null;
        }
    }

    /**
     * Adding data to create or update the object data.
     * If creation is successful, return true.
     *
     * @param $attribute
     * @param $value
     *
     * @return bool
     */
    public function set($attribute, $value)
    {
        if (in_array($attribute, $this->_field)) {
            return $this->_data[$attribute] = $value;
        }
        return null;
    }

    /**
     * Creates or Updates an object.
     * If creation is successful, return true.
     */
    public function save()
    {
        if ($this->_loadStatus == 1) {
            $this->_action = 1;
            $this->updateData();

            $data = [];
            foreach ($this->_field as $item) {
                $data[] = $item . " = '" . $this->_data[$item] . "'";
            }
            try {
                $sql = 'UPDATE ' . $this->getTableName()
                    . ' SET ' . implode(', ', $data)
                    . ' WHERE ' . $this->_pkFieldName . ' = ' . $this->_id;
                $this->getConnection()->prepare($sql)->execute();
            } catch (\PDOException $e) {
                $this->setLog()->error($e->getMessage());
            }
        } else {
            $this->_action = 0;
            $this->updateData();

            try {
                $sql = 'INSERT INTO ' . $this->getTableName()
                    . ' (' . implode(', ', $this->_field) . ') '
                    . " VALUES ('" . implode("', '", $this->_data) . "')";
                $this->getConnection()->prepare($sql)->execute();
            } catch (\PDOException $e) {
                $this->setLog()->error($e->getMessage());
            }
        }

    }

    /**
     * Delete previously downloaded object
     * If deletion is successful, return true.
     */
    public function delete()
    {
        try {
            $sql = 'DELETE FROM ' . $this->getTableName()
                . ' WHERE ' . $this->_pkFieldName . ' = ' . $this->_id;
            $this->getConnection()->prepare($sql)->execute();

            $this->_loadStatus = 0;
            $this->_id = null;
        } catch (\PDOException $e) {
            $this->setLog()->error($e->getMessage());
        }
    }

    /**
     * Returns the data model based on the primary key.
     *
     * @param $id
     *
     * @return array
     */
    public function load($id)
    {
        try {
            $sql = 'SELECT * FROM ' . $this->getTableName()
                . ' WHERE ' . $this->_pkFieldName . ' = ' . $id;
            $select = $this->getConnection()->prepare($sql);
            $select->execute();

            $data = $select->fetch();
            $this->_data = $data;

            $this->_id = $id;
            $this->_loadStatus = 1;

            return $this->_data;
        } catch (\PDOException $e) {
            $this->setLog()->error($e->getMessage());
        }
        return false;
    }

    /**
     * Returns the id of the loaded object
     */
    public function getId()
    {
        if ($this->_id) {
            return $this->_id;
        }
        return false;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->getTableName();
        $select = $this->getConnection()->prepare($sql);
        $select->execute();
        $data = $select->fetchAll();
        return $data;
    }

    /**
     * @param array $attribute
     *
     * @return array
     */
    public function findByAttribute(array $attribute)
    {
        $conditions = [];
        foreach ($attribute as $key => $item) {
            $conditions[] = $key . " = '" . $item . "'";
        }
        $sql = 'SELECT * FROM ' . $this->getTableName()
            . ' WHERE ' . implode(' AND ', $conditions);
        $select = $this->getConnection()->prepare($sql);
        $select->execute();
        $data = $select->fetch();

        $this->_data = $data;
        $this->_loadStatus = 1;

        return $data;
    }
}