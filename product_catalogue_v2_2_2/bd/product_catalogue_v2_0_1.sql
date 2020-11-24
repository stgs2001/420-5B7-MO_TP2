-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2020 at 06:24 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_catalogue_v2_0_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `title`, `description`, `created`, `modified`) VALUES
(1, 'Phone case', 'Shock proof black phone case.', '2020-10-14 21:05:36', '2020-10-17 18:36:26'),
(2, 'Amplifier', '30W amplifier with 4 knobs.', '2020-10-14 22:06:33', '2020-10-17 15:38:05'),
(4, 'String', 'BG65 Pro badminton racket string.', '2020-10-15 15:30:28', '2020-11-20 15:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `accessories_products`
--

CREATE TABLE `accessories_products` (
  `id` int(11) NOT NULL,
  `accessory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessories_products`
--

INSERT INTO `accessories_products` (`id`, `accessory_id`, `product_id`) VALUES
(5, 1, 1),
(6, 2, 2),
(7, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created`, `modified`) VALUES
(0, 'Other', '2020-10-14 22:59:39', '2020-10-14 22:59:39'),
(1, 'Electronics', '2020-10-14 00:00:00', '2020-10-14 00:00:00'),
(3, 'Household items', '2020-10-14 22:54:23', '2020-10-14 22:54:23'),
(4, 'Gaming', '2020-10-14 22:56:48', '2020-10-14 22:56:48'),
(5, 'Clothing', '2020-10-14 22:58:30', '2020-10-14 22:58:30'),
(6, 'Sports', '2020-10-14 22:59:07', '2020-10-14 22:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `i18n`
--

CREATE TABLE `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `i18n`
--

INSERT INTO `i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'fr_CA', 'Products', 6, 'title', 'Clavier'),
(2, 'fr_CA', 'Products', 6, 'description', 'Clavier d\'ordinateur avec lumières.'),
(3, 'fr_CA', 'Accessories', 2, 'title', 'Amplificateur'),
(4, 'fr_CA', 'Accessories', 2, 'description', 'Amplificateur de 30 Watts avec 4 boutons.'),
(5, 'fr_CA', 'Issues', 1, 'title', 'Surchauffe facilement'),
(6, 'fr_CA', 'Issues', 1, 'description', 'Ce iPhone surchauffe trop facilement.'),
(7, 'fr_CA', 'Products', 11, 'title', 'Chaise'),
(8, 'es_MX', 'Products', 6, 'title', 'Teclado'),
(9, 'es_MX', 'Products', 6, 'description', 'Teclado de computadora con luces.'),
(10, 'fr_CA', 'Issues', 2, 'title', 'Son'),
(11, 'fr_CA', 'Issues', 2, 'description', 'Le son d\'une des corde est étrange.'),
(12, 'es_MX', 'Issues', 2, 'title', 'Sonido'),
(13, 'es_MX', 'Issues', 2, 'description', 'El sonido de una de las cuerdas es extraño.'),
(14, 'es_MX', 'Accessories', 2, 'title', 'Amplificador'),
(15, 'es_MX', 'Accessories', 2, 'description', 'Amplificador de 30 vatios con cuatro perillas.'),
(16, 'en_CA', 'Accessories', 4, 'title', 'Racket string'),
(17, 'en_CA', 'Products', 11, 'title', 'Chair'),
(18, 'en_CA', 'Products', 11, 'description', 'Foldable chair.'),
(19, 'fr_CA', 'Products', 11, 'description', 'Chaise pliable.');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `product_id`, `category_id`, `title`, `description`, `created`, `modified`) VALUES
(1, 1, 1, 'Overheats easily', 'This iPhone overheats too easily.', '2020-10-14 21:13:11', '2020-10-14 21:13:11'),
(2, 2, 1, 'Bad sound', 'The sound of one of the strings is odd.', '2020-10-17 15:35:19', '2020-10-19 23:56:39'),
(3, 11, 3, 'Flimsy', 'The legs feel very flimsy.', '2020-11-18 21:36:57', '2020-11-19 00:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Not yet assigned',
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `product_id`, `title`, `owner`, `date`, `description`, `filename`, `path`, `created`, `modified`) VALUES
(1, 1, 'Phone', NULL, NULL, 'Iphone 11 Pro', 'iphone.jpg', 'img/Photos/index/', '2020-10-17 20:43:30', '2020-10-17 23:06:16'),
(3, 2, 'Guitar', NULL, NULL, 'Stock photo of a guitar.', 'guitar.jpg', 'img/Photos/index/', '2020-10-17 20:50:47', '2020-10-17 22:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `title`, `description`, `created`, `modified`) VALUES
(1, 1, 1, 'iPhone', 'Apple iPhone 11th generation.', '2020-10-14 21:03:57', '2020-10-17 18:36:55'),
(2, 2, 1, 'Electric guitar', '6-string electric guitar.', '2020-10-14 22:01:07', '2020-10-17 02:06:22'),
(4, 3, 6, 'Badminton racket', '75g badminton aluminum racket.', '2020-10-15 00:38:24', '2020-10-17 02:07:06'),
(6, 1, 4, 'Keyboard', 'Computer keyboard with lights.', '2020-10-15 17:54:16', '2020-10-17 15:27:01'),
(8, 4, 5, 'Shirt', 'XL t-shirt.', '2020-10-15 18:00:13', '2020-10-17 00:15:08'),
(11, 1, 3, 'Chair', 'long chair', '2020-10-17 00:23:17', '2020-10-17 19:29:56'),
(33, 1, 0, 'Cardboard', 'Double layered brown cardboard.', '2020-11-20 03:36:08', '2020-11-20 03:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'admin', 'The admin can do anything.', '2020-10-16 00:00:00', '2020-10-16 00:00:00'),
(2, 'moderator', 'The moderator can do almost anything.', '2020-10-16 00:00:00', '2020-10-16 00:00:00'),
(3, 'member', 'The member is limited but can still add products and edit/delete them afterwards.', '2020-10-16 00:00:00', '2020-10-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `uuid`, `confirmed`, `created`, `modified`) VALUES
(1, 1, 'admin', 'admin@admin.com', '$2y$10$UiEu/hknudQj9ZMkCDpeeODhaJ.zRAWiklJODnH4O8BDzn75Js5TG', '44a5543b-467a-4252-81f5-1aad62e8ac42', 1, '2020-10-14 00:00:00', '2020-10-19 01:41:00'),
(2, 2, 'moderator', 'moderator@mod.com', '$2y$10$V0Z4dH5j4061CJgYgEv2l.Hm3aqY234hlCbUaE5Fq0edYSlJ9wJSC', '0e0b4dcd-410b-45de-ba2f-4f985e1bdf56', 1, '2020-10-14 19:35:52', '2020-10-19 22:33:52'),
(3, 3, 'Stgl2000', 'Stgl2000@live.com', '$2y$10$W3Dc6OXRjUYFNzgk4U6m0ugtc1qHT/YNd/BMdtvPXMoMG7lGC4fkO', '526dafbb-5074-417f-baa9-4a06dae58bfd', 0, '2020-10-15 00:23:55', '2020-10-19 23:28:42'),
(4, 3, 'Louis75', 'Louis75@live.com', '$2y$10$.fETVB9oujPgChq8Ek4b7u/jcEhb9mqhLD.0Wad3ktLjifaibD.w.', '7a96a53f-34fd-4a18-a267-8a51c6c1ecd4', 0, '2020-10-15 13:49:59', '2020-10-19 02:07:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories_products`
--
ALTER TABLE `accessories_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessory_id` (`accessory_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`(100),`foreign_key`,`field`(100)),
  ADD KEY `I18N_FIELD` (`model`(100),`foreign_key`,`field`(100));

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `accessories_products`
--
ALTER TABLE `accessories_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories_products`
--
ALTER TABLE `accessories_products`
  ADD CONSTRAINT `accessories_products_ibfk_1` FOREIGN KEY (`accessory_id`) REFERENCES `accessories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `accessories_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `issues_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
