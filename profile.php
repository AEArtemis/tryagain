<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Profile";

    if (!isset($_SESSION['session_id'])) {
		header('location: index.php');
	}
?>

<!DOCTYPE html>
<html>
    <?php 
        include 'includes/head.php';
    ?>

    <body>
        <div id="wrapper">
            <?php 
                include 'includes/sidebar.php';
            ?>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <?php
                        include 'includes/header.php';
                    ?>
                </div>


                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-4">
                        <h2>Profile</h2>
                        <ol class="breadcrumb">
                            <li class="active">
                                <a href="#"><strong>Update Profile</strong></a>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- Content here -->
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            <?php
                                if(isset($_SESSION['success'])) {
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <?php 
                                        $id = $_SESSION['session_id'];
                                        $data = "SELECT * FROM users WHERE id = '$id'";
                                        $result = mysqli_query($connection, $data);
                                        $get_info = mysqli_fetch_assoc($result);
                                    ?>
                                    <form action="auth/update-profile.php" method="POST" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Full Name:</label> 
                                            <input type="text" placeholder="Full name" class="form-control" name="full_name" autocomplete="off" required value="<?php echo $get_info['full_name']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone:</label> 
                                            <input type="number" placeholder="Phone number" class="form-control" name="phone" autocomplete="off" required value="<?php echo $get_info['phone']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email:</label> 
                                            <input type="email" placeholder="Email" class="form-control" name="email" autocomplete="off" required value="<?php echo $get_info['email']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password:</label> 
                                            <input type="password" placeholder="********" class="form-control" name="password" autocomplete="off">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Photo:</label> 
                                            <input type="file" class="form-control" name="photo">
                                        </div> -->
                                        <div class="m-t-lg text-right">
                                            <button type="submit" class="btn btn-primary" name="update_profile"><i class="fa fa-pencil"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    include 'includes/footer.php';
                ?>
            </div>
        </div>

        <?php
            include 'includes/scripts.php';
        ?>
    </body>
</html>