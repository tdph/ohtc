-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2016 at 01:28 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohtcdb`
--
CREATE DATABASE IF NOT EXISTS `ohtcdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ohtcdb`;

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longblob,
  `imagepath` varchar(255) DEFAULT NULL,
  `dateadded` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`id`, `title`, `description`, `imagepath`, `dateadded`) VALUES
(8, 'fruit carving', 0x66727569742063617276696e67, '../assets/img/gallery/fruit carving.jpg', '2016-09-09 12:21:16'),
(9, 'fruit carving b', 0x66727569742063617276696e672062, '../assets/img/gallery/fruit carving b.jpg', '2016-09-09 12:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblmodule`
--

CREATE TABLE `tblmodule` (
  `id` bigint(20) NOT NULL,
  `serviceid` bigint(20) DEFAULT NULL,
  `description` longblob,
  `dateadded` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE `tblnews` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longblob,
  `imagepath` varchar(255) NOT NULL,
  `isfeatured` tinyint(1) NOT NULL DEFAULT '0',
  `dateadded` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`id`, `title`, `content`, `imagepath`, `isfeatured`, `dateadded`) VALUES
(63, 'The Oceanic Hospitality Training Centre Launches Own Website', 0x4f6e65206f662074686520746f7020686f73706974616c69747920616e642063756c696e61727920747261696e696e672063656e7465722c20546865204f6365616e696320486f73706974616c69747920547261696e696e672043656e747265206c61756e6368657320746865697220776562736974652c207777772e6f6365616e69636874632e636f6d20746f20696e6372656173652074686569722070726573656e636520696e2074686520776f726c6477696465207765622e2041736964652066726f6d20746865697220776562736974652c204f4854432068617320612046616365626f6f6b2066616e20706167652c20687474703a2f2f7777772e66616365626f6f6b2e636f6d2f6f6874636d6c612e204e6f7720616e796f6e652063616e207265616368204f48544320616e6420626520696e666f726d6564206279206f6e676f696e6720636f7572736573206576656e207768656e2074686579277265206f6e2074686520676f2e, '../assets/img/news/news-featured.jpg', 1, '2016-08-22 16:00:00'),
(64, 'Ericson Bautista', 0x48524d2067726164756174652077686f2068617320756e646572676f6e652061206f6e20746865206a6f6220747261696e696e6720696e20746865204f6365616e696320486f73706974616c6974792043656e7472652066726f6d20417072696c203230313520746f2053657074656d62657220323031352e204d722e204261757469737461206861732066696e69736865642068697320666972737420636f6e7472616374206173204d6573736d616e207769746820612067726561742061707072616973616c2066726f6d20746865204d6173746572206f6e20626f6172642e20536f6f6e2068652077696c6c207361696c206177617920616761696e2e20576520617265206c6f6f6b696e6720666f727761726420746f207365652068696d206173206120436869656620636f6f6b20696e20746865206e656172206675747572652e, '../assets/img/news/news4.jpg', 0, '2016-02-17 16:00:00'),
(65, 'Family Mission LPC', 0x4f6365616e696320486f73706974616c69747920547261696e696e672043656e74726520537461666620697320636f6f6b696e67206672656520666f6f6420666f72207468652066616d696c79206d697373696f6e204c504320696e2041756775737420323031362e, '../assets/img/news/news2.jpg', 0, '2016-07-22 16:00:00'),
(66, 'OHTC on Propellers Club Manila', 0x4f48544320697320686f7374696e67207468652050726f70656c6c65727320636c7562204d616e696c61206d656574696e6720696e204a756e6520323031362e, '../assets/img/news/news3.jpg', 0, '2016-06-03 16:00:00'),
(67, 'John', 0x4a6f686e20697320612048524d2067726164756174652077686f2066696e697368656420686973206f6e20746865206a6f6220747261696e696e6720696e20746865206f4854432066726f6d20417072696c20746f2053657074656d62657220323031342e204279206e6f77206865206861732066696e69736865642074776f20636f6e747261637473206173206d6573736d616e2e205468697320697320686f7720612066757475726520436869656620436f6f6b206c6f6f6b73206c696b652e205765207769736820676f6f64206c75636b20666f7220746865206675747572652e, '../assets/img/news/news5.jpg', 0, '2016-01-27 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblobjectives`
--

CREATE TABLE `tblobjectives` (
  `id` bigint(20) NOT NULL,
  `serviceid` bigint(20) DEFAULT NULL,
  `objective` varchar(255) DEFAULT NULL,
  `dateadded` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblourteam`
--

CREATE TABLE `tblourteam` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `description` longblob,
  `imagepath` varchar(255) DEFAULT NULL,
  `dateadded` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblourteam`
--

INSERT INTO `tblourteam` (`id`, `name`, `position`, `description`, `imagepath`, `dateadded`) VALUES
(8, 'Cornelio Bastillo', 'Chef the Cuisine and Supervisor for E-learning Programs', 0x43686566204a6f6c61732069732061206361746572696e672070726f66657373696f6e616c2077697468206d6f7265207468616e203235205965617273e2809920657870657269656e636520617320457865637574697665204368656620616e642043616d7020426f7373206f6e20696e7465726e6174696f6e616c2074726164696e672076657373656c7320616e642072656d6f74652061726561732e, '../assets/img/aboutus/ourteam/Cornelio BastilloChef the Cuisine and Supervisor for E-learning Programs.jpg', '2016-09-09 07:19:05'),
(9, 'Marlon Encarnacion', 'Head Culinary Instructor', 0x43686566204d61726c6f6e20697320612063756c696e617279206578706572742077697468206d6f7265207468616e203135207965617273206f662073686970626f61726420657870657269656e63652e, '../assets/img/aboutus/ourteam/Marlon EncarnacionHead Culinary Instructor.jpg', '2016-09-09 07:19:39'),
(10, 'Adelisa F. Garrido-Lontoc', 'Head Trainer for Nutritional Education', 0x4d616d204c69736120697320612052656769737465726564204e7574726974696f6e6973742d44696574697469616e2c204469616265746573204564756361746f722e, '../assets/img/aboutus/ourteam/Adelisa F. Garrido-LontocHead Trainer for Nutritional Education.jpg', '2016-09-09 07:20:13'),
(11, 'Jaime Generalia Manalac', 'Head Trainer for Housekeeping and Restaurant', 0x41207665727920657870657269656e63656420747261696e65722077697468206d6f7265207468616e203330207965617273206f662073686970626f61726420657870657269656e63652e, '../assets/img/aboutus/ourteam/Jaime Generalia ManalacHead Trainer for Housekeeping and Restaurant.jpg', '2016-09-09 07:21:14'),
(12, 'Jose Marie Tuason', 'Operations Manager', 0x43686566204a6f6579206973206120686f73706974616c697479206578706572742077697468203230207965617273206f662073686970626f61726420657870657269656e63652e, '../assets/img/aboutus/ourteam/Jose Marie TuasonOperations Manager.jpg', '2016-09-09 07:23:24'),
(13, 'Edgar Alquisada', 'Catering Manager', 0x536972204564676172206973206120486f74656c20616e642052657374617572616e74206578706572742077697468203330207965617273206f662073686970626f61726420657870657269656e63652e, '../assets/img/aboutus/ourteam/Edgar AlquisadaCatering Manager.jpg', '2016-09-09 07:24:05'),
(14, 'Ramir Villanueva', 'Training Officer for Catering Management and Reporting Procedures', 0x52616d6972206973206120747275652070726f66657373696f6e616c2077697468206d6f7265207468616e203230207965617273206f662073686970626f61726420657870657269656e63652e, '../assets/img/aboutus/ourteam/Ramir VillanuevaTraining Officer for Catering Management and Reporting Procedures.jpg', '2016-09-09 07:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `minstudents` int(11) DEFAULT NULL,
  `maxstudents` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  `dateadded` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `username`, `password`, `dateadded`) VALUES
(1, 'admin', 'admin', '2016-09-10 05:25:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmodule`
--
ALTER TABLE `tblmodule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnews`
--
ALTER TABLE `tblnews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblobjectives`
--
ALTER TABLE `tblobjectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblourteam`
--
ALTER TABLE `tblourteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblmodule`
--
ALTER TABLE `tblmodule`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblnews`
--
ALTER TABLE `tblnews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `tblobjectives`
--
ALTER TABLE `tblobjectives`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblourteam`
--
ALTER TABLE `tblourteam`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
