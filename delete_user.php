<?php
if(isset($_GET['delete_user']))
{
    $delete_id = $_GET['delete_user'];
    
    //delete sq
    $d = "DELETE FROM `user_table` WHERE user_id=$delete_id";
    $r = mysqli_query($c,$d);
    if($r)
    {
        echo "<script>alert('Deleted Successfully!')</script>";
        echo "<script>window.open('admin.php','_self')</script>";
    }
}

?>