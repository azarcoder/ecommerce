<?php
include('./includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrtap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
    <div class="container-fluid p-0">
         <!-- first child -->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid">
        <img src="images/logo.png" alt="logo" class="logo">
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-items">
                    <a href="#" class="nav-link text-light">Welcome Guest</a>
                </li>
            </ul>
        </nav>
    </div>
</nav>
<!-- second child -->
<div class="bg-light">
    <h3 class="text-center p-2">Manage Details</h3>
</div>
<!-- thrid child -->
<div class="row">
    <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
        <div>
            <a href="#"><img src="images/apple.jpg" alt="" class="admin_img"></a>
            <p class="text-light text-center">Admin name</p>
        </div>
        <div class="button text-center p-3">
            <a class="btn btn-warning m-2" href="admin.php?insert_product" role="button">Insert Products</a>
            <a class="btn btn-warning mb-2" href="admin.php?view_products" role="button">View Products</a>
            <a class="btn btn-warning" href="admin.php?insert_category" role="button">Insert Categories</a>
            <a class="btn btn-warning m-2" href="admin.php?view_categories" role="button">View Categories</a>
            <a class="btn btn-warning mb-2" href="admin.php?insert_brand" role="button">Insert Brands</a>
            <a class="btn btn-warning" href="admin.php?view_brands" role="button">View Brands</a>
            <a class="btn btn-primary m-2" href="admin.php?all_orders" role="button">All Orders</a>
            <a class="btn btn-success mb-2" href="admin.php?all_payments" role="button">All Payments</a>
            <a class="btn btn-warning" href="admin.php?list_users" role="button">List users</a>
            <a class="btn btn-danger" href="#" role="button">logout</a>
        </div>
    </div>
</div>
    </div>
    <div class="container my-5">
        <?php
        if(isset($_GET['insert_category']))
        {
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brand']))
        {
            include('insert_brands.php');
        }
        if(isset($_GET['insert_product']))
        {
            include('insert_product.php');
        }
        //view_products
        if(isset($_GET['view_products']))
        {
            include('view_products.php');
        }
        //edit_products
        if(isset($_GET['edit_products']))
        {
            include('edit_products.php');
        }
        //delete_products
        if(isset($_GET['delete_products']))
        {
            include('delete_products.php');
        }
        //view_categories
        if(isset($_GET['view_categories']))
        {
            include('view_categories.php');
        }
        //view_brands
        if(isset($_GET['view_brands']))
        {
            include('view_brands.php');
        }
        //edit_category
        if(isset($_GET['edit_category']))
        {
            include('edit_category.php');
        }
        //delete_category
        if(isset($_GET['delete_category']))
        {
            include('delete_category.php');
        }
        //edit_brand
        if(isset($_GET['edit_brand']))
        {
            include('edit_brand.php');
        }
        //delete_brand
        if(isset($_GET['delete_brand']))
        {
            include('delete_brand.php');
        }
        //all_orders
        if(isset($_GET['all_orders']))
        {
            include('all_orders.php');
        }
        //delete_order
        if(isset($_GET['delete_order']))
        {
            include('delete_order.php');
        }
        //all_payments
        if(isset($_GET['all_payments']))
        {
            include('all_payments.php');
        }
        //delete_payment
        if(isset($_GET['delete_payment']))
        {
            include('delete_payment.php');
        }
        //list_users
        if(isset($_GET['list_users']))
        {
            include('list_users.php');
        }
        //delete_user
        if(isset($_GET['delete_user']))
        {
            include('delete_user.php');
        }
        ?>
    </div>
    <!-- footer -->
    <?php include('footer.php');?>
   <!-- Bootstrap js -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
        
</body>
</html>