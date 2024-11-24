-- Check if the database exists and create it if not
CREATE DATABASE IF NOT EXISTS eventease;

-- Use the eventease database
USE eventease;

-- Ensure consistent SQL settings
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for `events`
CREATE TABLE IF NOT EXISTS `events` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
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
  `supervisor` varchar(100) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `events`
INSERT INTO `events` (`no`, `name`, `short_dis`, `long_dis`, `flag`, `time`, `date`, `location`, `people_limit`, `type`, `approvedstatus`, `supervisor`) VALUES
(26, 'Summer Picnic', 'Enjoy a fun day in the park', 'Join us for a delightful summer picnic in the heart of Central Park. Bring your favorite blanket, snacks, and games for a fun-filled day with friends and family. We\'ll have live music, a barbecue, and plenty of outdoor activities for all ages.', 1, '12:00:00', '2024-07-15', 'Central Park', 100, 'Social', 1, 'John Doe'),
(27, 'Coding Workshop', 'Learn to code in a fun and interactive way', 'Discover the world of coding in our interactive workshop. Experienced instructors will guide you through the basics of HTML, CSS, and JavaScript. Whether you\'re a complete beginner or looking to enhance your skills, this workshop is perfect for anyone interested in learning to code.', 0, '09:00:00', '2024-10-20', 'Tech Hub', 50, 'Educational', 1, 'Jane Smith');

-- More events...

-- Table structure for `inventory`
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(50) NOT NULL,
  `inventory_no` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `inventory_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `rolereq`
CREATE TABLE IF NOT EXISTS `rolereq` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(40) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `users`
CREATE TABLE IF NOT EXISTS `users` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usertype` varchar(40) NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`No`, `username`, `password`, `email`, `usertype`) VALUES
(1, 'Seniru', '2002', 'seni', 'student');

-- Complete the transaction
COMMIT;
