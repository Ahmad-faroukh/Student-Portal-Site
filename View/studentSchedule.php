<?php
    session_start();
    include_once ('../Controller/connection.php');
    include_once ('../Controller/databaseData.php');

    if (!isset($_SESSION['id'])) {
        header('Location: http://localhost:82/html/StudentPortal/view/loginPage.php');
    }
    $stdID = $_SESSION['std_id'];
    echo "<input type='hidden' name='stdID' value='" . $stdID . "'>"
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Student Portal - Schedule</title>

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
                <a href="studentSchedule.php" class="simple-text">
                    Student Portal
                </a>
            </div>

            <ul class="nav">
                <li>
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
                <li class="active">
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
                    <a class="navbar-brand" >Student Schedule</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">

                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="#">
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Schedule For Registered Courses</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                    <th>ID</th>
                                    <th>Course</th>
                                    <th>INSTRUCTOR</th>
                                    <th>Section</th>
                                    <th>Room</th>
                                    <th></th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $courses = getData::getCourseSchedule($stdID);
                                    echo "<form>";
                                    foreach ($courses as $course) {
                                        echo "<tr>";
                                        echo "<td>" . $course->getId() . "</td>";
                                        echo "<td>" . $course->getName() . "</td>";
                                        echo "<td>" . $course->getInstructor() . "</td>";
                                        echo "<td>" . $course->getSection() . "</td>";
                                        echo "<td>" . $course->getRoom() . "</td>";
                                        echo "<td></td>";
                                        if (strpos($course->getDays(), 'SAT') !== false) {
                                            echo "<td>" . $course->getTime() . "</td>";
                                        } else {
                                            echo "<td></td>";
                                        };
                                        if (strpos($course->getDays(), 'SUN') !== false) {
                                            echo "<td>" . $course->getTime() . "</td>";
                                        } else {
                                            echo "<td></td>";
                                        };
                                        if (strpos($course->getDays(), 'MON') !== false) {
                                            echo "<td>" . $course->getTime() . "</td>";
                                        } else {
                                            echo "<td></td>";
                                        };
                                        if (strpos($course->getDays(), 'TUE') !== false) {
                                            echo "<td>" . $course->getTime() . "</td>";
                                        } else {
                                            echo "<td></td>";
                                        };
                                        if (strpos($course->getDays(), 'WED') !== false) {
                                            echo "<td>" . $course->getTime() . "</td>";
                                        } else {
                                            echo "<td></td>";
                                        };
                                        echo "</tr>";
                                    }
                                    echo "</form>";
                                    ?>
                                    </tbody>
                                </table>

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