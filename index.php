<?php

use Controller\CrudController;
include('<Controller/CrudController.php');
include('FrontendHandler/auth.php');
    if(!authorize()){
        header('location:login.php');
    }
   


    $query = "SELECT t.id, t.title, t.description, t.status, t.deadline, t.created_at, t.updated_at,
            u.id as userID, u.fast_name, u.last_name
            FROM tasks as t LEFT JOIN users as u 
            ON t.user_id=u.id ";

        $crud = new CrudController();
        $results = $crud ->index($query);

        if(isset($_POST['delete_data'])){
            $id=$_POST['id'];

            $delete_query= " DELETE FROM tasks WHERE id=$id";
            $crud->destroy($delete_query);
            header('location:index.php');
            $_SESSION['class']= 'text-success';
            $_SESSION['msg']= 'Task Delete successfully';

        }

        if(isset($_GET['filter'])){
            $clumn = $_GET['clumn'] ?? 'title';
            $order_by = $_GET['order_by'] ?? 'asc';
            $search = $_GET['search'] ?? '';

            $query = "SELECT t.id, t.title, t.description, t.status, t.deadline, t.created_at, t.updated_at,
            u.id as userID, u.fast_name, u.last_name
            FROM tasks as t LEFT JOIN users as u 
            ON t.user_id=u.id WHERE $clumn LIKE '%$search%' ORDER BY $clumn $order_by ";
            try{
                $crud = new CrudController();
                $results = $crud ->index($query);
                // echo "searching success";
            }catch(PDOException $e){
                echo "searching faild". $e->getMessage();
            }
        }
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
                        <a href="task_create.php"><button type="submit" class="btn btn-sm btn-success me-1"><i class="fa-solid fa-sm fa-plus"></i></button></a>
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
                        <form action="" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="clumn" class="form-select form-select-sm" id="">
                                    <option <?php if(isset($clumn)){if($clumn=='title'){echo 'selected';}}?> value="title"name="title">Title</option>
                                    <option <?php if(isset($clumn)){if($clumn=='status'){echo 'selected';}}?> value="status"name="status">Status</option>
                                    <option <?php if(isset($clumn)){if($clumn=='deadline'){echo 'selected';}}?> value="deadline"name="deadline">Deadline</option>
                                    <option <?php if(isset($clumn)){if($clumn=='created_at'){echo 'selected';}}else{echo "selected";}?> name="created_at" value="created_at">Created at</option>
                                    <option <?php if(isset($clumn)){if($clumn=='updated_at'){echo 'selected';}}?> value="updated_at"name="updated_at">Updated at</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                            <select name="order_by" class="form-select form-select-sm" id="">
                                    <option <?php if(isset($order_by)){if($order_by=='asc'){echo 'selected';}}else{echo "selected";}?> value="asc">Ascending</option>
                                    <option <?php if(isset($order_by)){if($order_by=='desc'){echo 'selected';}}?> value="desc">Deascending</option>
                             </select>
                            </div>
                            <div class="col-md-4">
                                <input type="search" name="search" class="form-control form-control-sm" placeholder="search..">
                            </div>
                            <div class="col-md-2 text-end d-grid">
                                <button type="submit" name="filter" class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                        </form>
                        
                        <table class="table table-bordered table-hover table-sm table-stripped my-3">
                            <thead>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Assigned User</th>
                                    <th>Deadline</th>
                                    <th>Created at</th>
                                    <th>Update at</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $SL= 1; 
                                    foreach($results as $result){
                                        
                                    ?>
                                <tr class="text-center">
                                    <td><?php echo $SL ++; ?></td>
                                    <td><?php echo $result->title; ?></td>
                                    <td>
                                        <?php echo substr($result->description, offset:0, length:30) ; ?>....
                                        <a href="task_show.php ?id=<?php echo $result->id; ?>">Read more</a>
                                    </td>
                                    <td><?php echo $result->status==1? 'Active':'Inactive'; ?></td>
                                    <td><?php echo $result->fast_name . ' '. $result->last_name ; ?></td>
                                    <td><?php echo date('d M, Y ',strtotime($result->deadline)) ; ?></td>
                                    <td><?php echo date('d M, Y h:iA' , strtotime($result->created_at)); ?></td>
                                    <td><?php echo date('d M, Y h:iA' ,strtotime($result->updated_at)); ?></td>
                                    <td class=" justify-content-center">
                                    <a href="task_show.php ?id=<?php echo $result->id; ?>"><button type="submit" class="btn btn-sm btn-info me-1"><i class="fa-solid fa-sm fa-eye"></i></button></a>
                                    <a href="task_edit.php ?id=<?php echo $result->id; ?>"><button type="submit" class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-sm fa-edit"></i></button></a>
                                    <form action="" method="post">
                            
                                    <input type="hidden"  name="id" value="<?php echo $result->id;?>">
                                    <button type="submit" onclick =" return confirm('are you sure to delete data?')"  name="delete_data"  class="btn btn-sm btn-danger me-0"><i class="fa-solid fa-sm fa-trash"></i></button>
                                    </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
  </body>
</html>