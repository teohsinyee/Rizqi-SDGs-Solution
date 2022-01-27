-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 07:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rizqi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `ADMIN_USERNAME` varchar(30) NOT NULL,
  `ADMIN_PASSWORD` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `POST_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `POST_ITEM_NAME` varchar(100) NOT NULL,
  `POST_DESCRIPTION` varchar(300) NOT NULL,
  `POST_PICTURE` mediumblob DEFAULT NULL,
  `POST_QUANTITY` int(11) NOT NULL,
  `POST_LOCATION` varchar(100) NOT NULL,
  `POST_CATEGORY` varchar(10) NOT NULL,
  `POST_DATETIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `REPORT_ID` int(11) NOT NULL,
  `REPORTING_USER_ID` int(11) NOT NULL,
  `POST_OWNER_USER_ID` int(11) NOT NULL,
  `POST_ID` int(11) NOT NULL,
  `ADMIN_ID` int(11) DEFAULT NULL,
  `REPORT_DESCRIPTION` varchar(300) NOT NULL,
  `REPORT_CATEGORY` varchar(30) NOT NULL,
  `REPORT_DATETIME` datetime NOT NULL DEFAULT current_timestamp(),
  `REPORT_STATUS` varchar(20) NOT NULL DEFAULT 'UNSOLVED',
  `REPORT_POST_LINK` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `USER_EMAIL` varchar(100) NOT NULL,
  `USER_PASSWORD` varchar(200) NOT NULL,
  `USER_PHONE_NUMBER` varchar(15) NOT NULL,
  `USER_PICTURE` mediumblob DEFAULT NULL,
  `USER_SUSPENSION_STATUS` varchar(15) NOT NULL DEFAULT 'NOT SUSPENDED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`POST_ID`),
  ADD KEY `fk_post_user_USER_ID` (`USER_ID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`REPORT_ID`),
  ADD KEY `fk_reports_user_USER_ID` (`REPORTING_USER_ID`),
  ADD KEY `reports_user_USER_ID_2` (`POST_OWNER_USER_ID`),
  ADD KEY `reports_post_POST_ID` (`POST_ID`),
  ADD KEY `reports_admin_ADMIN_ID` (`ADMIN_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `POST_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `REPORT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_user_USER_ID` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_user_USER_ID` FOREIGN KEY (`REPORTING_USER_ID`) REFERENCES `user` (`USER_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_admin_ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_post_POST_ID` FOREIGN KEY (`POST_ID`) REFERENCES `post` (`POST_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_user_USER_ID_2` FOREIGN KEY (`POST_OWNER_USER_ID`) REFERENCES `user` (`USER_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
