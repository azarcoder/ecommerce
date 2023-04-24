<?php
include('./includes/connect.php');
session_start();
if(isset($_GET['order_id']))
{
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_orders` WHERE order_id=$order_id";
    $rt = mysqli_query($c,$select_data);
    $row = mysqli_fetch_assoc($rt);
    $invoice = $row['invoice_number'];
    $amt = $row['amout_due'];
}
if(isset($_POST['confirm_payment']))
{
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment'];
    $insert_query = "INSERT INTO `user_payments` (order_id,invoice_number,amount,payment_mode) 
    VALUES($order_id,$invoice_number,$amount,'$payment_mode')";
    $result = mysqli_query($c,$insert_query);
    if($result)
    {
        echo "<h3 class='text-center text-light'>Successfully completed the Payment</h3>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
    //update orders
    $update_orders = "UPDATE `user_orders` set order_status='Complete' WHERE order_id=$order_id";
    $result_update = mysqli_query($c,$update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice;?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amt;?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment" id="" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option value="upi">UPI</option>
                    <option value="Netbanking" >Netbanking</option>
                    <option value="paypal" >Paypal</option>
                    <option value="cod">COD</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
               <input type="submit" class="bg-info py-2 px-3 border-0"  value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>