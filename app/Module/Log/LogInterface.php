<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Log;

interface LogInterface
{
    /**
     * @param $massage
     *
     * @return mixed
     */
    public function error($massage);

    /**
     * @param $massage
     *
     * @return mixed
     */
    public function warning($massage);

    /**
     * @param $massage
     *
     * @return mixed
     */
    public function notice($massage);
}