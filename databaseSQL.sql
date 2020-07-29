-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 07:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hours` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `hours`) VALUES
(1, 'Calculus A', 3),
(2, 'Calculus B', 4),
(3, 'Data Structure', 3),
(4, 'Programming 1', 3),
(5, 'Web Programming 1', 3),
(6, 'Introduction To Computing', 2),
(7, 'Discrete Mathematics', 3),
(8, 'Programming 2', 3),
(9, 'Programming 1 lab', 1),
(10, 'Programming 2 lab', 1),
(11, 'Programming 3', 1),
(12, 'Programming 3 Lab', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `faculty`) VALUES
(1, 'Basem', 'IT'),
(2, 'Ashraf', 'IT'),
(3, 'Ehab', 'ENG'),
(4, 'Ahmad', 'SC');

-- --------------------------------------------------------

--
-- Table structure for table `registered_courses`
--

CREATE TABLE `registered_courses` (
  `Student_id` int(10) NOT NULL,
  `Semester_Course_id` int(10) NOT NULL,
  `grade` double NOT NULL DEFAULT '40'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_courses`
--

INSERT INTO `registered_courses` (`Student_id`, `Semester_Course_id`, `grade`) VALUES
(120170297, 2, 97),
(120170297, 5, 92),
(120170297, 7, 85),
(120170297, 9, 89);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(10) NOT NULL,
  `year` int(10) DEFAULT NULL,
  `semester` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `year`, `semester`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2),
(7, 4, 1),
(8, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `semester_course`
--

CREATE TABLE `semester_course` (
  `id` int(10) NOT NULL,
  `Instructor_id` int(10) DEFAULT NULL,
  `Time_Table_id` int(10) DEFAULT NULL,
  `Course_id` int(10) DEFAULT NULL,
  `Semester_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester_course`
--

INSERT INTO `semester_course` (`id`, `Instructor_id`, `Time_Table_id`, `Course_id`, `Semester_id`) VALUES
(1, 1, 1, 4, 1),
(2, 2, 1, 7, 1),
(4, 1, 4, 5, 4),
(5, 2, 3, 1, 1),
(6, 1, 2, 8, 4),
(7, 1, 4, 11, 4),
(8, 4, 2, 12, 4),
(9, 2, 2, 2, 5),
(13, 4, 2, 9, 1),
(14, 3, 4, 6, 1),
(15, 4, 1, 10, 4),
(16, 1, 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gpa` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `phone`, `password`, `gpa`) VALUES
(120170297, 'Ahmad Faroukh', 'ahmad@email.com', 598347573, '5f4dcc3b5aa765d61d8327deb882cf99', 92.5),
(120170299, 'admin', 'admin@email.com', 590000000, '21232f297a57a5a743894a0e4a801fc3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE `time_table` (
  `id` int(10) NOT NULL,
  `Section_no` int(10) DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`id`, `Section_no`, `days`, `time`, `room`) VALUES
(1, 101, 'SAT-MON-WED', '9:00-10:00', 'I318'),
(2, 102, 'SUN-TUE', '12:30-14:00', 'K301'),
(3, 103, 'SUN-TUE', '14:00-15:00', 'K301'),
(4, 104, 'SAT-MON-WED', '8:00-9:00', 'I116');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD PRIMARY KEY (`Student_id`,`Semester_Course_id`),
  ADD KEY `FKRegistered829243` (`Student_id`),
  ADD KEY `FKRegistered52747` (`Semester_Course_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester_course`
--
ALTER TABLE `semester_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKSemester_C416517` (`Time_Table_id`),
  ADD KEY `FKSemester_C715318` (`Instructor_id`),
  ADD KEY `FKSemester_C126293` (`Semester_id`),
  ADD KEY `FKSemester_C2205` (`Course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_table`
--
ALTER TABLE `time_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `semester_course`
--
ALTER TABLE `semester_course`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120170300;

--
-- AUTO_INCREMENT for table `time_table`
--
ALTER TABLE `time_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD CONSTRAINT `FKRegistered52747` FOREIGN KEY (`Semester_Course_id`) REFERENCES `semester_course` (`id`),
  ADD CONSTRAINT `FKRegistered829243` FOREIGN KEY (`Student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `semester_course`
--
ALTER TABLE `semester_course`
  ADD CONSTRAINT `FKSemester_C126293` FOREIGN KEY (`Semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `FKSemester_C2205` FOREIGN KEY (`Course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `FKSemester_C416517` FOREIGN KEY (`Time_Table_id`) REFERENCES `time_table` (`id`),
  ADD CONSTRAINT `FKSemester_C715318` FOREIGN KEY (`Instructor_id`) REFERENCES `instructors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
