<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                
                
                <?php
                    if(isset($_GET['p_id']))
                    {
                        $p_id = $_GET['p_id'];
                        $p_author = $_GET['author'];
                    }
                ?>
                
                
               <?php 
                
                //Here we can see every single post entirely by clicking on the link of the name of the post
                
                $query = "select * from posts WHERE post_author = '{$p_author}'";
                $result = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                
                ?>
               

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $p_id; ?>">
                            <?php echo $post_author; ?>
                        </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $p_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <?php
                }
                ?>
                         
               
                <!-- Blog Comments -->

               
               <?php
                    if(isset($_POST["create_comment"]))
                    {
                        $p_id = $_GET['p_id'];
                        $cmt_author = $_POST['cmt_author'];
                        $cmt_email = $_POST['cmt_email'];
                        $cmt_content = $_POST['cmt_content'];
                        
                        if(!empty($cmt_author) && !empty($cmt_email) && !empty($cmt_content))
                        {
                            $query = "INSERT INTO comments (cmt_post_id, cmt_author, cmt_email, cmt_content, cmt_status,
                                        cmt_date) ";
                            $query .= "VALUES ($p_id, '{$cmt_author}', '{$cmt_email}', '{$cmt_content}', 'unapproved', now())";

                            $cmt_query = mysqli_query($connection, $query);

                            $query = "UPDATE posts set post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = $p_id ";
                            $update_cmt_count = mysqli_query($connection, $query);
    
                        }
                        else
                        {
                            echo "<script>alert('Fields cannot be empty!')</script>";
                        }         
                    }
                
                ?>
               <hr>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>