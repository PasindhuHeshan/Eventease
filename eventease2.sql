-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 07:11 AM
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
-- Database: `eventease`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `no` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `short_dis` varchar(200) NOT NULL,
  `long_dis` varchar(2000) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(20) NOT NULL,
  `people_limit` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `approvedstatus` int(11) NOT NULL,
  `supervisor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`no`, `name`, `short_dis`, `long_dis`, `flag`, `time`, `date`, `location`, `people_limit`, `type`, `approvedstatus`, `supervisor`) VALUES
(1, 'AI', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence.', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n<br>\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI\r\n<br>\r\nA visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n<br>\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI\r\n<br>\r\nA visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n<br>\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI\r\n<br>', 1, '13:45:59', '2024-09-19', 'UCSC', 350, '', 0, ''),
(2, 'AI', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence.', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI', 1, '13:45:59', '2024-09-19', 'UCSC', 350, '', 0, ''),
(3, 'AI', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence.', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI', 0, '13:45:59', '2024-09-19', 'UCSC', 350, '', 0, ''),
(4, 'AI', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence.', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI', 1, '13:45:59', '2024-09-19', 'UCSC', 350, '', 0, ''),
(5, 'AI', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence.', 'A visitor lecturer in AI is a distinguished expert in the field of artificial intelligence who is invited to a university or institution to share their knowledge and insights with students and faculty. They typically hold advanced degrees or have significant industry experience in AI research, development, or applications.\r\n\r\nVisitor lecturers often deliver guest lectures, workshops, or seminars on various AI', 1, '13:45:59', '2024-09-19', 'UCSC', 350, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `inventory_no` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `inventory_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rolereq`
--

CREATE TABLE `rolereq` (
  `no` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(40) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `No` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usertype` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolereq`
--
ALTER TABLE `rolereq`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rolereq`
--
ALTER TABLE `rolereq`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
