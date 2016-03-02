<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi;

require_once 'namespacemap.php';
require_once 'Core/router.php';
require_once 'config.php';

session_start();
Router::start();