<?php
namespace PHPPROJECT\lib;
class messenger
{
    const APP_MESSAGE_SUCCESS   =1;
    const APP_MESSAGE_ERROR     =2;
    const APP_MESSAGE_WARNNING  =3;
    const APP_MESSAGE_INFO      =4;
    private static $instance;
    private $_session;
    private $_messages = [];


    private function __construct( $_session)
    {
        $this->_session = $_session;
    }
    public static function get_instance(session_manager $_session)
    {
        if ( self::$instance === null)
        {
            self::$instance = new self($_session);
        }
        return self::$instance;
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return $this-> $name;
    }
    // set

    public function add_message($message, $type = self::APP_MESSAGE_SUCCESS)
    {
        if(!$this->message_exists()) {
            $this->_session->messages = [];
        }
        $msgs = $this->_session->messages;
        $msgs[] = [$message, $type];
        $this->_session->messages = $msgs;

    }


    // get

    private function message_exists()
    {
        return isset($this->_session->messages);
    }

    public function get_messgaes()
    {
        if($this->message_exists()) {
            $this->_messages = $this->_session->messages;
            unset($this->_session->messages);
            return $this->_messages;
        }
        return [];

    }

}

/*
        if($this->message_exists()) {
            $this->_messages = $this->_session->messages;
            unset($this->_session->messages);
            return $this->_messages;
        }
        return [];

PHP - Class Constants
Constants cannot be changed once it is declared.

Class constants can be useful if you need to define some constant data within a class.

A class constant is declared inside a class with the const keyword.

Class constants are case-sensitive. However, it is recommended to name the constants in all uppercase letters.

We can access a constant from outside the class by using the class name followed by the scope resolution operator (::) followed by the constant name, like here:
*/

    

