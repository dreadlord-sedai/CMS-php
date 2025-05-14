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
                        Welcome to Comments
                        <small>Author</small>
                    </h1>
                </div>

                <?php

                if (isset($_POST['checkBoxArray'])) {
                    foreach ($_POST['checkBoxArray'] as $postValueId) {
                        $bulk_options = $_POST['bulk_options'];

                        switch ($bulk_options) {
                            case 'published':
                                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                                $update_to_published_status = mysqli_query($connection, $query);
                                confirm_query($update_to_published_status);
                                break;

                            case 'draft':
                                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                                $update_to_draft_status = mysqli_query($connection, $query);
                                confirm_query($update_to_draft_status);
                                break;

                            case 'delete':
                                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                                $delete_post = mysqli_query($connection, $query);
                                confirm_query($delete_post);
                                break;

                            case 'clone':
                                $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                                $select_post_query = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_array($select_post_query)) {
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_date = $row['post_date'];
                                    $post_image = $row['post_image'];
                                    $post_content = $row['post_content'];
                                    $post_status = $row['post_status'];
                                    $post_comment_count = $row['post_comment_count'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_tags = $row['post_tags'];
                                }
                                $query = "INSERT INTO posts(post_title, post_author, post_date, post_image, post_content, post_status, post_comment_count, post_category_id, post_tags) ";
                                $query .= "VALUES('{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_status}', {$post_comment_count}, {$post_category_id}, '{$post_tags}')";
                                $clone_post = mysqli_query($connection, $query);
                                confirm_query($clone_post);

                                break;
                        }
                    }
                    header("Location: posts.php");
                }

                ?>

                <form action="" method="post">

                    <table class="table table-bordered table-hover">
                        <div id="bulkOptionsContainer" class="col-xs-4">
                            <select class="form-control" name="bulk_options" id="">
                                <option value="">Select Options</option>
                                <option value="published">Publish</option>
                                <option value="draft">Draft</option>
                                <option value="delete">Delete</option>
                                <option value="clone">Clone</option>
                            </select>

                        </div>

                        <div class="col-xs-4">
                            <button type="submit" name="submit" class="btn btn-success" value="Apply">Apply</button>
                            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                        </div>

                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllBoxes"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response To</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <?php

                        $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
                        $select_comments = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($select_comments)) {
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];

                            echo "<tr>";
                        ?>

                            <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                        <?php

                            echo "<td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";
                            echo "<td>{$comment_content}</td>";
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_status}</td>";

                            // Fetching the post title for the comment (in response to)
                            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                            $select_post_id_query = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                            }

                            echo "<td>{$comment_date}</td>";
                            echo "<td><a href='post_comments.php?approve={$comment_id}'>Approve</a></td>";
                            echo "<td><a href='post_comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                            echo "<td><a href='post_comments.php?delete={$comment_id}&id={$_GET['id']}'>Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </form>

                <?php
                // Delete Post
                if (isset($_GET['delete'])) {
                    $the_comment_id = $_GET['delete'];
                    $query = "DELETE FROM comments WHERE comment_id = " . mysqli_real_escape_string($connection, $the_comment_id) . "";
                    $delete_query = mysqli_query($connection, $query);
                    header("Location: post_comments.php?id=" . mysqli_real_escape_string($connection, $_GET['id']) . "");
                }

                ?>

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