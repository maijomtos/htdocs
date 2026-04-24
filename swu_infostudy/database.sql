-- phpMyAdmin SQL Dump
-- Database: `swu_infostudy`

CREATE DATABASE IF NOT EXISTS `swu_infostudy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `swu_infostudy`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

-- The password for the admin account is: password123
INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$tZ2w/Y3N0sU1T.Nqzr3j8u/uH9CItp1QG2i7f3XvT2n3T9/h.x6tG', 'admin', '2023-10-27 10:00:00');

-- The password for the student account is: swu123
INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(2, 'student', '$2y$10$wT20h/.A.QO/5f1l1Z/01e9.V5P/R0cQq6.fX8dY/v7D/vD.0E2L6', 'student', '2023-10-27 10:00:00');
