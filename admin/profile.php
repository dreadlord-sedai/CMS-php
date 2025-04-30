<?php
include "includes/admin_header.php";
?>
<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        //$user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

?>

<?php

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE users SET ";
    $query .= "user_firstname= '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}'";
    $query .= "WHERE username = '{$username}' ";

    $edit_user_query = mysqli_query($connection, $query);

    confirm_query($edit_user_query);

    header("Location: users.php?source=view_all_users");
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php
    include "includes/admin_navigation.php";
    ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_firstname">Firstname</label>
                            <input type="text" class="form-control" name="user_firstname"
                                value="<?php if (isset($user_firstname)) {
                                            echo $user_firstname;
                                        } ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input type="text" class="form-control" name="user_lastname"
                                value="<?php if (isset($user_lastname)) {
                                            echo $user_lastname;
                                        } ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_role">Role</label>
                            <select name="user_role" id="">

                                <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

                                <?php
                                if ($user_role == 'admin') {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username"
                                value="<?php if (isset($username)) {
                                            echo $username;
                                        } ?>">
                        </div>


                        <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="text" class="form-control" name="user_email"
                                value="<?php if (isset($user_email)) {
                                            echo $user_email;
                                        } ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_passsword">Password</label>
                            <input type="password" class="form-control" name="user_password"
                                value="<?php
                                        echo $user_password;
                                        ?>">
                        </div>


                        <div class="form-group">
                            <input type="submit" value="Update Profile" name="edit_user" class="btn btn-primary">
                        </div>

                    </form>
                </div>

                <!-- Display Source -->


            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php
include "includes/admin_footer.php";

?>