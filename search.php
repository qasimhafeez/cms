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
                
                if(isset($_POST['submit']))
                {
                    $search = $_POST['search'];

                    $query = "select * from posts where post_tags LIKE '%$search%' ";
                    $result = mysqli_query($connection, $query);

                    if(!$result)
                    {
                        die("No Search Found!".mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($result);
                    if($count == 0)
                    {
                        echo "<h1>No Result Found!</h1>";
                    }
                    else
                    {
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
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <?php
                        }
                        

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