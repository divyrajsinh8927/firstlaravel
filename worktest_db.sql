-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 07:50 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worktest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 104, 1, 500, '2023-04-13 08:31:41', NULL),
(2, 104, 22, 700, '2023-04-13 10:30:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `isDelete`) VALUES
(1, 'Men\'s', '2023-04-11 06:39:33', NULL, 0),
(2, 'Women\'s', '2023-04-11 08:15:03', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_01_103222_create_categories_table', 2),
(6, '2023_03_02_100835_create_products_table', 3),
(7, '2023_03_02_101521_create_products_table', 4),
(8, '2023_03_04_095647_create_product_images_table', 5),
(9, '2023_04_11_101418_add_paid_to_users_table', 6),
(10, '2023_04_11_104721_rename_categories_table_to_sub_categories', 7),
(11, '2023_04_11_120414_create_categories_table', 8),
(12, '2023_04_11_120704_add_categories_id_to_sub_categories_table', 9),
(13, '2023_04_11_124758_add_is_delete_to_categories_table', 10),
(14, '2023_04_11_191852_add_user_type_id_to_categories_table', 11),
(15, '2023_04_11_192119_create_user_types_table', 12),
(16, '2023_04_12_123425_add_description_to_product', 13),
(17, '2023_04_12_131614_create_bookoings_table', 14),
(18, '2023_04_12_133352_create_bookoings_table', 15),
(19, '2023_04_12_133528_add_mobile_number_to_users', 16),
(20, '2023_04_13_134832_create_carts_table', 17),
(21, '2023_04_14_124259_create_orders_table', 18),
(22, '2023_04_14_165133_add_fcm_token_column_to_users_table', 19),
(23, '2023_04_14_183826_add_column_device_key', 20),
(24, '2023_04_14_185256_add_fcm_token_column_to_users_table', 21),
(25, '2023_04_15_114309_add_device_key_column_to_users_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `address`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 104, 1, 'ergeg', 1, 500, 0, '2023-04-14 07:31:39', '2023-04-17 05:11:15'),
(13, 104, 8, 'qwwed', 1, 800, 1, '2023-04-14 10:56:06', '2023-04-17 05:19:10'),
(14, 104, 8, 'qwwed', 1, 800, 1, '2023-04-14 10:57:58', '2023-04-17 05:20:17'),
(26, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:25:24', NULL),
(27, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:25:54', NULL),
(28, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:31:08', NULL),
(29, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:32:10', NULL),
(30, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:33:22', NULL),
(31, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:33:27', NULL),
(32, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:40:37', NULL),
(33, 104, 8, 'geg', 4, 800, NULL, '2023-04-17 07:41:27', NULL),
(34, 104, 1, 'jamanagar', 1, 500, NULL, '2023-04-17 07:49:06', NULL),
(35, 104, 8, 'Rajkot', 2, 800, NULL, '2023-04-17 07:49:51', NULL),
(36, 104, 1, 'Rajkot', 1, 500, NULL, '2023-04-17 07:49:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `isDelete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `product_image`, `isDelete`, `created_at`, `updated_at`, `product_price`, `product_description`) VALUES
(1, 'maliyalam T-shirt', 3, 'media/malayalitshirt.jpg', 0, NULL, '2023-03-07 05:52:32', 500, 'MALAYALI TSHIRT UNISEX COMFORT FIT – GOLDEN 3D PRINT:\nWe’ve seen people going crazy over trendy t-shirts. And, the round neck ones top their list. The Trendy design, Comfy fabric and Unmatchable love for urbane clothing are just some reasons you must check this one out.\nT-shirt Color: Black\nMaterial: 100% Combed cotton with Single jersey to make it wrinkle-free and smooth. Doesn’t let you feel hot!\nREGULAR FIT: Fits just right. Not too tight, not too loose!\n190 GSM bio-washed material for a soft and silky fabric finish, along with superior color brightness.'),
(8, 'Childran where', 4, 'media/1759260900657869.jpeg', 0, '2023-03-02 07:28:56', '2023-04-10 12:05:27', 800, 'Suffering Summer? Make your kids always cool by wearing fresh summer collections from Ventra.  Very soft on Skin, 100% Super Soft Cotton Premium Quality Fabric: Made by high quality natural skin friendly cotton fabrics Pure Cotton: Quality Pure Cotton special processed So Pure Cotton fabric gets a soft and comfy feeling.'),
(22, 'girl black Pink frock', 7, 'media/1759714287769409.jpeg', 0, '2023-03-07 07:35:20', '2023-03-13 09:42:13', 700, 'FEATURES: Body Material: 100% Polyester Lining Material :80%Cotton 20%Viscose Fit Type: Slim Cancan underskirt shown in the images is used for styling purpose only and does not come with this dress. The actual product may differ slightly in color from the one illustrated in the images. WHAT\'S INCLUDED: 1 Party Dress CARE: Gentle Wash Suitable for Girl\'s Colour Pink'),
(23, 'men Red Shirts', 4, 'media/1759714311933641.jpeg', 0, '2023-03-07 07:35:43', NULL, 300, 'Spread Collar Slim Fit Full Sleeve Patch Pocket Curved Hem Design Spare Buttons Include Logo On The Chest 2-way Lycra With this stylish solid colour shirt from the renowned Labels OF Mind, you may add some international style to your closet. Excellently made of superior cotton for a better blend of softness, comfort, and durability, its slim fit pattern gives it a snug, fashionable silhouette. '),
(24, 'men\'s Blazer', 2, 'media/1759714348989586.jpeg', 0, '2023-03-07 07:36:18', NULL, 1500, 'Care Instructions: Dry Clean Only Fit Type: Regular Fabric: This blazer for men is made from lightweight Poly Viscose Fabric and is perfect for layering and delivering a perfect formal look. The quality and design of this suit makes it Premium and Classy mens wear. Quality: These blazers are made keeping in mind all the quality things like Premium fabric, Soft inner fabric, Light weight, Perfect regular fit type, Absorbent, Sweat proof, Occasion: This formal blazer is suitable for Office, Formal, Business Work, Date, Party Wear, Weddings, Engagement, and Gift for Families, Friends & Boyfriend etc. Comfortable to wear and you will get tons of compliments throughout the day. Size Chart: Each style of garment has a different size guide. Please go through our size chart, measure accordingly, and buy the size that fits you the best. Including: Mens Blazer/Sui'),
(25, 'men\'s Black Hoodie', 8, 'media/1759714399835203.jpeg', 0, '2023-03-07 07:37:07', NULL, 1000, 'AN ADIDAS HOODIE WITH A DRAWCORD-ADJUSTABLE HOOD. Welcome stormy weather. Slip on this hoodie for fleecy warmth that keeps you comfortable when the sun slides behind the clouds. Tuck your hands into the kangaroo pocket for a quick warmup.  By buying cotton products from us, you\'re supporting more sustainable cotton farming. This product is made with recycled content as part of our ambition to end plastic waste'),
(26, 'new', 7, 'media/1762854736494710.jpg', 1, '2023-04-11 05:01:25', '2023-04-11 05:08:38', 200, ''),
(27, 'renkgjhekrfd', 2, 'media/1763410452088647.jpeg', 1, '2023-04-17 08:14:17', '2023-04-17 08:30:57', 1000, 'ehrkjrheigfhegrejhfe'),
(28, 'dasds', 3, 'media/1763411290998794.jpeg', 1, '2023-04-17 08:27:37', '2023-04-17 08:30:06', 1222, 'rsgvv'),
(29, 'asda', 2, 'media/1763416296441972.jpeg', 0, '2023-04-17 09:44:51', '2023-04-17 09:47:53', 111, 'wsfd');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `isDelete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_name`, `isDelete`, `created_at`, `updated_at`, `category_id`) VALUES
(2, 'Blazer', 0, '2023-03-01 10:48:51', '2023-03-01 10:48:51', 1),
(3, 'T-Shirt', 0, '2023-03-01 06:59:19', '2023-03-02 04:29:54', 1),
(4, 'Shirt', 0, '2023-03-03 04:47:46', '2023-03-09 04:54:12', 1),
(5, 'Children Where', 1, '2023-03-03 04:50:47', '2023-03-03 07:41:18', 1),
(7, 'Froke', 0, '2023-03-07 07:34:13', '2023-03-09 04:52:45', 2),
(8, 'Hoodie', 0, '2023-03-07 07:34:30', '2023-04-11 05:49:19', 1),
(75, 'ddd', 1, '2023-04-17 09:24:42', '2023-04-17 09:41:50', 1),
(76, 'wwww', 1, '2023-04-17 09:33:39', '2023-04-17 09:41:46', 1),
(77, 'llllll', 0, '2023-04-17 09:42:49', '2023-04-17 09:42:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `device_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `is_delete` varchar(1) NOT NULL DEFAULT '0',
  `user_type_id` int(11) NOT NULL DEFAULT 2,
  `mobile_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `device_token`, `created_at`, `updated_at`, `status`, `is_delete`, `user_type_id`, `mobile_number`) VALUES
(2, 'me', 'me@gmail.com', '2023-02-28 08:25:18', '$2y$10$xW9LZq.GaKZ0y.CDfpSfNuugJoGZDB24ovnv3U6FlcYk5GcrPFLXK', NULL, NULL, '2023-02-28 08:24:59', '2023-04-10 12:05:44', '1', '0', 1, '9724363368'),
(19, 'Prof. Paul Ledner', 'shemar87@example.com', '2023-03-09 04:58:36', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DqMnJBu0Mt', NULL, '2023-03-09 04:58:36', '2023-03-09 04:58:36', '1', '0', 2, '0'),
(20, 'Ezekiel Frami DVM', 'kade07@example.org', '2023-03-09 04:58:36', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QPVVvcnqKX', NULL, '2023-03-09 04:58:36', '2023-03-09 04:58:36', '1', '0', 2, '0'),
(104, 'Divyrajsinh', 'duvrajsinh@gmail.com', '2023-04-12 05:38:39', '$2y$10$KiwbkA5yLPvM.W5s.J///.LNPxcdlN7MaHQ6f5hq41Od/c1z13RG.', NULL, 'csLn1CVIhjxpeFOus6vBRZ:APA91bEMqC2kg2TtwiQiZqLtL78pPgxnvql-3TwQF-JydEapCWQ6P-7BGefB4cAFLZh3zBpYHJJOoWScbOoaB3kEGH-ZPU5yqrBSqqUamXEGaZosWRjuxCZwtlvh24aJiM3LGWBvILKQ', '2023-04-12 05:36:15', '2023-04-15 07:10:36', '1', '0', 2, '9687866294'),
(105, 'abc', 'abc@gmail.com', '2023-04-12 08:19:33', '$2y$10$qbRXzNCFInvNk8zYgDYtpeWnodT9c9IyD0Hk3Z7SZufeZHvdKTC2G', NULL, NULL, '2023-04-12 08:19:03', '2023-04-12 08:19:33', '1', '0', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(20) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'User', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkcategoryidinproduct` (`category_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catforeignkey` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fkUserType` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fkcategoryidinproduct` FOREIGN KEY (`category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `catforeignkey` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fkUserType` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
