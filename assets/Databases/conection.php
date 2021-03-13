<?php
    $user = "root";
    $pwd = "";
    $dbname = "DB_Jobs";

    try{
        $cn = new PDO('mysql:host=localhost; dbname='.$dbname, $user, $pwd,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "Set names utf8"));

    }catch (Exception $ex){
        echo "Ha ocurrido el error ".$ex->getMessage();
    }
