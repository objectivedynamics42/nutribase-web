-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2025 at 06:42 AM
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
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kcal_per_unit` decimal(10,2) NOT NULL,
  `protein_grams_per_unit` decimal(10,2) DEFAULT NULL,
  `unit_caption_override` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `kcal_per_unit`, `protein_grams_per_unit`, `unit_caption_override`) VALUES
(1, 'Chickpeas - Freshona (LIDL) - In Water', 125.00, 6.40, NULL),
(2, 'Kidney Beans', 93.00, 7.20, NULL),
(3, 'Tagliatelli - Dried, Sainsbury\'s', 358.00, NULL, NULL),
(4, 'Rice - Basmati', 351.00, NULL, NULL),
(5, 'Rice - Wholegrain, dried', 280.00, NULL, NULL),
(6, 'Rice - Wholegrain, cooked', 4321.00, NULL, NULL),
(7, 'Chicken Breast', 106.00, 32.00, NULL),
(8, 'Ryvita - Fruity', 56.00, NULL, 'Per Biscuit'),
(9, 'Bread - Wholemeal', 121.00, NULL, 'Per Round'),
(10, 'Eggs - Large', 85.00, NULL, 'Per Egg'),
(11, 'Eggs - Medium', 72.00, 7.00, 'Per Egg'),
(12, 'Parmesan', 400.00, NULL, NULL),
(13, 'Spread Cheese - Full Fat', 240.00, NULL, NULL),
(14, 'Spread Cheese - Light', 141.00, NULL, NULL),
(15, 'Greek Yoghurt - Milbona (LIDL) - Full Fat', 126.00, 4.10, NULL),
(16, 'Milk - UHT Full Fat - Tesco', 66.00, 3.50, NULL),
(17, 'Milk - Oat - Homemade', 46.00, NULL, NULL),
(18, 'Milk - UHT Skimmed - Dairy Manor (LIDL)', 35.00, 3.40, NULL),
(19, 'Milk - Soya', 33.00, NULL, NULL),
(20, 'Milk - Oat - Vemondo', 41.00, NULL, NULL),
(21, 'PhD Whey Protein Powder', 96.00, 64.00, NULL),
(22, 'Apple - Fresh', 36.00, NULL, NULL),
(23, 'Apple - Stewed', 40.00, NULL, NULL),
(24, 'Apricot - Dried, Alesto', 215.00, 2.50, NULL),
(25, 'Apricot - With Stone', 7.00, NULL, NULL),
(26, 'Banana', 89.00, NULL, NULL),
(27, 'Blackberries', 60.00, NULL, NULL),
(28, 'Dates - Dried, Alesto', 288.00, 2.50, NULL),
(29, 'Figs - Dried, Alesto', 233.00, 2.50, NULL),
(30, 'Figs - Fresh', 74.00, NULL, NULL),
(31, 'Grapes', 64.00, NULL, NULL),
(32, 'Kiwi', 44.00, NULL, NULL),
(33, 'Mango', 63.00, NULL, NULL),
(34, 'Melon', 36.00, NULL, NULL),
(35, 'Mixed Berries - Frozen', 50.00, NULL, NULL),
(36, 'Nectarine', 44.00, NULL, NULL),
(37, 'Peach', 32.00, NULL, NULL),
(38, 'Peaches and Nectarines - Frozen', 42.00, NULL, NULL),
(39, 'Pear', 36.00, NULL, NULL),
(40, 'Persimmon', 127.00, NULL, NULL),
(41, 'Pineapple - Frozen', 45.00, NULL, NULL),
(42, 'Plum', 36.00, NULL, NULL),
(43, 'Rhubarb - stewed', 27.00, NULL, NULL),
(44, 'Strawberries', 32.00, NULL, NULL),
(45, 'Tangerine - Flesh Only', 53.00, NULL, NULL),
(46, 'Bran - Whole', 368.00, NULL, NULL),
(47, 'Bran - Kellogs', 350.00, NULL, NULL),
(48, 'Granola - Lizi\'s', 501.00, NULL, NULL),
(49, 'Lentils Green - Dried', 176.00, NULL, NULL),
(50, 'Nuts - Mixed - (Lidl)', 646.00, 20.40, NULL),
(51, 'Porridge - Mornflake', 369.00, 11.50, NULL),
(52, 'Seed - Mixed - Holland & Barrett', 566.00, 23.70, NULL),
(53, 'Seed - Mixed - Alesto (LIDL)', 576.00, 23.00, NULL),
(54, 'Asparagus', 26.00, NULL, NULL),
(55, 'Aubergine', 25.00, NULL, NULL),
(56, 'Broccoli', 25.00, NULL, NULL),
(57, 'Butternut Squash', 45.00, NULL, NULL),
(58, 'Cabbage', 21.00, NULL, NULL),
(59, 'Carrot', 21.00, NULL, NULL),
(60, 'Cauliflower', 38.00, NULL, NULL),
(61, 'Celery', 7.00, NULL, NULL),
(62, 'Garlic - Fresh', 111.00, NULL, NULL),
(63, 'Garlic - Paste', 102.00, NULL, NULL),
(64, 'Ginger - Paste', 49.00, NULL, NULL),
(65, 'Mushrooms', 20.00, NULL, NULL),
(66, 'Olives', 155.00, NULL, NULL),
(67, 'Onion', 25.00, NULL, NULL),
(68, 'Peas - Frozen', 83.00, NULL, NULL),
(69, 'Pepper - Red', 24.00, NULL, NULL),
(70, 'Pepper - Yellow', 36.00, NULL, NULL),
(71, 'Potatoes - baby', 64.00, NULL, NULL),
(72, 'Runner Beans', 25.00, NULL, NULL),
(73, 'Sprouts', 51.00, NULL, NULL),
(74, 'Swede', 38.00, NULL, NULL),
(75, 'Sweet Potato', 86.00, NULL, NULL),
(76, 'Sweetcorn - Frozen', 77.00, NULL, NULL),
(77, 'Tomatoes - Tinned - Chopped', 22.00, NULL, NULL),
(78, 'Tomtatoes - Fresh', 14.00, NULL, NULL),
(79, 'Tomatoes - Passata', 37.00, NULL, NULL),
(80, 'Tomatoes - Sun Dried', 197.00, NULL, NULL),
(81, 'Rapeseed Oil', 899.00, NULL, NULL),
(82, 'Lime Pickle', 187.00, NULL, NULL),
(83, 'Pesto - Green', 184.00, NULL, NULL),
(84, 'Anchovies', 248.00, NULL, NULL),
(85, 'Mackerel in Sauce - Nixe (LIDL) - In Spicy Tomato Sauce', 103.00, 8.30, 'Per Half Can'),
(86, 'Mackerel in Sauce - Sainsbury\'s - In Spicy Jerk Sauce', 132.00, 8.50, 'Per Half Can'),
(87, 'Tuna - Nixe (LIDL) In Brine', 58.00, NULL, 'Per Half Can');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
