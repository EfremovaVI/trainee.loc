<?php
/**
 * The connection to the database
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi;

use Cgi\Module\Log\LogFile;

class Connection
{
    private $dbConnection;
    private static $_instance;

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        try {
            $this->dbConnection = new \PDO(
                'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS
            );
        } catch (\PDOException $e) {
            $logFile = new LogFile();
            $logFile->error(
                'The connection failed, error: ' . $e->getMessage()
            );
            die();
        }
    }

    /**
     * @return Connection
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     * Get PDO connection
     *
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->dbConnection;
    }
}