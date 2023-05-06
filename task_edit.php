<?php 
include('Controller/CrudController.php');
use Controller\CrudController;
include('FrontendHandler/auth.php');


    if(!authorize()){
        header('location:login.php');
    }
    if(!isset($_GET['id'])){
        header('location:index.php');
       }
       $id =$_GET['id'];

$user_query = "SELECT id, fast_name, last_name FROM users";
$task_query = "SELECT  * FROM tasks WHERE id= $id ";


$crud = new CrudController();
$users = $crud->index($user_query);
$result = $crud->show($task_query);

if(isset($_POST['update_task'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];
    $user_id = $_POST['user_id'];
    $_SESSION['class']= 'text-success';
    $_SESSION['msg']= 'Task update successfully';
    

    $query = "UPDATE  tasks SET title='$title', description='$description', status='$status' , deadline='$deadline', user_id='$user_id' WHERE id=$id ";    
        

        try{
            $crud->update($query);
            header('location:index.php');
            // echo 'data inser success';
        }catch(PDOException $e){
            echo "data inser faild". $e->getMessage(); 
        }
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
            <div class="col-md-3">
                <!--        sidebar start -->
                <?php include('includes/sideber.php') ?>
                <!--        sidebar end -->
            </div>
            <div class="col-md-9">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Task Create</h3>
                        <a href="index.php"><button type="submit" class="btn btn-sm btn-success me-1"><i class="fa-solid fa-sm fa-backward"></i></button></a>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="fast_name" class="w-100 mt-2">
                                Title
                                <input value="<?php echo $result->title; ?>" type="text" name="title" class="form-control form-control-sm"
                                    placeholder="Enter your title">
                            </label>
                            <label for="description" class="w-100 mt-2">
                                Description
                                <textarea   name="description" class="form-control form-control-sm"
                                    placeholder="Enter your description"> <?php echo $result->description; ?></textarea>
                            </label>
                            <label for="status" class="w-100 mt-2">
                                Select Status
                                <select name="status" class="form-select">
                                    <option <?php echo $result->status==1 ? 'selected': null ; ?> value="1">Active</option>
                                    <option <?php echo $result->status==0 ? 'selected': null ; ?> value="0">Inactive</option>
                                </select>
                            </label>
                            <label for="dadeline" class="w-100 mt-2">
                                Deadline
                                <input value="<?php echo date('Y-m-d',strtotime($result->deadline)); ?>" type="date" name="deadline" class="form-control form-control-sm"
                                    placeholder="Enter your deadline">
                            </label>
                            <label for="user_id" class="w-100 mt-2">
                                Select Users
                                <select name="user_id" class="form-select">
                                    <?php 
                                        foreach($users as $user){
                                            ?>
                                    <option <?php echo $user->id==$result->user_id? 'selected': null ; ?> value="<?php echo $user->id; ?>">
                                        <?php echo $user->fast_name . ' '. $user->last_name; ?></option>
                                    <?php
                                        }
                                    ?>

                                </select>
                            </label>
                            <button type="submit" name="update_task"
                                class="form-control btn btn-sm btn-success my-3">Update Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</body>

</html>