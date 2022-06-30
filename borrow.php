<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Borrow";

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
                            <li>
                                <a href="borrowed-books.php">Borrowed Books</a>
                            </li>
                            <li class="active">
                                <a href="borrow.php"><strong>Borrow</strong></a>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- Content here -->
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6 col-lg-offset-3">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <form action="book/borrow-book-action.php" method="POST" role="form">
                                            <div class="form-group">
                                                <label>Borrower:</label> 
                                                <select class="form-control" name="borrower" required>
                                                    <option value="" selected disabled>Select borrower</option>
                                                    <?php 
                                                        $fetch_users = "SELECT * FROM users WHERE type=1";
                                                        $result = mysqli_query($connection, $fetch_users);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo '<option value="'.$row['id'].'">'.$row['full_name'].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Book:</label> 
                                                <select class="form-control" name="book" required>
                                                    <option value="" selected disabled>Select book</option>
                                                    <?php 
                                                        $fetch_books = "SELECT * FROM books WHERE quantity > 0 ORDER BY title";
                                                        $result = mysqli_query($connection, $fetch_books);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Date:</label> 
                                                <input type="text" class="form-control" name="date_borrowed" autocomplete="off" required placeholder="YYYY-MM-DD">
                                            </div>
                                            <div class="m-t-lg text-right">
                                                <button type="submit" class="btn btn-primary" name="borrow_book_button"><i class="fa fa-check"></i> Borrow Book</button>
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