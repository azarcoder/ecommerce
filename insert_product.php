<?php
include('./includes/connect.php');
if(isset($_POST['insert_product']))
{
    $p_title = $_POST['product_title'];
    $p_desc = $_POST['description'];
    $p_keyw = $_POST['product_keywords'];
    $p_cat = $_POST['product_category'];
    $p_brand = $_POST['product_brand'];
    $p_price = $_POST['product_price'];
    $status ="true"; 
    //access images
    $img1 = $_FILES['product_image1']['name'];
    $img2 = $_FILES['product_image2']['name'];
    $img3 = $_FILES['product_image3']['name'];
    //access tmp name
    $temp1 = $_FILES['product_image1']['tmp_name'];
    $temp2 = $_FILES['product_image2']['tmp_name'];
    $temp3 = $_FILES['product_image3']['tmp_name'];

    //checking empty condition
    if($p_title=='' or $p_desc=='' or $p_keyw=='' or $p_cat=='' or $p_brand=='' or $p_price=='' or $img1=='' or $img2=='' or $img3=='')
    {
        echo "<script>alert('Please fill all the field')</script>";
        exit();
    }
    else
    {
        move_uploaded_file($temp1,"./product_images/$img1");
        move_uploaded_file($temp2,"./product_images/$img2");
        move_uploaded_file($temp3,"./product_images/$img3");

        //NOW()-function return current timestamp
        //insert query
        $insert_sql = "INSERT INTO `products`(product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,
        product_price,date,status) VALUES('$p_title','$p_desc','$p_keyw','$p_cat','$p_brand','$img1','$img2','$img3','$p_price',NOW(),'$status')";
        $res = mysqli_query($c,$insert_sql);
        if($res){
            echo "<script>alert('Added successfully!')</script>";
        }    
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
        <!-- title -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_title" class="form-lebel">Product title</label>
        <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
    </div>
    <!-- description -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="description" class="form-lebel">Product description</label>
        <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
    </div>
    <!-- product keyword -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_keywords" class="form-lebel">Product_keywords</label>
        <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
    </div>
    <!-- categories -->
    <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_category" id="" class="form-select">
            <?php
                $sql = "SELECT * FROM categories";
                $r = mysqli_query($c,$sql);
                while($row=mysqli_fetch_assoc($r)){
                    $c_t = $row['category_title'];
                    $c_id = $row['category_id'];
                    echo "<option value='$c_id'>$c_t</option>";
                }
            ?>
        </select>
    </div>
    <!-- brand -->
    <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_brand" id="" class="form-select">
        <?php
                $sql = "SELECT * FROM brands";
                $r = mysqli_query($c,$sql);
                while($row=mysqli_fetch_assoc($r)){
                    $b_t = $row['brand_title'];
                    $b_id = $row['brand_id'];
                    echo "<option value='$b_id'>$b_t</option>";
                }
            ?>
        </select>
    </div>
    <!-- img 1 -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image1" class="form-lebel">Product Image 1</label>
        <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
    </div>
    <!-- img 2 -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image2" class="form-lebel">Product Image 2</label>
        <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
    </div>
    <!-- img 3 -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image3" class="form-lebel">Product Image 3</label>
        <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
    </div>
     <!-- product price -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_price" class="form-lebel">Product price</label>
        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
    </div>
    <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" name="insert_product" class="btn btn-info mb-3 mx-auto d-flex text-light" value="insert product">
    </div>
    
</form>
</div>
</body>
</html>