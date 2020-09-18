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

                //This is For Pagination

                $posts_per_page = 2;

                if(isset($_GET['page'])){

                    $page = $_GET['page'];

                }
                else {
                    $page = "";

                }

                if ($page == "" || $page == 1) {
                
                    $page_1 = 0;
                
                } else {
                    $page_1 = ($page * $posts_per_page) - $posts_per_page;
                }



                $find_rows_numbers = "select * from posts";
                $get_count = mysqli_query($connection, $find_rows_numbers);
                $count = mysqli_num_rows($get_count);
                $count = ceil($count / $posts_per_page);


                $query = "select * from posts LIMIT $page_1,2";
                $result = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 225);
                    $post_status = $row['post_status'];
                    
                    if($post_status == 'published')
                    {
                        
                ?>
               

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>&post_title=<?php echo $post_title; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <?php
                    }
                }
                ?>
                
                
                <hr>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        <hr>

        <ul class="pager">
            <?php 

            for ($i=1; $i <= $count; $i++) {
                if ($i == $page) {
                    echo "<li><a href='index.php?page={$i}' class='active'>{$i}</a></li>";     
                 } else {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";    
                 }
                
            }


             ?>
        </ul>


        <!-- Footer -->
        <?php include "includes/footer.php"; ?>