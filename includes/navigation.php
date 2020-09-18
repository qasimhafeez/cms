
     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                    <?php
                    
                    //Displaying all the categories in the navigation bar
                    
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($result))
                    {       
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
                    <?php
                        if(isset($_SESSION['user_role']))
                        {
                            $user_role = $_SESSION['user_role'];
                            if($user_role === 'admin')
                            {
                                echo "<ul class='nav navbar-nav navbar-right'>
                                        <li><a href='admin'>Admin Panel</a></li>
                                      </ul>";
                            }
                            
                            if(isset($_GET['p_id']))
                            {
                                $p_id = $_GET['p_id'];
                                echo "<ul class='nav navbar-nav navbar-right'>
                                        <li><a href='admin/posts.php?source=edit_post&p_id={$p_id}'>Edit Post</a></li>
                                      </ul>";
                            }
                        }
                    ?>
                    
<!--                    <li><a href=""></a></li>-->
<!--                </ul>-->
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>