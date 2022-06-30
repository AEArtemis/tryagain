<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Edit Category";
    $_SESSION['previous'] = 'http://'. $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];

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
                        <h2>Settings</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="categories.php">Categories</a>
                            </li>
                            <li class="active">
                                <a href="edit-category.php"><strong>Edit Category</strong></a>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- Content here -->
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6 col-lg-offset-3">
                                <?php 
                                    if(isset($_SESSION['error'])) {
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    }
                                ?>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <?php 
                                            if (isset($_GET['id'])) {
                                                $category_id = $_GET['id'];
                                            
                                                $edit_category = "SELECT * FROM categories WHERE id ='$category_id'";
                                                $result = mysqli_query($connection, $edit_category);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                }
                                            }
                                        ?>
                                        <form action="category/edit-category-action.php" method="POST" role="form">
                                            <div class="form-group">
                                                <label>Name:</label>  
                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="hidden_category_id">
                                                <input type="text" autocomplete="off" value="<?php echo $row['name']; ?>" class="form-control" name="edit_name" required>
                                            </div>
                                            <div class="m-t-lg text-right">
                                                <button type="submit" class="btn btn-primary" name="edit_category_button"><i class="fa fa-check"></i> Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
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
