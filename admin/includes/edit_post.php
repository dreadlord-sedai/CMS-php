<?php

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
} else {
    $the_post_id = '';
}
// Update Post
$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
}

if (isset($_POST['update_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $post_date = date('d-m-y');
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";


    $update_post = mysqli_query($connection, $query);

    confirm_query($update_post);
   
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
}


?>
<form action="" method="post" enctype="multipart/form-data" class="edit-post-form">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirm_query($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['id'];
                $selected = ($cat_id == $post_category_id) ? 'selected' : '';
                echo "<option value='{$cat_id}' {$selected}>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option value="<?php echo $post_status; ?>" selected><?php echo ucfirst($post_status); ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Published</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <div class="current-image">
            <img width="100" src="../images/<?php echo $post_image; ?>" alt="Current post image">
        </div>
        <input type="file" name="image" class="form-control">
        <small class="help-block">Leave empty to keep the current image</small>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
        <small class="help-block">Separate tags with commas</small>
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Update Post" name="update_post" class="btn btn-primary">
    </div>
</form>

<style>
.edit-post-form {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.edit-post-form .form-group {
    margin-bottom: 1.5rem;
}

.edit-post-form label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--admin-text);
    font-weight: 500;
}

.edit-post-form .form-control {
    background-color: var(--admin-bg);
    border: 1px solid var(--admin-border);
    color: var(--admin-text);
    border-radius: 6px;
    padding: 10px 15px;
    width: 100%;
}

.edit-post-form .form-control:focus {
    border-color: var(--admin-primary);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

.edit-post-form select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

.edit-post-form select.form-control option {
    background-color: var(--admin-card-bg);
    color: var(--admin-text);
    padding: 12px;
}

.edit-post-form .current-image {
    margin-bottom: 1rem;
    padding: 10px;
    background-color: var(--admin-card-bg);
    border-radius: 6px;
    display: inline-block;
}

.edit-post-form .help-block {
    color: var(--admin-text-muted);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.edit-post-form .btn-primary {
    padding: 10px 20px;
    font-size: 1rem;
}

/* Summernote Editor Dark Theme */
.note-editor {
    background-color: var(--admin-bg) !important;
    border-color: var(--admin-border) !important;
}

.note-editor .note-toolbar {
    background-color: var(--admin-card-bg) !important;
    border-color: var(--admin-border) !important;
}

.note-editor .note-editing-area {
    background-color: var(--admin-bg) !important;
}

.note-editor .note-editable {
    background-color: var(--admin-bg) !important;
    color: var(--admin-text) !important;
}

.note-editor .note-statusbar {
    background-color: var(--admin-card-bg) !important;
    border-color: var(--admin-border) !important;
}
</style>