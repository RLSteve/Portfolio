-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2019 at 11:16 PM
-- Server version: 10.2.27-MariaDB-10.2.27+maria~xenial
-- PHP Version: 7.0.33-0ubuntu0.16.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gwurschm_3_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `animal_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `food_id`, `location_id`, `animal_type_id`) VALUES
(1, 1, 1, 1),
(2, 3, 3, 2),
(3, 3, 1, 3),
(4, 3, 1, 3),
(5, 7, 4, 4),
(6, 14, 4, 4),
(7, 7, 4, 4),
(8, 8, 6, 5),
(9, 9, 6, 5),
(10, 9, 5, 6),
(11, 10, 7, 7),
(12, 14, 8, 8),
(13, 15, 2, 9),
(14, 9, 5, 6),
(15, 15, 2, 9),
(16, 7, 4, 4),
(17, 13, 7, 7),
(18, 3, 1, 2),
(19, 15, 2, 9),
(20, 9, 6, 5),
(21, 7, 1, 3),
(22, 10, 7, 7),
(23, 2, 1, 1),
(24, 9, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `animal_reference`
--

CREATE TABLE `animal_reference` (
  `animal_type_id` int(11) NOT NULL,
  `animal_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal_reference`
--

INSERT INTO `animal_reference` (`animal_type_id`, `animal_type`) VALUES
(1, 'Panda'),
(2, 'Koala'),
(3, 'Lemur'),
(4, 'Monkey'),
(5, 'Alligator'),
(6, 'Shark'),
(7, 'Anteater'),
(8, 'Peacock'),
(9, 'Snake');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `wlevel_id` int(11) NOT NULL,
  `first_name` varchar(22) NOT NULL,
  `last_name` varchar(22) NOT NULL,
  `supervisor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `wlevel_id`, `first_name`, `last_name`, `supervisor`) VALUES
(1, 1, 'Garin ', 'Wurschmidt', 0),
(2, 1, 'Tyler', 'Jump', 0),
(3, 6, 'Charles', 'Barkley', 1),
(4, 5, 'Top', 'Dog', 0),
(5, 7, 'Chandler', 'Warnick', 1),
(8, 1, 'Marvin', 'Garvin', 0),
(9, 6, 'Bob', 'Fido', 1),
(10, 6, 'Tommy', 'John', 1),
(11, 4, 'Deep', 'Caravan', 0),
(12, 3, 'Ladyanda', 'Tramp', 0),
(13, 4, 'Lactose', 'Intolerant', 0);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `fired` AFTER DELETE ON `employee` FOR EACH ROW BEGIN
INSERT INTO ex_employee
SET
employee_id=OLD.employee_id,
level_id=OLD.wlevel_id,
first_name=OLD.first_name,
last_name=OLD.last_name,
supervisor=OLD.supervisor,
change_date= NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ex_employee`
--

CREATE TABLE `ex_employee` (
  `employee_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `first_name` varchar(22) NOT NULL,
  `last_name` varchar(22) NOT NULL,
  `supervisor` tinyint(1) NOT NULL,
  `change_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ex_employee`
--

INSERT INTO `ex_employee` (`employee_id`, `level_id`, `first_name`, `last_name`, `supervisor`, `change_date`) VALUES
(6, 7, 'Tyler', 'Faircloth', 1, '2019-12-11 16:46:10'),
(7, 3, 'Tom', 'Brady', 0, '2019-12-11 21:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `feeding`
--

CREATE TABLE `feeding` (
  `food_id` int(11) NOT NULL,
  `animal_type_id` int(11) NOT NULL,
  `amount` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feeding`
--

INSERT INTO `feeding` (`food_id`, `animal_type_id`, `amount`) VALUES
(1, 1, '1 stick'),
(2, 1, '3 fish'),
(3, 2, '2 pounds'),
(4, 3, '1 Pomegranate'),
(7, 3, '1 pound'),
(7, 4, '1 pound'),
(7, 8, '0.5 pounds'),
(8, 5, '5 pounds'),
(9, 5, '5 pounds'),
(9, 6, '5 pounds'),
(10, 7, '1 pound'),
(13, 7, '0.5 pounds'),
(14, 4, '0.5 pounds'),
(14, 7, '1 pound'),
(14, 8, '0.25 pounds'),
(15, 9, '1 Rat');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `cost_per_lb` decimal(10,2) NOT NULL,
  `food_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `cost_per_lb`, `food_name`) VALUES
(1, '5.99', 'Bamboo'),
(2, '8.49', 'Fresh Fish'),
(3, '2.99', 'Leaf'),
(4, '2.00', 'Pomegranate'),
(7, '3.49', 'Berries'),
(8, '5.00', 'Catfish'),
(9, '3.00', 'Chum'),
(10, '0.50', 'Ants'),
(13, '1.50', 'Caterpillar'),
(14, '1.50', 'Stick bugs'),
(15, '2.00', 'Rats');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`) VALUES
(1, 'Rainforest'),
(2, 'Desert'),
(3, 'Outback'),
(4, 'African Jungle'),
(5, 'Pacific'),
(6, 'Swamps'),
(7, 'Forest Floor'),
(8, 'North America');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `clock_in` datetime NOT NULL,
  `clock_out` datetime NOT NULL,
  `employee_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`clock_in`, `clock_out`, `employee_id`, `location_id`) VALUES
('2019-11-16 23:59:00', '2019-11-17 02:00:00', 1, 1),
('2019-11-18 00:00:00', '2019-11-18 00:00:00', 2, 2),
('2019-12-02 08:00:00', '2019-12-11 20:00:00', 1, 2),
('2019-12-06 12:06:03', '2019-12-06 15:00:00', 5, 3),
('2019-12-06 10:00:00', '2019-12-11 12:00:00', 3, 4),
('2019-12-12 00:00:00', '2019-12-12 05:00:00', 12, 4),
('2019-12-03 12:00:00', '2019-12-03 16:00:00', 11, 5),
('2019-12-06 13:00:00', '2019-12-06 17:00:00', 10, 5),
('2019-12-06 06:00:00', '2019-12-11 10:00:00', 8, 6),
('2019-12-06 15:50:00', '2019-12-11 20:00:00', 11, 7),
('2019-12-09 00:00:00', '2019-12-09 05:00:00', 13, 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `supervisors`
--
CREATE TABLE `supervisors` (
`first_name` varchar(22)
,`last_name` varchar(22)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `top_employees`
--
CREATE TABLE `top_employees` (
`first_name` varchar(22)
,`last_name` varchar(22)
,`wlevel_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `worker_pay`
--

CREATE TABLE `worker_pay` (
  `wlevel_id` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worker_pay`
--

INSERT INTO `worker_pay` (`wlevel_id`, `rate`) VALUES
(1, '14.00'),
(2, '14.50'),
(3, '15.50'),
(4, '17.00'),
(5, '20.00'),
(6, '18.00'),
(7, '19.00'),
(8, '21.00'),
(9, '23.50'),
(10, '27.00');

-- --------------------------------------------------------

--
-- Structure for view `supervisors`
--
DROP TABLE IF EXISTS `supervisors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`gwurschm`@`localhost` SQL SECURITY DEFINER VIEW `supervisors`  AS  select `employee`.`first_name` AS `first_name`,`employee`.`last_name` AS `last_name` from `employee` where `employee`.`supervisor` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `top_employees`
--
DROP TABLE IF EXISTS `top_employees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`gwurschm`@`localhost` SQL SECURITY DEFINER VIEW `top_employees`  AS  select `employee`.`first_name` AS `first_name`,`employee`.`last_name` AS `last_name`,`employee`.`wlevel_id` AS `wlevel_id` from `employee` where `employee`.`wlevel_id` > 2 and `employee`.`supervisor` = 0 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `animal_type_id` (`animal_type_id`);

--
-- Indexes for table `animal_reference`
--
ALTER TABLE `animal_reference`
  ADD PRIMARY KEY (`animal_type_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `wlevel_id` (`wlevel_id`);

--
-- Indexes for table `feeding`
--
ALTER TABLE `feeding`
  ADD PRIMARY KEY (`food_id`,`animal_type_id`),
  ADD KEY `animal_type_id` (`animal_type_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`clock_in`,`clock_out`,`employee_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `worker_pay`
--
ALTER TABLE `worker_pay`
  ADD PRIMARY KEY (`wlevel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `animal_reference`
--
ALTER TABLE `animal_reference`
  MODIFY `animal_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `worker_pay`
--
ALTER TABLE `worker_pay`
  MODIFY `wlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `feeding` (`food_id`),
  ADD CONSTRAINT `animal_ibfk_4` FOREIGN KEY (`animal_type_id`) REFERENCES `animal_reference` (`animal_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `animal_ibfk_5` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`wlevel_id`) REFERENCES `worker_pay` (`wlevel_id`);

--
-- Constraints for table `feeding`
--
ALTER TABLE `feeding`
  ADD CONSTRAINT `feeding_ibfk_1` FOREIGN KEY (`animal_type_id`) REFERENCES `animal_reference` (`animal_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `feeding_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `shift_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `shift_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
