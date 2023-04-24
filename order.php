<?php
$c = mysqli_connect('localhost','root','','ecommerce',3307);
include('./functions/common_functions.php');
if(isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];

    //getting total items and total price of all items
    $get_ip = getIPAddress();
    $total_price = 0;
    $cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip'";
    $result_cart = mysqli_query($c,$cart_query_price);
    $invoice_number = mt_rand();//mersen twister alogorithm for rand number generation
    $status = 'pending';

    $count_product = mysqli_num_rows($result_cart);
    while($row= mysqli_fetch_array($result_cart))
    {
        $product_id = $row['product_id'];
        $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
        $run_price = mysqli_query($c,$select_product);
        while($row_product_price=mysqli_fetch_array($run_price))
        {
            $product_price  = array($row_product_price['product_price']);
            $product_value  = array_sum($product_price);
            $total_price+=$product_value;
        }
    }

    //getting quantity from cart
    $get_cart = "SELECT * FROM `cart_details`";
    $result_of_cart = mysqli_query($c,$get_cart);
    $get_qty = mysqli_fetch_array($result_cart);
    $qty = $get_qty['quantity'];
    if($qty==0)
    {
        $qty=1;
        $subtotal=$total_price;
    }
    else
    {
        $qty=$qty;
        $subtotal=$total_price*$qty;
    }
    $insert_sql = "INSERT INTO `user_orders` (user_id,amout_due,invoice_number,total_products,order_date,order_status)
                    VALUES($user_id,$subtotal,$invoice_number,$count_product,NOW(),'$status')";
    $r = mysqli_query($c,$insert_sql);
    if($r)
    {
        echo "<script>alert('Orders Submited Successfully!')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }

    //orders pending
    $insert_pending = "INSERT INTO `orders_pending` (user_id,invoice_number,product_id,quantity,order_status)
                    VALUES($user_id,$invoice_number,$product_id,$qty,'$status')";
    $rslt_pending = mysqli_query($c,$insert_pending);

    //delete items from cart
    $empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip'";
    $er = mysqli_query($c,$empty_cart);
}
?>
