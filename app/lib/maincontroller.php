<?php
namespace PHPPROJECT\lib;

use PHPPROJECT\lib\template\template;

class maincontroller
{
   
    use routing;
    const NOT_FOUND_CONTROLLER = "notfoundcontroller";
    const NOT_FOUND_ACTION = "notfoundaction";
    private $_controller = "homepage";
    private $_action     ="default";
    private $_params     = array();
    private $_template;
    private $_register;
    private $_auth;
    public function __construct(template $template,register $register,authentication $_auth)
    {
       $this->parseurl();
       $this->_template = $template;
       $this->_register = $register;
       $this->_auth = $_auth;
    }

    private function parseurl()
    {
      $url =  $_SERVER['REQUEST_URI'];
      $url = trim($url,"/");
      $url = explode("/",$url,3);
    
      if( isset($url[0]) && !$url[0]== "")
      {
        $this->_controller = $url[0];
        
        
      }
      else
      {
        $this->_controller = "homepage";
      }

      if(isset($url[1]) && !$url[1]== "")
      {
        $this->_action = $url[1]; 
      
        
      }
      else
      {
        $this->_action = "default";
      }
      
      if(isset($url[2]) && !$url[2] == "")
      {
          $this->_params = explode("/",$url[2]);
      }
    }

    public function dispatch()
    {


      $controllerclassname = "\\PHPPROJECT\controller\\".$this->_controller."controller";    
      $actionname = $this->_action."action";

       if(! $this->_auth->autenticate())
       {
        $controllerclassname = "\\PHPPROJECT\controller\\authcontroller";
        $actionname = "loginaction";
        $this->_controller = "auth";
        $this->_action = "login";

       }
       if(! $this->_auth->autenticate())
       {
        if($this->_controller != "auth" && $this->_action != "login")
        {
         $this->routing("/auth/login");
        }
       }
       else
       {
          if($this->_controller == "auth" && $this->_action == "login")
          {
            //$_SERVER["HTTP_REFERER"]  دي بتشتغل فقط لما يكون فيه رابط حقيقي انا دوست عليه وقتها هيرجعني ع نفس المكان
          isset($_SERVER["HTTP_REFERER"]) ? $this->routing( $_SERVER["HTTP_REFERER"]) : $this->routing( "/");

          
          }
          if(! $this->_auth->hasaccess($this->_controller,$this->_action))
          {
            $this->routing("/accessdenid/default");

          }

      }

  
 
       if(! class_exists($controllerclassname))
       {
         $controllerclassname = "\\PHPPROJECT\controller\\".self::NOT_FOUND_CONTROLLER;
         $this->_controller = self::NOT_FOUND_CONTROLLER;
       }
       
       //echo $controllerclassname."//////".$actionname;
      $controller = new $controllerclassname();
      if(! method_exists($controller,$actionname))
      {
        $actionname = self::NOT_FOUND_ACTION;
        $this->_action = self::NOT_FOUND_ACTION;
      }
     
     
      $controller->setcontroller($this->_controller);  
      $controller->setacion($this->_action);  
      $controller->setparams($this->_params); 
      $controller->settemplate($this->_template); 
      $controller->setregister($this->_register); 
       $controller->$actionname();
       
    }
         
}