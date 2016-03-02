<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Log;

class LogFile extends LogAbstract
{
    /**
     * @param $massage
     * @param $type
     *
     * @return mixed|void
     */
    protected function writeLog($massage, $type)
    {
        $current = file_get_contents(LOG_FILE);
        $current .= date('Y-m-d H:i:s') . ' - ' . $type . ' - '
            . $massage . "\r";
        file_put_contents(LOG_FILE, $current);
    }
}