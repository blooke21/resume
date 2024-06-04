-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 02:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busybee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(125) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `category_description` varchar(450) COLLATE utf8mb4_bin NOT NULL,
  `category_img_path` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `category_alt` varchar(250) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_img_path`, `category_alt`) VALUES
(1, 'Granola Barzzz', 'Our gluten-free granola barzzz are the perfect snack for the “buzzy” hive on the move. The all-natural oats used in the bars are USDA-certified Organic and were grown without non-GMOs. ', 'green-gronola-icon', 'Icon of a granola bar'),
(2, 'Honey Products', 'Our award-winning honey is so good, we named our company after it.', 'yellow-honey-icon', 'Icon of a honey jar'),
(3, 'Packaged Nutzzz', '', 'green-nuts-icon', 'Icon of a single nut'),
(4, 'Yogurtzzz', 'Busy as a bee or just looking for a delicious snack. Our irresistible and creamy yogurtzzz is a perfect snack for every occasion. By providing a tremendous 13 grams of protein and only 82 calories (about 7 minutes of running) per serving our yogurtzzz perfectly balances being delicious and nutritious.', 'yellow-yogurt-icon', 'Icon of a yogurt'),
(5, 'Popsiclezzz', 'Looking for a way to crave your sweet tooth but want to remain health-conscious?? Our “cool” zero-sugar popsicles are here to save the day! ', 'green-popsicle-icon', 'Icon of a popsicle');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(125) COLLATE utf8mb4_bin DEFAULT NULL,
  `purpose` varchar(125) COLLATE utf8mb4_bin DEFAULT NULL,
  `msg` varchar(420) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `purpose`, `msg`) VALUES
(8, 'Blake', 'blake@balke.com', 'question', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first` varchar(75) COLLATE utf8mb4_bin DEFAULT NULL,
  `last` varchar(75) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(75) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_bin DEFAULT NULL,
  `address` varchar(75) COLLATE utf8mb4_bin DEFAULT NULL,
  `country` varchar(75) COLLATE utf8mb4_bin DEFAULT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `zip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first`, `last`, `email`, `password`, `phone`, `address`, `country`, `state`, `zip`) VALUES
(1, 'David', 'Davidson', 'test@test.com', '123456', '920', 'Next door', 'testss', 'te', 53011),
(2, 'Bobby', 'Bobberson', 'bob@bob.com', 'bob', '222222222', '222 Bob Way', 'United States', 'WI', 52011),
(3, 'Luke', 'Lukerson', 'luke@luke.com', 'luke', '555', 'lukvile', 'United States', 'AZ', 15356),
(4, 'Marry', 'Huggen', 'marry@marry.com', 'marry', '84665', '625 Marry Way', 'United States', 'OK', 566516),
(5, ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0),
(422, 'Megan', 'Voypick', 'doug.hamm@gotoltc.edu', '123LTC', '', '1290 North Ave.', 'United States', 'Wi', 53015),
(423, 'James', 'Rice', 'james.rice@gotoltc.edu', 'password', '1234567890', '321 Street Dr', 'USA', 'Wi', 53085),
(424, 'Dino Master ', 'Vang', 'eli.vang@gotoltc.edu', 'Ephala0126', '920.693.1729', '1548 N 16th Street', 'Sheboygan', 'WI', 53081),
(425, '', '', 'exitkielbicki@gmail.com', 'BusyBees2023!', '', '', '', '', 0),
(426, 'Nunya', 'Who\'s asking?', 'buttfuckslutsuck@gmail.com', 'bitchesaintshit', '911', 'On the Block', 'Afghan yo', 'so', 90210),
(427, 'Chucky', 'Cucky', 'gayboi@gmail.com', 'nika', '9208899443', '4206 Chuck Ave', 'China', 'Br', 16233);

-- --------------------------------------------------------

--
-- Table structure for table `fav_list`
--

CREATE TABLE `fav_list` (
  `fav_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `fav_list`
--

INSERT INTO `fav_list` (`fav_id`, `customer_id`, `product_id`) VALUES
(26, 1, 5),
(28, 422, 2),
(29, 423, 1),
(30, 423, 3),
(31, 424, 5),
(32, 426, 11),
(33, 426, 13),
(34, 426, 40),
(35, 427, 30),
(36, 427, 31);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `CVV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_id`, `customer_id`, `num`, `name`, `exp_month`, `exp_year`, `CVV`) VALUES
(2, 1, 234324234, 'test', 3, 25, 225);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `img_path` varchar(125) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(450) COLLATE utf8mb4_bin NOT NULL,
  `ingredients` varchar(750) COLLATE utf8mb4_bin NOT NULL,
  `alt` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `page-description` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `page-title` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `ounces` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL,
  `size` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `honey` tinyint(1) NOT NULL,
  `must_have` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `name`, `img_path`, `description`, `ingredients`, `alt`, `page-description`, `page-title`, `ounces`, `size`, `price`, `honey`, `must_have`) VALUES
(1, 1, 'Strawbarzzz', 'images/granola/strawbarzzz', 'These Barzzz are complemented by the sweet and slightly sour flavor notes of our dehydrated strawberries, turning a plain granola snack into a delicious treat. Not just a regular granola bar, but a tasty, fun, and healthy strawberry granola bar (Beat the Rest with the Best)', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Dried Strawberry, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, StrawberryJuice Concentrate, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'strawbarzzz granola bar', 'Strawbarzzz are complemented by the sweet and slightly sour flavor notes of our dehydrated strawberries, turning a plain gran', 'Strawbarzzz | Strawberry Flavored Granola Barzzz', NULL, 12, '2.99', 0, 0),
(2, 1, 'Bluebarzzz', 'images/granola/bluebarzzz', 'By utilizing the sweet but woody flavor of our dehydrated blueberries, these Barzzz are transformed into a healthy delectable snack. Not just a regular granola bar, but a very tasty, fun, and healthy blueberry granola bar.', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Dried Blueberries, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, Blueberry Juice Concentrate, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'bluebarzzz granola bar', 'Bluebarzz are complemented by the sweet and sour flavor of our dehydrated blueberries, turn a bland granola bar into a delici', 'Bluebarzzz| Blueberry Flavored Granola Barzzz', NULL, 12, '1.99', 0, 0),
(3, 1, 'Vanilla and Banana Chunks', 'images/granola/vanilla-and-banana-chunks', 'The combination of the savory vanilla and sweet banana transforms these Barzzz into an irresistible snack while still upholding its healthy traits.', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Dried Bananas, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, Vanilla Concentrate, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'vanilla and banana chunk granola bars', 'Vanilla and Banana Chunk Granola Bars are complemented by the sweet taste of our vanilla pudding and banana chunks which turn', 'Vanilla and Banana Chunks|Vanilla and Banana Flavored Granola Barzzz', NULL, 12, '2.99', 0, 0),
(4, 1, 'Crunchy Honey', 'images/granola/crunchy-honey', 'The inclusion of our award-winning honey uplifts these Barzzz into a league of their own. The floral and woody flavor of the honey melds and elevates this simple snack from a bland filler to a nutritious and glamorous treat that will leave you positively buzzing.', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Our Award-Winning-Honey, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'crunchy honey granola bars', 'Crunchy Honey Granola Bars are complemented by the nice sweet taste of our award winning honey which turns a bland granola ba', 'Crunchy Honey| Honey Flavored Granola Barzzz', NULL, 12, '2.99', 1, 1),
(5, 2, 'Busy Bee Award Honey', 'images/Honey/award-honey', 'Do not believe us? Try it out yourself! Our home-made (and home-loved) honey will buzzy its way straight into your heart!', 'Pure Award-Winning Honey... That\'s it', 'award-winning-honey, the perfect healthy snack', 'Our Award Winning Honey is award winning for a reason! This healthy snack is a perfect way to make a healthy breakfast taste ', 'Award-Winning-Honey | The perfect healthy snack ', '12 oz', 12, '4.19', 1, 1),
(6, 2, 'Honey Sticks', 'images/Honey/honeystick', 'Want to enjoy our award-winning honey in a simpler, quicker way. These perfectly portioned honey sticks allow anyone to savor our honey by itself in an effortless way!', 'Pure Award-Winning Honey... That\'s it', 'honey sticks, the perfect easy appetizer', 'Want to enjoy our award-winning honey in a simpler, quicker way. This easy appetizer is a good snack for busier bees!', 'Honey Sticks | For healthy honey lovers on the go!', NULL, 20, '5.49', 1, 0),
(7, 3, 'Almondzzz', 'images/Nut/almondzzz', 'Our most popular Nutzzz the Almond contains a hugely impressive nutrient profile. Along with its bold flavor a single serving (1 oz) comprises over 6 grams of protein and 48% of the daily value of Vitamin E.', 'Almonds (Pasteurized), Refined, Bleached and Deodorized Highly Refined Peanut Oil. Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'almond nuts', 'Almondzzz are complemented by the salty taste which is delicious to eat. ', 'Almondzzz|Almond Nutzzz', '1.5 oz', 12, '9.99', 0, 0),
(8, 3, 'Walnutzzz', 'images/Nut/walnutzzz', 'Our English Walnuts are an excellent provider of Omega-3s which help combat and reduce heart disease risk. Its complex flavor which comprises both a sharp and tangy note will leave you craving for more.', 'Walnuts, Refined, Bleached and Deodorized Highly Refined Peanut Oil. **May contain occasional shell fragment.** Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'walnut nuts ', 'Walnutzzz are complemented by the taste of salt that will make your mouth water. Our Walnuts are healthier and organic. Walnu', 'Walnutzzz| Walnut Nutzzz', '1.5 oz', 12, '9.99', 0, 0),
(9, 3, 'Cashewzzz', 'images/Nut/cashewzzz', 'These keto-friendly nuts are the perfect health-conscious snack. The mild but creamy and rich texture of our cashew\'s contrasts with the lower fat count per serving (1 oz) of most other nuts. Just one serving of these delectable nuts provides over 38% of the daily value of monounsaturated fat, which promotes cardiovascular health.', 'Cashews, Highly Refined Peanut Oil, Flour Salt. Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'cashew nuts', 'Cashewzz are complemented by the tasty, fun, and delicious flavor of salt which can make a regular cashew more tempting to ea', 'Cashewzzz|Cashew Nutzzz', '1.5 oz', 12, '11.99', 0, 0),
(10, 3, 'Variety Pack', 'images/Nut/variety-box', 'The combination of our Almonds, Cashews, and English Walnuts results in the ultimate \"on-the-go\" nutzzz all in one bag! This \"cross-pollination\" is prevalent in their flavor medleys and in their health benefits. Providing a well-rounded source of proteins, various vitamins, and antioxidants.', 'Almonds, Cashews, Pistachios, Sea Salt, Salt, Highly Refined Peanut Oil. Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'variety pack of our nut products', 'Our variety pack offers a variety of our nut products for everyone to try in one box.', 'Variety Pack| Assorted flavors of our nut products', '1.5 oz', 24, '18.99', 0, 0),
(11, 4, 'Strawberry Yogurtzzz', 'images/Yogurt/strawberry-yogurtzzz', 'the sweet flavor provided by the strawberries directly compliments the creamy texture of the irresistible yogurt, which subsequently transcends the plain yogurt into our “hive” favor strawberry yogurtzzz.', 'Cultured Non Fat Milk; Water; Strawberries; Less Than 1%: Natural & Artificial Flavors; Black Carrot Juice & Carmine (For Color); Modified Food Starch; Acesulfame Potassium; Sucralose; Fructose; Malic Acid; Potassium Sorbate (To Maintain Freshness); Active Yogurt Cultures L. Bulgaricus & S. Thermophilus.', 'strawberry yogurt', 'Strawberry Yogurt is complemented by the smooth flavor of strawberries in this nutritious snack.  Our Strawberry Yogurt is he', 'Strawberry Yogurtzzz| Strawberry Flavored Yogurt', '6 oz', 8, '4.89', 0, 0),
(12, 4, 'Berry Blast Yogurtzzz', 'images/Yogurt/berry-blast-yogurtzzz', 'Blueberry and raspberry have joined forces to deliver the Berry Blast Yogurtzzz. This combo will blast you away with their sweet yet woody flavors and create pure bliss when complimented by the creaminess of the yogurt.', 'Cultured Non Fat Milk, Water, Milk Protein Concentrate, Less than 1%: Modified Food Starch, Natural and Artificial Flavors, Fruit and Vegetable Juice (for Color), Lemon Juice Concentrate, Lactase**, Sucralose, Acesulfame Potassium, Vitamin D3, Active Yogurt Cultures L. Bulgaricus & S. Thermophilus.', 'berry blast yogurt', 'Berry Blast Yogurt is complemented by the flavors of varieties of berries that are sweet and sour which makes this yogurt fla', 'Berry Blast Yogurtzzz| Berry Flavored Yogurt', '6 oz', 8, '3.89', 0, 0),
(13, 4, 'Creamy Honey Yogurtzzz', 'images/Yogurt/creamy-honey-yogurtzzz', 'This might be the closest someone can get to tasting heaven. The flavor fusion of our award-winning honey and the creamy all-natural yogurt will leave you buzzing for more!', 'Cultured Non Fat Milk; Water; Award-Winning Honey; Less Than 1%: Natural & Artificial Flavors; Black Carrot Juice & Carmine (For Color); Modified Food Starch; Acesulfame Potassium; Sucralose; Fructose; Malic Acid; Potassium Sorbate (To Maintain Freshness); Active Yogurt Cultures L. Bulgaricus & S. Thermophilus.', 'creamy honey yogurt', 'Creamy Honey Yogurt is complemented by the taste of honey which is sweet and savory which will make your mouth water. Our Cre', 'Creamy Honey Yogurtzzz|Creamy Honey Flavored Yogurt', '6 oz', 8, '5.89', 1, 0),
(14, 5, 'Cool Honey Popsiclezzz', 'images/Popsicle/cool-honey', 'This time our award-winning honey has snuck its way into another one of our irresistible products! Enjoy the sweet flavor of the honey as you indulge in a frozen nasty treat.', 'Our Award-Winning Honey; Water; Cane Sugar; Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'cool honey popsicles ', 'Cool Honey Popsiclezzz are complemented by the delicious sweet flavor that is craved in a popsicle on a hot summer day. Our C', 'Cool Honey Popsiclezzz| Cool Honey Flavored Popsiclezzz', '18 oz', 6, '4.98', 1, 1),
(15, 5, 'Strawberry and Banana Popsiclezzz', 'images/Popsicle/strawberry-and-banana', 'The sweet flavor provided by the strawberries directly compliments the creamy texture of the irresistible yogurt, which subsequently transcends the plain yogurt into our “hive” favor strawberry yogurtzzz.', 'Banana Puree; Strawberry Juice From Concentrate (Water; Strawberry Juice Concentrate); Water; Cane Sugar; Lemon Juice From Concentrate (Water; Lemon Juice Concentrate); Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'strawberry and banana popsicles', 'Strawberry and Banana Popsiclezzz are complemented by a delicious flavor of fresh strawberries and bananas with a sweet and s', 'Strawberry and Banana Popsiclezzz| Strawberry and Banana Flavored Popsiclezzz', '18 oz', 6, '3.89', 0, 0),
(16, 5, 'Berry Blast Popsiclezzz', 'images/Popsicle/berry-blast', 'Blueberry and raspberry have joined forces to deliver the Berry Blast Popsiclezzz. This combo will blast you away with their sweet yet woody flavors and create pure bliss when complimented by the creaminess of the yogurt-based popsicle.', 'Red Raspberry Puree; Raspberry Juice From Concentrate (Water; Raspberry Juice Concentrate); Water; Cane Sugar; Lemon Juice From Concentrate (Water; Lemon Juice Concentrate); Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'berry blast popsicles', 'Berry Blast Popsiclezz is complemented by the flavors of varieties of berries that are sweet and sour which makes the popsicl', 'Berry Blast Popsiclezzz| Berry Flavored Popsiclezzz', '18 oz', 6, '3.89', 0, 0),
(17, 5, 'Peach Popsiclezzz', 'images/Popsicle/peach', 'Nothing is sweeter than a peach… well except for our Positively Peach Popsiclezzz!', 'Peach Puree; Peach Juice From Concentrate (Water; Peach Juice Concentrate); Water; Cane Sugar; Lemon Juice From Concentrate (Water; Lemon Juice Concentrate); Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'peach popsicles ', 'Peach Popsiclezzz is complemented by fresh Peaches that are juicy and sour so your taste buds will water. Our Peach Popsicles', 'Peach Popsiclezzz| Peach Flavored Popsiclezzz ', '18 oz', 6, '2.89', 0, 0),
(18, 3, 'Honey-Roasted Almondzzz', 'images/Nut/honey-roasted-almondzzz', 'Our most popular Nutzzz the Almond contains a hugely impressive nutrient profile. Along with its bold flavor a single serving (1 oz) comprises over 6 grams of protein and 48% of the daily value of Vitamin E.', 'Almonds (Pasteurized), Roasted in our Award-Winning Honey, Highly Refined Peanut Oil, Salt Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'honey roasted almonds', 'Honey Roasted Almondzzz are complemented by the fun, delicious flavor of honey which turns a boring, plain walnut, into a yum', 'Honey-Roasted Almondzzz| Honey Roasted Flavored Almondzzz', '1.5 oz', 12, '10.99', 1, 0),
(19, 3, 'Honey-Roasted Walnutzzz', 'images/Nut/honey-roasted-walnutzzz', 'Our English Walnuts are an excellent provider of Omega-3s which help combat and reduce heart disease risk. Its complex flavor which comprises both a sharp and tangy note will leave you craving for more.', 'Walnuts(Pasteurized), Roasted in our Award-Winning Honey, Highly Refined Peanut Oil, Salt Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'honey roasted walnuts ', 'Honey Roasted Flavored Walnutzzz are complemented by the yummy taste of honey which turns a bland walnut into a delicious one', 'Honey-Roasted Walnutzzz|Honey Roasted Flavored Walnutzzz', '1.5 oz', 12, '10.99', 1, 0),
(20, 3, 'Honey-Roasted Cashewzzz', 'images/Nut/honey-roasted-cashewzzz', 'These keto-friendly nuts are the perfect health-conscious snack. The mild but creamy and rich texture of our cashew\'s contrasts with the lower fat count per serving (1 oz) of most other nuts. Just one serving of these delectable nuts provides over 38% of the daily value of monounsaturated fat, which promotes cardiovascular health.', 'Cashews(Pasteurized), Roasted in our Award-Winning Honey, Highly Refined Peanut Oil, Salt Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'honey roasted cashews', 'Honey Roasted Flavored Cashewzzz are complemented by the taste of delicious honey which turns a bland cashew into a delicious', 'Honey-Roasted Cashewzzz|Honey Roasted Flavored Cashewzzz', '1.5 oz', 12, '12.99', 1, 0),
(21, 1, 'Strawbarzzz', 'images/granola/strawbarzzz', 'These Barzzz are complemented by the sweet and slightly sour flavor notes of our dehydrated strawberries, turning a plain granola snack into a delicious treat. Not just a regular granola bar, but a tasty, fun, and healthy strawberry granola bar (Beat the Rest with the Best)', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Dried Strawberry, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, StrawberryJuice Concentrate, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'strawbarzzz granola bar', 'Strawbarzzz are complemented by the sweet and slightly sour flavor notes of our dehydrated strawberries, turning a plain gran', 'Strawbarzzz | Strawberry Flavored Granola Barzzz', NULL, 24, '5.99', 0, 0),
(22, 1, 'Bluebarzzz', 'images/granola/bluebarzzz', 'By utilizing the sweet but woody flavor of our dehydrated blueberries, these Barzzz are transformed into a healthy delectable snack. Not just a regular granola bar, but a very tasty, fun, and healthy blueberry granola bar', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Dried Blueberries, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, Blueberry Juice Concentrate, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).\r\n', 'bluebarzzz granola bar', 'Bluebarzz are complemented by the sweet and sour flavor of our dehydrated blueberries, turn a bland granola bar into a delici', 'Bluebarzzz| Blueberry Flavored Granola Barzzz', NULL, 24, '5.99', 0, 0),
(23, 1, 'Vanilla and Banana Chunks', 'images/granola/vanilla-and-banana-chunks', 'The combination of the savory vanilla and sweet banana transforms these Barzzz into an irresistible snack while still upholding its healthy traits.', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Dried Bananas, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, Vanilla Concentrate, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'vanilla and banana chunk granola bars', 'Vanilla and Banana Chunk Granola Bars are complemented by the sweet taste of our vanilla pudding and banana chunks which turn', 'Vanilla and Banana Chunks|Vanilla and Banana Flavored Granola Barzzz', NULL, 24, '5.99', 0, 0),
(24, 1, 'Crunchy Honey', 'images/granola/crunchy-honey', 'The inclusion of our award-winning honey uplifts these Barzzz into a league of their own. The floral and woody flavor of the honey melds and elevates this simple snack from a bland filler to a nutritious and glamorous treat that will leave you positively buzzing. ', 'Whole Grain Blend (Rolled Oats, Rye Flakes), Enriched Flour [wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate (Vitamin B1), Riboflavin (Vitamin B2), Folic Acid), Canola Oil, Sugar, Whole Grain Wheat Flour, Evaporated Cane Sugar, Our Award-Winning-Honey, Malt Syrup (From Corn And Barley), Invert Sugar, Baking Soda, Salt, Soy Lecithin, Disodium Pyrophosphate, Natural Flavor, Datem, Ferric Orthophosphate (Iron), Niacinamide, Pyridoxine Hydrochloride (Vitamin B6), Riboflavin (Vitamin B2), Thiamin Mononitrate (Vitamin B1).', 'crunchy honey granola bars', 'Crunchy Honey Granola Bars are complemented by the nice sweet taste of our award winning honey which turns a bland granola ba', 'Crunchy Honey| Honey Flavored Granola Barzzz', NULL, 24, '5.99', 1, 0),
(25, 3, 'Almondzzz', 'images/Nut/almondzzz', 'Our most popular Nutzzz the Almond contains a hugely impressive nutrient profile. Along with its bold flavor a single serving (1 oz) comprises over 6 grams of protein and 48% of the daily value of Vitamin E.', 'Almonds (Pasteurized), Refined, Bleached and Deodorized Highly Refined Peanut Oil. Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'Almondzzz|Almond Nutzzz', 'Almondzzz are complemented by the salty taste which is delicious to eat. ', 'Almondzzz|Almond Nutzzz', '1.5 oz', 24, '16.99', 0, 0),
(26, 3, 'Walnutzzz', 'images/Nut/walnutzzz', 'Our English Walnuts are an excellent provider of Omega-3s which help combat and reduce heart disease risk. Its complex flavor which comprises both a sharp and tangy note will leave you craving for more.', 'Walnuts, Refined, Bleached and Deodorized Highly Refined Peanut Oil. **May contain occasional shell fragment.** Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'walnut nuts ', 'Walnutzzz are complemented by the taste of salt that will make your mouth water. Our Walnuts are healthier and organic. Walnu', 'Walnutzzz| Walnut Nutzzz', '1.5 oz', 24, '17.99', 0, 0),
(27, 3, 'Cashewzzz', 'images/Nut/cashewzzz', 'These keto-friendly nuts are the perfect health-conscious snack. The mild but creamy and rich texture of our cashew\'s contrasts with the lower fat count per serving (1 oz) of most other nuts. Just one serving of these delectable nuts provides over 38% of the daily value of monounsaturated fat, which promotes cardiovascular health.', 'Cashews, Highly Refined Peanut Oil, Flour Salt. Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'cashew nuts', 'Cashewzz are complemented by the tasty, fun, and delicious flavor of salt which can make a regular cashew more tempting to ea', 'Cashewzzz|Cashew Nutzzz', '1.5 oz', 24, '18.99', 0, 0),
(28, 3, 'Variety Pack', 'images/Nut/variety-box2', 'The combination of our Almonds, Cashews, and English Walnuts results in the ultimate \"on-the-go\" nutzzz all in one bag! This \"cross-pollination\" is prevalent in their flavor medleys and in their health benefits. Providing a well-rounded source of proteins, various vitamins, and antioxidants.', 'Almonds, Cashews, Pistachios, Sea Salt, Salt, Highly Refined Peanut Oil. Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'variety pack of our nut products', 'Our variety pack offers a variety of our products for everyone to try in one box.', 'Variety Pack| Assorted flavors of our products', '1.5 oz', 36, '42.99', 0, 0),
(29, 3, 'Honey-Roasted Almondzzz', 'images/Nut/honey-roasted-almondzzz', 'Our most popular Nutzzz the Almond contains a hugely impressive nutrient profile. Along with its bold flavor a single serving (1 oz) comprises over 6 grams of protein and 48% of the daily value of Vitamin E.', 'Almonds (Pasteurized), Roasted in our Award-Winning Honey, Highly Refined Peanut Oil, Salt Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', '', 'Honey Roasted Almondzzz are complemented by the fun, delicious flavor of honey which turns a boring, plain walnut, into a yum', 'Honey-Roasted Almondzzz| Honey Roasted Flavored Almondzzz', '1.5 oz', 24, '17.99', 1, 0),
(30, 3, 'Honey-Roasted Walnutzzz', 'images/Nut/honey-roasted-walnutzzz', 'Our English Walnuts are an excellent provider of Omega-3s which help combat and reduce heart disease risk. Its complex flavor which comprises both a sharp and tangy note will leave you craving for more.', 'Walnuts(Pasteurized), Roasted in our Award-Winning Honey, Highly Refined Peanut Oil, Salt Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'honey roasted walnuts ', 'Honey Roasted Flavored Walnutzzz are complemented by the yummy taste of honey which turns a bland walnut into a delicious one', 'Honey-Roasted Walnutzzz|Honey Roasted Flavored Walnutzzz', '1.5 oz', 24, '18.99', 1, 0),
(31, 3, 'Honey-Roasted Cashewzzz', 'images/Nut/honey-roasted-cashewzzz', 'These keto-friendly nuts are the perfect health-conscious snack. The mild but creamy and rich texture of our cashew\'s contrasts with the lower fat count per serving (1 oz) of most other nuts. Just one serving of these delectable nuts provides over 38% of the daily value of monounsaturated fat, which promotes cardiovascular health.', 'Cashews(Pasteurized), Roasted in our Award-Winning Honey, Highly Refined Peanut Oil, Salt Packaged in the same facility as peanuts, tree nuts, soy, sesame, and milk products.', 'honey roasted cashews', 'Honey Roasted Flavored Cashewzzz are complemented by the taste of delicious honey which turns a bland cashew into a delicious', 'Honey-Roasted Cashewzzz|Honey Roasted Flavored Cashewzzz', '1.5 oz', 24, '19.99', 1, 0),
(32, 2, 'Busy Bee Award Honey', 'images/Honey/award-honey-large', 'Do not believe us? Try it out yourself! Our home-made (and home-loved) honey will buzzy its way straight into your heart!', 'Pure Award-Winning Honey... That\'s it', 'award-winning-honey, the perfect healthy snack', 'Our Award Winning Honey is award winning for a reason! This healthy snack is a perfect way to make a healthy breakfast taste ', 'Award-Winning-Honey | The perfect healthy snack ', '32 oz', 32, '9.39', 1, 0),
(33, 4, 'Strawberry Yogurtzzz', 'images/Yogurt/strawberry-yogurtzzz', 'The sweet flavor provided by the strawberries directly compliments the creamy texture of the irresistible yogurt, which subsequently transcends the plain yogurt into our “hive” favor strawberry yogurtzzz.', 'Cultured Non Fat Milk; Water; Strawberries; Less Than 1%: Natural & Artificial Flavors; Black Carrot Juice & Carmine (For Color); Modified Food Starch; Acesulfame Potassium; Sucralose; Fructose; Malic Acid; Potassium Sorbate (To Maintain Freshness); Active Yogurt Cultures L. Bulgaricus & S. Thermophilus.', 'strawberry yogurt', 'Strawberry Yogurt is complemented by the smooth flavor of strawberries in this nutritious snack.  Our Strawberry Yogurt is he', 'Strawberry Yogurtzzz| Strawberry Flavored Yogurt', '6 oz', 12, '6.89', 0, 0),
(34, 4, 'Berry Blast Yogurtzzz', 'images/Yogurt/berry-blast-yogurtzzz', 'Blueberry and raspberry have joined forces to deliver the Berry Blast Yogurtzzz. This combo will blast you away with their sweet yet woody flavors and create pure bliss when complimented by the creaminess of the yogurt.', 'Cultured Non Fat Milk, Water, Milk Protein Concentrate, Less than 1%: Modified Food Starch, Natural and Artificial Flavors, Fruit and Vegetable Juice (for Color), Lemon Juice Concentrate, Lactase**, Sucralose, Acesulfame Potassium, Vitamin D3, Active Yogurt Cultures L. Bulgaricus & S. Thermophilus.', 'berry blast yogurt', 'Berry Blast Yogurt is complemented by the flavors of varieties of berries that are sweet and sour which makes this yogurt fla', 'Berry Blast Yogurtzzz| Berry Flavored Yogurt', '6 oz', 12, '6.89', 0, 0),
(35, 4, 'Creamy Honey Yogurtzzz', 'images/Yogurt/creamy-honey-yogurtzzz', 'This might be the closest someone can get to tasting heaven. The flavor fusion of our award-winning honey and the creamy all-natural yogurt will leave you buzzing for more!', 'Cultured Non Fat Milk; Water; Award-Winning Honey; Less Than 1%: Natural & Artificial Flavors; Black Carrot Juice & Carmine (For Color); Modified Food Starch; Acesulfame Potassium; Sucralose; Fructose; Malic Acid; Potassium Sorbate (To Maintain Freshness); Active Yogurt Cultures L. Bulgaricus & S. Thermophilus.', 'creamy honey yogurt', 'Creamy Honey Yogurt is complemented by the taste of honey which is sweet and savory which will make your mouth water. Our Cre', 'Creamy Honey Yogurtzzz|Creamy Honey Flavored Yogurt', '6 oz', 12, '7.89', 1, 0),
(36, 5, 'Cool Honey Popsiclezzz', 'images/Popsicle/cool-honey', 'This time our award-winning honey has snuck its way into another one of our irresistible products! Enjoy the sweet flavor of the honey as you indulge in a frozen nasty treat.', 'Our Award-Winning Honey; Water; Cane Sugar; Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'cool honey popsicles ', 'Cool Honey Popsiclezzz are complemented by the delicious sweet flavor that is craved in a popsicle on a hot summer day. Our C', 'Cool Honey Popsiclezzz| Cool Honey Flavored Popsiclezzz', '18 oz', 12, '6.64', 1, 0),
(37, 5, 'Strawberry and Banana Popsiclezzz', 'images/Popsicle/strawberry-and-banana', 'Strawberry and Banana are a tried-and-true combo. While maintaining a healthy nutrient profile and holding valid the deliciousness of the combination of strawberries and bananas, this snack will fill that craving for sweetness without racking up the calories.', 'Banana Puree; Strawberry Juice From Concentrate (Water; Strawberry Juice Concentrate); Water; Cane Sugar; Lemon Juice From Concentrate (Water; Lemon Juice Concentrate); Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'strawberry and banana popsicles', 'Strawberry and Banana Popsiclezzz are complemented by a delicious flavor of fresh strawberries and bananas with a sweet and s', 'Strawberry and Banana Popsiclezzz| Strawberry and Banana Flavored Popsiclezzz', '18 oz', 12, '5.64', 0, 0),
(38, 5, 'Berry Blast Popsiclezzz', 'images/Popsicle/berry-blast', 'Blueberry and raspberry have joined forces to deliver the Berry Blast Popsiclezzz. This combo will blast you away with their sweet yet woody flavors and create pure bliss when complimented by the creaminess of the yogurt-based popsicle.', 'Red Raspberry Puree; Raspberry Juice From Concentrate (Water; Raspberry Juice Concentrate); Water; Cane Sugar; Lemon Juice From Concentrate (Water; Lemon Juice Concentrate); Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'berry blast popsicles', 'Berry Blast Popsiclezz is complemented by the flavors of varieties of berries that are sweet and sour which makes the popsicl', 'Berry Blast Popsiclezzz| Berry Flavored Popsiclezzz', '18 oz', 12, '5.64', 0, 0),
(39, 5, 'Peach Popsiclezzz', 'images/Popsicle/peach', 'Nothing is sweeter than a peach… well except for our Positively Peach Popsiclezzz!', 'Peach Puree; Peach Juice From Concentrate (Water; Peach Juice Concentrate); Water; Cane Sugar; Lemon Juice From Concentrate (Water; Lemon Juice Concentrate); Guar Gum; Carob Bean Gum; Natural Flavor; Ascorbic Acid (Vitamin C); Citric Acid', 'peach popsicles ', 'Peach Popsiclezzz is complemented by fresh Peaches that are juicy and sour so your taste buds will water. Our Peach Popsicles', 'Peach Popsiclezzz| Peach Flavored Popsiclezzz ', '18 oz', 12, '5.64', 0, 0),
(40, 2, 'Honey Sticks', 'images/Honey/honeystick2', 'Want to enjoy our award-winning honey in a simpler, quicker way. These perfectly portioned honey sticks allow anyone to savor our honey by itself in an effortless way! This quick and easy snacks is the perfect healthy alternative to the mainstream candies', 'Pure Award-Winning Honey... That\'s it', 'honey sticks, the perfect easy appetizer', 'Want to enjoy our award-winning honey in a simpler, quicker way. \r\nThis easy appetizer is a good snack for busier bees!', 'Honey Sticks | For healthy honey lovers on the go!', NULL, 50, '10.99', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `total` decimal(5,2) NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zip` varchar(8) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `customer_id`, `guest_id`, `total`, `email`, `name`, `address`, `country`, `state`, `zip`) VALUES
(11, NULL, 425659837, '56.68', 'test@test.com', ' test test', 'test', 'Test', 'te', '5555'),
(12, 1, NULL, '4.40', 'test@test.com', 'David Davidson', 'test', 'test', 'te', '53011'),
(13, 1, NULL, '6.27', 'test@test.com', 'David Davidson', 'Idoaoa', 'test', 'te', '53011'),
(18, 1, NULL, '25.05', 'test@test.com', 'David Davidson', 'Next door', 'test', 'te', '53011'),
(19, NULL, 923676264, '20.98', 'megan.voypick@gotoltc.edu', 'Megan Voypick', '1290 North Ave.', ' United States', ' W', '53015'),
(20, NULL, 1068244378, '34.62', 'james.rice@gotoltc.edu', 'James Rice', '123 Street Dr', ' USA', 'WI', '53085'),
(21, NULL, 884981728, '11.54', 'buttfuckslutsuck@gmail.com', 'Work', ' On the Block', ' Afghan yo', 'so', '90210'),
(22, NULL, 1149297441, '11.54', ' gayboi@gmail.com', '   Chuck Cuck', '1748 Chunk Ave', ' United States of America', 'WI', '53081'),
(23, NULL, 756373790, '8.80', ' as@as.com', '   as', ' as', ' as', ' ', '0'),
(24, NULL, 1947548636, '4.40', 'as@as.com', '   as', ' as', ' as', ' a', '0'),
(25, 1, NULL, '4.40', 'test@test.com', 'David Davidson', 'Next door', 'test', 'te', '53011');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `detai_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`detai_id`, `purchase_id`, `product_id`, `quantity`) VALUES
(32, 11, 28, 1),
(33, 11, 18, 1),
(34, 12, 5, 1),
(35, 13, 2, 3),
(44, 18, 5, 1),
(45, 18, 13, 2),
(46, 18, 35, 1),
(47, 19, 8, 2),
(48, 20, 40, 3),
(49, 21, 40, 1),
(50, 22, 40, 1),
(51, 23, 5, 2),
(52, 24, 5, 1),
(53, 25, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `msg` varchar(420) COLLATE utf8mb4_bin NOT NULL,
  `stars` int(11) NOT NULL,
  `show_on_index` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `customer_id`, `product_id`, `msg`, `stars`, `show_on_index`) VALUES
(2, 1, 32, 'Loved IT! The best honey I\'ve ever had!!\r\n', 5, 1),
(3, 2, 35, 'I can\'t go a day without eating this delicous yogurt!!\r\n', 5, 1),
(4, 4, 2, 'My kids love all the different \"Barzzz\" but the Bluebarzzz have a special place in my heart <3!!!', 4, 1),
(5, 3, 28, 'The variety pack is the best snack for when I\'m on the go!', 5, 1),
(6, 1, 40, 'By far my favorite product, I love Honey and this is the perfect way to get it on the go!!', 5, 0),
(10, 423, 1, 'Much good!', 5, 0),
(11, 424, 6, 'These were great! I love them so much. ', 5, 0),
(12, 424, 5, 'Wow! So good', 5, 0),
(13, 425, 12, 'The best yogurt in the whole United States! I highly encourage you to buy from this site!', 5, 0),
(14, 426, 11, 'Bitches ain\'t shit, but this shit is the shit home dog!!! It keeps my paraplegic mom regular. <3 8=======D', 1, 0),
(15, 427, 30, 'This shit dry asf. 5 stars', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `special`
--

CREATE TABLE `special` (
  `specials_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `new_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `special`
--

INSERT INTO `special` (`specials_id`, `product_id`, `new_price`) VALUES
(1, 2, '1.99'),
(2, 6, '5.49'),
(3, 8, '9.99'),
(4, 12, '3.89'),
(5, 17, '2.89'),
(6, 19, '10.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `fav_list`
--
ALTER TABLE `fav_list`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `customer_id` (`customer_id`,`product_id`),
  ADD KEY `product_fav` (`product_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`detai_id`),
  ADD KEY `purchase_id` (`purchase_id`,`product_id`),
  ADD KEY `purchase_product` (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`,`product_id`),
  ADD KEY `product_review` (`product_id`);

--
-- Indexes for table `special`
--
ALTER TABLE `special`
  ADD PRIMARY KEY (`specials_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `fav_list`
--
ALTER TABLE `fav_list`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `detai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `special`
--
ALTER TABLE `special`
  MODIFY `specials_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fav_list`
--
ALTER TABLE `fav_list`
  ADD CONSTRAINT `customer_fav` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `product_fav` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `customer_payment` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_detail` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`),
  ADD CONSTRAINT `purchase_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `customer_review` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `product_review` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `special`
--
ALTER TABLE `special`
  ADD CONSTRAINT `special_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
