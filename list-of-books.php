<?php  
    include 'includes/connection.php';
    session_start();
    // session_destroy();
    $title = "Books";

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
                            <li class="active">
                                <a href="list-of-books.php"><strong>List of Books</strong></a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <div class="title-action">
                            <a href="add-book.php" class="btn btn-primary"><span class="fa fa-book"></span> Add Book</a>
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
                                    unset($_SESSION['success']  );
                                }
                            ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl-books">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ISBN</th>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>Category</th>
                                                    <th>Publish</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $fetch_categories = "SELECT books.id, books.isbn, books.title, books.author, books.publish_date, books.quantity, categories.name FROM books INNER JOIN categories ON books.category_id = categories.id";
                                                    $result = mysqli_query($connection, $fetch_categories);
                                                    $i=1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($row['quantity'] < 1) {
                                                            $quantity = '<center><span class="label label-danger">Unavailable</span></center>';
                                                        } else {
                                                            $quantity = '<center><span class="label label-success">'.$row['quantity'].'</span></center>';
                                                        }
                                                        echo '
                                                            <tr>
                                                                <td>'.$i.'</td>
                                                                <td>'.$row['isbn'].'</td>
                                                                <td>'.$row['title'].'</td>
                                                                <td>'.$row['author'].'</td>
                                                                <td>'.$row['name'].'</td>
                                                                <td>'.$row['publish_date'].'</td>
                                                                <td>'.$quantity.'</td>
                                                                <td>
                                                                    <a href="edit-book.php?id='.$row['id'].'" class="btn btn-circle btn-primary">
                                                                        <span class="fa fa-pencil"></span>
                                                                    </a>
                                                                    <a href="book/delete-book-action.php?id='.$row['id'].'" class="btn btn-circle btn-primary">
                                                                        <span class="fa fa-trash"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        ';
                                                        $i += 1;
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
                $('#tbl-books').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: []
                });
            });
        </script>
    </body>
</html>
