-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 07:42 PM
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
-- Database: `eventmanagerpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_users`
--

CREATE TABLE `tbl_app_users` (
  `user_id` bigint(20) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 NOT NULL,
  `user_type` tinyint(2) DEFAULT '3' COMMENT '0=Admin ,1=Client, 2=Vendor',
  `User_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=created,1= active,2=deactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_app_users`
--

INSERT INTO `tbl_app_users` (`user_id`, `email`, `password`, `user_type`, `User_status`) VALUES
(1, 'admin@gmail.com', '123456', 1, 1),
(2, 'admin@event.com', '123456', 0, 1),
(6, 'admin1@gmail.com', '123456', 2, 0),
(7, 'ad@gmail.com', '123456', 2, 2),
(8, 'admn@gmail.com', '123456', 2, 0),
(9, 'adminqq@gmail.com', '123456', 2, 1),
(10, 'adm12@gmail.com', '123456', 2, 2),
(11, 'ad111@gmail.com', '1q2w3e', 2, 1),
(12, 'ruhawew@gmail.com', '1q2w3e4r', 2, 2),
(13, 'test@gmail.com', '123456', 2, 1),
(15, 'test@gmail.com', '12345678', 2, 1),
(16, 'ruhccvca@gmail.com', '1234567890', 2, 1),
(17, 'h1@gail.com', '123456', 1, 1),
(18, 'client@gmail.com', '123456', 1, 1),
(19, 'vendor@gmail.com', '123456', 2, 1),
(20, 'www@gmai.coom', '123456', 1, 1),
(21, 'client@user.com', '123456', 1, 1),
(22, 'client@users.com', '123456', 1, 1),
(23, 'vendor@user.com', '123456', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_service`
--

CREATE TABLE `tbl_booking_service` (
  `booking_service_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `vendor_service` int(11) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service_amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0= created, 1 = Accepted, 2 = Rejected',
  `payment_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = not payment, 1 = payment done',
  `payment_method` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0= not select yet, 1 = Hand cash,  2= Online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking_service`
--

INSERT INTO `tbl_booking_service` (`booking_service_id`, `event_id`, `vendor_id`, `client_id`, `vendor_service`, `booking_date`, `service_amount`, `status`, `payment_status`, `payment_method`) VALUES
(1, 2, 6, 1, 5, '2020-05-05 00:00:00', 8000, 0, 0, 0),
(2, 3, 6, 1, 4, '2020-05-05 00:00:00', 5000, 1, 1, 2),
(3, 3, 7, 1, 9, '2020-05-05 00:00:00', 5000, 0, 0, 0),
(4, 4, 5, 3, 7, '2020-05-05 00:00:00', 9000, 0, 0, 0),
(5, 4, 7, 3, 9, '2020-05-05 00:00:00', 5000, 0, 0, 0),
(6, 3, 5, 1, 6, '2020-05-05 00:00:00', 8500, 0, 0, 0),
(7, 2, 7, 1, 8, '2020-05-06 00:00:00', 4000, 0, 0, 0),
(8, 4, 6, 3, 4, '2020-05-06 00:00:00', 5000, 2, 0, 0),
(9, 4, 1, 3, 10, '2020-05-06 00:00:00', 20000, 0, 0, 0),
(10, 7, 7, 7, 9, '2020-05-14 23:28:59', 5000, 0, 0, 0),
(11, 7, 7, 7, 8, '2020-05-14 23:29:33', 4000, 0, 0, 0),
(12, 7, 6, 7, 3, '2020-05-14 23:30:29', 1123, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `phn_number` varchar(128) CHARACTER SET utf8 NOT NULL,
  `address` varchar(128) CHARACTER SET utf8 NOT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1=Male,2=Female',
  `image` varchar(128) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `user_id`, `first_name`, `last_name`, `phn_number`, `address`, `gender`, `image`) VALUES
(1, 1, 'Md. Husam', 'Hosen', '01989898989', 'Mirpur-10', 1, './uploads/client/15880654072.png'),
(3, 17, 'Aas', 'Asss', '1212121212', 'Dhaka', NULL, NULL),
(4, 18, 'Ershadul', 'Bari', '01900999000', 'Dhaka', NULL, NULL),
(5, 20, 'File', 'test', 'hfh', 'vendormail', NULL, NULL),
(6, 21, 'Ershadul', 'Bari', '01651655999', 'Dhaka', NULL, NULL),
(7, 22, 'Ershadul', 'Baritt', '01651222999', 'Dhaka', 1, './uploads/client/1589477673s.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_decoration`
--

CREATE TABLE `tbl_decoration` (
  `decoration_id` bigint(20) NOT NULL,
  `decoration_name` varchar(128) NOT NULL,
  `decoration_description` varchar(1024) NOT NULL,
  `decoration_img` varchar(1024) NOT NULL,
  `decoration_price` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_decoration`
--

INSERT INTO `tbl_decoration` (`decoration_id`, `decoration_name`, `decoration_description`, `decoration_img`, `decoration_price`) VALUES
(6, 'asfsad', 'fsd edfrewrfew', './uploads/decoration/15879715802.png', '121');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `event_id` bigint(20) NOT NULL,
  `event_name` varchar(128) NOT NULL,
  `event_category` bigint(20) NOT NULL COMMENT '1 = coporate, 2 = private, 3 = social',
  `event_type` bigint(20) NOT NULL,
  `event_city` varchar(32) NOT NULL,
  `event_loc` bigint(20) NOT NULL,
  `event_budget` int(32) NOT NULL,
  `event_date` date NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Running, 1= Closed, 2= Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`event_id`, `event_name`, `event_category`, `event_type`, `event_city`, `event_loc`, `event_budget`, `event_date`, `client_id`, `status`) VALUES
(2, 'test', 2, 2, 'dhaka', 1, 12000, '2020-05-28', 1, 1),
(3, 'hello Testing purpose', 2, 1, 'dhaka-1', 2, 21000, '2020-05-08', 1, 0),
(4, 'test', 2, 2, 'dhaka', 2, 80000, '2020-05-20', 1, 0),
(5, 'Latest event', 2, 1, 'Dhaka', 2, 100000, '2020-05-22', 4, 0),
(6, 'My wedding', 2, 2, 'Dhaka', 2, 20000, '2020-05-23', 4, 0),
(7, 'My wedding', 2, 2, 'Dhaka', 2, 20000, '2020-05-16', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_category`
--

CREATE TABLE `tbl_event_category` (
  `event_category_id` bigint(20) NOT NULL,
  `event_category` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_category`
--

INSERT INTO `tbl_event_category` (`event_category_id`, `event_category`) VALUES
(1, 'Corporate'),
(2, 'Private'),
(3, 'Social');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_invitation`
--

CREATE TABLE `tbl_event_invitation` (
  `event_invitation_id` tinyint(4) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `email_address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_invitation`
--

INSERT INTO `tbl_event_invitation` (`event_invitation_id`, `event_id`, `client_id`, `email_address`) VALUES
(1, 3, 1, 'Hardware'),
(2, 3, 1, 'Test'),
(3, 3, 1, 'Testing'),
(4, 3, 1, 'Software'),
(5, 3, 1, 'hello@gmail.com'),
(6, 3, 1, 'ell3.gmail.com'),
(7, 3, 1, 'hello2112@gmail.com'),
(8, 3, 1, 'hello22@gmail.com'),
(9, 3, 1, 'hello212@gmail.com'),
(10, 3, 1, 'hellowq@gmail.com'),
(11, 2, 1, 'hello@gmail.com'),
(12, 2, 1, 'hello2112@gmail.com'),
(13, 2, 1, 'hello22@gmail.com'),
(14, 2, 1, 'hello212@gmail.com'),
(15, 2, 1, 'hellowq@gmail.com'),
(16, 5, 4, 'ershadhusam124@gmail.com'),
(17, 5, 4, '1000514@daffodil.ac'),
(18, 7, 7, 'ershadhusam124@gmail.com'),
(19, 7, 7, '1000514@daffodil.ac');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_todo_list`
--

CREATE TABLE `tbl_event_todo_list` (
  `todo_list_id` tinyint(4) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `todo_desc` varchar(512) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0= not done, 1 = done'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_todo_list`
--

INSERT INTO `tbl_event_todo_list` (`todo_list_id`, `event_id`, `client_id`, `todo_desc`, `status`) VALUES
(3, 3, 1, 'sdsdsdds', 1),
(4, 3, 1, 'sdsddsds', 0),
(5, 3, 1, 'sssssssssssssssssssss', 1),
(6, 3, 1, 'sxxsxdsfe ercfedc', 1),
(7, 2, 1, 'fffvff vfefvfvfv', 1),
(8, 2, 1, 'efrfdf rfvr3fr3', 0),
(9, 2, 1, 'edcdwc efvfevrf', 0),
(10, 2, 1, 'zxcxvvcx fdvfdvf', 0),
(11, 4, 1, 'ddfdsf', 0),
(13, 7, 7, 'Another task', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_type`
--

CREATE TABLE `tbl_event_type` (
  `event_type_id` bigint(20) NOT NULL,
  `event_category_id` bigint(20) NOT NULL,
  `event_type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_type`
--

INSERT INTO `tbl_event_type` (`event_type_id`, `event_category_id`, `event_type`) VALUES
(1, 1, 'Weeding'),
(2, 2, 'Haldi'),
(3, 1, 'Reception'),
(4, 2, 'Birthday'),
(5, 3, 'Engagement');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notification_id` tinyint(5) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `booking_service_id` bigint(20) NOT NULL,
  `message` varchar(1024) NOT NULL,
  `flag` tinyint(5) NOT NULL COMMENT '1 = success, 2 = danger, 3 = warning, 4 = info',
  `time_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view` tinyint(4) NOT NULL COMMENT '1= vendor, 2= client'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`notification_id`, `client_id`, `vendor_id`, `event_id`, `booking_service_id`, `message`, `flag`, `time_date`, `view`) VALUES
(1, 3, 6, 4, 8, 'Your Have a Request of \r\nVendor Service', 1, '2020-05-06 15:56:31', 1),
(2, 3, 1, 4, 9, 'Your Have a Request of Vendor Service', 1, '2020-05-06 16:00:11', 1),
(3, 1, 6, 3, 2, 'Your Vendor Service Request Accepted', 1, '2020-05-06 16:18:14', 2),
(4, 3, 6, 4, 8, 'Your Vendor Service Request Rejected. Choose another one', 2, '2020-05-06 16:18:38', 2),
(5, 1, 6, 3, 2, 'Vendor Service Payment Done', 4, '2020-05-06 21:56:04', 1),
(6, 1, 6, 3, 2, 'Vendor Service Payment Done', 4, '2020-05-06 21:58:53', 1),
(7, 7, 7, 7, 10, 'Your Have a Request of Vendor Service', 1, '2020-05-14 23:28:59', 1),
(8, 7, 7, 7, 11, 'Your Have a Request of Vendor Service', 1, '2020-05-14 23:29:33', 1),
(9, 7, 6, 7, 12, 'Your Have a Request of Vendor Service', 1, '2020-05-14 23:30:29', 1),
(10, 7, 6, 7, 12, 'Your Vendor Service Request Accepted', 1, '2020-05-14 23:32:22', 2),
(11, 7, 6, 7, 12, 'Vendor Service Payment Done', 4, '2020-05-14 23:32:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` bigint(20) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `staff_email` varchar(64) NOT NULL,
  `phn_num` varchar(64) NOT NULL,
  `staff_loc` varchar(128) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '1=Male, 2=Female, 3=Others',
  `expected_salary` varchar(64) NOT NULL,
  `image` varchar(128) NOT NULL,
  `staff_type` tinyint(1) NOT NULL COMMENT '1=fresher, 2=experience',
  `experience` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `full_name`, `staff_email`, `phn_num`, `staff_loc`, `gender`, `expected_salary`, `image`, `staff_type`, `experience`) VALUES
(1, 'hello', 'abc@gmail.com', '01010101', '1', 0, '1000', '', 2, 'hello'),
(2, 'Husam', 'husam@gmail.com', '01010101010', 'Dhanmondi', 0, '1000', '', 2, 'hello'),
(3, 'Husam', 'husam2@gmail.com', '01010101010', 'Dhanmondi', 0, '1000', '', 2, 'hello'),
(4, 'Husam', 'abv@gmail.com', '0101010101', 'Dhanmondi', 0, '1122', '', 2, 'hello'),
(5, 'Md. husam', 'test@gmail.com', '01898282828', 'Dhanmondi', 0, '1000', '', 1, ''),
(9, 'Md. bari ', 'd@gmail.com', '12345567888', '1', 1, '12346', '', 1, 'Hello i am Hello i am Hello i am Hello i am Hello i am Hello i am Hello i am Hello i am Hello i am '),
(10, 'sadsad', 's@gmail.com', '1212121', '3', 1, '1121', '', 2, 'Heloow '),
(11, 'Md. hosen', 'hg@gmail.com', '1212121212', '4', 1, '1212', './uploads/staff/15880194292.png', 1, 'afasr  e er qr resr'),
(12, 'Ershadul Bari', 'erss@gmai.com', '0199919999', '2', 2, '1000', './uploads/staff/1589477852r.jpg', 2, 'I want to work');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_loc`
--

CREATE TABLE `tbl_staff_loc` (
  `staff_loc_id` int(11) NOT NULL,
  `staff_loc` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staff_loc`
--

INSERT INTO `tbl_staff_loc` (`staff_loc_id`, `staff_loc`) VALUES
(1, 'Mohammadpur'),
(2, 'Chawkbazar'),
(3, 'Dhanmondi'),
(4, 'Agargaon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

CREATE TABLE `tbl_vendor` (
  `vendor_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `company_name` varchar(64) NOT NULL,
  `vendor_type` bigint(20) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `phn_num` varchar(64) NOT NULL,
  `sucessful_event` varchar(64) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`vendor_id`, `user_id`, `company_name`, `vendor_type`, `address`, `city`, `phn_num`, `sucessful_event`, `image`) VALUES
(1, 9, 'as', 2, '1q2w', '1q', '0980989898', '1', NULL),
(2, 10, 'sasdad', 2, 'qaws', 'sxs', '123456789098', '25', NULL),
(3, 11, 'sadas', 1, 'qswsw1w', '1w12w', '1234566545443', '1', NULL),
(4, 12, 'sxqwd', 1, 's2w1s12', 'sqxzsxz', '121212121211', '2', NULL),
(5, 13, 'ASSAD', 1, 'qsxqs', 'zqsz', '0909090998', NULL, NULL),
(6, 15, 'Test2', 4, 'dfd tgtreg', 'Dhaka', '01918181818', NULL, './uploads/vendor/1588102192D.jpg'),
(7, 16, 'dssfdsf', 3, 'sf4r42  g', 'sdsf', '009099990090', NULL, NULL),
(8, 19, 'New Vendor', 1, 'Dhanmondi', 'Dhaka', '01659555777', NULL, NULL),
(9, 23, 'Company', 2, 'Dhaka', 'Dhaka', '01999999999', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_service`
--

CREATE TABLE `tbl_vendor_service` (
  `id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `service_name` varchar(128) NOT NULL,
  `service_desc` varchar(1024) NOT NULL,
  `service_img` varchar(512) NOT NULL,
  `service_price` int(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_category` bigint(20) NOT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0=Running, 1= Closed, 2= Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor_service`
--

INSERT INTO `tbl_vendor_service` (`id`, `vendor_id`, `service_name`, `service_desc`, `service_img`, `service_price`, `date`, `event_category`, `status`) VALUES
(3, 6, 'sasadsa', 'zxzc  efef    dfbfdbvfdvsdv wd', './uploads/service/1588148759e.PNG', 1123, '2020-05-03 00:00:00', 3, 0),
(4, 6, 'Lorem ipsum dolor sit amet consectetur.', 'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!', './uploads/service/1588149940e.PNG', 5000, '2020-05-04 00:00:00', 1, 0),
(5, 6, 'orem ipsum dolor sit amet,', 'Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo! Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit', './uploads/service/1588149990n.png', 8000, '2020-04-27 00:00:00', 3, 0),
(6, 5, 'victory day, independence day, farewell parties', 'Click here to see arrangements for different types of social events like martyrs day, victory day, independence day, farewell parties, reunion parties, success celebrations, gala nights, christmas, new year etc.', './uploads/service/15881501112.png', 8500, '2020-05-01 00:00:00', 3, 0),
(7, 5, 'receptions, haldi night, birthday, anniversary,', 'Click here to see arrangements for different types of social events like wedding, receptions, haldi night, birthday, anniversary, engagement party, baby shower, bridal shower etc..', './uploads/service/1588150145.jpeg', 9000, '2020-05-03 00:00:00', 1, 0),
(8, 7, 'arrangements for different types of social', 'Click here to see arrangements for different types of social events like wedding, receptions, haldi night, birthday, anniversary, engagement party, baby shower, bridal shower etc..', './uploads/service/1588150707.jpeg', 4000, '2020-05-01 00:00:00', 1, 0),
(9, 7, 'Hello Date ', 'expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!\r\n\r\nDate: January 2017\r\nClient: Threads\r\nCategory: Illustration', './uploads/service/1588150746n.png', 5000, '2020-05-04 00:00:00', 1, 0),
(10, 1, 'tesing', 'gngcnc', './uploads/service/15886913741.PNG', 20000, '2020-05-05 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_type`
--

CREATE TABLE `tbl_vendor_type` (
  `vendor_type_id` bigint(20) NOT NULL,
  `vendor_name` varchar(128) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor_type`
--

INSERT INTO `tbl_vendor_type` (`vendor_type_id`, `vendor_name`) VALUES
(1, 'Photography'),
(2, 'DJ'),
(3, 'Lighting'),
(4, 'Catering'),
(5, 'Vehicle'),
(6, 'Electronics'),
(7, 'Venue'),
(8, 'Singer'),
(9, 'Performer'),
(10, 'Mascott');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_app_users`
--
ALTER TABLE `tbl_app_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_booking_service`
--
ALTER TABLE `tbl_booking_service`
  ADD PRIMARY KEY (`booking_service_id`),
  ADD KEY `FK_tbl_booking_service_event_id` (`event_id`),
  ADD KEY `FK_tbl_booking_service_vendor_id` (`vendor_id`),
  ADD KEY `FK_tbl_booking_service_client_id` (`client_id`),
  ADD KEY `FK_tbl_booking_service_vendor_service_id` (`vendor_service`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `FK_tbl_client_user_id_tbl_app_users` (`user_id`);

--
-- Indexes for table `tbl_decoration`
--
ALTER TABLE `tbl_decoration`
  ADD PRIMARY KEY (`decoration_id`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `FK_tbl_event_2` (`event_type`),
  ADD KEY `FK_tbl_event_1` (`event_category`),
  ADD KEY `FK3_tbl_event` (`client_id`);

--
-- Indexes for table `tbl_event_category`
--
ALTER TABLE `tbl_event_category`
  ADD PRIMARY KEY (`event_category_id`);

--
-- Indexes for table `tbl_event_invitation`
--
ALTER TABLE `tbl_event_invitation`
  ADD PRIMARY KEY (`event_invitation_id`),
  ADD KEY `FK_tbl_event_invitation_client_id` (`client_id`),
  ADD KEY `FK_tbl_event_invitation_event_id` (`event_id`);

--
-- Indexes for table `tbl_event_todo_list`
--
ALTER TABLE `tbl_event_todo_list`
  ADD PRIMARY KEY (`todo_list_id`),
  ADD KEY `FK_tbl_event_todo_list_client_id` (`client_id`),
  ADD KEY `FK_tbl_event_todo_list_event_id` (`event_id`);

--
-- Indexes for table `tbl_event_type`
--
ALTER TABLE `tbl_event_type`
  ADD PRIMARY KEY (`event_type_id`),
  ADD KEY `FK_tbl_event_type_event_category_id_tbl_event_category` (`event_category_id`) USING BTREE;

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `FK_tbl_notification_client_id` (`client_id`),
  ADD KEY `FK_tbl_notification_vendor_id` (`vendor_id`),
  ADD KEY `FK_tbl_notification_event_id` (`event_id`),
  ADD KEY `FK_tbl_notification_booking_service_id` (`booking_service_id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tbl_staff_loc`
--
ALTER TABLE `tbl_staff_loc`
  ADD PRIMARY KEY (`staff_loc_id`);

--
-- Indexes for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `FK_tbl_vendor_user_id_tbl_app_users` (`user_id`);

--
-- Indexes for table `tbl_vendor_service`
--
ALTER TABLE `tbl_vendor_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_vendor_service_tbl_vendor` (`vendor_id`),
  ADD KEY `tbl_vendor_service_tbl_event_category` (`event_category`);

--
-- Indexes for table `tbl_vendor_type`
--
ALTER TABLE `tbl_vendor_type`
  ADD PRIMARY KEY (`vendor_type_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_app_users`
--
ALTER TABLE `tbl_app_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_booking_service`
--
ALTER TABLE `tbl_booking_service`
  MODIFY `booking_service_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_decoration`
--
ALTER TABLE `tbl_decoration`
  MODIFY `decoration_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `event_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_event_category`
--
ALTER TABLE `tbl_event_category`
  MODIFY `event_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_event_invitation`
--
ALTER TABLE `tbl_event_invitation`
  MODIFY `event_invitation_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_event_todo_list`
--
ALTER TABLE `tbl_event_todo_list`
  MODIFY `todo_list_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_event_type`
--
ALTER TABLE `tbl_event_type`
  MODIFY `event_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notification_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_staff_loc`
--
ALTER TABLE `tbl_staff_loc`
  MODIFY `staff_loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_vendor_service`
--
ALTER TABLE `tbl_vendor_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_booking_service`
--
ALTER TABLE `tbl_booking_service`
  ADD CONSTRAINT `FK_tbl_booking_service_client_id` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `FK_tbl_booking_service_event_id` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`),
  ADD CONSTRAINT `FK_tbl_booking_service_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`),
  ADD CONSTRAINT `FK_tbl_booking_service_vendor_service_id` FOREIGN KEY (`vendor_service`) REFERENCES `tbl_vendor_service` (`id`);

--
-- Constraints for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD CONSTRAINT `FK_tbl_client_user_id_tbl_app_users` FOREIGN KEY (`user_id`) REFERENCES `tbl_app_users` (`user_id`);

--
-- Constraints for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD CONSTRAINT `FK3_tbl_event` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `FK_tbl_event_1` FOREIGN KEY (`event_category`) REFERENCES `tbl_event_category` (`event_category_id`),
  ADD CONSTRAINT `FK_tbl_event_2` FOREIGN KEY (`event_type`) REFERENCES `tbl_event_type` (`event_type_id`);

--
-- Constraints for table `tbl_event_invitation`
--
ALTER TABLE `tbl_event_invitation`
  ADD CONSTRAINT `FK_tbl_event_invitation_client_id` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `FK_tbl_event_invitation_event_id` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`);

--
-- Constraints for table `tbl_event_todo_list`
--
ALTER TABLE `tbl_event_todo_list`
  ADD CONSTRAINT `FK_tbl_event_todo_list_client_id` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `FK_tbl_event_todo_list_event_id` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`);

--
-- Constraints for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD CONSTRAINT `FK_tbl_notification_booking_service_id` FOREIGN KEY (`booking_service_id`) REFERENCES `tbl_booking_service` (`booking_service_id`),
  ADD CONSTRAINT `FK_tbl_notification_client_id` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `FK_tbl_notification_event_id` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`),
  ADD CONSTRAINT `FK_tbl_notification_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`);

--
-- Constraints for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  ADD CONSTRAINT `FK_tbl_vendor_user_id_tbl_app_users` FOREIGN KEY (`user_id`) REFERENCES `tbl_app_users` (`user_id`);

--
-- Constraints for table `tbl_vendor_service`
--
ALTER TABLE `tbl_vendor_service`
  ADD CONSTRAINT `tbl_vendor_service_tbl_event_category` FOREIGN KEY (`event_category`) REFERENCES `tbl_event_category` (`event_category_id`),
  ADD CONSTRAINT `tbl_vendor_service_tbl_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
