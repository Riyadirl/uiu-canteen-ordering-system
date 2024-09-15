-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 10:37 PM
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
-- Database: `uiucos`
--

-- --------------------------------------------------------

--
-- Table structure for table `canteen`
--

CREATE TABLE `canteen` (
  `id` int(11) NOT NULL,
  `canteen_name` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`id`, `canteen_name`, `owner_id`, `created_at`) VALUES
(1, 'olympia', 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `foodname` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `canteen_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `foodname`, `image`, `description`, `price`, `quantity`, `canteen_id`, `created_at`) VALUES
(1, 'Burger', 'burger.jpg', 'Juicy grilled burger with lettuce and tomato', 120.00, 50, 1, '2024-09-14 17:38:54'),
(2, 'Pizza', 'burger.jpg', 'Classic cheese pizza with fresh basil', 250.00, 30, 1, '2024-09-14 17:38:54'),
(3, 'Pasta', 'burger.jpg', 'Creamy Alfredo pasta with chicken', 180.00, 20, 1, '2024-09-14 17:38:54'),
(4, 'Fried Chicken', 'burger.jpg', 'Crispy fried chicken with a side of fries', 150.00, 40, 1, '2024-09-14 17:38:54'),
(5, 'Sandwich', 'burger.jpg', 'Grilled chicken sandwich with mayonnaise', 100.00, 60, 1, '2024-09-14 17:38:54'),
(6, 'Salad', 'burger.jpg', 'Fresh garden salad with a variety of vegetables', 90.00, 25, 1, '2024-09-14 17:38:54'),
(7, 'Biryani', 'burger.jpg', 'Traditional spicy chicken biryani', 200.00, 35, 1, '2024-09-14 17:38:54'),
(8, 'Samosa', 'burger.jpg', 'Deep-fried samosas filled with potatoes', 40.00, 80, 1, '2024-09-14 17:38:54'),
(9, 'Ice Cream', 'burger.jpg', 'Vanilla ice cream with chocolate syrup', 70.00, 100, 1, '2024-09-14 17:38:54'),
(10, 'Juice', 'burger.jpg', 'Freshly squeezed orange juice', 50.00, 120, 1, '2024-09-14 17:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` enum('for_order','canteen_owner','delivery_man','admin') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_id`, `email`, `phone`, `role`, `gender`, `password`, `created_at`) VALUES
(1, 'Mahabub Hasan Riyad', '011211007', 'riyad.info1@gmail.com', '01770928271', 'for_order', 'male', '$2y$10$0Xa2QH0gXVIKubNTCCPNI.CpZ.WqYkud33J4ewFenwpj4POLrR0Wi', '2024-09-13 15:31:18'),
(2, 'asdf', 'asdf', 'asdf@gmail.com', '2025550122', 'canteen_owner', 'male', '$2y$10$gBlJDxslROOAs/7TatsNIurFFUnOfm/QjUeq7JRFtRjZwdOmkY4oS', '2024-09-13 15:54:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canteen`
--
ALTER TABLE `canteen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `canteen_id` (`canteen_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canteen`
--
ALTER TABLE `canteen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canteen`
--
ALTER TABLE `canteen`
  ADD CONSTRAINT `canteen_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`canteen_id`) REFERENCES `canteen` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
