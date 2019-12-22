-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2019 at 10:37 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atp3dbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(100) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_weight` varchar(100) NOT NULL,
  `ingredient` varchar(100) NOT NULL DEFAULT '[ - ]',
  `item_cost` varchar(100) NOT NULL,
  `approval` int(100) NOT NULL DEFAULT 0,
  `out_id` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `item_code`, `item_type`, `item_name`, `item_weight`, `ingredient`, `item_cost`, `approval`, `out_id`) VALUES
(1, 'B104', 'Burger', 'Chicken Cheese Delight', '300gm', 'Chicken,Cheese,Onion,Bun', '250', 1, ''),
(2, 'P107', 'Pizza', 'Pan Pizza', '320gm', 'Chicken,Onion,Mushroom,Peeper,Olive,Cheese,Tomato', '400', 1, ''),
(3, 'B109', 'Burger', 'Chicken BBQ Burg', '300gm', 'BBQ Sauce,Chicken,Cheese,Onion,Pepperoni,Bun', '150', 0, ''),
(4, 'P108', 'Pizza', 'Cheese Pepperoni Blast', '500gm', 'Beef,Onion,Pepperoni,Mushroom,Sausage,Peeper,Olive,Cheese,Tomato,', '560', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
