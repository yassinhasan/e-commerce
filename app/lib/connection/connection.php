<?php

try {
    $dbname = "storedb";
    $dsn = "mysql://host=localhost;dbname=$dbname";
    $username = "root";
    $passwd   = "hasan123";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
    );

    $conn = new PDO($dsn,$username,$passwd,$options);

}
catch(PDOException $e){
    echo "<p class='alert alert-danger'> failed to connect to $dbname ".$e->getMessage() ."</p>";
}
