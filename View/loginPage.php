<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: http://localhost:82/html/StudentPortal/view/userProfile.php');
} else {

    include_once ('../Controller/connection.php');
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['student_id']) && isset($_POST['student_password'])) {
            $std_id = htmlspecialchars($_POST['student_id']);
            $password = htmlspecialchars($_POST['student_password']);
            $connection = DBConnection::get_instance()->get_connection();
            $sql = "SELECT * FROM student WHERE id = '" . $std_id . "' AND password = '" . md5($password) . "'";
            $result = mysqli_query($connection, $sql);
            if ($result != false) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["std_id"] = $std_id;
                    $_SESSION["logged_in"] = true;
                    if(isset($_POST['remember_me'])){
                        setcookie("student", $std_id, time() + (9000 * 30) );
                    }
                    header('Location: http://localhost:82/html/StudentPortal/view/userProfile.php');
                } else {

                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("Login Failed","Wrong Student Name or Password","error");';
                    echo '}, 90);</script>';

                }
            } else {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Backend Error","Cant Connect To Database","error");';
                echo '}, 90);</script>';
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Portal Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style type="text/css">
        body {
            color: #999;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
        }
        .form-control {
            box-shadow: none;
            border-color: #ddd;
        }
        .form-control:focus {
            border-color: #4aba70;
        }
        .login-form {
            width: 350px;
            margin: 0 auto;
            padding: 30px 0;
        }
        .login-form form {
            color: #434343;
            border-radius: 1px;
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #f3f3f3;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h4 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .login-form .avatar {
            color: #fff;
            margin: 0 auto 30px;
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            z-index: 9;
            background: #4aba70;
            padding: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }
        .login-form .avatar i {
            font-size: 62px;
        }
        .login-form .form-group {
            margin-bottom: 20px;
        }
        .login-form .form-control, .login-form .btn {
            min-height: 40px;
            border-radius: 2px;
            transition: all 0.5s;
        }
        .login-form .close {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .login-form .btn {
            background: #4aba70;
            border: none;
            line-height: normal;
        }
        .login-form .btn:hover, .login-form .btn:focus {
            background: #42ae68;
        }
        .login-form .checkbox-inline {
            float: left;
        }
        .login-form input[type="checkbox"] {
            margin-top: 2px;
        }
        .login-form .forgot-link {
            float: right;
        }
        .login-form .small {
            font-size: 13px;
        }
        .login-form a {
            color: #4aba70;
        }
    </style>
</head>
<body>
<div class="login-form">
    <form action="loginPage.php" method="post" name="login">
        <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
        <h4 class="modal-title">Login to Your Account</h4>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Student ID" required="required" name="student_id">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name="student_password">
        </div>
        <div class="form-group small clearfix">
            <label class="checkbox-inline"><input type="checkbox" name="remember_me"> Remember me</label>
            <a href="#" class="forgot-link">Forgot Password?</a>
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
    </form>
    <div class="text-center small">Don't have an account? <a href="#">Sign up</a></div>
</div>
</body>
</html>