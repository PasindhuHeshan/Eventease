-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 11:47 AM
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
('Seniru', 3);

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
  `event_type` varchar(50) NOT NULL,
  `approvedstatus` int(11) NOT NULL,
  `supervisor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`no`, `name`, `short_dis`, `long_dis`, `flag`, `time`, `date`, `location`, `people_limit`, `event_type`, `approvedstatus`, `supervisor`) VALUES
(1, 'Art Exhibition', 'Futuristic art showcase from renowned artists.', 'Step into a world where imagination meets reality in this cutting-edge art exhibition. Featuring over 50 renowned contemporary artists, \"Visions of the Future\" explores the infinite possibilities of tomorrow through various mediums including paintings, sculptures, digital art, and installations. Each piece challenges conventional perceptions and invites viewers to ponder the future of technology, society, and the environment. Special guided tours and interactive sessions with the artists will provide deeper insights into their visionary creations.', 1, '09:00:00', '2024-01-15', 'Art Gallery', 150, 'Exhibition', 1, 'Mr. Adams'),
(2, 'Music Festival', 'Relaxing music in a picturesque park.', 'Experience the perfect blend of music and nature at the \"Sounds of Serenity\" music festival. Set in a picturesque park, this event features acoustic performances, ambient soundscapes, and nature-inspired compositions from world-class musicians. Guests can participate in guided meditation sessions, yoga classes, and mindfulness workshops, all designed to enhance the healing power of music and nature. Enjoy evening bonfires, storytelling sessions, and serene boat rides on the park’s tranquil lake.', 1, '10:00:00', '2024-02-20', 'City Park', 200, 'Festival', 1, 'Ms. Davis'),
(3, 'Tech Conference', 'Premier event for tech enthusiasts.', 'Join industry leaders and innovators at \"Innovate 2024,\" the foremost tech conference of the year. This three-day event includes keynote speeches from top tech CEOs, panel discussions on emerging trends, hands-on workshops, and a showcase of the latest gadgets and technologies. Attendees will have the opportunity to network with experts, learn about the future of AI, blockchain, cybersecurity, and more. The conference will also feature innovation challenges, hackathons, and startup pitches, providing a platform for the next generation of tech entrepreneurs.', 1, '08:00:00', '2024-03-05', 'Convention Center', 300, 'Conference', 1, 'Mr. Brown'),
(4, 'Film Festival', 'Celebration of international films.', 'Embark on a cinematic journey at \"Cinema Paradiso,\" a festival dedicated to the art of filmmaking. Featuring screenings of over 100 films from around the globe, this event highlights the diversity of storytelling through cinema. Meet acclaimed directors, participate in Q&A sessions, and enjoy special premieres of groundbreaking films. Workshops and masterclasses on screenwriting, directing, and editing are also available for aspiring filmmakers. The festival will also include a special section for independent films and documentaries, providing a platform for emerging voices in cinema.', 1, '11:00:00', '2024-04-10', 'Film Theater', 250, 'Festival', 1, 'Ms. Clark'),
(5, 'Culinary Event', 'Global culinary experience.', 'Indulge in a gastronomic adventure at \"Flavors of the World,\" where chefs from around the globe come together to showcase their culinary artistry. Taste exotic dishes, attend cooking demonstrations, and learn about the cultural significance of various cuisines. This event also features food-related workshops, such as wine pairing, chocolate making, and sustainable cooking practices. A must-attend for food lovers and culinary professionals alike, the event will also host a special farm-to-table dinner under the stars.', 1, '12:00:00', '2024-05-18', 'Gourmet Hall', 180, 'Event', 1, 'Chef Blanc'),
(6, 'Literary Festival', 'World of literature and storytelling.', 'Dive into the world of words at the \"Books and Beyond\" literary festival. Featuring renowned authors, poets, and storytellers, this event offers a variety of literary activities including book readings, signings, and panel discussions. Explore the world of publishing, participate in writing workshops, and discover new literary talents. With a dedicated area for children’s literature, the festival is a family-friendly event promoting the joy of reading. Special sessions on digital publishing, e-books, and interactive storytelling will also be part of the festival.', 1, '13:00:00', '2024-06-22', 'Library Plaza', 200, 'Festival', 1, 'Mr. Johnson'),
(7, 'Wellness Expo', 'Health and wellness expo.', 'Transform your lifestyle at the \"Live Well\" Health and Wellness Expo. This comprehensive event focuses on physical, mental, and emotional well-being, featuring health screenings, fitness classes, and nutrition seminars. Connect with wellness experts, participate in mindfulness sessions, and explore holistic health products. Workshops on stress management, mental health awareness, and alternative therapies provide valuable insights for a balanced life. Additionally, the expo will offer personalized wellness plans and one-on-one consultations with health professionals.', 1, '09:30:00', '2024-07-15', 'Health Center', 220, 'Expo', 1, 'Dr. Green'),
(8, 'Environmental Summit', 'Addressing environmental challenges.', 'Join environmental activists, scientists, and policymakers at the \"Green Future\" summit to tackle pressing ecological issues. This event includes keynote speeches on climate change, biodiversity, and sustainable practices. Participate in roundtable discussions, attend green technology exhibitions, and network with like-minded individuals committed to environmental preservation. Workshops on renewable energy, conservation strategies, and eco-friendly living offer practical solutions for a sustainable future. The summit will also host a special youth forum to engage the next generation in environmental activism.', 1, '14:00:00', '2024-08-09', 'Eco Center', 300, 'Summit', 1, 'Ms. Taylor'),
(9, 'Fashion Show', 'Latest trends in fashion.', 'Discover the future of fashion at the \"Runway Revolution\" fashion show. Featuring collections from top designers and emerging talents, this event showcases innovative designs, sustainable fashion, and avant-garde styles. Enjoy live runway shows, fashion exhibitions, and styling workshops. Attendees can also participate in panel discussions on the impact of fashion on society and the environment, and explore the intersection of technology and fashion. Special backstage tours and meet-and-greet sessions with designers will provide an exclusive look into the world of fashion.', 1, '15:30:00', '2024-09-12', 'Fashion Avenue', 150, 'Show', 1, 'Ms. Lee'),
(10, 'Science Fair', 'Interactive science and technology fair.', 'Ignite your curiosity at \"Discover 2024,\" an interactive science fair designed for all ages. Explore hands-on exhibits, demonstrations, and experiments covering topics like robotics, space exploration, and environmental science. Meet scientists, engineers, and educators who share their passion for discovery and innovation. Participate in science workshops, competitions, and STEM activities that inspire the next generation of innovators. The fair will also feature special guest lectures and presentations on cutting-edge scientific research and breakthroughs.', 1, '10:00:00', '2024-10-05', 'Science Center', 250, 'Fair', 1, 'Dr. Williams');

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
(25, 'Laptop', 'INV-001', 10, 'Electronics'),
(26, 'Keyboard', 'INV-002', 20, 'Electronics'),
(27, 'Mouse', 'INV-003', 30, 'Electronics'),
(28, 'Desk', 'INV-004', 5, 'Furniture'),
(29, 'Chair', 'INV-005', 10, 'Furniture'),
(30, 'Pen', 'INV-006', 100, 'Stationery'),
(33, 'Washing Machine', 'INV-009', 2, 'Appliances'),
(34, 'TV', 'INV-010', 4, 'Electronics');

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

--
-- Dumping data for table `rolereq`
--

INSERT INTO `rolereq` (`no`, `username`, `email`, `role`, `status`, `reason`) VALUES
(1, 'Seniru', 'seni@gmail.com', 'Event Organizer', 0, 'Want it');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `No` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usertype` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `profile_picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`No`, `username`, `password`, `email`, `usertype`, `address`, `city`, `phone`, `profile_picture`) VALUES
(1, 'Seniru', '2005', 'seni@gmail.com', 'student', 'Sama Mawatha', 'Homagama', 7070707, 'images/profiles/DSCN3961.jpg'),
(2, 'admin', '2001', 'sanduni@gmail.com', 'admin', '', '', 0, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rolereq`
--
ALTER TABLE `rolereq`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
