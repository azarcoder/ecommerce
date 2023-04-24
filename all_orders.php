<h1 class="text-center text-success">All Orders</h1>
<div class="container-md my-3">
<table class="table-bordered mt-5 w-100 p-3">
    <thead class="bg-info text-center">
        <tr>
            <th>Order Id</th>
            <th>User Id</th>
            <th>Amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody class="bg-secondary text-light">
        
        <?php
            $get_orders = "SELECT * FROM `user_orders`";
            $r = mysqli_query($c,$get_orders);
            while($row=mysqli_fetch_assoc($r))
            {
                $oid = $row['order_id'];
                $uid = $row['user_id'];
                $amt = $row['amout_due'];
                $invoice = $row['invoice_number'];
                $tp = $row['total_products'];
                $d = $row['order_date'];
                $s = $row['order_status'];
            ?>
            <tr class='text-center'>
            <td><?php echo $oid; ?></td>
            <td><?php echo $uid; ?></td>
            <td><?php echo $amt; ?></td>
            <td><?php echo $invoice; ?></td>
            <td><?php echo $tp; ?></td>
            <td><?php echo $d; ?></td>
            <td><?php echo $s; ?></td>
            <td><a href='admin.php?delete_order=<?php echo $oid;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        </table>
   