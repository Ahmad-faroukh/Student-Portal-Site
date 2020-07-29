<?php
    session_start();
    include_once('../Controller/connection.php');
    $response = array("status" => "false","message" => "");
    $stdID = $_SESSION['std_id'];
    $courseID = $_POST['course_id'];

    if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $query = "DELETE FROM registered_courses WHERE registered_courses.Semester_Course_id = $courseID AND Student_id = $stdID";

        $connection = DBConnection::get_instance()->get_connection();
        $result = mysqli_query($connection,$query);

        if ($result != false){
            $response["status"]= "true" ;
            $response["message"]= "SemesterCourse Added To Schedule";
        }else{
            $response["message"]= "Internal Server Error";
            $response["status"]= "false" ;
        }
    }else{
        $response["message"]= "Method Not Allowed";
        $response["status"]= "false" ;
    }

    echo json_encode($response);

?>