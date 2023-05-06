
<?php 
    session_start();
    function authorize(){
        if(isset($_SESSION['email'])){
            return true;
        }else{
            return false;
        }
    }
?>