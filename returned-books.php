<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Returned Books";

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
                                <a href="returned-books.php"><strong>Return</strong></a>
                            </li>
                        </ol>
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
                                        <table class="table table-striped table-bordered table-hover" id="tbl-returned-books">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Borrower</th>
                                                    <th>ISBN</th>
                                                    <th>Book Title</th>
                                                    <th>Date Borrowed</th>
                                                    <th>Date Returned</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $fetch_borrowed_books = "SELECT returned.id, users.full_name, books.isbn, books.title, returned.date_borrowed, returned.date_returned FROM returned INNER JOIN users ON returned.user_id = users.id INNER JOIN books ON returned.book_id = books.id";
                                                    $result = mysqli_query($connection, $fetch_borrowed_books);
                                                    $i=1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$row['id'].'</td>
                                                                <td>'.$row['full_name'].'</td>
                                                                <td>'.$row['isbn'].'</td>
                                                                <td>'.$row['title'].'</td>
                                                                <td>'.$row['date_borrowed'].'</td>
                                                                <td>'.$row['date_returned'].'</td>
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
                $('#tbl-returned-books').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: []
                });
            });
        </script>
    </body>
</html>
