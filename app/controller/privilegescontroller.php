<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\filter_inputs;
use PHPPROJECT\lib\routing;
use PHPPROJECT\models\privilegesmodel;
use PHPPROJECT\models\usersgroupmodel;
use PHPPROJECT\models\usersgroupprivilegesmodel;

class privilegescontroller extends abstractclasscontroller
{
    use filter_inputs;
    use routing;
    public function defaultaction()
    {
        
        $this->language->load_dictionary_path("privileges.default");
        $this->language->load_dictionary_path("template.common");
        $this->data['privileges'] = privilegesmodel::get_all();
        $this->_showpage();
        
    }
    // TODO: we need to implementn csrf prevention
    public function addaction()
    {
        
        $this->language->load_dictionary_path("privileges.add");
        $this->language->load_dictionary_path("template.common");

           if(isset($_POST['save']))
           {
               $privilege_title =  trim($this->filter_str($_POST['privileges_title']));
               $privileges_url =trim($this->filter_str($_POST['privileges_url'])) ;
                $new_privlige= new privilegesmodel();
                $new_privlige->privilege_title = $privilege_title;
                $new_privlige->privileges_url = $privileges_url;
         
                
               if($new_privlige->save(false))
               {
               $this->messenger->add_message("privliles is saved succusefuly ");     
                $this->routing("/privileges");
               }

                
           }
        $this->_showpage(); 
   
    }
    public function editaction()
    {
        if(!empty($this->_params) &&  $this->_params[0] > 0)
        {
            $priviliges_id = $this->filter_int( $this->_params[0]);
            $this->data['privilege'] = privilegesmodel::get_by_primary_key($priviliges_id);
            if( $this->data['privilege'] == false )
            {
                $this->routing("/privileges");
            }

        }    
        $this->language->load_dictionary_path("privileges.edit");
        $this->language->load_dictionary_path("template.common");

        if(isset($_POST['save']))
        {
            $privilege_title = $this->filter_str($_POST['privileges_title']);
            $privileges_url = $this->filter_str($_POST['privileges_url']);
                $privilege= new privilegesmodel();
                $privilege->privilege_title = trim($privilege_title) ;
                $privilege->privileges_url =trim($privileges_url) ;
                $privilege->privilege_id = $priviliges_id ;
            if($privilege->save())
            {
                $this->routing("/privileges");
            }

        }

        $this->_showpage(); 
   
    }
    public function deleteaction()
    {
        if(!empty($this->_params) &&  $this->_params[0] > 0)
        {
            $priviliges_id = $this->filter_int( $this->_params[0]);
            $privilege = privilegesmodel::get_by_primary_key($priviliges_id);
            if( $privilege == false )
            {
                
                $this->routing("/privileges");
            }
            $selectd_priv = usersgroupprivilegesmodel::getone('privilege_id', $privilege->privilege_id);
            if(! $selectd_priv == false )
            {
                foreach($selectd_priv as $delted_privilege)
                {
                    $delted_privilege->delete();
                }
            }            
            if($privilege->delete())
            {
                $this->routing("/privileges");
            }

        }    

    }
}
