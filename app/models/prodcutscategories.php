<?php
namespace PHPPROJECT\models;

class prodcutscategories  extends abstractmodel
{
    public $category_id;
    public $category_name; 
    public	$category_iamge;	


    public static $tablename = "app_products_category";
    protected static $primary_key = "category_id";
    protected static $table_columns = array(
        "category_id" => self::FILTER_INT,
        "category_name"  => self::FILTER_STR,
        "category_iamge"  => self::FILTER_STR,    );
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