<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($c,$get_user);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    
    ?>
    <h3 class="text-success">All my Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
    <tr>
        <th>SI no</th>
        <th>Order number</th>
        <th>Amouont Due</th>
        <th>Total Products</th>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Complete/Incomplete</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
        $result_orders=mysqli_query($c,$get_order_details);
        while($row_orders=mysqli_fetch_assoc($result_orders))
        {
            $i=1;
            $oid = $row_orders['order_id'];
            $amt = $row_orders['amout_due'];
            $total_products = $row_orders['total_products'];
            $invoice = $row_orders['invoice_number'];
            $date = $row_orders['order_date'];
            $sts = $row_orders['order_status'];
            if($sts=='pending')
            {
                $sts = 'Incomplete';
            }
            else $sts="Complete";
            echo "
            <tr>
            <td>$i</td>
            <td>$oid</td>
            <td>$amt</td>
            <td>$total_products</td>
            <td>$invoice</td>
            <td>$date</td>
            <td>$sts</td>";
            if($sts=='Complete')
            {
                echo "<td>Paid</td>";
            }
            else{
                echo "<td><a href='confirm_payment.php?order_id=$oid' class='text-light'>Confirm</a></td></tr>";
            }
            $i++;
        }
        ?>
    </tbody>
    </table>
</body>
</html>