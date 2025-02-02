START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tagged_food;
DROP TABLE IF EXISTS food;
DROP TABLE IF EXISTS tag;

CREATE TABLE users (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE tag (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE food (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kcal_per_unit` decimal(10,2) NOT NULL,
  `protein_grams_per_unit` decimal(10,2) DEFAULT NULL,
  `unit_caption_override` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE tagged_food (
  `food_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`food_id`,`tag_id`),
  KEY `fk_tag_id` (`tag_id`),
  CONSTRAINT `fk_food_id` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tag (`name`) VALUES
('Bakery'),
('Dairy'),
('Fish'),
('Fruit'),
('Grains'),
('Legumes'),
('Meat'),
('Oil'),
('Packaged'),
('Pasta'),
('Rice'),
('Supplements'),
('Vegetables'),
('Whole Foods');

INSERT INTO `food` (`name`, `kcal_per_unit`, `protein_grams_per_unit`, `unit_caption_override`) VALUES
('Chickpeas - Freshona (LIDL) - In Water', 125.00, 6.40, NULL),
('Kidney Beans', 93.00, 7.20, NULL),
('Tagliatelli - Dried, Sainsbury', 358.00, NULL, NULL),
('Fusili - Cooked, Baresa (LIDL)', 158.00, NULL, NULL),
('Fusili - Dried, Baresa (LIDL)', 344.00, 13.0, NULL),
('Rice - Basmati, Dried', 351.00, NULL, NULL),
('Rice - Basmati, Cooked', 143.00, NULL, NULL),
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
('Granola - Lizi''s', 501.00, NULL, NULL),
('Lentils Green - Dried', 176.00, NULL, NULL),
('Nuts - Mixed - Alesto (LIDL)', 646.00, 20.40, NULL),
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
('Mackerel in Sauce - Sainsbury - In Spicy Jerk Sauce', 132.00, 8.50, 'Per Half Can'),
('Tuna - Nixe (LIDL) In Brine', 58.00, NULL, 'Per Half Can');

INSERT INTO tagged_food (`food_id`, `tag_id`)
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
  (f.name = 'Mackerel in Sauce - Sainsbury - In Spicy Jerk Sauce' AND t.name = 'Fish') OR
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
  (f.name = 'Granola - Lizi''s' AND t.name = 'Grains') OR
  (f.name = 'Porridge - Mornflake' AND t.name = 'Grains') OR
  (f.name = 'Chickpeas - Freshona (LIDL) - In Water' AND t.name = 'Legumes') OR
  (f.name = 'Kidney Beans' AND t.name = 'Legumes') OR
  (f.name = 'Lentils Green - Dried' AND t.name = 'Legumes') OR
  (f.name = 'Chicken Breast' AND t.name = 'Meat') OR
  (f.name = 'Rapeseed Oil' AND t.name = 'Oil') OR
  (f.name = 'Nuts - Mixed - Alesto (LIDL)' AND t.name = 'Packaged') OR
  (f.name = 'Seed - Mixed - Holland & Barrett' AND t.name = 'Packaged') OR
  (f.name = 'Seed - Mixed - Alesto (LIDL)' AND t.name = 'Packaged') OR
  (f.name = 'Lime Pickle' AND t.name = 'Packaged') OR
  (f.name = 'Pesto - Green' AND t.name = 'Packaged') OR
  (f.name = 'Fusili - Cooked, Baresa (LIDL)' AND t.name = 'Pasta') OR
  (f.name = 'Fusili - Dried, Baresa (LIDL)' AND t.name = 'Pasta') OR
  (f.name = 'Tagliatelli - Dried, Sainsbury' AND t.name = 'Pasta') OR
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
  (f.name = 'Tomatoes - Sun Dried' AND t.name = 'Vegetables') OR
  (f.name = 'Bran - Whole' AND t.name = 'Whole Foods') OR
  (f.name = 'Lentils Green - Dried' AND t.name = 'Whole Foods') OR
  (f.name = 'Seed - Mixed - Holland & Barrett' AND t.name = 'Whole Foods') OR
  (f.name = 'Seed - Mixed - Alesto (LIDL)' AND t.name = 'Whole Foods') OR
  (f.name = 'Nuts - Mixed - Alesto (LIDL)' AND t.name = 'Whole Foods');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
