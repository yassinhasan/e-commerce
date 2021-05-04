<?php
namespace PHPPROJECT\models;

class usersgroupmodel  extends abstractmodel
{

    public $group_id; 
    public	$group_name;	


    public static $tablename = "app_users_group";
    protected static $primary_key = "group_id";
    protected static $table_columns = array(
        "group_id" => self::FILTER_INT,
        "group_name"  => self::FILTER_STR,

    );
    // public function __construct($group_name)
    // {
    //     $this->group_name =$group_name;
    // }
    // public function __set($name, $value)
    // {
    //      $this->$name = $value;
    // }
    // public function __get($name)
    // {
    //     return $this->$name;
    // }


}