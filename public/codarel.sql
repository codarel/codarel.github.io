-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 08:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codarel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (IN `sku` VARCHAR(255), IN `name` VARCHAR(255), IN `description` TEXT, IN `product_image` VARCHAR(255), IN `regular_price` INT(11), IN `discount_price` INT(11), IN `weight` FLOAT, IN `category` VARCHAR(50))  begin
insert into products values ('', sku, name, description, product_image, regular_price, discount_price, weight, category, now(), null);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_stock` (IN `product_id` INT(11), IN `size` VARCHAR(20), IN `quantity` INT(11))  begin
insert into stock values ('', product_id, size, quantity, now(), null);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product` (IN `id_product` INT(11), IN `sku` VARCHAR(255), IN `name` VARCHAR(255), IN `description` TEXT, IN `product_image` VARCHAR(255), IN `regular_price` INT(11), IN `discount_price` INT(11), IN `weight` FLOAT, IN `category` VARCHAR(50))  begin
update products set sku=sku, name=name, description=description, product_image=product_image, regular_price=regular_price, discount_price=discount_price, weight=weight, category=category, updated_at=now() where id=id_product; 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_stock` (IN `stock_id` INT(11), IN `product_id` INT(11), IN `size` VARCHAR(20), IN `quantity` INT(11))  begin
update stock set product_id=product_id, size=size, quantity=quantity, updated_at=now() where id=stock_id;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `percentage_discount` (`id_product` INT) RETURNS INT(11) BEGIN
DECLARE percentage INT;
DECLARE regular INT;
DECLARE discount INT;
SELECT regular_price INTO regular FROM products WHERE id = id_product;
SELECT discount_price INTO discount FROM products WHERE id = id_product;
SET percentage = 100-(discount / regular * 100);
RETURN percentage;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `shipping` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_status`, `shipping`, `amount`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 12000, 100000, '2021-05-17 21:04:41', '2021-05-17 21:07:53');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `insert_order_logs` AFTER INSERT ON `orders` FOR EACH ROW begin 
insert into order_logs (id, order_id, order_status, created_at) values ('', new.id, new.order_status, now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_order_logs_update` AFTER UPDATE ON `orders` FOR EACH ROW begin 
insert into order_logs (id, order_id, order_status, created_at) values ('', new.id, new.order_status, now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `quantity`, `subtotal`) VALUES
(1, 3, 1, 'M', 1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `order_logs`
--

CREATE TABLE `order_logs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_logs`
--

INSERT INTO `order_logs` (`id`, `order_id`, `order_status`, `created_at`) VALUES
(1, 3, 1, '2021-05-17 21:04:51'),
(2, 3, 2, '2021-05-17 21:08:02'),
(3, 3, 3, '2021-05-17 21:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`) VALUES
(1, 'Belum Bayar'),
(2, 'Sedang Diproses'),
(3, 'Selesai'),
(4, 'Dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `payment_image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `email`, `order_id`, `sender_name`, `amount`, `payment_image`, `created_at`, `confirm`) VALUES
(1, 'codarel.id@gmail.com', 3, 'Codarel', 112000, 'payment.jpg', '2021-05-17 21:08:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `product_image` varchar(255) NOT NULL DEFAULT 'product.jpg',
  `regular_price` int(11) NOT NULL DEFAULT 0,
  `discount_price` int(11) NOT NULL DEFAULT 0,
  `weight` float NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `description`, `product_image`, `regular_price`, `discount_price`, `weight`, `category`, `created_at`, `updated_at`) VALUES
(1, 'TS001', 'Codarel Tshirt Black', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b064a40c8c1.jpg,60b064a40d43e.jpg', 170000, 100000, 0.25, 'Tshirt', '2021-05-17 16:02:35', '2021-05-28 10:33:56'),
(2, 'TS002', 'Codarel Tshirt Navy', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', 'product.jpg', 150000, 100000, 0.25, 'Tshirt', '2021-05-17 17:17:02', '2021-05-26 13:53:39'),
(3, 'TS090', 'Codarel Tshirt Pink', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60afad181aab6.jpg', 150000, 0, 0.25, 'Tshirt', '2021-05-17 20:28:57', '2021-05-27 23:06:54'),
(22, 'TS092', 'Codarel Tshirt Pink', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60afad7b42e90.jpg', 150000, 100000, 0.2, 'Tshirt', '2021-05-25 23:38:37', '2021-05-27 21:32:27'),
(25, 'TS091', 'Codarel Tshirt Green', 'Bahan 100% cotton, tipis dan ringan, handfeel lemb', '60afad9cc3c71.jpg', 150000, 100000, 0.1, 'Tshirt', '2021-05-26 20:08:51', '2021-05-27 21:33:00'),
(26, 'TS003', 'Sole Mates', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b02fadeeda6.jpg', 129000, 0, 0.2, 'Tshirt', '2021-05-28 06:47:57', NULL),
(27, 'TS004', 'Black pure', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b02fe3b84c9.jpg', 129000, 0, 0.2, 'Tshirt', '2021-05-28 06:48:51', NULL),
(28, 'TS005', 'strip snow', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b0345181815.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:07:45', NULL),
(29, 'TS006', 'road t-shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03974461b8.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:29:40', NULL),
(30, 'TS007', 'road red t-shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b039ca8b105.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:31:06', NULL),
(31, 'TS008', 'High', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03a0c0fb1c.jpg', 229000, 0, 0.2, 'Tshirt', '2021-05-28 07:32:12', NULL),
(32, 'TS010', 'out of cash', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03a5453e0f.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:33:24', NULL),
(33, 'S001', 'Red Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03aa04a04f.jpg', 279000, 0, 0.2, 'Shirt', '2021-05-28 07:34:40', '2021-05-28 07:35:08'),
(34, 'S002', 'Strip Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03aee4b6e5.jpg', 278999, 0, 0.2, 'Shirt', '2021-05-28 07:35:58', NULL),
(35, 'S003', 'Cube Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03b251f243.jpg', 299000, 0, 0.2, 'Shirt', '2021-05-28 07:36:53', NULL),
(36, 'S004', 'Carbon', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03b5db40b9.jpg', 229000, 0, 0.2, 'Shirt', '2021-05-28 07:37:49', NULL),
(37, 'S005', 'White Stan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03b9be7f7d.jpg', 229000, 0, 0.2, 'Shirt', '2021-05-28 07:38:51', NULL),
(38, 'S006', 'Dizzy Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03bd504941.jpg', 299000, 0, 0.2, 'Shirt', '2021-05-28 07:39:49', NULL),
(39, 'S007', 'Cube Standard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03c14c9703.jpg', 279000, 0, 0.2, 'Shirt', '2021-05-28 07:40:52', NULL),
(40, 'S008', 'Abstrak Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03c773164c.jpg', 279000, 0, 0.2, 'Shirt', '2021-05-28 07:42:31', NULL),
(41, 'JC001', 'jacket jeans blue standard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b03cf7acc6b.jpg', 329000, 0, 0.2, 'Jacket', '2021-05-28 07:44:39', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_detail`
-- (See below for the actual view)
--
CREATE TABLE `product_detail` (
`id` int(11)
,`sku` varchar(255)
,`name` varchar(255)
,`description` text
,`product_image` varchar(255)
,`regular_price` int(11)
,`discount_price` int(11)
,`weight` float
,`category` varchar(50)
,`stock_id` int(11)
,`size` varchar(20)
,`quantity` int(11)
,`created_at` datetime
,`updated_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 20, '2021-05-17 14:54:44', '2021-05-27 11:31:11'),
(3, 1, 'L', 20, '2021-05-17 14:56:05', NULL),
(19, 25, 'M', 20, NULL, NULL),
(20, 3, 'M', 20, '2021-05-26 23:34:24', NULL),
(21, 1, 'XL', 20, '2021-05-27 10:21:08', '2021-05-27 11:31:29'),
(24, 1, 'SM', 10, '2021-05-27 11:43:38', '2021-05-27 11:43:46'),
(25, 26, 'S', 10, '2021-05-28 09:43:33', NULL),
(26, 27, 'M', 10, '2021-05-28 09:43:52', NULL),
(27, 37, 'M', 10, '2021-05-28 09:44:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `username`, `fullname`, `date_of_birth`, `phone`, `user_image`, `password`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'mochamadnurulhuda16@gmail.com', 'huda16', 'Mochamad Nurul Huda', '0000-00-00', '', '60af73b5ae151.png', '$2y$10$nZfs/HrZsDalWehO0yB8u.iQkWq3TLEbW8C3jyJIII3vM5XAPuvGK', 1, '2021-05-15 12:37:10', '2021-05-27 17:27:51', NULL),
(2, 2, 'codarel.id@gmail.com', NULL, NULL, NULL, NULL, 'default.jpg', '$2y$10$iWBQJSltNPd6pXpfXzAgGOxSF6wxOyUFznpnyQOocefj2hDenb.uS', 1, '2021-05-15 15:10:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `districts` varchar(255) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Structure for view `product_detail`
--
DROP TABLE IF EXISTS `product_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_detail`  AS  select `products`.`id` AS `id`,`products`.`sku` AS `sku`,`products`.`name` AS `name`,`products`.`description` AS `description`,`products`.`product_image` AS `product_image`,`products`.`regular_price` AS `regular_price`,`products`.`discount_price` AS `discount_price`,`products`.`weight` AS `weight`,`products`.`category` AS `category`,`stock`.`id` AS `stock_id`,`stock`.`size` AS `size`,`stock`.`quantity` AS `quantity`,`stock`.`created_at` AS `created_at`,`stock`.`updated_at` AS `updated_at` from (`products` join `stock` on(`products`.`id` = `stock`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_status` (`order_status`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_status`) REFERENCES `order_statuses` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD CONSTRAINT `order_logs_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
