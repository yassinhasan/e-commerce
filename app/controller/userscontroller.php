<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\file_upload;
use PHPPROJECT\lib\filter_inputs;
use PHPPROJECT\lib\helper;
use PHPPROJECT\lib\messenger;
use PHPPROJECT\lib\routing;
use PHPPROJECT\lib\validate;
use PHPPROJECT\models\userprofilemodel;
use PHPPROJECT\models\usersgroupmodel;
use PHPPROJECT\models\usersmodel;


class userscontroller extends abstractclasscontroller 
{
    use validate;
    use filter_inputs;
    use routing;
    use helper;


    private $_add_action_roles = 
        [
            'username'           => 'req|alpha_num|between(6,30),lt(33)',
            'firstname'           => 'req|alpha_num|between(6,30),lt(33)',
            'lastname'           => 'req|alpha_num|between(6,30),lt(33)',
            'address'           => 'req|alpha_num|between(6,50),lt(50)',
            // 'username'           => 'eq(hasan)',
            'password'           => 'req|eqfiled(confirm_password)',
            'confirm_password'   => 'req',
            'email'              =>  'req|email|eqfiled(confirm_email)',
            'confirm_email'      =>  'req|email',
            'phonenumber'        =>  'alpha_num|min(5)',
            // 'phonenumber'        =>  'float_like(2,3)',
            'group_id'        =>  'req',

        ];
    private $_edit_action_roles = 
        [
            'phonenumber'        =>  'alpha_num|min(5)',
            // 'phonenumber'        =>  'float_like(2,3)',
            'group_id'        =>  'req',

        ];
    public function defaultaction()
    {
        
        $this->language->load_dictionary_path("users.default");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("users.messages");
        $this->language->load_dictionary_path("validate.validate");
        $this->data['users'] = usersmodel::get_all_except_loged_user(usersgroupmodel::$tablename,'group_id',$this->session->u->users_id);
        // if($this->data['users'] != false)
        // {
        //     if(!empty($this->data['users']) && is_array($this->data['users']))
        //         {   
        //             $users_group  = [];
        //             foreach($this->data['users'] as $user)
        //             {        
        //                 $users_group[] = usersgroupmodel::getby(['group_id' => $user->group_id]);  
        //             }
        //         }
        // }

        
        $this->_showpage();

    }
    public function addaction()
    {

        
        $this->language->load_dictionary_path("users.add");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("validate.validate");
        $this->language->load_dictionary_path("users.messages");
        $this->data['groups'] = usersgroupmodel::get_all();


        

       // TODO:: SEND THE USER WELCOME EMAIL
        if(isset($_POST['save']) && $this->isvalid($this->_add_action_roles,$_POST)) 
        {

           $username = $this->filter_str($_POST['username']);
           $email = $this->filter_str($_POST['email']);
           $phonenumber = $this->filter_str($_POST['phonenumber']);
           $group_id = $this->filter_int($_POST['group_id']);

            $file = new file_upload($_FILES, 'image',$this->messenger);
           // new user
           $new_users = new usersmodel();
           $new_users->username = $username;  
           $newpass = $new_users->cryptpassword($_POST['password'])  ;
           $new_users->password =  $newpass;
           $new_users->email = $email;
           $new_users->phonenumber = $phonenumber;
           $new_users->group_id = $group_id;
           $new_users->subscriptiondate = date('Y-m-d');
           $new_users->lastlogin = date('Y-m-d H:i:s');
           $new_users->status = 1;

           if (usersmodel::userexists( 'username',$username))
            {
                $this->messenger->add_message(
                    "sorry this acocount name $username is exists"
                    ,messenger::APP_MESSAGE_ERROR
                    ); 
    
                
            }
           if (usersmodel::userexists( 'email',$email))
            {
                $this->messenger->add_message(
                    "sorry this email  $email is exists"
                    ,messenger::APP_MESSAGE_ERROR
                    ); 
    
                    session_write_close();
                    $this->routing("/users");
                    exit;
            }

            if($file->filecheck())
            {
           if($new_users->create() )
           {
// new user profile
            $firstname = $this->filter_str($_POST['firstname']);
            $lastname = $this->filter_str($_POST['lastname']);
            $address = $this->filter_str($_POST['address']);
            $dob = $this->filter_str($_POST['DOB']);
            $user_profile = new userprofilemodel();
            $user_profile->users_id = $new_users->last_id;
            $user_profile->firstname = $_POST['firstname'];
            $user_profile->lastname = $_POST['lastname'];
            $user_profile->address = $_POST['address'];
            $user_profile->DOB = $_POST['DOB'];
            $user_profile->image =  $file->getfilename();
            $user_profile->create();
            var_dump($new_users);
            var_dump($user_profile);

            

            $this->messenger->add_message(  
            $this->language->get_value_from_dictionary("text_messages_succ")
           );

           }
           else
           {

            $this->messenger->add_message(  
            $this->language->get_value_from_dictionary("text_messages_failed"),messenger::APP_MESSAGE_ERROR
            );
           }
           session_write_close();
         //  $this->routing("/users");
           exit;
        } 
            }
 
        
        $this->_showpage();
        
    }

    public function checkuserajaxrequestaction()
    {

       if (isset($_POST['username']))
        {
           
            header('Content-type: text/plain');//with header Content type 
           if (usersmodel::userexists('username',$_POST['username']))
           {
                echo 1;
                
           }
           else
           {
               echo 2;
           }
            
        }
       if (isset($_POST['email']))
        {
           
            header('Content-type: text/plain');//with header Content type 
           if (usersmodel::emailexists('email', $_POST['email']))
           {
                echo 1;
                
           }
           else
           {
               echo 2;
           }
            
        }
    }
    public function editaction()
    {
        $this->language->load_dictionary_path("users.edit");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("validate.validate");
        $this->language->load_dictionary_path("users.messages"); 
        $this->data['groups'] = usersgroupmodel::get_all();
        if(!empty($this->_params) &&  $this->_params[0] > 0)
        {
            $users_id = $this->filter_int( $this->_params[0]);
            $this->data['users'] = usersmodel::get_by_primary_key($users_id);
            if( $this->data['users'] == false || $this->session->u->users_id == $users_id)
            {
                
             
                $this->routing("/users");
              
               
            }
            if(isset($_POST['save'])  &&  $this->isvalid($this->_edit_action_roles,$_POST))
            {
                $username = $this->filter_str($_POST['username']);
               $phonenumber = $this->filter_str($_POST['phonenumber']);
               $group_id = $this->filter_int($_POST['group_id']);
               // new user
               $updated_users = usersmodel::get_by_primary_key($users_id);
               $updated_users->phonenumber = $phonenumber;
               $updated_users->group_id = $group_id;

               if($updated_users->save())
               {
                  
              $this->messenger->add_message(  
                $this->language->get_value_from_dictionary("text_messages_succ")
               );
               
               }
               else
               {
                
                 $this->messenger->add_message(  
                $this->language->get_value_from_dictionary("text_messages_failed"),messenger::APP_MESSAGE_ERROR
                );
                
               }
               session_write_close();
               $this->routing("/users");
               exit;
             
               
              
            }


        }  
        $this->_showpage();
    }
    public function deleteaction()
    {
        $this->language->load_dictionary_path("users.edit");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("validate.validate");
        $this->language->load_dictionary_path("users.messages"); 
        if(!empty($this->_params) &&  $this->_params[0] > 0)
        {
            $users_id = $this->filter_int( $this->_params[0]);
            $this->data['users'] = usersmodel::get_by_primary_key($users_id);
           if( $this->data['users'] == false || $this->session->u->users_id == $users_id)
            {

                $this->routing("/users");
            }
               if($this->data['users']->delete())
               {
              $this->messenger->add_message(  
                $this->language->get_value_from_dictionary("text_messages_succ")
               );
             
               }
               else
               {
                 $this->messenger->add_message(  
                $this->language->get_value_from_dictionary("text_messages_failed"),messenger::APP_MESSAGE_ERROR
                );
                
               }
               $this->routing("/users");
               
              


        }  
        // $this->_showpage();
    }

}
/*
HTTP headers | Content-Type
Last Updated : 11 Oct, 2019
The Content-Type header is used to indicate the media type of the resource. The media type is a string sent along with the file indicating the format of the file. For example, for image file its media type will be like image/png or image/jpg, etc.

In response, it tells about the type of returned content, to the client. The browser gets to know about the type of content it has to load on the machine. Every time its byte stream of the file that browsers receive, by the Content-type header, the browser will do something known as MIME sniffing i.e. it will inspect the stream it is receiving and then loads the data accordingly.

Syntax:

Content-Type: text/html; charset=UTF-8
Content-Type: multipart/form-data; boundary=something
Directives: There are three directives in the HTTP headers Content-type.

media type: It holds the MIME (Multipurpose Internet Mail Extensions) type of the data.
charset: It holds the character encoding standard. Charset is the encoding standard in which the data will be received by the browsers.
boundary: The boundary directive is required when there is multipart entities. Boundary is for multipart entities consisting of 70 characters from a set of characters known to be very robust through email gateways, and with no white space.
*/


