<?php
if(isset($_GET['delete_brand']))
{
    $delete_id = $_GET['delete_brand'];
    
    //delete sq
    $d = "DELETE FROM `brands` WHERE brand_id=$delete_id";
    $r = mysqli_query($c,$d);
    if($r)
    {
        echo "<script>alert('Deleted Successfully!')</script>";
        echo "<script>window.open('admin.php','_self')</script>";
    }
}

?>