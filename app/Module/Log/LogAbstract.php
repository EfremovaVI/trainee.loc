<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Log;

abstract class LogAbstract implements LogInterface
{

    /**
     * @param $massage
     *
     * @return mixed|void
     */
    public function error($massage)
    {
        $this->writeLog($massage, LogConstant::ERROR);
    }

    /**
     * @param $massage
     *
     * @return mixed|void
     */
    public function warning($massage)
    {
        $this->writeLog($massage, LogConstant::WARNING);
    }

    /**
     * @param $massage
     *
     * @return mixed|void
     */
    public function notice($massage)
    {
        $this->writeLog($massage, LogConstant::NOTICE);
    }

    /**
     * @param $massage
     * @param $type
     *
     * @return mixed
     */
    abstract protected function writeLog($massage, $type);
}