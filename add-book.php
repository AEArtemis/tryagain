<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Add Book";

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
                                <a href="add-book.php"><strong>Add Book</strong></a>
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
                                        <form action="book/add-book-action.php" method="POST" role="form">
                                            <div class="form-group">
                                                <label>ISBN:</label> 
                                                <input type="text" placeholder="ISBN" class="form-control" name="isbn" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title:</label> 
                                                <input type="text" placeholder="Title" class="form-control" name="title" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Author:</label> 
                                                <input type="text" placeholder="Author" class="form-control" name="author" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Category:</label> 
                                                <select class="form-control" name="category" required>
                                                    <option value="" selected disabled>Select category</option>
                                                    <?php 
                                                        $fetch_categories = "SELECT * FROM categories ORDER BY name";
                                                        $result = mysqli_query($connection, $fetch_categories);

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Publish:</label> 
                                                <input type="text" placeholder="September 1995" class="form-control" name="publish_date" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity:</label> 
                                                <input type="number" placeholder="XX" class="form-control" name="quantity" autocomplete="off" required>
                                            </div>
                                            <div class="m-t-lg text-right">
                                                <button type="submit" class="btn btn-primary" name="add_book_button"><i class="fa fa-plus"></i> Add Book</button>
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
