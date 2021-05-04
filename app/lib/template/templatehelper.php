<?php
namespace PHPPROJECT\lib\template;

// هعمل الكلاس ده عشان اخد منه في التمبليت الرئيسي
trait templatehelper
{
    public function match_url($url)
    {
        //$_SERVER['REQUEST_URI']  return /home/default
        // انا هقوله هل url  
        // الي انا هكتبه هيساوي العنوان الي جايلي من الفنكشن دي ولالا الي
        // هي بتاخد عنوان الصفحه الي انا فيها
        return    parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) == $url;
    }
}