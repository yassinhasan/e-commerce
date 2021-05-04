<?php
namespace PHPPROJECT\lib;
trait filter_inputs
{
    public function filter_int($int)
    {
        return $int = filter_var($int,FILTER_SANITIZE_NUMBER_INT);
    }
    public function filter_str($str)
    {
        return $str = filter_var($str,FILTER_SANITIZE_STRING);
    }
    public function filter_decimal($decimal)
    {
        return $decimal = filter_var($decimal,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    }
}