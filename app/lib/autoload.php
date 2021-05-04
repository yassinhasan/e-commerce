<?php
namespace PHPPROJECT\lib;

class Autoload
{

    public static function autload($classname)
    {
        $classname = strtolower (str_replace("PHPPROJECT\\","",$classname));
        $classname =  $classname.".php";
        if(! file_exists(APP_PATH.$classname))
        {
            return;
        }
        else
        {
            require_once APP_PATH.$classname;
        }
       
        
    }

}



spl_autoload_register( __NAMESPACE__."\\Autoload::autload");




