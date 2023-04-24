<h1 class="text-center text-success">All Payments</h1>
<div class="container-md my-3">
<table class="table-bordered mt-5 w-100 p-3">
    <thead class="bg-info text-center">
        <tr>
            <th>SI no </th>
            <th>Payment ID</th>
            <th>Order ID</th>
            <th>Invoice Number</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody class="bg-secondary text-light">
        
        <?php
            $get_orders = "SELECT * FROM `user_payments`";
            $r = mysqli_query($c,$get_orders);
            $i=1;
            while($row=mysqli_fetch_assoc($r))
            {
                $payid = $row['payment_id'];
                $oid = $row['order_id'];
                $invoice = $row['invoice_number'];
                $amt = $row['amount'];
                $pm = $row['payment_mode'];
                $d = $row['date'];
            ?>
            <tr class='text-center'>
            <td><?php echo $i++; ?></td>
            <td><?php echo $payid; ?></td>
            <td><?php echo $oid; ?></td>
            <td><?php echo $invoice; ?></td>
            <td><?php echo $amt; ?></td>
            <td><?php echo $pm; ?></td>
            <td><?php echo $d; ?></td>
            <td><a href='admin.php?delete_payment=<?php echo $payid;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        </table>
   