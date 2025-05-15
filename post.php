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
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                $send_query = mysqli_query($connection, $view_query);

                if (!$send_query) {
                    die('QUERY FAILED' . mysqli_error($connection));
                }

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_status = $row['post_status'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_category_id = $row['post_category_id'];
                    $post_tags = $row['post_tags'];
            ?>
                    <article class="single-post">
                        <header class="post-header">
                            <h1 class="post-title"><?php echo $post_title; ?></h1>
                            <div class="post-meta">
                                <span class="post-author">
                                    <i class="fas fa-user"></i> 
                                    <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author; ?></a>
                                </span>
                                <span class="post-date">
                                    <i class="fas fa-calendar"></i> 
                                    <?php echo $post_date; ?>
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comments"></i> 
                                    <?php echo $post_comment_count; ?> Comments
                                </span>
                            </div>
                        </header>

                        <div class="post-image">
                            <img src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                        </div>

                        <div class="post-content">
                            <?php echo $post_content; ?>
                        </div>

                        <div class="post-tags">
                            <i class="fas fa-tags"></i> 
                            <?php echo $post_tags; ?>
                        </div>
                    </article>

                    <!-- Comments Section -->
                    <section class="comments-section">
                        <h3 class="section-title">Comments (<?php echo $post_comment_count; ?>)</h3>

                        <!-- Comments Form -->
                        <div class="comment-form-container">
                            <h4>Leave a Comment</h4>
                            <form action="#" method="post" role="form" class="comment-form">
                                <div class="form-group">
                                    <label for="comment_author">Name</label>
                                    <input type="text" name="comment_author" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="comment_email">Email</label>
                                    <input type="email" name="comment_email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="comment_content">Your Comment</label>
                                    <textarea name="comment_content" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" name="create_comment" class="btn btn-primary">Post Comment</button>
                            </form>
                        </div>

                        <!-- Posted Comments -->
                        <div class="comments-list">
                            <?php
                            $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
                            $select_comment_query = mysqli_query($connection, $query);
                            if (!$select_comment_query) {
                                die('QUERY FAILED' . mysqli_error($connection));
                            }
                            while ($row = mysqli_fetch_array($select_comment_query)) {
                                $comment_date = $row['comment_date'];
                                $comment_content = $row['comment_content'];
                                $comment_author = $row['comment_author'];
                            ?>
                                <div class="comment">
                                    <div class="comment-avatar">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($comment_author); ?>&background=random" alt="<?php echo $comment_author; ?>">
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-header">
                                            <h4 class="comment-author"><?php echo $comment_author; ?></h4>
                                            <span class="comment-date"><?php echo $comment_date; ?></span>
                                        </div>
                                        <div class="comment-body">
                                            <?php echo $comment_content; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </section>
            <?php
                }
            } else {
                header("Location: index.php");
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include "includes/sidebar.php";
        ?>
    </div>
</div>

<!-- Footer -->
<?php
include "includes/footer.php";
?>