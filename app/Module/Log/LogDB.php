<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Log;


use Cgi\Connection;

class LogDB extends LogAbstract
{
    private $_conn = null;

    /**
     * @return null|\PDO
     */
    protected function getConnection()
    {
        if (null === $this->_conn) {
            $this->_conn = Connection::getInstance()->getConnection();
            $this->_conn->setAttribute(
                \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION
            );
        }
        return $this->_conn;
    }

    /**
     * @param $massage
     * @param $type
     *
     * @return mixed|void
     */
    protected function writeLog($massage, $type)
    {
        $sql = "INSERT INTO log (message, type, creation_date)"
            . " VALUES ( ?, ? , ? )";
        $statement = $this->getConnection()->prepare($sql);
        $statement->execute([$massage, $type, date('Y-m-d H:i:s')]);
    }
}