<?php 
include('Controller/CrudController.php');
use Controller\CrudController;
include('FrontendHandler/auth.php');


    if(!authorize()){
        header('location:login.php');
    }

$user_query = "SELECT id, fast_name, last_name FROM users";

$crud = new CrudController();
$users = $crud->index($user_query);

if(isset($_POST['create_task'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];
    $user_id = $_POST['user_id'];
    $_SESSION['class']= 'text-success';
    $_SESSION['msg']= 'Task create successfully';
    

    $query = "INSERT INTO tasks
        (title, description, status , deadline, user_id)
    VALUES
        ('$title', '$description', '$status' , '$deadline', '$user_id')";

        try{
            $crud->storage($query);
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
                                <input type="text" name="title" class="form-control form-control-sm"
                                    placeholder="Enter your title">
                            </label>
                            <label for="description" class="w-100 mt-2">
                                Description
                                <textarea name="description" class="form-control form-control-sm"
                                    placeholder="Enter your description"></textarea>
                            </label>
                            <label for="status" class="w-100 mt-2">
                                Select Status
                                <select name="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </label>
                            <label for="dadeline" class="w-100 mt-2">
                                Deadline
                                <input type="date" name="deadline" class="form-control form-control-sm"
                                    placeholder="Enter your deadline">
                            </label>
                            <label for="user_id" class="w-100 mt-2">
                                Select Users
                                <select name="user_id" class="form-select">
                                    <?php 
                                        foreach($users as $user){
                                            ?>
                                    <option value="<?php echo $user->id; ?>">
                                        <?php echo $user->fast_name . ' '. $user->last_name; ?></option>
                                    <?php
                                        }
                                    ?>

                                </select>
                            </label>
                            <button type="submit" name="create_task"
                                class="form-control btn btn-sm btn-success my-3">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</body>

</html>