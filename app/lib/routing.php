<?php
namespace PHPPROJECT\lib;
trait routing
{
    public function routing($path)
    {
       header("LOCATION: $path") ;
    }

}