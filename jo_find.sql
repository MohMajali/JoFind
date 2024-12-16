-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 06:42 PM
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
-- Database: `jo_find`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `place_id`, `title`, `description`, `image`, `price`, `active`, `created_at`) VALUES
(1, 2, 'adver 1', 'lorem lorem lorem', 'Advertisements_Images/advertisement.jpg', 50, 1, '2024-10-28 16:07:56'),
(2, 2, 'venue adv 34333', 'df jdbfij', 'Advertisements_Images/car.jpg', 80, 1, '2024-11-26 17:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `booking_options`
--

CREATE TABLE `booking_options` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `date_time` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `has_soft_drinks` tinyint(1) NOT NULL,
  `has_food` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking_options`
--

INSERT INTO `booking_options` (`id`, `place_id`, `title`, `description`, `date_time`, `quantity`, `has_soft_drinks`, `has_food`, `price`, `active`, `created_at`) VALUES
(1, 2, 'Option 1', 'lorem lorem lorem lorem lorem', '2024-10-27 00:00:00', 5, 1, 1, 50, 1, '2024-10-26 16:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `active`, `created_at`) VALUES
(1, 'Categories_Images/cafes.jpg', 'Cafes', 0, '2024-10-21 21:51:53'),
(2, 'Categories_Images/coffee_house.jpg', 'Coffee Houses', 1, '2024-10-22 21:01:17'),
(3, 'Categories_Images/resturants.jpg', 'Restaurants', 1, '2024-10-22 21:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer_logs`
--

CREATE TABLE `customer_logs` (
  `id` int(11) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `advertisement_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_place_ratings`
--

CREATE TABLE `customer_place_ratings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer_place_ratings`
--

INSERT INTO `customer_place_ratings` (`id`, `customer_id`, `place_id`, `rate`, `created_at`) VALUES
(6, 2, 2, 3, '2024-10-28 19:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `place_id`, `customer_id`, `message`, `created_at`) VALUES
(1, 2, 2, 'Feedback is good', '2024-10-28 19:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `offer` varchar(250) NOT NULL,
  `discount` double NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `place_id`, `offer`, `discount`, `start_date`, `end_date`, `active`, `created_at`) VALUES
(1, 2, 'Offer 1', 0.5, '2024-10-23 00:00:00', '2024-10-23 00:00:00', 1, '2024-10-23 21:00:54'),
(2, 2, 'offer 2', 1.5, '2024-10-28 23:47:58', '2024-10-28 23:47:58', 1, '2024-10-28 20:48:17'),
(3, 2, 'Offer 3', 8.5, '2024-10-28 21:50:29', '2024-10-28 21:50:29', 1, '2024-10-28 20:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `offer_winners`
--

CREATE TABLE `offer_winners` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `offer_winners`
--

INSERT INTO `offer_winners` (`id`, `offer_id`, `customer_id`, `is_used`, `created_at`) VALUES
(2, 2, 1, 0, '2024-10-29 21:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `total_rate` double NOT NULL DEFAULT 0,
  `phone` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `category_id`, `sub_category_id`, `status_id`, `name`, `image`, `email`, `description`, `total_rate`, `phone`, `password`, `active`, `created_at`) VALUES
(2, 3, 2, 2, 'test 4343', 'Places_Images/resturants.jpg', 'test@test.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, '0123456789', '1234567890', 1, '2024-10-23 19:22:33'),
(5, 3, NULL, 3, 'Place 1', 'Places_Images/resturants.jpg', 'place@emaily.com', NULL, 0, '1234567890', 'Ab@123456', 1, '2024-11-24 17:28:08'),
(9, 3, NULL, 1, 'nuvndub', 'Places_Images/venue3.jpg', 'efe', 'fef', 1, '6547', '1234567890', 1, '2024-11-27 17:18:32'),
(10, 3, NULL, 1, 'place 555', 'Places_Images/venue3.jpg', 'place555@yahoo.com', NULL, 0, '9876543210', '1234567890', 1, '2024-11-27 18:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `place_locations`
--

CREATE TABLE `place_locations` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `place_locations`
--

INSERT INTO `place_locations` (`id`, `place_id`, `longitude`, `latitude`, `active`, `created_at`) VALUES
(2, 2, 35.84654724840546, 31.977270313905475, 1, '2024-10-23 19:22:33'),
(3, 2, 31.997004633950606, 35.88301877389005, 1, '2024-10-26 17:13:37'),
(5, 5, 31.982645499421, 32.009061957708, 1, '2024-11-24 17:28:08'),
(6, 10, 31.982645499421, 35.836069437279, 1, '2024-11-27 18:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `place_subscriptions`
--

CREATE TABLE `place_subscriptions` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `subscription_type` varchar(250) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `price` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `place_subscriptions`
--

INSERT INTO `place_subscriptions` (`id`, `place_id`, `subscription_type`, `start_date`, `end_date`, `price`, `active`, `created_at`) VALUES
(2, 2, '6 Months Contract (300 JOD)', '2024-10-23 00:00:00', '0000-00-00 00:00:00', 300, 1, '2024-10-23 19:22:33'),
(4, 5, '6 Months Contract (300 JOD)', '2024-11-24 00:00:00', '2025-05-23 00:00:00', 300, 1, '2024-11-24 17:28:08'),
(6, 10, '3 Months Open Contract (First Time Only) (For Free)', '2024-11-27 00:00:00', '2025-02-25 00:00:00', 0, 1, '2024-11-27 18:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `offer_id` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `price` tinyint(1) NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `place_id`, `customer_id`, `status_id`, `offer_id`, `date_time`, `price`, `total_price`, `created_at`) VALUES
(1, 2, 2, 2, NULL, '2024-10-27 00:00:00', 50, 50, '2024-10-28 19:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `active`, `created_at`) VALUES
(1, 'Sliders_images/resturants.jpg', 1, '2024-10-27 21:46:11'),
(2, 'Sliders_images/coffee_house.jpg', 1, '2024-11-03 20:32:02'),
(3, 'Sliders_images/car.jpg', 0, '2024-11-26 20:02:23'),
(4, 'Sliders_images/office.jpg', 1, '2024-11-26 20:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Accepted'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `image`, `name`, `active`, `created_at`) VALUES
(2, 3, 'Categories_Images/resturants.jpg', 'Sub Category 1', 1, '2024-10-23 22:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `tops`
--

CREATE TABLE `tops` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tops`
--

INSERT INTO `tops` (`id`, `place_id`, `price`, `active`, `created_at`) VALUES
(1, 2, 40, 1, '2024-10-28 16:59:37'),
(2, 2, 90, 1, '2024-11-26 17:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type_id`, `name`, `email`, `password`, `phone`, `active`, `created_at`) VALUES
(1, 1, 'Admin', 'admin@jofind.com', '1234567890', '0123456789', 1, '2024-10-21 21:43:44'),
(2, 2, 'Customer222', 'mmajali45@gmail.com', '1234567890', '0123456789', 1, '2024-10-26 21:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `users_types`
--

CREATE TABLE `users_types` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_types`
--

INSERT INTO `users_types` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_adv` (`place_id`);

--
-- Indexes for table `booking_options`
--
ALTER TABLE `booking_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_bookings` (`place_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_logs`
--
ALTER TABLE `customer_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_logs` (`place_id`),
  ADD KEY `category_id_logs` (`category_id`),
  ADD KEY `sub_category_id_logs` (`sub_category_id`),
  ADD KEY `customer_id_logs` (`customer_id`),
  ADD KEY `adv_id_logs` (`advertisement_id`);

--
-- Indexes for table `customer_place_ratings`
--
ALTER TABLE `customer_place_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_rate_FK` (`customer_id`),
  ADD KEY `place_rate_FK` (`place_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_feedback` (`place_id`),
  ADD KEY `customer_id_feedback` (`customer_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_offers` (`place_id`);

--
-- Indexes for table `offer_winners`
--
ALTER TABLE `offer_winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id_winner` (`offer_id`),
  ADD KEY `customer_id_winner` (`customer_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_place_FK` (`category_id`),
  ADD KEY `sub_category_place_FK` (`sub_category_id`),
  ADD KEY `status_id_fk` (`status_id`);

--
-- Indexes for table `place_locations`
--
ALTER TABLE `place_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_locations` (`place_id`);

--
-- Indexes for table `place_subscriptions`
--
ALTER TABLE `place_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_subs` (`place_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_reservation` (`place_id`),
  ADD KEY `user_id_reservation` (`customer_id`),
  ADD KEY `status_id_reservation` (`status_id`),
  ADD KEY `offer_id_reservation` (`offer_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_id_FK` (`category_id`);

--
-- Indexes for table `tops`
--
ALTER TABLE `tops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_tops` (`place_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id_FK` (`type_id`);

--
-- Indexes for table `users_types`
--
ALTER TABLE `users_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_options`
--
ALTER TABLE `booking_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_logs`
--
ALTER TABLE `customer_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_place_ratings`
--
ALTER TABLE `customer_place_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offer_winners`
--
ALTER TABLE `offer_winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `place_locations`
--
ALTER TABLE `place_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `place_subscriptions`
--
ALTER TABLE `place_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tops`
--
ALTER TABLE `tops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_types`
--
ALTER TABLE `users_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `place_id_adv` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `booking_options`
--
ALTER TABLE `booking_options`
  ADD CONSTRAINT `place_id_bookings` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `customer_logs`
--
ALTER TABLE `customer_logs`
  ADD CONSTRAINT `adv_id_logs` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`),
  ADD CONSTRAINT `category_id_logs` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `customer_id_logs` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `place_id_logs` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`),
  ADD CONSTRAINT `sub_category_id_logs` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `customer_place_ratings`
--
ALTER TABLE `customer_place_ratings`
  ADD CONSTRAINT `customer_rate_FK` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `place_rate_FK` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `customer_id_feedback` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `place_id_feedback` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `place_id_offers` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `offer_winners`
--
ALTER TABLE `offer_winners`
  ADD CONSTRAINT `customer_id_winner` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `offer_id_winner` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`);

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `category_place_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `status_id_fk` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `sub_category_place_FK` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `place_locations`
--
ALTER TABLE `place_locations`
  ADD CONSTRAINT `place_id_locations` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `place_subscriptions`
--
ALTER TABLE `place_subscriptions`
  ADD CONSTRAINT `place_id_subs` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `offer_id_reservation` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `place_id_reservation` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`),
  ADD CONSTRAINT `status_id_reservation` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `user_id_reservation` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_category_id_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `tops`
--
ALTER TABLE `tops`
  ADD CONSTRAINT `place_id_tops` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `type_id_FK` FOREIGN KEY (`type_id`) REFERENCES `users_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
