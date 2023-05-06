<?php
include('FrontendHandler/auth.php');
    
    if(authorize()){
        header('location:index.php');
    }
    
        
?>

<!doctype html>
<html lang="en">
  <head>
    <?php include('includes/header.php'); ?>
  </head>
  <body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">User Registration</h2>
                    </div>
                    <div class="card-body">
                        <form action="FrontendHandler/registration.php" method="post">
                            <label for="fast_name" class="w-100 mt-2">
                                Fast Name
                                <input type="text" name="fast_name" class="form-control form-control-sm" placeholder="Enter your fast name">
                            </label>
                            <label for="last_name" class="w-100 mt-2">
                                Last Name
                                <input type="text" name="last_name" class="form-control form-control-sm" placeholder="Enter your last name">
                            </label>
                            <label for="email" class="w-100 mt-2">
                                Email
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter your email">
                            </label>
                            <label for="phone" class="w-100 mt-2">
                                Phone Number
                                <input type="number" name="phone" class="form-control form-control-sm" placeholder="Enter your phone number">
                            </label>
                            <label for="address" class="w-100 mt-2">
                                Address
                                <textarea type="text" name="address" class="form-control form-control-sm" placeholder="Enter your fast name"> </textarea>
                            </label>
                            <label for="password" class="w-100 mt-2">
                                Password
                                <div class="input-group mb-2">
                                <input id="password" type="password" name="password" class="form-control form-control-sm" placeholder="Enter your passwordr">
                                <div style="cursor:pointer;" id="show_hide_password" class="input-group-text"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                                <!-- <i class="fa-solid fa-eye-slash"></i> -->
                            </label>
                            <button name="registration" class="btn btn-sm btn-info">Registration</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script>
        $("#show_hide_password").on('click', function(){
            let element = $('#password')
            if(element.attr('type')=='password' ){
                element.attr('type', 'text')
                $(this).children('i').addClass('fa-eye-slash').removeClass('fa-eye')
                
            }else{
                element.attr('type', 'password')
                $(this).children('i').removeClass('fa-eye-slash').addClass('fa-eye')

            }
        })
    </script>
  </body>
</html>