<?php
    session_start();
    include_once ('../Controller/connection.php');

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

    <title>Student Portal - Withdraw</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="gray" data-image="assets/img/sidebar-2.jpg">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

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
                <li>
                    <a href="studentSchedule.php">
                        <i class="pe-7s-note2"></i>
                        <p>Course Schedule</p>
                    </a>
                </li>
                <li class="active">
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
                    <a class="navbar-brand" >Course Withdrawal</a>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="col-md-12">
                            <h4 class="title">Registered Courses</h4>
                        </div>
                    </div>


                    <div class="content table-responsive table-full-width">
                        <form>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Section</th>
                                <th>Days</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Instructor</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        </form>


                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function (e) {
                                $.ajax({
                                    url:"../controller/getRegisteredCourses.php",
                                    method:'GET' ,
                                    dataType: 'JSON',
                                    success:function (courses) {
                                        for (var i = 0; i < courses.length; i++) {
                                            $('tbody').append(
                                                '<tr>'+
                                                '<td>'+courses[i].id+'</td>'+
                                                '<td>'+courses[i].name+'</td>'+
                                                '<td>'+courses[i].section+'</td>'+
                                                '<td>'+courses[i].days+'</td>'+
                                                '<td>'+courses[i].time+'</td>'+
                                                '<td>'+courses[i].room+'</td>'+
                                                '<td>'+courses[i].instructor+'</td>'+
                                                '<td>'+'<button class="btn" type="button" id= '+ courses[i].id +' ><i class="fa fa-trash"></i></button>'+'</td>'
                                                +'</tr>'
                                            );
                                        }

                                        $('td button').click(function(e){
                                            dele($(this).attr('id'));
                                        });


                                    },
                                    error:function(data, textStatus){
                                        alert("error");
                                    }
                                });
                            });

                            function dele(courseId) {

                                    var path = "http://localhost:82/html/StudentPortal/controller/deleteCourse.php";
                                    var data = {
                                        'course_id':courseId
                                    };

                                    if (confirm("Are you sure you want to withdraw from this course")){
                                        $(this).attr("disabled", true);
                                        $.ajax({
                                            url:path,
                                            data:data,
                                            dataType:'json',
                                            method:'POST',
                                            success:function (res) {
                                                if(res.status=="true"){
                                                    $('tbody').html("");
                                                    $.ajax({
                                                        url:"../controller/getRegisteredCourses.php",
                                                        method:'GET' ,
                                                        dataType: 'JSON',
                                                        success:function (courses) {
                                                            for (var i = 0; i < courses.length; i++) {
                                                                $('tbody').append(
                                                                    '<tr>'+
                                                                    '<td>'+courses[i].id+'</td>'+
                                                                    '<td>'+courses[i].name+'</td>'+
                                                                    '<td>'+courses[i].section+'</td>'+
                                                                    '<td>'+courses[i].days+'</td>'+
                                                                    '<td>'+courses[i].time+'</td>'+
                                                                    '<td>'+courses[i].room+'</td>'+
                                                                    '<td>'+courses[i].instructor+'</td>'+
                                                                    '<td>'+'<button  class="btn" type="button" id= '+ courses[i].id +' ><i class="fa fa-trash"></i></button>'+'</td>'
                                                                    +'</tr>'
                                                                );
                                                            }

                                                            $('td button').click(function(e){
                                                                dele($(this).attr('id'));
                                                            });


                                                        },
                                                        error:function(data, textStatus){
                                                            alert("error");
                                                        }
                                                    });

                                                    swal("Success","Successfully Withdrew From This Course","success");

                                                }else if (res.status == "false") {
                                                    swal("Failed To Enroll", "Unexpected Error", "error");
                                                };
                                            },
                                            error:function (res, error) {
                                                swal("Failed To Enroll", "Unexpected Error", "error");
                                            }
                                        });
                                    }

                            }

                        </script>

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
                    &copy; <script>document.write(new Date().getFullYear())</script> , Made By Ahmad Faroukh
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>