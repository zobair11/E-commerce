-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 09:09 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project85`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `logo` varchar(20) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `email` varchar(30) NOT NULL,
  `forgot_hash` varchar(64) NOT NULL,
  `is_forgot` int(1) NOT NULL,
  `fb` varchar(30) NOT NULL,
  `tw` varchar(30) NOT NULL,
  `ins` varchar(30) NOT NULL,
  `gp` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `logo`, `uname`, `pass`, `email`, `forgot_hash`, `is_forgot`, `fb`, `tw`, `ins`, `gp`, `phone`, `contact`, `copyright`, `is_active`) VALUES
(1, '59a4326a96c55.png', 'admin', '2a97516c354b68848cdbd8f54a226a0a55b21ed138e207ad6c5cbb9c00aa5aea', 'admin@gmail.com', '', 0, 'http://facebook.com/', 'http://twiiter.com', 'http://instagram.com', 'http://google.com', '01675718450', 'zobair.el.shaarawy@gmail.com', 'copyright @php85 2017', 1);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `b_id` int(11) NOT NULL,
  `b_title` varchar(255) NOT NULL,
  `b_sub_title` varchar(255) NOT NULL,
  `b_des` text NOT NULL,
  `b_img` varchar(20) NOT NULL,
  `b_button` varchar(20) NOT NULL,
  `b_button_url` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`b_id`, `b_title`, `b_sub_title`, `b_des`, `b_img`, `b_button`, `b_button_url`, `is_active`) VALUES
(1, 'E-Shopper edited', '100% Responsive Design edited', 'Edited Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '599d92ceef7bb.jpg', 'Get It Now edited', 'http://www.yahoo.com', 1),
(3, 'E-Shopper 2', '100% Responsive Design 2 ', 'orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '599d9ed0ec058.jpg', 'Get It Now 2', 'http://www.google.com', 1),
(4, 'New title', 'new sub title', 'new desciri', '59bfcf1451ba8.jpg', 'go', 'www.yahoo.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `br_id` int(11) NOT NULL,
  `br_name` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`br_id`, `br_name`, `is_active`) VALUES
(2, 'Bata2', 0),
(3, 'Nokia', 1),
(4, 'bata', 0),
(8, 'Windows', 1),
(9, 'Samsung', 1),
(10, 'Brand 1', 1),
(11, 'Brand 2', 1),
(12, 'Brand 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `is_active`) VALUES
(1, 'Men', 1),
(2, 'Women', 1),
(3, 'Kids', 1),
(4, 'Sports', 1),
(5, 'Households', 1),
(6, 'New', 1),
(7, 'Pet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_title` varchar(255) NOT NULL,
  `p_price` decimal(5,2) NOT NULL,
  `p_des` text NOT NULL,
  `p_image` varchar(20) NOT NULL,
  `p_model` varchar(20) NOT NULL,
  `p_qnt` int(2) NOT NULL,
  `p_available` int(1) NOT NULL,
  `p_cond` varchar(10) NOT NULL,
  `br_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_title`, `p_price`, `p_des`, `p_image`, `p_model`, `p_qnt`, `p_available`, `p_cond`, `br_id`, `cat_id`, `sub_id`, `is_active`) VALUES
(2, 'Cat', '125.00', 'A set of key/value pairs that configure the Ajax request. All settings are optional. A default can be set for any option with $.ajaxSetup(). See jQuery.ajax( settings ) below for a complete list of all settings.', '59b68caf74b08.jpg', 'S-125', 5, 0, '1', 10, 7, 13, 1),
(3, 'Three piece', '500.00', 'A set of key/value pairs that map a given dataType to its MIME type, which gets sent in the Accept request header. This header tells the server what kind of response it will accept in return. For example, the following defines a custom type mycustomtype to be sent with the request:', '59b6911bed59f.jpg', 'P-12', 7, 1, '2', 11, 2, 5, 1),
(4, 'Polo shirt', '999.99', 'Description are goes to here.', '59ba8930f0a58.jpg', 'F-11', 6, 1, '3', 12, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `o_id` int(11) NOT NULL,
  `company` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `country` varchar(2) NOT NULL,
  `state` varchar(4) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mphone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `payment` int(1) NOT NULL,
  `message` text NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `ordered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`o_id`, `company`, `email`, `title`, `fname`, `mname`, `lname`, `address`, `zip`, `country`, `state`, `phone`, `mphone`, `fax`, `payment`, `message`, `u_id`, `p_id`, `ordered`) VALUES
(6, 'creativeartbd', 'shibbir.me@gmail.com', 'Web Applicaiton Developer', 'Shibbir', 'Ahmed', 'babu', 'address', '23434', 'bd', 'uk-s', '01671133639', '01671123365', '165165465416', 3, 'Message are gess tsdsfdfo here....', 1, 2, '2017-09-18 01:59:43'),
(11, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 1, 2, '2017-09-18 02:36:31'),
(12, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 1, 2, '2017-09-18 02:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `r_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `review` text NOT NULL,
  `rating` int(1) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`r_id`, `p_id`, `name`, `email`, `review`, `rating`, `dated`) VALUES
(1, 3, 'Foyez', 'foyez@gmail.com', 'The product is not good', 1, '2017-09-11 03:05:39'),
(8, 3, 'sdfsd', 'stfab_k08@yahoo.com', '', 2, '2017-09-11 03:11:42'),
(9, 3, 'Badhon', 'badhon@gmail.com', 'Very useful and comfortable ', 4, '2017-09-11 03:12:25'),
(10, 2, 'sdfsd', 'fsdf@gmail.com', '', 2, '2017-09-12 02:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_name` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_id`, `cat_id`, `sub_name`, `is_active`) VALUES
(1, 1, 'T-shirt', 1),
(2, 1, 'Men Shoe', 1),
(3, 1, 'Jeans', 1),
(4, 1, 'Watch', 1),
(5, 2, 'Three Piece', 1),
(6, 2, 'Shari', 1),
(7, 2, 'Lehenga', 1),
(8, 4, 'Ball', 1),
(9, 4, 'Bat', 1),
(10, 4, 'Tennis', 1),
(11, 2, 'Chair edited ', 0),
(12, 5, 'Table', 1),
(13, 7, 'Cat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_cart`
--

CREATE TABLE `tmp_cart` (
  `tmp_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `is_completed` int(11) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmp_cart`
--

INSERT INTO `tmp_cart` (`tmp_id`, `p_id`, `qnt`, `u_id`, `is_completed`, `dated`) VALUES
(22, 2, 2, 1, 1, '2017-09-18 20:26:57'),
(23, 3, 3, 1, 1, '2017-09-18 20:27:00'),
(24, 3, 1, 4, 0, '2018-03-08 16:36:23'),
(25, 4, 4, 4, 0, '2018-03-08 16:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `dated` datetime NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `name`, `email`, `pass`, `dated`, `is_active`) VALUES
(1, 'Badhon Edited', 'badhon1@gmail.com', '8a9bcf1e51e812d0af8465a8dbcc9f741064bf0af3b3d08e6b0246437c19f7fb', '2017-09-13 02:06:57', 1),
(3, 'babu', 'babu@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2017-09-13 03:28:28', 1),
(4, 'zobair', 'zobair619316@hotmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2018-03-08 08:55:17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tmp_cart`
--
ALTER TABLE `tmp_cart`
  ADD PRIMARY KEY (`tmp_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tmp_cart`
--
ALTER TABLE `tmp_cart`
  MODIFY `tmp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
