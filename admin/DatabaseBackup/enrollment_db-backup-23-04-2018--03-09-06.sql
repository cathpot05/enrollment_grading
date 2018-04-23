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
(1, 'ivan2', '2c42e5cf1cdbafea04ed267018ef1511', 'ivan', 'ivan', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'Male', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '', '', 'ivan', 'ivan', 'ivan', '90', 'BC,F138,F137,GMC,', 'ivan', '2018-04-12 00:00:00'),
(2, 'ivan123', '3847820138564525205299f1f444c5ec', 'ivan', 'ivan', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'on', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '90', '0', 'ivan', '2018-04-12 00:00:00'),
(3, 'ivan', '2c42e5cf1cdbafea04ed267018ef1511', 'ivan', 'ivan', 'ivan', 'ivan', 'new', 'ivan', 'ivan', 'ivan', '2016-01-01', 2, 'Male', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', 'ivan', '', '', 'ivan', 'ivan', 'ivan', '90', 'BC,F138,', 'ivan', '2018-04-12 00:00:00'),
(5, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'john', 'john', 'john', 'jjlk', 'new', 'aw', 'awr', 'awr', '2007-10-14', 10, 'on', 'jhgk', 'nbm,', 'bhvm,', 'nb', 'mn', 'mnb', 'bm', 'jhkj', 'jh', 'kjh', 'n', '90', '000', 'awat', '2018-04-12 00:00:00'),
(6, 'wew', '3847820138564525205299f1f444c5ec', 'jgajh', 'sehtj', 'gjh', ' gjk', 'new', 'jhg', 'jhgj', 'hg', '2002-09-17', 15, 'Female', 'jkh', 'hl', 'jhlkj', 'kjh', 'lkjh', 'lkjh', 'lkjh', 'kjh', 'lkjh', 'kjh', 'lkjhlkjh', '98', 'BC,F138,', 'wsehgser', '2018-04-18 00:00:00');

-- Table `sy` --
CREATE TABLE `sy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolYear` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `sy` (`ID`, `schoolYear`) VALUES
(1, '2018-2019'),
(2, '2022-2023');

-- Table `section` --
CREATE TABLE `section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) NOT NULL,
  `section` varchar(15) NOT NULL,
  `level_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `section` (`ID`, `year`, `section`, `level_id`) VALUES
(1, '1', 'sampaguita', 1),
(2, '1', 'roses', 1),
(3, '2', 'narra', 2),
(4, '2', 'bamboo', 2),
(5, '3', 'francis', 3),
(6, '3', 'pedro', 3),
(7, '4', 'philippines', 4),
(8, '4', 'canada', 4),
(9, '1', 'orchids', 1),
(10, '1', 'ilang ilang', 1);

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
(1, '1', '8ba9b5f003bc16d75a9ddbc558e5e7fa', 'Olaguir', 'Cath', 'Manguiat', '09358029816', '2018-04-15 18:10:25'),
(4, '2', 'c4ca4238a0b923820dcc509a6f75849b', 'Mugiwara', 'Luffy', 'Aa', '1', '2018-04-17 02:00:00');

-- Table `subject` --
CREATE TABLE `subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `subject` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `subject` (`ID`, `code`, `subject`) VALUES
(1, 'eng07', 'filipino07'),
(2, 'eng07', 'english07');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `enrolled_student` (`ID`, `student_ID`, `sy_level_section_ID`, `status`) VALUES
(1, 1, 1, 0),
(2, 3, 5, 0),
(3, 2, 1, 0),
(4, 4, 1, 0),
(5, 5, 1, 0),
(6, 3, 6, 0),
(7, 1, 6, 0),
(8, 5, 8, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `grade` (`ID`, `enrolled_student_ID`, `teacher_section_subject_ID`, `q1`, `q2`, `q3`, `q4`, `final`) VALUES
(9, 1, 1, '71', '80', '81', '90', ''),
(10, 3, 1, '82', '71', '80', '60', ''),
(11, 2, 1, '90', '67', '88', '87', ''),
(12, 4, 1, '70', '77', '80', '60', ''),
(13, 5, 1, '89', '60', '60', '60', ''),
(14, 2, 2, '90', '', '', '', ''),
(15, 1, 2, '90', '', '', '', ''),
(16, 3, 2, '90', '', '', '', ''),
(17, 4, 2, '88', '', '', '', ''),
(18, 5, 2, '77', '', '', '', ''),
(19, 2, 3, '', '', '', '', ''),
(20, 1, 6, '70', '', '', '', ''),
(21, 3, 6, '78', '', '', '', ''),
(22, 5, 6, '90', '', '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=latin1;

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
(61, 'admin', 'Admin', 'Changed Password (St', '2018-04-14 09:20:03'),
(62, 'admin', 'Admin', 'Logged in', '2018-04-14 22:13:58'),
(63, 'admin', 'Admin', 'Added New Teacher', '2018-04-14 23:00:11'),
(64, 'admin', 'Admin', 'Added New Encoder', '2018-04-14 23:04:02'),
(65, 'admin', 'Admin', 'Edited Encoder', '2018-04-14 23:08:53'),
(66, 'admin', 'Admin', 'Added New Encoder', '2018-04-14 23:13:06'),
(67, 'admin', 'Admin', 'Added New Encoder', '2018-04-14 23:18:17'),
(68, 'admin', 'Admin', 'Added New Encoder', '2018-04-14 23:19:46'),
(69, 'admin', 'Admin', 'Deleted Encoder', '2018-04-14 23:19:54'),
(70, 'admin', 'Admin', 'Logged in', '2018-04-15 11:47:23'),
(71, 'admin', 'Admin', 'Added New SchoolYear', '2018-04-15 14:23:01'),
(72, 'admin', 'Admin', 'Logged in', '2018-04-15 14:40:18'),
(73, 'admin', 'Admin', 'Added New SchoolYear', '2018-04-15 14:50:56'),
(74, 'admin', 'Admin', 'Deleted SchoolYear', '2018-04-15 14:58:18'),
(75, 'admin', 'Admin', 'Added New Teacher', '2018-04-15 18:10:25'),
(76, 'admin', 'Admin', 'Logged in', '2018-04-16 07:42:02'),
(77, 'admin', 'Admin', 'Logged in', '2018-04-17 09:43:37'),
(78, 'admin', 'Admin', 'Logged in', '2018-04-17 14:25:03'),
(79, 'admin', 'Admin', 'Logged out', '2018-04-17 22:15:28'),
(80, 'admin', 'Admin', 'Logged in', '2018-04-17 22:15:49'),
(81, 'admin', 'Admin', 'Logged out', '2018-04-17 22:16:23'),
(82, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-17 22:16:26'),
(83, 'admin', 'Admin', 'Logged in', '2018-04-18 07:56:10'),
(84, 'admin', 'Admin', 'Logged out', '2018-04-18 07:59:22'),
(85, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-18 07:59:29'),
(86, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 14:31:23'),
(87, 'admin', 'Admin', 'Logged in', '2018-04-18 14:31:28'),
(88, 'admin', 'Admin', 'Logged out', '2018-04-18 14:31:55'),
(89, 'encoder', 'Encoder', 'Edited new Student', '2018-04-18 14:34:15'),
(90, 'encoder', 'Encoder', 'Edited new Student', '2018-04-18 14:44:05'),
(91, 'encoder', 'Encoder', 'Edited new Student', '2018-04-18 14:44:55'),
(92, 'encoder', 'Encoder', 'Edited new Student', '2018-04-18 14:51:11'),
(93, 'encoder', 'Encoder', 'Added new Student', '2018-04-18 15:00:49'),
(94, 'admin', 'Admin', 'Logged in', '2018-04-18 15:02:45'),
(95, 'admin', 'Admin', 'Changed Student Pass', '2018-04-18 15:02:58'),
(96, 'admin', 'Admin', 'Logged out', '2018-04-18 15:03:03'),
(97, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 15:03:18'),
(98, 'admin', 'Admin', 'Logged in', '2018-04-18 15:24:08'),
(99, 'admin', 'Admin', 'Logged out', '2018-04-18 15:34:23'),
(100, 'admin', 'Admin', 'Logged in', '2018-04-18 15:34:28'),
(101, 'admin', 'Admin', 'Logged out', '2018-04-18 15:34:36'),
(102, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 15:51:38'),
(103, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-18 15:51:44'),
(104, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 16:16:40'),
(105, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 16:19:04'),
(106, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 16:33:29'),
(107, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-18 16:33:33'),
(108, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 16:47:43'),
(109, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 17:14:15'),
(110, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-18 17:14:18'),
(111, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 17:14:24'),
(112, 'admin', 'Admin', 'Logged in', '2018-04-19 08:08:08'),
(113, 'admin', 'Admin', 'Logged out', '2018-04-19 08:18:31'),
(114, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-19 08:18:35'),
(115, ' ', 'Teacher', 'Dropped a student', '2018-04-19 08:18:46'),
(116, ' ', 'Teacher', 'Dropped a student', '2018-04-18 08:24:44'),
(117, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 08:28:09'),
(118, 'ivan ivan', 'Student', 'Logged out', '2018-04-19 09:19:34'),
(119, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-19 09:19:39'),
(120, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-19 09:51:06'),
(121, 'ivan ivan', 'Student', 'Logged out', '2018-04-19 09:51:20'),
(122, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-19 09:51:24'),
(123, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 09:51:48'),
(124, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 09:52:35'),
(125, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-18 09:52:39'),
(126, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 09:53:06'),
(127, 'ivan ivan', 'Student', 'Logged out', '2018-04-18 10:03:46'),
(128, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-18 10:03:49'),
(129, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-18 10:04:53'),
(130, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-19 13:26:11'),
(131, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-19 13:37:00'),
(132, 'admin', 'Admin', 'Logged in', '2018-04-23 07:59:02'),
(133, 'admin', 'Admin', 'Logged out', '2018-04-23 09:56:32'),
(134, 'Luffy Mugiwara', 'Teacher', 'Logged in', '2018-04-23 09:56:37'),
(135, 'Luffy Mugiwara', 'Teacher', 'Logged out', '2018-04-23 10:01:35'),
(136, 'admin', 'Admin', 'Logged in', '2018-04-23 10:01:42'),
(137, 'admin', 'Admin', 'Logged out', '2018-04-23 10:04:32'),
(138, 'Luffy Mugiwara', 'Teacher', 'Logged in', '2018-04-23 10:23:07'),
(139, 'Luffy Mugiwara', 'Teacher', 'Logged out', '2018-04-23 11:00:46'),
(140, 'admin', 'Admin', 'Logged in', '2018-04-23 11:01:29'),
(141, 'admin', 'Admin', 'Added Summer Subject', '2018-04-23 11:01:59'),
(142, 'admin', 'Admin', 'Logged out', '2018-04-23 11:02:08'),
(143, 'Luffy Mugiwara', 'Teacher', 'Logged in', '2018-04-23 11:02:12'),
(144, 'Luffy Mugiwara', 'Teacher', 'Logged out', '2018-04-23 11:03:24'),
(145, 'admin', 'Admin', 'Logged in', '2018-04-23 11:03:32'),
(146, 'admin', 'Admin', 'Logged out', '2018-04-23 11:04:47'),
(147, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-23 11:04:52'),
(148, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-23 11:09:50'),
(149, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-23 11:12:33'),
(150, 'admin', 'Admin', 'Logged in', '2018-04-23 11:12:38'),
(151, 'admin', 'Admin', 'Enroll Students Per ', '2018-04-23 11:39:02'),
(152, 'admin', 'Admin', 'Logged out', '2018-04-23 11:58:57'),
(153, 'admin', 'Admin', 'Logged in', '2018-04-23 13:09:57'),
(154, 'admin', 'Admin', 'Logged out', '2018-04-23 13:53:31'),
(155, 'ivan ivan', 'Student', 'Logged out', '2018-04-23 13:58:07'),
(156, 'admin', 'Admin', 'Logged in', '2018-04-23 14:07:10'),
(157, 'admin', 'Admin', 'Logged out', '2018-04-23 14:11:12'),
(158, 'john john', 'Student', 'Logged out', '2018-04-23 14:13:09'),
(159, 'admin', 'Admin', 'Logged in', '2018-04-23 14:13:14'),
(160, 'admin', 'Admin', 'Delete Subject Per S', '2018-04-23 14:20:20'),
(161, 'admin', 'Admin', 'Delete Subject Per S', '2018-04-23 14:20:25'),
(162, 'admin', 'Admin', 'Added Subject Per SY', '2018-04-23 14:20:32'),
(163, 'admin', 'Admin', 'Update Grade Sched', '2018-04-23 14:21:11'),
(164, 'admin', 'Admin', 'Logged out', '2018-04-23 14:21:25'),
(165, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-23 14:21:33'),
(166, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-23 14:21:53'),
(167, 'admin', 'Admin', 'Logged in', '2018-04-23 14:22:03'),
(168, 'admin', 'Admin', 'Logged out', '2018-04-23 14:22:22'),
(169, 'Cath Olaguir', 'Teacher', 'Logged in', '2018-04-23 14:22:27'),
(170, 'Cath Olaguir', 'Teacher', 'Logged out', '2018-04-23 14:23:00'),
(171, 'admin', 'Admin', 'Logged in', '2018-04-23 14:23:09'),
(172, 'admin', 'Admin', 'Added Section Per SY', '2018-04-23 14:47:33'),
(173, 'admin', 'Admin', 'Enroll Students Per ', '2018-04-23 14:47:45'),
(174, 'admin', 'Admin', 'Added Subject Per SY', '2018-04-23 14:48:08'),
(175, 'admin', 'Admin', 'Added Section Per SY', '2018-04-23 14:50:09');

-- Table `grade_sched` --
CREATE TABLE `grade_sched` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `q1Start` varchar(50) DEFAULT NULL,
  `q1End` varchar(50) DEFAULT NULL,
  `q2Start` varchar(50) DEFAULT NULL,
  `q2End` varchar(50) DEFAULT NULL,
  `q3Start` varchar(50) DEFAULT NULL,
  `q3End` varchar(50) DEFAULT NULL,
  `q4Start` varchar(50) DEFAULT NULL,
  `q4End` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `grade_sched` (`ID`, `sy_level_ID`, `q1Start`, `q1End`, `q2Start`, `q2End`, `q3Start`, `q3End`, `q4Start`, `q4End`) VALUES
(1, 1, '2018-04-23', '2018-04-23', '', '', '', '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `summer_enrolled` (`ID`, `student_ID`, `summer_subject_ID`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0);

-- Table `summer_grade` --
CREATE TABLE `summer_grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `summer_enrolled_ID` int(11) NOT NULL,
  `summer_subject_ID` int(11) NOT NULL,
  `grade` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `summer_grade` (`ID`, `summer_enrolled_ID`, `summer_subject_ID`, `grade`) VALUES
(1, 1, 1, '4'),
(2, 2, 1, '80');

-- Table `summer_grade_sched` --
CREATE TABLE `summer_grade_sched` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `summer_grade_sched` (`ID`, `sy_level_ID`, `start`, `end`) VALUES
(1, 1, '2018-04-18 00:00:00', '2018-04-18 00:00:00');

-- Table `summer_subject` --
CREATE TABLE `summer_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sy_level_ID` int(11) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `subject_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `summer_subject` (`ID`, `sy_level_ID`, `teacher_ID`, `subject_ID`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 5, 1, 1),
(4, 5, 4, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `sy_level_section` (`ID`, `sy_level_ID`, `section_ID`, `teacher_ID`, `capacity`) VALUES
(1, 1, 1, 1, 55),
(5, 1, 9, 4, 20),
(6, 5, 3, 1, 10),
(7, 2, 4, 4, 20),
(8, 6, 4, 1, 1),
(9, 7, 5, 1, 20);

-- Table `teacher_section_subject` --
CREATE TABLE `teacher_section_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_ID` int(11) NOT NULL,
  `sy_level_subject_ID` int(11) NOT NULL,
  `sy_level_section_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `teacher_section_subject` (`ID`, `teacher_ID`, `sy_level_subject_ID`, `sy_level_section_ID`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 4, 1, 5),
(4, 4, 2, 5),
(5, 1, 5, 1),
(6, 1, 6, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `encoder` (`ID`, `employeeNo`, `password`, `Lname`, `Fname`, `Mname`, `contactNo`, `dateCreated`) VALUES
(1, 'encoder', '724a00e315992b82d662231ea0dcbe50', 'Olaguir', 'Catherine Gay', 'Manguiat', '09358029816', '0000-00-00 00:00:00');

