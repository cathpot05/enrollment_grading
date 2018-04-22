-- Database: `enrollment_db` --
-- Table `admin` --
CREATE TABLE `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`ID`, `username`, `password`, `Lname`, `Fname`, `Mname`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', 0);

-- Table `student` --
CREATE TABLE `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
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
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `student` (`ID`, `username`, `password`, `Fname`, `Lname`, `Mname`, `LRN`, `classification`, `religion`, `address`, `contactno`, `birthdate`, `age`, `gender`, `nameMother`, `contactMother`, `occupationMother`, `nameFather`, `contactFather`, `occupationFather`, `nameGuardian`, `contactGuardian`, `prevSchool`, `prevSY`, `prevLevel`, `average`, `docs`, `remarks`, `dateCreated`) VALUES
(1, 'ivan2', '2c42e5cf1cdbafea04ed267018ef1511', 'Ivans', 'Jaron', 'B', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'Male', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '', '', 'ivan', 'ivan', 'ivan', '90', 'BC,F138,F137,GMC,', 'ivan', '2018-04-12 00:00:00'),
(2, 'ivan123', '3847820138564525205299f1f444c5ec', 'Cath', 'Olaguir', 'Manguiat', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'on', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '90', '0', 'ivan', '2018-04-12 00:00:00'),
(3, 'ivan', '2c42e5cf1cdbafea04ed267018ef1511', 'Student1', 'Student1', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'Male', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '', '', 'ivan', 'ivan', 'ivan', '90', 'BC,F138,', 'ivan', '2018-04-12 00:00:00'),
(4, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'john', 'john', 'john', 'jjlk', 'new', 'aw', 'awr', 'awr', '2007-10-14', 10, 'on', 'jhgk', 'nbm,', 'bhvm,', 'nb', 'mn', 'mnb', 'bm', 'jhkj', 'jh', 'kjh', 'n', '90', '0', 'awat', '2018-04-12 00:00:00'),
(5, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'Student2', 'Student2', 'john', 'jjlk', 'new', 'aw', 'awr', 'awr', '2007-10-14', 10, 'on', 'jhgk', 'nbm,', 'bhvm,', 'nb', 'mn', 'mnb', 'bm', 'jhkj', 'jh', 'kjh', 'n', '90', '000', 'awat', '2018-04-12 00:00:00'),
(6, 'wew', '3847820138564525205299f1f444c5ec', 'Student3', 'Student3', 'gjh', ' gjk', 'new', 'jhg', 'jhgj', 'hg', '2002-09-17', 15, 'Female', 'jkh', 'hl', 'jhlkj', 'kjh', 'lkjh', 'lkjh', 'lkjh', 'kjh', 'lkjh', 'kjh', 'lkjhlkjh', '98', 'BC,F138,', 'wsehgser', '2018-04-18 00:00:00');

-- Table `sy` --
CREATE TABLE `sy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolYear` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `sy` (`ID`, `schoolYear`) VALUES
(1, '2018-2019'),
(2, '2019-2020');

-- Table `section` --
CREATE TABLE `section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  `section` varchar(15) NOT NULL,
  `level_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `section` (`ID`, `year`, `section`, `level_id`) VALUES
(1, '', 'roses', 1),
(2, '', 'sampaguita', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `teacher` (`ID`, `employeeNo`, `password`, `Lname`, `Fname`, `Mname`, `contactNo`, `dateCreated`) VALUES
(1, '1', 'c81e728d9d4c2f636f067f89cc14862c', 'Olaguir', 'Cath', 'Manguiat', '09358029816', '2018-04-15 18:10:25'),
(4, '2', 'c4ca4238a0b923820dcc509a6f75849b', 'Mugiwara', 'Luffy', 'Aa', '1', '2018-04-17 02:00:00');

-- Table `subject` --
CREATE TABLE `subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `subject` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `subject` (`ID`, `code`, `subject`) VALUES
(1, 'fil01', 'filipino'),
(2, 'eng01', 'english01');

-- Table `enrolled_student` --
CREATE TABLE `enrolled_student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `student_ID` int(11) NOT NULL,
  `sy_level_section_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `student_ID` (`student_ID`),
  KEY `sy_section_ID` (`sy_level_section_ID`),
  KEY `student_ID_2` (`student_ID`,`sy_level_section_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `enrolled_student` (`ID`, `student_ID`, `sy_level_section_ID`, `status`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 0),
(3, 1, 4, 0),
(4, 1, 4, 0);

-- Table `grade` --
CREATE TABLE `grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `enrolled_student_ID` int(11) NOT NULL,
  `teacher_section_subject_ID` int(11) NOT NULL,
  `q1` float DEFAULT NULL,
  `q2` float DEFAULT NULL,
  `q3` float DEFAULT NULL,
  `q4` float DEFAULT NULL,
  `final` float DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `enrolled_student_ID` (`enrolled_student_ID`,`teacher_section_subject_ID`),
  KEY `SY_section_subject_ID` (`teacher_section_subject_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `grade` (`ID`, `enrolled_student_ID`, `teacher_section_subject_ID`, `q1`, `q2`, `q3`, `q4`, `final`) VALUES
(1, 1, 1, '70', '70', '70', '70', ''),
(2, 2, 1, '85', '70', '85', '90', '');

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
  KEY `grade_ID` (`grade_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `log` --
CREATE TABLE `log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `userType` varchar(15) NOT NULL,
  `logType` varchar(20) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `log` (`ID`, `user`, `userType`, `logType`, `Date`) VALUES
(1, 'admin', 'Admin', 'Added New SchoolYear', '2018-04-21 12:54:47'),
(2, 'admin', 'Admin', 'Added new Section', '2018-04-21 12:55:18'),
(3, 'admin', 'Admin', 'Added new Section', '2018-04-21 12:55:27'),
(4, 'admin', 'Admin', 'Added New Subject', '2018-04-21 12:56:05'),
(5, 'admin', 'Admin', 'Added New Subject', '2018-04-21 12:56:18'),
(6, 'Luffy Mugiwara', 'Teacher', 'Logged in', '2018-04-21 13:11:34'),
(7, 'Luffy Mugiwara', 'Teacher', 'Logged in', '2018-04-21 21:11:05'),
(8, 'admin', 'Admin', 'Added New SchoolYear', '2018-04-21 22:43:03'),
(9, 'admin', 'Admin', 'Logged out', '2018-04-22 11:30:03'),
(10, 'admin', 'Admin', 'Logged in', '2018-04-22 11:30:13'),
(11, '', 'Admin', 'Update Grade Sched', '2018-04-22 12:06:05'),
(12, '', 'Admin', 'Update Grade Sched', '2018-04-22 12:11:08'),
(13, '', 'Admin', 'Added Grade Sched', '2018-04-22 12:12:24'),
(14, '', 'Admin', 'Update Grade Sched', '2018-04-22 12:12:43'),
(15, '', 'Admin', 'Update Grade Sched', '2018-04-22 12:13:08'),
(16, 'admin', 'Admin', 'Added Grade Sched', '2018-04-22 12:13:30'),
(17, 'admin', 'Admin', 'Update Grade Sched', '2018-04-22 12:13:38'),
(18, 'admin', 'Admin', 'Added Section Per SY', '2018-04-22 12:16:32'),
(19, 'admin', 'Admin', 'Added Subject Per SY', '2018-04-22 12:31:06'),
(20, 'admin', 'Admin', 'Added Summer Subject', '2018-04-22 12:31:19');

-- Table `grade_sched` --
CREATE TABLE `grade_sched` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `q1Start` date DEFAULT NULL,
  `q1End` date DEFAULT NULL,
  `q2Start` date DEFAULT NULL,
  `q2End` date DEFAULT NULL,
  `q3Start` date DEFAULT NULL,
  `q3End` date DEFAULT NULL,
  `q4Start` date DEFAULT NULL,
  `q4End` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `grade_sched` (`ID`, `sy_level_ID`, `q1Start`, `q1End`, `q2Start`, `q2End`, `q3Start`, `q3End`, `q4Start`, `q4End`) VALUES
(1, 1, '2018-04-21', '2018-04-27', '2018-04-21', '2018-04-27', '2018-04-21', '2018-04-27', '2018-04-21', '2018-04-27'),
(2, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(3, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

-- Table `level` --
CREATE TABLE `level` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `level` (`ID`, `level`) VALUES
(1, 'Grade 7'),
(2, 'Grade 8'),
(3, 'Grade 9'),
(4, 'Grade 10');

-- Table `summer_enrolled` --
CREATE TABLE `summer_enrolled` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `student_ID` int(11) NOT NULL,
  `summer_subject_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `summer_enrolled` (`ID`, `student_ID`, `summer_subject_ID`, `status`) VALUES
(5, 1, 4, 0),
(6, 1, 5, 0);

-- Table `summer_grade` --
CREATE TABLE `summer_grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `summer_enrolled_ID` int(11) NOT NULL,
  `summer_subject_ID` int(11) NOT NULL,
  `grade` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `summer_grade` (`ID`, `summer_enrolled_ID`, `summer_subject_ID`, `grade`) VALUES
(2, 6, 5, '90');

-- Table `summer_grade_sched` --
CREATE TABLE `summer_grade_sched` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `summer_grade_sched` (`ID`, `sy_level_ID`, `start`, `end`) VALUES
(1, 1, '2018-04-21 00:00:00', '2018-04-30 00:00:00');

-- Table `summer_subject` --
CREATE TABLE `summer_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `subject_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `summer_subject` (`ID`, `sy_level_ID`, `teacher_ID`, `subject_ID`) VALUES
(4, 1, 1, 1),
(5, 1, 4, 2),
(6, 5, 1, 1),
(7, 5, 1, 2);

-- Table `sy_level` --
CREATE TABLE `sy_level` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_ID` int(11) NOT NULL,
  `level_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `sy_level` (`ID`, `sy_ID`, `level_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4);

-- Table `sy_level_section` --
CREATE TABLE `sy_level_section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `section_ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `sy_level_section` (`ID`, `sy_level_ID`, `section_ID`, `teacher_ID`, `capacity`) VALUES
(1, 1, 1, 4, 2),
(2, 1, 2, 1, 1),
(3, 5, 1, 1, 10);

-- Table `teacher_section_subject` --
CREATE TABLE `teacher_section_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_ID` int(11) NOT NULL,
  `sy_level_subject_ID` int(11) NOT NULL,
  `sy_level_section_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `teacher_section_subject` (`ID`, `teacher_ID`, `sy_level_subject_ID`, `sy_level_section_ID`) VALUES
(1, 4, 1, 1),
(2, 4, 1, 2);

-- Table `encoder` --
CREATE TABLE `encoder` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeNo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

