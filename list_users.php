<h3 class="text-success text-center">All Users</h3>
<div class="container-md">
<table class="table-bordered mt-5 w-100 p-3">
    <thead class="bg-info">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Profile Image</th>
            <th>Email</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
            $get_users = "SELECT * FROM `user_table`";
            $r = mysqli_query($c,$get_users);
            while($row=mysqli_fetch_assoc($r))
            {
                $uid = $row['user_id'];
                $name = $row['username'];
                $email = $row['user_email'];
                $uimg = $row['user_image'];
                $address = $row['user_address'];
                $ph = $row['user_mobile'];
        ?>
        <tr class='text-center'>
                <td><?php echo $uid; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo"<img src='./users_area/user_images/$uimg' width='100px'>"?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $ph; ?></td>
                <td><a href='admin.php?delete_user=<?php echo $uid;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
        <?php
            }
            ?>
    </tbody>
</table>
</div>