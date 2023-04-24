<!-- connect file -->
<?php 
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php $_SESSION['username'];?></title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .profile_img
        {
            width: 90%;
            margin: auto;
            display: block;
            /* height: 100%; */
            object-fit: contain;
        }
        .edit_image
        {
          width: 100px;
          height: 100px;
          object-fit: contain;
        }
    </style>
</head>
<body>
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
          <a class="nav-link" href="profile.php">My account</a>
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
    <!-- fourth child -->
    <div class="row">
      <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
        <li class="nav-item bg-info">
          <a class="nav-link text-light" aria-current="page" href="#"><h4>Your profile</h4></a>
        </li>
        <?php
        $username = $_SESSION['username'];
        $user_img = "SELECT * FROM `user_table` WHERE username='$username'";
        $result_img = mysqli_query($c,$user_img);
        $row = mysqli_fetch_array($result_img);
        $user_img = $row['user_image'];
        echo "<li class='nav-item '>
        <img src='./users_area/user_images/$user_img' alt='' class='my-3 profile_img'>
        </li>";
        ?>
        <li class="nav-item ">
          <a class="nav-link text-light" aria-current="page" href="profile.php?pending_orders">Pending orders</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" aria-current="page" href="profile.php?edit_account">Edit account</a>
    </li>
        <li class="nav-item ">
          <a class="nav-link text-light" aria-current="page" href="profile.php?my_orders">My orders</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" aria-current="page" href="profile.php?delete_account">Delete Account</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" aria-current="page" href="./users_area/logout.php">Logout</a>
        </li>
        </ul>
      </div>
      <div class="col-md-10 text-center">
        <?php get_user_order_details();
        
        if(isset($_GET['edit_account']))
        {
          include("./edit_account.php");
        }
        if(isset($_GET['my_orders']))
        {
          include("./user_orders.php");
        }
        if(isset($_GET['delete_account']))
        {
          include("./delete_account.php");
        }
        
        ?>
      </div>
    </div>
    <!-- footer -->
    <?php include('footer.php');?>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>