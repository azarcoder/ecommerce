<?php
if(isset($_GET['edit_category']))
{
    $edit_id  = $_GET['edit_category'];
    $getdata = "SELECT * FROM `categories` WHERE category_id=$edit_id";
    $r = mysqli_query($c,$getdata);
    $row = mysqli_fetch_assoc($r);
    $ctitle = $row['category_title']; 
}
?>
<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <label for="" class="form-label">Category Title</label>
            <input type="text" class="form-control w-50 m-auto" name="title" value="<?php echo $ctitle; ?>">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" class="btn btn-info mb-3 mx-auto d-flex text-light" value="Update Category" name="edit_cat" required="required">
    </div>
    </form>
</div>
<?php
if(isset($_POST['edit_cat']))
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
        $u ="UPDATE `categories` SET category_title='$t' WHERE category_id=$edit_id";
        $rcc = mysqli_query($c,$u);
        if($rcc)
        {
            echo "<script>alert('Updated Successfully!')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        }
    }
}
?>