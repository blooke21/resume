<?php

    $dsn="mysql:host=localhost;dbname=poohhkst_busybeesnacks";
    $username="poohhkst_admin";
    $password="beeadmin!";

    try{
        $db=new PDO($dsn, $username, $password);
    }catch(Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }