<?php

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
} else {
    $the_post_id = '';
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php
                                                                    echo $post_title;
                                                                    ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirm_query($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['id'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php
                                                                        echo $post_author;
                                                                        ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php
                                                                            echo $post_status;
                                                                            ?>">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php
                                                                        echo $post_tags;
                                                                        ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php
                                                                                        echo $post_content;
                                                                                        ?> </textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Publish Post" name="submit" class="btn btn-primary">
    </div>

</form>