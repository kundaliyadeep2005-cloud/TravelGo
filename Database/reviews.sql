-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306:4306
-- Generation Time: Apr 25, 2025 at 12:54 PM
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
-- Database: `travelgo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(100) DEFAULT 'Anonymous'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `package_id`, `rating`, `review`, `created_at`, `user_name`) VALUES
(1, 1, 3, 'wc', '2025-04-25 07:40:38', 'Anonymous'),
(2, 2, 4, 'nice', '2025-04-25 07:41:12', 'Anonymous'),
(3, 3, 3, 'best', '2025-04-25 07:58:24', 'Anonymous'),
(4, 4, 4, 'good', '2025-04-25 07:58:35', 'Anonymous'),
(5, 7, 4, 'wow', '2025-04-25 07:58:49', 'Anonymous'),
(6, 6, 5, 'best', '2025-04-25 07:59:04', 'Anonymous'),
(7, 9, 5, 'nice', '2025-04-25 07:59:26', 'Anonymous'),
(8, 11, 5, 'perfect temple', '2025-04-25 08:01:20', 'Anonymous'),
(9, 11, 5, 'perfect temple', '2025-04-25 08:02:50', 'Anonymous'),
(10, 11, 5, 'perfect temple', '2025-04-25 08:03:56', 'Anonymous'),
(11, 11, 5, 'perfect temple', '2025-04-25 08:04:13', 'Anonymous'),
(12, 11, 5, 'perfect temple', '2025-04-25 08:04:28', 'Anonymous'),
(13, 11, 5, 'perfect temple', '2025-04-25 08:04:48', 'Anonymous'),
(14, 11, 5, 'perfect temple', '2025-04-25 08:05:14', 'Anonymous'),
(15, 11, 5, 'perfect temple', '2025-04-25 08:05:34', 'Anonymous'),
(16, 11, 5, 'perfect temple', '2025-04-25 08:05:45', 'Anonymous'),
(17, 11, 5, 'perfect temple', '2025-04-25 08:06:02', 'Anonymous'),
(18, 11, 5, 'perfect temple', '2025-04-25 08:08:22', 'Anonymous'),
(19, 11, 5, 'perfect temple', '2025-04-25 08:09:33', 'Anonymous'),
(20, 11, 5, 'perfect temple', '2025-04-25 08:10:30', 'Anonymous'),
(22, 11, 5, 'perfect temple', '2025-04-25 08:13:11', 'Anonymous'),
(23, 11, 5, 'perfect temple', '2025-04-25 08:14:41', 'Anonymous'),
(24, 11, 5, 'perfect temple', '2025-04-25 08:14:56', 'Anonymous'),
(25, 11, 5, 'perfect temple', '2025-04-25 08:15:30', 'Anonymous'),
(26, 11, 5, 'perfect temple', '2025-04-25 08:15:50', 'Anonymous'),
(27, 11, 5, 'perfect temple', '2025-04-25 08:18:45', 'Anonymous'),
(28, 11, 5, 'perfect temple', '2025-04-25 08:19:35', 'Anonymous'),
(29, 11, 5, 'perfect temple', '2025-04-25 08:20:09', 'Anonymous'),
(30, 11, 5, 'perfect temple', '2025-04-25 08:21:17', 'Anonymous'),
(31, 11, 5, 'perfect temple', '2025-04-25 08:21:37', 'Anonymous'),
(32, 11, 5, 'perfect temple', '2025-04-25 08:21:46', 'Anonymous'),
(33, 11, 5, 'perfect temple', '2025-04-25 08:24:45', 'Anonymous'),
(34, 11, 5, 'perfect temple', '2025-04-25 08:26:18', 'Anonymous'),
(35, 11, 5, 'perfect temple', '2025-04-25 08:27:55', 'Anonymous'),
(36, 11, 5, 'perfect temple', '2025-04-25 09:44:45', 'Anonymous'),
(37, 11, 5, 'perfect temple', '2025-04-25 09:45:02', 'Anonymous'),
(38, 11, 5, 'perfect temple', '2025-04-25 09:48:30', 'Anonymous'),
(39, 11, 5, 'perfect temple', '2025-04-25 09:49:19', 'Anonymous'),
(40, 11, 5, 'perfect temple', '2025-04-25 09:52:23', 'Anonymous'),
(41, 11, 5, 'perfect temple', '2025-04-25 09:53:04', 'Anonymous'),
(42, 11, 5, 'perfect temple', '2025-04-25 09:53:18', 'Anonymous'),
(43, 11, 5, 'perfect temple', '2025-04-25 09:53:31', 'Anonymous'),
(44, 11, 5, 'perfect temple', '2025-04-25 09:53:44', 'Anonymous'),
(45, 11, 5, 'perfect temple', '2025-04-25 10:36:04', 'Anonymous'),
(46, 11, 5, 'perfect temple', '2025-04-25 10:36:51', 'Anonymous'),
(47, 11, 5, 'perfect temple', '2025-04-25 10:38:06', 'Anonymous'),
(48, 11, 5, 'perfect temple', '2025-04-25 10:39:17', 'Anonymous'),
(49, 11, 5, 'perfect temple', '2025-04-25 10:40:05', 'Anonymous'),
(50, 11, 5, 'perfect temple', '2025-04-25 10:41:17', 'Anonymous'),
(51, 11, 5, 'perfect temple', '2025-04-25 10:42:31', 'Anonymous'),
(52, 11, 5, 'perfect temple', '2025-04-25 10:42:49', 'Anonymous'),
(53, 11, 5, 'perfect temple', '2025-04-25 10:43:32', 'Anonymous'),
(54, 11, 5, 'perfect temple', '2025-04-25 10:45:00', 'Anonymous'),
(55, 11, 5, 'perfect temple', '2025-04-25 10:45:51', 'Anonymous'),
(56, 11, 5, 'perfect temple', '2025-04-25 10:46:45', 'Anonymous'),
(57, 11, 5, 'perfect temple', '2025-04-25 10:47:07', 'Anonymous'),
(58, 11, 5, 'perfect temple', '2025-04-25 10:47:16', 'Anonymous'),
(59, 11, 5, 'perfect temple', '2025-04-25 10:50:02', 'Anonymous');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
