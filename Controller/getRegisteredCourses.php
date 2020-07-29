<?php
    session_start();
    include_once ('../Controller/connection.php');
    include_once('../model/Semester_Course.php');
    $stdID = $_SESSION['std_id'];
    $courses = array();
    $connection = DBConnection::get_instance()->get_connection();
    $sql = "SELECT * from registered_courses 
                                INNER JOIN semester_course on semester_course.id = registered_courses.Semester_Course_id
                                INNER JOIN course on semester_course.Course_id = course.id
                                INNER JOIN time_table on semester_course.Time_Table_id = time_table.id
                                INNER JOIN instructors on semester_course.Instructor_id = instructors.id
                                INNER JOIN semester on semester_course.Semester_id = semester.id
                                WHERE registered_courses.Student_id = $stdID";

    $result = mysqli_query($connection, $sql);

    if ($result!=false) {
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_row($result)) {
                $course = new Semester_Course;
                $course->setId($row[1]) ;
                $course->setName($row[9]) ;
                $course->setSection($row[12]) ;
                $course->setDays($row[13]) ;
                $course->setTime($row[14]) ;
                $course->setRoom($row[15]) ;
                $course->setInstructor($row[17]) ;
                array_push($courses,$course);
            }
        }
    }

    echo json_encode($courses);

?>