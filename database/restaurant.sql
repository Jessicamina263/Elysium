-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2025 at 05:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authorization` enum('moderator','super admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `authorization`) VALUES
(2, 'jessica', 'jessica', 'super admin'),
(3, 'bosy', 'basmalla', 'moderator'),
(4, 'basmalla', '123456789', 'super admin'),
(5, 'basma', 'basmallaaa', 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `chefs`
--

CREATE TABLE `chefs` (
  `chefid` int(5) NOT NULL,
  `chefname` varchar(255) DEFAULT NULL,
  `specialty` text DEFAULT NULL,
  `chefimage` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chefs`
--

INSERT INTO `chefs` (`chefid`, `chefname`, `specialty`, `chefimage`) VALUES
(1, 'Henri Soulé', 'Italian Cuisine', 0x312e6a7067),
(2, 'Toni Fiore', 'French Cuisine', 0x322e6a7067),
(3, 'Ken Hom', 'Middle Eastern Cuisine', 0x332e6a7067),
(4, 'Rose Gray', 'Mexican Cuisine', 0x342e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Jessica Mina', 'jessica@gmail.com', 1234567890, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `prodid` int(11) NOT NULL,
  `prodname` varchar(50) DEFAULT NULL,
  `prodprice` float(10,2) DEFAULT NULL,
  `prodrate` float(3,2) DEFAULT NULL,
  `proddesc` text DEFAULT NULL,
  `prodtype` varchar(255) DEFAULT NULL,
  `prodimage` longblob DEFAULT NULL,
  `chefid` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`prodid`, `prodname`, `prodprice`, `prodrate`, `proddesc`, `prodtype`, `prodimage`, `chefid`) VALUES
(1, 'Crispy Chicken Tenders', 7.99, 4.80, 'Golden-brown, breaded chicken strips with a crispy exterior and tender, juicy meat inside. Perfect for dipping in your favorite sauce.', 'Appetizers', 0x63726973707920636869636b656e2074656e646572732e706e67, 1),
(2, 'Dumplings with a Bowl of Sauce', 6.99, 4.50, 'Steamed or fried dumplings filled with savory ingredients, served with a tangy dipping sauce.', 'Appetizers', 0x64756d706c696e67732077697468206120626f776c206f662073617563652e706e67, 1),
(3, 'Fried Shrimp', 8.99, 4.70, 'Crispy and golden shrimp, deep-fried to perfection, served hot and ready to dip.', 'Appetizers', 0x467269656420736872696d702e706e67, 1),
(4, 'Potato Fries with Ketchup Sauce', 3.99, 4.30, 'Classic crispy potato fries paired with a side of tangy ketchup.', 'Appetizers', 0x506f7461746f2046726965732057697468204b6574636875702053617563652e706e67, 1),
(5, 'Chicken Enchiladas Mexican Tortillas Meal', 12.99, 4.60, 'Rolled tortillas stuffed with seasoned chicken, topped with sauce and melted cheese.', 'Lunch', 0x436869636b656e20456e6368696c61646173204d65786963616e20546f7274696c6c6173204d65616c2e706e67, 1),
(6, 'Chicken Katsu Ingredients', 13.99, 4.80, 'Breaded and fried chicken cutlet, served with rice and a tangy tonkatsu sauce.', 'Lunch', 0x436869636b656e204b6174737520496e6772656469656e74732e706e67, 1),
(7, 'Chicken Parmesan Dish', 14.99, 4.70, 'Breaded chicken cutlet topped with marinara sauce and melted cheese, served with pasta or bread.', 'Lunch', 0x436869636b656e205061726d6573616e20446973682e706e67, 1),
(8, 'Chicken Quesadilla Mexican Cheesy Tortilla', 9.99, 4.40, 'A toasted tortilla filled with juicy chicken and gooey melted cheese.', 'Lunch', 0x436869636b656e20517565736164696c6c61204d65786963616e2043686565737920546f7274696c6c612e706e67, 1),
(9, 'Creamy Oatmeal Bowl', 5.49, 4.75, 'Smooth and creamy oatmeal topped with fresh, juicy berries.', 'Breakfast', 0x437265616d79204f61746d65616c20426f776c2e706e67, 1),
(10, 'Ultimate Breakfast Platter', 10.99, 4.82, 'Golden French toast with a dollop of butter, crispy bacon, savory sausages, and two perfectly cooked sunny-side-up eggs.', 'Breakfast', 0x556c74696d61746520427265616b6661737420506c61747465722e706e67, 1),
(11, 'Deluxe Grilled Club Sandwich', 7.99, 4.35, 'Grilled sandwich with crispy chicken, fresh veggies, cheddar cheese, and creamy mayo on toasted bread.', 'Breakfast', 0x44656c757865204772696c6c656420436c75622053616e64776963682e706e67, 1),
(12, 'Classic Breakfast Plate', 8.99, 4.59, 'Crispy bacon, sunny-side-up eggs, and golden toast, served with fresh greens and cherry tomatoes.', 'Breakfast', 0x436c617373696320427265616b6661737420506c6174652e706e67, 1),
(13, 'Apple Ice Cream Toast', 5.99, 4.50, 'Warm toast topped with apple slices, creamy ice cream, and a drizzle of syrup.', 'Dessert', 0x4170706c6520496365637265616d20546f6173742e706e67, 1),
(14, 'Apple Pie', 4.99, 4.60, 'Classic dessert with spiced apple filling in a flaky, golden crust.', 'Dessert', 0x4170706c65207069652e706e67, 1),
(15, 'Belgian Waffle Ice Cream Pancake', 7.99, 4.80, 'A soft Belgian waffle served with ice cream and syrup for a sweet treat.', 'Dessert', 0x42656c6769616e20576166666c652049636520437265616d2050616e63616b652e706e67, 1),
(16, 'Americano', 2.99, 4.50, 'Smooth black coffee with a bold and robust flavor.', 'Hot Drinks', 0x616d65726963616e6f2e706e67, 1),
(17, 'Cappuccino', 3.49, 4.60, 'Creamy coffee topped with steamed milk foam.', 'Hot Drinks', 0x63617070756363696e6f2e706e67, 1),
(18, 'Coffee', 1.99, 4.30, 'Simple and aromatic, perfect for a warm pick-me-up.', 'Hot Drinks', 0x636f666665652e706e67, 1),
(19, 'Marshmallow Hot Chocolate', 3.99, 4.70, 'Rich hot chocolate topped with fluffy marshmallows.', 'Hot Drinks', 0x6d617273686d656c6c6f20686f742063686f636f2e706e67, 1),
(20, 'Caramel Iced Coffee Dessert Drink Cream', 4.99, 4.70, 'Iced coffee layered with caramel and topped with whipped cream.', 'Cold Drinks', 0x636172616d656c206963656420636f666665652064657373657274206472696e6b20637265616d2e706e67, 1),
(21, 'Iced Americano Coffee', 3.49, 4.50, 'Refreshing black coffee served over ice.', 'Cold Drinks', 0x6963656420616d65726963616e6f20636f666665652e706e67, 1),
(22, 'Mocha Smoothie Cold Drink', 5.49, 4.80, 'A creamy blend of coffee, chocolate, and ice for a chilled treat.', 'Cold Drinks', 0x6d6f63686120736d6f6f7468696520636f6c64206472696e6b2e706e67, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `people` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `people`, `date`, `time`) VALUES
(1, 'Jessica Mina', 'jessica@gmail.com', 1234567890, 5, '2024-12-24', '11:20:00'),
(2, 'Basmalla Mahmoud', 'basala@gmail.com', 129876543, 5, '2024-12-24', '11:20:00'),
(3, 'Jessica Mina', 'jessicamina263@gmail.com', 1234567890, 5, '2024-12-24', '22:24:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chefs`
--
ALTER TABLE `chefs`
  ADD PRIMARY KEY (`chefid`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chefs`
--
ALTER TABLE `chefs`
  MODIFY `chefid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `prodid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
