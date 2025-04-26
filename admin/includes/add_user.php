<?php
if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password )
              VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}')";

    $create_user_query = mysqli_query($connection, $query);

    confirm_query($create_user_query);

    header("Location: users.php?source=view_all_users");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="">
            <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>

            <?php
            // $query = "SELECT * FROM users ";
            // $select_users = mysqli_query($connection, $query);
            // confirm_query($select_users);

            // while ($row = mysqli_fetch_assoc($select_users)) {
            //     $user_id = $row['user_id'];
            //     $user_role = $row['user_role'];
            //     echo "<option value='{$user_id}'>{$user_role}</option>";
            // } 
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>


    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_passsword">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>



    <div class="form-group">
        <input type="submit" value="Create User" name="create_user" class="btn btn-primary">
    </div>

</form>