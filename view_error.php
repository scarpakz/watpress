<?php include 'include/header.php';?>
<?php session_start();?>

        <!-- Login -->
        <div class="wp_login_field">
            <div class="container">
                <div class="col s8">
                    <h3>Log In</h3>
                    <div class="login_error">
                      <h6><b>ERROR!</b> Incorrect Username or Password! </h6>
                    </div>
                    <form action="controller/handling.php" method="POST">
                        <div class="wp_input_group">
                            <label for="">Username
                                <input type="text" name="username" placeholder="Type username" required="" autofocus>
                            </label>
                            <label for="">Password
                                <input type="password" name="password" placeholder="Type password" required="">
                            </label>
                        </div>
                        <br>
                        <input type="submit" value="Log In" class="btn blue">
                    </form>
                </div>
            </div>
        </div>

<?php include 'include/footer.php';?>
