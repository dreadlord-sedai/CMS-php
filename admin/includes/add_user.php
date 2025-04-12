<?php
if (isset($_POST['title'])) {
    $user_id = $_POST['user_id'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(post_title, post_category_id, post_date, post_author, post_image, post_content, post_tags, post_status, post_comment_count)
              VALUES('{$post_title}', '{$post_category_id}', now(), '{$post_author}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}', '0')";

    $create_post_query = mysqli_query($connection, $query);

    confirm_query($create_post_query);

    header("Location: posts.php?source=add_post");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_category">Role</label>
        <select name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM users ";
            $select_users = mysqli_query($connection, $query);
            confirm_query($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];
                echo "<option value='{$user_id}'>{$user_role}</option>";
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="author">
    </div>


    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_status">Password</label>
        <input type="text" class="form-control" name="post_status">
    </div>



    <div class="form-group">
        <input type="submit" value="Publish Post" name="submit" class="btn btn-primary">
    </div>

</form>