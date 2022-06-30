<?php
    session_start();
    include '../includes/connection.php';

    if (isset($_POST['add_administrator_button'])) {
        $name = trim(mysqli_real_escape_string($connection, $_POST['name']));
        $email = trim(mysqli_real_escape_string($connection, $_POST['email']));
        $phone = trim(mysqli_real_escape_string($connection, $_POST['phone']));
        $check_exist = "SELECT * FROM users WHERE full_name='$name' WHERE type =0";
        $result = mysqli_query($connection, $check_exist);

        if ($result->num_rows > 0) {
            echo $_SESSION['error'] = '
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <i class="fa fa-exclamation-triangle fa-3x m-r-sm"></i> <span><strong>Failed! </strong>Administrator already exist.</span>
                </div>';

            header("Location: ../add-administrator.php");
        } else {
            $add_administrator = "INSERT INTO users (full_name,email,phone,type) VALUES ('$name','$email','$phone',0)";
        
            if (mysqli_query($connection, $add_administrator)) {
                echo $_SESSION['success'] = '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <i class="fa fa-info-circle fa-3x m-r-sm"></i> <span><strong>Success! </strong>Administrator was successfully added.</span>
                    </div>';

                header("Location: ../administrators.php");
            } else {
                echo "Error: " . $add_administrator . "<br>" . mysqli_error($connection);
            }
        }
    }

    mysqli_close($connection);
?>