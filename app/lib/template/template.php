<?php
namespace PHPPROJECT\lib\template;

use PHPPROJECT\lib\helper;

class template
{
    use templatehelper;
    use helper;
    public $template_parts;
    private $_viewpath;
    private $_data ;
    private $koky_js;
    private $_regitser;
    public function __construct($parts)
    {
        $this->template_parts = $parts;
    }
    public function setpath($path)
    {
        $this->_viewpath = $path;

    }
    public function setdata($_data)
    {
        $this->_data = $_data;
    
    }
    public function koky_js($koky_js)
    {
        $this->koky_js = $koky_js;
    
    }
    public function setregister($_register)
    {
        $this->_regitser = $_register;
    
    }

    public function __get($key)
    {
        return $this->_regitser->$key;
    }

    public function swaptemplateparts($template_parts)
    {
        $this->template_parts['template'] = $template_parts;
    }

    public function template_parts()
    {
        return $this->template_parts ;
    }

    private function html_start()

    {
        extract($this->_data);
        require_once  TEMP_PATH."html_start.PHP";
    }
    private function render_css()
    {
        $parts = $this->template_parts;
        if(!empty ($parts) && is_array($parts))
        {
           
            if(array_key_exists("header_links" , $parts))
            {   

                $css_parts = $parts['header_links']['css_links'];
                $links = "";
                foreach($css_parts as $css_name => $link)
                {
                    
                     $links  .= "<link rel='stylesheet' href = '".$link."' >";

                }
                if( $_SESSION["lang"] == "ar")
                {
                    $links  .= "<link rel='stylesheet' href = '".CSS.'//rtl.css'."' >";
                }
                
                echo $links;
            }

        }
    }
    private function render_JS()
    {
        $parts = $this->template_parts;
        if(!empty ($parts) && is_array($parts))
        {
           
            if(array_key_exists("footer_links" , $parts))
            {
                $jss_parts = $parts['footer_links']['js_links'];
                $links = "";
                foreach($jss_parts as $jss_name => $link)
                {
                    
                     $links  .= "<script src = '".$link."' ></script>";

                }
                if($this->koky_js === "koky")
                {
                    $links  .= "<script src = '".JS."myjquery.js"."' ></script>";
                }
                echo $links;
            }

        }
    }
    private function head_end()

    {
       extract($this->_data) ;
        require_once  TEMP_PATH."head_end.php";
    }
    private function html_end()

    {
        extract($this->_data);
        require_once  TEMP_PATH."html_end.php";
    }

    private function render_all()
    {
        $parts = $this->template_parts;
        if(!empty ($parts) && is_array($parts))
        {
           
            if(array_key_exists("template" , $parts))
            {
                $header_parts = $parts['template'];
                
                foreach($header_parts as $key => $value)
                {   
                    if($key === ":view")
                    {
                        extract($this->_data);
                        require_once $this->_viewpath;
                    }
                    else
                    {
                        extract($this->_data);
                        require_once $value;
                    }                   
               }

                
            }

        }
    }

    public function render_template()
    { 
        $this->html_start();
        $this->render_css();
        $this->head_end();

        $this->render_all();
        $this->render_JS();
        $this->html_end();
    }
    

}