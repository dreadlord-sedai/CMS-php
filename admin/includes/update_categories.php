<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            // Find all categories from the database
            $query = "SELECT * FROM categories WHERE id = {$cat_id}";
            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['id'];
        ?>

                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" type="text" class="form-control" name="cat_title">



        <?php
            }
        }

        ?>

        <?php
        // Update category in the database
        if (isset($_POST['update_category'])) {
            $the_cat_title = $_POST['cat_title'];
            $cat_id = $_GET['edit'];

            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE id = {$cat_id}";
            $update_category_query = mysqli_query($connection, $query);

            if (!$update_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            } else {
                header("Location: categories.php");
            }
        }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" name="update_category" value="update_category" class="btn btn-primary">
    </div>
</form>