-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 06:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `admin_support`
--

CREATE TABLE `admin_support` (
  `no` int(11) NOT NULL,
  `row_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `details` varchar(4000) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_support`
--

INSERT INTO `admin_support` (`no`, `row_id`, `id`, `details`, `contact_no`, `status`) VALUES
(55, 8, 2, 'account has been blocked', 715286555, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_support_id`
--

CREATE TABLE `admin_support_id` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_support_id`
--

INSERT INTO `admin_support_id` (`id`, `type`) VALUES
(1, 'Feedback'),
(2, 'Disable Account'),
(3, 'Complaint');

-- --------------------------------------------------------

--
-- Table structure for table `contact_numbers`
--

CREATE TABLE `contact_numbers` (
  `Cnt_No` int(11) NOT NULL,
  `Cnt_num` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_numbers`
--

INSERT INTO `contact_numbers` (`Cnt_No`, `Cnt_num`) VALUES
(63, '0452896578'),
(63, '0526998574'),
(17, '0718596880'),
(17, '0748596327'),
(94, '0711320220'),
(16, '0125478569');

-- --------------------------------------------------------

--
-- Table structure for table `contact_support`
--

CREATE TABLE `contact_support` (
  `no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `open_time` timestamp NULL DEFAULT NULL,
  `reply_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_support`
--

INSERT INTO `contact_support` (`no`, `name`, `id`, `email`, `contact_no`, `open_time`, `reply_time`) VALUES
(23, 'sdsa', '3', 'ss@gmail.com', '0125478969', '2025-04-16 06:38:04', NULL),
(25, 'Seniru', '1', 'seniru@stu.ucsc.cmb.ac.lk', '0718596859', '2025-04-16 15:59:43', '2025-04-16 15:17:02'),
(26, 'asd', '1', 'asd@stu.ucsc.cmb.ac.lk', '0715286555', '2025-04-19 08:02:22', '2025-04-19 08:05:28'),
(27, 'asd', '3', 'asd@stu.ucsc.cmb.ac.lk', '0715286555', '2025-04-19 08:03:35', NULL),
(29, 'san', '1', 'san@gmail.com', '0715286550', '2025-04-19 08:24:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_support_data`
--

CREATE TABLE `contact_support_data` (
  `row_no` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `user_msg` varchar(1000) NOT NULL,
  `admin_msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_support_data`
--

INSERT INTO `contact_support_data` (`row_no`, `no`, `user_msg`, `admin_msg`) VALUES
(50, 25, 'adasd', ''),
(51, 25, '', 'hih'),
(52, 25, 'hi', ''),
(53, 25, '', ''),
(54, 26, 'hi ', ''),
(55, 27, 'whyy', ''),
(56, 26, '', 'hi'),
(65, 29, 'hi i want to know about events', '');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `username` varchar(100) NOT NULL,
  `eventno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`username`, `eventno`) VALUES
('Seniru', 26),
('Seniru', 27),
('ssss', 2),
('seniru0', 3),
('Sanduni', 1),
('seniru', 8),
('seniru', 1),
('navindu', 5),
('seniru', 2),
('seniru', 3),
('asdw', 3),
('asdw', 4),
('seniru', 4);

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
  `finish_time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(20) NOT NULL,
  `people_limit` int(11) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `approvedstatus` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `event_banner` varchar(200) NOT NULL,
  `organizer` int(11) NOT NULL,
  `orgno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`no`, `name`, `short_dis`, `long_dis`, `flag`, `time`, `finish_time`, `date`, `location`, `people_limit`, `event_type`, `approvedstatus`, `reason`, `supervisor`, `event_banner`, `organizer`, `orgno`) VALUES
(1, 'Art Exhibition', 'Futuristic art showcase from renowned artists.', 'Step into a world where imagination meets reality in this cutting-edge art exhibition. Featuring over 50 renowned contemporary artists, \"Visions of the Future\" explores the infinite possibilities of tomorrow through various mediums including paintings, sculptures, digital art, and installations. Each piece challenges conventional perceptions and invites viewers to ponder the future of technology, society, and the environment. Special guided tours and interactive sessions with the artists will provide deeper insights into their visionary creations.', 0, '09:00:00', '00:00:00', '2025-01-15', 'Art Gallery', 150, 'Exhibition', 0, '', 20, 'images/events/banner1.jpeg', 16, 2),
(2, 'Music Festival', 'Relaxing music in a picturesque park.', 'Experience the perfect blend of music and nature at the \"Sounds of Serenity\" music festival. Set in a picturesque park, this event features acoustic performances, ambient soundscapes, and nature-inspired compositions from world-class musicians. Guests can participate in guided meditation sessions, yoga classes, and mindfulness workshops, all designed to enhance the healing power of music and nature. Enjoy evening bonfires, storytelling sessions, and serene boat rides on the park’s tranquil lake.', 1, '10:00:00', '00:00:00', '2025-02-11', 'City Park', 200, 'Festival', 0, '', 20, 'images/events/banner2.jpeg', 16, 0),
(3, 'Tech Conference', 'Premier event for tech enthusiasts.', 'Join industry leaders and innovators at \"Innovate 2025,\" the foremost tech conference of the year. This three-day event includes keynote speeches from top tech CEOs, panel discussions on emerging trends, hands-on workshops, and a showcase of the latest gadgets and technologies. Attendees will have the opportunity to network with experts, learn about the future of AI, blockchain, cybersecurity, and more. The conference will also feature innovation challenges, hackathons, and startup pitches, providing a platform for the next generation of tech entrepreneurs.', 1, '08:00:00', '00:00:00', '2025-02-20', 'Convention Center', 300, 'Conference', 0, '', 20, 'images/events/banner3.jpeg', 16, 0),
(4, 'Film Festival', 'Celebration of international films.', 'Embark on a cinematic journey at \"Cinema Paradiso,\" a festival dedicated to the art of filmmaking. Featuring screenings of over 100 films from around the globe, this event highlights the diversity of storytelling through cinema. Meet acclaimed directors, participate in Q&A sessions, and enjoy special premieres of groundbreaking films. Workshops and masterclasses on screenwriting, directing, and editing are also available for aspiring filmmakers. The festival will also include a special section for independent films and documentaries, providing a platform for emerging voices in cinema.', 1, '11:00:00', '00:00:00', '2025-04-10', 'Film Theater', 250, 'Festival', 0, '', 20, 'images/events/banner1.jpeg', 16, 0),
(5, 'Culinary Event', 'Global culinary experience.', 'Indulge in a gastronomic adventure at \"Flavors of the World,\" where chefs from around the globe come together to showcase their culinary artistry. Taste exotic dishes, attend cooking demonstrations, and learn about the cultural significance of various cuisines. This event also features food-related workshops, such as wine pairing, chocolate making, and sustainable cooking practices. A must-attend for food lovers and culinary professionals alike, the event will also host a special farm-to-table dinner under the stars.', 1, '12:00:00', '00:00:00', '2025-05-18', 'Gourmet Hall', 180, 'Event', 0, '', 20, 'images/events/banner4.jpeg', 16, 0),
(6, 'Literary Festival', 'World of literature and storytelling.', 'Dive into the world of words at the \"Books and Beyond\" literary festival. Featuring renowned authors, poets, and storytellers, this event offers a variety of literary activities including book readings, signings, and panel discussions. Explore the world of publishing, participate in writing workshops, and discover new literary talents. With a dedicated area for children’s literature, the festival is a family-friendly event promoting the joy of reading. Special sessions on digital publishing, e-books, and interactive storytelling will also be part of the festival.', 1, '13:00:00', '00:00:00', '2025-06-22', 'Library Plaza', 200, 'Festival', 0, '', 20, 'images/events/banner5.jpeg', 16, 2),
(7, 'Wellness Expo', 'Health and wellness expo.', 'Transform your lifestyle at the \"Live Well\" Health and Wellness Expo. This comprehensive event focuses on physical, mental, and emotional well-being, featuring health screenings, fitness classes, and nutrition seminars. Connect with wellness experts, participate in mindfulness sessions, and explore holistic health products. Workshops on stress management, mental health awareness, and alternative therapies provide valuable insights for a balanced life. Additionally, the expo will offer personalized wellness plans and one-on-one consultations with health professionals.', 1, '09:30:00', '00:00:00', '2025-07-15', 'Health Center', 220, 'Expo', 0, '', 20, 'images/events/banner2.jpeg', 16, 0),
(8, 'Environmental Summit', 'Addressing environmental challenges.', 'Join environmental activists, scientists, and policymakers at the \"Green Future\" summit to tackle pressing ecological issues. This event includes keynote speeches on climate change, biodiversity, and sustainable practices. Participate in roundtable discussions, attend green technology exhibitions, and network with like-minded individuals committed to environmental preservation. Workshops on renewable energy, conservation strategies, and eco-friendly living offer practical solutions for a sustainable future. The summit will also host a special youth forum to engage the next generation in environmental activism.', 1, '14:00:00', '00:00:00', '2025-08-09', 'Eco Center', 300, 'Summit', 0, '', 20, 'images/events/banner1.jpeg', 16, 0),
(9, 'Fashion Show', 'Latest trends in fashion.', 'Discover the future of fashion at the \"Runway Revolution\" fashion show. Featuring collections from top designers and emerging talents, this event showcases innovative designs, sustainable fashion, and avant-garde styles. Enjoy live runway shows, fashion exhibitions, and styling workshops. Attendees can also participate in panel discussions on the impact of fashion on society and the environment, and explore the intersection of technology and fashion. Special backstage tours and meet-and-greet sessions with designers will provide an exclusive look into the world of fashion.', 1, '15:30:00', '17:30:00', '2025-09-12', 'Fashion Avenue', 150, 'Charity', 0, 'nope', 20, 'images/events/Gemini_Generated_Image_qe545jqe545jqe54.jpeg', 16, 0),
(10, 'Social Gathering', 'Community social event.', 'Join us for a community social gathering where neighbors can connect, share stories, and enjoy a variety of activities. The event will feature live music, food stalls, games, and a talent show. It’s a perfect opportunity to meet new people and strengthen community bonds.', 1, '00:00:00', '00:00:00', '2025-10-10', 'Community Center', 100, 'Social', 0, '', 20, 'images/events/Gemini_Generated_Image_qe545jqe545jqe54.jpeg', 16, 0),
(11, 'Educational Workshop', 'Interactive learning experience.', 'Participate in an interactive educational workshop designed to enhance your skills and knowledge. This workshop covers a range of topics including technology, science, and arts. Expert instructors will guide you through hands-on activities and provide valuable insights.', 1, '10:00:00', '00:00:00', '2025-11-15', 'Education Hall', 50, 'Educational', 0, '', 20, '0', 16, 0),
(12, 'Entertainment Night', 'Fun-filled entertainment event.', 'Enjoy a night of entertainment with live performances, comedy acts, and dance shows. This event promises to be a fun-filled evening for all ages. Don’t miss out on the exciting lineup of entertainers and the chance to win prizes in various contests.', 1, '15:40:00', '16:00:00', '2025-09-12', 'Entertainment Arena', 300, 'Entertainment', 0, '', 20, '0', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_inventory`
--

CREATE TABLE `event_inventory` (
  `event_id` int(11) NOT NULL,
  `inventory_item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_inventory`
--

INSERT INTO `event_inventory` (`event_id`, `inventory_item`, `quantity`, `status`) VALUES
(9, 15, 2, 1),
(9, 17, 1, 1),
(12, 15, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `eventno` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_numbers`
--

CREATE TABLE `id_numbers` (
  `no` int(11) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item`, `inventory_no`, `quantity`, `inventory_type`) VALUES
(1, 'Laptop', 'INV-001', 8, 'Electronics'),
(3, 'Whiteboard Marker', 'INV-003', 200, 'Stationery'),
(4, 'Chair', 'INV-004', 35, 'Furniture'),
(5, 'Air Conditioner', 'INV-005', 1, 'Appliances'),
(7, 'Lecture Notes', 'INV-007', 500, 'Stationery'),
(9, 'Microscope', 'INV-009', 10, 'Electronics'),
(12, 'Stapler', 'INV-012', 1000, 'Stationery'),
(13, 'Office Chair', 'INV-013', 25, 'Furniture'),
(14, 'Projector Lamp', 'INV-014', 18, 'Electronics'),
(15, 'Dryer', 'INV-015', 4, 'Appliances'),
(16, 'Pen', 'INV-016', 1000, 'Stationery'),
(17, 'File Cabinet', 'INV-017', 1, 'Furniture'),
(18, 'Tablet', 'INV-018', 32, 'Electronics'),
(19, 'Refrigerator', 'INV-019', 5, 'Appliances'),
(20, 'Notebook', 'INV-020', 300, 'Stationery'),
(21, 'Tablet', 'INV-19', 10, 'Electronics'),
(22, 'Desk', 'INV-051', 25, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `orgno` int(11) NOT NULL,
  `orgname` varchar(100) NOT NULL,
  `orgdetails` varchar(2000) NOT NULL,
  `orgprofilepic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`orgno`, `orgname`, `orgdetails`, `orgprofilepic`) VALUES
(0, 'IEEE student Branch UCSC', 'Hi', ''),
(1, 'AISEC', 'asdad', ''),
(2, 'ACM Student Branch UCSC', 'Hello', '');

-- --------------------------------------------------------

--
-- Table structure for table `organizer_society`
--

CREATE TABLE `organizer_society` (
  `organizer_no` int(11) NOT NULL,
  `organization_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizer_society`
--

INSERT INTO `organizer_society` (`organizer_no`, `organization_no`) VALUES
(17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rolereq`
--

CREATE TABLE `rolereq` (
  `no` int(11) NOT NULL,
  `role` varchar(40) NOT NULL,
  `organization` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `reply` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rolereq`
--

INSERT INTO `rolereq` (`no`, `role`, `organization`, `status`, `reason`, `reply`) VALUES
(17, '3', 2, 1, 'asd', ''),
(63, '3', 0, 0, 'i want to be an event organizer', '');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` varchar(50) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
('0', 'Admin'),
('1', 'Student'),
('2', 'Guest'),
('3', 'Organizer'),
('4', 'Support Staff'),
('5', 'Academic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `No` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `id` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`No`, `username`, `password`, `fname`, `lname`, `email`, `usertype`, `id`, `address`, `city`, `profile_picture`, `status`, `created_at`, `updated_at`) VALUES
(10, 'sanduni', '$2y$10$VB/Zi7XXE/gFY.64z8o7a.jric8faY3mLJwBCXynOtpP1SNSIgGBq', 'Sanduni', '', 'saduni@stu.ucsc.cmb.lk', '0', 'ucsc', '2', '2', 'images/profiles/BlackRock-windows10Wallpapers.jpg', 1, '2024-11-28 13:00:52', '2025-04-14 09:56:42'),
(11, 'navindu', '$2y$10$gLOWumpp8eS6JnsCrLrK.uJP4y9hr/wNfQ5tM/TlkSnh9ScaPFfGq', 'Navindu', 'Thilakshana', 'se@gmail.com', '2', '200234600111', 'asd', 'asd', NULL, 1, '2024-11-28 13:27:11', '2025-04-07 08:01:08'),
(16, 'pasindu', '$2y$10$.6eQk7X78Q.s2vhu3IG77uPC9YH5/3JKzVZ.mutH0Z0EkGP6z3YUa', 'Pasindu', 'Heshan', 'seniru@stu.ucsc.cmb.lk', '3', '22020782', 'Sama Mawatha', 'Kottawa', 'images/profiles/WP_20190224_13_38_15_Pro_LI.jpg', 1, '2024-11-28 14:55:07', '2025-04-07 06:44:36'),
(17, 'seniru', '$2y$10$OKNPBhPharr9wqV2FS1MPONXDVA2gVqOcgAM1TiBqA3OgVE/xqvnW', 'Seniru', 'Ranasinghe', 'seniru@stu.ucsc.cmb.ac.lk', '3', '22020782', 'Sama Mawatha', 'Homagama', 'images/profiles/Screenshot (3).png', 1, '2024-11-28 15:02:04', '2025-04-16 15:39:11'),
(19, 'pasindu2', '$2y$10$tYxF4J6sEY6EYZdwf6RodOSSFmOkyaym3FgHLN51xaDqyJoevdm/O', 'Pasindu', 'aa', 'aa@gmail.com', '4', '0', '12', '`12', NULL, 1, '2024-11-29 04:55:05', '2025-04-07 06:44:37'),
(20, 'navindu2', '$2y$10$tyZ0/xUexSm8mGn8WT9WHe9AaHcjrmusKBLLV6soRYc/UQ0ZY446C', 'Navindu', 'T', 'se@gmail.com', '5', '0', '12', '12', NULL, 1, '2024-11-29 05:01:30', '2025-04-07 06:44:37'),
(51, 'aaaa', '$2y$10$dAcHXcRFqhUExqHjnXC2EemXfy0uF/QPY9yJB7G8RpytFVDnBFHlO', 'as', 'asd', 'asd@gmail.com', '2', '200234600222', '45', '5', NULL, 1, '2025-04-07 08:05:54', '2025-04-14 11:57:21'),
(52, 'wwww', '$2y$10$zeZWyCGr5MUQ.4NB698tROQerAAveVQ5k40aO7Br0Tw2PbGNwO7ne', 'aaaa', 'aaaa', 'aaa@stu.ucsc.cmb.ac.lk', '1', '22020782', '12', '12', NULL, 1, '2025-04-07 08:07:12', '2025-04-07 08:07:26'),
(53, 'asds', '$2y$10$N5W8aWgM9VVABlaAmHA.YuLID3ql/9R9y54I4dp0VWHdL4GeVsPuy', 'aa', 'aa', 'aa@stu.ucsc.cmb.ac.lk', '1', '00', 'a', 'd', NULL, 1, '2025-04-07 08:16:19', '2025-04-07 08:16:19'),
(54, 'asdasd', '$2y$10$6wM7eI4KOdRRKTiEFKBJQ.5xeBUk8CtwXdY60JZE1lV67DJlDQlwC', 'ss', 'ss', 'ss@stu.ucsc.cmb.ac.lk', '1', '00', '22', '22', NULL, 1, '2025-04-07 08:18:29', '2025-04-07 08:18:29'),
(55, 'asdasdf', '$2y$10$NI3lDVxH.XIpVHF17ssmkeMxDqCihM2QXApR.5IuwQDtqC9NjCKKi', 'asd', 'asd', 'asd@stu.ucsc.cmb.ac.lk', '1', '22020782', '22', '22', NULL, 0, '2025-04-07 08:20:02', '2025-04-19 07:55:39'),
(56, 'asdasdfg', '$2y$10$7GMBqafL3MwgnyxUBW0LNOg2XMxzX2xr4xa3T6UgaweQ9.IU9MrKO', 'asd', 'asd', 'asd@gmail.com', '2', '200234655555', '123', '123', NULL, 1, '2025-04-07 08:21:20', '2025-04-07 08:21:20'),
(63, 'qqqq', '$2y$10$rgWvw0e4SB37ZgmHhXybPedBHEkZroYPywdA3pNUMgg7W40IhWTSm', 'asd', 'asa', 'asd@stu.ucsc.cmb.ac.lk', '1', '22020258', 'asd', 'asd', NULL, 1, '2025-04-09 15:29:05', '2025-04-19 07:55:34'),
(94, 'Kaushi', '$2y$10$EzRS8fiKrzhS4RwhK1zJWuQFdHKvjklz4mcaAlPO1C1j58RVfVmWm', 'Kaushi', 'Wijewardhana', 'sanduniwijewardhane@gmail.com', '5', '22021180', 'colombo', 'colombo7', NULL, 1, '2025-04-19 07:49:08', '2025-04-19 07:51:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_support`
--
ALTER TABLE `admin_support`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `no` (`no`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `admin_support_id`
--
ALTER TABLE `admin_support_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_numbers`
--
ALTER TABLE `contact_numbers`
  ADD KEY `contact_numbers_ibfk_1` (`Cnt_No`);

--
-- Indexes for table `contact_support`
--
ALTER TABLE `contact_support`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `contact_support_data`
--
ALTER TABLE `contact_support_data`
  ADD PRIMARY KEY (`row_no`),
  ADD KEY `contact_support_data_ibfk_1` (`no`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`no`),
  ADD KEY `orgno` (`orgno`),
  ADD KEY `supervisor` (`supervisor`);

--
-- Indexes for table `event_inventory`
--
ALTER TABLE `event_inventory`
  ADD KEY `eventno` (`event_id`),
  ADD KEY `inventory_requested` (`inventory_item`);

--
-- Indexes for table `id_numbers`
--
ALTER TABLE `id_numbers`
  ADD KEY `no` (`no`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`orgno`);

--
-- Indexes for table `organizer_society`
--
ALTER TABLE `organizer_society`
  ADD KEY `organizer_society_ibfk_1` (`organization_no`),
  ADD KEY `organizer_society_ibfk_2` (`organizer_no`);

--
-- Indexes for table `rolereq`
--
ALTER TABLE `rolereq`
  ADD KEY `no` (`no`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `usertype` (`usertype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_support`
--
ALTER TABLE `admin_support`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_support`
--
ALTER TABLE `contact_support`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `contact_support_data`
--
ALTER TABLE `contact_support_data`
  MODIFY `row_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `orgno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_support`
--
ALTER TABLE `admin_support`
  ADD CONSTRAINT `admin_support_ibfk_1` FOREIGN KEY (`no`) REFERENCES `users` (`No`),
  ADD CONSTRAINT `admin_support_ibfk_2` FOREIGN KEY (`id`) REFERENCES `admin_support_id` (`id`);

--
-- Constraints for table `contact_numbers`
--
ALTER TABLE `contact_numbers`
  ADD CONSTRAINT `contact_numbers_ibfk_1` FOREIGN KEY (`Cnt_No`) REFERENCES `users` (`No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_support_data`
--
ALTER TABLE `contact_support_data`
  ADD CONSTRAINT `contact_support_data_ibfk_1` FOREIGN KEY (`no`) REFERENCES `contact_support` (`no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`orgno`) REFERENCES `organizations` (`orgno`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`supervisor`) REFERENCES `users` (`No`);

--
-- Constraints for table `event_inventory`
--
ALTER TABLE `event_inventory`
  ADD CONSTRAINT `event_inventory_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`no`),
  ADD CONSTRAINT `event_inventory_ibfk_2` FOREIGN KEY (`inventory_item`) REFERENCES `inventory` (`id`);

--
-- Constraints for table `id_numbers`
--
ALTER TABLE `id_numbers`
  ADD CONSTRAINT `id_numbers_ibfk_1` FOREIGN KEY (`no`) REFERENCES `users` (`No`);

--
-- Constraints for table `organizer_society`
--
ALTER TABLE `organizer_society`
  ADD CONSTRAINT `organizer_society_ibfk_1` FOREIGN KEY (`organization_no`) REFERENCES `organizations` (`orgno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organizer_society_ibfk_2` FOREIGN KEY (`organizer_no`) REFERENCES `users` (`No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rolereq`
--
ALTER TABLE `rolereq`
  ADD CONSTRAINT `rolereq_ibfk_1` FOREIGN KEY (`no`) REFERENCES `users` (`No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`usertype`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
