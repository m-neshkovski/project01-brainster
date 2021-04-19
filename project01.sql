-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2020 at 08:33 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15705865_project01`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$KrxQqbWMUv7Vrodp.XpieeoaiLBB5hhwDdCnugl5k4U5pRSX2Licm', '2020-11-02 10:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `vraboti`
--

CREATE TABLE `vraboti` (
  `id` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_tel` varchar(20) DEFAULT NULL,
  `student_type` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vraboti`
--

INSERT INTO `vraboti` (`id`, `full_name`, `company_name`, `contact_email`, `contact_tel`, `student_type`, `created_at`) VALUES
(1, 'Milosh Neshkovski', 'MilKomKu', 'm.neshkovski@gmail.com', '+38972233847', 'programming', '2020-10-29 21:10:01'),
(2, 'Milosh Neshkovski', 'MilKomKu', '+38972233847', '', 'design', '2020-11-02 09:40:28'),
(3, 'Milosh Neshkovski', 'MilKomKu', '+38972233847', '', 'design', '2020-11-02 09:42:00'),
(4, 'Milosh Neshkovski', 'MilKomKu', '+38972233847', '', 'design', '2020-11-02 10:01:49'),
(5, 'Milosh Neshkovski', 'MilKomKu', 'm.neshkovski@gmail.com', '+38972233847', 'marketing', '2020-11-02 10:18:06'),
(6, 'Milosh Neshkovski', 'MilKomKu', 'm.neshkovski@gmail.com', '+38972233847', 'marketing', '2020-11-02 10:23:40'),
(7, 'Milosh Neshkovski', 'MilKomKu', 'm.neshkovski@gmail.com', '+38972233847', 'marketing', '2020-11-02 10:26:12'),
(8, 'Milosh Neshkovski', 'Osnoven sud Kumanvo', 'm.neshkovski@gmail.com', '+38972233847', 'programming', '2020-11-02 15:24:45'),
(9, 'Milosh Neshkovski', 'Nekoja kompanija', 'm.neshkovski@gmail.com', '+38972233847', 'programming', '2020-11-25 11:29:44'),
(10, 'Милош Нешковски', 'Основен суд Куманово - Куманово', 'm.neshkovski@gmail.com', '+38972345678', 'marketing', '2020-12-01 15:43:16'),
(11, 'darko lazarevski', 'darko laz inc', 'derko@darko.com', '+38972233847', 'programming', '2020-12-17 08:53:18'),
(12, 'Nekoj Nekojsi', 'Nekoja si kompanija', 'nekojacompanija@gmail.com', '+38972233847', 'programming', '2020-12-17 18:05:04'),
(13, 'Милош Нешковски', '000WEBHOST тест-кирилица', 'milosh@milosh.com', '+38971234567', 'marketing', '2020-12-18 08:20:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vraboti`
--
ALTER TABLE `vraboti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vraboti`
--
ALTER TABLE `vraboti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
