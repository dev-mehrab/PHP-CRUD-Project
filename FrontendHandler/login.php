<?php 
    session_start();
    include('../Controller/CrudController.php');
    use Controller\CrudController;
    $email= $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT id, email, password FROM users WHERE email='$email' ";

    $crud = new CrudController();
    $data= $crud->show($query);
    
    //  print_r($data->password);
    if($data){
        if($data->password==$password){
            $_SESSION['email']= $email;
            header('location:../index.php');
        }else{
            echo 'email or password donse not match';
        }
    }else{
        echo 'Email dosenot exit';
    }