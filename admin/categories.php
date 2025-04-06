<?php
include "includes/admin_header.php";
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
                </div>
                <div class="col-xs-6">
                    <!-- Add Category to Database -->
                    <?php
                    if (isset($_POST['sumbit'])) {
                        $cat_title = $_POST['cat_title'];
                        if ($cat_title == "" || empty($cat_title)) {
                            echo "<div class='alert alert-danger'>This field should not be empty</div>";
                        } else {
                            $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
                            $create_category_query = mysqli_query($connection, $query);
                            if (!$create_category_query) {
                                die('QUERY FAILED' . mysqli_error($connection));
                            }
                        }
                    }
                    ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="sumbit" value="Add Category" class="btn btn-primary">
                        </div>
                    </form>
                </div>

                <!-- Add Category Form -->
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Find all categories from the database
                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_categories)) {
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['id'];
                                echo "<tr>";
                                echo "<td>{$cat_id}</td>";
                                echo "<td>{$cat_title}</td>";
                                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>

                            <?php
                            // Delete category from the database
                            if (isset($_GET['delete'])) {
                                $the_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE id = {$the_cat_id}";
                                $delete_query = mysqli_query($connection, $query);
                                header("Location: categories.php");
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php
    include "includes/footer.php";

    ?>