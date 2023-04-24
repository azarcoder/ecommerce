<?php
include('./includes/connect.php');
?>
<h3 class="text-success text-center">All Products</h3>
<div class="container-md d-flex justify-content-center">
<table class="table-bordered mt-5 w-100 p-3">
    <thead class="bg-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Product Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
            $get_prod = "SELECT * FROM `products`";
            $r = mysqli_query($c,$get_prod);
            while($row=mysqli_fetch_assoc($r))
            {
                $pid = $row['product_id'];
                $ptit = $row['product_title'];
                $ppc = $row['product_price'];
                $pimg = $row['product_image1'];
                $psts = $row['status'];
            
        ?>
        <tr class='text-center'>
                <td><?php echo $pid; ?></td>
                <td><?php echo $ptit; ?></td>
                <td><?php echo"<img src='./product_images/$pimg' width='100px'>"?></td>
                <td><?php echo $ppc; ?></td>
                <td>
                    <?php
                         //get product sold count
                        $get_sold = "SELECT * FROM `orders_pending` WHERE product_id=$pid"; 
                        $rst = mysqli_query($c,$get_sold);
                        $row_count = mysqli_num_rows($rst);
                        echo $row_count;           
                    ?>
                </td>
                <td><?php echo $psts; ?></td>
                <td><a href='admin.php?edit_products=<?php echo $pid;?>' class='text-light'><i class='fa-solid fa-pen-to-square'></a></td>
                <td><a href='admin.php?delete_products=<?php echo $pid;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
        <?php
            }
            ?>
    </tbody>
</table>
</div>