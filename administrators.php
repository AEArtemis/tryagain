<?php 
    include 'includes/connection.php';
    session_start();
    // session_destroy();
    $title = "Administrators";

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
                            <li class="active">
                                <a href="administrators.php"><strong>Administrators</strong></a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <div class="title-action">
                            <a href="add-administrator.php" class="btn btn-primary">
                                <span class="fa fa-users"></span> Add Admin
                            </a>
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
                                        <table class="table table-striped table-bordered table-hover" id="tbl-administrators">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $fetch_categories = "SELECT * FROM users WHERE type =0";
                                                    $result = mysqli_query($connection, $fetch_categories);
                                                    $i = 1;

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$i.'</td>
                                                                <td>'.$row['full_name'].'</td>
                                                                <td>'.$row['phone'].'</td>
                                                                <td>'.$row['email'].'</td>
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
                $('#tbl-administrators').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: []
                });
            });
        </script>

    </body>
</html>
