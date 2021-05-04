<?php
namespace PHPPROJECT\models;

class privilegesmodel  extends abstractmodel
{

    private $privilege_id; 
    private	$privilege_title;	
    private	$privileges_url;

    protected static $tablename = "app_users_privileges";
    protected static $primary_key = "privilege_id";
    protected static $table_columns = array(
        "privilege_id" => self::FILTER_INT,
        "privilege_title"  => self::FILTER_STR,
        "privileges_url"  => self::FILTER_STR,

    );
    // public function __construct($privilege_title,$privileges_url)
    // {
    //     $this->privilege_title =$privilege_title;
    //     $this->privileges_url =$privileges_url;
    // }
    public function __set($name, $value)
    {
         $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }
}