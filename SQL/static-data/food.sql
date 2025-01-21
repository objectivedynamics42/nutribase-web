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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kcal_per_unit` decimal(10,2) NOT NULL,
  `protein_grams_per_unit` decimal(10,2) DEFAULT NULL,
  `unit_caption_override` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`name`, `kcal_per_unit`, `protein_grams_per_unit`, `unit_caption_override`) VALUES
('Chickpeas - Freshona (LIDL) - In Water', 125.00, 6.40, NULL),
('Kidney Beans', 93.00, 7.20, NULL),
('Tagliatelli - Dried, Sainsbury\'s', 358.00, NULL, NULL),
('Rice - Basmati, Dried', 351.00, NULL, NULL),
('Rice - Wholegrain, dried', 280.00, NULL, NULL),
('Rice - Wholegrain, cooked', 4321.00, NULL, NULL),
('Chicken Breast', 106.00, 32.00, NULL),
('Ryvita - Fruity', 56.00, NULL, 'Per Biscuit'),
('Bread - Wholemeal', 121.00, NULL, 'Per Round'),
('Eggs - Large', 85.00, NULL, 'Per Egg'),
('Eggs - Medium', 72.00, 7.00, 'Per Egg'),
('Parmesan', 400.00, NULL, NULL),
('Spread Cheese - Full Fat', 240.00, NULL, NULL),
('Spread Cheese - Light', 141.00, NULL, NULL),
('Greek Yoghurt - Milbona (LIDL) - Full Fat', 126.00, 4.10, NULL),
('Milk - UHT Full Fat - Tesco', 66.00, 3.50, NULL),
('Milk - Oat - Homemade', 46.00, NULL, NULL),
('Milk - UHT Skimmed - Dairy Manor (LIDL)', 35.00, 3.40, NULL),
('Milk - Soya', 33.00, NULL, NULL),
('Milk - Oat - Vemondo', 41.00, NULL, NULL),
('PhD Whey Protein Powder', 96.00, 64.00, NULL),
('Apple - Fresh', 36.00, NULL, NULL),
('Apple - Stewed', 40.00, NULL, NULL),
('Apricot - Dried, Alesto', 215.00, 2.50, NULL),
('Apricot - With Stone', 7.00, NULL, NULL),
('Banana', 89.00, NULL, NULL),
('Blackberries', 60.00, NULL, NULL),
('Dates - Dried, Alesto', 288.00, 2.50, NULL),
('Figs - Dried, Alesto', 233.00, 2.50, NULL),
('Figs - Fresh', 74.00, NULL, NULL),
('Grapes', 64.00, NULL, NULL),
('Kiwi', 44.00, NULL, NULL),
('Mango', 63.00, NULL, NULL),
('Melon', 36.00, NULL, NULL),
('Mixed Berries - Frozen', 50.00, NULL, NULL),
('Nectarine', 44.00, NULL, NULL),
('Peach', 32.00, NULL, NULL),
('Peaches and Nectarines - Frozen', 42.00, NULL, NULL),
('Pear', 36.00, NULL, NULL),
('Persimmon', 127.00, NULL, NULL),
('Pineapple - Frozen', 45.00, NULL, NULL),
('Plum', 36.00, NULL, NULL),
('Rhubarb - stewed', 27.00, NULL, NULL),
('Strawberries', 32.00, NULL, NULL),
('Tangerine - Flesh Only', 53.00, NULL, NULL),
('Bran - Whole', 368.00, NULL, NULL),
('Bran - Kellogs', 350.00, NULL, NULL),
('Granola - Lizi\'s', 501.00, NULL, NULL),
('Lentils Green - Dried', 176.00, NULL, NULL),
('Nuts - Mixed - (Lidl)', 646.00, 20.40, NULL),
('Porridge - Mornflake', 369.00, 11.50, NULL),
('Seed - Mixed - Holland & Barrett', 566.00, 23.70, NULL),
('Seed - Mixed - Alesto (LIDL)', 576.00, 23.00, NULL),
('Asparagus', 26.00, NULL, NULL),
('Aubergine', 25.00, NULL, NULL),
('Broccoli', 25.00, NULL, NULL),
('Butternut Squash', 45.00, NULL, NULL),
('Cabbage', 21.00, NULL, NULL),
('Carrot', 21.00, NULL, NULL),
('Cauliflower', 38.00, NULL, NULL),
('Celery', 7.00, NULL, NULL),
('Garlic - Fresh', 111.00, NULL, NULL),
('Garlic - Paste', 102.00, NULL, NULL),
('Ginger - Paste', 49.00, NULL, NULL),
('Mushrooms', 20.00, NULL, NULL),
('Olives', 155.00, NULL, NULL),
('Onion', 25.00, NULL, NULL),
('Peas - Frozen', 83.00, NULL, NULL),
('Pepper - Red', 24.00, NULL, NULL),
('Pepper - Yellow', 36.00, NULL, NULL),
('Potatoes - baby', 64.00, NULL, NULL),
('Runner Beans', 25.00, NULL, NULL),
('Sprouts', 51.00, NULL, NULL),
('Swede', 38.00, NULL, NULL),
('Sweet Potato', 86.00, NULL, NULL),
('Sweetcorn - Frozen', 77.00, NULL, NULL),
('Tomatoes - Tinned - Chopped', 22.00, NULL, NULL),
('Tomtatoes - Fresh', 14.00, NULL, NULL),
('Tomatoes - Passata', 37.00, NULL, NULL),
('Tomatoes - Sun Dried', 197.00, NULL, NULL),
('Rapeseed Oil', 899.00, NULL, NULL),
('Lime Pickle', 187.00, NULL, NULL),
('Pesto - Green', 184.00, NULL, NULL),
('Anchovies', 248.00, NULL, NULL),
('Mackerel in Sauce - Nixe (LIDL) - In Spicy Tomato Sauce', 103.00, 8.30, 'Per Half Can'),
('Mackerel in Sauce - Sainsbury\'s - In Spicy Jerk Sauce', 132.00, 8.50, 'Per Half Can'),
('Tuna - Nixe (LIDL) In Brine', 58.00, NULL, 'Per Half Can');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
