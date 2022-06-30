<?php 
    include 'includes/connection.php';
    session_start();
    $title = "Dashbord";
    
    $id = $_SESSION['session_id'];

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
                <div class="wrapper wrapper-content">
                    <?php if($_SESSION['session_type'] == 0 ): ?>
                        <div class="row">
                            <?php 
                                $most_borrowed = "SELECT MAX(books.title) AS most_borrowed_book FROM returned INNER JOIN books ON books.id = returned.book_id GROUP BY books.title ORDER BY COUNT(*) DESC LIMIT 1";
                                $result = mysqli_query($connection, $most_borrowed);

                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '
                                        <div class="col-lg-12">
                                        <div class="widget red-bg p-lg text-center">
                                            <div class="m-b-md">
                                                <i class="fa fa-trophy fa-4x"></i>
                                                <h1 class="m-b-md">
                                                        '.$row['most_borrowed_book'].'
                                                </h1>
                                                <h3 class="font-bold no-margins">
                                                    Most Borrowed Book
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                        ';
                                    }
                                }
                            ?>
                            
                            <div class="col-lg-3">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Users </span>
                                            <h2 class="font-bold">
                                                <?php 
                                                    $total_users = "SELECT COUNT(*) AS users FROM users WHERE type=1";
                                                    $result = mysqli_query($connection, $total_users);

                                                    if ($result) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo $row['users'];
                                                        }
                                                    } else {
                                                        echo '0';
                                                    }
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-book fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Total Books </span>
                                            <h2 class="font-bold">
                                                <?php 
                                                    $total_books = "SELECT COUNT(*) AS total_book FROM books";
                                                    $result = mysqli_query($connection, $total_books);

                                                    if ($result) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo $row['total_book'];
                                                        }
                                                    } else {
                                                        echo '0';
                                                    }
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-bookmark-o fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Borrowed Books </span>
                                            <h2 class="font-bold">
                                                <?php 
                                                    $total_borrowed = "SELECT COUNT(*) AS total_borrowed FROM borrow";
                                                    $result = mysqli_query($connection, $total_borrowed);

                                                    if ($result) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo $row['total_borrowed'];
                                                        }
                                                    } else {
                                                        echo '0';
                                                    }
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-exchange fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Returned Books </span>
                                            <h2 class="font-bold">
                                                <?php 
                                                    $date = date('Y/m/d');
                                                    $total_returned = "SELECT COUNT(*) AS total_returned FROM returned WHERE date_returned = '$date'";
                                                    $result = mysqli_query($connection, $total_returned);

                                                    if ($result) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo $row['total_returned'];
                                                        }
                                                    } else {
                                                        echo '0';
                                                    }
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Returned Books</h5>
                                    </div>
                                    <?php 
                                        $data = "SELECT books.title, returned.date_returned FROM returned INNER JOIN users ON returned.user_id = users.id INNER JOIN books ON returned.book_id = books.id WHERE users.id = '$id'";
                                        $data_result = mysqli_query($connection, $data);
                                        
                                        if ($data_result->num_rows > 0) {
                                            while ($data_row = mysqli_fetch_assoc($data_result)) {
                                                echo '
                                                    <div class="ibox-content">
                                                        <div class="row">
                                                            <div class="col-xs-8">
                                                                <small class="stats-label">Book Title</small>
                                                                <h4>'.$data_row['title'].'</h4>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <small class="stats-label">Date Returned</small>
                                                                <h4>'.$data_row['date_returned'].'</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ';
                                            }
                                        } else {
                                            echo '
                                                    <div class="ibox-content">
                                                        <div class="row">
                                                            <div class="col-xs-12 text-center">
                                                                <img class="m-b-sm" src="assets/img/default_return.png" width="150px">
                                                                <h4>You do not have returned book(s) yet.</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Borrowed Books</h5>
                                    </div>
                                    <?php 
                                        $data = "SELECT books.title, borrow.date_borrowed FROM borrow INNER JOIN users ON borrow.user_id = users.id INNER JOIN books ON borrow.book_id = books.id WHERE users.id = '$id'";
                                        $data_result = mysqli_query($connection, $data);
                                        
                                        if ($data_result->num_rows > 0) {
                                            while ($data_row = mysqli_fetch_assoc($data_result)) {
                                                echo '
                                                    <div class="ibox-content">
                                                        <div class="row">
                                                            <div class="col-xs-8">
                                                                <small class="stats-label">Book Title</small>
                                                                <h4>'.$data_row['title'].'</h4>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <small class="stats-label">Date Borrowed</small>
                                                                <h4>'.$data_row['date_borrowed'].'</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ';
                                            }
                                        } else {
                                            echo '
                                                    <div class="ibox-content">
                                                        <div class="row">
                                                            <div class="col-xs-12 text-center">
                                                                <img class="m-b-sm" src="assets/img/default_borrow.png" width="150px">
                                                                <h4>You do not have borrowed book(s) yet.</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
