<!DOCTYPE html>
<html lang="en" 
 dir="<?php if($_SESSION['lang'] == 'en') {echo 'ltr' ;} else { echo 'rtl' ;} ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : ""; ?></title>