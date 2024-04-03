-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2021 at 09:13 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AName` text NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `StartAt` text NOT NULL,
  `EndAt` text NOT NULL,
  `TotalPainting` int(11) DEFAULT 0,
  `TotalSales` int(11) NOT NULL DEFAULT 0,
  `Status` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auction_date`
--

DROP TABLE IF EXISTS `tbl_auction_date`;
CREATE TABLE IF NOT EXISTS `tbl_auction_date` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ArtName` text NOT NULL,
  `Discription` text NOT NULL,
  `DemandPrice` int(11) NOT NULL DEFAULT 0,
  `SoldTO` int(11) NOT NULL DEFAULT -1,
  `Image` text DEFAULT NULL,
  `ArtBy` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT -1,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bit`
--

DROP TABLE IF EXISTS `tbl_bit`;
CREATE TABLE IF NOT EXISTS `tbl_bit` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `Comment` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_description`
--

DROP TABLE IF EXISTS `tbl_description`;
CREATE TABLE IF NOT EXISTS `tbl_description` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Contact` text NOT NULL,
  `Facebook` text NOT NULL,
  `Twitter` text NOT NULL,
  `Buy` text NOT NULL,
  `Gift` text NOT NULL,
  `Download` text NOT NULL,
  `Title` text NOT NULL,
  `Subtitle` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_description`
--

INSERT INTO `tbl_description` (`ID`, `Contact`, `Facebook`, `Twitter`, `Buy`, `Gift`, `Download`, `Title`, `Subtitle`) VALUES
(1, '03475647345', 'www.facebook.com', 'www.twitter.com', '<p><strike>You can buy our painting on during exibition...&nbsp;</strike></p><p><strike>sadlkaslkdjsaldjaslkj</strike></p>', '<b>We are offering a laptop on each buy today......</b>', 'It is not legal to download someone work....', 'Art made artist', 'Art belongs to everyone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `Mesg` text NOT NULL,
  `_read` int(11) NOT NULL DEFAULT -1,
  `subject` text DEFAULT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

DROP TABLE IF EXISTS `tbl_notifications`;
CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NID` int(11) NOT NULL,
  `Noti` text NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `_Read` int(11) NOT NULL DEFAULT -1,
  `Status` text DEFAULT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paintings`
--

DROP TABLE IF EXISTS `tbl_paintings`;
CREATE TABLE IF NOT EXISTS `tbl_paintings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PaintName` text NOT NULL,
  `UID` int(11) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `Description` text NOT NULL,
  `Type` text NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay`
--

DROP TABLE IF EXISTS `tbl_pay`;
CREATE TABLE IF NOT EXISTS `tbl_pay` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AID` int(11) NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_security`
--

DROP TABLE IF EXISTS `tbl_security`;
CREATE TABLE IF NOT EXISTS `tbl_security` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_security`
--

INSERT INTO `tbl_security` (`ID`, `UserName`, `Password`) VALUES
(26, 'test2@gmail.com', '123'),
(25, 'professsional1@professsional.com', '123'),
(1, 'admin@admin.com', '123'),
(24, 'test@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `ID` int(11) NOT NULL,
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
(1, 'Gallary', 'Admin', 'admin@admin.com', 'M', '+923460200343', 'A', 'Mar 03, 1999', 'Art Gallarry', 'Admin'),
(26, 'test2', 'test2', 'test2@gmail.com', 'M', '923460200343', 'B', '2021-12-02', 'Mohallah Channi balyah', 'Student'),
(25, 'Professsional', '123', 'professsional1@professsional.com', 'O', '923460200343', 'P', '3313-03-01', 'dadasda', 'Artist'),
(24, 'test', 'test', 'test@gmail.com', 'M', '923460200343', 'B', '1999-03-03', 'hlksflsakj', 'Student');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
