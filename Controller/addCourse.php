<?php
    session_start();
    include_once('../Controller/connection.php');
    include_once('../Controller/databaseData.php');
    $response = array("status" => "false","message" => "");

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $stdID = $_POST['student_id'];
        $courseID = $_POST['course_id'];
        $result = false ;
        $conflict = false;
        $alreadyRegistered= false ;


        $registeredCourses = getData::getRegisteredCoursesForStdID($stdID);
        $newCourse = getData::getCourseInfo($courseID);

        foreach ($registeredCourses as $registeredCourse){
            if (   $registeredCourse->getDays() == $newCourse->getDays()
                && $registeredCourse->getTime() == $newCourse->getTime()){

                $response["status"]= "conflict" ;
                $response["message"]= "Chosen Course Conflicts with " . $registeredCourse->getName();
                $conflict= true ;
            }
        }


        if ($conflict == false){
            $query = "INSERT INTO registered_courses (Student_id,Semester_Course_id)values ('$stdID','$courseID')";
            $connection = DBConnection::get_instance()->get_connection();
            $result = mysqli_query($connection,$query);

        }


        if ($result == true){
            $response["status"]= "true" ;
            $response["message"]= "SemesterCourse Added To Schedule";
        }

    }else{
        $response["status"]= "false" ;
        $response["message"]= "Method Not Allowed";
    }

    echo json_encode($response);

?>