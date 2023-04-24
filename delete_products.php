<?php
include('./includes/connect.php');
if(isset($_GET['delete_products']))
{
    $delete_id = $_GET['delete_products'];
    
    //delete sq
    $d = "DELETE FROM `products` WHERE product_id=$delete_id";
    $r = mysqli_query($c,$d);
    if($r)
    {
        echo "<script>alert('Deleted Successfully!')</script>";
        echo "<script>window.open('admin.php','_self')</script>";
    }
}

?>