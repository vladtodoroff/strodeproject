-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2022 at 10:24 AM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `name`) VALUES
(30, 'Accountant'),
(10, 'Admin'),
(20, 'Sales'),
(100, 'User'),
(40, 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL,
  `unit_price` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity_in_stock`, `unit_price`) VALUES
(1, 'Vanilla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit. ', 70, '1.22'),
(2, 'Chocolate', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit. ', 49, '4.65'),
(3, 'Mint Chocolate Chip', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit. ', 38, '3.35'),
(4, 'Cookie Dough', 'sdvdfvdf', 90, '4.53'),
(5, 'Buttered Pecan', '', 94, '1.63'),
(6, 'Neapolitan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit. ', 14, '2.39'),
(7, 'Banana', '', 98, '3.29'),
(8, 'Toffee', '', 26, '0.74'),
(9, 'Caramel', '', 67, '2.26'),
(10, 'Dark chocolate', '', 6, '1.09'),
(11, 'Vanila', '', 12, '1.15'),
(12, 'test ice cream', 'something', 20, '1.20');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `username` varchar(55) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `urole` int(3) NOT NULL DEFAULT '100',
  `auth_key` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `username`, `password`, `urole`, `auth_key`, `access_token`) VALUES
(1, 'user1', '$2y$13$wUl9wuLt.EIYtkALylpo8.NuKx6L6GxkyHkpt1wkWwH3ZPrKtQeY2', 10, 'tVubBieR-_9S9Em4E7PDXu8Q65EGO1NB', 'LJdsQNRhUJqTNx_FPgXWtGfnQspf-uFJ'),
(2, 'user2', '$2y$13$AF0ewxTarxkyhJFlzblogOo16IE/Pi.zvC4xcY8Ol/ji97Ifu7Thq', 100, 'fGQ0LqmN5OKct2N_E_j74WF0YTSizZbQ', 'kzE9yHK-InQnRyZ4ONO3odIcXO0ZZBDL'),
(3, 'client10', '$2y$13$8r5DKdm0lXz.MFvd6yM51.ocMRaq6NsU1TdoY5QgdK0AG0DmI8NUW', 100, '2PPLh6zKvpYOfdzv3jEyjjor9RyituKs', 'R6SYNknnue5M5PyiUAIdjj_ZqFI32VmB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
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
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
