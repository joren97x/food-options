-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 02:17 PM
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
-- Database: `foodoptionsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `id` int(11) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `userType` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`id`, `firstName`, `lastName`, `email`, `password`, `userType`) VALUES
(6, 'Joren', 'Sumagang', 'joren@email.com', 'ataypiste', 'admin'),
(7, 'John', 'Doe', 'johndoe@gwapo.com', 'ataypiste', 'user'),
(8, 'hello', 'giatay', 'hello@giatay.com', 'ataypiste', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `id` int(11) NOT NULL,
  `productName` varchar(222) NOT NULL,
  `imageName` varchar(222) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `categoryName`) VALUES
(1, 'Eggs'),
(2, 'Fruits'),
(3, 'Vegetable'),
(4, 'Meat'),
(5, 'Seafood'),
(6, 'Junkfood'),
(7, 'Bread'),
(8, 'Milk'),
(9, 'Drinks');

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
(21, 6, 'Mango', 25, '2022-11-30'),
(22, 6, 'Egg', 25, '2022-11-30'),
(23, 7, 'Milk', 0, '2022-12-08'),
(24, 7, 'Shrimp', 0, '2022-12-08'),
(25, 6, 'Mango', 0, '2022-12-12'),
(26, 6, 'Milk', 0, '2022-12-12'),
(27, 6, 'Orange', 0, '2022-12-12'),
(28, 6, 'Shrimp', 0, '2022-12-12'),
(29, 6, 'Crab', 0, '2022-12-12'),
(30, 8, 'Orange', 0, '2022-12-12'),
(31, 8, 'Shrimp', 0, '2022-12-12'),
(32, 6, 'Bangus', 0, '2022-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `imageName` varchar(222) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `productName`, `imageName`, `price`, `quantity`, `categoryID`) VALUES
(3, 'Mango', 'mango.png', 19, 1, 2),
(4, 'Milk', 'milk.png', 19, 1, 9),
(5, 'Orange', 'orange.png', 10, 1, 2),
(6, 'Shrimp', 'shrimp.png', 25, 1, 5),
(7, 'Crab', 'crab.png', 22, 1, 5),
(8, 'Onion', 'onion.png', 5, 1, 3),
(9, 'Tomato', 'tomato.png', 6, 1, 3),
(10, 'Garlic', 'garlic.png', 10, 1, 3),
(11, 'Sili Spada', 'silispada.png', 5, 1, 3),
(12, 'Kamunggay', 'kamunggay.png', 1, 1, 3),
(13, 'Kalabasa', 'Kalabasa.png', 10, 1, 3),
(14, 'Eggplant', 'eggplant.png', 12, 1, 3),
(15, 'Luy A', 'luya.png', 5, 1, 3),
(16, 'Magic Sarap', 'magicsarap.png', 10, 1, 3),
(17, 'Bangus', 'bangus.png', 200, 1, 5),
(18, 'Chicken', 'chicken.png', 200, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorderhistory`
--
ALTER TABLE `tblorderhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblorderhistory`
--
ALTER TABLE `tblorderhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
