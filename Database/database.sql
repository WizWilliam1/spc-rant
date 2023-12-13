-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 08:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `User_ID` int(11) NOT NULL,
  `Email_or_Phone` varchar(255) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`User_ID`, `Email_or_Phone`, `Username`, `Password`) VALUES
(1, 'Admin@gmail.com', 'Admin', '5321');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `timestamp`, `user_id`, `comment`) VALUES
(17, 13, '2023-11-18 12:15:47', 0, 'New Comment Update'),
(18, 13, '2023-11-18 12:17:38', 0, 'sure ba'),
(19, 13, '2023-11-18 12:33:12', 0, 'asdf'),
(20, 14, '2023-11-18 12:50:15', 0, 'yawa'),
(21, 13, '2023-11-18 12:57:41', 0, 'atay'),
(22, 14, '2023-11-18 12:57:44', 0, 'test'),
(23, 15, '2023-11-18 13:25:54', 0, 'Cool dog post comment?'),
(24, 19, '2023-11-18 14:38:31', 0, 'Mafia Yarns sheeshhh'),
(25, 19, '2023-11-18 14:40:30', 0, 'Test refresh mode again'),
(26, 19, '2023-11-18 14:44:09', 0, 'atots da'),
(27, 19, '2023-11-18 14:45:48', 0, 'yawa'),
(28, 19, '2023-11-18 14:45:51', 0, 'baunga oi'),
(29, 20, '2023-12-13 12:10:13', 0, 'anga oi'),
(30, 20, '2023-12-13 12:31:32', 0, 'test'),
(31, 20, '2023-12-13 12:35:41', 0, 'sadfasdf'),
(32, 22, '2023-12-13 14:37:18', 1, 'Added Forgot Password Files and Function'),
(33, 22, '2023-12-13 14:37:35', 1, '*Still have problem; Sa pag reset sa password kay di mo update');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`user_id`, `token`, `timestamp`) VALUES
(1, 'ec95fda0e010b790feb9dd3b5be35ee1bca9535a8a9e59f96d483a045758b55a2d32bb83bf80f7015c84d63bcd12df0302ab', 1702444507);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(30) NOT NULL,
  `CONTENT` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `TITLE`, `CONTENT`, `user_id`, `created_at`) VALUES
(13, 'Comment Testing', 'This is a comment testing and we will see if it is working or not.', 0, '2023-11-18 04:03:17'),
(14, 'Another Comment Testing', 'Another comment testing and we will update this later or sooner.', 0, '2023-11-18 04:50:07'),
(15, 'Another New Posts ', 'Another new posts to be tested out and I hope it works.', 0, '2023-11-18 05:16:28'),
(16, 'This is a new pop up test moda', 'Testing only for pop up post modal submit', 0, '2023-11-18 06:01:14'),
(17, 'Can you try again for post mod', 'this is a new pop up test modal', 0, '2023-11-18 06:01:33'),
(18, 'Another New Post Modal', 'Testing of new post modal again once again', 0, '2023-11-18 06:12:12'),
(19, 'Mafia Dark Mode', 'Testing of the new create post content design.', 0, '2023-11-18 06:38:21'),
(22, 'Time Posted Is Fixed', 'Can see Just Now, can also see weeks about the post its live and updated.', 0, '2023-12-13 04:42:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
