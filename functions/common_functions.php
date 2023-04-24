<?php
include('./includes/connect.php');
//getting products
function getproducts()
{
    global $c; //must be global because it's passed to index.php file 
    //condition check
    if(!isset($_GET['Category']))
    {
        if(!isset($_GET['brand']))
        {

          $sql = "SELECT * FROM `products` ORDER BY rand() LIMIT 0,4";//rand() randomly ordered
          $result = mysqli_query($c,$sql);
          while($row = mysqli_fetch_assoc($result))
          {
              $pid = $row['product_id'];
              $ptit = $row['product_title'];
              $pdes = $row['product_description'];
              $cid = $row['category_id'];
              $bid = $row['brand_id'];
              $pimg1 = $row['product_image1'];
              $pimg2 = $row['product_image2'];
              $pimg3 = $row['product_image3'];
              $price = $row['product_price'];
              echo "<div class='col-md-4 mb-2'>
              <div class='card'>
                      <img class='card-img-top' src='product_images/$pimg1' alt='$ptit'>
                      <div class='card-body'>
                              <h5 class='card-title'>$ptit</h5>
                              <p class='card-text'>$pdes</p>
                              <p class='card-text'>Price:$price/-</p>
                              <a href='index.php?add_to_cart=$pid' class='btn btn-info'>Add to cart</a>
                              <a href='product_details.php?product_id=$pid' class='btn btn-secondary'>View more</a>
                      </div>
                </div>
            </div>";
              
          }
}
}
}

//getting unique catgegories
function get_unique_categories()
{
    global $c; 
    if(isset($_GET['Category']))
    {
        $catid = $_GET['Category'];

          $sql = "SELECT * FROM `products` WHERE category_id=$catid";
          $result = mysqli_query($c,$sql);
          $total_rows = mysqli_num_rows($result);
          if($total_rows==0)
          {
            echo "<h2 class='text-center text-danger'>No stock available in this category</h2>";
          }
          while($row = mysqli_fetch_assoc($result))
          {
              $pid = $row['product_id'];
              $ptit = $row['product_title'];
              $pdes = $row['product_description'];
              $cid = $row['category_id'];
              $bid = $row['brand_id'];
              $pimg1 = $row['product_image1'];
              $pimg2 = $row['product_image2'];
              $pimg3 = $row['product_image3'];
              $price = $row['product_price'];
              echo "<div class='col-md-4 mb-2'>
              <div class='card'>
                      <img class='card-img-top' src='product_images/$pimg1' alt='$ptit'>
                      <div class='card-body'>
                              <h5 class='card-title'>$ptit</h5>
                              <p class='card-text'>$pdes</p>
                              <p class='card-text'>Price:$price/-</p>
                              <a href='index.php?add_to_cart=$pid' class='btn btn-info'>Add to cart</a>
                              <a href='#' class='btn btn-secondary'>View more</a>
                      </div>
                </div>
            </div>";
              
          }
}
}

//getting unique catgegories
function get_unique_brands()
{
    global $c; 
    if(isset($_GET['brand']))
    {
        $bid = $_GET['brand'];

          $sql = "SELECT * FROM `products` WHERE brand_id=$bid";
          $result = mysqli_query($c,$sql);
          $total_rows = mysqli_num_rows($result);
          if($total_rows==0)
          {
            echo "<h2 class='text-center text-danger'>No brands available</h2>";
          }
          while($row = mysqli_fetch_assoc($result))
          {
              $pid = $row['product_id'];
              $ptit = $row['product_title'];
              $pdes = $row['product_description'];
              $cid = $row['category_id'];
              $bid = $row['brand_id'];
              $pimg1 = $row['product_image1'];
              $pimg2 = $row['product_image2'];
              $pimg3 = $row['product_image3'];
              $price = $row['product_price'];
              echo "<div class='col-md-4 mb-2'>
              <div class='card'>
                      <img class='card-img-top' src='product_images/$pimg1' alt='$ptit'>
                      <div class='card-body'>
                              <h5 class='card-title'>$ptit</h5>
                              <p class='card-text'>$pdes</p>
                              <p class='card-text'>Price:$price/-</p>
                              <a href='index.php?add_to_cart=$pid' class='btn btn-info'>Add to cart</a>
                              <a href='#' class='btn btn-secondary'>View more</a>
                      </div>
                </div>
            </div>";
              
          }
}
}

//display brands in side nav
function displaybrand()
{
        global $c;
        $select_brands = "SELECT * FROM `brands`";
          $res_brands = mysqli_query($c,$select_brands); 
          // $row_data = mysqli_fetch_assoc($res_brands);
          // echo $row_data['brand_title']; it will print first index detail
          while($row_data = mysqli_fetch_assoc($res_brands))
          {
            $b_title = $row_data['brand_title'];
            $brand_id = $row_data['brand_id'];
            echo "<li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>$b_title</a>
          </li>";
          }
}
//display categories in side nav
function displaycategories()
{
        global $c;
        $select_cat = "SELECT * FROM `categories`";
          $res_cat = mysqli_query($c,$select_cat); 
          // $row_data = mysqli_fetch_assoc($res_brands);
          // echo $row_data['brand_title']; it will print first index detail
          while($row_data = mysqli_fetch_assoc($res_cat))
          {
            $c_title = $row_data['category_title'];
            $cat_id = $row_data['category_id'];
            echo "<li class='nav-item'>
            <a href='index.php?Category=$cat_id' class='nav-link text-light'>$c_title</a>
          </li>";
          }
}

//getting all products
function get_all_products()
{
  global $c; //must be global because it's passed to index.php file 
    //condition check
    if(!isset($_GET['Category']))
    {
        if(!isset($_GET['brand']))
        {

          $sql = "SELECT * FROM `products` ORDER BY rand()";//rand() randomly ordered
          $result = mysqli_query($c,$sql);
          while($row = mysqli_fetch_assoc($result))
          {
              $pid = $row['product_id'];
              $ptit = $row['product_title'];
              $pdes = $row['product_description'];
              $cid = $row['category_id'];
              $bid = $row['brand_id'];
              $pimg1 = $row['product_image1'];
              $pimg2 = $row['product_image2'];
              $pimg3 = $row['product_image3'];
              $price = $row['product_price'];
              echo "<div class='col-md-4 mb-2'>
              <div class='card'>
                      <img class='card-img-top' src='product_images/$pimg1' alt='$ptit'>
                      <div class='card-body'>
                              <h5 class='card-title'>$ptit</h5>
                              <p class='card-text'>$pdes</p>
                              <p class='card-text'>Price:$price/-</p>
                              <a href='index.php?add_to_cart=$pid' class='btn btn-info'>Add to cart</a>
                              <a href='#' class='btn btn-secondary'>View more</a>
                      </div>
                </div>
            </div>";
              
          }
}
}
}

//search products
function search_products()
{
  global $c; //must be global because it's passed to index.php file 
      if(isset($_GET['search_data_product'])){
          $search_data_value = $_GET['search_data'];
          $sql = "SELECT * FROM `products` WHERE product_keywords like '%$search_data_value%'";
          $result = mysqli_query($c,$sql);
          $total_rows = mysqli_num_rows($result);
          if($total_rows==0)
          {
            echo "<h2 class='text-center text-danger'>Searched product not available</h2>";
          }
          while($row = mysqli_fetch_assoc($result))
          {
              $pid = $row['product_id'];
              $ptit = $row['product_title'];
              $pdes = $row['product_description'];
              $cid = $row['category_id'];
              $bid = $row['brand_id'];
              $pimg1 = $row['product_image1'];
              $pimg2 = $row['product_image2'];
              $pimg3 = $row['product_image3'];
              $price = $row['product_price'];
              echo "<div class='col-md-4 mb-2'>
              <div class='card'>
                      <img class='card-img-top' src='product_images/$pimg1' alt='$ptit'>
                      <div class='card-body'>
                              <h5 class='card-title'>$ptit</h5>
                              <p class='card-text'>$pdes</p>
                              <p class='card-text'>Price:$price/-</p>
                              <a href='index.php?add_to_cart=$pid' class='btn btn-info'>Add to cart</a>
                              <a href='#' class='btn btn-secondary'>View more</a>
                      </div>
                </div>
            </div>";
              
          }
}
}

//view details
function view_details()
{
  global $c; //must be global because it's passed to index.php file 
  //condition check
  if(isset($_GET['product_id'])){
  if(!isset($_GET['Category']))
  {
      if(!isset($_GET['brand']))
      {
        $prod_id = $_GET['product_id'];
        $sql = "SELECT * FROM `products` WHERE product_id=$prod_id";//rand() randomly ordered
        $result = mysqli_query($c,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $pid = $row['product_id'];
            $ptit = $row['product_title'];
            $pdes = $row['product_description'];
            $cid = $row['category_id'];
            $bid = $row['brand_id'];
            $pimg1 = $row['product_image1'];
            $pimg2 = $row['product_image2'];
            $pimg3 = $row['product_image3'];
            $price = $row['product_price'];
            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
                    <img class='card-img-top' src='product_images/$pimg1' alt='$ptit'>
                    <div class='card-body'>
                            <h5 class='card-title'>$ptit</h5>
                            <p class='card-text'>$pdes</p>
                            <p class='card-text'>Price:$price/-</p>
                            <a href='index.php?add_to_cart=$pid' class='btn btn-info'>Add to cart</a>
                            <a href='index.php' class='btn btn-secondary'>Go Home</a>
                    </div>
              </div>
          </div>
          <div class='col-md-8'>
            <!-- related images -->
            <div class='row'>
                <div class='col-md-12'>
                    <h4 class='text-center mb-5 text-info'>Related Products</h4>
                    <div class='col-md-6'>
                        <img src='product_images/$pimg2'alt='$ptit' class='card-img-top'>
                    </div>
                    <div class='col-md-6'>
                        <img src='product_images/$pimg3' alt='$ptit' class='card-img-top'>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>

            </div>
            <div class='col-md-6'>
                
            </div>
        </div>";
            
        }
}
}
}
}
//get ip address
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
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip; 


//cart fucntion
function cart()
{
  global $c;
  if(isset($_GET['add_to_cart']))
  {
    $get_ip_add = getIPAddress();
    $get_product_id =$_GET['add_to_cart'];
    $ssql = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
    $res = mysqli_query($c,$ssql);
    $num_of_rows = mysqli_num_rows($res);
    if($num_of_rows>0)
    {
      echo"<script>alert('This item already present inside the cart');</script>";
      echo "<script>window.open('index.php','_self');</script>";
    }
    else
    {
      $insert_sql = "INSERT INTO `cart_details`(product_id,ip_address,quantity) VALUES($get_product_id,'$get_ip_add',0)";
      $r = mysqli_query($c,$insert_sql);
      echo"<script>alert('Item added to cart');</script>";
      echo "<script>window.open('index.php','_self');</script>";
    }
  }
}
//function to get cart items
function cart_item()
{
  global $c;
  if(isset($_GET['add_to_cart']))
  {
    $get_ip_add = getIPAddress();
    $ssql = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $res = mysqli_query($c,$ssql);
    $num_of_rows = mysqli_num_rows($res);
  }
  else
  {
    $get_ip_add = getIPAddress();
    $ssql = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $res = mysqli_query($c,$ssql);
    $num_of_rows = mysqli_num_rows($res); 
  }
  echo $num_of_rows;
}

//total price function
function total_cart_price()
{
  global $c;
  $get_ip_add = getIPAddress();
  $total_price = 0;
  $cart_sql = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
  $r = mysqli_query($c,$cart_sql);
  while($row = mysqli_fetch_array($r))
  {
    $product_id=$row['product_id'];
    $select_products = "SELECT * FROM `products` where product_id='$product_id'";
    $result=mysqli_query($c,$select_products);
    while($row_product = mysqli_fetch_array($result))
    {
        $price = array($row_product['product_price']);
        $value = array_sum($price);
        $total_price+=$value;
    }
  }
  echo $total_price;
}



//get user order details
function get_user_order_details()
{
  global $c;
  $username = $_SESSION['username'];
  $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
  $result_query  = mysqli_query($c,$get_details);
  while($row = mysqli_fetch_array($result_query))
  {
    $user_id = $row['user_id'];
    if(!isset($_GET['edit_account']))
    {
      if(!isset($_GET['my_orders']))
      {
        if(!isset($_GET['delete_account']))
        {
          $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id and order_status='pending'";
          $r = mysqli_query($c,$get_orders);
          $row_c = mysqli_num_rows($r);
          if($row_c>0)
          {
            echo "<h3 class='text-center text-success'>You have <span class='text-danger'> $row_c </span>pending orders</h3>";
            echo  "<p class='text-center'><a class='text-dark' href='profile.php?my_orders'>Orders Details</a></p>";
          }
          else
          {
            echo "<h3 class='text-center text-success'>You have <span class='text-danger'> 0 </span>pending orders</h3>";
            echo  "<p class='text-center'><a class='text-dark' href='index.php'>Explore products</a></p>";
          }
        }
    }
  }
}
}
?>