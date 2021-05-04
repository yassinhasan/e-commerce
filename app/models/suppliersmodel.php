<?php

namespace PHPPROJECT\models;

class suppliersmodel  extends abstractmodel
{
    public $suppliers_id;
    public $suppliers_name ;
    public $suppliers_number;
    public $email;
    public $address;



    public static $tablename = "app_suppliers";
    protected static $primary_key = "suppliers_id";
    protected static $table_columns = array(
        "suppliers_id" => self::FILTER_INT,
        "suppliers_name" => self::FILTER_STR,
        "suppliers_number"   => self::FILTER_STR,
        "email"   => self::FILTER_STR,
        "address" => self::FILTER_STR,

    );

    public function __set($name, $value)
    {
         $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }
}






