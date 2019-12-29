-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 02:46 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i211_final_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `production_date` date NOT NULL,
  `length` decimal(4,2) NOT NULL,
  `width` decimal(4,2) NOT NULL,
  `wood_type` varchar(30) NOT NULL,
  `image` varchar(120) NOT NULL,
  `price` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`id`, `brand`, `production_date`, `length`, `width`, `wood_type`, `image`, `price`) VALUES
(1, 1, '2017-02-13', '31.90', '8.13', '7-ply USA Hard Maple', 'element1.jpg', '30.00'),
(2, 2, '2018-11-05', '22.00', '8.13', '7-ply USA Hard Maple', 'zero1.jpg', '35.99'),
(3, 1, '2018-12-01', '30.25', '8.10', '7-ply USA Hard Maple', 'element2.jpg', '30.00'),
(4, 1, '2017-07-04', '30.00', '8.00', '7-ply USA Hard Oak', 'element3.jpg', '26.00'),
(5, 2, '2016-11-05', '31.00', '7.75', '7-ply USA Hard Maple', 'zero2.jpg', '35.00'),
(6, 2, '2018-04-15', '29.50', '8.15', '7-ply USA Hard Maple', 'zero3.jpg', '20.00'),
(15, 5, '2019-12-01', '31.90', '8.13', '7-ply USA Hard Maple', 'princess.jpg', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `board_brand`
--

CREATE TABLE `board_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_brand`
--

INSERT INTO `board_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Element'),
(6, 'test'),
(5, 'Welcome'),
(2, 'Zero');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `first_name` char(15) DEFAULT NULL,
  `last_name` char(15) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `email`, `first_name`, `last_name`, `admin`) VALUES
(4, 'TylerJ', '$2y$10$X6AeOvTi9qAUc0VBxYG4Ke8H30pPyUeOumz.uvUXZG5Upx03rePGu', 'thisemail@gmail.com', 'Tyler', 'Jump', 1),
(5, 'Test1', '$2y$10$gyVpAvT0C9SooRZtnpIjDeb69EDUvaHRzkK3wcHUm3FovayBdavDu', 'test@gmail.com', 'te', 'st', 0),
(6, 'TylerF', '$2y$10$k3b5EUTjmM8RmPGs11ekieYZ7VMVm0/knDBeY7hekf/SpHfJ.Ufvq', 'tylerf@gmail.com', 'Tyler', 'F', 1),
(7, 'TylerF', '$2y$10$p.7Ia8EXEhPowW7UFSJ9yOsf7GRGdwE/2U1ITivdqBmyvHrUUgCuK', 'tylerf@gmail.com', 'Tyler', 'F', 1),
(8, 'gwurschm', '$2y$10$M5QcW9PybqkuEJFGxEWaDel9IjFY4sA3vOwmQJqbzmW9kTxVj6HPK', 'gwurschm@iu.edu', 'Garin', 'Wurschmidt', 1),
(9, 'test', '$2y$10$3RAVlKvuO3GfrgTsJWPfd.nVhx6CSVr7eDgKvtClemUSrTUTENPX2', 'email@email.com', 'TEST', 'test', 0),
(10, 'gwurschm', '$2y$10$M5QcW9PybqkuEJFGxEWaDel9IjFY4sA3vOwmQJqbzmW9kTxVj6HPK', 'email@email.com', 'Garin', 'W', 0),
(11, 'sky', '$2y$10$vNmqcVK4BnFmlPJBS5z82OxPU4VLwfAwKlgpN/h70s.jP.vtOXUs6', 'skylarsteffen@yahoo.com', 'Skylar', 'Steffen', 0),
(12, 'Louie', '$2y$10$FbvqbMlhpT1dATp3xDy8v.pxt4e8pzy6sI.JNw97k2plk4d2MKFOG', 'email@email.com', 'Louie', 'Zhu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `board_brand`
--
ALTER TABLE `board_brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `board_brand`
--
ALTER TABLE `board_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `board`
--
ALTER TABLE `board`
  ADD CONSTRAINT `board_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `board_brand` (`brand_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
