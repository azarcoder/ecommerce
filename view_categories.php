<?php
include('./includes/connect.php');
?>
<h3 class="text-center textsuccess">All Categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <th>SI no</th>
        <th>Category Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody class="bg-secondary text-light text-center">
        <?php
        $sql ="SELECT * FROM `categories`";
        $rt = mysqli_query($c,$sql);
        $i=0;
        while($rw=mysqli_fetch_assoc($rt))
        {
            $cid = $rw['category_id'];
            $ct = $rw['category_title'];
            $i++;
            ?>
            <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $ct; ?></td>
            <td><a href='admin.php?edit_category=<?php echo $cid;?>' class='text-light'><i class='fa-solid fa-pen-to-square'></a></td>
            <td><a href='admin.php?delete_category=<?php echo $cid;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>