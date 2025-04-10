<?php
include "includes/header.php";
?>

<!-- Navigation -->
<?php
include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['p_id']) && is_numeric($_GET['p_id'])) {
                $the_post_id = intval($_GET['p_id']);
            } else {
                // Redirect or handle the error if 'p_id' is not set or invalid
                header("Location: index.php");
                exit();
            }

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];
                $post_comment_count = $row['post_comment_count'];
                $post_category_id = $row['post_category_id'];
                $post_tags = $row['post_tags'];

            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->

                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>



            <?php
            }
            ?>

            <!-- Blog Comments -->

            <?php

            if (isset($_POST['submit'])) {
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $comment_status = 'unapproved';
                $comment_date = date('d-m-y');
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now())";
                $create_comment_query = mysqli_query($connection, $query);
                if (!$create_comment_query) {
                    die('QUERY FAILED' . mysqli_error($connection));
                }
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                $update_comment_count = mysqli_query($connection, $query);
                if (!$update_comment_count) {
                    die('QUERY FAILED' . mysqli_error($connection));
                }
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Comment</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>

        </div>


        <!-- Blog Sidebar Widgets Column -->
        <?php
        include "includes/sidebar.php";
        ?>




    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php
    include "includes/footer.php";
    ?>