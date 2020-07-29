<?php
    include_once('../Controller/connection.php');
    include_once('../model/Semester_Course.php');

    class getData{

        public static function getGrades($id){
            $connection = DBConnection::get_instance()->get_connection();
            $grades = array();
            $sql = "SELECT * from registered_courses 
                    INNER JOIN semester_course on semester_course.id = registered_courses.Semester_Course_id
                    INNER JOIN course on semester_course.Course_id = course.id
                    INNER JOIN time_table on semester_course.Time_Table_id = time_table.id
                    INNER JOIN instructors on semester_course.Instructor_id = instructors.id
                    INNER JOIN semester on semester_course.Semester_id = semester.id
                    WHERE registered_courses.Student_id = $id";

            $result = mysqli_query($connection, $sql);

            if ($result!=false) {
                if (mysqli_num_rows($result)>0) {
                    $totalHours = 0 ;
                    $gradeTotal = 0 ;
                    while ($row = mysqli_fetch_row($result)) {
                        $courseGrade = array();
                        $courseGrade['id'] = $row[1] ;
                        $courseGrade['course'] = $row[9] ;
                        $courseGrade['hours'] = $row[10] ;
                        $courseGrade['grade'] = $row[2] ;

                        $gradeTotal = $gradeTotal + $row[10]*$row[2];
                        $totalHours = $totalHours + $row[10];
                        array_push($grades,$courseGrade);
                    }
                    $gradeTotal = $gradeTotal/$totalHours ;
                    $gpa= number_format((float)$gradeTotal, 2, '.', '');;
                    array_push($grades,$gpa);
                }
            }

            return $grades ;
        }


        public static function getRegisteredCoursesForStdID($id){
            $courses = array();
            $connection = DBConnection::get_instance()->get_connection();
            $sql = "SELECT * from registered_courses 
                            INNER JOIN semester_course on semester_course.id = registered_courses.Semester_Course_id
                            INNER JOIN course on semester_course.Course_id = course.id
                            INNER JOIN time_table on semester_course.Time_Table_id = time_table.id
                            INNER JOIN instructors on semester_course.Instructor_id = instructors.id
                            INNER JOIN semester on semester_course.Semester_id = semester.id
                            WHERE registered_courses.Student_id = $id";

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

            return $courses;
        }



        public static function getSemesterGrades($id,$year,$sem){
            $connection = DBConnection::get_instance()->get_connection();
            $grades = array();
            $sql = "select registered_courses.Semester_Course_id,course.hours, registered_courses.grade ,
                    course.name , semester.year as year , semester.semester as semester
                    FROM registered_courses , course , semester_course , semester WHERE
                    registered_courses.Student_id = $id
                    AND
                    semester_course.Semester_id = semester.id
                    AND
                    registered_courses.Semester_Course_id = semester_course.id
                    AND
                    course.id = semester_course.Course_id
                    And 
                    semester.semester =$sem
                    AND semester.year =$year";

            $result = mysqli_query($connection, $sql);

            if ($result!=false) {
                if (mysqli_num_rows($result)>0) {
                    $totalHours = 0 ;
                    $gradeTotal = 0 ;
                    while ($row = mysqli_fetch_row($result)) {
                        $courseGrade = array();
                        $courseGrade['id'] = $row[0] ;
                        $courseGrade['course'] = $row[3] ;
                        $courseGrade['hours'] = $row[1] ;
                        $courseGrade['grade'] = $row[2] ;

                        $gradeTotal = $gradeTotal + $row[1]*$row[2];
                        $totalHours = $totalHours + $row[1];
                        array_push($grades,$courseGrade);
                    }
                    $gradeTotal = $gradeTotal/$totalHours ;
                    $gpa= number_format((float)$gradeTotal, 2, '.', '');;
                    array_push($grades,$gpa);
                }
            }

            return $grades ;
        }


        public static function getCoursesForSemester($sem){
            $courses = array();
            $connection = DBConnection::get_instance()->get_connection();
            $sql = "SELECT * from semester_course 
                  INNER JOIN course on semester_course.Course_id = course.id
                   INNER JOIN time_table on semester_course.Time_Table_id = time_table.id
                    INNER JOIN instructors on semester_course.Instructor_id = instructors.id
                    INNER JOIN semester on semester_course.Semester_id = semester.id 
                    where semester.semester = $sem ORDER BY course.name ";

            $result = mysqli_query($connection, $sql);

            if ($result!=false) {
                if (mysqli_num_rows($result)>0) {
                    while ($row = mysqli_fetch_row($result)) {
                        $course = new Semester_Course;
                        $course->setId($row[0]) ;
                        $course->setName($row[6]) ;
                        $course->setYear($row[17]) ;
                        $course->setSection($row[9]) ;
                        $course->setDays($row[10]) ;
                        $course->setTime($row[11]) ;
                        $course->setRoom($row[12]) ;
                        $course->setInstructor($row[14]) ;
                        array_push($courses,$course);
                    }
                }
            }

            return $courses;
        }

        public static function getCourseSchedule($id){
            $courses = array();
            $connection = DBConnection::get_instance()->get_connection();
            $sql = "SELECT * from registered_courses 
                    INNER JOIN semester_course on semester_course.id = registered_courses.Semester_Course_id
                    INNER JOIN course on semester_course.Course_id = course.id
                    INNER JOIN time_table on semester_course.Time_Table_id = time_table.id
                    INNER JOIN instructors on semester_course.Instructor_id = instructors.id
                    INNER JOIN semester on semester_course.Semester_id = semester.id
                    WHERE registered_courses.Student_id = $id";

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

            return $courses;
        }



        public static function getCourseInfo($courseID){
            $connection = DBConnection::get_instance()->get_connection();
            $sql = "SELECT * from semester_course 
                  INNER JOIN course on semester_course.Course_id = course.id
                   INNER JOIN time_table on semester_course.Time_Table_id = time_table.id
                    INNER JOIN instructors on semester_course.Instructor_id = instructors.id
                    INNER JOIN semester on semester_course.Semester_id = semester.id 
                    where semester_course.id = $courseID";

            $result = mysqli_query($connection, $sql);
            $course = array();
            if ($result!=false) {
                if (mysqli_num_rows($result)>0) {
                    while ($row = mysqli_fetch_row($result)) {
                        $course = new Semester_Course;
                        $course->setId($row[1]) ;
                        $course->setName($row[6]) ;
                        $course->setSection($row[9]) ;
                        $course->setDays($row[10]) ;
                        $course->setTime($row[11]) ;
                        $course->setRoom($row[12]) ;
                        $course->setInstructor($row[14]) ;
                    }
                }
            }

            return $course;
        }



    }



?>
