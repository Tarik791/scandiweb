-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2024 at 08:27 PM
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
-- Database: `product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_attributes`
--

CREATE TABLE `book_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_attributes`
--

INSERT INTO `book_attributes` (`id`, `product_id`, `weight`) VALUES
(1, 2, 350.00),
(2, 5, 400.00),
(3, 8, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `dvd_attributes`
--

CREATE TABLE `dvd_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dvd_attributes`
--

INSERT INTO `dvd_attributes` (`id`, `product_id`, `size`) VALUES
(1, 1, 4.70),
(2, 4, 4.70),
(3, 7, 8.50),
(4, 10, 4.70);

-- --------------------------------------------------------

--
-- Table structure for table `furniture_attributes`
--

CREATE TABLE `furniture_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `length` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture_attributes`
--

INSERT INTO `furniture_attributes` (`id`, `product_id`, `height`, `width`, `length`) VALUES
(1, 3, 90.00, 40.00, 40.00),
(2, 6, 45.00, 50.00, 100.00),
(3, 9, 90.00, 100.00, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` enum('DVD','Book','Furniture') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `type`, `created_at`) VALUES
(1, 'DVD001', 'The Matrix', 19.99, 'DVD', '2024-07-01 10:00:00'),
(2, 'BK001', 'The Catcher in the Rye', 10.99, 'Book', '2024-07-02 10:00:00'),
(3, 'FUR001', 'Wooden Chair', 49.99, 'Furniture', '2024-07-03 10:00:00'),
(4, 'DVD002', 'Inception', 14.99, 'DVD', '2024-07-04 10:00:00'),
(5, 'BK002', 'To Kill a Mockingbird', 12.99, 'Book', '2024-07-05 10:00:00'),
(6, 'FUR002', 'Glass Table', 79.99, 'Furniture', '2024-07-06 10:00:00'),
(7, 'DVD003', 'Interstellar', 17.99, 'DVD', '2024-07-07 10:00:00'),
(8, 'BK003', '1984', 9.99, 'Book', '2024-07-08 10:00:00'),
(9, 'FUR003', 'Leather Sofa', 199.99, 'Furniture', '2024-07-09 10:00:00'),
(10, 'DVD004', 'The Dark Knight', 15.99, 'DVD', '2024-07-10 10:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_attributes`
--
ALTER TABLE `book_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `dvd_attributes`
--
ALTER TABLE `dvd_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `furniture_attributes`
--
ALTER TABLE `furniture_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_attributes`
--
ALTER TABLE `book_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dvd_attributes`
--
ALTER TABLE `dvd_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `furniture_attributes`
--
ALTER TABLE `furniture_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_attributes`
--
ALTER TABLE `book_attributes`
  ADD CONSTRAINT `book_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dvd_attributes`
--
ALTER TABLE `dvd_attributes`
  ADD CONSTRAINT `dvd_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `furniture_attributes`
--
ALTER TABLE `furniture_attributes`
  ADD CONSTRAINT `furniture_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
