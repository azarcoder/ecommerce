<?php
include('./includes/connect.php');
if(isset($_GET['edit_products']))
{
    $eid = $_GET['edit_products'];
    //get data
    $get_data = "SELECT * FROM `products` WHERE product_id=$eid";
    $rsql = mysqli_query($c,$get_data);
    $row=mysqli_fetch_assoc($rsql);
    $p_title = $row['product_title'];
    $p_desc = $row['product_description'];
    $p_keyw = $row['product_keywords'];
    $p_cat = $row['category_id'];
    $p_brand = $row['brand_id'];
    $p_price = $row['product_price'];
    $img1 = $row['product_image1'];
    $img2 = $row['product_image2'];
    $img3 = $row['product_image3'];

    //fetching category name
    $cn = "SELECT * FROM `categories` WHERE category_id=$p_cat";
    $rc = mysqli_query($c,$cn);
    $row_c=mysqli_fetch_assoc($rc);
    $cat_tit = $row_c['category_title'];

    //fetching brand name
    $cb = "SELECT * FROM `brands` WHERE brand_id=$p_brand";
    $rb = mysqli_query($c,$cb);
    $row_b=mysqli_fetch_assoc($rb);
    $br_tit = $row_b['brand_title'];
}
?>
<div class="container mt-5">
<h1 class="text-center">Edit Products</h1>
<form action="" method="post" enctype="multipart/form-data">
    
<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_title" class="form-label">Product Title</label>
        <input type="text" class="form-control" name="product_title" required="required" value="<?php echo $p_title; ?>">
    </div>

<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_description" class="form-label">Product Description</label>
        <input type="text" class="form-control" name="product_description" required="required" value="<?php echo $p_desc; ?>">
    </div>
<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_keywords" class="form-label">Product Keywords</label>
        <input type="text" class="form-control" name="product_keywords" required="required" value="<?php echo $p_keyw; ?>">
    </div>
<div class="form-outline mb-4 w-50 m-auto">
<label for="product_keywords" class="form-label">Product Category</label>
    <select name="product_category" id="" class="form-select">
        <option value="<?php echo $p_cat; ?>"><?php echo $cat_tit; ?></option>
            <?php
                $sql = "SELECT * FROM categories";
                $r = mysqli_query($c,$sql);
                while($row=mysqli_fetch_assoc($r)){
                    $c_t = $row['category_title'];
                    $c_id = $row['category_id'];
                    if($c_t!=$cat_tit)
                        echo "<option value='$c_id'>$c_t</option>";
                }
            ?>
    </select>
    </div>
<div class="form-outline mb-4 w-50 m-auto">
<label for="product_keywords" class="form-label">Product Brand</label>
    <select name="product_brand" id="" class="form-select">
    <option value="<?php echo $p_brand; ?>"><?php echo $br_tit; ?></option>
             <?php
                $sql = "SELECT * FROM brands";
                $r = mysqli_query($c,$sql);
                while($row=mysqli_fetch_assoc($r)){
                    $b_t = $row['brand_title'];
                    $b_id = $row['brand_id'];
                    if($b_t!=$br_tit)
                    echo "<option value='$b_id'>$b_t</option>";
                }
            ?>
    </select>
    </div>
<!-- img 1 -->
<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image1" class="form-lebel">Product Image 1</label>
        <div class="d-flex">
        <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
        <img src="./product_images/<?php echo $img1; ?>" alt="" width="100px">
        </div> 
</div>
<!-- img 2 -->
<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image2" class="form-lebel">Product Image 2</label>
        <div class="d-flex">
        <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
        <img src="./product_images/<?php echo $img2; ?>" alt="" width="100px">
        </div> 
</div>
<!-- img 3 -->
<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image3" class="form-lebel">Product Image 3</label>
        <div class="d-flex">
        <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
        <img src="./product_images/<?php echo $img3; ?>" alt="" width="100px">
        </div> 
</div>
<!-- product price -->
<div class="form-outline mb-4 w-50 m-auto">
        <label for="product_price" class="form-lebel">Product price</label>
        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required" value="<?php echo $p_price;?>">
    </div>
    <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" class="btn btn-info mb-3 mx-auto d-flex text-light" value="Update product" name="edit_product">
    </div>
</form>
</div>

<!-- editing products -->
<?php

if(isset($_POST['edit_product']))
{
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $prod_img1 = $_FILES['product_image1']['name'];
    $prod_img2 = $_FILES['product_image2']['name'];
    $prod_img3 = $_FILES['product_image3']['name'];
    $temp1 = $_FILES['product_image1']['tmp_name'];
    $temp2 = $_FILES['product_image2']['tmp_name'];
    $temp3 = $_FILES['product_image3']['tmp_name'];
    $product_price = $_POST['product_price'];

    //checking fields are empty
    if($product_title=='' or $product_description=='' or $product_keywords=='' or $product_category=='' 
    or $product_brand=='' or $prod_img1=='' or $prod_img2=='' or $prod_img3=='' or $product_price=='')
    {
        echo "<script>alert('Please fill all the fields!')</script>";
        exit();
    }  
    else
    {
        move_uploaded_file($temp1,"./product_images/$prod_img1");
        move_uploaded_file($temp2,"./product_images/$prod_img2");
        move_uploaded_file($temp3,"./product_images/$prod_img3");

        //update sql
        $update_sql = "UPDATE `products` SET product_title='$product_title',product_description='$product_description',
        product_keywords='$product_keywords',category_id='$product_category',brand_id='$product_brand',
        product_image1='$prod_img1',product_image2='$prod_img2',product_image3='$prod_img3',
        product_price='$product_price',date=NOW() WHERE product_id=$eid";

        $ur = mysqli_query($c,$update_sql);
        if($ur)
        {
            echo "<script>alert('Updated Successfully!')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        }

    }

}

?>
