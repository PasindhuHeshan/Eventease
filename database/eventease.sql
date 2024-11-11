-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 07:29 AM
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
(26, 'Summer Picnic', 'Enjoy a fun day in the park', 'Join us for a delightful summer picnic in the heart of Central Park. Bring your favorite blanket, snacks, and games for a fun-filled day with friends and family. We\'ll have live music, a barbecue, and plenty of outdoor activities for all ages.', 1, '12:00:00', '2024-07-15', 'Central Park', 100, 'Social', 1, 'John Doe'),
(27, 'Coding Workshop', 'Learn to code in a fun and interactive way', 'Discover the world of coding in our interactive workshop. Experienced instructors will guide you through the basics of HTML, CSS, and JavaScript. Whether you\'re a complete beginner or looking to enhance your skills, this workshop is perfect for anyone interested in learning to code.', 0, '09:00:00', '2024-10-20', 'Tech Hub', 50, 'Educational', 1, 'Jane Smith'),
(28, 'Movie Night', 'Watch a classic film on the big screen', 'Experience the magic of cinema at our exclusive movie night. We\'ll be screening the iconic film \"The Godfather\" in a state-of-the-art theater. Enjoy popcorn, drinks, and the timeless storytelling of this classic masterpiece.', 1, '19:00:00', '2024-11-08', 'Community Center', 80, 'Entertainment', 1, 'Mike Johnson'),
(29, 'Art Exhibition', 'Discover local talent at our art exhibition', 'Immerse yourself in the vibrant world of local art at our annual exhibition. Featuring a diverse range of paintings, sculptures, and photography, this event showcases the talent and creativity of our community\'s artists. Don\'t miss this opportunity to discover new favorites and support local talent.', 0, '10:00:00', '2024-12-05', 'Art Gallery', 200, 'Cultural', 1, 'Emily Davis'),
(30, 'Charity Run', 'Run or walk for a good cause', 'Lace up your running shoes and join us for our annual charity run. Run or walk to raise funds for a worthy cause and make a positive impact on our community. The event will feature a 5K and 10K race, followed by a post-race celebration with refreshments and awards.', 1, '08:00:00', '2025-01-12', 'City Park', 500, 'Charity', 1, 'Chris Taylor'),
(31, 'Music Festival', 'Enjoy live music and a vibrant atmosphere', 'Get ready to rock out at our epic music festival! Featuring a lineup of talented musicians from various genres, this event is a must-attend for music lovers. Enjoy live performances, food vendors, and a vibrant atmosphere.', 1, '12:00:00', '2025-04-25', 'Festival Grounds', 10000, 'Music', 1, 'Sarah Wilson'),
(32, 'Science Fair', 'Showcase your science projects', 'Ignite your curiosity and creativity at our annual science fair. Students of all ages are invited to showcase their innovative projects and compete for prizes. Explore the wonders of science and technology through engaging experiments, demonstrations, and presentations.', 0, '13:00:00', '2025-05-15', 'School Auditorium', 300, 'Educational', 1, 'David Lee'),
(33, 'Book Club Meeting', 'Discuss your favorite books with like-minded people', 'Join our lively book club discussions and connect with fellow bookworms. We meet monthly to share our thoughts and insights on a variety of literary works. Whether you\'re a seasoned reader or just starting your literary journey, everyone is welcome.', 0, '17:00:00', '2025-06-08', 'Library', 20, 'Social', 1, 'Karen Brown'),
(34, 'Gaming Tournament', 'Compete with other gamers in a thrilling tournament', 'Test your skills and compete against other gamers in our exciting tournament. Featuring popular titles like [Game 1], [Game 2], and [Game 3], this event is a must-attend for gaming enthusiasts. Win bragging rights and valuable prizes!', 1, '10:00:00', '2025-07-20', 'Gaming Arena', 100, 'Entertainment', 1, 'Brian Hill'),
(35, 'Cooking Class', 'Learn new recipes and cooking techniques', 'Discover your inner chef in our hands-on cooking class. Learn valuable cooking techniques and create delicious dishes from scratch. Our experienced instructors will guide you through the process, providing tips and tricks along the way. Perfect for beginners and seasoned cooks alike.', 0, '18:00:00', '2025-08-25', 'Community Kitchen', 30, 'Educational', 1, 'Jennifer Carter');

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
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usertype` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`No`, `username`, `password`, `email`, `usertype`) VALUES
(1, 'Seniru', '2002', 'seni', 'student');

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
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
