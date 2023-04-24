<?php
include("../includes/connect.php");
session_start();
// include("../functions/common_functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
     <!-- Bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid my-3">
    <h2 class="text-center">New User Registeration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- username -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your Username" autocomplete="off" required="required" name="user_username">
                </div>
                <!-- email -->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email">
                </div>
                <!-- image -->
                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" id="user_image" class="form-control" autocomplete="off" required="required" name="user_image">
                </div>
                <!-- password -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                </div>
                <!--confirm  password -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="conf_user_password" class="form-control" placeholder="Enter confirm password" autocomplete="off" required="required" name="user_cpassword">
                </div>
                <!-- address -->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address">
                </div>
                <!-- contact -->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact" autocomplete="off" required="required" name="user_contact">
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-info py-2 px-2 border-0" name="user_register">
                    <p class="mt-3 fw-bold">Already have an account? <a href="users_login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_register'])){

    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    } 


    $username = $_POST['user_username'];
    $email = $_POST['user_email'];
    $image = $_FILES['user_image']['name'];
    $userimg_tmp = $_FILES['user_image']['tmp_name'];
    $password = $_POST['user_password'];
    //hash password
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    $cpassword = $_POST['user_cpassword'];
    $contact = $_POST['user_contact'];
    $address = $_POST['user_address'];
    $user_ip = getIPAddress();

    //select Query
    $select_sql = "SELECT * FROM  `user_table` WHERE username='$username' or user_email='$email'";
    $rst = mysqli_query($c,$select_sql);
    $row_count  = mysqli_num_rows($rst);
    if($row_count>0)
    {
        echo "<script>alert('Username and Email already Exists!');</script>";
    }
    elseif($password!=$cpassword)
    {
        echo "<script>alert('Password do not match!');</script>";
    }
    else{
        // file upload
    move_uploaded_file($userimg_tmp,"user_images/$image");//double quotes is must for file uplaod
    
    //sql for insert
    $insert_sql = "INSERT INTO `user_table`(username,user_email,user_password,user_image,user_ip,
    user_address,user_mobile) VALUES('$username','$email','$hash_password','$image',
    '$user_ip','$address','$contact')";

    $sql_execute = mysqli_query($c,$insert_sql);

    if($sql_execute)
    {
        echo "<script>alert('Data inserted successfully');</script>";
    }
    else{
        die(mysqli_error($c));
    }
    }
    
//selecting cart items
$select_cart_items = "SELECT * FROM `cart_details`  WHERE ip_address='$user_ip'";
$result_cart = mysqli_query(($c),$select_cart_items);

$rw_ct = mysqli_num_rows($result_cart);
if($rw_ct>0)
{
    $_SESSION['username'] = $username;
    echo "<script>alert('You have items in your cart');</script>";
    echo "<script>window.open('../checkout.php','_self');</script>";
}
else
{
    echo "<script>window.open('../index.php','_self');</script>";
}
}
?>