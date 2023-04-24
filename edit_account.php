<?php
if(isset($_GET['edit_account']))
{
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $rt= mysqli_query($c,$select_query);
    $row_fetch = mysqli_fetch_assoc($rt);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $email = $row_fetch['user_email'];
    $address = $row_fetch['user_address'];
    $contact = $row_fetch['user_mobile'];

    if(isset($_POST['user_update']))
    {
        $update_id = $user_id;
        $username = $_POST['user_username'];
        $email = $_POST['user_email'];
        $address = $_POST['user_address'];
        $contact = $_POST['user_contact'];
        $user_image = $_FILES['user_image']['name'];
        $img_tmp = $_FILES['user_image']['tmp_name'];

        //file upload
        $target_dir = "./users_area/user_images/";
        $target_file = $target_dir . basename($user_image);
        if (file_exists($target_file))
        echo "<script>alert('Photo already exists!')</script>";
        else
            move_uploaded_file($img_tmp,"./users_area/user_images/$user_image");
        
        //update sql
        $update_data = "UPDATE `user_table` set username='$username',user_email='$email',
        user_image='$user_image',user_address='$address',user_mobile='$contact' WHERE user_id=$update_id";
        $rst= mysqli_query($c,$update_data);
        if($rst)
        {
            echo "<script>alert('Updated Successfully')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-center text-success">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $username; ?>" class="form-control w-50 m-auto" name="user_username" placeholder="Username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" value="<?php echo $email; ?>" class="form-control w-50 m-auto" name="user_email" placeholder="Email">
        </div>
        <div class="form-outline mb-4 mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="user_image">
            <img src="./users_area/user_images/<?php echo $user_img;?>" alt="" class="edit_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $address; ?>" class="form-control w-50 m-auto" name="user_address" placeholder="Address">
        </div>
        <div class="form-outline mb-4">
            <input type="contact" value="<?php echo $contact; ?>" class="form-control w-50 m-auto" name="user_contact" placeholder="Contact">
        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>