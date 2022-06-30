<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Edit Book";

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
                        <h2>Book</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="list-of-books.php">List of Books</a>
                            </li>
                            <li class="active">
                                <a href="edit-book.php"><strong>Edit Book</strong></a>
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
                                                $book_id = $_GET['id'];
                                            
                                                $edit_book = "SELECT * FROM books WHERE id ='$book_id'";
                                                $result = mysqli_query($connection, $edit_book);
                                                
                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                }
                                            }
                                        ?>
                                        <form action="book/edit-book-action.php" method="POST" role="form">
                                            <input type="hidden" value="<?php echo $row['id']; ?>" name="hidden_book_id">
                                            <div class="form-group">
                                                <label>ISBN:</label> 
                                                <input type="text" value="<?php echo $row['isbn']; ?>" class="form-control" name="edit_isbn" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title:</label> 
                                                <input type="text" value="<?php echo $row['title']; ?>" class="form-control" name="edit_title" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Author:</label> 
                                                <input type="text" value="<?php echo $row['author']; ?>" class="form-control" name="edit_author" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Category:</label> 
                                                <select class="form-control" name="edit_category" required>
                                                    <?php 
                                                        $fetch_categories = "SELECT * FROM categories ORDER BY name";
                                                        $result = mysqli_query($connection, $fetch_categories);
                                                        
                                                        while ($category_row = mysqli_fetch_assoc($result)) {
                                                            if ($row['category_id'] === $category_row['id']) {
                                                                echo '<option selected value="'.$category_row['id'].'">'.$category_row['name'].'</option>';
                                                            } else {
                                                                echo '<option value="'.$category_row['id'].'">'.$category_row['name'].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Publish:</label> 
                                                <input type="text" value="<?php echo $row['publish_date']; ?>" class="form-control" name="edit_publish_date" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity:</label> 
                                                <input type="number" value="<?php echo $row['quantity']; ?>" class="form-control" name="edit_quantity" autocomplete="off" required>
                                            </div>
                                            <div class="m-t-lg text-right">
                                                <button type="submit" class="btn btn-primary" name="edit_book_button"><i class="fa fa-check"></i> Save Changes</button>
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