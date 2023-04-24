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
    <title>Cart details</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .cart-img
        {
            width: 80px;
            height: 80px;
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
    <div class="container">
        <div class="row">
          <form action="" method="post">
            <table class="table table-bordered">
                    <!-- php code display dynamic data -->
                    <?php
                        global $c;
                        $get_ip_add = getIPAddress();
                        $total_price = 0;
                        $cart_sql = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                        $r = mysqli_query($c,$cart_sql);
                        $result_count = mysqli_num_rows($r);
                          if($result_count>0)
                          {
                        //     echo "
                        //     <thead>
                        //     <th>Product Title</th>
                        //     <th>Product Image</th>
                        //     <th>Quantity</th>
                        //     <th>Total price</th>
                        //     <th>Remove</th>
                        //     <th colspan='2'>Operations</th>
                        // </thead>
                        // <tbody>";
                        while($row = mysqli_fetch_array($r))
                        {
                          $product_id=$row['product_id'];
                          $select_products = "SELECT * FROM `products` where product_id='$product_id'";
                          $result=mysqli_query($c,$select_products);
                          while($row_product = mysqli_fetch_array($result))
                          {
                              $price = array($row_product['product_price']);
                              $price_table = $row_product['product_price'];
                              $product_title = $row_product['product_title'];
                              $product_img1 = $row_product['product_image1'];
                              $value = array_sum($price);
                              $total_price+=$value; 
                              ?>
                              <thead>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                            <th>Remove</th>
                            <th colspan='2'>Operations</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $product_title?></td>
                                    <td><img src="./product_images/<?php echo $product_img1?>" alt="" class="cart-img"></td>
                                    <td><input type="text" class="form-input w-50" name="qty"></td>
                                    <?php
                                      // global $c;
                                      $get_ip_add = getIPAddress();
                                      if(isset($_POST['update_cart']))
                                      {
                                        $quantity = $_POST['qty'];
                                        if($quantity>0)
                                        {
                                          $update_cart = "UPDATE `cart_details` SET quantity=$quantity WHERE ip_address='$get_ip_add'";
                                          $result_query=mysqli_query($c,$update_cart);
                                          $total_price=$total_price*$quantity;
                                        }
                                      }

                                    ?>
                                    <td><?php echo $price_table?>/-</td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
                                    <td>
                                        <!-- <button class="bg-info  px-3 border-0 ">Update</button> -->
                                        <input class="bg-info  px-3 border-0" type="submit" value="Update cart" name="update_cart">
                                        <!-- <button class="bg-danger  px-3 border-0 text-light">Remove</button> -->
                                        <input class="bg-danger text-light  px-3 border-0" type="submit" value="Remove" name="remove_cart">
                                    </td>
                                </tr>
                <?php  }}}
                else
                {
                  echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                }
                ?>
                </tbody>
            </table>            
            <!--sub total -->
            <div class="d-flex mb-5">
              <?php
              global $c;
              $get_ip_add = getIPAddress();
              $cart_sql = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
              $r = mysqli_query($c,$cart_sql);
              $result_count = mysqli_num_rows($r);
                if($result_count>0)
                {
                    echo "
                    <h4 class='px-3'>Subtotal : <strong class='text-info'>$total_price/-</strong></h4>
                    <input class='bg-danger text-light mx-3 px-3 border-0' type='submit' value='Continue Shopping' name='continue_shopping'>
                    <button class='bg-secondary  px-3 border-0 text-light'><a href='checkout.php' class='text-light text-decoration-none'>Checkout</a></button>
                    ";
                }
                else{
                  echo "<a href='index.php'><button class='bg-info  px-3 border-0 mx-3'>Continue Shopping</button></a>";
                }
              if(isset($_POST['continue_shopping']))
              {
                echo "<script>window.open('index.php','_self')</script>";
              }
              ?>
              
            </div>
        </div>
    </div>
    </form>
    <!-- function to remove item -->
    <?php
    function remove_cart_item()
    {
      global $c;
      if(isset($_POST['remove_cart']))
      {
        foreach($_POST['removeitem'] as $remove_id)
        {
          echo $remove_id;
          $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
          $run_delete = mysqli_query($c,$delete_query);
          if($run_delete)
          {
            echo "<script>window.open('cart.php','_self')</script>";
          } 
        }
      }
    }
    echo $remove_item = remove_cart_item();
    ?>
    <!-- footer -->
    <?php include('footer.php');?>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>