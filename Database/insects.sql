-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2016 at 02:03 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insects`
--

-- --------------------------------------------------------

--
-- Table structure for table `Family`
--

CREATE TABLE `Family` (
  `family_Id` int(11) NOT NULL,
  `family_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Family`
--

INSERT INTO `Family` (`family_Id`, `family_name`) VALUES
(1, 'elasteridae'),
(2, 'Histeridae'),
(3, 'Curculiodae'),
(4, 'colydiidea'),
(5, 'bothrideridae'),
(6, 'cerambycidae'),
(7, 'saturniidae'),
(8, 'eupterotidae'),
(9, 'notodontidae'),
(10, 'noctuidae'),
(11, 'lycaenidae');

-- --------------------------------------------------------

--
-- Table structure for table `Genus`
--

CREATE TABLE `Genus` (
  `genus_id` int(11) NOT NULL,
  `genus_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Genus`
--

INSERT INTO `Genus` (`genus_id`, `genus_name`) VALUES
(1, 'melanotus'),
(2, 'neotrichophorus'),
(3, 'odontanychus'),
(4, 'olopheus'),
(5, 'pantolamprus'),
(6, 'propsephus'),
(7, 'tetralobus'),
(8, 'chropoecilus'),
(9, 'synchita'),
(10, 'sprecodes'),
(11, 'nudaurelia'),
(12, 'ANISOMEROUS');

-- --------------------------------------------------------

--
-- Table structure for table `Insects`
--

CREATE TABLE `Insects` (
  `insect_Id` int(11) NOT NULL,
  `CB` int(11) NOT NULL,
  `STB` int(11) NOT NULL,
  `order_Id` int(11) NOT NULL,
  `family_Id` int(11) NOT NULL,
  `genus_Id` int(11) NOT NULL,
  `species_Id` int(11) NOT NULL,
  `sub_family` varchar(255) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `AC_NO` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `coordinates` varchar(255) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `collector` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `preserv` varchar(255) NOT NULL,
  `Others` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Insects`
--

INSERT INTO `Insects` (`insect_Id`, `CB`, `STB`, `order_Id`, `family_Id`, `genus_Id`, `species_Id`, `sub_family`, `auth`, `AC_NO`, `country`, `location`, `coordinates`, `doc`, `collector`, `identifier`, `image`, `preserv`, `Others`) VALUES
(1, 1, 1, 2, 3, 4, 3, 'Protea', 'burg', 'B4959', 'Uganda', 'Uganda', 'in flight', '2016-10-23 18:21:07', 'Ricks', 'C.M.F Van Hayek det1967', 'ABS_SELECT.png', 'pin', ''),
(2, 1, 2, 2, 6, 4, 2, '', 'cand', 'B4978', 'Uganda', 'Uganda', 'in car', '2016-10-23 13:53:28', 'K.W.Browns', 'C.M.F Van Hayek det1964', 'insects3.jpg', 'pin', ''),
(3, 2, 3, 2, 1, 1, 1, '', 'fleunt', 'B3456', 'Tanzania', 'Ddodoma', 'on shrub', '2016-10-22 01:15:37', 'K.W.Brown', 'C.M.F Van Hayek det1987', 'strings_mysql.png', 'pin', ''),
(4, 2, 3, 3, 4, 5, 4, '', 'hope', 'B3446', 'Uganda', 'Nakawa', 'on shrub', '2016-10-22 09:17:11', 'K.W.Brown', 'C.M.F Van Hayek det1967', 'ant.jpg', 'pin', ''),
(5, 3, 2, 5, 2, 3, 2, 'protrxin', 'fleunt', 'B3239', 'Tanzania', 'Ddodoma', 'on shrub', '2016-10-22 10:49:58', 'K.W.Brown', 'C.M.F Van Hayek det1967', 'sharp.jpg', 'pin', ''),
(6, 2, 1, 1, 2, 2, 2, '', 'burg', 'B2345', 'Uganda', 'Uganda', 'in car', '2016-10-23 13:51:05', 'K.W.Brown', 'C.M.F Van Hayek det1969', 'hopper.jpg', 'pin', ''),
(7, 1, 1, 4, 6, 7, 5, 'Protea', 'burg', 'B3232', 'Tanzania', 'Mombasa', 'on shrub', '2016-10-23 13:57:13', 'k.W.Kevin', 'C.M.F Van Hayek det1987', 'fly.jpg', 'pin', '');

-- --------------------------------------------------------

--
-- Table structure for table `Order`
--

CREATE TABLE `Order` (
  `order_Id` int(11) NOT NULL,
  `order_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Order`
--

INSERT INTO `Order` (`order_Id`, `order_name`) VALUES
(1, 'coleoptera'),
(2, 'lepidoptera'),
(3, 'diptera'),
(4, 'Hemiptera'),
(5, 'Hymenoptera');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_ID` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_ID`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `Species`
--

CREATE TABLE `Species` (
  `species_Id` int(11) NOT NULL,
  `species_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Species`
--

INSERT INTO `Species` (`species_Id`, `species_name`) VALUES
(1, 'umbilcatus'),
(2, 'fossiceos'),
(3, 'canaliculatus'),
(4, 'terminatus'),
(5, 'bruneiventris');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `full_name`, `email`, `password`, `role`) VALUES
(1, 'Jeff', 'Jeff Rickson', 'jeff123@gmail.com', '$2y$10$OiYwVa0dWPnmkbFxszVZme9XFjt7VuVAgKjpR5qkLBPizX11Hde/u', 1),
(2, 'patrick', 'Patrick Adams', 'patric@yahoo.com', '$2y$10$SbX0cFYUhLngJKUXllhs2uj7bIJLpzrH/Zdnd0Hwfy2Kgw63ZaT0C', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Family`
--
ALTER TABLE `Family`
  ADD PRIMARY KEY (`family_Id`);

--
-- Indexes for table `Genus`
--
ALTER TABLE `Genus`
  ADD PRIMARY KEY (`genus_id`);

--
-- Indexes for table `Insects`
--
ALTER TABLE `Insects`
  ADD PRIMARY KEY (`insect_Id`),
  ADD KEY `Insects_Species` (`species_Id`),
  ADD KEY `Insects_Order` (`order_Id`),
  ADD KEY `Insects_Family` (`family_Id`),
  ADD KEY `Insects_Genus` (`genus_Id`);

--
-- Indexes for table `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`order_Id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `Species`
--
ALTER TABLE `Species`
  ADD PRIMARY KEY (`species_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Family`
--
ALTER TABLE `Family`
  MODIFY `family_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Genus`
--
ALTER TABLE `Genus`
  MODIFY `genus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Insects`
--
ALTER TABLE `Insects`
  MODIFY `insect_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Order`
--
ALTER TABLE `Order`
  MODIFY `order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Species`
--
ALTER TABLE `Species`
  MODIFY `species_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Insects`
--
ALTER TABLE `Insects`
  ADD CONSTRAINT `Insects_Family` FOREIGN KEY (`family_Id`) REFERENCES `Family` (`family_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Insects_Genus` FOREIGN KEY (`genus_Id`) REFERENCES `Genus` (`genus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Insects_Order` FOREIGN KEY (`order_Id`) REFERENCES `Order` (`order_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Insects_Species` FOREIGN KEY (`species_Id`) REFERENCES `Species` (`species_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
