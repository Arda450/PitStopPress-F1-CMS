-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 09:36 PM
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
-- Database: `pitstoppress_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alt_text` text DEFAULT NULL,
  `src` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `alt_text`, `src`, `created_at`) VALUES
(157, 'McLaren on a rampage to back to back victories', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet', 'This is an image of Mclaren tp Andrea Stella and Mclaren driver Lando Norris', '1721070769_lando-norris-andrea-stella.webp', '2024-07-13 01:13:59'),
(158, 'Toto Wolff is quite happy with the Biritish GP victory', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr ...', 'This is an image of Mercedes team principle Toto Wolff', '1721070744_toto-wolff-interview.webp', '2024-07-13 01:14:32'),
(159, 'Daniel Ricciardo under pressure after poor performances', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr...', 'This is an image of Formula 1 driver Daniel Ricciardo', '1721070721_daniel-ricciardo.webp', '2024-07-13 01:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT '',
  `content` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `src`, `alt_text`, `content`, `date`) VALUES
(60, 'Unleashing the Speed Demons: A Deep Dive into the Aerodynamics of Formula 1 Cars', '1721064632_five-drivers.webp', 'This is an image of a Mclaren F1 car.', 'Explore the dynamic evolution of Formula 1 technology, where innovation is the name of the game. From hybrid power units ...', '2024-07-10'),
(61, 'Beyond the Checkered Flag: The Evolution of Formula 1', '1721064553_driver-moves.webp', 'This is a formula 1 related image', 'Formula 1 is not just about speed; it\'s about epic rivalries that define eras. From Senna vs. Prost to Hamilton vs. Rosberg ...', '2024-07-02'),
(65, 'Fueling the F1 Dream: A Comprehensive Analysis of the Engine Technologies', '1721066503_mclaren-mcl38.webp', 'This is a Formula 1 related image', 'Formula 1 isn\'t just a sport; it\'s a global phenomenon that transcends borders. With races held on every continent ...', '2024-07-02'),
(66, 'From Paddock to Podium: Exploring the Intricate Strategies Behind Formula 1', '1721066692_hamilton-to-ferrari.webp', 'This is an image of Lewis Hamilton and Toto Wolff', 'Experience the adrenaline-fueled world of, Formula 1, where cutting-edge technology meets high-speed drama. From the roar of engines ...', '2024-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `race` varchar(100) NOT NULL,
  `race_date` date NOT NULL,
  `winner` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `race_time` time NOT NULL,
  `laps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `race`, `race_date`, `winner`, `team`, `race_time`, `laps`) VALUES
(28, 'Bahrain GP', '2024-03-02', 'Max Verstappen', 'RED BULL RACING HONDA RBPT', '01:31:44', 57),
(29, 'Saudi Arabian GP', '2024-03-09', 'Max Verstappen', 'RED BULL RACING HONDA RBPT', '01:20:43', 50),
(30, 'Australian GP', '2024-03-24', 'Carlos Sainz', 'FERRARI', '01:20:26', 58),
(31, 'Japanese GP', '2024-04-07', 'Max Verstappen', 'RED BULL RACING HONDA RBPT', '01:54:23', 53),
(32, 'Chinese GP', '2024-04-21', 'Max Verstappen', 'RED BULL RACING HONDA RBPT', '01:40:52', 56),
(33, 'Miami GP', '2024-05-05', 'Lando Norris', 'MCLAREN MERCEDES', '01:30:49', 57);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `hash`) VALUES
(20, 'Arda123', 'arda@hello.com', '$2y$10$Dytpo9.HL98Ma8Q7pv1eaeUbKySpieNZUmZtoV4JVB1mFfhZkF1bG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
