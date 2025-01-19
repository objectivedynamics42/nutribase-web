-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2025 at 06:41 AM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `object_nutribase`
--

-- --------------------------------------------------------

--
-- Table structure for table `tagged_food`
--

CREATE TABLE `tagged_food` (
  `food_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagged_food`
--

INSERT INTO `tagged_food` (`food_id`, `tag_id`) VALUES
(8, 1),
(9, 1),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(43, 4),
(44, 4),
(45, 4),
(46, 5),
(47, 5),
(48, 5),
(51, 5),
(1, 6),
(2, 6),
(49, 6),
(7, 7),
(81, 8),
(50, 9),
(52, 9),
(53, 9),
(82, 9),
(83, 9),
(3, 10),
(4, 11),
(5, 11),
(6, 11),
(21, 12),
(54, 13),
(55, 13),
(56, 13),
(57, 13),
(58, 13),
(59, 13),
(60, 13),
(61, 13),
(62, 13),
(63, 13),
(64, 13),
(65, 13),
(66, 13),
(67, 13),
(68, 13),
(69, 13),
(70, 13),
(71, 13),
(72, 13),
(73, 13),
(74, 13),
(75, 13),
(76, 13),
(77, 13),
(78, 13),
(79, 13),
(80, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tagged_food`
--
ALTER TABLE `tagged_food`
  ADD PRIMARY KEY (`food_id`,`tag_id`),
  ADD KEY `fk_tag_id` (`tag_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagged_food`
--
ALTER TABLE `tagged_food`
  ADD CONSTRAINT `fk_food_id` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
