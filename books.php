<?php 
    include 'includes/connection.php';
    $title = "Books";
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
                                <a href="books.html"><strong>List of Books</strong></a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <div class="title-action">
                            <button data-toggle="modal" href="#add-book-modal" class="btn btn-primary"><span class="fa fa-book"></span> Add Book</button>
                        </div>
                    </div>

                    <!-- Add Book Modal -->
                    <div id="add-book-modal" class="modal fade" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Add Book</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form action="#" method="" role="form">
                                            <div class="form-group">
                                                <label>ISBN:</label> 
                                                <input type="text" placeholder="ISBN" class="form-control" name="isbn">
                                            </div>
                                            <div class="form-group">
                                                <label>Title:</label> 
                                                <input type="text" placeholder="Title" class="form-control" name="title">
                                            </div>
                                            <div class="form-group">
                                                <label>Author:</label> 
                                                <input type="text" placeholder="Author" class="form-control" name="author">
                                            </div>
                                            <div class="form-group">
                                                <label>Category:</label> 
                                                <select class="form-control" name="category">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Publish:</label> 
                                                <input type="text" placeholder="Date of publish" class="form-control" name="publish_date">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content here -->
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>Category</th>
                                                    <th>Publish</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
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
                $('.dataTables-example').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: []
                });
            });
        </script>
    </body>
</html>
