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
-- Table structure for table `our_story`
--

CREATE TABLE `our_story` (
  `id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `extra_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our_story`
--

INSERT INTO `our_story` (`id`, `section`, `title`, `content`, `extra_info`) VALUES
(1, 'Navbar', 'Home', 'index.php', 'active'),
(2, 'Navbar', 'Packages', 'packages.php', NULL),
(3, 'Navbar', 'About Us', 'our-story.php', NULL),
(4, 'Navbar', 'Contact', 'contact.php', NULL),
(5, 'About Us', 'Welcome to TravelGo', 'We are committed to providing the best travel experiences worldwide. Our mission is to make your journey unforgettable.', NULL),
(6, 'Features', 'Best Destinations', 'We offer curated travel experiences in top destinations.', NULL),
(7, 'Features', 'Affordable Packages', 'Get the best deals on travel packages.', NULL),
(8, 'Features', '24/7 Customer Support', 'We are here to assist you anytime.', NULL),
(9, 'Features', 'Secure Bookings', 'Your information and payments are safe with us.', NULL),
(10, 'Next Adventure', 'Start Your Next Adventure', 'Explore breathtaking destinations with our exclusive tour packages.', 'View Packages'),
(14, 'Footer', 'Contact Us', 'Email: contact@travelgo.com | Phone: +1234567890', NULL),
(15, 'Footer', 'Follow Us', 'Stay connected via our social media channels.', NULL),
(16, 'Footer', 'Terms & Conditions', 'Read our terms and conditions for booking and cancellation policies.', NULL),
(17, 'Footer', 'Privacy Policy', 'Your privacy is important to us. Learn more about how we protect your data.', NULL),
(18, 'Footer', 'TravelGo 2025', '&copy; 2025 TravelGo | All Rights Reserved', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `our_story`
--
ALTER TABLE `our_story`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `our_story`
--
ALTER TABLE `our_story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
