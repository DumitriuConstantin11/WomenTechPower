-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: dec. 01, 2024 la 05:36 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `women_tech_power`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `file_photo` varchar(255) DEFAULT NULL,
  `file_video` varchar(255) DEFAULT NULL,
  `yt_link` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `subject`, `description`, `file_photo`, `file_video`, `yt_link`, `member_id`, `created_at`) VALUES
(1, 'TestTitleArticle1', '', 'EditedDescription1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1', 'articles_uploads/Famous-Raisin-Sponge-Cake.jpg', NULL, NULL, 1, '2024-11-26 10:12:32'),
(2, 'TestTitleArticle2', NULL, 'Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2Description2', NULL, NULL, 'tfIO1uVQSZw', 1, '2024-11-26 10:27:15'),
(3, 'TestTitleArticle3', NULL, 'Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3', 'articles_uploads/pug.jpg', NULL, NULL, 1, '2024-11-26 14:04:19'),
(4, 'TestTitleArticle4', NULL, 'Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4', 'articles_uploads/latest.jpg', NULL, 'Nly4s1NTbWU', 1, '2024-11-26 15:43:43'),
(5, 'TestTitleArticle1', NULL, 'Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1Description1', NULL, NULL, NULL, 2, '2024-11-27 09:07:22'),
(7, 'TestTitle3Article', 'TestSubject3', 'Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3Description3', NULL, NULL, NULL, 2, '2024-11-27 09:16:12'),
(8, 'TestTitleArticle%%%', 'SubiectSubiect', 'DEscRiption DEscRiptionDEscRiptionDEscRiptionDEscRiption DEscRiption DEscRiptionDEscRiption DEscRiptionDEscRiptionDEscRiption DEscRiptionDEscRiption DEscRiption DEscRiption DEscRiption DEscRiptionDEscRiptionDEscRiption DEscRiption DEscRiptionDEscRiption  DEscRiption DEscRiptionDEscRiptionDEscRiptionDEscRiption ', NULL, NULL, NULL, 1, '2024-11-29 15:58:16'),
(9, 'TestArticleART_ARTICL', 'SuBjEcT', 'ionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion\r\nDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion Desc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tionDesc crip tion  Desc crip tionDesc crip tionDesc crip tion', NULL, NULL, NULL, 1, '2024-11-29 15:59:14');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_type` enum('workshop','mentoring','networking','conference') DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `event_type`, `max_participants`, `created_by`, `created_at`) VALUES
(1, 'EventTest1', 'EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1EventDescription1', '2025-01-01 00:00:00', 'Location1', 'workshop', 20, 1, '2024-11-28 09:41:45'),
(2, 'TitleEvent2', 'EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2EventDescription2', '2024-11-30 00:00:00', 'Location2', 'workshop', 2, 2, '2024-11-28 14:40:53'),
(3, 'TestTitlePastEvent', 'Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4Description4', '2024-11-29 00:00:00', 'Location4', 'conference', 3, 1, '2024-11-28 15:11:36'),
(4, 'TestTitleEventPastBeen', 'DescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASDDescriptiojnADASD', '2024-11-27 00:00:00', 'Location5', 'networking', 3, 1, '2024-11-28 15:50:37');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('confirmed','waiting','cancelled') DEFAULT 'confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `member_id`, `event_id`, `registration_date`, `status`) VALUES
(1, 1, 1, '2024-11-28 11:58:45', 'confirmed'),
(2, 2, 2, '2024-11-28 14:41:09', 'confirmed'),
(3, 1, 2, '2024-11-28 14:41:36', 'confirmed'),
(4, 2, 4, '2024-11-28 15:51:04', 'confirmed'),
(5, 2, 1, '2024-11-29 09:56:24', 'confirmed');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `event_reviews`
--

CREATE TABLE `event_reviews` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `event_reviews`
--

INSERT INTO `event_reviews` (`id`, `event_id`, `member_id`, `review`, `created_at`) VALUES
(1, 4, 2, 'ReviewText1ReviewText1ReviewText1ReviewText1', '2024-11-29 14:15:39');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Member','Mentor','Admin','') NOT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `expertise` text DEFAULT NULL,
  `linkedin_profile` varchar(255) DEFAULT NULL,
  `status` enum('active','pending','mentor') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `user_name`, `email`, `password`, `role`, `profession`, `company`, `expertise`, `linkedin_profile`, `status`, `created_at`, `profile_pic`) VALUES
(1, 'TestFN', 'TestLN', 'TestUN', 'testmail@gmail.com', '$2y$10$2zW6LP4cEoYlH0SA0e6c0.i9Zu79r/ooVUXw6OujR3OotQyfKOolS', 'Member', 'testprofession', 'testcompany', 'testexpertise', 'https://www.linkedin.com/in/testFN-testLN-6312422b8/', 'pending', '2024-11-21 09:53:34', 'uploads/female1.png'),
(2, 'test2FN', 'test2LN', 'test2UN', 'test2mail@gmail.com', '$2y$10$9PbDiNxOMMSxaKneeB.JK.lYVGM.VEa5valj0FRekfUz3/KDAXJse', 'Mentor', 'test2profession', 'test2company', 'test2expertise', 'https://www.linkedin.com/in/test2FN-test2LN-6312422b8/', 'pending', '2024-11-21 10:06:48', 'uploads/female2.png'),
(3, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$zGYd88BKpuNO7qs0eHpDruRfcRXockHimOON6XsTHmHw0odr0iYVG', 'Admin', '', '', '', 'https://www.linkedin.com/in/admin-admin-6312422b8/', 'pending', '2024-11-25 14:44:13', 'uploads/music.jpg'),
(4, 'Test3FN', 'Test3LN', 'Test3UN', 'test3email@gmail.com', '$2y$10$di8DaRu8MBr4v4IP5tSTJupunni95e963/Onb4sT6/7S4wZs3t1PO', 'Mentor', 'profession3', 'company3', 'expertise3', 'https://www.linkedin.com/in/test3fn-test3ln-6312422b8/', 'pending', '2024-11-27 11:05:23', 'uploads/female3.png'),
(5, 'Test4FN', 'Test4LN', 'Test4UN', 'test4email@gmail.com', '$2y$10$TK3OcPnuCWtwa2XzBYVd1OgUVxVLwf7n.NW6S1EGsLvVKPVnXz5Pm', 'Member', 'profession4', 'company4', 'expertise4', 'https://www.linkedin.com/in/test4ln-test4fn-6312422b8/', 'pending', '2024-11-30 14:55:16', 'uploads/etica7.jpg'),
(6, 'Test5FN', 'Test5LN', 'Test5UN', 'test5email@gmail.com', '$2y$10$FZHUyd7bHhdnbOyZkKdNQ.XhdRxfCSot1mruFxS5dwQdcS3UvaRsu', 'Member', 'profession5', 'company5', 'expertise5', 'https://www.linkedin.com/in/test5fn-test5ln-6312422b8/', 'pending', '2024-11-30 15:27:54', 'uploads/etica6.jpg'),
(7, 'Test6FN', 'Test6LN', 'Test6UN', 'test6email@gmail.com', '$2y$10$QBZgkTQOgkYO.dRJFmXHBeDhHxN4D0zXqjG7/gYH3OwtRWTB0EqO6', 'Mentor', 'profession6', 'company6', 'expertise6', 'https://www.linkedin.com/in/test6fn-tes6ln-6312422b8/', 'pending', '2024-12-01 10:51:12', 'uploads/female4.png');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `mentorship_enrollments`
--

CREATE TABLE `mentorship_enrollments` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `completed_chapters` int(11) DEFAULT 0,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `mentorship_enrollments`
--

INSERT INTO `mentorship_enrollments` (`id`, `program_id`, `member_id`, `completed_chapters`, `joined_at`) VALUES
(8, 4, 1, 9, '2024-11-30 11:53:30'),
(9, 4, 5, 0, '2024-11-30 15:00:42'),
(11, 4, 6, 2, '2024-11-30 15:36:50');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `mentorship_programs`
--

CREATE TABLE `mentorship_programs` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `total_chapters` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `mentorship_programs`
--

INSERT INTO `mentorship_programs` (`id`, `mentor_id`, `program_name`, `total_chapters`, `created_at`) VALUES
(4, 2, 'Web Development Mentorship', 10, '2024-11-30 11:38:54');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `saved`
--

CREATE TABLE `saved` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('membru','mentor','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexuri pentru tabele `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexuri pentru tabele `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexuri pentru tabele `event_reviews`
--
ALTER TABLE `event_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexuri pentru tabele `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexuri pentru tabele `mentorship_enrollments`
--
ALTER TABLE `mentorship_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_id` (`program_id`,`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexuri pentru tabele `mentorship_programs`
--
ALTER TABLE `mentorship_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexuri pentru tabele `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pentru tabele `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `event_reviews`
--
ALTER TABLE `event_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pentru tabele `mentorship_enrollments`
--
ALTER TABLE `mentorship_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pentru tabele `mentorship_programs`
--
ALTER TABLE `mentorship_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `saved`
--
ALTER TABLE `saved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constrângeri pentru tabele `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `members` (`id`) ON DELETE SET NULL;

--
-- Constrângeri pentru tabele `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `event_reviews`
--
ALTER TABLE `event_reviews`
  ADD CONSTRAINT `event_reviews_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_reviews_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constrângeri pentru tabele `mentorship_enrollments`
--
ALTER TABLE `mentorship_enrollments`
  ADD CONSTRAINT `mentorship_enrollments_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `mentorship_programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mentorship_enrollments_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `mentorship_programs`
--
ALTER TABLE `mentorship_programs`
  ADD CONSTRAINT `mentorship_programs_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `saved`
--
ALTER TABLE `saved`
  ADD CONSTRAINT `saved_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
