-- Database: `enrollment_db` --
-- Table `admin` --
CREATE TABLE `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'pdfmnhs_admin', '474ebb16d8db1e852dfebbec83bfdc16');

-- Table `student` --
CREATE TABLE `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `address` varchar(45) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `bday` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `genAvg` float NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `student` (`ID`, `username`, `password`, `Fname`, `Lname`, `Mname`, `address`, `religion`, `phoneNo`, `bday`, `age`, `gender`, `genAvg`, `dateCreated`) VALUES
(2, 'S2000667920', '3489b909418aec96e54689274211bf1a', 'Daryl', 'Saunders', 'Yu', 'Alaminos, Laguna', 'Catolic', '+639106699376', '2005-03-18', 12, 'Male', '89', '2017-03-24 10:27:09'),
(3, 'S2000798823', '3489b909418aec96e54689274211bf1a', 'Frederick', 'Blair', 'Santos', 'San Pablo City, Laguna', 'Catolic', '+639270355901', '2005-08-25', 11, 'Male', '82.5', '2017-03-24 10:29:58'),
(4, 'S2000993591', '3489b909418aec96e54689274211bf1a', 'Marion', 'Flores', 'Boston', 'San Pablo City, Laguna', 'Catolic', '+639457822100', '2005-02-16', 12, 'Male', '85.6', '2017-03-24 10:31:44'),
(5, 'S2001895731', '3489b909418aec96e54689274211bf1a', 'Shawn', 'Lewis', 'Chavez', 'San Pablo City, Laguna', 'Catolic', '+639087891749', '2006-07-13', 11, 'Male', '89.9', '2017-03-24 10:34:16'),
(6, 'S2017108967', '3489b909418aec96e54689274211bf1a', 'Dana', 'Bowers', 'Soto', 'San Pablo City, Laguna', 'Catolic', '+6397849206673', '2006-07-13', 11, 'Female', '80.7', '2017-03-24 10:36:43');

-- Table `sy` --
CREATE TABLE `sy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolYear` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `sy` (`ID`, `schoolYear`) VALUES
(1, '2000-2001'),
(3, '2000-2000');

-- Table `section` --
CREATE TABLE `section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  `section` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO `section` (`ID`, `year`, `section`) VALUES
(1, '1', 'A'),
(2, '1', 'B'),
(3, '1', 'C'),
(4, '1', 'D'),
(5, '1', 'E'),
(6, '2', 'A'),
(7, '2', 'B'),
(8, '2', 'C'),
(9, '2', 'D'),
(11, '3', 'B'),
(12, '3', 'C'),
(13, '3', 'D'),
(14, '3', 'E'),
(15, '4', 'A'),
(16, '4', 'B'),
(17, '4', 'C'),
(19, 'Grade 11', 'asfafasdfsaf');

-- Table `teacher` --
CREATE TABLE `teacher` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeNo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `employeeNo` (`employeeNo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `teacher` (`ID`, `employeeNo`, `password`, `Lname`, `Fname`, `Mname`, `contactNo`, `dateCreated`) VALUES
(1, 'E2000112811', '6a4c692a7ba12da347c0d0b489af187d', 'Rivera', 'Jonny', 'Gomez', '+639384619935', '2017-03-24 10:17:18'),
(2, 'E2000281988', '6a4c692a7ba12da347c0d0b489af187d', 'Reed', 'Ebony', 'Panem', '+639078391458', '2017-03-24 11:00:16'),
(3, 'E2000259808', '6a4c692a7ba12da347c0d0b489af187d', 'Ellis', 'Brenda', 'Cortez', '+639056839112', '2017-03-24 11:01:17'),
(4, 'E2001908832', '6a4c692a7ba12da347c0d0b489af187d', 'Ross', 'Van', 'Santos', '+639603384011', '2017-03-24 11:03:01'),
(6, 'E2001890213', '6a4c692a7ba12da347c0d0b489af187d', 'Soto', 'June', 'Rivera', '+639456183348', '2017-03-24 11:05:04');

-- Table `subject` --
CREATE TABLE `subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `subject` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO `subject` (`ID`, `code`, `subject`) VALUES
(2, 'ALGB1', 'Algebra 1'),
(3, 'INTSCI', 'Integrated Science'),
(4, 'ENGL1', 'English 1'),
(5, 'PHHIS', 'Philippine History'),
(6, 'FLPN2', 'Filipino 2'),
(7, 'ALGB2', 'Algebra 2'),
(8, 'BIOLGY', 'Biology'),
(9, 'ENGL2', 'English 2'),
(10, 'ASHIS', 'Asian History'),
(11, 'FLPN3', 'Filipino 3'),
(12, 'GEOME3', 'Geometry'),
(13, 'CHEMS3', 'Chemistry'),
(14, 'WRLDHIS', 'World History'),
(15, 'GEOGP', 'Geography'),
(16, 'FLPN4', 'Filipino 4'),
(17, 'CALCU', 'Calculus'),
(18, 'TRGNM3', 'Trigonometry'),
(19, 'PHYSCS', 'Physics'),
(20, 'LTRTR', 'Literature'),
(21, 'ECONMC', 'Economics');

-- Table `sy_section` --
CREATE TABLE `sy_section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_ID` int(11) NOT NULL,
  `section_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `sy_ID` (`sy_ID`,`section_ID`),
  KEY `sy_section_ibfk_2` (`section_ID`),
  CONSTRAINT `sy_section_ibfk_1` FOREIGN KEY (`sy_ID`) REFERENCES `sy` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `sy_section_ibfk_2` FOREIGN KEY (`section_ID`) REFERENCES `section` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `enrolled_student` --
CREATE TABLE `enrolled_student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `student_ID` int(11) NOT NULL,
  `sy_section_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `student_ID` (`student_ID`),
  KEY `sy_section_ID` (`sy_section_ID`),
  KEY `student_ID_2` (`student_ID`,`sy_section_ID`),
  CONSTRAINT `enrolled_student_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `student` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `enrolled_student_ibfk_2` FOREIGN KEY (`sy_section_ID`) REFERENCES `sy_section` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `sy_section_subject` --
CREATE TABLE `sy_section_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `subject_ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `sy_section_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `subject_ID` (`subject_ID`,`teacher_ID`,`sy_section_ID`),
  KEY `teacher_ID` (`teacher_ID`),
  KEY `sy_section_ID` (`sy_section_ID`),
  CONSTRAINT `sy_section_subject_ibfk_1` FOREIGN KEY (`subject_ID`) REFERENCES `subject` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `sy_section_subject_ibfk_2` FOREIGN KEY (`teacher_ID`) REFERENCES `teacher` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `sy_section_subject_ibfk_3` FOREIGN KEY (`sy_section_ID`) REFERENCES `sy_section` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `grade` --
CREATE TABLE `grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `enrolled_student_ID` int(11) NOT NULL,
  `SY_section_subject_ID` int(11) NOT NULL,
  `q1` float NOT NULL,
  `q2` float NOT NULL,
  `q3` float NOT NULL,
  `q4` float NOT NULL,
  `final` float NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `enrolled_student_ID` (`enrolled_student_ID`,`SY_section_subject_ID`),
  KEY `SY_section_subject_ID` (`SY_section_subject_ID`),
  CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`enrolled_student_ID`) REFERENCES `enrolled_student` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`SY_section_subject_ID`) REFERENCES `sy_section_subject` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `grade_actions` --
CREATE TABLE `grade_actions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `grade_ID` int(11) NOT NULL,
  `actionType` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(11) NOT NULL DEFAULT '0',
  `q1` float NOT NULL,
  `q2` float NOT NULL,
  `q3` float NOT NULL,
  `q4` float NOT NULL,
  `final` float NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `grade_ID` (`grade_ID`),
  CONSTRAINT `grade_actions_ibfk_1` FOREIGN KEY (`grade_ID`) REFERENCES `grade` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `log` --
CREATE TABLE `log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `userType` varchar(15) NOT NULL,
  `logType` varchar(20) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

INSERT INTO `log` (`ID`, `user`, `userType`, `logType`, `Date`) VALUES
(1, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:07:30'),
(2, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:07:38'),
(3, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:16:26'),
(4, ' Saunders', 'Student', 'login', '2017-05-13 13:16:35'),
(5, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:16:54'),
(6, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:18:17'),
(7, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:18:43'),
(8, ' Saunders', 'Student', 'login', '2017-05-13 13:19:13'),
(9, ' Rivera', 'Teacher', 'login', '2017-05-13 13:19:28'),
(10, ' Rivera', 'Teacher', 'login', '2017-05-13 13:21:44'),
(11, 'Jonny Rivera', 'Teacher', 'login', '2017-05-13 13:24:35'),
(12, 'Jonny Rivera', 'Teacher', 'login', '2017-05-13 13:25:31'),
(13, 'Jonny Rivera', 'Teacher', 'login', '2017-05-13 13:26:48'),
(14, 'Jonny Rivera', 'Teacher', 'logout', '2017-05-13 13:26:50'),
(15, 'Daryl Saunders', 'Student', 'login', '2017-05-13 13:28:32'),
(16, 'Daryl Saunders', 'Student', 'logout', '2017-05-13 13:28:33'),
(17, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:48:11'),
(18, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:56:18'),
(19, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:56:22'),
(20, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:56:30'),
(21, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:56:37'),
(22, 'Jonny Rivera', 'Teacher', 'login', '2017-05-13 13:56:46'),
(23, 'Jonny Rivera', 'Teacher', 'logout', '2017-05-13 13:56:47'),
(24, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:57:01'),
(25, 'Daryl Saunders', 'Student', 'login', '2017-05-13 13:58:12'),
(26, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:58:25'),
(27, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:58:33'),
(28, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 13:59:28'),
(29, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 13:59:36'),
(30, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 14:00:18'),
(31, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 14:00:36'),
(32, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 14:01:26'),
(33, 'Daryl Saunders', 'Student', 'logout', '2017-05-13 14:06:35'),
(34, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 14:10:34'),
(35, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-13 14:10:43'),
(36, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-13 14:11:45'),
(37, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-15 10:41:16'),
(38, 'Jonny Rivera', 'Teacher', 'login', '2017-05-15 14:05:55'),
(39, 'Daryl Saunders', 'Student', 'login', '2017-05-15 14:06:24'),
(40, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-15 16:05:14'),
(41, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-16 08:57:59'),
(42, 'pdfmnhs_admin', 'Admin', 'logout', '2017-05-16 09:03:24'),
(43, 'pdfmnhs_admin', 'Admin', 'login', '2017-05-16 09:03:30'),
(44, 'pdfmnhs_admin', 'Admin', 'login', '2017-06-14 12:36:45'),
(45, 'pdfmnhs_admin', 'Admin', 'Added new Section', '2017-06-14 12:52:00'),
(46, 'pdfmnhs_admin', 'Admin', 'Added New School Yea', '2017-06-14 12:57:56'),
(47, 'pdfmnhs_admin', 'Admin', 'Edited School Year', '2017-06-14 12:58:02'),
(48, 'pdfmnhs_admin', 'Admin', 'Deleted School Year', '2017-06-14 12:58:06'),
(49, 'pdfmnhs_admin', 'Admin', 'Deleted Section', '2017-06-14 12:58:33'),
(50, 'pdfmnhs_admin', 'Admin', 'Edited Section', '2017-06-14 12:58:45'),
(51, 'pdfmnhs_admin', 'Admin', 'Added New Subject', '2017-06-14 12:58:55'),
(52, 'pdfmnhs_admin', 'Admin', 'Edited Subject', '2017-06-14 12:59:13'),
(53, 'pdfmnhs_admin', 'Admin', 'Deleted Subject', '2017-06-14 12:59:17'),
(54, 'pdfmnhs_admin', 'Admin', 'Added New Teacher', '2017-06-14 12:59:32'),
(55, 'pdfmnhs_admin', 'Admin', 'Edited Teacher', '2017-06-14 12:59:38'),
(56, 'pdfmnhs_admin', 'Admin', 'Deleted Teacher', '2017-06-14 12:59:40'),
(57, 'pdfmnhs_admin', 'Admin', 'Added new Student', '2017-06-14 13:00:06'),
(58, 'pdfmnhs_admin', 'Admin', 'Edited Student', '2017-06-14 13:00:14'),
(59, 'pdfmnhs_admin', 'Admin', 'Deleted Student', '2017-06-14 13:00:17'),
(60, 'pdfmnhs_admin', 'Admin', 'Added New SchoolYear', '2017-06-14 13:01:54'),
(61, 'pdfmnhs_admin', 'Admin', 'Logged in', '2017-06-16 09:30:17');

