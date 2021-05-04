<?php
namespace PHPPROJECT\lib;
trait helper
{
    public function showvalue($field_name,$object = null)
    {
        return isset($_POST[$field_name]) ? $_POST[$field_name] : (\is_null($object)? '': $object->$field_name);
    }
    public function selected($field_name,$value,$object= null)
    {
      return  ( (isset($_POST[$field_name]) && $_POST[$field_name] == $value ) ||  (!\is_null($object) && $object->$field_name == $value) )? "selected='selected'": "";
    }
    
}