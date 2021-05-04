<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\routing;

class langcontroller extends abstractclasscontroller
{
    use routing;
    public function defaultaction()
    {
       
       
        
      if($this->session->lang == 'ar')
    {
        $this->session->lang ='en';
    }
    else
    {
        $this->session->lang= 'ar';
    }  
   
    $this->routing($_SERVER['HTTP_REFERER']);
    }
   


}