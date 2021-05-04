<?php

namespace PHPPROJECT\controller;

use PHPPROJECT\lib\file_upload;
use PHPPROJECT\lib\filter_inputs;
use PHPPROJECT\lib\helper;
use PHPPROJECT\lib\messenger;
use PHPPROJECT\lib\routing;
use PHPPROJECT\lib\validate;
use PHPPROJECT\models\userprofilemodel;
use PHPPROJECT\models\suppliersgroupmodel;
use PHPPROJECT\models\suppliersmodel;

class supplierscontroller extends abstractclasscontroller
{
    use validate;
    use filter_inputs;
    use routing;
    use helper;


    public function defaultaction()
    {

        $this->language->load_dictionary_path("suppliers.default");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("suppliers.messages");
        $this->language->load_dictionary_path("validate.validate");
        $this->data['suppliers'] = suppliersmodel::get_all();

        $this->_showpage();

    }
    public function addaction()
    {

        $this->language->load_dictionary_path("suppliers.add");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("validate.validate");
        $this->language->load_dictionary_path("suppliers.messages");

        // TODO:: SEND THE USER WELCOME EMAIL
        if (isset($_POST['save'])) 
        {

            $suppliers_name = $this->filter_str($_POST['suppliers_name']);
            $email = $this->filter_str($_POST['email']);
            $suppliers_number = $this->filter_str($_POST['suppliers_number']);
            $address = $this->filter_str($_POST['address']);

            // new user
            $new_suppliers = new suppliersmodel();
            $new_suppliers->suppliers_name = $suppliers_name;
            $new_suppliers->email = $email;
            $new_suppliers->suppliers_number = $suppliers_number;
            $new_suppliers->address = $address;


                if ($new_suppliers->save()) {

                    $this->messenger->add_message(
                        $this->language->get_value_from_dictionary("text_messages_succ")
                    );

                } else {

                    $this->messenger->add_message(
                        $this->language->get_value_from_dictionary("text_messages_failed"), messenger::APP_MESSAGE_ERROR
                    );
                }
                session_write_close();
                $this->routing("/suppliers");
                exit;
        }
            

        $this->_showpage();


 
    }
    public function editaction()
    {
        $this->language->load_dictionary_path("suppliers.edit");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("validate.validate");
        $this->language->load_dictionary_path("suppliers.messages");
        if (!empty($this->_params) && $this->_params[0] > 0) {
            $suppliers_id = $this->filter_int($this->_params[0]);
            $this->data['suppliers'] = suppliersmodel::get_by_primary_key($suppliers_id);
            if ($this->data['suppliers'] == false) {

                $this->routing("/suppliers");

            }
            if (isset($_POST['save']) && $this->isvalid($this->_add_action_roles, $_POST)) {
            $suppliers_name = $this->filter_str($_POST['suppliers_name']);
            $email = $this->filter_str($_POST['email']);
            $suppliers_number = $this->filter_str($_POST['suppliers_number']);
            $address = $this->filter_str($_POST['address']);

                // new user
                $updated_suppliers = suppliersmodel::get_by_primary_key($suppliers_id);
                $updated_suppliers->suppliers_name = $suppliers_name;
                $updated_suppliers->email = $email;
                $updated_suppliers->suppliers_number = $suppliers_number;
                $updated_suppliers->address = $address;


                if ($updated_suppliers->save()) {

                    $this->messenger->add_message(
                        $this->language->get_value_from_dictionary("text_messages_succ")
                    );

                } else {

                    $this->messenger->add_message(
                        $this->language->get_value_from_dictionary("text_messages_failed"), messenger::APP_MESSAGE_ERROR
                    );

                }
                session_write_close();
                $this->routing("/suppliers");
                exit;

            }

        }
        $this->_showpage();
    }
    public function deleteaction()
    {
        $this->language->load_dictionary_path("suppliers.edit");
        $this->language->load_dictionary_path("template.common");
        $this->language->load_dictionary_path("validate.validate");
        $this->language->load_dictionary_path("suppliers.messages");
        if (!empty($this->_params) && $this->_params[0] > 0) {
            $suppliers_id = $this->filter_int($this->_params[0]);
            $this->data['suppliers'] = suppliersmodel::get_by_primary_key($suppliers_id);
            if ($this->data['suppliers'] == false) {

                $this->routing("/suppliers");
            }
            if ($this->data['suppliers']->delete()) {
                $this->messenger->add_message(
                    $this->language->get_value_from_dictionary("text_messages_succ")
                );

            } else {
                $this->messenger->add_message(
                    $this->language->get_value_from_dictionary("text_messages_failed"), messenger::APP_MESSAGE_ERROR
                );

            }
            $this->routing("/suppliers");

        }
        // $this->_showpage();
    }

}
