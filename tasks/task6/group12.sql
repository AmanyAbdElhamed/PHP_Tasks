-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 05:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group12`
--

-- --------------------------------------------------------

--
-- Table structure for table `articals`
--

CREATE TABLE `articals` (
  `id` int(11) NOT NULL,
  `title` char(20) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `imagePath` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articals`
--

INSERT INTO `articals` (`id`, `title`, `content`, `imagePath`) VALUES
(7, 'Perferendis ea esse', 'Nulla irure est sit Nulla irure est sit Nulla irure est sit Nulla irure est sit Nulla irure est sit Nulla irure est sit Nulla irure est sit\r\nNulla irure est sit Nulla irure est sit Nulla irure est sit Nulla irure est sit Nulla irure est sit', 'uploads/16472762281540387994.jpeg'),
(8, 'Amet sunt fugit et', 'Iusto fugiat tempora Iusto fugiat tempora Iusto fugiat tempora Iusto fugiat tempora Iusto fugiat tempora\r\nIusto fugiat tempora Iusto fugiat tempora Iusto fugiat tempora Iusto fugiat tempora', 'uploads/1647276329604560518.png'),
(9, 'Sequi rerum consequu', 'Eaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c \r\nEaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c Eaque voluptatibus c', 'uploads/1647276364274184145.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` char(30) NOT NULL,
  `email` char(60) NOT NULL,
  `password` char(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'amany', 'amany@gmail.com', '123456'),
(2, 'Regan Callahan', 'leme@mailinator.com', 'Pa$$w0rd!'),
(3, 'Sonya Hubbard', 'wagowygij@mailinator.com', '123456789'),
(4, 'Neve Olsen', 'rasumefy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(5, 'Jin Strickland', 'qecikeq@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articals`
--
ALTER TABLE `articals`
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
-- AUTO_INCREMENT for table `articals`
--
ALTER TABLE `articals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
