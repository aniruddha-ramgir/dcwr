-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2016 at 07:57 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcwr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(15) NOT NULL,
  `dept_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `dept_id`) VALUES
(3, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(15) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `name`) VALUES
(1, 'CSE'),
(2, 'ECE');

-- --------------------------------------------------------

--
-- Table structure for table `incharges`
--

CREATE TABLE `incharges` (
  `user_id` int(15) NOT NULL,
  `section_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incharges`
--

INSERT INTO `incharges` (`user_id`, `section_id`) VALUES
(1, 1),
(2, 1),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(15) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `pass` text NOT NULL,
  `type_id` char(1) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `user_name`, `pass`, `type_id`, `name`) VALUES
(1, 'alpha', '1234', 'C', 'rahul'),
(2, 'beta', '1111', 'F', 'anusha'),
(3, 'gamma', '2222', 'A', 'madan'),
(4, 'delta', '3333', 'C', 'aniruddha'),
(5, 'epsilon', '4444', 'F', 'keerthika'),
(6, 'zelta', '5555', 'A', 'rubina');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `dept_id` int(15) NOT NULL,
  `batch` year(4) NOT NULL,
  `year` int(1) NOT NULL,
  `semester` int(1) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `plan_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`dept_id`, `batch`, `year`, `semester`, `admin_id`, `plan_id`) VALUES
(1, 2017, 4, 1, 3, 1),
(2, 2017, 4, 1, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `plans_subject_data`
--

CREATE TABLE `plans_subject_data` (
  `plan_id` int(15) NOT NULL,
  `subject1` text NOT NULL,
  `subject2` text NOT NULL,
  `subject3` text NOT NULL,
  `subject4` text NOT NULL,
  `subject5` text NOT NULL,
  `subject6` text NOT NULL,
  `subject7` text NOT NULL,
  `subject8` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans_subject_data`
--

INSERT INTO `plans_subject_data` (`plan_id`, `subject1`, `subject2`, `subject3`, `subject4`, `subject5`, `subject6`, `subject7`, `subject8`, `date`) VALUES
(1, 'Cloud Computing', 'Cloud Computing', 'Information Retrieval Systems', 'Design Patterns', 'lunch', 'Linux Programming', 'Big Data', 'club Activity', '2016-08-29'),
(1, 'Cloud Computing', 'DWDM', 'DWDM', 'Big Data', 'lunch', 'Cloud Computing', 'Design Patterns', 'club Activity', '2016-08-30'),
(1, 'DWDM', 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'lunch', 'Big Data', 'Cloud Computing', 'club Activity', '2016-08-31'),
(1, 'DWDM LAB', 'DWDM LAB', 'DWDM LAB', 'Linux Programming', 'lunch', 'Cloud COmputing', 'DWDM', 'club Activity', '2016-09-01'),
(1, 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'Design Patterns', 'lunch', 'Big Data', 'Information Retrieval Systems', 'club Activity', '2016-09-02'),
(1, 'Big Data', 'Design Patterns', 'Cloud Computing', 'Cloud Computing', 'lunch', 'Design Patterns', 'dbms', 'club Activity', '2016-09-03'),
(1, 'Cloud Computing', 'Big Data', 'Information Retrieval Systems', 'DWDM', 'lunch', 'Information Retrieval Systems', 'Big Data', 'club Activity', '2016-09-05'),
(1, 'Design Patterns', 'Big Data', 'Information Retrieval Systems', 'Cloud Computing', 'lunch', 'Linux Programming', 'Linux Programming', 'club Activity', '2016-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `plans_topic_data`
--

CREATE TABLE `plans_topic_data` (
  `plan_id` int(15) NOT NULL,
  `subject1` text NOT NULL,
  `subject2` text NOT NULL,
  `subject3` text NOT NULL,
  `subject4` text NOT NULL,
  `subject5` text NOT NULL,
  `subject6` text NOT NULL,
  `subject7` text NOT NULL,
  `subject8` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans_topic_data`
--

INSERT INTO `plans_topic_data` (`plan_id`, `subject1`, `subject2`, `subject3`, `subject4`, `subject5`, `subject6`, `subject7`, `subject8`, `date`) VALUES
(1, 'Cloud Computing', 'Cloud Computing', 'Information Retrieval Systems', 'Design Patterns', 'lunch', 'Linux Programming', 'Big Data', 'club Activity', '2016-08-28'),
(1, 'Cloud Computing', 'DWDM', 'DWDM', 'Big Data', 'lunch', 'Cloud Computing', 'Design Patterns', 'club Activity', '2016-08-29'),
(1, 'DWDM', 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'lunch', 'Big Data', 'Cloud Computing', 'club Activity', '2016-08-30'),
(1, 'DWDM LAB', 'DWDM LAB', 'DWDM LAB', 'Linux Programming', 'lunch', 'Cloud COmputing', 'DWDM', 'club Activity', '2016-08-31'),
(1, 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'Design Patterns', 'lunch', 'Big Data', 'Information Retrieval Systems', 'club Activity', '2016-09-01'),
(1, 'Big Data', 'Design Patterns', 'Cloud Computing', 'Cloud Computing', 'lunch', 'Design Patterns', 'dbms', 'club Activity', '2016-09-02'),
(1, 'Design Patterns', 'Big Data', 'Information Retrieval Systems', 'Cloud Computing', 'lunch', 'Linux Programming', 'Linux Programming', 'club Activity', '2016-09-03'),
(1, 'DP', 'LP', 'CP', 'MP', 'NP', 'PP', 'HP', 'EP', '2016-09-05'),
(1, 'Cloud Computing', 'Big Data', 'Information Retrieval Systems', 'DWDM', 'lunch', 'Information Retrieval Systems', 'Big Data', 'club Activity', '2016-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `dcwr_id` int(15) NOT NULL,
  `date` date NOT NULL,
  `hour` int(4) NOT NULL,
  `event` text NOT NULL,
  `reason` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='0 - on course, 1 - delayed, 2- substituted, etc';

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`dcwr_id`, `date`, `hour`, `event`, `reason`) VALUES
(1, '2016-09-01', 1, 'Substituted', ''),
(1, '2016-09-01', 2, 'On Track', NULL),
(1, '2016-09-01', 3, 'Cancelled', NULL),
(1, '2016-09-01', 4, 'Delayed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `section_id` int(15) NOT NULL,
  `year` int(1) NOT NULL,
  `semester` int(1) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `dcwr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`section_id`, `year`, `semester`, `mentor_id`, `dcwr_id`) VALUES
(1, 4, 1, 2, 1),
(2, 4, 1, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reports_subject_data`
--

CREATE TABLE `reports_subject_data` (
  `dcwr_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `1H` text,
  `2H` text,
  `3H` text,
  `4H` text,
  `5H` text,
  `6H` text,
  `7H` text,
  `8H` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports_subject_data`
--

INSERT INTO `reports_subject_data` (`dcwr_id`, `date`, `1H`, `2H`, `3H`, `4H`, `5H`, `6H`, `7H`, `8H`) VALUES
(1, '2016-08-29', 'Cloud Computing', 'Cloud Computing', 'Information Retrieval Systems', 'Design Patterns', 'lunch', 'Linux Programming', 'Big Data', 'club Activity'),
(1, '2016-08-30', 'Cloud Computing', 'DWDM', 'DWDM', 'Big Data', 'lunch', 'Cloud Computing', 'Design Patterns', 'club Activity'),
(1, '2016-08-31', 'DWDM', 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'lunch', 'Big Data', 'Cloud Computing', 'club Activity'),
(1, '2016-09-01', 'ELECTIVE2', 'DWDM LAB', 'DWDM LAB', 'Linux Programming', 'lunch', 'Cloud COmputing', 'DWDM', 'club Activity'),
(1, '2016-09-02', 'Design Patterns', 'ELECTIVE2', 'ELECTIVE2', 'Design Patterns', 'lunch', 'Big Data', 'Information Retrieval Systems', 'club Activity'),
(1, '2016-09-03', 'Cloud Computing', 'Big Data', 'Information Retrieval Systems', 'DWDM', 'lunch', 'Information Retrieval Systems', 'Big Data', 'club Activity'),
(1, '2016-09-04', 'Design Patterns', 'Big Data', 'Information Retrieval Systems', 'Cloud Computing', 'lunch', 'Linux Programming', 'Linux Programming', 'club Activity'),
(1, '2016-09-05', 'Big Data', 'Design Patterns', 'Cloud Computing', 'Cloud Computing', 'lunch', 'Design Patterns', 'dbms', 'club Activity');

-- --------------------------------------------------------

--
-- Table structure for table `reports_topic_data`
--

CREATE TABLE `reports_topic_data` (
  `dcwr_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `1H` text,
  `2H` text,
  `3H` text,
  `4H` text,
  `5H` text,
  `6H` text,
  `7H` text,
  `8H` text,
  `CR` int(11) NOT NULL DEFAULT '0',
  `Incharge` int(11) NOT NULL DEFAULT '0',
  `Admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports_topic_data`
--

INSERT INTO `reports_topic_data` (`dcwr_id`, `date`, `1H`, `2H`, `3H`, `4H`, `5H`, `6H`, `7H`, `8H`, `CR`, `Incharge`, `Admin`) VALUES
(1, '2016-08-29', 'Design Patterns', 'Big Data', 'Information Retrieval Systems', 'Cloud Computing', 'lunch', 'Linux Programming', 'Linux Programming', 'club Activity', 0, 0, 0),
(1, '2016-08-30', 'Big Data', 'Design Patterns', 'Cloud Computing', 'Cloud Computing', 'lunch', 'Design Patterns', 'dbms', 'club Activity', 0, 0, 0),
(1, '2016-08-31', 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'Design Patterns', 'lunch', 'Big Data', 'Information Retrieval Systems', 'club Activity', 0, 0, 0),
(1, '2016-09-01', 'eed', 'DWDM', 'DWDM', 'Big Data', 'lunch', 'Cloud Computing', 'Design Patterns', 'club Activity', 0, 0, 0),
(1, '2016-09-02', 'j', 'Test2', 'Test3', 'Design Patterns', 'lunch', 'Linux Programming', 'Big Data', 'club Activity', 0, 0, 0),
(1, '2016-09-03', 'DWDM', 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'lunch', 'Big Data', 'Cloud Computing', 'club Activity', 0, 1, 1),
(1, '2016-09-04', 'DWDM LAB', 'DWDM LAB', 'DWDM LAB', 'Linux Programming', 'lunch', 'Cloud COmputing', 'DWDM', 'club Activity', 0, 1, 1),
(1, '2016-09-05', 'Cloud Computing', 'Big Data', 'Information Retrieval Systems', 'DWDM', 'lunch', 'Information Retrieval Systems', 'Big Data', 'club Activity', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_data`
--

CREATE TABLE `schedule_data` (
  `dcwr_id` int(11) NOT NULL,
  `day` int(2) NOT NULL,
  `1H` text,
  `2H` text,
  `3H` text,
  `4H` text,
  `5H` text,
  `6H` text,
  `7H` text,
  `8H` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_data`
--

INSERT INTO `schedule_data` (`dcwr_id`, `day`, `1H`, `2H`, `3H`, `4H`, `5H`, `6H`, `7H`, `8H`) VALUES
(1, 1, 'Design Patterns', 'Big Data', 'Information Retrieval Systems', 'Cloud Computing', 'lunch', 'Linux Programming', 'Linux Programming', 'club Activity'),
(1, 2, 'Big Data', 'Design Patterns', 'Cloud Computing', 'Cloud Computing', 'lunch', 'Design Patterns', 'dbms', 'club Activity'),
(1, 3, 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'Design Patterns', 'lunch', 'Big Data', 'Information Retrieval Systems', 'club Activity'),
(1, 4, 'Cloud Computing', 'DWDM', 'DWDM', 'Big Data', 'lunch', 'Cloud Computing', 'Design Patterns', 'club Activity'),
(1, 5, 'Cloud Computing', 'Cloud Computing', 'Information Retrieval Systems', 'Design Patterns', 'lunch', 'Linux Programming', 'Big Data', 'club Activity'),
(1, 6, 'DWDM', 'Information Retrieval Systems', 'Cloud Computing', 'Design Patterns', 'lunch', 'Big Data', 'Cloud Computing', 'club Activity'),
(1, 7, 'DWDM LAB', 'DWDM LAB', 'DWDM LAB', 'Linux Programming', 'lunch', 'Cloud COmputing', 'DWDM', 'club Activity'),
(2, 1, 'Cloud Computing', 'Big Data', 'Information Retrieval Systems', 'DWDM', 'lunch', 'Information Retrieval Systems', 'Big Data', 'club Activity');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(15) NOT NULL,
  `dept_id` int(15) NOT NULL,
  `name` text NOT NULL,
  `batch` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `dept_id`, `name`, `batch`) VALUES
(1, 1, 'C', 2017),
(2, 2, 'A', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `plan_id` int(15) NOT NULL,
  `SUBJECT1` text NOT NULL,
  `SUBJECT2` text NOT NULL,
  `SUBJECT3` text NOT NULL,
  `SUBJECT4` text NOT NULL,
  `SUBJECT5` text NOT NULL,
  `SUBJECT6` text NOT NULL,
  `SUBJECT7` text NOT NULL,
  `SUBJECT8` text,
  `SUBJECT9` text,
  `SUBJECT10` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_list`
--

INSERT INTO `subject_list` (`plan_id`, `SUBJECT1`, `SUBJECT2`, `SUBJECT3`, `SUBJECT4`, `SUBJECT5`, `SUBJECT6`, `SUBJECT7`, `SUBJECT8`, `SUBJECT9`, `SUBJECT10`) VALUES
(1, 'Design Patterns', 'ELECTIVE2', 'ELECTIVE1', 'DWDM', 'Cloud Computing', 'Linux Programming', 'LAB', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `incharges`
--
ALTER TABLE `incharges`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`),
  ADD UNIQUE KEY `plan_id` (`plan_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `plans_subject_data`
--
ALTER TABLE `plans_subject_data`
  ADD PRIMARY KEY (`plan_id`,`date`);

--
-- Indexes for table `plans_topic_data`
--
ALTER TABLE `plans_topic_data`
  ADD PRIMARY KEY (`plan_id`,`date`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`dcwr_id`,`date`,`hour`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`dcwr_id`),
  ADD UNIQUE KEY `dcwr_id` (`dcwr_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexes for table `reports_subject_data`
--
ALTER TABLE `reports_subject_data`
  ADD PRIMARY KEY (`dcwr_id`,`date`);

--
-- Indexes for table `reports_topic_data`
--
ALTER TABLE `reports_topic_data`
  ADD PRIMARY KEY (`dcwr_id`,`date`);

--
-- Indexes for table `schedule_data`
--
ALTER TABLE `schedule_data`
  ADD PRIMARY KEY (`dcwr_id`,`day`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`,`dept_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `dcwr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`user_id`),
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`);

--
-- Constraints for table `incharges`
--
ALTER TABLE `incharges`
  ADD CONSTRAINT `incharges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`user_id`),
  ADD CONSTRAINT `incharges_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`),
  ADD CONSTRAINT `plans_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`user_id`);

--
-- Constraints for table `plans_subject_data`
--
ALTER TABLE `plans_subject_data`
  ADD CONSTRAINT `plans_subject_data_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`);

--
-- Constraints for table `plans_topic_data`
--
ALTER TABLE `plans_topic_data`
  ADD CONSTRAINT `plans_topic_data_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`);

--
-- Constraints for table `reasons`
--
ALTER TABLE `reasons`
  ADD CONSTRAINT `reasons_ibfk_1` FOREIGN KEY (`dcwr_id`) REFERENCES `reports` (`dcwr_id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`mentor_id`) REFERENCES `incharges` (`user_id`);

--
-- Constraints for table `reports_subject_data`
--
ALTER TABLE `reports_subject_data`
  ADD CONSTRAINT `reports_subject_data_ibfk_1` FOREIGN KEY (`dcwr_id`) REFERENCES `reports` (`dcwr_id`);

--
-- Constraints for table `reports_topic_data`
--
ALTER TABLE `reports_topic_data`
  ADD CONSTRAINT `reports_topic_data_ibfk_1` FOREIGN KEY (`dcwr_id`) REFERENCES `reports` (`dcwr_id`);

--
-- Constraints for table `schedule_data`
--
ALTER TABLE `schedule_data`
  ADD CONSTRAINT `schedule_data_ibfk_1` FOREIGN KEY (`dcwr_id`) REFERENCES `reports` (`dcwr_id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`);

--
-- Constraints for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD CONSTRAINT `subject_list_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
