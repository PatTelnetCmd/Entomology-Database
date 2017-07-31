-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2017 at 10:39 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

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
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `family_Id` int(11) NOT NULL,
  `family_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`family_Id`, `family_name`) VALUES
(1, 'Elasteridae'),
(2, 'Histeridae'),
(3, 'Curculiodae'),
(4, 'Colydiidea'),
(5, 'Bothrideridae'),
(6, 'Cerambycidae'),
(7, 'Saturniidae'),
(8, 'Eupterotidae'),
(9, 'Notodontidae'),
(10, 'Noctuidae');

-- --------------------------------------------------------

--
-- Table structure for table `genus`
--

CREATE TABLE `genus` (
  `genus_id` int(11) NOT NULL,
  `genus_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genus`
--

INSERT INTO `genus` (`genus_id`, `genus_name`) VALUES
(1, 'Melanotus'),
(2, 'Neotrichophorus'),
(3, 'Odontanychus'),
(4, 'Olopheus'),
(5, 'Pantolamprus'),
(6, 'Propsephus'),
(7, 'Tetralobus'),
(8, 'Chropoecilus'),
(9, 'Synchita'),
(10, 'Sprecodes'),
(11, 'Nudaurelia');

-- --------------------------------------------------------

--
-- Table structure for table `insects`
--

CREATE TABLE `insects` (
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
  `doc` tinytext NOT NULL,
  `collector` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `preserv` varchar(255) NOT NULL,
  `Others` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insects`
--

INSERT INTO `insects` (`insect_Id`, `CB`, `STB`, `order_Id`, `family_Id`, `genus_Id`, `species_Id`, `sub_family`, `auth`, `AC_NO`, `country`, `location`, `coordinates`, `doc`, `collector`, `identifier`, `image`, `preserv`, `Others`) VALUES
(1, 1, 1, 2, 3, 4, 3, 'Protea', 'burg', 'B4959', 'Uganda', 'Uganda', 'in flight', '02/03/2016', 'Ricks', 'C.M.F Van Hayek det1967', 'ABS_SELECT.png', 'pin', ''),
(2, 1, 2, 2, 6, 4, 2, '', 'cand', 'B4978', 'Uganda', 'Uganda', 'in car', '03/01/2016', 'K.W.Browns', 'C.M.F Van Hayek det1964', 'insects3.jpg', 'pin', ''),
(3, 2, 3, 2, 1, 1, 1, '', 'fleunt', 'B3456', 'Tanzania', 'Ddodoma', 'on shrub', '23/01/2017', 'K.W.Brown', 'C.M.F Van Hayek det1987', 'strings_mysql.png', 'pin', ''),
(4, 2, 3, 3, 4, 5, 4, '', 'hope', 'B3446', 'Uganda', 'Nakawa', 'on shrub', '28/02/2017', 'K.W.Brown', 'C.M.F Van Hayek det1967', 'ant.jpg', 'pin', ''),
(5, 3, 2, 5, 2, 3, 2, 'protrxin', 'fleunt', 'B3239', 'Tanzania', 'Ddodoma', 'on shrub', '08/11/2016', 'K.W.Brown', 'C.M.F Van Hayek det1967', 'sharp.jpg', 'pin', ''),
(6, 2, 1, 1, 2, 2, 2, '', 'burg', 'B2345', 'Uganda', 'Uganda', 'in car', '03/12/2016', 'K.W.Brown', 'C.M.F Van Hayek det1969', 'hopper.jpg', 'pin', ''),
(7, 1, 1, 4, 6, 7, 5, 'Protea', 'burg', 'B3232', 'Tanzania', 'Mombasa', 'on shrub', '14/06/2016', 'k.W.Kevin', 'C.M.F Van Hayek det1987', 'fly.jpg', 'pin', ''),
(8, 2, 3, 2, 2, 2, 3, '', 'burg', 'CW-0838939', 'Uganda', 'Kawempe', '23078', '29/07/2017', 'Ken W James', 'KW Organ', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_Id` int(11) NOT NULL,
  `order_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_Id`, `order_name`) VALUES
(1, 'Coleoptera'),
(2, 'Lepidoptera'),
(3, 'Diptera'),
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
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `species_Id` int(11) NOT NULL,
  `species_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`species_Id`, `species_name`) VALUES
(1, 'Umbilcatus'),
(2, 'Fossiceos'),
(3, 'Canaliculatus'),
(4, 'Terminatus'),
(5, 'Bruneiventris');

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
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`family_Id`);

--
-- Indexes for table `genus`
--
ALTER TABLE `genus`
  ADD PRIMARY KEY (`genus_id`);

--
-- Indexes for table `insects`
--
ALTER TABLE `insects`
  ADD PRIMARY KEY (`insect_Id`),
  ADD KEY `Insects_Species` (`species_Id`),
  ADD KEY `Insects_Order` (`order_Id`),
  ADD KEY `Insects_Family` (`family_Id`),
  ADD KEY `Insects_Genus` (`genus_Id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_Id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
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
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `family_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `genus`
--
ALTER TABLE `genus`
  MODIFY `genus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `insects`
--
ALTER TABLE `insects`
  MODIFY `insect_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
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
-- Constraints for table `insects`
--
ALTER TABLE `insects`
  ADD CONSTRAINT `Insects_Family` FOREIGN KEY (`family_Id`) REFERENCES `family` (`family_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Insects_Genus` FOREIGN KEY (`genus_Id`) REFERENCES `genus` (`genus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Insects_Order` FOREIGN KEY (`order_Id`) REFERENCES `order` (`order_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Insects_Species` FOREIGN KEY (`species_Id`) REFERENCES `species` (`species_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
