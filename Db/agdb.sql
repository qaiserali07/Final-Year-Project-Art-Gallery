-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2024 at 09:31 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auction`
--

DROP TABLE IF EXISTS `tbl_auction`;
CREATE TABLE IF NOT EXISTS `tbl_auction` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AName` text NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StartAt` text NOT NULL,
  `EndAt` text NOT NULL,
  `TotalPainting` int DEFAULT '0',
  `TotalSales` int NOT NULL DEFAULT '0',
  `Status` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auction_date`
--

DROP TABLE IF EXISTS `tbl_auction_date`;
CREATE TABLE IF NOT EXISTS `tbl_auction_date` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ArtName` text NOT NULL,
  `Discription` text NOT NULL,
  `DemandPrice` int NOT NULL DEFAULT '0',
  `SoldTO` int NOT NULL DEFAULT '-1',
  `Image` text,
  `ArtBy` int NOT NULL,
  `Status` int NOT NULL DEFAULT '-1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bit`
--

DROP TABLE IF EXISTS `tbl_bit`;
CREATE TABLE IF NOT EXISTS `tbl_bit` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AID` int NOT NULL,
  `UID` int NOT NULL,
  `Price` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CID` int NOT NULL,
  `PID` int NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comment` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `SID` int NOT NULL,
  `RID` int NOT NULL,
  `Mesg` text NOT NULL,
  `_read` int NOT NULL DEFAULT '-1',
  `subject` text,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

DROP TABLE IF EXISTS `tbl_notifications`;
CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NID` int NOT NULL,
  `Noti` text NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_Read` int NOT NULL DEFAULT '-1',
  `Status` text,
  `link` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paintings`
--

DROP TABLE IF EXISTS `tbl_paintings`;
CREATE TABLE IF NOT EXISTS `tbl_paintings` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `PaintName` text NOT NULL,
  `UID` int NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` text NOT NULL,
  `Type` text NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay`
--

DROP TABLE IF EXISTS `tbl_pay`;
CREATE TABLE IF NOT EXISTS `tbl_pay` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AID` int NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_security`
--

DROP TABLE IF EXISTS `tbl_security`;
CREATE TABLE IF NOT EXISTS `tbl_security` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_security`
--

INSERT INTO `tbl_security` (`ID`, `UserName`, `Password`) VALUES
(1, 'qaiserali89645@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `ID` int NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `Email` text NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Contact` text NOT NULL,
  `Role` varchar(1) NOT NULL,
  `DOB` text NOT NULL,
  `Address` text NOT NULL,
  `Profession` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `FirstName`, `LastName`, `Email`, `Gender`, `Contact`, `Role`, `DOB`, `Address`, `Profession`) VALUES
(1, 'Qaiser', 'Ali', 'qaiserali89645@gmail.com', 'M', '+4434343443', 'A', 'Mar 03, 1999', 'Art Gallarry', 'Admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
