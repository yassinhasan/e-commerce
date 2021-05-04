<?php
namespace PHPPROJECT\controller;
class accessdenidcontroller extends abstractclasscontroller
{
    
    public function defaultaction()
    {

        $this->language->load_dictionary_path("template.common");
        $this->_showpage();

    }
}