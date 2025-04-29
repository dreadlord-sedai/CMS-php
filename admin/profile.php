<?php
include "includes/admin_header.php";
?>
<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
                            <input type="text" class="form-control" name="user_password"
                                value="<?php if (isset($user_password)) {
                                            echo $user_password;
                                        } ?>">
                        </div>


                        <div class="form-group">
                            <input type="submit" value="Edit User" name="edit_user" class="btn btn-primary">
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