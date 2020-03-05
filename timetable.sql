-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2019 at 07:10 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE `allocation` (
  `cid` varchar(10) NOT NULL,
  `deptid` varchar(10) NOT NULL,
  `staffid` varchar(10) NOT NULL,
  `subjectid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`cid`, `deptid`, `staffid`, `subjectid`) VALUES
('course1', 'dept1', 'stf1', 'sub1'),
('course1', 'dept1', 'stf2', 'sub2'),
('course1', 'dept1', 'stf3', 'sub3'),
('course1', 'dept1', 'stf4', 'sub4'),
('course1', 'dept1', 'stf5', 'sub5'),
('course1', 'dept1', 'stf6', 'sub6');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `classid` varchar(10) NOT NULL,
  `classname` varchar(20) NOT NULL,
  `deptid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`classid`, `classname`, `deptid`) VALUES
('cs1', 'cse-a', 'dept1'),
('cs2', 'cse-b', 'dept1'),
('cs3', 'cse-c', 'dept1');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` varchar(10) NOT NULL,
  `coursename` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursename`) VALUES
('course1', 'btech'),
('course2', 'mtech');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deptid` varchar(10) NOT NULL,
  `deptname` varchar(20) NOT NULL,
  `courseid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptid`, `deptname`, `courseid`) VALUES
('dept1', 'cse', 'course1'),
('dept2', 'cybersecurity', 'course2');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` varchar(10) NOT NULL,
  `staffname` varchar(20) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `deptid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `mail`, `deptid`) VALUES
('stf1', 'edward kenway', 'edward_assasin@gmail', 'dept1'),
('stf2', 'ezio auditore', 'ezio_assasin@gmail.c', 'dept1'),
('stf3', 'shay cormac', 'shay_templar@gmail.c', 'dept1'),
('stf4', 'bruce wayne', 'dark_knight@gmail.co', 'dept1'),
('stf5', 'tony stark', 'ironman@gmail.com', 'dept1'),
('stf6', 'desmond miles', 'desmond@gmail.com', 'dept1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` varchar(10) NOT NULL,
  `subjectname` varchar(30) NOT NULL,
  `deptid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectname`, `deptid`) VALUES
('sub1', 'web application development', 'dept1'),
('sub2', 'r programming', 'dept1'),
('sub3', 'intellectual property rightss', 'dept1'),
('sub4', 'design and analysis of algorit', 'dept1'),
('sub5', 'java programming', 'dept1'),
('sub6', 'python programming', 'dept1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`cid`,`deptid`,`staffid`,`subjectid`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`classid`),
  ADD UNIQUE KEY `classname` (`classname`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`),
  ADD UNIQUE KEY `coursename` (`coursename`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptid`),
  ADD UNIQUE KEY `deptname` (`deptname`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD UNIQUE KEY `staffname` (`staffname`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`),
  ADD UNIQUE KEY `subjectname` (`subjectname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
