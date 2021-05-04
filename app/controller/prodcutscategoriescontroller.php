<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\file_upload;
use PHPPROJECT\lib\filter_inputs;
use PHPPROJECT\lib\messenger;
use PHPPROJECT\lib\routing;
use PHPPROJECT\models\prodcutscategories;

class prodcutscategoriescontroller extends abstractclasscontroller
{
    use filter_inputs;
    use routing;
    public function defaultaction()
    {
//var_dump($this);
        $this->language->load_dictionary_path("prodcutscategories.default");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("prodcutscategories.messages");

        $this->data['categories'] = prodcutscategories::get_all();
        $this->_showpage();

    }
    public function addaction()
    {

        $this->language->load_dictionary_path("prodcutscategories.default");

        $this->language->load_dictionary_path("prodcutscategories.add");    

        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("prodcutscategories.messages");


        if (isset($_POST['save'])) {

            $category_name = $this->filter_str($_POST['category_name']);
            $new_category = new prodcutscategories();
            $new_category->category_name = $category_name;
            $file = new file_upload($_FILES, 'category_image', $this->messenger);

            $new_category->category_iamge = $file->getfilename();


        //  var_dump($file->getfilename())  ;
            //var_dump($file)
            if($file->filecheck()){
                 if ($new_category->save()) {
                        $this->messenger->add_message("product added".$file->getfilename()."succesfully", messenger::APP_MESSAGE_SUCCESS);
                        session_write_close();
                        $this->routing("/prodcutscategories");
                        exit;              
                    }                
            }

        }
        $this->_showpage();
    }
    public function editaction()
    {
        if (!empty($this->_params) && $this->_params[0] > 0) {
            $category_id = $this->filter_int($this->_params[0]);
            $categories = prodcutscategories::get_by_primary_key($category_id);

            $oldimage = $categories->category_iamge;


            $this->data['categories'] = $categories;
            if ($categories == false) {
                $this->routing("/prodcutscategories");
            }
            $this->language->load_dictionary_path("prodcutscategories.default");
            $this->language->load_dictionary_path("prodcutscategories.edit");
            $this->language->load_dictionary_path("template.common");
            $this->language->load_dictionary_path("prodcutscategories.messages");


            if (isset($_POST['save'])) {

                $categoryname = $this->filter_str($_POST['category_name']);
                $categories->category_name = $categoryname;
                $file = new file_upload($_FILES, 'category_image', $this->messenger);
                // var_dump($file->getfilename());
                // exit;
             if (file_exists(UPLOADED_PATH . $oldimage ) &&  $file->getfilename() !== "")
            {
                unlink(UPLOADED_PATH . $oldimage);             
            }
            if ($file->filecheck() && $file->getfilename() !== "") {
                $categories->category_iamge = $file->getfilename();

                if ($categories->save()) {
                    $this->messenger->add_message("product added" . $file->getfilename() . "succesfully", messenger::APP_MESSAGE_SUCCESS);
                    session_write_close();
                    $this->routing("/prodcutscategories");
                    exit;
                }
            }
            else
            {
                $categories->save();
            }




                    $this->routing("/prodcutscategories");
                    /*
                select augp.*,aup.privilege_title,aug.group_name from app_users_group_privileges as augp inner join app_users_privileges as aup on augp.privilege_id = aup.privilege_id inner join app_users_group as aug on augp.group_id = aug.group_id;                    */
                
        }
           
        }

        $this->_showpage();

    }
    public function deleteaction()
    {
        if (!empty($this->_params) && $this->_params[0] > 0) {
            $category_id = $this->filter_int($this->_params[0]);
            $category = prodcutscategories::get_by_primary_key($category_id);
            if ($category == false) {
                $this->routing("/prodcutscategories");
            }
            if (file_exists(UPLOADED_PATH . $category->category_iamge))
            {
                unlink(UPLOADED_PATH . $category->category_iamge);
                
            }
            
            $category->delete();

            
               $this->routing("/prodcutscategories");
                /*
            select augp.*,aup.privilege_title,aug.group_name from app_users_group_privileges as augp inner join app_users_privileges as aup on augp.privilege_id = aup.privilege_id inner join app_users_group as aug on augp.group_id = aug.group_id;                    */
        }
    }

}
