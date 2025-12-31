-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2026 at 12:14 AM
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
-- Database: `mini_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `size` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `size`, `created_at`) VALUES
(22, 1, 4, 1, NULL, '2025-12-31 22:08:11'),
(23, 1, 8, 1, NULL, '2025-12-31 22:08:29'),
(24, 1, 13, 1, NULL, '2025-12-31 22:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Recent Kits'),
(2, 'Retro Kits'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('en_attente','validee','annulee') DEFAULT 'en_attente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(1, 4, 320.00, '', '2025-12-30 23:59:02'),
(2, 4, 80.00, '', '2025-12-31 00:03:02'),
(3, 4, 80.00, '', '2025-12-31 00:05:52'),
(4, 4, 80.00, '', '2025-12-31 00:07:52'),
(5, 4, 80.00, 'validee', '2025-12-31 19:51:00'),
(6, 4, 80.00, 'validee', '2025-12-31 19:58:03'),
(7, 4, 80.00, 'validee', '2025-12-31 20:55:07'),
(8, 4, 80.00, 'validee', '2025-12-31 21:00:23'),
(9, 4, 80.00, 'validee', '2025-12-31 21:29:08'),
(10, 4, 80.00, 'validee', '2025-12-31 21:59:35'),
(11, 4, 80.00, 'validee', '2025-12-31 22:05:13'),
(12, 6, 45.00, 'validee', '2025-12-31 22:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` int(10) NOT NULL,
  `id_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `name`, `description`, `created_at`, `price`, `id_category`) VALUES
(1, 'home-kit-2025.webp', 'Home Kit 2025/2026', 'Home Kit 2025/2026 - Official home jersey for the 2025/2026 season. Modern design featuring the club\'s traditional colors. Breathable technology for optimal comfort.\r\n', '2025-12-05 04:18:29', 80, 1),
(2, 'third-kit-2025.avif', 'Third Kit 2025/2026', 'Third Kit 2025/2026 - Exclusive third kit for the 2025/2026 season. Bold and innovative style, perfect for away matches. Lightweight fabric with moisture-wicking properties.\r\n', '2025-12-05 04:18:29', 90, 1),
(3, 'away-kit-2025.avif', 'Away Kit 2025/2026', 'Away Kit 2025/2026 - Away jersey for the 2025/2026 season. Elegant and high-performance, designed for travel matches. Slim fit with quick-dry technology.\r\n', '2025-12-05 04:18:29', 80, 1),
(4, 'home-kit-2000.avif', 'Home Kit 2000/2001', 'Relive the early 2000s with the iconic 2000/2001 home kit.\r\nA classic and timeless design that brings back unforgettable Premier League nights.\r\nA must-have piece for any retro football shirt collector.', '2025-12-05 04:18:29', 45, 2),
(5, 'home-kit-1998.avif', 'Home Kit 1998/1999', 'A legendary late-90s home shirt.\r\nDeep blue colour, traditional fit, and the unmistakable details of a classic Chelsea era.\r\nPerfect for fans who love authentic retro style.', '2025-12-05 04:18:29', 45, 2),
(7, 'black-kit-1998.avif', 'Black Kit 1998/1999', 'One of the most unique third kits from the 90s.\r\nA sleek all-black design with subtle accents, making it a rare and highly sought-after piece.\r\nIdeal for collectors who want something truly different.', '2025-12-05 04:25:34', 45, 2),
(8, 'chelsea-annual.jpg', 'Chelsea Annual 2026', 'The Chelsea Annual 2026 features season highlights, key matches, player insights, exclusive photos, and club stories.\r\nA perfect pick for fans who want a complete and stylish overview of the year.', '2025-12-05 18:12:11', 16, 3),
(9, 'home-kit-2024.avif', 'Home Kit 2024/2025', 'Home Kit 2024/2025 - Home jersey for the 2024/2025 season. Current club collection with premium finishes. Ideal for supporters and collectors.\r\n', '2025-12-07 00:11:49', 50, 1),
(10, 'away-kit-2024.jpeg', 'Away Kit 2024/2025', 'Away Kit 2024/2025 - Away jersey for the 2024/2025 season. Contemporary design with contrasting colors. Technical fabric with anti-perspiration technology.\r\n', '2025-12-08 02:04:09', 40, 1),
(11, 'third-kit-2024.webp', 'Third Kit 2024/2025', 'Third Kit 2024/2025 - Third kit for the 2024/2025 season. Special edition with unique details. Comfort and style for all fans.\r\n', '2025-12-08 02:06:50', 35, 1),
(12, 'cole-palmer-frame.avif', 'Cole Palmer Signed Chelsea 25/26 Shirt Elite Frame\r\n', 'Put your love of Chelsea on display wherever you want. Drawing inspiration from the club\'s history and iconic aesthetic it\'s perfect for putting the team in the heart of your home, or as a gift for the Chelsea fan in your life.\r\n', '2025-12-08 03:40:42', 550, 3),
(13, 'chelsea-ucl-badge.avif', 'Chelsea UCL Pin Badge', 'Get the perfect souvenir to celebrate Chelsea\'s participation in the UEFA Champions League this year. Show your support wherever you are as they compete in the most prestigious contest in European football!\r\n', '2025-12-08 03:42:14', 7, 3),
(14, 'chelsea-uefa-frame.avif', 'Chelsea UEFA We\'ve Won It All\' Frame\r\n', 'Put your love of Chelsea on display wherever you want. Drawing inspiration from the club\'s history and iconic aesthetic it\'s perfect for putting the team in the heart of your home, or as a gift for the Chelsea fan in your life.\r\n', '2025-12-08 03:43:47', 100, 3),
(15, 'history-chelsea-shirt.avif', 'Blue Is The Colour - The Official History of the Chelsea Shirt', 'Blue Is The Colour - The Official History of the Chelsea Shirt\r\n\r\nExplore the iconic history of Chelsea\'s legendary blue shirt through stunning photography and fascinating stories. This beautifully crafted coffee-table book chronicles the evolution of the club\'s most memorable kits, from vintage classics to modern designs.\r\n', '2025-12-08 03:47:06', 60, 3),
(16, 'chelsea-pzlz-stadium.avif', 'Chelsea Puzzle Mini Stadium\r\n', 'Enjoy quality time with your loved ones while celebrating your Chelsea pride. This family-friendly product features official club branding and is perfect for game nights or gatherings, bringing a touch of Chelsea fun to your home.\r\n', '2025-12-08 03:49:14', 10, 3),
(17, 'third-kit-1998.avif', 'Third Kit 1998/1999', 'Remember your club\'s heroes. Still stylish all these years on, this product is a must-have for supporters.', '2025-12-08 03:54:43', 52, 2),
(18, 'kit-1987.avif', 'Kit 1987/1988', 'Celebrate Chelsea\'s storied past with this piece of retro memorabilia. Recalling iconic moments from the club\'s history, this item brings nostalgia to fans of all ages. It\'s a wonderful way to honour the rich history of the Blues and keep cherished memories of past glories alive.', '2025-12-08 03:56:50', 46, 2),
(19, 'kit-1998.avif', 'Blank Out Kit 1998/1999\r\n', 'This \'blank-out\' version is a must-have for Blues fans everywhere, whether you were there for the original season or you\'re looking for a token of the club\'s history to wear with pride wherever you go.\r\n', '2025-12-08 03:58:50', 58, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(4, 'hasham', 'hasham.hassan936@gmail.com', 'Hishmi02.'),
(5, 'hash', 'hashamulhassan@hotmail.com', 'hasham'),
(6, 'has', 'h@gmail.com', 'hasham');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_category` (`id_category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `foreign_key_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
