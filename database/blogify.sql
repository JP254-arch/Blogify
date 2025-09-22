-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 06:53 PM
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
-- Database: `blogify`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(4, 1, 'The Art of storytelling', 'Stories connect us, inspire us, and bring meaning to our lives. Learn the timeless techniques and modern twists that make storytelling a powerful tool in every field.', 'https://media.istockphoto.com/id/494641258/photo/in-wonderland.jpg?s=1024x1024&w=is&k=20&c=2ToMV1gTdqKcjK2BKLw9fKC-sd0FyDQjGFy6Awq8bDE=', '2025-09-19 13:20:27', '2025-09-22 14:54:08'),
(5, 1, 'Tech Trends in 2025', 'The future is unfolding faster than ever. Dive into the innovations shaping how we live and work — from AI and automation to sustainable technology leading us into a smarter tomorrow.', 'https://plus.unsplash.com/premium_photo-1661878265739-da90bc1af051?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGF0YXxlbnwwfHwwfHx8MA%3D%3D', '2025-09-19 13:21:15', '2025-09-22 14:53:50'),
(6, 1, 'Adventures Around the World', 'Join us as we journey across continents, uncovering hidden gems, breathtaking landscapes, and cultural wonders that inspire the traveler in all of us.', 'https://media.istockphoto.com/id/2160837154/photo/green-logistic-or-sustainable-transport-sustainable-global-transport-logistics-or-travel-by.jpg?s=612x612&w=0&k=20&c=PYKmlGxICNiXH0UM6zPldC_YRYsisQDgWj3FRSpISTg=', '2025-09-19 13:22:03', '2025-09-22 14:53:34'),
(8, 5, 'Architecture & Interiors', 'Discover how thoughtful design transforms the heart of every home. From modern minimalism to cozy rustic vibes, explore creative ideas that balance function with beauty in your kitchen space.', 'https://plus.unsplash.com/premium_photo-1683917067889-c88599491d5c?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDEzfE04alZiTGJUUndzfHxlbnwwfHx8fHw%3D', '2025-09-22 14:08:33', '2025-09-22 15:19:21'),
(9, 5, 'Healthy Living Made Simple', 'Small changes lead to big results. Explore practical tips on nutrition, fitness, and mindfulness that make living a healthy lifestyle easy and enjoyable.', 'https://images.unsplash.com/photo-1687184412163-09d005f5caa2?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8SGVhbHRoeSUyMExpdmluZyUyME1hZGUlMjBTaW1wbGV8ZW58MHx8MHx8fDA%3D', '2025-09-22 14:55:47', '2025-09-22 14:55:47'),
(10, 5, 'The Future of Education', 'From virtual classrooms to AI-driven learning, education is evolving rapidly. Discover how technology and creativity are reshaping the way we gain knowledge and skills.', 'https://plus.unsplash.com/premium_photo-1663091704223-cc051e0f0c47?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8VGhlJTIwRnV0dXJlJTIwb2YlMjBFZHVjYXRpb258ZW58MHx8MHx8fDA%3D', '2025-09-22 14:58:25', '2025-09-22 14:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','editor','author','reader') NOT NULL DEFAULT 'reader'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'JP', 'jp@gmail.com', '$2y$10$tAmAHFLv1LUggiktuQ.wgOukac3Kh/rdcWEe5K3lM9IwEWS8R7NGO', '2025-09-19 12:37:54', 'admin'),
(4, 'eli', 'eli@gmail.com', '$2y$10$ZsZEkuOp8eNJ1CQA9O.bjuFy5WRntO1vZRSNGfRZmsMn3Hun3PyIG', '2025-09-22 13:53:18', 'reader'),
(5, 'jj', 'jj@gmail.com', '$2y$10$rUqzh2SW8EQNP.PhU3kZdOiBJiW5sm4CCS6XEAniVh75u/I6vR3pS', '2025-09-22 13:54:12', 'author'),
(6, 'zena', 'zena@gmail.com', '$2y$10$xxbHG3BzkfntvGbLUKwjOeLPamlyCPr7isZG9KkxC2V027N0uEIMq', '2025-09-22 14:47:49', 'reader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
