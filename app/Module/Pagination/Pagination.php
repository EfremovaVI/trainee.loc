<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Pagination;

use Cgi\Connection;
use Cgi\Module\Log\LogFile;
use Cgi\Module\Url\Url;

class Pagination
{
    private $_conn;
    private $_log;
    private $_limit = 5;
    private $_page = 1;
    private $_data = [];
    private $_table;

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
     * @param $limit
     * @param $page
     * @param $table
     * @param $sort
     *
     * @return array
     */
    public function getData($limit, $page, $table, $sort)
    {
        $this->_table = $table;
        $this->_limit = !empty($limit) ? $limit : $this->_limit;
        $this->_page = !empty($page) ? $page : $this->_page;

        $sql = 'SELECT * FROM ' . $table . $sort . ' LIMIT '
            . (($this->_page - 1) * $this->_limit) . ', ' . $this->_limit;

        $select = $this->getConnection()->prepare($sql);
        $select->execute();

        $data = $select->fetchAll();
        $this->_data = $data;
        return $this->_data;
    }

    /**
     * @return array
     */
    public function createLinks()
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->_table;
        $select = $this->getConnection()->prepare($sql);
        $select->execute();

        $countPage = $select->fetch();
        $countLinkPage = ceil($countPage[0] / $this->_limit);
        $pager = [];
        for ($i = 1; $i <= $countLinkPage; $i++) {
            $pager[] = '<a href="' . Url::getUrlPage() . 'page=' . $i
                . '">' . $i . '</a> &nbsp';
        }
        return $pager;
    }
}