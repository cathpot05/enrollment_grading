-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2018 at 01:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enrollment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `encoder`
--

CREATE TABLE `encoder` (
  `ID` int(11) NOT NULL,
  `employeeNo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_student`
--

CREATE TABLE `enrolled_student` (
  `ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `sy_level_section_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `ID` int(11) NOT NULL,
  `enrolled_student_ID` int(11) NOT NULL,
  `teacher_section_subject_ID` int(11) NOT NULL,
  `q1` float NOT NULL,
  `q2` float NOT NULL,
  `q3` float NOT NULL,
  `q4` float NOT NULL,
  `final` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_actions`
--

CREATE TABLE `grade_actions` (
  `ID` int(11) NOT NULL,
  `grade_ID` int(11) NOT NULL,
  `actionType` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(11) NOT NULL DEFAULT '0',
  `q1` float NOT NULL,
  `q2` float NOT NULL,
  `q3` float NOT NULL,
  `q4` float NOT NULL,
  `final` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_sched`
--

CREATE TABLE `grade_sched` (
  `ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `ID` int(11) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`ID`, `level`) VALUES
(1, 'Grade 7'),
(2, 'Grade 8'),
(3, 'Grade 9'),
(4, 'Grade 10');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `ID` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `userType` varchar(15) NOT NULL,
  `logType` varchar(20) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`ID`, `user`, `userType`, `logType`, `Date`) VALUES
(1, 'admin', 'Admin', 'Added New SchoolYear', '2018-04-11 13:46:39'),
(2, 'admin', 'Admin', 'Logged in', '2018-04-12 09:57:36'),
(3, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:28:45'),
(4, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:31:01'),
(5, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:34:25'),
(6, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:41:29'),
(7, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:43:19'),
(8, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:44:09'),
(9, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:50:43'),
(10, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:52:15'),
(11, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:53:56'),
(12, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:56:00'),
(13, 'admin', 'Admin', 'Added new Student', '2018-04-12 16:59:17'),
(14, 'admin', 'Admin', 'Added new Student', '2018-04-12 17:01:53'),
(15, 'admin', 'Admin', 'Added new Student', '2018-04-12 17:14:13'),
(16, 'admin', 'Admin', 'Added new Student', '2018-04-12 17:20:14'),
(17, 'admin', 'Admin', 'Logged out', '2018-04-12 17:20:16'),
(18, 'admin', 'Admin', 'Logged in', '2018-04-13 08:22:37'),
(19, 'admin', 'Admin', 'Added new Student', '2018-04-13 08:24:18'),
(20, 'admin', 'Admin', 'Added New SchoolYear', '2018-04-13 08:26:47'),
(21, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:58:26'),
(22, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:58:29'),
(23, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:58:30'),
(24, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:25'),
(25, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:26'),
(26, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:27'),
(27, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:28'),
(28, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:28'),
(29, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:29'),
(30, 'admin', 'Admin', 'Edited Student', '2018-04-13 09:59:29'),
(31, 'admin', 'Admin', 'Edited new Student', '2018-04-13 11:54:42'),
(32, 'admin', 'Admin', 'Edited new Student', '2018-04-13 11:54:53'),
(33, 'admin', 'Admin', 'Edited new Student', '2018-04-13 11:55:11'),
(34, 'admin', 'Admin', 'Edited new Student', '2018-04-13 11:55:32'),
(35, 'admin', 'Admin', 'Logged in', '2018-04-13 12:45:45'),
(36, 'admin', 'Admin', 'Deleted Student', '2018-04-13 12:51:22'),
(37, 'admin', 'Admin', 'Deleted Student', '2018-04-13 12:51:26'),
(38, 'admin', 'Admin', 'Edited new Student', '2018-04-13 12:51:35'),
(39, 'admin', 'Admin', 'Deleted Student', '2018-04-13 12:51:39'),
(40, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 14:39:03'),
(41, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 14:39:13'),
(42, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 14:39:22'),
(43, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 14:43:44'),
(44, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 15:06:25'),
(45, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 15:09:33'),
(46, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 15:09:55'),
(47, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 15:10:01'),
(48, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 16:24:10'),
(49, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 16:24:19'),
(50, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 16:24:32'),
(51, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 16:24:49'),
(52, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 16:24:58'),
(53, 'admin', 'Admin', 'Changed Password (St', '2018-04-13 16:25:10'),
(54, 'admin', 'Admin', 'Logged in', '2018-04-14 08:36:32'),
(55, 'admin', 'Admin', 'Changed Password (St', '2018-04-14 09:18:39'),
(56, 'admin', 'Admin', 'Changed Password (St', '2018-04-14 09:18:54'),
(57, 'admin', 'Admin', 'Changed Password (St', '2018-04-14 09:19:07'),
(58, 'admin', 'Admin', 'Logged out', '2018-04-14 09:19:26'),
(59, 'ivan ivan', 'Student', 'Logged out', '2018-04-14 09:19:39'),
(60, 'admin', 'Admin', 'Logged in', '2018-04-14 09:19:43'),
(61, 'admin', 'Admin', 'Changed Password (St', '2018-04-14 09:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `ID` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `section` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `LRN` varchar(30) NOT NULL,
  `classification` varchar(20) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nameMother` varchar(100) NOT NULL,
  `contactMother` varchar(15) NOT NULL,
  `occupationMother` varchar(30) NOT NULL,
  `nameFather` varchar(100) NOT NULL,
  `contactFather` varchar(15) NOT NULL,
  `occupationFather` varchar(30) NOT NULL,
  `nameGuardian` varchar(100) NOT NULL,
  `contactGuardian` varchar(15) NOT NULL,
  `prevSchool` varchar(100) NOT NULL,
  `prevSY` varchar(20) NOT NULL,
  `prevLevel` varchar(10) NOT NULL,
  `average` float NOT NULL,
  `docs` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `username`, `password`, `Fname`, `Lname`, `Mname`, `LRN`, `classification`, `religion`, `address`, `contactno`, `birthdate`, `age`, `gender`, `nameMother`, `contactMother`, `occupationMother`, `nameFather`, `contactFather`, `occupationFather`, `nameGuardian`, `contactGuardian`, `prevSchool`, `prevSY`, `prevLevel`, `average`, `docs`, `remarks`, `dateCreated`) VALUES
(1, 'ivan2', '2c42e5cf1cdbafea04ed267018ef1511', 'ivan', 'ivan', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'Male', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '', '', 'ivan', 'ivan', 'ivan', 90, 'BC,F138,F137,GMC,', 'ivan', '2018-04-12 00:00:00'),
(2, 'ivan123', '3847820138564525205299f1f444c5ec', 'ivan', 'ivan', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'on', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 90, '0', 'ivan', '2018-04-12 00:00:00'),
(3, 'ivan', '2c42e5cf1cdbafea04ed267018ef1511', 'ivan', 'ivan', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'on', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 90, '0', 'ivan', '2018-04-12 00:00:00'),
(4, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'john', 'john', 'john', 'jjlk', 'new', 'aw', 'awr', 'awr', '2007-10-14', 10, 'on', 'jhgk', 'nbm,', 'bhvm,', 'nb', 'mn', 'mnb', 'bm', 'jhkj', 'jh', 'kjh', 'n', 90, '0', 'awat', '2018-04-12 00:00:00'),
(5, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'john', 'john', 'john', 'jjlk', 'new', 'aw', 'awr', 'awr', '2007-10-14', 10, 'on', 'jhgk', 'nbm,', 'bhvm,', 'nb', 'mn', 'mnb', 'bm', 'jhkj', 'jh', 'kjh', 'n', 90, '000', 'awat', '2018-04-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `ID` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `subject` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `summer`
--

CREATE TABLE `summer` (
  `ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `summer_enrolled`
--

CREATE TABLE `summer_enrolled` (
  `ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `summer_grade`
--

CREATE TABLE `summer_grade` (
  `ID` int(11) NOT NULL,
  `summer_enrolled_ID` int(11) NOT NULL,
  `grade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `summer_grade_sched`
--

CREATE TABLE `summer_grade_sched` (
  `ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `summer_subject`
--

CREATE TABLE `summer_subject` (
  `ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `ID` int(11) NOT NULL,
  `schoolYear` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sy`
--

INSERT INTO `sy` (`ID`, `schoolYear`) VALUES
(1, '2018-2019'),
(2, '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `sy_level`
--

CREATE TABLE `sy_level` (
  `ID` int(11) NOT NULL,
  `sy_ID` int(11) NOT NULL,
  `level_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sy_level`
--

INSERT INTO `sy_level` (`ID`, `sy_ID`, `level_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sy_level_section`
--

CREATE TABLE `sy_level_section` (
  `ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL,
  `section_ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sy_level_subject`
--

CREATE TABLE `sy_level_subject` (
  `ID` int(11) NOT NULL,
  `sy_level_ID` int(11) NOT NULL,
  `subject_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `ID` int(11) NOT NULL,
  `employeeNo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_section_subject`
--

CREATE TABLE `teacher_section_subject` (
  `ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `sy_level_subject_ID` int(11) NOT NULL,
  `sy_level_section_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enrolled_student`
--
ALTER TABLE `enrolled_student`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `student_ID` (`student_ID`),
  ADD KEY `sy_section_ID` (`sy_level_section_ID`),
  ADD KEY `student_ID_2` (`student_ID`,`sy_level_section_ID`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `enrolled_student_ID` (`enrolled_student_ID`,`teacher_section_subject_ID`),
  ADD KEY `SY_section_subject_ID` (`teacher_section_subject_ID`);

--
-- Indexes for table `grade_actions`
--
ALTER TABLE `grade_actions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `grade_ID` (`grade_ID`);

--
-- Indexes for table `grade_sched`
--
ALTER TABLE `grade_sched`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `summer`
--
ALTER TABLE `summer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `summer_enrolled`
--
ALTER TABLE `summer_enrolled`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `summer_grade`
--
ALTER TABLE `summer_grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `summer_grade_sched`
--
ALTER TABLE `summer_grade_sched`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `summer_subject`
--
ALTER TABLE `summer_subject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sy`
--
ALTER TABLE `sy`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sy_level`
--
ALTER TABLE `sy_level`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sy_level_section`
--
ALTER TABLE `sy_level_section`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sy_level_subject`
--
ALTER TABLE `sy_level_subject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `employeeNo` (`employeeNo`);

--
-- Indexes for table `teacher_section_subject`
--
ALTER TABLE `teacher_section_subject`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `enrolled_student`
--
ALTER TABLE `enrolled_student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade_actions`
--
ALTER TABLE `grade_actions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade_sched`
--
ALTER TABLE `grade_sched`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `summer`
--
ALTER TABLE `summer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `summer_enrolled`
--
ALTER TABLE `summer_enrolled`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `summer_grade`
--
ALTER TABLE `summer_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `summer_grade_sched`
--
ALTER TABLE `summer_grade_sched`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `summer_subject`
--
ALTER TABLE `summer_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sy`
--
ALTER TABLE `sy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sy_level`
--
ALTER TABLE `sy_level`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sy_level_section`
--
ALTER TABLE `sy_level_section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sy_level_subject`
--
ALTER TABLE `sy_level_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_section_subject`
--
ALTER TABLE `teacher_section_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
