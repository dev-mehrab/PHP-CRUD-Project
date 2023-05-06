<?php

use Controller\CrudController;
include('<Controller/CrudController.php');
include('FrontendHandler/auth.php');
    if(!authorize()){
        header('location:login.php');
    }
   if(!isset($_GET['id'])){
    header('location:index.php');
   }
   $id =$_GET['id'];
   

    

    $query = "SELECT t.id, t.title, t.description, t.status, t.deadline, t.created_at, t.updated_at,
            u.id as userID, u.fast_name, u.last_name, u.email, u.phone, u.address, u.created_at as users_created_at, u.updated_at as users_updated_at 
            FROM tasks as t LEFT JOIN users as u 
            ON t.user_id=u.id  WHERE t.id= $id";

        $crud = new CrudController();
        $results = $crud ->show($query);
        
        // echo '<pre>';
        // print_r($results)
?>

<!doctype html>
<html lang="en">
  <head>
  <?php include('includes/header.php'); ?>
 </head>
  <body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <!--        sidebar start -->
                    <?php include('includes/sideber.php') ?>
                <!--        sidebar end -->
            </div>
            <div class="col-md-9">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Task Management</h3>
                        <a href="index.php"><button type="submit" class="btn btn-sm btn-success me-1"><i class="fa-solid fa-sm fa-backward"></i></button></a>
                    </div>
                    <div class="card-body">
                        <?php 
                            if(isset($_SESSION['msg'])){
                                ?>
                                <div class="alert alert-success">
                                    <p class="<?php echo $_SESSION['class']; ?>">
                                    <?php 
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                     ?></p>
                                </div>
                                
                                <?php

                            }
                        ?>
                        <table class="table table-bordered table-hover table-sm table-stripped">
                                
                            <thead>
                            
                                <tr>
                                    <th>Title</th>
                                    <td><?php echo $results->title; ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><?php echo $results->description; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo $results->status==1? 'Active':'Inactive'; ?></td>
                                </tr>
                                <tr>
                                    <th>Deadline</th>
                                    <td><?php echo date('d-M-Y', strtotime($results->deadline)) ; ?></td>
                                </tr>
                                <tr>
                                    <th>Created at</th>
                                    <td><?php echo date('d-M-Y  h:i:s a', strtotime($results->created_at)); ?></td>
                                </tr>
                                <tr>
                                    <th>Updated at</th>
                                    <td><?php echo date('d-M-Y  h:i:s a', strtotime($results->updated_at)); ?></td>
                                </tr>
                            </thead>
                         </table>
                        
                        <table class="table table-bordered table-hover table-sm table-stripped">
                                <h5>User Details</h5>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $results->fast_name . " ". $results->last_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $results->email; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $results->phone; ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $results->address; ?></td>
                                </tr>
                                <tr>
                                    <th>User Created at</th>
                                    <td><?php echo date('d-M-Y  h:i:s a', strtotime($results->users_created_at)); ?></td>
                                </tr>
                                <tr>
                                    <th>User Updated at</th>
                                    <td><?php echo date('d-M-Y  h:i:s a', strtotime($results->users_updated_at)); ?></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
  </body>
</html>