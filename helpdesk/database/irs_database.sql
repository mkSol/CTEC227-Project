-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2014 at 01:58 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `irs`
--
CREATE DATABASE IF NOT EXISTS `irs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `irs`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `category`) VALUES
(1, 'PC Hardware'),
(2, 'Software'),
(3, 'Email'),
(4, 'Printer/Scanner/Fax/Misc'),
(5, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `deptID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`deptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptID`, `department`) VALUES
(1, 'Management'),
(2, 'HR'),
(3, 'Marketing'),
(4, 'IT'),
(5, 'Customer Service');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipID` int(11) NOT NULL AUTO_INCREMENT,
  `equipType` int(11) NOT NULL,
  `equipSerial` varchar(255) NOT NULL,
  `equipDesc` text NOT NULL,
  PRIMARY KEY (`equipID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipID`, `equipType`, `equipSerial`, `equipDesc`) VALUES
(1, 1, 'IT-001', 'Dell XPS 8700'),
(2, 2, 'HR-001', 'Dell Inspiron 15'),
(3, 3, 'HR-001', 'HP 1010 Deskjet Printer');

-- --------------------------------------------------------

--
-- Table structure for table `equipType`
--

DROP TABLE IF EXISTS `equipType`;
CREATE TABLE IF NOT EXISTS `equipType` (
  `equipTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `equipType` varchar(40) NOT NULL,
  PRIMARY KEY (`equipTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `equipType`
--

INSERT INTO `equipType` (`equipTypeID`, `equipType`) VALUES
(1, 'Desktop PC'),
(2, 'Laptop PC'),
(3, 'Peripheral');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `msgID` int(11) NOT NULL AUTO_INCREMENT,
  `msgSubject` varchar(255) NOT NULL,
  `msgTo` varchar(40) NOT NULL,
  `msgFrom` varchar(40) NOT NULL,
  `msgBody` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `read` tinyint(1) NOT NULL,
  PRIMARY KEY (`msgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msgID`, `msgSubject`, `msgTo`, `msgFrom`, `msgBody`, `timestamp`, `read`) VALUES
(1, 'Testing The Message System', '2', '1', 'This is a test. 1. 2. 3.', '2014-05-03 08:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `priorityID` int(11) NOT NULL AUTO_INCREMENT,
  `priority` varchar(10) NOT NULL,
  PRIMARY KEY (`priorityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`priorityID`, `priority`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `privID` int(11) NOT NULL AUTO_INCREMENT,
  `privRole` varchar(20) NOT NULL,
  PRIMARY KEY (`privID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`privID`, `privRole`) VALUES
(1, 'User'),
(2, 'IT Help Desk'),
(3, 'Manager'),
(4, 'System Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

DROP TABLE IF EXISTS `software`;
CREATE TABLE IF NOT EXISTS `software` (
  `softwareID` int(11) NOT NULL AUTO_INCREMENT,
  `softwareName` varchar(255) NOT NULL,
  `softwareSerial` varchar(255) NOT NULL,
  `equipID` int(11) NOT NULL,
  PRIMARY KEY (`softwareID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`softwareID`, `softwareName`, `softwareSerial`, `equipID`) VALUES
(1, 'Microsoft Office 2007', 'XYXYX-ABABA-TYTYT-LOLOL-10101', 2);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `status`) VALUES
(1, 'Open'),
(2, 'Assigned'),
(3, 'Closed (Solved)'),
(4, 'Closed (Can Not Fix)');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `priorityID` int(11) NOT NULL,
  `assignedTo` int(11) DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  `issueDesc` text NOT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketID`, `userID`, `statusID`, `categoryID`, `priorityID`, `assignedTo`, `timestamp`, `issueDesc`) VALUES
(1, 2, 1, 1, 1, NULL, '2014-05-03 00:00:00', 'Help! My paper won''t fit into the cd drive!'),
(2, 1, 2, 5, 1, 1, '2014-05-08 00:00:00', 'This website isn''t working yet.');

-- --------------------------------------------------------

--
-- Table structure for table `ticketComment`
--

DROP TABLE IF EXISTS `ticketComment`;
CREATE TABLE IF NOT EXISTS `ticketComment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `ticketID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ticketComment`
--

INSERT INTO `ticketComment` (`commentID`, `ticketID`, `userID`, `comment`, `timestamp`) VALUES
(1, 1, 1, 'Paper does not go into the CD drive. CDs do.', '2014-05-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `passwd` varchar(40) NOT NULL,
  `dateRegistered` date NOT NULL,
  `datePassword` date NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `department` int(11) NOT NULL,
  `privilege` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `passwd`, `dateRegistered`, `datePassword`, `firstName`, `lastName`, `email`, `department`, `privilege`) VALUES
(1, 'root', 'admin', '2014-05-03', '2014-05-03', 'Admin', 'Administrator', 'admin@greenwellbank.com', 4, 4),
(2, 'jdoe', 'password', '2014-05-03', '2014-05-03', 'John', 'Doe', 'jdoe@greenwellbank.com', 5, 1),
(3, 'Rebekah', 'GoIRS', '2014-05-07', '2014-05-08', 'Roth', 'Ayers', 'lectus.quis.massa@ipsumdolorsit.edu', 2, 3),
(4, 'Arden', 'GoIRS', '2014-05-07', '2014-05-08', 'Louis', 'Jordan', 'inceptos.hymenaeos@nec.org', 2, 4),
(5, 'Aquila', 'GoIRS', '2014-05-07', '2014-05-08', 'Veda', 'Powell', 'tellus@vellectusCum.net', 5, 1),
(6, 'Brendan', 'GoIRS', '2014-05-07', '2014-05-08', 'Zenaida', 'Ortiz', 'quam.quis@sem.co.uk', 3, 3),
(7, 'Virginia', 'GoIRS', '2014-05-07', '2014-05-08', 'Rachel', 'Bullock', 'nec.tempus.mauris@senectusetnetus.net', 1, 3),
(8, 'Felicia', 'GoIRS', '2014-05-07', '2014-05-08', 'Nevada', 'Silva', 'volutpat.Nulla@velconvallisin.ca', 2, 3),
(9, 'Minerva', 'GoIRS', '2014-05-07', '2014-05-08', 'Mannix', 'Beasley', 'in.cursus.et@Nunc.org', 4, 3),
(10, 'Gannon', 'GoIRS', '2014-05-07', '2014-05-08', 'Diana', 'Dotson', 'a@tincidunt.edu', 5, 4),
(11, 'Rudyard', 'GoIRS', '2014-05-07', '2014-05-08', 'Axel', 'Carney', 'vitae.semper.egestas@semvitaealiquam.com', 1, 4),
(12, 'Gloria', 'GoIRS', '2014-05-07', '2014-05-08', 'Warren', 'Stevenson', 'fermentum.convallis@SednequeSed.ca', 5, 2),
(13, 'Porter', 'GoIRS', '2014-05-07', '2014-05-08', 'William', 'Case', 'consectetuer.adipiscing@ProinvelitSed.edu', 5, 1),
(14, 'Luke', 'GoIRS', '2014-05-07', '2014-05-08', 'Karyn', 'Simmons', 'tristique.pharetra@cursusluctus.org', 2, 1),
(15, 'Eric', 'GoIRS', '2014-05-07', '2014-05-08', 'Illana', 'Stout', 'id.ante@a.com', 5, 4),
(16, 'Omar', 'GoIRS', '2014-05-07', '2014-05-08', 'Hadassah', 'Bradshaw', 'mauris@lectussit.net', 4, 2),
(17, 'Malik', 'GoIRS', '2014-05-07', '2014-05-08', 'Althea', 'Barton', 'est.vitae@mollisPhasellus.net', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userEquip`
--

DROP TABLE IF EXISTS `userEquip`;
CREATE TABLE IF NOT EXISTS `userEquip` (
  `linkID` int(11) NOT NULL AUTO_INCREMENT,
  `equipID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `deptID` int(11) DEFAULT NULL,
  PRIMARY KEY (`linkID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `userEquip`
--

INSERT INTO `userEquip` (`linkID`, `equipID`, `userID`, `deptID`) VALUES
(1, 3, NULL, 2),
(2, 1, 1, NULL),
(3, 3, 2, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
