-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 04:13 PM
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
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(25) NOT NULL,
  `price` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `quantity`, `price`) VALUES
(3, 'Laptop', 'Laptop Dell Inspiron 15', 10, 650),
(4, 'Smartphone', 'Samsung Galaxy S21', 15, 800),
(5, 'Headphones', 'Sony WH-1000XM4 Wireless', 20, 300),
(6, 'Monitor', 'LG 24-inch Full HD', 8, 180),
(7, 'Keyboard', 'Mechanical Keyboard RGB', 25, 76),
(8, 'Mouse', 'Wireless Mouse Logitech', 30, 45),
(9, 'Tablet', 'Apple iPad 10.2\"', 12, 329),
(10, 'Smartwatch', 'Fitbit Versa 3', 18, 200),
(11, 'Printer', 'HP LaserJet Pro', 7, 220),
(12, 'Speaker', 'JBL Bluetooth Speaker', 22, 90);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`) VALUES
(16, 'Riad', 'Gashi', 'riadi', 'gashiriad09@gmail.com', '$2y$10$EMBdc810ldw49eF/6PotUe71GOpl7aPbFrhjdR0D1jk.YZYtTnIJO'),
(17, 'Andri', 'Hoxha', 'andri', 'andri@example.com', 'andri123'),
(18, 'Elira', 'Shehu', 'elira', 'elira@example.com', 'elira123'),
(19, 'Besnik', 'Krasniqi', 'besnik', 'besnik@example.com', 'besnik123'),
(20, 'Linda', 'Dervishi', 'linda', 'linda@example.com', 'linda123'),
(21, 'Arben', 'Gashi', 'arben', 'arben@example.com', 'arben123'),
(22, 'Jonida', 'Meta', 'jonida', 'jonida@example.com', 'jonida123'),
(23, 'Dritan', 'Basha', 'dritan', 'dritan@example.com', 'dritan123'),
(24, 'Klea', 'Kola', 'klea', 'klea@example.com', 'klea123'),
(25, 'Valon', 'Shala', 'valon', 'valon@example.com', 'valon123'),
(26, 'Sara', 'Leka', 'sara', 'sara@example.com', 'sara123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
