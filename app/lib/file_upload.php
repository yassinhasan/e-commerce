<?php
namespace PHPPROJECT\lib;
use PHPPROJECT\lib\messenger;

class file_upload
{

  // هحتاج الملف 
  // هحتاج اسم الملف 
  // هحتاج التمب بتاع الملف
  // هحتاج حجم الملف
    private $file;
    private $file_name;
    private $file_size;
    private $file_type;
    private $file_tmp;
    private $file_error;
    private $file_extenstion;
    const UPLOADED_FILE = UPLOADED_PATH;
    const ALLOWED_TYPE = array("jpeg","gif","jpg","JPG");
    private $uploaded_foleder;
    private $messenger;
    

    // public function getfile($type,$file)
    // {
    //   return $this->file = $type[$file];
    // }
    public function __construct($type,$file,messenger $messenger)
    {
      $this->file = $type[$file];

      preg_match_all('/([a-z]{1,4}$)/i', $type[$file]['name'], $m);

      $this->file_extenstion = isset($m[0][0]) ? strtolower($m[0][0]) : "";

      // $filename = substr($filename,0,15);
      if($this->file_extenstion != "") 
      {
       $this->file_name = substr(md5($type[$file]['name'] . time()), 0, 20) . ".".strtolower($this->file_extenstion);
      }
      else
      {
        $this->file_name = "";
      }
        $this->file_size = $type[$file]['size'];
        $this->file_tmp = $this->file['tmp_name'];
        $this->file_error = $this->file['error'];
        $this->file_type = $this->file['type'];
        $this->uploaded_foleder = self::UPLOADED_FILE.$this->file_name;
        $this->messenger = $messenger;

    }
    public function getfilename()
    {

      return $this->file_name;

    }
    public function is_file_size_allowed()
    {
       preg_match_all("/(\d+)([MG])/",MAX_UPLOADED_FILE_SIZE,$m);
      $file_size_allowed = round($m[1][0]);
      $currentsize = ($m[2][0]) == "M" ? ($this->file_size / (1024*1024)) : ($this->file_size  /(1024*1024 * 1024)) ;
      return ceil($currentsize) < $file_size_allowed;

    }
    public function isimage()
    {
      return preg_match("/image/i",$this->file_type);
    }
    public function filecheck()
    {

      $errors = [];

      if(isset($this->file) &&  $this->file_error === 4)
      {
  
     $this->messenger->add_message("sorry no file choses", messenger::APP_MESSAGE_ERROR);

        $errors[] = "sorry no file choses";

      }
      else
      {

          if (!$this->is_file_size_allowed())
            {
            $this->messenger->add_message("sorry the  file if big", messenger::APP_MESSAGE_ERROR);
              $errors[] = "sorry the  file if big";

          }
          if(!in_array( $this->file_extenstion , SELF::ALLOWED_TYPE))
          {
            $this->messenger->add_message(" soory this type not allowed ", messenger::APP_MESSAGE_ERROR);

            $errors[] = " soory this type not allowed ";
          }
         

      }

      if(empty($errors))
      {
        if($this->isimage())
        {
          move_uploaded_file($this->file_tmp, UPLOADED_PATH . $this->getfilename());
           return $this;

        }
      }
      else
      {
        return false;
      }
     
    }

}

/*

array(1) {
  ["image"]=>
  array(5) {
    ["name"]=>
    string(11) "yassin2.jpg"
    ["type"]=>
    string(10) "image/jpeg"
    ["tmp_name"]=>
    string(23) "C:\xampp\tmp\phpE30.tmp"
    ["error"]=>
    int(0)
    ["size"]=>
    int(25101)
  }
}



    
*/