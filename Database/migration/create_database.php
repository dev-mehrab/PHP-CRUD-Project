<?php
    $server_name='localhost';
    $user_name='root';
    $password='';
     
    try{
        $conn= new PDO("mysql:host=$server_name", $user_name, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "CREATE DATABASE task_management";
        $conn->query($query);
        echo 'Database create successfully';
    }catch(PDOException $e){
        echo 'Database create faild'. $e->getMessage();
    }