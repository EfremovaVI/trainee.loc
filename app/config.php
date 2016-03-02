<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */

define ('DS', DIRECTORY_SEPARATOR);
$sitePath = realpath(dirname(__FILE__) . DS);
define ('SITE_PATH', $sitePath);

define('DB_USER', 'root');
define('DB_PASS', '2016');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'trainee');

define('LOG_FILE', 'info.log');

define('VALUE_TEXT', '65535');
define('VALUE_VARCHAR', '255');