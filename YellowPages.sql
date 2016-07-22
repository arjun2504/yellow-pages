-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2015 at 09:00 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `YellowPages`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
`aid` int(32) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `t` datetime DEFAULT CURRENT_TIMESTAMP,
  `cat_id` int(12) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`aid`, `filename`, `t`, `cat_id`) VALUES
(1, '1_facebook-dot-trick-cryptlife.jpg', '2015-02-15 12:14:23', 3),
(2, '2_logo1.png', '2015-02-15 12:14:56', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
`cat_id` int(12) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `cat_desc` tinyblob NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(1, 'Hotels', ''),
(2, 'Automobile', ''),
(3, 'Theatres', ''),
(4, 'Computers', 0x436f6d70757465722053746f72657320616e64204578636c757369766573),
(5, 'Technology', 0x546563686e6f6c6f67792043656e7472657320616e64204954205061726b73);

-- --------------------------------------------------------

--
-- Table structure for table `CategoryContent`
--

CREATE TABLE IF NOT EXISTS `CategoryContent` (
  `con_id` int(12) NOT NULL DEFAULT '0',
  `con_name` varchar(300) NOT NULL,
  `con_desc` longblob NOT NULL,
  `contact` int(10) DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `cat_id` int(12) DEFAULT NULL,
  `web` varchar(500) DEFAULT NULL,
  `fax` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CategoryContent`
--

INSERT INTO `CategoryContent` (`con_id`, `con_name`, `con_desc`, `contact`, `address`, `cat_id`, `web`, `fax`, `email`) VALUES
(1, 'Ambika Theater', '', 2147483647, 'Somewhere at Madurai', 3, 'http://ambigacinemas.com', NULL, NULL),
(2, 'Jazz', '', 897543210, 'idhuvum madurai la than', 3, NULL, NULL, NULL),
(3, 'Priya Computers', 0x53686f77726f6f6d20666f7220636f6d7075746572207065726970686572616c7320616e64206163636573736f72696573, 987654321, 'Sim', 4, 'http://www.priyacomputers.com', '988345432', 'priya@hotmail.com'),
(4, 'Gladiaz Technologies', 0x5765622064657369676e696e6720616e642070726f6772616d6d696e67, 2147483647, 'Simmakkal', 5, 'http://www.gladiaz.com', '0987654321', 'gladiaz@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '864faee128623e2ffa244f90d6fd5dc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
 ADD PRIMARY KEY (`aid`), ADD UNIQUE KEY `filename` (`filename`), ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `CategoryContent`
--
ALTER TABLE `CategoryContent`
 ADD PRIMARY KEY (`con_id`), ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
MODIFY `aid` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
MODIFY `cat_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `Categories` (`cat_id`);

--
-- Constraints for table `CategoryContent`
--
ALTER TABLE `CategoryContent`
ADD CONSTRAINT `categorycontent_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `Categories` (`cat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
