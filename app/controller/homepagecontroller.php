<?php
namespace PHPPROJECT\controller;

use PHPPROJECT\lib\validate;

class homepagecontroller extends abstractclasscontroller
{
    use validate;
    public function defaultaction()
    {

        
        $this->language->load_dictionary_path("homepage.default");
        $this->language->load_dictionary_path("template.common");
        $this->_showpage();     


    }
    public function addaction()
    {
        $this->language->load_dictionary_path("notfound.notfound" );
        $this->language->load_dictionary_path("template.common");
        $this->_showpage();
    }

}

