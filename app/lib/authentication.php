<?php
namespace PHPPROJECT\lib;

use PHPPROJECT\models\usersmodel;
use VARIANT;

class authentication 
{
    private static $instance;
    public $_session;

    public function __construct(session_manager $session)
    {
        $this->_session = $session;
    }

    public static function getinstance($session)
    {
        if(self::$instance === null)
        {
            self::$instance = new self($session);
        }
        return self::$instance;
    }
  
    public function autenticate()
    {

        // var_dump($this->_session->u);
        return isset($this->_session->u) ;
    }
    public function hasaccess($controller,$action)
    {
        $url  = "/".$controller."/".$action;
        if(in_array($url,EXCLUDED_URL) || in_array($url,$this->_session->u->privileges))
        {
            return true;
        }
        else
        {
            return false;
        }
   
    }
}