-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 10:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(200) NOT NULL,
  `adminUser` varchar(200) NOT NULL,
  `adminEmail` varchar(200) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Prodip kumar', 'Admin', 'prodip@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'ACER'),
(2, 'IPHONE'),
(3, 'SAMSUNG'),
(4, 'CANON');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `sId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES
(35, '5cg7a7d2pfcpp2podv14norrhl', 15, 'Dress', 1000.00, 1, 'uploads/08832b9948.jpg'),
(36, 'bcuqisqmaaat5csvkrt5k2gb17', 14, 'phone', 50000.00, 1, 'uploads/4ca830f8db.png'),
(37, 'hm2n5nen1201t0s7445ftoudqt', 15, 'Dress', 1000.00, 1, 'uploads/08832b9948.jpg'),
(38, 'l4mfihug4f7tcb01o0ualruav5', 14, 'phone', 50000.00, 1, 'uploads/4ca830f8db.png'),
(39, 'oq22m8krd48siqj10kljf89vio', 15, 'Dress', 1000.00, 1, 'uploads/08832b9948.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Desktop'),
(2, 'Laptop'),
(3, 'Accessories'),
(4, 'Software'),
(5, 'Sports &amp; Fitness'),
(6, 'Footware'),
(7, 'Jewellery'),
(8, 'Cloth'),
(9, 'Home decor &amp; Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(3, 'Prodip kumar sutradhar', 'Monipuripara,Tejgaon', 'Dhaka', 'Bangladesh', '1215', '01778773603', 'prodip@gmail.com', '202cb962ac59075b964b07152d234b'),
(5, 'tanmoy', 'monipuripara.tejgaon', 'dhaka', 'bangladesh', '1215', '01778773603', 'ibnsaad0@gmail.com', 'e10adc3949ba59abbe56e057f20f88'),
(6, 'Rubel', 'monipuripara.tejgaon', 'dhaka', 'bangladesh', '1215', '01778773603', 'ratonsutra93@gmail.com', 'c20ad4d76fe97759aa27a0c99bff67'),
(8, 'Nishat', 'monipuripara.tejgaon', 'dhaka', 'bangladesh', '1215', '01724472259', 'nishat@gmail.com', '81dc9bdb52d04dc20036dbd8313ed0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(23, 3, 13, 'Lorem Ipsum is simply', 1, 20000, 'uploads/930ce6652b.jpg', '2020-03-17 09:40:35', 2),
(25, 3, 13, 'Lorem Ipsum is simply', 1, 20000, 'uploads/930ce6652b.jpg', '2020-03-17 10:44:25', 2),
(26, 3, 12, 'Lorem Ipsum is simply', 1, 5500, 'uploads/b8e8c3c418.jpg', '2020-03-17 10:44:26', 2),
(30, 3, 14, 'phone', 1, 50000, 'uploads/4ca830f8db.png', '2020-03-18 10:55:31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(2, 'Lorem Ipsum is simply', 3, 3, '<p>Lorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simplyLorem Ipsum is simply</p>', 5000, 'uploads/685980413f.jpg', 0),
(3, 'phone', 3, 2, '<p>This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.</p>\r\n<p>This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.This brand product quality is the best.</p>', 10000, 'uploads/a521568299.png', 0),
(6, 'phone', 3, 3, '<p>Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.</p>\r\n<p>Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.</p>', 25400.6, 'uploads/66f44f278d.png', 0),
(7, 'Lorem Ipsum is simply', 9, 1, '<p>Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.</p>\r\n<p>Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.</p>', 12458, 'uploads/b49712850f.jpg', 0),
(8, 'Lorem Ipsum is simply', 5, 1, '<p>Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.</p>\r\n<p>Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.Samsung is a best brand of the world.</p>', 45785, 'uploads/800abb9712.jpg', 0),
(9, 'phone', 3, 1, '<p>Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.</p>\r\n<p>Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.Samsung brand is the best brand of the world.</p>', 5000, 'uploads/2063a8d157.jpg', 0),
(10, 'Lorem Ipsum is simply', 9, 4, '<p>canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.</p>\r\n<p>canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.canon is the best brand.</p>', 10000, 'uploads/bcaf615b54.jpg', 0),
(11, 'Lorem Ipsum is simply', 8, 1, '<p><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span></p>', 1225, 'uploads/e6ad19abcd.jpg', 0),
(12, 'Lorem Ipsum is simply', 3, 1, '<p><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span></p>', 5500, 'uploads/b8e8c3c418.jpg', 0),
(13, 'Lorem Ipsum is simply', 1, 3, '<p><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span></p>', 20000, 'uploads/930ce6652b.jpg', 0),
(14, 'phone', 3, 2, '<p><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span><span>Lorem ipsum</span><span>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.</span></p>', 50000, 'uploads/4ca830f8db.png', 0),
(15, 'Dress', 8, 1, '<p>That kproduct is very good.That kproduct is very good.That kproduct is very good.</p>', 1000, 'uploads/08832b9948.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
