<?php
include('./includes/connect.php');//it's include that file and we can use their properties here

if(isset($_POST['insert_brand']))
{
  $t = $_POST['brand_title'];
  //select data from database
  $select_sql = "SELECT * FROM `brands` WHERE brand_title='$t'";
  $res_select = mysqli_query($c,$select_sql);
  $number = mysqli_num_rows($res_select);
  if($number>0)
  {
    echo "<script>alert('This is present inside database')</script>";
  }
  else
  {
    //insert
    $insert_sql = "INSERT INTO `brands` (brand_title) VALUES('$t')";
    $r = mysqli_query($c,$insert_sql);
    if($r)
    {
      echo "<script>alert('Brands has been inserted successfully!')</script>";
    }
  }
}
?>
<h2 class="text-center">Insert Brands</h2>
<form action="" method="post"r class="mb-2">
<div class="input-group mb-2 w-90">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="brand_title" placeholder="Insert a Brand" aria-label="brands" aria-describedby="basic-addon1">
</div>
<div class="input-group mb-2 w-10">
<input type="submit" class="bg-success text-light border-0 w-25 p-1" name="insert_brand" value="insert">
    <!-- <button class="bg-info p-2 my-3 border-0">Insert brand</button> -->
</div>
</form>