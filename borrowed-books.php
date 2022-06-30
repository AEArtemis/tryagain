<?php
    include 'includes/connection.php';
    session_start();
    // session_destroy();
    $title = "Borrowed Books";

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
                                <a href="borrowed-books.php"><strong>Borrow</strong></a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <div class="title-action">
                            <a href="borrow.php" class="btn btn-primary"><span class="fa fa-bookmark-o"></span> Borrow Book</a>
                        </div>
                    </div>
                </div>

                <!-- Content here -->
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                if(isset($_SESSION['success'])) {
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="tbl-borrowed-books">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Borrower</th>
                                                    <th>ISBN</th>
                                                    <th>Book Title</th>
                                                    <th>Borrow Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $fetch_borrowed_books = "SELECT borrow.id, users.id AS user_id, users.full_name, books.id AS book_id, books.isbn, books.title, borrow.date_borrowed FROM borrow INNER JOIN users ON borrow.user_id = users.id INNER JOIN books ON borrow.book_id = books.id";
                                                    $result = mysqli_query($connection, $fetch_borrowed_books);
                                                    $i=1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$i.'</td>
                                                                <td>'.$row['full_name'].'</td>
                                                                <td>'.$row['isbn'].'</td>
                                                                <td>'.$row['title'].'</td>
                                                                <td>'.$row['date_borrowed'].'</td>
                                                                <td>
                                                                    <form action="book/return-book-action.php" method="POST" role="form">
                                                                        <input type="hidden" name="borrow_id" value="'.$row['id'].'">
                                                                        <input type="hidden" name="user_id" value="'.$row['user_id'].'">
                                                                        <input type="hidden" name="book_id" value="'.$row['book_id'].'">
                                                                        <input type="hidden" name="date_borrowed" value="'.$row['date_borrowed'].'">
                                                                        <button class="btn btn-primary" type="submit" name="return_book_button">
                                                                            <span class="fa fa-exchange"></span> Return Book
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        ';
                                                        $i+=1;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
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

        <!-- DataTable -->
        <script>
            $(document).ready(function(){
                $('#tbl-borrowed-books').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: []
                });
            });
        </script>

    </body>
</html>