-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 02 jan 2019 om 20:32
-- Serverversie: 5.7.23
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Books', 'books', '2017-10-28 17:19:31', '2017-10-28 17:19:31', NULL),
(2, 'Electronics', 'electronics', '2017-10-28 17:19:44', '2017-10-28 17:19:44', NULL),
(3, 'Accessories', 'accessories', '2017-10-28 17:19:58', '2017-10-28 17:19:58', NULL),
(4, 'Women\'s Clothing', 'womens-clothing', '2017-10-28 17:20:50', '2017-10-28 17:20:50', NULL),
(5, 'Men\'s Clothing', 'mens-clothing', '2017-10-28 17:22:00', '2017-10-28 17:22:00', NULL),
(6, 'Furniture', 'furniture', '2017-10-28 17:22:14', '2017-10-28 17:22:14', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `total` float NOT NULL,
  `status` varchar(255) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `quantity` int(6) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `quantity`, `category_id`, `sub_category_id`, `image_path`, `featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nikel Sport gear', 59.99, 'Slim sport outfit for men', 10, 5, 4, 'images\\uploads\\products\\3_front-edc184be2d72e34664fadf2b82630629.jpg', 0, '2017-11-11 01:06:56', '2017-11-11 04:40:36', NULL),
(2, 'Puma Arsenal Home Shirt', 89, 'The Puma Arsenal Home Shirt 2016 2017 Mens is ideal for wearing whilst cheering on the Gunners or when playing yourself. The shirt is constructed using the latest Drycell technology to ensure you remain cool, dry and comfortable at all times. The team crest, puma logo and club sponsor feature on the front of the shirt for a great look.', 8, 5, 4, 'images\\uploads\\products\\2_front-633e0d9cdba8c61e527ddab7fb391dbb.jpg', 1, '2017-11-27 13:18:42', '2017-11-27 13:18:42', NULL),
(3, 'Manchester City Home Shorts', 69, 'These Nike Manchester City Home Shorts 2017 2018 benefit from being engineered with Dri-Fit technology which wicks sweat away from your skin to keep you feeling dry and comfortable, whilst the drawstring fastening and elasticated waist allows you to get a secure fit that is comfortable and the club crest allows you to show your support for the blue side of Manchester.', 7, 5, 4, 'images\\uploads\\products\\new37214201_l-31e03fd8f95da680c2879350591ce381.jpg', 0, '2017-11-27 13:19:42', '2017-11-27 13:19:42', NULL),
(4, 'Manchester City Home Mini Kit', 155, 'Let your little one look like a City legend in this Nike Manchester City Home Mini Kit 2017 2018 which comes with a replica shirt, shorts and socks for an on pitch look, whilst the club crest allows you to show your admiration for the Citizens.', 15, 5, 4, 'images\\uploads\\products\\manchester-ee72a10542501c23c76a7360c3d281fb.jpg', 1, '2017-11-27 13:20:36', '2017-11-27 13:20:36', NULL),
(5, 'Adidas Chelsea Home Shirt', 149, 'The Adidas Chelsea Home Shirt 2016 2017 is ideal for any Chelsea supports and features an all over print of the Chelsea lion. The shirt is constructed using climacool technology to ensure you remain cool, dry and comfortable whilst wearing the shirt. The top is completed with the team badge stitched onto the front along with Adidas branding and the club sponsor for a great look.', 4, 5, 4, 'images\\uploads\\products\\chelsea-e4390662bc89fc346f1b9f61088c7eea.jpg', 0, '2017-11-27 13:21:29', '2017-11-27 13:21:29', NULL),
(6, 'Adidas Chelsea Home Goalkeeper Shirt', 49, 'The Adidas Chelsea Home Goalkeeper Shirt 2016 2017 is perfect for wearing on or off the pitch. The top is constructed using climacool technology to ensure you remain cool, dry and comfortable at all times. The shirt features the team crest on the front of the shirt along with adidas branding for a great look. The club sponsor is featured in the middle to complete the look.', 16, 5, 4, 'images\\uploads\\products\\goal-keeper-25c6251d62e14da7e9a9563ed2bab39f.jpg', 0, '2017-11-27 13:22:18', '2017-11-27 13:22:18', NULL),
(7, 'Adidas Chelsea Home Shorts', 81, 'The Adidas Chelsea Home Shorts 2016 2017 are ideal for wearing in or outside of the stadium. The shorts are constructed using Climacool technology to ensure you remain cool, dry and comfortable at all times. The shorts features the team badge on the front of the shorts and adidas branding is stitched onto the back to complete the design.', 10, 5, 4, 'images\\uploads\\products\\adidas-chels-6f0734fbff5510a72066d0422760d0bd.jpg', 1, '2017-11-27 13:23:03', '2017-11-27 13:23:03', NULL),
(8, 'Adidas Chelsea Away Socks', 19, 'The Adidas Chelsea Away Socks 2016 2017 are ideal for wearing when enjoying a game of football and provides comfort, support and style on the pitch. The socks feature an elasticated opening with built in foot-bed to make them suitable for wearing with boots or trainers. The socks are finished off with Adidas and Chelsea detailing for a great look.', 4, 5, 4, 'images\\uploads\\products\\chels-sock-43a4a17d2789da47aefa38b635a7d159.jpg', 0, '2017-11-27 13:24:35', '2017-11-27 13:24:35', NULL),
(9, 'Adidas Chelsea Away Kit', 48, 'The Adidas Chelsea Away Kit 2016 2017 Mini is perfect for any young blues fan to wear whilst cheering on their favorite team or practicing their skills. The shirt features a crew neck collar with short sleeves for a comfortable fit, whilst the club badge, Adidas branding and the club sponsor ensures an authentic look. The shorts benefit from an elasticated waist and drawstring fastening for a secure and comfortable fit. The shorts also feature the club badge and Adidas branding.', 12, 5, 4, 'images\\uploads\\products\\chels-y-5769c58065135810f12e8e8302321b8b.jpg', 0, '2017-11-27 13:25:25', '2017-11-27 13:25:25', NULL),
(10, 'Nike Barcelona Messi Home Shirt', 51, 'Let your little one look like the Barca superstar in this Nike Barcelona Messi Home Shirt. The shirt features Messi 10 printed onto the rear of the shirt along with the club crest on the front of the shirt alongside Nike swoosh branding.', 19, 5, 4, 'images\\uploads\\products\\messi-f921dbbe7c06c82a185b19c496aa5eb3.jpg', 0, '2017-11-27 13:26:10', '2017-11-27 13:26:10', NULL),
(11, 'Nike Barcelona Home Shorts', 29, 'The Nike Barcelona Home Shorts offer support and comfort whilst playing to allow you to concentrate on your game. The shorts are constructed using Nike Dri-Fit technology to ensure you remain cool, dry and comfortable. Sweat is also drawn away from the skin so you remain comfortable at all times. The shorts are finished off with Nike swoosh branding and the team crest for a great look.', 16, 5, 4, 'images\\uploads\\products\\barca-short-6bc574cea7d4c43d254c1228fd9e9f75.jpg', 0, '2017-11-27 13:27:06', '2017-11-27 13:27:06', NULL),
(12, 'Nike Barcelona Baby Home Kit', 45.99, 'The Nike Barcelona Home Baby kit is perfect for any little youngster to wear when showing their support for the mighty Barcelona. The kit comes complete with shirt, shorts and socks for a great look and ensures they look like one of the superstars on the pitch. The shirt features the club crest on the chest along with Nike swoosh branding for a great look whilst the elasticated shorts and socks ensure maximum comfort.', 15, 5, 4, 'images\\uploads\\products\\barca-e04f5e8b8b32918a1fa351cdf763c598.jpg', 0, '2017-11-27 13:27:59', '2017-11-27 13:27:59', NULL),
(13, 'Nike Barcelona Football Club Training Jacket', 39, 'Represent your team in this Nike Barcelona Football Club Training Jacket, with a full zip up fastening, long sleeves with elasticated cuffs, a mock collar that keeps your chin warm and an open front pocket. Also featuring an elasticated waistband, the Nike Swoosh alongside Barcelona branding across the front.', 7, 5, 4, 'images\\uploads\\products\\barca-t-4a0acd04225ee127a2d206148f6e0fff.jpg', 0, '2017-11-27 13:30:43', '2017-11-27 13:30:43', NULL),
(14, 'Hudson Jeans Mens Blake Slim Straight Jean', 299, 'The Blake is a slim-straight in stretch denim. It offers the room of a straight leg from the knee up, and tapers from the knee down to a 14.5 inch', 15, 5, 2, 'images\\uploads\\products\\aso-jean-66130198a0a2822191273844683c7ed6.jpg', 0, '2017-11-27 13:32:00', '2017-11-27 13:32:00', NULL),
(15, 'Levi\'s Men\'s 511 Slim Fit Jean', 49.99, 'Five-pocket jean in slim silhouette featuring slightly tapered leg and zip fly with button closure, 100% fabric.', 15, 5, 2, 'images\\uploads\\products\\levi-4ccb1da896a4267368c602b3dd9ca0e8.jpg', 0, '2017-11-27 13:32:57', '2017-11-27 13:32:57', NULL),
(16, 'Graduate Slim Straight Leg Jeans', 198, 'Vintage details and a clean, tailored silhouette define classic jeans crafted from rich, dark Italian denim.', 7, 5, 2, 'images\\uploads\\products\\jeans-men-157b83daa1f2f43b49c1ad20e3b4577e.jpg', 0, '2017-11-27 13:34:04', '2017-11-27 13:34:04', NULL),
(17, 'Graduate SUD Slim Straight Leg Pants', 149, 'A customer favorite for their comfort and versatility, these five-pocket pants are cleanly styled, slightly stretchy and incredibly soft.', 10, 5, 2, 'images\\uploads\\products\\jeans-m-pants-c14c29da9bb78da42dc5195fceff94f8.jpg', 0, '2017-11-27 13:34:48', '2017-11-27 13:34:48', NULL),
(18, 'Yoyo Slim Straight Leg Jeans', 249, 'Rich, dark denim structures five-pocket jeans with a vintage look and a clean, tailored silhouette.', 14, 5, 2, 'images\\uploads\\products\\jean-yoyo-4ff95ca9501688dc22addbcb75eb1ed7.jpg', 0, '2017-11-27 13:35:26', '2017-11-27 13:35:26', NULL),
(19, 'Rylee Slipdress', 145.99, 'Simple, chic and perfect for almost any occasion, this slipdress illustrated with photo-realistic botanicals is a great addition to your warm-weather wardrobe.', 15, 4, 6, 'images\\uploads\\products\\women_dress_1-3bc93ac88691a30e7ba007431e88264d.jpg', 0, '2017-11-27 13:43:28', '2017-11-27 13:43:28', NULL),
(20, 'Mix Print Maxi Dress', 169, 'A summery print of playfully shifting spots draws attention to this floor-sweeping slip dress in a billowy cut of sheer and airy Georgette.', 5, 4, 6, 'images\\uploads\\products\\women_dress_2-645ac0a0e794c7abb87b2f7cfb6727da.jpg', 0, '2017-11-27 13:45:41', '2017-11-27 13:45:41', NULL),
(21, 'Off the Shoulder Print Dress', 299, 'An elasticized neckline allows for on- or off-shoulder styling in this sweet dress with a leaf print and pom trim.', 18, 4, 6, 'images\\uploads\\products\\women_dress_3-be8a914e37dd8d50776ad47b0cfcec71.jpg', 1, '2017-11-27 13:46:20', '2017-11-27 13:46:20', NULL),
(22, 'Swingy Minidress', 109, 'Cut for a fit that\'\'s as breezy as your beachfront vacay, this style is cut with a plunging V-neckline and skin-flaunting back-perfect for soaking up the sun.', 8, 4, 6, 'images\\uploads\\products\\women_dress_4-3b26122c1a9916c58f8bffa98f2696e7.jpg', 0, '2017-11-27 13:49:03', '2017-11-27 13:49:03', NULL),
(23, 'BB Dakota Tulle Swing Dress', 199, 'Jewel-tone embroidery illuminates this light, loosely tailored dress with intricate detail.', 14, 4, 6, 'images\\uploads\\products\\women_dress_5-49e1389695b14377ce9b35f1cba31279.jpg', 1, '2017-11-27 13:49:47', '2017-11-27 13:49:47', NULL),
(24, 'Embroidered High Neck Dress', 99, 'Southwestern-inspired embroidery details a flowy high-neck dress designed with a flattering high-low hem.', 10, 4, 6, 'images\\uploads\\products\\women_dress_6-94d889be5fd890d24068d455607b4c8d.jpg', 0, '2017-11-27 13:50:20', '2017-11-27 13:50:20', NULL),
(25, 'Print Maxi Dress', 119, 'Warmer weather calls for stylish versatility, and this tie-dyed maxi will look just as good at the beach as it does at weekend parties.', 16, 4, 6, 'images\\uploads\\products\\women_dress_7-9071ff530391005efe391f84a885301e.jpg', 0, '2017-11-27 13:50:54', '2017-11-27 13:50:54', NULL),
(26, 'Maxi Dress', 129, 'With this dreamy woven maxi dress, vacation packing is nearly done.', 10, 4, 6, 'images\\uploads\\products\\women_dress_8-5715ee3722258b6de44b2a3b3c70d432.jpg', 0, '2017-11-27 13:51:53', '2017-11-27 13:51:53', NULL),
(27, 'Summer Party Maxi Dress', 149, 'Chic and easy dressing for any summer event, this flowy maxi wins with a global-inspired print and a comfortable drawstring-waist fit.', 16, 4, 6, 'images\\uploads\\products\\women_dress_9-fe4c7da7c7deae54e1cf27d1047ab35e.jpg', 0, '2017-11-27 13:59:04', '2017-11-27 13:59:04', NULL),
(28, 'Print Maxi Dress special', 189, 'A lush tropical print enlivens the front and crisscrossing back straps of a breezy maxi dress blocked with solid contrast at the reverse.', 19, 4, 6, 'images\\uploads\\products\\women_dress_10-5a1075457bc042582b9098b73a4829a7.jpg', 1, '2017-11-27 14:00:21', '2017-11-27 14:00:21', NULL),
(29, 'Painted Stripe A-Line Dress', 399, 'A wash of sea-colored brushstrokes adds summery charm to a soft knit dress in a gently fitted cut with an elegantly cascading drape at one side.', 9, 4, 6, 'images\\uploads\\products\\women_dress_11-ba1ff684a1cee41c948b53d05cd58ee1.jpg', 0, '2017-11-27 14:00:58', '2017-11-27 14:00:58', NULL),
(30, 'Madison Sofa Bed', 499, 'One of our design heroes once said they loved black because it affirms, designs, and styles. Whether fashion or furniture, we believe the same to be true in the case of this convertible sofa bed, with deep seats, high backrest, and upholstered in premium bonded leather.', 4, 6, 9, 'images\\uploads\\products\\madison_sofa_bed_1-a5cde205076036ce13a82c27b2d6bb4a.png', 0, '2017-11-28 05:20:14', '2017-11-28 05:20:14', NULL),
(31, 'Chelsea Sofa Bed ', 299, 'And once the party is over, be a good host, let your friends rest comfortably on this modern convertible sofa bed. We say it can fit 2, but if you\'re trying to optimize for a solid cuddle sesh, 4 is reasonable.', 2, 6, 9, 'images\\uploads\\products\\madison_sofa_bed_1-c28dbb77e07f74bf43b4d3b885193e80.png', 0, '2017-11-28 05:28:09', '2017-11-28 05:28:09', NULL),
(32, 'Bedford Sofa Bed ', 349, 'This fine apparatus might come in a box, but it\'s not about to be put back into one. It cannot and shall not be defined by any single term. This hunky, hexagonal stitched gift from the furniture gods hails from the multi-hyphenated generation, managing to flourish as both a futon and sofa.', 2, 6, 9, 'images\\uploads\\products\\bedford_sofa_bed_2-c7282d556f6d70d1692fb5292f249504.png', 0, '2017-11-28 05:29:29', '2017-11-28 05:29:29', NULL),
(33, 'Madison Dining Table ', 499, 'Rectangular because everyone knows you have a secret love for table tennis and now you have an excuse to also buy a dining table. Finished in warm american walnut veneer, this table offers just the right amount of bounce for the ping pong ball to effortlessly float side to side.', 7, 6, 10, 'images\\uploads\\products\\madison_dining_table_2-32bc1841cbfdfcddec0f0be91553df22.png', 0, '2017-11-28 05:31:10', '2017-11-28 05:31:10', NULL),
(34, 'Chelsea Dining Table ', 299, 'We designed the Chelsea Dining Table to make you the social butterfly that you always aspired to be. Picture 4 to 6 ridiculously good looking Swedes eating, drinking, dancing together.', 3, 6, 10, 'images\\uploads\\products\\chelsea-roundtable-front-e9f211a0097cd4f682e86435a6db40dd.jpg', 0, '2017-11-28 05:31:56', '2017-11-28 05:31:56', NULL),
(35, 'Bedford Dining Table ', 119, 'We can\'t be all things to everyone, but we feel it is our duty to enable you and your crew to continue creating embarrassing memories well into middle age. And that\'s why we created this rectangular dining table for use as your personal canvas, literally or otherwise.', 2, 6, 10, 'images\\uploads\\products\\bedford_dining_table_2-926cd8e0ea8073d858018eef28c535da.png', 0, '2017-11-28 05:32:41', '2017-11-28 05:32:41', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Shoes', 'shoes', 5, '2017-10-28 17:23:27', '2017-10-28 17:23:27', NULL),
(2, 'Jeans', 'jeans', 5, '2017-10-28 17:23:37', '2017-10-28 17:23:37', NULL),
(3, 'Kids', 'kids', 3, '2017-10-28 17:23:54', '2017-10-28 17:23:54', NULL),
(4, 'Sport Wears', 'sport-wears', 5, '2017-10-28 17:24:11', '2017-10-28 17:24:30', NULL),
(5, 'Tops', 'tops', 4, '2017-10-28 17:25:31', '2017-10-28 17:25:31', NULL),
(6, 'Dresses', 'dresses', 4, '2017-10-28 17:25:43', '2017-10-28 17:25:43', NULL),
(7, 'Footwears', 'footwears', 4, '2017-10-28 17:25:58', '2017-10-28 17:25:58', NULL),
(8, 'T-Shirts', 'tshirts', 5, '2017-10-28 17:27:09', '2017-10-28 17:27:09', NULL),
(9, 'Sofa Beds', 'sofa-beds', 6, '2017-11-28 05:15:57', '2017-11-28 05:15:57', NULL),
(10, 'Dining Tables', 'dining-tables', 6, '2017-11-28 05:16:21', '2017-11-28 05:16:21', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
