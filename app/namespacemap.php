<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi;

require_once 'autoload.php';

$autoload = new Autoload();
$autoload->addNamespace('Cgi', 'app/Controllers');
$autoload->addNamespace('Cgi', 'app/Models');
$autoload->addNamespace('Cgi', 'app/View');
$autoload->addNamespace('Cgi', 'app/Module/Magento');
$autoload->addNamespace('Cgi', 'app/Module/EOrm');
$autoload->addNamespace('Cgi', 'app/Module/Log');
$autoload->addNamespace('Cgi', 'app/Module/Pagination');
$autoload->addNamespace('Cgi', 'app/Core');
$autoload->register();