-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 12:12 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_order` (IN `order_id` VARCHAR(255), IN `user_id` INT(11), IN `shipping` INT(11), IN `amount` INT(11), IN `address_id` INT(11))  begin
INSERT INTO orders (id, user_id, order_status, shipping, amount, address_id, created_at) VALUES (order_id, user_id, 1, shipping, amount, address_id, now());
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_payment` (IN `email` VARCHAR(255), IN `order_id` VARCHAR(255), IN `sender_name` VARCHAR(255), IN `amount` INT(11), IN `payment_image` VARCHAR(255))  begin
INSERT INTO payment (email, order_id, sender_name, amount, payment_image, created_at, confirm) VALUES (email, order_id, sender_name, amount, payment_image, now(), 0);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (IN `sku` VARCHAR(255), IN `name` VARCHAR(255), IN `description` TEXT, IN `product_image` VARCHAR(255), IN `regular_price` INT(11), IN `discount_price` INT(11), IN `weight` FLOAT, IN `category` VARCHAR(50))  begin
insert into products (sku, name, description, product_image, regular_price, discount_price, weight, category, created_at) values (sku, name, description, product_image, regular_price, discount_price, weight, category, now());
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_stock` (IN `product_id` INT(11), IN `size` VARCHAR(20), IN `quantity` INT(11))  begin
insert into stock (product_id, size, quantity, created_at) values (product_id, size, quantity, now());
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'L', 1, '2021-05-30 11:17:40', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cart_detail`
-- (See below for the actual view)
--
CREATE TABLE `cart_detail` (
`id` int(11)
,`user_id` int(11)
,`product_id` int(11)
,`size` varchar(20)
,`quantity` int(11)
,`created_at` datetime
,`updated_at` datetime
,`sku` varchar(255)
,`name` varchar(255)
,`description` text
,`product_image` varchar(255)
,`regular_price` int(11)
,`discount_price` int(11)
,`weight` float
,`category` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `shipping` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `address_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_status`, `shipping`, `amount`, `address_id`, `created_at`, `updated_at`) VALUES
('60b348fd485f2', 1, 1, 12000, 462000, NULL, '2021-05-30 15:12:45', NULL),
('60b3492db532b', 1, 1, 12000, 112000, NULL, '2021-05-30 15:13:33', NULL),
('60b6031a13249', 1, 1, 12000, 241000, 1, '2021-06-01 16:51:22', NULL);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `insert_order_logs` AFTER INSERT ON `orders` FOR EACH ROW begin 
insert into order_logs (order_id, order_status, created_at) values ( new.id, new.order_status, now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_order_logs_update` AFTER UPDATE ON `orders` FOR EACH ROW begin 
insert into order_logs (order_id, order_status, created_at) values ( new.id, new.order_status, now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_detail`
-- (See below for the actual view)
--
CREATE TABLE `order_detail` (
`id` varchar(255)
,`user_id` int(11)
,`shipping` int(11)
,`amount` int(11)
,`address_id` int(11)
,`item_id` int(11)
,`product_id` int(11)
,`size` varchar(20)
,`quantity` int(11)
,`subtotal` int(11)
,`logs_id` int(11)
,`order_status` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `quantity`, `subtotal`) VALUES
(1, '60b348fd485f2', 1, 'M', 1, 100000),
(2, '60b348fd485f2', 3, 'M', 1, 150000),
(3, '60b348fd485f2', 25, 'M', 2, 200000),
(4, '60b3492db532b', 1, 'M', 1, 100000),
(5, '60b6031a13249', 1, 'M', 1, 100000),
(6, '60b6031a13249', 27, 'M', 1, 129000);

-- --------------------------------------------------------

--
-- Table structure for table `order_logs`
--

CREATE TABLE `order_logs` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_logs`
--

INSERT INTO `order_logs` (`id`, `order_id`, `order_status`, `created_at`) VALUES
(1, '60b348fd485f2', 1, '2021-05-30 15:12:45'),
(2, '60b3492db532b', 1, '2021-05-30 15:13:33'),
(3, '60b6031a13249', 1, '2021-06-01 16:51:22');

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
  `order_id` varchar(255) NOT NULL,
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
(1, 'mochamadnurulhuda16@gmail.com', '60b3492db532b', 'Mochamad Nurul Huda', 100000, '60b4bb36366bd.jpg', '2021-05-31 17:32:22', 0);

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
(25, 'TS091', 'Codarel Tshirt Green', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60afad9cc3c71.jpg', 150000, 100000, 0.1, 'Tshirt', '2021-05-26 20:08:51', '2021-05-31 12:42:41'),
(26, 'TS003', 'Sole Mates', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b02fadeeda6.jpg', 129000, 0, 0.2, 'Tshirt', '2021-05-28 06:47:57', '2021-05-31 12:42:28'),
(27, 'TS004', 'Black pure', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b02fe3b84c9.jpg', 129000, 0, 0.2, 'Tshirt', '2021-05-28 06:48:51', '2021-05-31 12:42:53'),
(28, 'TS005', 'strip snow', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b0345181815.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:07:45', '2021-05-31 12:43:06'),
(29, 'TS006', 'road t-shirt', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b03974461b8.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:29:40', '2021-05-31 12:43:20'),
(30, 'TS007', 'road red t-shirt', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b039ca8b105.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:31:06', '2021-05-31 12:44:18'),
(31, 'TS008', 'High', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b03a0c0fb1c.jpg', 229000, 0, 0.2, 'Tshirt', '2021-05-28 07:32:12', '2021-05-31 12:44:40'),
(32, 'TS010', 'out of cash', 'Bahan 100% cotton, tipis dan ringan, handfeel lembut, nyaman dipakai di segala cuaca. Graphic printing pada bagian dada', '60b03a5453e0f.jpg', 179000, 0, 0.2, 'Tshirt', '2021-05-28 07:33:24', '2021-05-31 12:44:56'),
(33, 'S001', 'Red Shirt', 'Kemeja dari bahan flanel katun kotak-kotak yang lembut dengan kerah turn-down, bagian depan klasik, dua saku dada terbuka, dan sebuah kuk di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di ujung lengan dan saku rok lengan dengan tombol penghubung, dan ujung bundar.', '60b03aa04a04f.jpg', 279000, 0, 0.2, 'Shirt', '2021-05-28 07:34:40', '2021-05-31 12:47:45'),
(34, 'S002', 'Strip Shirt', 'Kemeja dari bahan flanel katun garis-garis yang lembut dengan kerah turn-down, bagian depan klasik, dua saku dada terbuka, dan sebuah kuk di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di ujung lengan dan saku rok lengan dengan tombol penghubung, dan ujung bundar.', '60b03aee4b6e5.jpg', 278999, 0, 0.2, 'Shirt', '2021-05-28 07:35:58', '2021-05-31 12:48:58'),
(35, 'S003', 'Cube Shirt', 'Kemeja dari bahan flanel katun kotak-kotak yang lembut dengan kerah turn-down, bagian depan klasik, dua saku dada terbuka, dan sebuah kuk di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di ujung lengan dan saku rok lengan dengan tombol penghubung, dan ujung bundar.', '60b03b251f243.jpg', 299000, 0, 0.2, 'Shirt', '2021-05-28 07:36:53', '2021-05-31 12:48:30'),
(36, 'S004', 'Carbon', 'Kemeja dari bahan flanel katun yang lembut dengan kerah turn-down, bagian depan klasik, dua saku dada terbuka, dan sebuah kuk di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di ujung lengan dan saku rok lengan dengan tombol penghubung, dan ujung bundar.', '60b03b5db40b9.jpg', 229000, 0, 0.2, 'Shirt', '2021-05-28 07:37:49', '2021-05-31 12:51:53'),
(37, 'S005', 'White Stan', 'Kemeja dari bahan katun Oxford yang elastis dengan kerah berkancing, bagian depan klasik dan kuk serta anak panah di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di bagian manset, dan ujung bulat. Muscle Fit â € “desain yang menampilkan fisik tubuh dengan bahu sempit dan lengan meruncing untuk menciptakan siluet yang menawan.\r\n', '60b03b9be7f7d.jpg', 229000, 0, 0.2, 'Shirt', '2021-05-28 07:38:51', '2021-05-31 12:53:47'),
(38, 'S006', 'Dizzy Shirt', 'Kemeja dari bahan katun Oxford yang elastis dengan kerah berkancing, bagian depan klasik dan kuk serta anak panah di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di bagian manset, dan ujung bulat. Muscle Fit â € “desain yang menampilkan fisik tubuh dengan bahu sempit dan lengan meruncing untuk menciptakan siluet yang menawan.\r\n', '60b03bd504941.jpg', 299000, 0, 0.2, 'Shirt', '2021-05-28 07:39:49', '2021-05-31 12:55:38'),
(39, 'S007', 'Cube Standard', 'Kemeja dari bahan flanel katun kotak-kotak yang lembut dengan kerah turn-down, bagian depan klasik, dua saku dada terbuka, dan sebuah kuk di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di ujung lengan dan saku rok lengan dengan tombol penghubung, dan ujung bundar.', '60b03c14c9703.jpg', 279000, 0, 0.2, 'Shirt', '2021-05-28 07:40:52', '2021-05-31 12:52:28'),
(40, 'S008', 'Abstrak Shirt', 'Kemeja dari bahan katun Oxford yang elastis dengan kerah berkancing, bagian depan klasik dan kuk serta anak panah di bagian belakang. Lengan panjang dengan kancing yang bisa disesuaikan di bagian manset, dan ujung bulat. Muscle Fit â € “desain yang menampilkan fisik tubuh dengan bahu sempit dan lengan meruncing untuk menciptakan siluet yang menawan.\r\n', '60b03c773164c.jpg', 279000, 0, 0.2, 'Shirt', '2021-05-28 07:42:31', '2021-05-31 12:56:42'),
(41, 'JC001', 'jacket jeans blue standard', '-Cotton Denim OE\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai', '60b03cf7acc6b.jpg', 329000, 0, 0.2, 'Jacket', '2021-05-28 07:44:39', '2021-05-31 13:17:02'),
(42, 'JC003', 'Dilan Jacket', '-Cotton Denim OE\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai\r\n-mirip dilan ', '60b0a25d5cbe9.jpg', 369000, 0, 0.2, 'Jacket', '2021-05-28 14:49:15', '2021-05-31 13:17:34'),
(43, 'JC002', 'Black Parka', '-Cotton parka OE OE\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai', '60b0a2355fa0d.jpg', 359000, 0, 1, 'Jacket', '2021-05-28 14:56:37', '2021-05-31 13:18:44'),
(44, 'JC004', 'Black ', '-Cotton Denim OE\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai\r\n\r\n \r\n', '60b0a4741e0b3.jpg', 359000, 0, 1, 'Jacket', '2021-05-28 15:06:12', '2021-05-31 13:19:30'),
(45, 'JC005', 'black jacket jeans', '-Cotton Denim OE\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai\r\n\r\n \r\n', '60b0a4d9d017c.jpg', 379000, 0, 1, 'Jacket', '2021-05-28 15:07:53', '2021-05-31 13:20:57'),
(46, 'JC006', 'cream', '-Cotton Denim OE\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai\r\n\r\n', '60b0a5234539f.jpg', 329000, 0, 1, 'Jacket', '2021-05-28 15:09:07', '2021-05-31 13:23:07'),
(47, 'JC007', 'leather jacket', '-Kulit sapi\r\n-Soft & Tidak Melar\r\n-Detail kerah\r\n-Variasi tipe Washing\r\n-Kantong samping/atas\r\n-Kancing dan Resetling Depan\r\n-Regular fit\r\n-Nyaman dipakai\r\n\r\n \r\n\r\n', '60b0bcf58d2e3.jpg', 429000, 50000, 1, 'Jacket', '2021-05-28 16:50:45', '2021-05-31 13:25:20'),
(48, 'PN001', 'Jeans Blue', '- Celana denim desain klasik dengan aksen washed\r\n- Warna biru\r\n- Mid rise\r\n- Skinny fit\r\n- Kancing dan resleting depan belakang\r\n- 2 kantong depan dan belakang\r\n- Material denim tidak transparan, ketebalan medium, dan tidak stretch\r\n- Tinggi model 188cm mengenakan ukuran 32in\r\n- 100% Original\r\n- Size Lokal', '60b0bd2e2acfb.jpg', 339000, 0, 1, 'Pant', '2021-05-28 16:51:42', '2021-05-31 13:26:41'),
(49, 'PN002', 'Dark Blue Jeans', '- Celana denim desain klasik dengan aksen washed\r\n- Warna biru\r\n- Mid rise\r\n- Skinny fit\r\n- Kancing dan resleting depan\r\n- 2 kantong depan dan belakang\r\n- Material denim tidak transparan, ketebalan medium, dan tidak stretch\r\n- Tinggi model 188cm mengenakan ukuran 32in\r\n- 100% Original\r\n- Size Lokal', '60b0bd67d955b.jpg', 339000, 0, 1, 'Pant', '2021-05-28 16:52:39', '2021-05-31 13:26:56'),
(50, 'PN003', 'Brown Chino', ' Celana chino desain clean cut yang memberikan kesan smart\r\n- Warna hijau army\r\n- Mid rise\r\n- Regular fit\r\n- Kancing dan resleting depan\r\n- Detail kantong\r\n- Material katun kombinasi tidak transparan, ringan, dan tidak stretch', '60b0bd8c60560.jpg', 299000, 0, 1, 'Pant', '2021-05-28 16:53:16', '2021-05-31 13:30:18'),
(51, 'PN004', 'Gobrog', ' Celana chino desain clean cut yang memberikan kesan smart\r\n- Warna hijau army\r\n- Mid rise\r\n- Regular fit\r\n- Kancing dan resleting depan\r\n- Detail kantong\r\n- Material katun kombinasi tidak transparan, ringan, dan tidak stretch', '60b0bdb01b116.jpg', 399000, 0, 1, 'Pant', '2021-05-28 16:53:52', '2021-05-31 13:31:10'),
(52, 'PN005', 'Black Blue', '- Celana denim desain klasik dengan aksen washed\r\n- Warna biru\r\n- Mid rise\r\n- Skinny fit\r\n- Kancing dan resleting depan\r\n- 2 kantong depan dan belakang\r\n- Material denim tidak transparan, ketebalan medium, dan tidak stretch\r\n- Tinggi model 188cm mengenakan ukuran 32in\r\n- 100% Original\r\n- Size Lokal\r\n', '60b0bde36bec5.jpg', 399000, 0, 1, 'Pant', '2021-05-28 16:54:43', '2021-05-31 13:28:06'),
(53, 'PN006', 'Jeans', '- Celana denim desain klasik dengan aksen washed\r\n- Warna biru pudar seperti cinta\r\n- Mid rise\r\n- Skinny fit\r\n- Kancing dan resleting depan\r\n- 2 kantong depan dan belakang\r\n- Material denim tidak transparan, ketebalan medium, dan tidak stretch\r\n- Tinggi model 188cm mengenakan ukuran 32in\r\n- 100% Original\r\n- Size Lokal', '60b0be0908708.jpg', 299000, 0, 1, 'Pant', '2021-05-28 16:55:21', '2021-05-31 13:28:52'),
(54, 'PN007', 'Dark Chino', '- Celana denim desain klasik dengan aksen washed\r\n- Warna biru\r\n- Mid rise\r\n- Skinny fit\r\n- Kancing dan resleting depan\r\n- 2 kantong depan dan belakang\r\n- Material denim tidak transparan, ketebalan medium, dan tidak stretch\r\n- Tinggi model 188cm mengenakan ukuran 32in\r\n- 100% Original\r\n- Size Lokal', '60b0be3f31ea5.jpg', 299000, 0, 1, 'Pant', '2021-05-28 16:56:15', '2021-05-31 13:31:33'),
(55, 'PN008', 'Ela Jeans', '- Celana denim desain klasik dengan aksen washed\r\n- Warna biru\r\n- Mid rise\r\n- Skinny fit\r\n- Kancing dan resleting depan\r\n- 2 kantong depan dan belakang\r\n- Material denim tidak transparan, ketebalan medium, dan tidak stretch\r\n- Tinggi model 188cm mengenakan ukuran 32in\r\n- 100% Original\r\n- Size Lokal', '60b0be73806b1.jpg', 399000, 0, 1, 'Pant', '2021-05-28 16:57:07', '2021-05-31 13:31:44'),
(56, 'AC001', 'Watch d', 'Sporty dan maskulin, D menampilkan Man Watches 26-100-001. Jam tangan yang dilengkapi dengan penunjuk tanggal dan hari serta balutan warna bold.\r\n\r\n- ABS case\r\n- PU Strap\r\n- Hitam\r\n- Chrono\r\n- Alarm\r\n- Negative display\r\n- EL backlight\r\n- Water resistant: 1 ATM\r\n- Garansi internasional 1 tahun, hanya berlaku di service center resmi', '60b0bed31939a.jpg', 399000, 0, 1, 'Accessories', '2021-05-28 16:58:43', '2021-05-31 13:35:32'),
(57, 'AC002', 'American Mask', '- Masker kain berwarna solid dengan tekstur lembut yang breathable\r\n- Warna AMERIKA\r\n- Material katun\r\n- Desain ear loop\r\n- Dapat digunakan kembali', '60b0bf00cdf8f.jpg', 99000, 0, 1, 'Accessories', '2021-05-28 16:59:28', '2021-05-31 13:49:30'),
(58, 'AC003', 'Tie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '60b0bf1fdc29a.jpg', 399000, 0, 1, 'Accessories', '2021-05-28 16:59:59', NULL),
(59, 'AC004', 'Watch Olex', 'Sporty dan maskulin, Olex menampilkan Man Watches. Jam tangan yang dilengkapi dengan penunjuk tanggal dan hari serta balutan warna bold.\r\n\r\n- ABS case\r\n- PU Strap\r\n- Hitam\r\n- Chrono\r\n- Alarm\r\n- Negative display\r\n- EL backlight\r\n- Water resistant: 1 ATM\r\n- Garansi internasional 1 tahun, hanya berlaku di service center resmi', '60b0bf47cfa4a.jpg', 699000, 0, 1, 'Accessories', '2021-05-28 17:00:39', '2021-05-31 13:36:01'),
(60, 'AC005', 'Black Glasses', '- Kacamata kami memberikan perlindungan dengan lensa kategori 3 yang melindungi dari silau dan menyaring 100% sinar ultraviolet (UV).\r\n- Dibuat untuk semua orang, kacamata ini cocok untuk wanita dan pria.\r\n- Dilengkapi dengan engsel fleksibel dan ringan, kacamata hitam ini akan sangat nyaman dipakai.', '60b0bf84b1d5e.jpg', 499000, 0, 1, 'Accessories', '2021-05-28 17:01:40', '2021-05-31 13:48:00'),
(61, 'AC006', 'Eiko Watch', 'Sporty dan maskulin, Eiko menampilkan Man Watches. Jam tangan yang dilengkapi dengan penunjuk tanggal dan hari serta balutan warna bold.\r\n\r\n- ABS case\r\n- PU Strap\r\n- Hitam\r\n- Chrono\r\n- Alarm\r\n- Negative display\r\n- EL backlight\r\n- Water resistant: 1 ATM\r\n- Garansi internasional 1 tahun, hanya berlaku di service center resmi', '60b0bfac5da83.jpg', 599000, 0, 1, 'Accessories', '2021-05-28 17:02:20', '2021-05-31 13:43:54'),
(62, 'JC008', 'Glasses', '- Kacamata  kami memberikan perlindungan dengan lensa kategori 3 yang melindungi dari silau dan menyaring 100% sinar ultraviolet (UV).\r\n- Dibuat untuk semua orang, kacamata ini cocok untuk wanita dan pria.\r\n- Dilengkapi dengan engsel fleksibel dan ringan, kacamata hitam ini akan sangat nyaman dipakai.', '60b0c0088cd53.jpg', 319000, 0, 1, 'Accessories', '2021-05-28 17:03:52', '2021-05-31 13:48:20'),
(63, 'AC009', 'Avatar Ring', '- High quality mini mixing palette\r\n- Can be worn as a ring to ease makeup application\r\n- Material: Stainless steel\r\n- Round shape\r\n​- Color: Silver', '60b0c02759f18.jpg', 129000, 0, 1, 'Accessories', '2021-05-28 17:04:23', '2021-05-31 13:50:26'),
(64, 'AC0010', 'Black Mask', '- Masker kain berwarna solid dengan tekstur lembut yang breathable\r\n- Warna hitam\r\n- Material katun\r\n- Desain ear loop\r\n- Dapat digunakan kembali', '60b0c04aa4b83.jpg', 99000, 0, 1, 'Accessories', '2021-05-28 17:04:58', '2021-05-31 13:49:07'),
(65, 'AC0011', 'Alexander Chisry Watch', 'Sporty dan maskulin, Alexander Chisry menampilkan Man Watches. Jam tangan yang dilengkapi dengan penunjuk tanggal dan hari serta balutan warna bold.\r\n\r\n- ABS case\r\n- PU Strap\r\n- Hitam\r\n- Chrono\r\n- Alarm\r\n- Negative display\r\n- EL backlight\r\n- Water resistant: 1 ATM\r\n- Garansi internasional 1 tahun, hanya berlaku di service center resmi', '60b0c07d8679f.jpg', 529000, 0, 1, 'Accessories', '2021-05-28 17:05:49', '2021-05-31 13:36:33'),
(66, 'AC0012', 'Style Glasses', '- Kacamata kami memberikan perlindungan dengan lensa kategori 3 yang melindungi dari silau dan menyaring 100% sinar ultraviolet (UV).\r\n- Dibuat untuk semua orang, kacamata ini cocok untuk wanita dan pria.\r\n- Dilengkapi dengan engsel fleksibel dan ringan, kacamata hitam ini akan sangat nyaman dipakai.', '60b0c0ad6cd41.jpg', 329000, 0, 1, 'Accessories', '2021-05-28 17:06:37', '2021-05-31 13:48:39');

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
(27, 37, 'M', 10, '2021-05-28 09:44:20', NULL),
(28, 37, 'L', 10, '2021-05-28 14:52:26', NULL),
(29, 1, 'S', 12, '2021-05-31 13:51:32', NULL),
(30, 1, 'XXL', 3, '2021-05-31 13:51:55', NULL),
(31, 2, 'XL', 12, '2021-05-31 13:52:10', NULL),
(32, 2, 'M', 21, '2021-05-31 13:52:20', NULL),
(33, 2, 'S', 31, '2021-05-31 13:52:32', NULL),
(34, 26, 'M', 12, '2021-05-31 13:53:06', NULL),
(35, 26, 'L', 3, '2021-05-31 13:53:18', NULL),
(36, 26, 'XL', 7, '2021-05-31 13:53:34', NULL),
(37, 27, 'S', 12, '2021-05-31 14:01:30', NULL),
(38, 27, 'L', 3, '2021-05-31 14:01:53', NULL),
(39, 27, 'XL', 4, '2021-05-31 14:02:03', NULL),
(40, 28, 'L', 31, '2021-05-31 14:02:15', NULL),
(41, 28, 'XL', 2, '2021-05-31 14:02:25', NULL),
(42, 29, 'M', 21, '2021-05-31 14:02:37', NULL),
(43, 29, 'XL', 43, '2021-05-31 14:02:49', NULL),
(44, 33, 'M', 3, '2021-05-31 14:03:05', NULL),
(45, 33, 'XL', 32, '2021-05-31 14:03:18', NULL),
(46, 35, 'XL', 3, '2021-05-31 14:03:30', NULL),
(47, 34, 'M', 33, '2021-05-31 14:03:42', NULL),
(48, 36, 'XL', 3, '2021-05-31 14:04:35', NULL),
(49, 38, 'L', 6, '2021-05-31 14:04:56', NULL),
(50, 39, 'XL', 7, '2021-05-31 14:05:16', NULL),
(51, 40, 'M', 5, '2021-05-31 14:05:28', NULL),
(52, 41, 'M', 12, '2021-05-31 14:05:40', NULL),
(53, 50, 'L', 12, '2021-05-31 14:06:21', NULL),
(54, 56, 'SM', 7, '2021-05-31 14:06:49', NULL),
(55, 57, 'One Size', 222, '2021-05-31 14:07:14', NULL),
(56, 59, 'One Size', 23, '2021-05-31 14:07:31', NULL),
(57, 62, 'One Size', 2, '2021-05-31 14:08:16', NULL),
(58, 60, 'One Size', 2, '2021-05-31 14:08:32', NULL);

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
(2, 2, 'codarel.id@gmail.com', NULL, NULL, NULL, NULL, 'default.jpg', '$2y$10$iWBQJSltNPd6pXpfXzAgGOxSF6wxOyUFznpnyQOocefj2hDenb.uS', 1, '2021-05-15 15:10:46', NULL, NULL),
(3, 1, 'farrelnurrilwanu72@gmail.com', NULL, NULL, NULL, NULL, 'default.jpg', '$2y$10$OkNZLTCNVLLuHUHNlNLM4.4XuwqCJV8bBL8dz.ZatXf0DYwcZn8PG', 1, '2021-05-28 18:48:59', NULL, NULL);

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

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `fullname`, `street_name`, `province`, `city`, `districts`, `postcode`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mochamad Nurul Huda', 'Jl. Laswi', 'Jawa Barat', 'Bandung', 'Majalaya', '40382', '081242337968', '2021-06-01 08:28:58', NULL),
(2, 1, 'Mochamad Nurul Huda', 'Jl. Baru', 'Jawa Barat', 'Bandung', 'Majalaya', '40382', '085220455777', '2021-06-01 16:18:49', NULL);

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
-- Structure for view `cart_detail`
--
DROP TABLE IF EXISTS `cart_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cart_detail`  AS  select `cart`.`id` AS `id`,`cart`.`user_id` AS `user_id`,`cart`.`product_id` AS `product_id`,`cart`.`size` AS `size`,`cart`.`quantity` AS `quantity`,`cart`.`created_at` AS `created_at`,`cart`.`updated_at` AS `updated_at`,`products`.`sku` AS `sku`,`products`.`name` AS `name`,`products`.`description` AS `description`,`products`.`product_image` AS `product_image`,`products`.`regular_price` AS `regular_price`,`products`.`discount_price` AS `discount_price`,`products`.`weight` AS `weight`,`products`.`category` AS `category` from (`cart` join `products` on(`cart`.`product_id` = `products`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `order_detail`
--
DROP TABLE IF EXISTS `order_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_detail`  AS  select `orders`.`id` AS `id`,`orders`.`user_id` AS `user_id`,`orders`.`shipping` AS `shipping`,`orders`.`amount` AS `amount`,`orders`.`address_id` AS `address_id`,`order_items`.`id` AS `item_id`,`order_items`.`product_id` AS `product_id`,`order_items`.`size` AS `size`,`order_items`.`quantity` AS `quantity`,`order_items`.`subtotal` AS `subtotal`,`order_logs`.`id` AS `logs_id`,`order_logs`.`order_status` AS `order_status`,`order_logs`.`created_at` AS `created_at` from ((`orders` join `order_items` on(`order_items`.`order_id` = `orders`.`id`)) join `order_logs` on(`order_logs`.`order_id` = `orders`.`id`)) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_status`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

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
