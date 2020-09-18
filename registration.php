<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php

    if(isset($_POST['submit']))
    {
        
        $u_name = $_POST['username'];
        $u_email = $_POST['email'];
        $u_pass = $_POST['password'];
        
        if(!empty($u_name) && !empty($u_email) && !empty($u_pass))
        {
            $u_name  = mysqli_real_escape_string($connection, $u_name);
            $u_email = mysqli_real_escape_string($connection, $u_email);
            $u_pass  = mysqli_real_escape_string($connection, $u_pass);

            $query = "SELECT passSalt from users";
            $getSalt = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($getSalt);
            
            $salt = $row['passSalt'];
            $u_pass = crypt($u_pass, $salt);
            
            $query = "INSERT into users (user_name, user_email, user_password, user_role) ";
            $query .= "VALUES ('{$u_name}', '{$u_email}', '{$u_pass}', 'subscriber' )";
            $register_user = mysqli_query($connection, $query);
            
            $message = "You have been successfully Registerd!";
        }
        else
        {
            $message = "Fill out the fields properly!";
        }
    }
    else
    {
        $message = "";
    }

?>   
   
   
   
   
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
