-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2025 at 05:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_tabulation`
--

-- --------------------------------------------------------

--
-- Table structure for table `athletes`
--

CREATE TABLE `athletes` (
  `id` int(11) NOT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `t_shirt_size` varchar(5) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `athletes`
--

INSERT INTO `athletes` (`id`, `sport_id`, `last_name`, `first_name`, `middle_initial`, `date_of_birth`, `age`, `t_shirt_size`, `email`) VALUES
(8, 20, 'Ones', 'AJ', 'A', '2000-06-13', 20, 'M', 'aj@gmail.com'),
(9, 21, 'Eugene', 'Domingo', 'L', '2004-02-10', 13, 'M', 'floterina@gmail.com'),
(10, 23, 'Dela Cruz', 'Juan', 'L', '2004-06-08', 22, 'L', 'juan@gmail.com'),
(11, 20, 'Alfred', 'John', 'R', '2000-06-07', 25, 'L', 'alfred@gmail.com'),
(20, 20, 'Dele Cruz', 'Jenny', 'M', '2000-01-12', 20, 'L', 'Jenny@gmail.com'),
(21, 20, 'Will', 'John Dee', 'M', '2001-02-13', 24, 'S', 'johndee@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(150) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`id`, `name`, `location`, `description`) VALUES
(1, 'Main Campus – Tandag City', 'Rosario, Tandag City', 'This is the administrative and academic hub of NEMSU. It offers a wide range of programs across various disciplines.'),
(2, 'Cantilan Campus', 'Cantilan', 'Provides programs in Information Technology, Industrial Technology, Business Administration, and Hotel & Restaurant Management.'),
(3, 'San Miguel Campus', 'Barangay Carromata, San Miguel', 'Largest campus in terms of land area. Specializes in Forestry and Agriculture programs.'),
(4, 'Tagbina Campus', 'Tagbina', 'Focuses on research in renewable energy, food security, poverty alleviation, and coffee production.'),
(5, 'Bislig Campus', 'Bislig City', 'Offers various academic programs and serves students in the southern part of Surigao del Sur.'),
(6, 'Lianga Campus', 'Lianga', 'Provides educational opportunities to students in the central region of the province.'),
(7, 'Cagwait Campus', 'Cagwait', 'Extends NEMSU\'s reach to the eastern coastal areas, offering programs tailored to the community\'s needs.');

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `t_shirt_size` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`id`, `sport_id`, `lastname`, `firstname`, `middle_initial`, `contact_number`, `t_shirt_size`) VALUES
(6, 22, 'Dela Cruz', 'Vincent', 'R', '09120912091', 'S'),
(7, 22, 'Dela Cruz', 'Jenny', 'R', '09878767876', 'S'),
(8, 23, 'Will', 'Taguro', 'K', '09120912093', 'L'),
(9, 20, 'Swift', 'Alfred', 'L', '09987232321', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `person_incharge` varchar(200) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `student_number` varchar(20) DEFAULT NULL,
  `course_code` varchar(10) DEFAULT NULL,
  `equipment_code` varchar(20) DEFAULT NULL,
  `borrow_date_time` datetime DEFAULT NULL,
  `return_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `person_incharge`, `equipment_name`, `quantity`, `description`, `student_name`, `student_number`, `course_code`, `equipment_code`, `borrow_date_time`, `return_date_time`) VALUES
(4, 'Roger Rocker', 'Boxing Gloves', 2, 'Poor condition', 'Aj Onez', '212022', 'BSCS', '2345567212', '2024-10-23 02:31:00', '0000-00-00 00:00:00'),
(7, 'Arnold Swagger', 'Ball', 2, 'Good Condition', 'Ronald Mc Donald', '61726817', 'BSIT', '12817962', '2025-05-01 17:14:00', '2025-05-02 17:14:00'),
(10, 'Arnold Swagger', 'Baseball Bat', 2, 'Good Condition', 'Alfred', '192812', 'BSCS', '1231233', '2025-05-01 18:47:00', '2025-05-02 18:47:00'),
(11, 'Arnold Swagger', 'Baseball', 2, 'Good Condition', 'Layla De Lima', '213123', '12312', '1233123', '2025-05-01 18:47:00', '2025-05-09 18:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `name`, `description`) VALUES
(20, 'Baseball (Men)', 'a game played with a bat and ball by two teams of nine players each on a field with four bases that mark the course a runner must take to score.'),
(21, 'Basketball (3x3)', 'three players in each team as opposed to the five in traditional basketball games. There\'s only one substitute allowed on the bench in 3x3 basketball, who can enter the game anytime during a dead ball situation by tagging an outgoing player.'),
(22, 'Basketball (4x4) ', 'Basketball (4x4) is a variation of basketball played with four players per team on the court, typically in a half-court or smaller full-court setting. It emphasizes speed, space, and simplified team play.'),
(23, 'Tennis Table', 'a sport in which two or four players hit a lightweight ball, also known as the ping-pong ball, back and forth across a table using small rackets.'),
(24, 'Football', 'a form of team game played in North America with an oval ball on a field marked out as a gridiron.'),
(25, 'Volleyball', 'a game in which two teams use their hands to hit a large ball from one side of a high net to the other, without allowing the ball to touch the ground.'),
(28, 'Track and Field', 'This sports run to laps\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `sports_award`
--

CREATE TABLE `sports_award` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `gold` int(11) DEFAULT 0,
  `silver` int(11) DEFAULT 0,
  `bronze` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports_award`
--

INSERT INTO `sports_award` (`id`, `student_id`, `campus_id`, `gold`, `silver`, `bronze`) VALUES
(1, 8, 1, 1, 1, 0),
(2, 9, 2, 0, 0, 1),
(9, 10, 5, 1, 0, 0),
(10, 11, 7, 1, 0, 0),
(11, 21, 6, 0, 1, 0),
(12, 20, 4, 0, 0, 1),
(13, 8, 6, 1, 0, 0),
(14, 8, 6, 1, 0, 0),
(15, 8, 6, 1, 0, 0),
(16, 9, 1, 0, 1, 0),
(17, 10, 1, 0, 0, 1),
(18, 20, 2, 1, 0, 0),
(19, 21, 2, 0, 1, 0),
(20, 9, 2, 0, 0, 1),
(21, 8, 6, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `athletes`
--
ALTER TABLE `athletes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `athletes_ibfk_1` (`sport_id`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports_award`
--
ALTER TABLE `sports_award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `athletes`
--
ALTER TABLE `athletes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sports_award`
--
ALTER TABLE `sports_award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `athletes`
--
ALTER TABLE `athletes`
  ADD CONSTRAINT `athletes_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
