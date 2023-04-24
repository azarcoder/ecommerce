<?php
$c = mysqli_connect('localhost','root','','ecommerce',3307);
@session_start();
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
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
    <h2 class="text-center">Login</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="lg-12 col-xl-6">
            <form action="" method="post">
                <!-- username -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your Username" autocomplete="off" required="required" name="user_username">
                </div>

                <!-- password -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                </div>

                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="bg-info py-2 px-2 border-0" name="user_login">
                    <p class="mt-3 fw-bold">Don't have an account? <a href="user_register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>
<?php
    if(isset($_POST['user_login']))
    {

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


        $user = $_POST['user_username'];
        $upsw = $_POST['user_password'];
        $sql = "SELECT * FROM `user_table` WHERE username='$user'";
        $res = mysqli_query($c,$sql);
        $row_count = mysqli_num_rows($res);
        $row_data = mysqli_fetch_assoc($res);
        $user_ip = getIPAddress();

        //cart item
        $cart_item = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $select_cart = mysqli_query($c,$cart_item);

        $row_count_cart = mysqli_num_rows($select_cart);

        //login username password checking
        if($row_count>0)
        {
            // password hashing checking
            if(password_verify($upsw,$row_data['user_password']))
            {

                $_SESSION['username']=$user;
                if($row_count==1 and $row_count_cart==0)
                {
                    $_SESSION['username']=$user;
                    echo "<script>alert('Login successfully!')</script>";
                    echo "<script>window.open('../profile.php','_self');</script>";
                }
                else
                {
                    $_SESSION['username']=$user;
                    echo "<script>alert('Login successfully!')</script>";
                    echo "<script>window.open('../payment.php','_self');</script>";
                }
            }
            else
            {
                echo "<script>alert('Invalid password!')</script>";
            }
        }
        else
        {
            echo "<script>alert('Invalid Username!')</script>";
        }
    }
?>