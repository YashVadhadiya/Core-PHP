-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3305
-- Generation Time: Apr 05, 2022 at 10:01 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_yash`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` int(8) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0,
  `same` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`, `same`) VALUES
(359, 244, 'e', 0, 'e', 'e', 'e', 1, 0, 1),
(360, 244, 'e', 0, 'e', 'e', 'e', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(4, 'demo', 'demo', 'demo@ccc', '63adf72d51df3907b1d18b13d93a054c', 1, '2022-03-12 01:33:39', '2022-04-05 13:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `shippingAmount` float DEFAULT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `total`, `shippingMethodId`, `shippingAmount`, `paymentMethodId`, `createdAt`, `updatedAt`) VALUES
(58, 244, 5000, 4, 65, 2, '2022-04-05 13:14:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postalCode` int(8) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 1,
  `shipping` tinyint(1) NOT NULL DEFAULT 1,
  `same` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`cartAddressId`, `cartId`, `firstName`, `lastName`, `phone`, `email`, `address`, `city`, `state`, `country`, `postalCode`, `billing`, `shipping`, `same`) VALUES
(67, 58, 'w', 'w', '', 'w', 'e', 'e', 'e', 'e', 0, 1, 0, 0),
(68, 58, 'w', 'w', '', 'w', 'e', 'e', 'e', 'e', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `cost` float NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemId`, `cartId`, `productId`, `quantity`, `price`, `cost`, `tax`, `taxAmount`, `discount`) VALUES
(178, 58, 663, 4, 1000, 1000, '10', 100, 10),
(179, 58, 664, 1, 1000, 1000, '10', 100, 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `path` varchar(127) NOT NULL,
  `categoryName` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `path`, `categoryName`, `status`, `createdAt`, `updatedAt`) VALUES
(33, 0, '33', 'mi', 1, '2022-03-21 11:47:51', '2022-04-05 10:04:42'),
(34, 33, '33/34', '10', 1, '2022-03-27 22:38:53', '2022-04-05 10:08:42'),
(35, 34, '33/34/35', '2', 1, '2022-04-03 11:40:43', '2022-04-05 10:06:09'),
(36, 33, '33/36', 'plus', 1, '2022-04-03 11:53:33', '2022-04-05 10:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `imageId` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `thumb` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `gallery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`imageId`, `categoryId`, `image`, `base`, `thumb`, `small`, `status`, `gallery`) VALUES
(30, 36, '0452022100341-favicon.jpg', 1, 1, 0, 0, '0'),
(31, 33, '0452022100421-WhatsApp Image 2022-03-24 at 9.57.29 PM.jpeg', 0, 0, 0, 0, '0'),
(32, 36, '0452022100452-WhatsApp Image 2022-03-24 at 9.57.29 PM.jpeg', 0, 0, 0, 0, '0'),
(33, 35, '0452022100514-WhatsApp Image 2022-03-24 at 9.57.29 PM.jpeg', 1, 1, 1, 1, '1'),
(34, 34, '0452022100819-WhatsApp Image 2022-04-02 at 8.43.40 PM.jpeg', 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `categoryId`, `productId`) VALUES
(32, 34, 663);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `value`, `code`, `status`, `createdAt`) VALUES
(1, 's', 's', 's', 1, '2022-04-05 13:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `salesmanId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `salesmanId`, `firstName`, `lastName`, `email`, `phone`, `status`, `createdAt`, `updatedAt`) VALUES
(244, 33, 'w', 'w', 'w', 'w', 1, '2022-04-05 12:55:40', '2022-04-05 13:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `customerPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `customerId`, `productId`, `customerPrice`) VALUES
(63, 244, 663, 999),
(64, 244, 664, 999),
(65, 244, 665, 999),
(66, 244, 666, 999),
(67, 244, 667, 999),
(68, 244, 671, 245),
(69, 244, 672, 9.5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `grandTotal` float NOT NULL,
  `taxAmount` float NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` float NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `state` tinyint(4) DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `firstName`, `lastName`, `email`, `phone`, `grandTotal`, `taxAmount`, `shippingMethodId`, `shippingAmount`, `paymentMethodId`, `state`, `status`, `createdAt`, `updatedAt`) VALUES
(67, 244, 'w', 'w', 'w', '', 5215, 200, 4, 65, 2, 1, 1, '2022-04-05 13:14:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `city` varchar(128) NOT NULL,
  `state` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `postalCode` int(8) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `email`, `phone`, `city`, `state`, `country`, `postalCode`, `address`, `type`, `createdAt`, `updatedAt`) VALUES
(121, 67, 'w', 'w', 'w', '', 'e', 'e', 'e', 0, 'e', 1, '2022-04-05 13:14:23', NULL),
(122, 67, 'w', 'w', 'w', '', 'e', 'e', 'e', 0, 'e', 2, '2022-04-05 13:14:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_comment`
--

CREATE TABLE `order_comment` (
  `commentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` text NOT NULL,
  `customerNotified` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_comment`
--

INSERT INTO `order_comment` (`commentId`, `orderId`, `status`, `note`, `customerNotified`, `createdAt`) VALUES
(10, 67, 0, '', 0, '2022-04-05 13:14:23'),
(11, 67, 5, '', 1, '2022-04-05 13:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `cost`, `price`, `tax`, `taxAmount`, `discount`, `quantity`, `createdAt`, `updatedAt`) VALUES
(521, 67, 663, 'q', 'FSbadnagdngzfgn', 1000, 1000, '10', 400, 40, 4, '2022-04-05 13:14:23', NULL),
(522, 67, 664, 'q', 'FSbadnagdngzfgn', 1000, 1000, '10', 100, 10, 1, '2022-04-05 13:14:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'demo', 'demo1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, '2022-03-01 00:52:15', '2022-04-05 01:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`methodId`, `name`, `note`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Cash On Delivery', '', 1, '2022-03-19 12:26:39', '2022-03-20 14:35:02'),
(2, 'UPI', '', 1, '2022-03-20 14:33:45', NULL),
(3, 'Debit Card', '', 1, '2022-03-20 14:33:53', NULL),
(4, 'Credit Card', '', 1, '2022-03-20 14:34:01', NULL),
(6, 'EMI', '', 2, '2022-04-02 00:45:50', '2022-04-02 00:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `cost` float NOT NULL,
  `discount` float NOT NULL,
  `discountMode` tinyint(1) NOT NULL,
  `quantity` int(10) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `cost`, `discount`, `discountMode`, `quantity`, `sku`, `tax`, `status`, `createdAt`, `updatedAt`) VALUES
(663, 'q', 1000, 1000, 10, 1, 1000, 'FSbadnagdngzfgn', '10', 1, '2022-04-04 20:21:02', '2022-04-05 12:31:26'),
(664, 'q', 1000, 1000, 10, 1, 1000, 'FSbadnagdngzfgn', '10', 1, '2022-04-04 20:21:02', '2022-04-04 20:21:02'),
(665, 'q', 1000, 1000, 10, 1, 1000, 'FSbadnagdngzfgn', '10', 1, '2022-04-04 20:21:02', '2022-04-04 20:21:02'),
(666, 'q', 1000, 1000, 10, 1, 1000, 'FSbadnagdngzfgn', '10', 1, '2022-04-04 20:21:02', '2022-04-04 20:21:02'),
(667, 'q', 1000, 1000, 10, 1, 1000, 'FSbadnagdngzfgn', '10', 1, '2022-04-04 20:21:02', '2022-04-04 20:21:02'),
(671, 'a', 250, 200, 10, 2, 1000, 'fbadfndgnsfaadf', '10', 1, '2022-04-05 01:15:13', '2022-04-05 01:19:54'),
(672, 'w', 10, 10, 10, 2, 1000, 'dfbsdgndz', '10', 1, '2022-04-05 10:00:07', '2022-04-05 10:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `base` tinyint(2) NOT NULL,
  `thumb` tinyint(2) NOT NULL,
  `small` tinyint(2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `gallery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `base`, `thumb`, `small`, `image`, `status`, `gallery`) VALUES
(50, 671, 1, 0, 0, '0452022011527-favicon.jpg', 0, '0'),
(51, 671, 0, 1, 0, '0452022011635-WhatsApp Image 2022-03-24 at 9.57.29 PM.jpeg', 0, '0'),
(52, 672, 0, 0, 0, '0452022100024-favicon.jpg', 0, '0'),
(53, 672, 0, 0, 1, '0452022100235-WhatsApp Image 2022-03-24 at 9.57.29 PM.jpeg', 0, '0'),
(54, 663, 0, 0, 0, '0452022122431-activity.png', 0, '0'),
(55, 663, 0, 0, 0, '0452022122514-favicon.jpg', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `percentage` float NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `email`, `status`, `phone`, `percentage`, `createdAt`, `updatedAt`) VALUES
(33, 'demo', 'demo', 'demo@demo', 1, '1234567890', 10, '2022-04-05 12:32:43', '2022-04-05 13:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `note` text NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`methodId`, `name`, `note`, `price`, `status`, `createdAt`, `updatedAt`) VALUES
(1, '2-day shipping', '', 25, 1, '2022-03-19 12:29:45', '2022-03-20 14:38:27'),
(2, 'Same-day delivery', '', 100, 1, '2022-03-20 14:36:46', '2022-03-20 14:38:19'),
(3, 'Overnight shipping', '', 75, 1, '2022-03-20 14:36:59', '2022-03-20 14:38:39'),
(4, 'Expedited shipping', '', 65, 1, '2022-03-20 14:37:07', '2022-03-20 14:38:47'),
(7, 'International shipping', '', 350, 1, '2022-04-02 01:05:18', '2022-04-02 01:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `phone`, `status`, `createdAt`, `updatedAt`) VALUES
(71, 'demo', 'demo', 'demo@demo', '1234567890', 1, '2022-04-05 09:28:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `vendorAddressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`vendorAddressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(45, 71, 'demo', 123456, 'demo', 'demo', 'demo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `category_media_ibfk_1` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `category_product_ibfk_2` (`productId`),
  ADD KEY `category_product_ibfk_3` (`categoryId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salesmanId` (`salesmanId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `customer_price_ibfk_1` (`customerId`),
  ADD KEY `customer_price_ibfk_2` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`vendorAddressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `order_comment`
--
ALTER TABLE `order_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=673;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `vendorAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `payment_method` (`methodId`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shipping_method` (`methodId`);

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`);

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE SET NULL;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `payment_method` (`methodId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shipping_method` (`methodId`);

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD CONSTRAINT `order_comment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
