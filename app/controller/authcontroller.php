<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\messenger;
use PHPPROJECT\lib\routing;
use PHPPROJECT\models\usersmodel;

class authcontroller extends abstractclasscontroller
{
  use routing;
    public function loginaction(){
      
        $this->language->load_dictionary_path("template.common");
        $this->_template->swaptemplateparts(
          [
            ":view"   => ":action_view"
          ]
        );
        if(isset($_POST['login']))
        {
          // $founduser = usersmodel::getone('username',$_POST['uname']);
          // if($founduser != false)
          // {
            
          //   return true;
            
          // }
          // will return $session->u = $object of user
            $isauthorized =  usersmodel::authentication($_POST['uname'],$_POST['upassword'],$this->session) ;
            if($isauthorized == 2)
            {
              $this->messenger->add_message(  
               "soory this user is dsiabled",messenger::APP_MESSAGE_ERROR
               );
            }
            if($isauthorized == 1)
            {
              $this->routing("/");
              return true;
            }
            if(!$isauthorized)
            {
              $this->messenger->add_message(  
                "soory this user is not found",messenger::APP_MESSAGE_WARNNING
                );
            }
          
        }
        
        $this->_showpage();
        
      
    }
    public function logoutaction()
    {
      $this->session->kill();
      $this->routing("/auth/login");
    }



}