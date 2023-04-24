<?php
if(isset($_GET['edit_brand']))
{
    $edit_id  = $_GET['edit_brand'];
    $getdata = "SELECT * FROM `brands` WHERE brand_id=$edit_id";
    $r = mysqli_query($c,$getdata);
    $row = mysqli_fetch_assoc($r);
    $ctitle = $row['brand_title']; 
}
?>
<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <label for="" class="form-label">Brand Title</label>
            <input type="text" class="form-control w-50 m-auto" name="title" value="<?php echo $ctitle; ?>">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" class="btn btn-info mb-3 mx-auto d-flex text-light" value="Update Brand" name="edit_b" required="required">
    </div>
    </form>
</div>
<?php
if(isset($_POST['edit_b']))
{
    $t = $_POST['title'];
    if($t=='')
    {
        echo "<script>alert('Please fill the fields!')</script>";
        exit();
    }
    else
    {
        //update
        $u ="UPDATE `brands` SET brand_title='$t' WHERE brand_id=$edit_id";
        $rcc = mysqli_query($c,$u);
        if($rcc)
        {
            echo "<script>alert('Updated Successfully!')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        }
    }
}
?>