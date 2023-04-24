<?php
if(isset($_GET['delete_order']))
{
    $delete_id = $_GET['delete_order'];
    
    //delete sq
    $d = "DELETE FROM `user_orders` WHERE order_id=$delete_id";
    $r = mysqli_query($c,$d);
    if($r)
    {
        echo "<script>alert('Deleted Successfully!')</script>";
        echo "<script>window.open('admin.php','_self')</script>";
    }
}

?>