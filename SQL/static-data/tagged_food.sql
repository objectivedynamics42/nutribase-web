
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
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`food_id`,`tag_id`),
  KEY `fk_tag_id` (`tag_id`),
  CONSTRAINT `fk_food_id` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tagged_food` (`food_id`, `tag_id`)
SELECT f.id, t.id
FROM food f, tag t
WHERE 
  (f.name = 'Ryvita - Fruity' AND t.name = 'Bakery') OR
  (f.name = 'Bread - Wholemeal' AND t.name = 'Bakery') OR
  (f.name = 'Eggs - Large' AND t.name = 'Dairy') OR
  (f.name = 'Eggs - Medium' AND t.name = 'Dairy') OR
  (f.name = 'Parmesan' AND t.name = 'Dairy') OR
  (f.name = 'Spread Cheese - Full Fat' AND t.name = 'Dairy') OR
  (f.name = 'Spread Cheese - Light' AND t.name = 'Dairy') OR
  (f.name = 'Greek Yoghurt - Milbona (LIDL) - Full Fat' AND t.name = 'Dairy') OR
  (f.name = 'Milk - UHT Full Fat - Tesco' AND t.name = 'Dairy') OR
  (f.name = 'Milk - Oat - Homemade' AND t.name = 'Dairy') OR
  (f.name = 'Milk - UHT Skimmed - Dairy Manor (LIDL)' AND t.name = 'Dairy') OR
  (f.name = 'Milk - Soya' AND t.name = 'Dairy') OR
  (f.name = 'Milk - Oat - Vemondo' AND t.name = 'Dairy') OR
  (f.name = 'Anchovies' AND t.name = 'Fish') OR
  (f.name = 'Mackerel in Sauce - Nixe (LIDL) - In Spicy Tomato Sauce' AND t.name = 'Fish') OR
  (f.name = 'Mackerel in Sauce - Sainsbury\'s - In Spicy Jerk Sauce' AND t.name = 'Fish') OR
  (f.name = 'Tuna - Nixe (LIDL) In Brine' AND t.name = 'Fish') OR
  (f.name = 'Apple - Fresh' AND t.name = 'Fruit') OR
  (f.name = 'Apple - Stewed' AND t.name = 'Fruit') OR
  (f.name = 'Apricot - Dried, Alesto' AND t.name = 'Fruit') OR
  (f.name = 'Apricot - With Stone' AND t.name = 'Fruit') OR
  (f.name = 'Banana' AND t.name = 'Fruit') OR
  (f.name = 'Blackberries' AND t.name = 'Fruit') OR
  (f.name = 'Dates - Dried, Alesto' AND t.name = 'Fruit') OR
  (f.name = 'Figs - Dried, Alesto' AND t.name = 'Fruit') OR
  (f.name = 'Figs - Fresh' AND t.name = 'Fruit') OR
  (f.name = 'Grapes' AND t.name = 'Fruit') OR
  (f.name = 'Kiwi' AND t.name = 'Fruit') OR
  (f.name = 'Mango' AND t.name = 'Fruit') OR
  (f.name = 'Melon' AND t.name = 'Fruit') OR
  (f.name = 'Mixed Berries - Frozen' AND t.name = 'Fruit') OR
  (f.name = 'Nectarine' AND t.name = 'Fruit') OR
  (f.name = 'Peach' AND t.name = 'Fruit') OR
  (f.name = 'Peaches and Nectarines - Frozen' AND t.name = 'Fruit') OR
  (f.name = 'Pear' AND t.name = 'Fruit') OR
  (f.name = 'Persimmon' AND t.name = 'Fruit') OR
  (f.name = 'Pineapple - Frozen' AND t.name = 'Fruit') OR
  (f.name = 'Plum' AND t.name = 'Fruit') OR
  (f.name = 'Rhubarb - stewed' AND t.name = 'Fruit') OR
  (f.name = 'Strawberries' AND t.name = 'Fruit') OR
  (f.name = 'Tangerine - Flesh Only' AND t.name = 'Fruit') OR
  (f.name = 'Bran - Whole' AND t.name = 'Grains') OR
  (f.name = 'Bran - Kellogs' AND t.name = 'Grains') OR
  (f.name = 'Granola - Lizi\'s' AND t.name = 'Grains') OR
  (f.name = 'Porridge - Mornflake' AND t.name = 'Grains') OR
  (f.name = 'Chickpeas - Freshona (LIDL) - In Water' AND t.name = 'Legumes') OR
  (f.name = 'Kidney Beans' AND t.name = 'Legumes') OR
  (f.name = 'Lentils Green - Dried' AND t.name = 'Legumes') OR
  (f.name = 'Chicken Breast' AND t.name = 'Meat') OR
  (f.name = 'Rapeseed Oil' AND t.name = 'Oil') OR
  (f.name = 'Nuts - Mixed - (Lidl)' AND t.name = 'Packaged') OR
  (f.name = 'Seed - Mixed - Holland & Barrett' AND t.name = 'Packaged') OR
  (f.name = 'Seed - Mixed - Alesto (LIDL)' AND t.name = 'Packaged') OR
  (f.name = 'Lime Pickle' AND t.name = 'Packaged') OR
  (f.name = 'Pesto - Green' AND t.name = 'Packaged') OR
  (f.name = 'Tagliatelli - Dried, Sainsbury\'s' AND t.name = 'Pasta') OR
  (f.name = 'Rice - Basmati, Dried' AND t.name = 'Rice') OR
  (f.name = 'Rice - Wholegrain, dried' AND t.name = 'Rice') OR
  (f.name = 'Rice - Wholegrain, cooked' AND t.name = 'Rice') OR
  (f.name = 'PhD Whey Protein Powder' AND t.name = 'Supplements') OR
  (f.name = 'Asparagus' AND t.name = 'Vegetables') OR
  (f.name = 'Aubergine' AND t.name = 'Vegetables') OR
  (f.name = 'Broccoli' AND t.name = 'Vegetables') OR
  (f.name = 'Butternut Squash' AND t.name = 'Vegetables') OR
  (f.name = 'Cabbage' AND t.name = 'Vegetables') OR
  (f.name = 'Carrot' AND t.name = 'Vegetables') OR
  (f.name = 'Cauliflower' AND t.name = 'Vegetables') OR
  (f.name = 'Celery' AND t.name = 'Vegetables') OR
  (f.name = 'Garlic - Fresh' AND t.name = 'Vegetables') OR
  (f.name = 'Garlic - Paste' AND t.name = 'Vegetables') OR
  (f.name = 'Ginger - Paste' AND t.name = 'Vegetables') OR
  (f.name = 'Mushrooms' AND t.name = 'Vegetables') OR
  (f.name = 'Olives' AND t.name = 'Vegetables') OR
  (f.name = 'Onion' AND t.name = 'Vegetables') OR
  (f.name = 'Peas - Frozen' AND t.name = 'Vegetables') OR
  (f.name = 'Pepper - Red' AND t.name = 'Vegetables') OR
  (f.name = 'Pepper - Yellow' AND t.name = 'Vegetables') OR
  (f.name = 'Potatoes - baby' AND t.name = 'Vegetables') OR
  (f.name = 'Runner Beans' AND t.name = 'Vegetables') OR
  (f.name = 'Sprouts' AND t.name = 'Vegetables') OR
  (f.name = 'Swede' AND t.name = 'Vegetables') OR
  (f.name = 'Sweet Potato' AND t.name = 'Vegetables') OR
  (f.name = 'Sweetcorn - Frozen' AND t.name = 'Vegetables') OR
  (f.name = 'Tomatoes - Tinned - Chopped' AND t.name = 'Vegetables') OR
  (f.name = 'Tomtatoes - Fresh' AND t.name = 'Vegetables') OR
  (f.name = 'Tomatoes - Passata' AND t.name = 'Vegetables') OR
  (f.name = 'Tomatoes - Sun Dried' AND t.name = 'Vegetables');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
