<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\filter_inputs;
use PHPPROJECT\lib\routing;
use PHPPROJECT\models\privilegesmodel;
use PHPPROJECT\models\usersgroupmodel;
use PHPPROJECT\models\usersgroupprivilegesmodel;
use PHPPROJECT\models\usersmodel;

class usersgroupcontroller extends abstractclasscontroller
{
    use filter_inputs;
    use routing;
    public function defaultaction()
    {
//var_dump($this);
        $this->language->load_dictionary_path("usersgroup.default");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("usersgroup.messages");

        $this->data['groups'] = usersgroupmodel::get_all();
        $this->_showpage();
        
    }
    public function addaction()
    {
        
        $this->language->load_dictionary_path("usersgroup.add");
        $this->language->load_dictionary_path("template.common");
        $this->data['privileges'] = privilegesmodel::get_all();
           // var_dump($this->data['privileges'] );
           if(isset($_POST['save']))
           {
               
               $group_name = $this->filter_str($_POST['group_name']);
                $new_group= new usersgroupmodel();
                $new_group->group_name = $group_name;
              
               if($new_group->create())
               {
                    
                    if(isset($_POST['privileges']) && is_array($_POST['privileges']))
                    {
                        foreach ($_POST['privileges'] as $privilege_id)
                        {
                         
                            $new_group_privilege = new usersgroupprivilegesmodel();
                           $new_group_privilege->group_id= $new_group->last_id;
                            $new_group_privilege->privilege_id=$privilege_id;
                         
                            $new_group_privilege->save();
                            
                        }
                        
                    }
                session_write_close();

                   $this->routing("/usersgroup");
                   exit;
                    /*
                    select augp.*,aup.privilege_title,aug.group_name from app_users_group_privileges as augp inner join app_users_privileges as aup on augp.privilege_id = aup.privilege_id inner join app_users_group as aug on augp.group_id = aug.group_id;                    */ 
               }                
           }
        $this->_showpage();    
    } 
    public function editaction()
    {
        if(!empty($this->_params) &&  $this->_params[0] > 0)
        {
            $group_id = $this->filter_int( $this->_params[0]);
            $groups = usersgroupmodel::get_by_primary_key($group_id);
            $this->data['groups'] = $groups;
            if( $groups == false )
            {
                $this->routing("/usersgroup");
            }

            $this->data['privileges'] = privilegesmodel::get_all();
            // // $selectd_privileges = usersgroupprivilegesmodel::getby(['group_id' => $groups->group_id]);
            // $selectd_privileges = usersgroupprivilegesmodel::getone('group_id', $groups->group_id);
            // $this->data['selectd_id'] = [];
            // if(! $selectd_privileges == false )
            // { 
            //     foreach($selectd_privileges as $selectd_privilege)
            //     {
            //         $this->data['selectd_id'][] = $selectd_privilege->privilege_id;
            //     }
            //     $extractes_selected_id = $this->data['selectd_id'] ;
            // }

            $extractes_selected_id =  usersgroupprivilegesmodel::get_priviliages($groups);
            $this->data['selectd_id'] = $extractes_selected_id;   
            $this->language->load_dictionary_path("usersgroup.edit");
            $this->language->load_dictionary_path("template.common");

            if(isset($_POST['save']))
            {
            
                  $group_name = $this->filter_str($_POST['group_name']);
                  $groups->group_name = $group_name;
                  $groups->group_id = $group_id;
        
                if($groups->save())
                {
                 
                    if(isset($_POST['privileges']) && is_array($_POST['privileges']))
                    {
                            $privilege_id_will_be_deleted = array_diff($extractes_selected_id ,$_POST['privileges']);
                            $privilege_id_will_be_added = array_diff($_POST['privileges'],$extractes_selected_id );
                            // loop for deleted privilages id 
                            foreach($privilege_id_will_be_deleted as $delted_priv)
                            {
                                    $unwanted_priv= usersgroupprivilegesmodel::getby(['privilege_id' => $delted_priv ,'group_id' => $groups->group_id]) ;
                                    for($x = 0 ; $x < count($unwanted_priv); $x++)
                                    {
                                        $unwanted_priv[$x]->delete();
                                    }

                                    
                            }
                            // add new priv    
                            foreach ($privilege_id_will_be_added as $added_privilege_id)
                            {
                                $new_group_privilege = new usersgroupprivilegesmodel();
                               $new_group_privilege->group_id = $groups->group_id;
                            $new_group_privilege->privilege_id= $added_privilege_id;
                               if($new_group_privilege->save())
                               {
                                   $this->messenger->add_message(
                                 $this->language->get_value_from_dictionary("text_messages_succ")
);

                               }
                         
                            }
                                
                    }
                    $this->routing("/usersgroup");
                 /*
                 select augp.*,aup.privilege_title,aug.group_name from app_users_group_privileges as augp inner join app_users_privileges as aup on augp.privilege_id = aup.privilege_id inner join app_users_group as aug on augp.group_id = aug.group_id;                    */ 
                }                
            }
        }
            

        $this->_showpage(); 
   
    }
    public function deleteaction()
    {
        if(!empty($this->_params) &&  $this->_params[0] > 0)
        {
            $group_id = $this->filter_int( $this->_params[0]);
            $groups = usersgroupmodel::get_by_primary_key($group_id);
            if( $groups == false )
            {
                $this->routing("/usersgroup");
            }
            $selectd_groups = usersgroupprivilegesmodel::getone('group_id', $groups->group_id);
            if(! $selectd_groups == false )
            {
                foreach($selectd_groups as $delted_privilege)
                {
                    $delted_privilege->delete();
                }
            }
       
            if($groups->delete())
                {
                    $this->routing("/usersgroup");
                 /*
                 select augp.*,aup.privilege_title,aug.group_name from app_users_group_privileges as augp inner join app_users_privileges as aup on augp.privilege_id = aup.privilege_id inner join app_users_group as aug on augp.group_id = aug.group_id;                    */ 
            }                
        }
    }
      
}