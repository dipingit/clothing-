-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 01:08 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` int(30) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_pp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cgid` int(20) NOT NULL,
  `category` varchar(50) NOT NULL,
  `cgfor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cgid`, `category`, `cgfor`) VALUES
(8, 'Jackets', 'Men'),
(10, 'T-Shirt', 'Men'),
(11, 'Shirt', 'Men'),
(12, 'Shari', 'Women'),
(13, 'Lehenga', 'Women'),
(14, 'Baby item', 'Child'),
(15, 'Polo T-Shirt', 'Men'),
(16, 'Round Collar T-Shirt', 'Men'),
(17, 'Full Sleeve Shirt', 'Men'),
(18, 'Half Sleeve Shirt', 'Men'),
(19, 'Pants & Trousers', 'Men'),
(20, 'Jeans', 'Men'),
(21, 'Shorts', 'Men'),
(22, 'Panjabi & Pajama', 'Men'),
(23, 'Suits Blazers & Ties', 'Men'),
(24, 'Sports Wear', 'Men'),
(25, 'Winter Wear', 'Men'),
(26, 'Wedding Collection', 'Men'),
(27, 'Inner Wear', 'Men'),
(28, 'Salwar Kamiz', 'Women'),
(29, 'Saree', 'Women'),
(30, 'Kurtis & Tunics', 'Women'),
(31, 'Hijab & Scarfs', 'Women'),
(32, 'Palazzo & Leggings', 'Women'),
(33, 'T-Shirt', 'Women'),
(34, 'Shirt', 'Women'),
(35, 'Pants', 'Women'),
(36, 'Inner Wear', 'Women'),
(37, 'Winter Wear', 'Women'),
(38, 'UN-Stitched Than', 'Women'),
(39, 'Wedding Collection', 'Women'),
(40, 'Tops', 'Women'),
(41, 'Dress', 'Women'),
(42, 'Shrugs & Jackets', 'Women'),
(43, 'Shirts', 'Child'),
(44, 'T-Shirts', 'Child'),
(45, 'Saree', 'Child'),
(46, 'Pants', 'Child'),
(47, 'Salwar Kameez', 'Child'),
(48, 'Panjabi & Pajamas', 'Child'),
(49, 'Hijab & Scarf', 'Child'),
(50, 'Dress & Frocks', 'Child'),
(51, 'casual blazer', 'Men');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cmntid` int(30) NOT NULL,
  `cmnt_text` varchar(255) NOT NULL,
  `cmnt_rating` int(20) DEFAULT NULL,
  `cmnt_for` int(30) NOT NULL,
  `cmnted_by` int(30) NOT NULL,
  `cmnter` varchar(50) NOT NULL,
  `nested_of` int(30) DEFAULT NULL,
  `created_date` varchar(30) NOT NULL,
  `created_time` varchar(30) NOT NULL,
  `modified_date` varchar(30) DEFAULT NULL,
  `modified_time` varchar(30) DEFAULT NULL,
  `mention` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmntid`, `cmnt_text`, `cmnt_rating`, `cmnt_for`, `cmnted_by`, `cmnter`, `nested_of`, `created_date`, `created_time`, `modified_date`, `modified_time`, `mention`) VALUES
(2, 'yeah i think so', NULL, 1, 3, 'mzs', 1, 'Nov 22, 2018', '19:14:54', NULL, NULL, 'nobo'),
(4, 'not bad', NULL, 1, 23, 'alex', 1, 'Nov 22, 2018', '19:29:23', NULL, NULL, 'nobo'),
(7, 'so cool :V', NULL, 1, 11, 'fizz', 1, 'Nov 23, 2018', '02:31:15', 'Nov 23, 2018', '12:37:10', 'nobo'),
(8, 'checking again :3', NULL, 1, 11, 'fizz', 1, 'Nov 23, 2018', '08:37:40', 'Nov 23, 2018', '12:37:24', 'nobo'),
(9, 'holy moly', 4, 10, 11, 'fizz', 0, 'Nov 23, 2018', '08:38:50', NULL, NULL, NULL),
(11, 'about to delete', NULL, 14, 11, 'fizz', 10, 'Nov 23, 2018', '09:00:42', 'Nov 23, 2018', '13:11:01', 'fizz'),
(13, 'xyz', 0, 10, 11, 'fizz', 0, 'Nov 23, 2018', '16:07:10', NULL, NULL, NULL),
(14, 'fyfujgu g', 5, 1, 23, 'alex', 0, 'Nov 23, 2018', '16:15:50', 'Nov 23, 2018', '16:23:18', NULL),
(17, 'dgsdgd', 0, 3, 3, 'mzs', 0, 'Nov 23, 2018', '16:36:31', NULL, NULL, NULL),
(18, 'ggdfgsgdfg', 5, 3, 3, 'mzs', 0, 'Nov 23, 2018', '16:36:36', 'Nov 23, 2018', '16:36:49', NULL),
(19, 'fgdghfgh', 3, 1, 1, 'Clothing.com', 0, 'Nov 23, 2018', '16:49:19', 'Nov 23, 2018', '17:02:14', NULL),
(20, 'we are working hard', NULL, 1, 1, 'Clothing.com', 14, 'Nov 23, 2018', '17:01:08', NULL, NULL, 'alex'),
(21, 'trddyyht', 0, 1, 2, 'nobo', 0, 'Nov 23, 2018', '17:46:25', 'Nov 23, 2018', '17:48:51', NULL),
(22, 'gkhhukuhbkgte', NULL, 1, 2, 'nobo', 21, 'Nov 23, 2018', '17:46:46', 'Nov 23, 2018', '17:47:36', 'nobo'),
(23, 'hfghfhfh', 0, 1, 2, 'nobo', 0, 'Nov 23, 2018', '17:49:10', 'Nov 23, 2018', '17:49:34', NULL),
(24, 'hlw', NULL, 1, 2, 'nobo', 23, 'Nov 23, 2018', '17:49:26', NULL, NULL, 'nobo'),
(25, 'rydhtfh', 4, 1, 2, 'nobo', 0, 'Nov 23, 2018', '17:50:12', NULL, NULL, NULL),
(26, 'k', 0, 21, 1, 'Clothing.com', 0, 'Nov 23, 2018', '18:03:02', NULL, NULL, NULL),
(27, 'gxgx', 0, 1, 3, 'mzs', 0, 'Nov 24, 2018', '13:51:17', NULL, NULL, NULL),
(28, 'fyhyrtyfh', 0, 1, 11, 'fizz', 0, 'Nov 25, 2018', '10:17:17', 'Nov 25, 2018', '10:17:28', NULL),
(29, 'ntyhtthytrd', 0, 10, 2, 'nobo', 0, 'Nov 25, 2018', '11:42:52', 'Nov 25, 2018', '11:43:07', NULL),
(30, 'all ok', NULL, 10, 1, 'Clothing.com', 9, 'Nov 25, 2018', '12:02:51', 'Nov 25, 2018', '12:03:21', 'fizz'),
(31, 'sfdffsa', 3, 14, 2, 'nobo', 0, 'Nov 25, 2018', '12:05:46', NULL, NULL, NULL),
(32, 'Nice design!!!', 0, 32, 2, 'nobo', 0, 'Nov 27, 2018', '11:55:34', NULL, NULL, NULL),
(34, 'Thanks!!', NULL, 32, 1, 'Clothing.com', 32, 'Nov 27, 2018', '11:57:14', NULL, NULL, 'nobo'),
(36, 'nice look!!', 0, 33, 2, 'nobo', 0, 'Nov 27, 2018', '15:40:19', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `cus_id` int(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` varchar(255) NOT NULL,
  `send_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int(30) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `customer_password` varchar(30) NOT NULL,
  `customer_pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fid` int(30) NOT NULL,
  `pid` int(30) NOT NULL,
  `uid` int(30) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`fid`, `pid`, `uid`, `username`) VALUES
(13, 14, 23, 'alex'),
(14, 19, 23, 'alex'),
(37, 10, 11, 'fizz'),
(40, 32, 1, 'mzsmunna'),
(44, 32, 11, 'fizz'),
(46, 34, 2, 'nobo'),
(53, 32, 2, 'nobo');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(54, '2018_11_22_095941_create_admins_table', 0),
(55, '2018_11_22_095941_create_categories_table', 0),
(56, '2018_11_22_095941_create_contact_us_table', 0),
(57, '2018_11_22_095941_create_customers_table', 0),
(58, '2018_11_22_095941_create_favorites_table', 0),
(59, '2018_11_22_095941_create_products_table', 0),
(60, '2018_11_22_095941_create_purchases_table', 0),
(61, '2018_11_22_095941_create_ratings_table', 0),
(62, '2018_11_22_095941_create_soldouts_table', 0),
(63, '2018_11_22_095941_create_users_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nid` int(30) NOT NULL,
  `notify_for` varchar(30) NOT NULL,
  `notify_forid` int(30) NOT NULL,
  `notify_of` varchar(30) NOT NULL,
  `notify_ofid` int(30) NOT NULL,
  `notify_type` varchar(30) NOT NULL,
  `notify_by` varchar(50) NOT NULL,
  `notify_title` varchar(100) NOT NULL,
  `notify_dtls` varchar(255) NOT NULL,
  `notify_to` varchar(30) NOT NULL,
  `notify_time` varchar(30) NOT NULL,
  `notify_date` varchar(30) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `uid` int(30) DEFAULT NULL,
  `pid` int(30) DEFAULT NULL,
  `prid` int(30) DEFAULT NULL,
  `soid` int(30) DEFAULT NULL,
  `fid` int(30) DEFAULT NULL,
  `rid` int(30) DEFAULT NULL,
  `cmntid` int(30) DEFAULT NULL,
  `msgid` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`nid`, `notify_for`, `notify_forid`, `notify_of`, `notify_ofid`, `notify_type`, `notify_by`, `notify_title`, `notify_dtls`, `notify_to`, `notify_time`, `notify_date`, `status`, `uid`, `pid`, `prid`, `soid`, `fid`, `rid`, `cmntid`, `msgid`) VALUES
(2, 'Product', 1, 'Comment', 14, 'Report', 'nobo', 'Report on a Comment of Product : Full T-Shirt', 'nobo has reported a comment of alex for Product : Full T-Shirt', 'Admin', '16:22:32', 'Nov 24, 2018', 'unchecked', NULL, 1, NULL, NULL, NULL, NULL, 14, NULL),
(3, 'Product', 10, 'Comment', 9, 'Report', 'nobo', 'Report on a Comment', 'nobo has reported a comment of fizz for Product : csdfsdfsd', 'Admin', '17:15:19', 'Nov 24, 2018', 'unchecked', NULL, 10, NULL, NULL, NULL, NULL, 9, NULL),
(4, 'Product', 31, 'Product', 31, 'StockOut', 'System', 'Out of Stock', 'Product \'kijjtyjhtyhyr\' is out of Stock!', 'Admin', '10:13:11', 'Nov 25, 2018', 'unchecked', NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Product', 32, 'Comment', 32, 'Report', 'fizz', 'Report on a Comment', 'fizz has reported a comment of nobo for Product : Blazer', 'Admin', '12:37:54', 'Nov 27, 2018', 'unchecked', NULL, 32, NULL, NULL, NULL, NULL, 32, NULL),
(6, 'Product', 33, 'Comment', 36, 'Report', 'fizz', 'Report on a Comment', 'fizz has reported a comment of nobo for Product : Pant', 'Admin', '15:41:39', 'Nov 27, 2018', 'unchecked', NULL, 33, NULL, NULL, NULL, NULL, 36, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(30) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `pfor` varchar(30) NOT NULL,
  `size` varchar(30) NOT NULL,
  `available` int(30) NOT NULL,
  `xs_available` int(30) DEFAULT NULL,
  `s_available` int(30) DEFAULT NULL,
  `m_available` int(30) DEFAULT NULL,
  `l_available` int(30) DEFAULT NULL,
  `xl_available` int(30) DEFAULT NULL,
  `xxl_available` int(30) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `price` int(30) NOT NULL,
  `currency` varchar(30) NOT NULL,
  `cost` int(30) NOT NULL,
  `offer` int(30) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `category`, `pfor`, `size`, `available`, `xs_available`, `s_available`, `m_available`, `l_available`, `xl_available`, `xxl_available`, `rating`, `price`, `currency`, `cost`, `offer`, `image`) VALUES
(32, 'Blazer', 'casual blazer', 'Men', 'XS,S,M,L,XL,XXL', 25, 10, 3, 0, 4, 0, 8, 3.66667, 5000, 'Taka', 4000, 5, NULL),
(33, 'Pant', 'Pants & Trousers', 'Men', 'XS,S,M,L,XL,XXL', 68, 12, 12, 12, 12, 8, 12, 5, 1500, 'Taka', 1200, NULL, NULL),
(34, 'Shirt', 'Full Sleeve Shirt', 'Men', 'XS,S,M,L,XL,XXL', 20, 4, 0, 4, 4, 4, 4, 4, 1000, 'Taka', 800, 2, NULL),
(35, 'Punjabi', 'Panjabi & Pajama', 'Men', 'XS,S,M,L,XL,XXL,', 39, 7, 7, 4, 7, 7, 7, 3, 2500, 'Taka', 2000, 15, NULL),
(36, 'Kurti', 'Kurtis & Tunics', 'Women', 'XS,S,M,L,XL,XXL', 14, 3, 3, 0, 3, 2, 3, NULL, 5000, 'Taka', 4500, 3, NULL),
(37, 'Baby dress', 'Baby item', 'Child', 'XS,S,M,L,XL,XXL', 12, 3, 0, 3, 3, 3, 3, NULL, 1500, 'Taka', 1200, 3, NULL),
(38, 'Baby Salwar', 'Baby item', 'Child', 'XS,S,M,L,XL,XXL', 18, 3, 3, 3, 3, 3, 3, NULL, 1200, 'Taka', 1000, 4, NULL),
(39, 'Salwar Kameez', 'Salwar Kamiz', 'Women', 'XS,S,M,L,XL,XXL,', 32, 1, 7, 7, 3, 7, 7, 5, 5000, 'Taka', 4500, NULL, NULL),
(40, 'Saree', 'Shari', 'Women', 'XS,S,M,L,XL,XXL', 30, 5, 5, 5, 5, 5, 5, NULL, 4000, 'Taka', 3800, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `prid` int(30) NOT NULL,
  `pid` int(30) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `pfor` varchar(30) NOT NULL,
  `size` varchar(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` int(30) NOT NULL,
  `cost` int(30) DEFAULT NULL,
  `offer` int(30) DEFAULT NULL,
  `currency` varchar(30) NOT NULL,
  `purchasedby` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `purchasedmethod` varchar(30) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `totalprice` int(30) NOT NULL,
  `image` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`prid`, `pid`, `pname`, `category`, `pfor`, `size`, `quantity`, `price`, `cost`, `offer`, `currency`, `purchasedby`, `date`, `purchasedmethod`, `phonenumber`, `address`, `totalprice`, `image`) VALUES
(124, 32, 'Blazer', 'casual blazer', 'Men', 'M', 3, 4750, 4000, 5, 'Taka', 'mzsmunna', '2018-11-27', 'Home Delivary', '01744692979', 'Dakkhin Chalabon, Uttara, Dhaka, Bangladesh', 14250, NULL),
(125, 32, 'Blazer', 'casual blazer', 'Men', 'XL', 10, 4750, 4000, 5, 'Taka', 'mzsmunna', '2018-11-27', 'Home Delivary', '01744692979', 'Dakkhin Chalabon, Uttara, Dhaka, Bangladesh', 47500, NULL),
(126, 32, 'Blazer', 'casual blazer', 'Men', 'XXL', 2, 4750, 4000, 5, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 9500, NULL),
(127, 32, 'Blazer', 'casual blazer', 'Men', 'S', 4, 4750, 4000, 5, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 19000, NULL),
(128, 33, 'Pant', 'Pants & Trousers', 'Men', 'XL', 4, 1500, 1200, 0, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 6000, NULL),
(129, 32, 'Blazer', 'casual blazer', 'Men', 'M', 3, 4750, 4000, 5, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 14250, NULL),
(130, 32, 'Blazer', 'casual blazer', 'Men', 'M', 4, 4750, 4000, 5, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 19000, NULL),
(131, 34, 'Shirt', 'Full Sleeve Shirt', 'Men', 'S', 4, 980, 800, 2, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 3920, NULL),
(132, 32, 'Blazer', 'casual blazer', 'Men', 'L', 3, 4750, 4000, 5, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 14250, NULL),
(133, 39, 'Salwar Kameez', 'Salwar Kamiz', 'Women', 'L', 4, 5000, 45000, 0, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 20000, NULL),
(134, 32, 'Blazer', 'casual blazer', 'Men', 'L', 3, 4750, 4000, 5, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 14250, NULL),
(135, 36, 'Kurti', 'Kurtis & Tunics', 'Women', 'M', 3, 4850, 4500, 3, 'Taka', 'nobo', '2018-11-27', 'Bikash', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 14550, NULL),
(136, 37, 'Baby dress', 'Baby item', 'Child', 'S', 3, 1455, 1200, 3, 'Taka', 'nobo', '2018-11-27', 'Bikash', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 4365, NULL),
(137, 36, 'Kurti', 'Kurtis & Tunics', 'Women', 'XL', 1, 4850, 4500, 3, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 4850, NULL),
(138, 39, 'Salwar Kameez', 'Salwar Kamiz', 'Women', 'XS', 6, 5000, 45000, 0, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 30000, NULL),
(139, 35, 'Punjabi', 'Panjabi & Pajama', 'Men', 'M', 3, 2125, 2000, 15, 'Taka', 'fizz', '2018-11-27', 'Home Delivary', '23435365464', 'aaaaaaaaaaaaaaaaaad, Chwak Bazar, Chittagong, Bangladesh', 6375, NULL),
(140, 32, 'Blazer', 'casual blazer', 'Men', 'S', 3, 4750, 4000, 5, 'Taka', 'fizz', '2018-11-27', 'Home Delivary', '23435365464', 'aaaaaaaaaaaaaaaaaad, Chwak Bazar, Chittagong, Bangladesh', 14250, NULL),
(141, 37, 'Baby dress', 'Baby item', 'Child', '15', 3, 1455, 1200, 3, 'Taka', 'nobo', '2018-11-27', 'Home Delivary', '01840117914', 'Sector 7, Uttara, Dhaka, Bangladesh', 4365, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rid` int(20) NOT NULL,
  `pid` int(20) NOT NULL,
  `pname` varchar(60) NOT NULL,
  `rating` double NOT NULL,
  `uid` int(20) NOT NULL,
  `username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rid`, `pid`, `pname`, `rating`, `uid`, `username`) VALUES
(1, 1, 'Full T-Shirt', 5, 2, 'nobo'),
(2, 1, 'Full T-Shirt', 1, 3, 'mzs'),
(3, 1, 'Full T-Shirt', 2, 4, 'munna'),
(4, 1, 'Full T-Shirt', 3, 7, 'Thor'),
(5, 1, 'Full T-Shirt', 5, 23, 'alex'),
(6, 10, 'csdfsdfsd', 4, 2, 'nobo'),
(7, 14, 'asdfdsf', 3, 2, 'nobo'),
(8, 19, 'ccrdxh', 1, 2, 'nobo'),
(9, 14, 'asdfdsf', 1, 3, 'mzs'),
(10, 14, 'asdfdsf', 5, 23, 'alex'),
(11, 2, 'Black Shari', 1, 23, 'alex'),
(12, 2, 'Black Shari', 2, 3, 'mzs'),
(13, 23, 'new pro', 3, 3, 'mzs'),
(14, 31, 'kijjtyjhtyhyr', 3, 2, 'nobo'),
(15, 21, 'new panjabi', 3, 2, 'nobo'),
(16, 30, 'child cloth', 3, 2, 'nobo'),
(17, 10, 'csdfsdfsd', 3, 11, 'fizz'),
(18, 32, 'Blazer', 1, 1, 'mzsmunna'),
(19, 32, 'Blazer', 5, 11, 'fizz'),
(20, 32, 'Blazer', 5, 2, 'nobo'),
(21, 33, 'Pant', 5, 2, 'nobo'),
(22, 34, 'Shirt', 4, 2, 'nobo'),
(23, 35, 'Punjabi', 3, 2, 'nobo'),
(24, 39, 'Salwar Kameez', 5, 2, 'nobo');

-- --------------------------------------------------------

--
-- Table structure for table `soldouts`
--

CREATE TABLE `soldouts` (
  `soid` int(30) NOT NULL,
  `pid` int(30) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `pfor` varchar(30) NOT NULL,
  `size` varchar(30) NOT NULL,
  `sold` int(30) NOT NULL,
  `xs_sold` int(30) DEFAULT NULL,
  `s_sold` int(30) DEFAULT NULL,
  `m_sold` int(30) DEFAULT NULL,
  `l_sold` int(30) DEFAULT NULL,
  `xl_sold` int(30) DEFAULT NULL,
  `xxl_sold` int(30) DEFAULT NULL,
  `rating` int(30) DEFAULT NULL,
  `price` int(30) NOT NULL,
  `currency` varchar(30) NOT NULL,
  `cost` int(30) NOT NULL,
  `offer` int(30) DEFAULT NULL,
  `profit` int(30) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soldouts`
--

INSERT INTO `soldouts` (`soid`, `pid`, `pname`, `category`, `pfor`, `size`, `sold`, `xs_sold`, `s_sold`, `m_sold`, `l_sold`, `xl_sold`, `xxl_sold`, `rating`, `price`, `currency`, `cost`, `offer`, `profit`, `image`) VALUES
(1, 26, 'lhjkfghdfs', 'T-Shirt', 'Men', 'XS', 6, 4, 2, NULL, NULL, NULL, NULL, NULL, 1176, 'Taka', 110, 2, 6396, NULL),
(2, 20, 'ashdagshf', 'vdasvgasg', 'Men', 'S', 10, NULL, 10, NULL, NULL, NULL, NULL, NULL, 900, 'Taka', 800, 10, 1000, NULL),
(3, 28, 'DGSFHF', 'SFHFGS', 'Men', 'XS', 10, 5, 5, NULL, NULL, NULL, NULL, NULL, 1176, 'Taka', 1100, 2, 760, NULL),
(5, 25, 'dxgxfgdgd', 'T-Shirt', 'Men', 'XS', 20, 2, 3, 4, 5, 6, NULL, NULL, 425, 'Taka', 300, 15, 2500, NULL),
(6, 24, 'gdfgdfgdsfdfg', 'T-Shirt', 'Men', 'S', 5, NULL, 2, 3, NULL, NULL, NULL, NULL, 800, 'Taka', 800, 20, 0, NULL),
(7, 23, 'new pro', 'jackets', 'Men', 'S', 5, NULL, 2, 3, NULL, NULL, NULL, NULL, 2250, 'Taka', 200, 10, 10250, NULL),
(8, 22, 'grown', 'night wear', 'Women', 'M', 5, NULL, NULL, 2, 3, NULL, NULL, NULL, 9925, 'Taka', 9098, 0, 4135, NULL),
(9, 30, 'child cloth', 'Baby item', 'Child', 'S', 12, NULL, 2, 5, NULL, 5, NULL, NULL, 1439, 'Taka', 1455, 10, -176, NULL),
(10, 21, 'new panjabi', 'panjabi', 'Men', 'M', 10, NULL, NULL, 5, NULL, 5, NULL, NULL, 2125, 'Taka', 1000, 15, 2250, NULL),
(11, 31, 'kijjtyjhtyhyr', 'Dress & Frocks', 'Child', 'M', 7, NULL, NULL, 3, 2, 2, NULL, NULL, 1304, 'Taka', 1234, 3, 350, NULL),
(12, 32, 'Blazer', 'casual blazer', 'Men', 'M', 35, NULL, 7, 10, 6, 10, 2, NULL, 4750, 'Taka', 4000, 5, 6750, NULL),
(13, 33, 'Pant', 'Pants & Trousers', 'Men', 'XL', 4, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1500, 'Taka', 1200, 0, 300, NULL),
(14, 34, 'Shirt', 'Full Sleeve Shirt', 'Men', 'S', 4, NULL, 4, NULL, NULL, NULL, NULL, NULL, 980, 'Taka', 800, 2, 180, NULL),
(16, 36, 'Kurti', 'Kurtis & Tunics', 'Women', 'M', 4, NULL, NULL, 3, NULL, 1, NULL, NULL, 4850, 'Taka', 4500, 3, 700, NULL),
(17, 37, 'Baby dress', 'Baby item', 'Child', 'S', 6, NULL, 3, NULL, NULL, NULL, NULL, NULL, 1455, 'Taka', 1200, 3, 510, NULL),
(18, 35, 'Punjabi', 'Panjabi & Pajama', 'Men', 'M', 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, 2125, 'Taka', 2000, 15, 125, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` varchar(30) DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `profilepic` varchar(255) DEFAULT NULL,
  `accounttype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `gender`, `dob`, `phonenumber`, `country`, `city`, `area`, `address`, `profilepic`, `accounttype`) VALUES
(1, 'mzsmunna', 'mamunuz', 'zaman', 'mzs.munna@gmail.com', '12345', 'Male', '1996-01-28', '01744692979', 'Bangladesh', 'Dhaka', 'Uttara', 'Dakkhin Chalabon', NULL, 'Admin'),
(2, 'nobo', 'nabaranjan', 'niloy', 'noboranjan@gmail.com', '123456', 'Male', '1995-01-13', '01840117914', 'Bangladesh', 'Dhaka', 'Uttara', 'Sector 7', NULL, 'User'),
(3, 'mzs', 'mzs', 'munna', 'mzs.munna@outlook.com', '123', 'male', '1996-01-28', '01744697929', 'Bangladesh', 'Dhaka', 'Uttara Khan', 'xyz', '', 'User'),
(4, 'munna', 'Mzsmunna', 'ffjgikyug', 'mzs.aiub@gmail.com', '123', 'Male', '2018-10-06', '01744682878', 'Bangladesh', 'Dhaka', 'Banani', 'jgchds', '', 'User'),
(5, 'sakib', 'sakib', 'hasan', 'sakib@gmail.com', '1234', 'male', '2018-10-01', '0176586755345', 'Bangladesh', 'Chittagong', 'Agrabad', 'gjfdsdgas', '', 'User'),
(6, 'tamim', 'tamim', 'iqbal', 'tamim@gmail.com', '12345', 'male', '2018-10-14', '017446929798', 'Bangladesh', 'Chittagong', 'Muradpur', 'dgghfggj', '', 'User'),
(7, 'Thor', 'thor', 'thunder', 'thor@gmail.com', '1234', 'male', '2018-10-24', '12345678', 'Bangladesh', 'Chittagong', 'Kazi Dewan Bari', 'ogikyuftyd', '', 'User'),
(8, 'mushi', 'mushfiqur', 'rahim', 'mushi@gmail.com', '1234', 'male', '2018-10-21', '0174498785654', 'Bangladesh', 'Chittagong', 'Khulshi', 'hkhgtrfytr', '', 'User'),
(9, 'mash', 'mash', 'rafi', 'mash@gmail.com', '12345', 'male', '1985-05-29', '0987654432', 'Other', 'Other', 'Other', '', '', 'User'),
(10, 'imrul', 'imrul', 'kayes', 'imrul@gmail.com', '1234', 'male', '2018-10-14', '0987654345678', 'Bangladesh', 'Chittagong', 'Muradpur', '', '', 'User'),
(11, 'fizz', 'mustafizur', 'rahman', 'fizz@gmail.com', '12345', 'male', '1997-03-18', '23435365464', 'Bangladesh', 'Chittagong', 'Chwak Bazar', 'aaaaaaaaaaaaaaaaaad', '', 'User'),
(13, 'dfdsg', 'gdgdfg', 'fgfdgdg', 'xyz@gmail.com', '123', 'male', '', '23435646757', 'Other', 'Other', 'Other', '', '', 'User'),
(14, 'liton', 'liton', 'dash', 'liton@gmail.com', '1234', 'male', '', '565453542', 'Other', 'Other', 'Other', '', '', 'User'),
(15, 'mehedi', 'mehedi', 'meraz', 'mehedi@gmail.com', '123', 'male', '2018-10-08', '01744111000', 'Other', 'Other', 'Other', '', '', 'User'),
(16, 'mular', 'mular', 'mzs', 'mular@gmail.com', '123', 'male', '', '876755443532', 'Other', 'Other', 'Other', '', '', 'User'),
(20, 'toto', 'toto', 'toto', 'toto@gmail.com', '4321', 'male', '', '8329473341', 'Other', 'Other', 'Other', '', '', 'User'),
(21, 'niloy', 'nabaranjan', 'niloy', 'niloy@gmail.com', '123', 'male', '', '07988765323', 'Other', 'Other', 'Other', '', '', 'Admin'),
(22, 'moni', 'moniruzzaman', 'sarker', 'moni@gmail.com', 'moni', 'male', '', '232432732326', 'Bangladesh', 'Dhaka', 'Uttara Khan', 'gkggfyu', '', 'User'),
(23, 'alex', 'alex', 'hales', 'alex@gmail.com', '1234', 'male', '2018-11-13', '01818444666', 'Bangladesh', 'Dhaka', 'Adabor', 'xyz', NULL, 'User'),
(34, 'kabbo', 'sfsdfs', 'sdgsdgsd', 'sdfsdg@sdffs.co', '123', 'male', NULL, NULL, 'Other', 'Other', 'Other', NULL, 'kabbo.png', 'User'),
(35, 'mahi', 'mazeda', 'mahi', 'mahi@gmail.com', '1234', 'female', '2018-11-12', '12345678', 'Bangladesh', 'Dhaka', 'Utttara', 'hdnfdgd', NULL, 'User'),
(36, 'thomas', 'vhst', 'hfdtrd', 'tdyess@vghjh.com', '123456', 'male', '2018-11-14', '8908975645', 'Bangladesh', 'Barishal', 'Mehendiganj', 'gvctydtfg', NULL, 'User'),
(37, 'CFGFGD', 'FSFDS', 'SFSDF', 'sdsfsfds@fgdgd.com', '123', 'male', NULL, NULL, 'Bangladesh', 'Barishal', 'Other', 'hdnfdgd', NULL, 'User'),
(38, 'dfdgdf', 'dsgddfg', 'dsgdsg', 'fdgdhdh@ddfxg.com', '123', 'female', '2018-11-20', '2132444566', 'Bangladesh', 'Dhaka', 'Elephant Road', 'sdsfdfs', NULL, 'User'),
(39, 'khgjghgfh', 'dfdgdg', 'dfgdfgd', 'sdfsfds@vdhvd.com', '123', 'male', NULL, '24235435', 'Bangladesh', 'Rajshahi', 'Not Available', 'hdnfdgd', NULL, 'User'),
(40, 'sfddfg', 'gdfd', 'gdfgdfdg', 'fgdgdg@sfdd.com', '1234', 'male', NULL, '123456789', 'Bangladesh', 'Chittagong', 'Nasirabad Housing Society', 'hdnfdgd', NULL, 'User'),
(41, 'lkghgfh', 'gdfgdfg', 'dfgsdsf', 'dfdsgf@ddfgdfh.com', '1234', 'male', NULL, '123456778', 'Bangladesh', 'Rajshahi', 'Not Available', 'hdnfdgd', NULL, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `admin_name` (`admin_name`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cgid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmntid`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `customer_name` (`customer_name`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pname` (`pname`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`prid`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `soldouts`
--
ALTER TABLE `soldouts`
  ADD PRIMARY KEY (`soid`),
  ADD UNIQUE KEY `pname` (`pname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `aid` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cgid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cmntid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `cus_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `fid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `prid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `soldouts`
--
ALTER TABLE `soldouts`
  MODIFY `soid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
