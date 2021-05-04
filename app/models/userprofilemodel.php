<?php
namespace PHPPROJECT\models;

class userprofilemodel extends abstractmodel
{
    public $users_id;
    public $firstname;
    public $lastname;
    public $address;
    public $DOB;
    public $image;

    public static $tablename = "app_users_profile";
    protected static $primary_key = "users_id";
    protected static $table_columns = array(
        "users_id" => self::FILTER_INT,
        "firstname" => self::FILTER_STR,
        "lastname" => self::FILTER_STR,
        "address" => self::FILTER_STR,
        "DOB" => self::FILTER_STR,
        "image" => self::FILTER_STR,


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