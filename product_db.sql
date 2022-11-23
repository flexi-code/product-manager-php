-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 01:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
(2, 'b'),
(3, 'c'),
(4, 'd'),
(5, 'e'),
(6, 'f'),
(7, 'g'),
(8, 'h'),
(9, 'i'),
(10, 'j'),
(11, 'k'),
(12, 'l'),
(13, 'm'),
(14, 'n'),
(15, 'o'),
(16, 'p'),
(17, 'q'),
(18, 'r'),
(19, 's'),
(20, 't'),
(21, 'u'),
(22, 'v'),
(23, 'w'),
(24, 'x'),
(25, 'y'),
(26, 'z'),
(27, 'A'),
(28, 'B'),
(29, 'C'),
(30, 'D'),
(31, 'E'),
(32, 'F'),
(33, 'G');

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
(1, 14, 'a1'),
(1, 15, 'a2'),
(2, 23, 'b1'),
(1, 41, 'a3'),
(2, 48, 'b3'),
(2, 50, 'b2'),
(3, 51, 'c1'),
(3, 52, 'c2'),
(3, 53, 'c3'),
(4, 54, 'd1'),
(4, 55, 'd2'),
(4, 56, 'd3'),
(5, 57, 'e1'),
(5, 58, 'e2'),
(5, 59, 'e3'),
(6, 60, 'f1'),
(6, 61, 'f2'),
(6, 62, 'f3'),
(7, 63, 'g1'),
(7, 64, 'g2'),
(7, 65, 'g3'),
(8, 66, 'h1'),
(8, 67, 'h2'),
(8, 68, 'h3'),
(9, 69, 'i1'),
(9, 70, 'i2'),
(9, 71, 'i3'),
(10, 72, 'j1'),
(10, 73, 'j2'),
(10, 74, 'j4'),
(12, 75, 'l1'),
(12, 76, 'l2'),
(12, 77, 'l3'),
(13, 78, 'm1'),
(13, 79, 'm2'),
(13, 80, 'm3'),
(11, 81, 'k1'),
(11, 82, 'k2'),
(11, 83, 'k3'),
(14, 84, 'n1'),
(14, 85, 'n2'),
(14, 86, 'n3'),
(15, 87, 'o1'),
(15, 88, 'o2'),
(15, 89, 'o3'),
(16, 90, 'p1'),
(16, 91, 'p2'),
(16, 92, 'p3'),
(17, 93, 'q1'),
(17, 94, 'q2'),
(17, 95, 'q3'),
(18, 96, 'r1'),
(18, 97, 'r2'),
(18, 98, 'r3'),
(19, 100, 's2'),
(19, 101, 's3'),
(19, 102, 's1'),
(20, 103, 't1'),
(20, 104, 't2'),
(20, 105, 't3'),
(21, 106, 'u1'),
(21, 107, 'u2'),
(21, 108, 'u3'),
(22, 109, 'v1'),
(22, 110, 'v2'),
(22, 111, 'v3'),
(23, 112, 'w1'),
(23, 113, 'w3'),
(24, 114, 'x1'),
(24, 115, 'x2'),
(24, 116, 'x3'),
(25, 117, 'y1'),
(25, 118, 'y2'),
(25, 119, 'y3'),
(26, 120, 'z1'),
(26, 121, 'z2'),
(26, 122, 'z3'),
(27, 123, 'A1'),
(27, 124, 'A2'),
(27, 125, 'A3'),
(28, 126, 'B1'),
(28, 127, 'B2'),
(28, 128, 'B3'),
(29, 129, 'C1'),
(29, 130, 'C2'),
(29, 131, 'C3'),
(30, 132, 'D1'),
(30, 133, 'D2'),
(30, 134, 'D3'),
(31, 135, 'E1'),
(31, 136, 'E2'),
(31, 137, 'E3'),
(32, 138, 'F1'),
(32, 139, 'F2'),
(32, 140, 'F3'),
(33, 141, 'G1'),
(33, 142, 'G2'),
(33, 143, 'G3'),
(23, 144, 'w2');

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
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

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
