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
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'Shimla Tour Package, India', 5000.00, 'A scenic tour to the beautiful Shimla hills.', 'images/package1.jpg'),
(2, '(Alappuzha) Backwaters in Kerala, India', 10000.00, 'Experience the serene backwaters of Kerala.', 'images/package2.jpg'),
(3, 'Key Monastery, India', 7000.00, 'Visit the stunning Tibetan monastery in Spiti.', 'images/package3.jpg'),
(4, 'Spiti Valley, Himachal Pradesh, India', 6000.00, 'Explore the rugged beauty of Spiti Valley.', 'images/package4.jpg'),
(5, 'Ziro Valley, India', 5000.00, 'A paradise for music lovers and nature enthusiasts.', 'images/package5.jpg'),
(6, 'Majuli Island, India', 8000.00, 'The world’s largest river island.', 'images/package6.jpg'),
(7, 'Tiger Hill, Darjeeling, India', 10000.00, 'A breathtaking sunrise viewpoint.', 'images/package7.jpg'),
(8, 'City Palace, Udaipur, Rajasthan, India', 9000.00, 'Explore the grandeur of Rajasthan.', 'images/package8.jpg'),
(9, 'Ellora Caves, Maharashtra, India', 8000.00, 'Witness the magnificent rock-cut caves.', 'images/package9.jpg'),
(10, 'Lakshmana Temple, Khajuraho, Madhya Pradesh, India', 6000.00, 'Explore the ancient temple carvings.', 'images/package10.jpg'),
(11, 'Dwarkadhish Temple, Gujarat, India', 5000.00, 'Visit the sacred temple of Lord Krishna.', 'images/package11.jpg'),
(12, 'Har Ki Pauri, Haridwar, Uttarakhand, India', 8000.00, 'A sacred ghat on the banks of Ganges.', 'images/package12.jpg'),
(13, 'Goa, India', 9000.00, 'Enjoy the beaches and nightlife of Goa.', 'images/package13.jpg'),
(14, 'Sela Pass, Arunachal Pradesh, India', 11000.00, 'A high-altitude pass with stunning views.', 'images/package14.jpg'),
(15, 'Kedarnath Temple, Uttarakhand, India', 12000.00, 'A divine pilgrimage in the Himalayas.', 'images/package15.jpg'),
(16, 'Adiyogi Statue, Coimbatore, Tamil Nadu, India', 10000.00, 'Visit the world’s largest bust statue.', 'images/package16.jpg'),
(17, 'Andaman and Nicobar Islands, India', 9000.00, 'A tropical paradise with pristine beaches.', 'images/package17.jpg'),
(18, 'Ram Janmabhoomi Mandir, Ayodhya, Uttar Pradesh, India', 7000.00, 'Visit the birthplace of Lord Rama.', 'images/package18.jpg'),
(19, 'Stone Chariot, Hampi, Karnataka, India', 9000.00, 'Explore the heritage site of Hampi.', 'images/package19.jpg'),
(20, 'Taj Mahal, Agra, Uttar Pradesh, India', 11000.00, 'Marvel at the beauty of the Taj Mahal.', 'images/package20.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
