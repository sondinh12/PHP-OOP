-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2025 at 07:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'cate1'),
(2, 'cate2');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_thumbnail` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `img_thumbnail`, `description`, `created_at`, `updated_at`) VALUES
(2, 2, 'fdgdf', 'uploads/products/1741154665_Screenshot 2023-11-20 173620.png', 'gdfg', NULL, '2025-03-05 13:04:25'),
(3, 2, '12', 'uploads/products/1740893913_Screenshot 2023-11-20 173728.png', 'ưerwerer', '2025-03-02 10:36:44', '2025-03-02 12:38:53'),
(8, 2, 'ssa', 'uploads/products/1740992208_Screenshot 2023-11-19 120637.png', 'ádasasd', '2025-03-02 12:34:39', '2025-03-03 15:56:48'),
(11, 1, '122222', 'uploads/products/1740992214_Screenshot 2023-11-20 173728.png', 'ừuue', '2025-03-03 15:47:22', '2025-03-03 15:57:02'),
(12, 2, 'dcsd2', 'uploads/products/1741016554_Screenshot 2023-12-03 103726.png', 'ưkmkg', '2025-03-03 16:08:19', '2025-03-03 22:42:34'),
(14, 1, '3424', 'uploads/products/1741060310_ẢNH 3.png', '34234', '2025-03-04 10:51:50', '2025-03-04 10:51:50'),
(16, 2, 'sffsf', 'uploads/products/1741154305_ẢNH 5.png', 'dscsddsad', '2025-03-05 12:58:25', '2025-03-05 12:58:25'),
(17, 2, 'ghhgfhgfhgf', 'uploads/products/1741154435_Screenshot 2023-12-03 103716.png', 'ưkmkg', '2025-03-05 12:58:47', '2025-03-05 13:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `age`, `email`, `password`, `role`, `image`) VALUES
(1, 'Son', 20, 'sonplay14@gmail.com', 'sonplay', 'user', ''),
(2, 'Son 2', 21, 'dinhson9@gmail.com', 'sondinh', 'admin', ''),
(12, '1', 1, '111', '12', 'user', ''),
(14, '1', 111, '1', '1', 'user', ''),
(16, 'sondinhsjsd', 20, 'nguyendinhson14092005@gmail.com', 'íyigdyfhsbdy', 'user', NULL),
(17, 'sondinh14905', 20, 'nguyendinhson92005@gmail.com', 'dsfgdrgrgr', 'user', 'uploads/users/1740126596_Screenshot 2023-11-20 173728.png'),
(18, 'sondinhsư', 22, 'nguyendinhson92005@gmail.com', 'vsdggdfgbdfh', 'user', 'uploads/users/1740126622_Screenshot 2024-01-05 152817.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
