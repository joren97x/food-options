-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 07:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tblaccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblorderhistory`
--

CREATE TABLE `tblorderhistory` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productName` varchar(222) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorderhistory`
--

INSERT INTO `tblorderhistory` (`id`, `userID`, `productName`, `total`, `date`) VALUES
(13, 12, 'Small Eggs', 20, '2022-11-28'),
(14, 12, 'Big ass Eggs bruh', 8, '2022-11-28'),
(15, 12, 'Small Eggs', 1380, '2022-11-28'),
(18, 13, 'Small Eggs', 440, '2022-11-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblorderhistory`
--
ALTER TABLE `tblorderhistory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblorderhistory`
--
ALTER TABLE `tblorderhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
