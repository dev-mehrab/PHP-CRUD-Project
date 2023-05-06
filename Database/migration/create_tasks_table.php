<?php
include("../../Helpers/DBConnection.php");
$conn_obj= new DBConnection();
$conn = $conn_obj->connect();

$query= "CREATE TABLE tasks(
    id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NULL,
    description TEXT NULL,
    status VARCHAR(30) NULL,
    user_id VARCHAR(30) NULL,
    deadline TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP


)";
try{
    $conn->query($query);
    echo 'DB Connection successfully';
}catch(PDOException $e ){
    echo 'DB Connection faild'. $e->getMessage();
};