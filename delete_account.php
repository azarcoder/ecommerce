<?php 
include('./includes/connect.php');
@session_start(); //@ is a error control or shutup operator
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger">Delete Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>
</body>
</html>
<?php
    $username = $_SESSION['username'];
    if(isset($_POST['delete']))
    {
        $delete_sql = "DELETE from `user_table` WHERE username='$username'";
        $result=mysqli_query($c,$delete_sql);
        if($result)
        {
            session_destroy();
            echo "<script>alert('Account Deleted Succesfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
    if(isset($_POST['dont_delete']))
    {
        echo "<script>window.open('profile.php','_self')</script>";
    }
    ?>