<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Register";

    if (isset($_SESSION['session_id'])) {
        header('location: dashboard.php');
    }
?>
<!DOCTYPE html>
<html>
    <?php 
        include 'includes/head.php';
    ?>

    <body class="gray-bg">
        <div class="middle-box text-center loginscreen   animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">TL</h1>
                </div>
                <h3>Register to TL</h3>
                <p>Create account to see it in action.</p>
                <form class="m-t" role="form" method="POST" action="auth/register-action.php">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name" required autocomplete="off" name="full_name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required autocomplete="off" name="email">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Phone" required autocomplete="off" name="phone">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required autocomplete="off" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" name="register_button">Register</button>

                    <p class="text-muted text-center"><small>Already have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" href="index.php">Login</a>
                </form>
            </div>
        </div>

        <?php
            include 'includes/scripts.php';
        ?>
    </body>
</html>