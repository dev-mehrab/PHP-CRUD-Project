<?php 
    
    include('../Controller/CrudController.php');
    use Controller\CrudController;

    $fast_name = $_POST['fast_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = md5($_POST['password']) ;

    $query="INSERT INTO users(fast_name, last_name, email, phone, address, password)
    VALUES('$fast_name','$last_name','$email','$phone','$address','$password')";
    
     $crud= new CrudController();
    if($crud->storage($query)){
        header('location:../login.php?message=Registration complete');
    };
    // echo $email;
    
    

?>
