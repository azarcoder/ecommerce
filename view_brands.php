<?php
include('./includes/connect.php');
?>
<h3 class="text-center textsuccess">All Brands</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <th>SI no</th>
        <th>Brand Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody class="bg-secondary text-light text-center">
        <?php
        $sql ="SELECT * FROM `brands`";
        $rt = mysqli_query($c,$sql);
        $i=0;
        while($rw=mysqli_fetch_assoc($rt))
        {
            $bid = $rw['brand_id'];
            $bt = $rw['brand_title'];
            $i++;
            ?>
            <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $bt; ?></td>
            <td><a href='admin.php?edit_brand=<?php echo $bid;?>' class='text-light'><i class='fa-solid fa-pen-to-square'></a></td>
            <td><a href='admin.php?delete_brand=<?php echo $bid;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>
