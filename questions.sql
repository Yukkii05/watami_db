-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 06:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riddle`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `riddle_id` int(11) NOT NULL,
  `riddle_question` text NOT NULL,
  `riddle_choices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`riddle_choices`)),
  `riddle_answer` text NOT NULL,
  `riddle_points` int(11) NOT NULL,
  `riddle_difficulty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`riddle_id`, `riddle_question`, `riddle_choices`, `riddle_answer`, `riddle_points`, `riddle_difficulty`) VALUES
(2, 'The more of this there is, the less you see. What is it?', '[\"Darkness\",\"Fog\",\"Light\"]', 'Darkness', 2, 2),
(3, 'What comes once in a minute, twice in a moment, but never in a thousand years?', '[\"The letter M\",\"Time\",\"Daylight\"]', 'The letter M', 3, 2),
(4, 'I’m tall when I’m young, and I’m short when I’m old. What am I?', '[\"A candle\",\"A tree\",\"A person\"]', 'A candle', 2, 1),
(5, 'I speak without a mouth and hear without ears. I have nobody, but I come alive with wind. What am I?', '[\"An echo\",\"A bird\",\"A wave\"]', 'An echo', 3, 3),
(6, 'What has many keys but can’t open a single lock?', '[\"A piano\",\"A computer\",\"A vault\"]', 'A piano', 2, 1),
(7, 'What has hands but can’t clap?', '[\"A clock\",\"A robot\",\"A statue\"]', 'A clock', 1, 1),
(8, 'What gets wetter as it dries?', '[\"A towel\",\"A sponge\",\"A cloud\"]', 'A towel', 2, 1),
(9, 'I’m light as a feather, yet the strongest man can’t hold me for much longer. What am I?', '[\"Breath\",\"A balloon\",\"Water\"]', 'Breath', 3, 3),
(10, 'What has a head, a tail, is brown, and has no legs?', '[\"A penny\",\"A snake\",\"A shoe\"]', 'A penny', 2, 1),
(11, 'Forward I am heavy, but backward I am not. What am I?', '[\"A ton\",\"A feather\",\"A book\"]', 'A ton', 3, 2),
(12, 'Uhmm', '[\"Yes\",\"No\",\"Maybe\"]', 'Maybe', 100, 1),
(13, 'Maya hee', '[\"maya who\",\"maya ha\",\"maya haha\"]', 'maya ha', 9999999, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`riddle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `riddle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
