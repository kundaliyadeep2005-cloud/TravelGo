-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306:4306
-- Generation Time: Apr 03, 2025 at 07:08 AM
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
-- Table structure for table `best_places`
--

CREATE TABLE `best_places` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best_places`
--

INSERT INTO `best_places` (`id`, `image`, `title`, `description`) VALUES
(1, 'images/index/homecard1.jpg', 'Beach Paradise', 'A beautiful beach destination.'),
(2, 'images/index/homecard2.jpg', 'Mountain Escape', 'Enjoy the breathtaking mountain views.'),
(3, 'images/index/homecard3.jpg', 'City Lights', 'Experience the vibrant nightlife of the city.'),
(4, 'images/index/homecard4.jpg', 'Tropical Island', 'Relax on a serene tropical island.'),
(5, 'images/index/homecard5.jpg', 'Historical Wonders', 'Explore ancient landmarks and historical sites.'),
(6, 'images/index/homecard6.jpg', 'Wildlife Safari', 'Get close to nature with an adventurous safari.'),
(7, 'images/index/homecard7.jpg', 'Desert Adventure', 'Feel the thrill of desert dune bashing and camel rides.'),
(8, 'images/index/homecard8.jpg', 'Snowy Retreat', 'Enjoy the snowy landscapes and winter sports.'),
(9, 'images/index/homecard9.jpg', 'Snowy Retreat', 'Enjoy the snowy landscapes and winter sports.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `best_places`
--
ALTER TABLE `best_places`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `best_places`
--
ALTER TABLE `best_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
