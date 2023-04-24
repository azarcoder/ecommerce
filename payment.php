<?php
$c = mysqli_connect('localhost','root','','ecommerce',3307);
@session_start();
include('./functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <!-- php code access user id -->
    <?php
        $user_ip = getIPAddress();
        $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
        $r = mysqli_query($c,$get_user);
        $run_sql = mysqli_fetch_array($r);
        $user_id=$run_sql['user_id'];

    ?>
    <div class="container-fluid p-0">
      <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/logo.png" alt="" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users_area/user_register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
          cart_item();
          ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price:<?php total_cart_price();?></a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
        <input type="submit" value="Search" class="btn btn-success" name="search_data_product">
      </form>
    </div>
  </div>
</nav>
<!-- cart calling function -->
<?php
  cart();
?>
<!-- 2nd child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
      <?php
      if(!isset($_SESSION['username']))
      {
        echo "<li><a href='#' class='nav-link'>Welcome guest</a></li>";
      }
      else
      {
        echo "<li><a href='#' class='nav-link'>Welcome ".$_SESSION['username']."</a></li>";
      }
      if(!isset($_SESSION['username']))
      {
        echo "<li><a href='users_area/users_login.php' class='nav-link'>Login</a></li>";
      }
      else
      {
        echo "<li><a href='users_area/logout.php' class='nav-link'>Logout</a></li>";
      }
      ?>
      
    </ul>
  </nav>
  <!-- thrid child -->
  <div class="bg-light">
      <h3 class="text-center">Azar's ecommerce</h3>
      <p class="text-center">Purchase what you need and you like at one place</p>
    </div>
    </div>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row my-5 d-flex justify-content-center align-items-center">
            <div class="col-md-6">
            <a href="https://www.paypal.com" target="_blank"><img src="./images/UPI.jpg" alt="" class="w-75"></a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id;?>"><h2 class="text-center">Pay offline</h2></a>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include('footer.php');?>
</body>
</html>