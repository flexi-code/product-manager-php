-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 03:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'a'),
(2, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pr_id` bigint(20) NOT NULL,
  `pr_name` varchar(50) NOT NULL,
  `pr_price` double NOT NULL,
  `pr_image` varchar(50) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `pr_status` varchar(20) NOT NULL,
  `pr_quantity` int(11) NOT NULL,
  `pr_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `p_id` bigint(20) NOT NULL,
  `c_id` bigint(20) NOT NULL,
  `sc_id` bigint(20) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `sc_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `p_c`
--

CREATE TABLE `p_c` (
  `p_id` bigint(20) NOT NULL,
  `c_id` bigint(20) NOT NULL,
  `sc_id` bigint(20) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `sc_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_c`
--

INSERT INTO `p_c` (`p_id`, `c_id`, `sc_id`, `c_name`, `sc_name`) VALUES
(10, 2, 13, 'b', 'b3');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `category_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`category_id`, `sub_category_id`, `sub_category_name`) VALUES
(1, 1, 'a1'),
(1, 3, 'a2'),
(1, 9, 'a3'),
(1, 10, 'a4'),
(2, 11, 'b1'),
(2, 12, 'b2'),
(2, 13, 'b3'),
(2, 14, 'b4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD KEY `product_category_ibfk_1` (`c_id`),
  ADD KEY `product_category_ibfk_2` (`p_id`),
  ADD KEY `sc_id` (`sc_id`);

--
-- Indexes for table `p_c`
--
ALTER TABLE `p_c`
  ADD KEY `product_category_ibfk_1` (`c_id`),
  ADD KEY `product_category_ibfk_2` (`p_id`),
  ADD KEY `sc_id` (`sc_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`pr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_3` FOREIGN KEY (`sc_id`) REFERENCES `sub_category` (`sub_category_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
