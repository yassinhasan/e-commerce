<?php
namespace PHPPROJECT ;

use PHPPROJECT\lib\authentication;
use PHPPROJECT\lib\language;
use PHPPROJECT\lib\maincontroller;
use PHPPROJECT\lib\messenger;
use PHPPROJECT\lib\register;
use PHPPROJECT\lib\session_manager;
use PHPPROJECT\lib\template\template;
use PHPPROJECT\models\abstractmodel;
use PHPPROJECT\models\employeemodel;
use PHPPROJECT\models\usersmodel;

defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);
// ICLUDE config.php
require_once dirname(realpath(__FILE__)).DS."..".DS."app".DS."config".DS."config.php";
$template_parts = require_once dirname(realpath(__FILE__)).DS."..".DS."app".DS."config".DS."templateconfig.php";
// var_dump($template_parts);

// include Autoload.php
require_once APP_PATH."lib".DS."autoload.php";
require_once CONN_PATH;

$session = new session_manager();
$session->start();


if(!isset($session->lang))
{
    $session->lang = DEFAULT_LANGUAGE;
   
} 
$template = new template($template_parts);
$language = new language();

$register = register::getinstance();
// $register = new register();
$register->language = $language;
$register->session = $session;

$messenger = messenger::get_instance($session);

$register->messenger =$messenger;


$authentication = authentication::getinstance($session);
// $register->authentication =$authentication;
$start = new maincontroller($template, $register,$authentication);
$start->dispatch();







 