<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\maincontroller;
use PHPPROJECT\lib\register;
use PHPPROJECT\lib\template;
use PHPPROJECT\lib\validate;

class abstractclasscontroller
{
    use validate;
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $data = [];
    protected $_template;
    protected $_regitser;


    public function setcontroller($_controller)
    {
       $this->_controller = $_controller;
    }
    public function setacion($_action)
    {
        $this->_action =$_action;
    }
    public function setparams($_params)
    {
        $this->_params =$_params;
    }
    public function settemplate($_template)
    {
        $this->_template =$_template;
    }
    public function setregister($_regitser)
    {
        $this->_regitser =$_regitser;
    }
    public function __get($key)
    {
        return $this->_regitser->$key;
    }

    public function notfoundaction()
    {
     $this->language->load_dictionary_path("notfound.notfound" , $this->session->lang );
     $this->language->load_dictionary_path("template.common" , $this->session->lang); 
     $this->_showpage();
    }
    public function _showpage()
    {

    //   if( $this->_action == maincontroller::NOT_FOUND_ACTION)
    //   {
         
    //       $view_page = VIEW_PATH."notfound".DS."404page.php";
    //       require_once $view_page;
    //   }
    //   else
    //   {

    //       $view_page = VIEW_PATH.$this->_controller.DS.$this->_action.".view.php";
    //       if(file_exists($view_page))
    //       {
    //             require_once $view_page;
    //       }
    //       else
    //       {
    //          $view_page = VIEW_PATH."notfound".DS."noaction.view.php";
    //          require_once $view_page;
    //       }
         
          
    //   }
    



        $view_page = VIEW_PATH.$this->_controller.DS.$this->_action.".view.php";
        if( $this->_controller == maincontroller::NOT_FOUND_CONTROLLER || ! file_exists($view_page) )
        {
            $view_page = VIEW_PATH."notfound".DS."notfound.php";
            $this->data['yes'] = true;
        }
        //   extract($this->data);
        $this->data['controller_name'] = $this->_controller;
        // $this->data['breadcrumb_controller'] = $this->_controller;

        $this->data['action_name'] = $this->_action;
        // $this->data['breadcrumb_action'] = $this->_action;
        $this->data =array_merge($this->language->get_dictionary(),$this->data);
        $this->_template->setregister($this->_regitser);
        $this->_template->setpath($view_page);
        $this->_template->setdata($this->data);
        //   require_once $view_page;
        $this->_template->render_template();
        
        require_once $view_page;
       
        
    }
      
    


}