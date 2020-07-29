<?php
    session_start();
    include_once ('../Controller/connection.php');
    include_once ('../Controller/databaseData.php');
    if (!isset($_SESSION['id'])){
        header('Location: http://localhost:82/html/StudentPortal/view/loginPage.php');
    }
    $stdID = $_SESSION['std_id'];

    $connection = DBConnection::get_instance()->get_connection();
    $query = "SELECT * FROM student where id =$stdID";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Student Portal - Profile</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="gray" data-image="assets/img/sidebar-2.jpg">

        <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="userProfile.php" class="simple-text">
                    Student Portal
                </a>
            </div>

            <ul class="nav">

                <li class="active">
                    <a href="userProfile.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="courseReg.php">
                        <i class="pe-7s-graph"></i>
                        <p>Course Registration</p>
                    </a>
                </li>
                <li>
                    <a href="studentSchedule.php">
                        <i class="pe-7s-note2"></i>
                        <p>Course Schedule</p>
                    </a>
                </li>
                <li>
                    <a href="courseWithdraw.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Withdraw a Course</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" >User Profile</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">

                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="http://localhost:82/html/StudentPortal/view/logoutPage.php">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>University</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="IUG">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" disabled placeholder="Name" value="<?php
                                                echo "$name";
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Balance</label>
                                                <input type="text" class="form-control" disabled placeholder="balance" value="+7.6 $">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" disabled placeholder="email"  value="<?php
                                                echo "$email";
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" disabled placeholder="phone" value="<?php
                                                echo "$phone";
                                                ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Course</th>
                                                    <th>Hours</th>
                                                    <th>Grade</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $grades = getData::getGrades($stdID);
                                                foreach ($grades as $grade) {
                                                    if (is_array ($grade)) {
                                                        echo '<tr>';
                                                        echo '<td>' . $grade["id"] . '</td>';
                                                        echo '<td>' . $grade["course"] . '</td>';
                                                        echo '<td>' . $grade["hours"] . '</td>';
                                                        echo '<td>' . $grade["grade"] . '</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3">TOTAL GPA</td>
                                                    <td><?php
                                                        $grades = getData::getGrades($stdID);
                                                        foreach ($grades as $grade) {
                                                            if (!(is_array ($grade))) {
                                                                echo $grade;
                                                            }
                                                        }
                                                        ?></td>
                                                </>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                <div class="row">
                                    <form method="post">
                                        <div class="col-md-3">
                                            <select class="form-control" name="year">
                                                <option selected disabled>Year</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="sem">
                                                <option selected disabled>Semester</option>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-dark" value="View Grades" name="view">
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Course</th>
                                                <th>Hours</th>
                                                <th>Grade</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (isset($_POST['view']) && isset($_POST['year']) && isset($_POST['sem'])) {
                                                $grades = getData::getSemesterGrades($stdID, $_POST['year'], $_POST['sem']);
                                                foreach ($grades as $grade) {
                                                    if (is_array($grade)) {
                                                        echo '<tr>';
                                                        echo '<td>' . $grade["id"] . '</td>';
                                                        echo '<td>' . $grade["course"] . '</td>';
                                                        echo '<td>' . $grade["hours"] . '</td>';
                                                        echo '<td>' . $grade["grade"] . '</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="3">Semester GPA</td>
                                                <td><?php
                                                    if (isset($_POST['view']) && isset($_POST['year']) && isset($_POST['sem'])) {
                                                        $grades = getData::getSemesterGrades($stdID, $_POST['year'], $_POST['sem']);
                                                        foreach ($grades as $grade) {
                                                            if (!(is_array($grade))) {
                                                                echo $grade;
                                                            }
                                                        }
                                                    }
                                                    ?></td>
                                            </>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/full-screen-image-3.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="assets/img/faces/face-0.jpg" alt="..."/>

                                        <h4 class="title"><?php
                                            echo "$name";
                                            ?><br />
                                            <small></small>
                                        </h4>
                                    </a>
                                </div>
                                <p class="description text-center">
                                    <br>
                                    Description
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> Made By Ahmad Faroukh
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>