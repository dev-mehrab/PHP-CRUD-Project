<?php

// use function PHPSTORM_META\elementType;

session_start();
if(isset($_POST['logout'])){
    unset($_SESSION['email']);
    header('location: ../login.php');
}