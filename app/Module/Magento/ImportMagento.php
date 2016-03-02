<?php
/**
 * Import product data from magento using api/rest and
 * the direction of data exported to the database trainee
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Magento;

use Cgi\Module\Log\LogFile;

class ImportMagento
{
    private $_log = null;

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
     * @param $url
     *
     * @return bool
     */
    public function getDataApi($url)
    {
        $apiURL = 'http://' . $url . '/api/rest/products';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        if (!$json) {
            $this->setLog()->notice(curl_error($ch));
        } else {
            $export = new ExportFromMagento();
            $export->setData(json_decode($json, true));
            return true;
        }
        curl_close($ch);
    }
}