-- phpMyAdmin SQL Dump
-- version 4.6.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql.signly.com
-- Generation Time: Aug 11, 2017 at 03:59 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signlydb5000`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_proposal`
--

CREATE TABLE `active_proposal` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `instance_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_proposal`
--

INSERT INTO `active_proposal` (`id`, `proposal_id`, `created_at`, `updated_at`, `user_id`, `instance_id`) VALUES
(51, 24, '2016-02-29 09:17:12', '0000-00-00 00:00:00', 1, 0),
(55, 38, '2016-03-1 03:02:19', '0000-00-00 00:00:00', 9, 0),
(150, 83, '2017-02-06 18:17:13', '0000-00-00 00:00:00', 7, 0),
(187, 101, '2017-07-18 02:07:52', '0000-00-00 00:00:00', 17, 0),
(189, 88, '2017-08-04 22:30:30', '0000-00-00 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `active_proposal_billboards`
--

CREATE TABLE `active_proposal_billboards` (
  `id` int(11) NOT NULL,
  `active_proposal_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `billboard_face_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proposal_price` double NOT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_proposal_billboards`
--

INSERT INTO `active_proposal_billboards` (`id`, `active_proposal_id`, `proposal_id`, `billboard_id`, `billboard_face_id`, `user_id`, `proposal_price`, `instance_id`) VALUES
(134, 150, 83, 86, 113, 7, 600, 0),
(139, 150, 83, 81, 103, 7, 200, 0),
(140, 150, 83, 81, 104, 7, 200, 0),
(339, 187, 101, 118, 149, 17, 400, 0),
(340, 187, 101, 122, 158, 17, 100, 0),
(341, 187, 101, 121, 155, 17, 150, 0),
(342, 187, 101, 124, 161, 17, 375, 0),
(346, 189, 88, 80, 101, 2, 1, 0),
(347, 189, 88, 84, 109, 2, 1, 0),
(348, 189, 88, 85, 112, 2, 1, 0),
(349, 189, 88, 82, 106, 2, 1, 0),
(350, 189, 88, 88, 117, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `billboard`
--

CREATE TABLE `billboard` (
  `id` int(11) NOT NULL,
  `billboard_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `city` text COLLATE utf8_bin NOT NULL,
  `state` text COLLATE utf8_bin NOT NULL,
  `zipcode` text COLLATE utf8_bin NOT NULL,
  `billboard_image_id` int(11) NOT NULL,
  `rate` decimal(10,0) NOT NULL,
  `digital_driveby` text COLLATE utf8_bin NOT NULL,
  `lat` varchar(100) COLLATE utf8_bin NOT NULL,
  `lng` varchar(100) COLLATE utf8_bin NOT NULL,
  `hard_cost` decimal(10,0) NOT NULL,
  `monthly_impressions` decimal(10,0) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `billboard`
--

INSERT INTO `billboard` (`id`, `billboard_id`, `owner_id`, `name`, `description`, `address`, `city`, `state`, `zipcode`, `billboard_image_id`, `rate`, `digital_driveby`, `lat`, `lng`, `hard_cost`, `monthly_impressions`, `created_at`, `updated_at`, `deleted_at`, `instance_id`) VALUES
(80, '', 3, 'Centerville (Parrish)', '', '960 N 950 W Centerville, UT 84014', '', '', '', 0, '0', '', '40.928862', '-111.89266900000001', '2150', '155300', NULL, NULL, NULL, 0),
(81, '', 3, '3300 South 355 E', '', '3300 South 355 East, Salt Lake City, UT 84115', '', '', '', 0, '0', '', '40.69984970000001', '-111.8809402', '400', '155300', NULL, NULL, NULL, 0),
(82, '', 3, '3900 SOUTH Street', '', '3900 South 500 West Salt Lake City, UT 84123', '', '', '', 0, '0', '', '40.6609843', '-111.91647790000002', '900', '52550', NULL, NULL, NULL, 0),
(83, '', 3, 'I-1 5000', '', '4892 Commerce Dr Murray, UT 84107', '', '', '', 0, '0', '', '40.6649616', '-111.89993300000003', '3300', '309550', NULL, NULL, NULL, 0),
(84, '', 3, 'Ft. Union', '', '6985 De Ville Dr E Cottonwood Heights, UT 84121', '', '', '', 0, '0', '', '40.6242375', '-111.83710050000002', '1500', '78225', NULL, NULL, NULL, 0),
(85, '', 3, 'Lindon Digital', '', '426 N Frontage Rd Lindon, UT 84042', '', '', '', 0, '0', '', '40.34491', '-111.75858399999998', '2150', '240200', NULL, NULL, NULL, 0),
(86, '', 3, 'I-1 Springville (North)', '', '1575-1699 E 4800 S St Springville, UT 84663', '', '', '', 0, '0', '', '40.1445662', '-111.64375010000003', '800', '67225', NULL, NULL, NULL, 0),
(87, '', 3, 'I-1 Springville (South)', '', '792 E 4800 S Spanish Fork, UT 84660', '', '', '', 0, '0', '', '40.143697', '-111.63870199999997', '900', '67225', NULL, NULL, NULL, 0),
(88, '', 3, 'I-1 4300 South', '', '4150 Commerce Dr Murray, UT 84107', '', '', '', 0, '0', '', '40.681435', '-111.90031299999998', '3350', '150000', NULL, NULL, NULL, 0),
(89, '', 3, '3900 South Digital', '', '411-425 W 3900 S Salt Lake City, UT 84115', '', '', '', 0, '0', '', '40.6866964', '-111.90330169999999', '3000', '304027', NULL, NULL, NULL, 0),
(90, '', 2, '30 Sheet - 513 West 24th', '', '513 WEST 24TH ST, Ogden, UT', '', '', '', 0, '0', '', '41.2229845', '-111.99024680000002', '750', '100000', NULL, NULL, NULL, 0),
(91, '', 2, '30 Sheet - 247 WEST 31ST', '', '247 WEST 31ST, Ogden, UT', '', '', '', 0, '0', '', '41.2082957', '-111.98227559999998', '750', '100000', NULL, NULL, NULL, 0),
(92, '', 2, '30 Sheet - 1775 WEST RIVERDALE RD', '', '1775 WEST RIVERDALE RD, Roy, UT', '', '', '', 0, '0', '', '41.168823', '-112.0232795', '750', '100000', NULL, NULL, NULL, 0),
(93, '', 2, '30 Sheet - 1484 NORTH MAIN ST', '', '1484 NORTH MAIN ST, Layton, UT', '', '', '', 0, '0', '', '41.0816443', '-111.99080079999999', '750', '100000', NULL, NULL, NULL, 0),
(95, '', 2, '30 Sheet - 1801 NORTH BECK ST', '', '1801 NORTH BECK ST, Salt Lake City, UT', '', '', '', 0, '0', '', '40.8062152', '-111.91793039999999', '750', '100000', NULL, NULL, NULL, 0),
(96, '', 2, '30 Sheet - 6022 SOUTH 1900 WEST', '', '6022 SOUTH 1900 WEST, Roy, UT', '', '', '', 0, '0', '', '41.154271', '-112.02560740000001', '750', '100000', NULL, NULL, NULL, 0),
(97, '', 2, '30 Sheet - 500 WEST 600 NORTH', '', '500 WEST 600 NORTH, Salt Lake City, UT', '', '', '', 0, '0', '', '40.7824108', '-111.9052206', '750', '100000', NULL, NULL, NULL, 0),
(98, '', 2, '30 Sheet - 3060 SOUTH REDWOOD RD', '', '3060 SOUTH REDWOOD RD, West Valley, UT', '', '', '', 0, '0', '', '40.7045586', '-111.9394752', '750', '1000000', NULL, NULL, NULL, 0),
(99, '', 2, '30 Sheet - 204 WEST 2100 SOUTH', '', '204 WEST 2100 SOUTH, Salt Lake City, UT', '', '', '', 0, '0', '', '40.7257561', '-111.89716470000002', '750', '100000', NULL, NULL, NULL, 0),
(100, '', 2, '30 Sheet - 150 EAST 3900 SOUTH', '', '150 EAST 3900 SOUTH, Millcreek, UT', '', '', '', 0, '0', '', '40.6870621', '-111.8867515', '750', '100000', NULL, NULL, NULL, 0),
(101, '', 2, '30 Sheet - 5051 SOUTH I-1', '', '5062 Commerce Dr, Murray, UT', '', '', '', 0, '0', '', '40.66164', '-111.90020900000002', '750', '100000', NULL, NULL, NULL, 0),
(102, '', 2, '30 Sheet - 4100 SOUTH 3900 WEST', '', '4100 SOUTH 3900 WEST, West Valley, UT', '', '', '', 0, '0', '', '40.6740205', '-111.98469239999997', '750', '100000', NULL, NULL, NULL, 0),
(103, '', 2, '30 Sheet - 7400 SOUTH 900 EAST', '', '7400 SOUTH 900 EAST, Midvale, UT', '', '', '', 0, '0', '', '40.6166251', '-111.86675550000001', '750', '100000', NULL, NULL, NULL, 0),
(104, '', 2, '30 Sheet - 8290 SOUTH STATE ST', '', '8290 SOUTH STATE ST, Sandy, UT', '', '', '', 0, '0', '', '40.6009319', '-111.89080509999997', '750', '100000', NULL, NULL, NULL, 0),
(105, '', 2, '30 Sheet - 4571 SOUTH 5600 WEST', '', '4571 SOUTH 5600 WEST, West Valley, UT', '', '', '', 0, '0', '', '40.6711436', '-112.02470340000002', '750', '100000', NULL, NULL, NULL, 0),
(106, '', 2, '30 Sheet - 59 WEST MAIN ST', '', '59 WEST MAIN ST, American Fork, UT', '', '', '', 0, '0', '', '40.3766001', '-111.80008759999998', '750', '100000', NULL, NULL, NULL, 0),
(107, '', 2, '30 Sheet - 495 NORTH GENEVA RD', '', '495 NORTH GENEVA RD, Lindon, UT', '', '', '', 0, '0', '', '40.3468362', '-111.74076809999997', '750', '100000', NULL, NULL, NULL, 0),
(108, '', 2, '30 Sheet - 300 NORTH I-1', '', '1301 400 North, Orem, UT', '', '', '', 0, '0', '', '40.30406259999999', '-111.72657859999998', '750', '100000', NULL, NULL, NULL, 0),
(109, '', 2, '30 Sheet - 1315 NORTH STATE ST', '', '1315 NORTH STATE ST, Provo, UT', '', '', '', 0, '0', '', '40.2516114', '-111.66885739999998', '750', '100000', NULL, NULL, NULL, 0),
(110, '', 2, '30 Sheet - 1004 EAST 1860 SOUTH', '', '1004 EAST 1860 SOUTH, Ironton, UT', '', '', '', 0, '0', '', '40.200392', '-111.62620049999998', '750', '100000', NULL, NULL, NULL, 0),
(111, '', 4, '59 WEST MAIN ST', '', '59 WEST MAIN ST, American Fork, UT', '', '', '', 0, '0', '', '40.3766001', '-111.80008759999998', '3500', '180000', NULL, NULL, NULL, 0),
(116, '', 5, '6325 Newark Rd.', '', '6325 Newark Rd. Nashport, OH, 43830', '', '', '', 0, '0', '', '40.03128359999999', '-82.10630270000001', '375', '9280', NULL, NULL, NULL, 2),
(117, '', 5, '16325 Millersburg Rd.', '', '16325 Millersburg Rd, Danville, OH 43014', '', '', '', 0, '0', '', '40.464829', '-82.206117', '200', '2060', NULL, NULL, NULL, 2),
(118, '', 5, '10019 Jacksontown Rd', '', '10019 Jacksontown Rd, Thornville, OH 43076', '', '', '', 0, '0', '', '39.948191', '-82.40675999999996', '400', '9087', NULL, NULL, NULL, 2),
(119, '', 5, '10019 Jacksontown Rd #2', '', '10019 Jacksontown Rd, Thornville, OH 43076', '', '', '', 0, '0', '', '39.948191', '-82.40675999999996', '300', '9087', NULL, NULL, NULL, 2),
(120, '', 5, '2865 Millersburg Rd', '', '2865 Millersburg Rd, Martinsburg, OH 43037', '', '', '', 0, '0', '', '40.270478', '-82.35977300000002', '150', '3870', '2017-07-12 00:00:00', NULL, NULL, 2),
(121, '', 5, '5420 Fallsburg Rd', '', '5420 Fallsburg Rd NE, Newark, OH 43055', '', '', '', 0, '0', '', '40.120396', '-82.34985389999997', '150', '4380', '2017-07-12 00:00:00', NULL, NULL, 2),
(122, '', 5, '5357 OH-95', '', '5357 OH-95, Mt Gilead, OH 43338', '', '', '', 0, '0', '', '40.5236244', '-82.7538601', '125', '6380', '2017-07-13 00:00:00', NULL, NULL, 2),
(123, '', 5, '7757 State RT 13', '', '7757 State RT 13 Bellville, OH 43338', '', '', '', 0, '0', '', '40.550818', '-82.53906699999999', '150', '4380', '2017-07-13 00:00:00', NULL, NULL, 2),
(124, '', 5, '1330 Johnstown Utica Rd.', '', '1330 Johnstown Utica Rd. Utica, OH 43080', '', '', '', 0, '0', '', '40.22707279999999', '-82.52446270000002', '375', '9840', '2017-07-13 00:00:00', NULL, NULL, 2),
(125, '', 5, '347 S Main St', '', '347 S Main St, Utica, OH 43080', '', '', '', 0, '0', '', '40.2286307', '-82.45208109999999', '375', '8150', '2017-07-13 00:00:00', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `billboard_faces`
--

CREATE TABLE `billboard_faces` (
  `id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `unique_id` varchar(15) COLLATE utf8_bin NOT NULL,
  `height` float NOT NULL DEFAULT '0',
  `width` float NOT NULL DEFAULT '0',
  `reads` varchar(50) COLLATE utf8_bin NOT NULL,
  `label` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'north east sout west custom',
  `digital_driveby` text COLLATE utf8_bin,
  `sign_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 for static 1 for digital',
  `hard_cost` float NOT NULL DEFAULT '0',
  `monthly_impressions` float NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8_bin NOT NULL,
  `max_ads` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `photo` text COLLATE utf8_bin NOT NULL,
  `owner_id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='billboard faces for each billboard view';

--
-- Dumping data for table `billboard_faces`
--

INSERT INTO `billboard_faces` (`id`, `billboard_id`, `unique_id`, `height`, `width`, `reads`, `label`, `digital_driveby`, `sign_type`, `hard_cost`, `monthly_impressions`, `notes`, `max_ads`, `duration`, `photo`, `owner_id`, `instance_id`) VALUES
(101, 80, '1', 12, 40, 'right', 'NORTH', '', 0, 2150, 155300, 'I-1 CENTERVILLE NF RR', 0, 0, '8b1c1d45b5e7e51ba846899d047b020a.jpg', 0, 0),
(102, 80, '2', 12, 40, 'cross', 'SOUTH', '', 0, 2150, 155300, 'I-1 CENTERVILLE SF LR', 0, 0, '3cf55c54363bdcd4b98b7e16071baf9c.jpg', 0, 0),
(103, 81, '11', 12, 24, 'cross', 'WEST', '', 0, 400, 155300, '3300 S 355 E WF LR', 0, 0, '039ca2b69344659e669bca89781b22e1.jpg', 0, 0),
(104, 81, '12', 12, 24, 'right', 'EAST', '', 0, 400, 155300, '3300 S 355 E EF RR', 0, 0, '3f1ceaf151157175d230306ccd73b9a8.jpg', 0, 0),
(105, 82, '13', 12, 30, 'right', 'WEST', '', 0, 900, 52550, '3900 S 500 W WF RR', 0, 0, '57f7487b7b76aa116ebdcc9cec377997.jpg', 0, 0),
(106, 82, '1', 12, 24, 'cross', 'EAST', '', 0, 900, 52550, '3900 S 500 W EF LR', 0, 0, '6c39a2bf00f1d6b4c6c31b5a4b6616bf.jpg', 0, 0),
(107, 83, '16', 14, 48, 'right', 'NORTH', '', 0, 3300, 309550, 'I-1 5000 S NF RR', 0, 0, 'fd04e5e04fab8740b4e41ff6abce482a.jpg', 0, 0),
(108, 83, '1', 14, 48, 'cross', 'SOUTH', '', 0, 3300, 309550, 'I-1 5000 S SF LR', 0, 0, 'cc6730ed59b26e1f8249fba5c54db4a8.jpg', 0, 0),
(109, 84, '17', 14, 48, 'cross', 'EAST', '', 0, 1500, 78225, '1912 FT UNION EF LR', 0, 0, '591fed5ecfee2e20dceb52158ff42fe6.jpg', 0, 0),
(110, 84, '18', 14, 48, 'right', 'WEST', '', 0, 1500, 78225, '1912 FT UNION WF RR', 0, 0, '7fb35cd78345d02433dd47f862a2f80f.jpg', 0, 0),
(111, 85, '19', 14, 48, 'cross', 'NORTH', '', 1, 2150, 240200, 'I-1 Lindon (Digital) NF LR', 7, 8, '4c8fe74976c5f70d0d32cc229f4865fc.jpg', 0, 0),
(112, 85, '20', 14, 48, 'right', 'SOUTH', '', 1, 2150, 240200, 'I-1 Lindon (Digital) SF RR', 7, 8, '6c84c8fe2fcfb0bfb5b1c38ed36c0b33.jpg', 0, 0),
(113, 86, '21', 14, 48, 'cross', 'NORTH', '', 0, 800, 67225, 'I-1 N SPRINGVILLE NF LR', 0, 0, '280b525a64a4fdc655f4b600d7a66b73.jpg', 0, 0),
(114, 86, '22', 14, 48, 'right', 'SOUTH', '', 0, 800, 67225, 'I-1 N SPRINGVILLE SF RR', 0, 0, '5177a0ed77ec46d11fb7cfc975aa3eb5.jpg', 0, 0),
(115, 87, '23', 14, 48, 'cross', 'NORTH', '', 0, 900, 67225, 'I-1 N SPRINGVILLE NF LR', 0, 0, 'a62c49b37fd94cd945a293ce1d485408.jpg', 0, 0),
(116, 87, '24', 14, 48, 'right', 'SOUTH', '', 0, 900, 67225, 'I-1 N SPRINGVILLE SF RR', 0, 0, 'fe5f9494ba72bb7f1c4e4b8d8bb37dbb.jpg', 0, 0),
(117, 88, '37', 14, 48, 'cross', 'NORTH', '', 0, 3350, 150000, 'I-1 4300 S NF LR', 0, 0, 'a33c889cb5d7cb541b9be54452c72b88.jpg', 0, 0),
(118, 89, '39', 14, 48, 'cross', 'SOUTH', '', 1, 3000, 304027, 'I-1 3900 South (Digital) SF LR', 7, 8, '3fe2bc5fbe581ccf6a2396e2b0aef32f.jpg', 0, 0),
(119, 90, '69', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '69', 0, 0, '2db92cce3f774b8b4d7595fe20155be6.jpeg', 0, 0),
(120, 91, '97', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '97', 0, 0, '7723c06dc728b81102c3ddaac042f9b1.jpeg', 0, 0),
(121, 92, '115', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '115', 0, 0, 'a6fbcf4ce7713e477c125d9383e077e3.jpg', 0, 0),
(122, 93, '279', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '279', 0, 0, '5523842810ffa6597b47753c801a182b.jpg', 0, 0),
(124, 95, '00326A', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '00326A', 0, 0, '732e53a00cf337fb0cd31cdefb315333.jpg', 0, 0),
(125, 96, '285', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '285', 0, 0, '86bb220b22a91a2ef0ee8199851c3c50.jpg', 0, 0),
(126, 97, '426', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '426', 0, 0, '997a674b8d344bf6f9210b3116ae2da0.jpg', 0, 0),
(127, 98, '498', 10, 20, 'right', 'SOUTH', '', 0, 750, 1000000, '498', 0, 0, '3ddaec3c81c7f8fdf150bb7f36ee989e.jpg', 0, 0),
(128, 99, '547', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '547', 0, 0, '97f834ceedb5d696379c61ecb20aae7d.jpg', 0, 0),
(129, 100, '676', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '676', 0, 0, 'cec3d2c8d8d7c496f0f5936db0144c71.jpg', 0, 0),
(130, 101, '768', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '768', 0, 0, '37df0be68b3b075b47ae84addec4f745.jpg', 0, 0),
(131, 102, '807', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '807', 0, 0, '73dc2f11f5524721d235ae29c7cbec3b.jpg', 0, 0),
(132, 103, '914', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '914', 0, 0, 'bbc9393899d0c0ec6005309d309570e9.jpg', 0, 0),
(133, 104, '929', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '929', 0, 0, '9196d8045e9fa5e9b65f5aaead32e0ab.jpg', 0, 0),
(134, 105, '999', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '999', 0, 0, '18acc8f139577f8a7508fac9a0da02f0.jpg', 0, 0),
(135, 106, '1011', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '1011', 0, 0, 'cbc51a58a1638b860d7c73ffb67fb0dd.jpg', 0, 0),
(136, 107, '1030', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '1030', 0, 0, '59c2a45dcc4231d7e781877d65dc6c0a.jpg', 0, 0),
(137, 108, '1041', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '1041', 0, 0, '8d84039ba3cb57bffe4cb37ba5a3625f.jpg', 0, 0),
(138, 109, '1099', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '1099', 0, 0, '836517606a23025c666fad553c622148.jpg', 0, 0),
(139, 110, '1166', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '1166', 0, 0, '82c426689a22d67d9a82a1fa3d4864e8.jpg', 0, 0),
(140, 111, '1', 10, 30, 'right', 'NORTH', '', 0, 3500, 180000, 'On the frontage road.', 0, 0, 'd23ec2141bf516829205be1115c1ee1c.jpg', 0, 0),
(145, 116, '1', 11, 22, 'right', 'NORTH', '', 0, 375, 9280, '$350 1 year Contract\r\n$375 6 Months Or Less Contract', 0, 0, '65f819db7c3ef715b4e9b35fa3d4010c.png', 0, 0),
(146, 116, '1-South', 11, 22, 'cross', 'SOUTH', '', 0, 375, 9280, '$350 1 year Contract\r\n$375 6 Months Or Less Contract', 0, 0, '60ab84b01543e91180ee67cf5035b39a.jpg', 0, 0),
(147, 117, '2-East', 12, 24, 'right', 'EAST', '', 0, 200, 2060, '$175/month- 1 Year Contract\r\n$200/month- 6 Months Or Less Contract', 0, 0, '8e4cc17877f783bb929e25d28f09694c.png', 0, 0),
(148, 117, '2-West', 12, 24, 'cross', 'WEST', '', 0, 200, 2060, '$175/month- 1 Year Contract\r\n$200/month- 6 Months Or Less Contract', 0, 0, '6b4cf459f4fd24e118c770f204938036.jpg', 0, 0),
(149, 118, '3-Right', 10, 30, 'right', 'NORTH', '', 0, 400, 9087, '$350/month- 1 Year Contract\r\n$400/month- 6 Months Or Less Contract', 0, 0, '0598bf2d04ffc2245ea0d713025419bf.png', 0, 0),
(150, 118, '3-South', 10, 30, 'cross', 'SOUTH', '', 0, 400, 9087, '$350/month- 1 Year Contract\r\n$400/month- 6 Months Or Less Contract', 0, 0, '71df9c15db8feb032c994f4a41667a6d.png', 0, 0),
(151, 119, '4-North', 10, 30, 'right', 'NORTH', '', 0, 300, 9087, 'Monthly Rate\r\n$275/month- 1 Year Contract\r\n$300/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$230 (one time charge)', 0, 0, 'a6201ff47ee2a343e065bc57f3716fe0.jpg', 0, 0),
(152, 119, '4-South', 10, 30, 'cross', 'SOUTH', '', 0, 300, 9087, 'Monthly Rate\r\n$275/month- 1 Year Contract\r\n$300/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$230 (one time charge)', 0, 0, '93c4d5340660a64593a7c67f5480c6cc.jpg', 0, 0),
(153, 120, '5-East', 6, 10, 'cross', 'EAST', '', 0, 150, 3870, 'Monthly Rate\r\n$125/month- 1 Year Contract\r\n$150/month- 6 Month Or Less Contract\r\nProduction / Vinyl Charge\r\n$100 (one time charge)', 0, 0, '3c0f35f8e27d9b37f83205720fe4fe4c.jpg', 0, 0),
(154, 120, '5-West', 6, 10, 'right', 'WEST', '', 0, 150, 3870, 'Monthly Rate\r\n$125/month- 1 Year Contract\r\n$150/month- 6 Month Or Less Contract\r\nProduction / Vinyl Charge\r\n$100 (one time charge)', 0, 0, '76c7d7b9544a3991701b43b48d44c8e0.jpg', 0, 0),
(155, 121, '6-North', 8, 14, 'right', 'NORTH', '', 0, 150, 4380, 'Monthly Rate\r\n$125/month- 1 Year Contract\r\n$150/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$120 (one time charge)', 0, 0, '475d7b75ffcccc73a9a4964b2851a84c.jpg', 0, 0),
(156, 121, '6-South', 8, 14, 'cross', 'SOUTH', '', 0, 150, 4380, 'Monthly Rate\r\n$125/month- 1 Year Contract\r\n$150/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$120 (one time charge)', 0, 0, '22cd2d8bf170fd887531206f5cb7ec22.png', 0, 0),
(157, 122, '7-East', 6, 12, 'cross', 'EAST', '', 0, 125, 6380, 'Monthly Rate\r\n$100/month- 1 Year Contract\r\n$125/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$100 (one time charge)', 0, 0, 'bdf63849883f7a54b153d4efd2394ea7.jpg', 0, 0),
(158, 122, '7-West', 6, 12, 'right', 'WEST', '', 0, 125, 6380, 'Monthly Rate\r\n$100/month- 1 Year Contract\r\n$125/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$100 (one time charge)', 0, 0, '67119768cdccadbd1cd6586d14a3834b.jpg', 0, 0),
(159, 123, '8-North', 6, 12, 'right', 'NORTH', '', 0, 150, 4380, 'Monthly Rate\r\n$125/month- 1 Year Contract Signed\r\n$150/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$100 (one time charge)', 0, 0, '171ceaeb1c47ef7e27c3414eb90ca8c4.jpg', 0, 0),
(160, 123, '8-South', 6, 12, 'cross', 'SOUTH', '', 0, 150, 4380, 'Monthly Rate\r\n$125/month- 1 Year Contract Signed\r\n$150/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$100 (one time charge)', 0, 0, '6633a5c808aef03275eab7a8216be7bc.png', 0, 0),
(161, 124, '9-East', 11, 22, 'right', 'EAST', '', 0, 375, 9840, 'Monthly Rate\r\n$325/month- 1 Year Contract\r\n$375/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$200 (one time charge)', 0, 0, 'beba7118b2c6745d1d6b0d6d3116f689.jpg', 0, 0),
(162, 124, '9-West', 11, 22, 'cross', 'WEST', '', 0, 375, 9840, 'Monthly Rate\r\n$325/month- 1 Year Contract\r\n$375/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$200 (one time charge)', 0, 0, '65b08c190fedf6089582f70e37c67d12.jpg', 0, 0),
(163, 125, '10-North', 11, 22, 'cross', 'NORTH', '', 0, 375, 8150, 'Monthly Rate\r\n$325/month- 1 Year Contract\r\n$375/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$200 (one time charge)', 0, 0, '5a5e92efd488eb89db71edf2f3fa2356.png', 0, 0),
(164, 125, '10-South', 11, 22, 'right', 'SOUTH', '', 0, 375, 8150, 'Monthly Rate\r\n$325/month- 1 Year Contract\r\n$375/month- 6 Months Or Less Contract\r\nProduction / Vinyl Charge\r\n$200 (one time charge)', 0, 0, '5908a7659e600a757eb9b2a93a0a768d.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `billboard_image`
--

CREATE TABLE `billboard_image` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `image_location` text COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone1` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `billing_address` text COLLATE utf8_bin,
  `billing_city` text COLLATE utf8_bin,
  `billing_state` text COLLATE utf8_bin,
  `billing_zipcode` text COLLATE utf8_bin,
  `logo` text COLLATE utf8_bin,
  `contact_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `email`, `phone1`, `phone2`, `fax`, `billing_address`, `billing_city`, `billing_state`, `billing_zipcode`, `logo`, `contact_name`, `company`, `updated_at`, `created_at`, `deleted_at`, `instance_id`) VALUES
(1, 'Michael', 'Spencer', 'michael@sjatty.com', '8017431507', '8017431507', '8017431507', '5664 S Green Street', '5664 S Green Street', '5664 S Green Street', '5664 S Green Street', NULL, NULL, 'Siegfried & Jensen', NULL, NULL, NULL, 0),
(2, 'Julianna', 'Spencer', ' jewels@mikeandjewels.com', '8012004964', '8012004964', '8012004964', '636 south 500 west', 'Provo', 'UT', '84601', NULL, NULL, 'Jsweetie', NULL, NULL, NULL, 0),
(3, 'Matt ', 'Reid', 'Matt@mammothbillboards.com', '801 898 2420', 'Same', 'None', '1727 e 27th street', 'Ogden', 'Utah', '84003', NULL, NULL, 'Mammoth Billboards', NULL, NULL, NULL, 0),
(4, 'John', 'Doe', 'cesar.benedicto.espinosa@gmail.com', '023939959', '4940594509', '495495495', 'test', 'test', 'test', 'test', NULL, NULL, 'ACME Ltd.', NULL, NULL, NULL, 0),
(5, 'H Le ', 'Spencer', 'hlespencer@yahoo.com', '6262521630', '6262521630', '6262521630', '1683 N. Rocky Rd.', 'Upland', 'California', '91784', NULL, NULL, 'Spencer Dynamics', NULL, NULL, NULL, 0),
(6, 'Mike', 'Spencer', 'mike@signly.com', '8012004395', '8012004395', '8012004395', '1291 Springfield St', 'Upland', 'CA', '91786', NULL, NULL, 'Signly', NULL, NULL, NULL, 0),
(7, 'Jared', 'Spencer', 'lemeilleurmec@gmail.com', '6266650927', '6266650927', '6666666666', '9176 Regents Rd. Apt. J', '9176 Regents Rd. Apt. J', '9176 Regents Rd. Apt. J', '9176 Regents Rd. Apt. J', NULL, NULL, 'Jared Spencer', NULL, NULL, NULL, 0),
(8, 'Test', 'Test', 'Test@TEst.com', '123456789', '123456789', '123456789', '5664 S Green Street', 'Salt Lake City', 'Utah', '84123', NULL, NULL, 'Test', NULL, NULL, NULL, 0),
(9, 'Ned', 'Siegfried', 'ned@sjatty.com', '8012660999', '8015981218', '8012660999', '5664 S Green Street', 'Salt Lake City', 'UT', '84123', NULL, NULL, 'Siegfried & Jensen', NULL, NULL, NULL, 0),
(10, 'Jay', 'Kimball', 'jay@jaysradiator.com', '8015468574', '8015468574', '8015468574', '453 Rancho Alegre', 'Covina', 'CA', '91724', NULL, NULL, 'Jay\'s Radioator', NULL, NULL, NULL, 0),
(11, 'Jenny', 'Ritza', 'ritza@pizza.com', '7859083485', '7859083485', '7859083485', '7859083485', '7859083485', '7859083485', '7859083485', NULL, NULL, 'Ritza\'s Pizza', NULL, NULL, NULL, 0),
(12, 'Thomas', 'Monson', 'tmonson@lds.org', '8012448578', '8012448578', '8012448578', '8012448578', '8012448578', '8012448578', '8012448578', NULL, NULL, 'LDS Church', NULL, NULL, NULL, 0),
(13, 'Randall', 'Day', 'rday@byu.edu', '8014224278', '8014224278', '8014224278', '8014224278', '8014224278', '8014224278', '8014224278', NULL, NULL, 'Flourishing Families', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_booking`
--

CREATE TABLE `client_booking` (
  `id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `billboard_face_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `book_start_date` datetime DEFAULT NULL,
  `book_end_date` datetime DEFAULT NULL,
  `set_price` decimal(10,0) DEFAULT NULL,
  `billboard_type` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `photo` text COLLATE utf8_bin NOT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `client_booking`
--

INSERT INTO `client_booking` (`id`, `billboard_id`, `billboard_face_id`, `vendor_id`, `client_id`, `proposal_id`, `description`, `book_start_date`, `book_end_date`, `set_price`, `billboard_type`, `updated_at`, `created_at`, `deleted_at`, `user_id`, `photo`, `instance_id`) VALUES
(1, 1, 1, 1, 1, 1, 'Test', '2016-06-01 08:46:04', '2016-06-30 08:46:13', '1000', 1, '2016-06-04 08:46:27', '2016-06-04 08:46:31', NULL, 1, '', 0),
(4, 20, 25, NULL, NULL, NULL, 'Partial Month', '2016-06-23 12:00:00', '2016-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(5, 22, 27, NULL, NULL, NULL, '$1,500/mo. for 4 months', '2016-04-21 12:00:00', '2016-06-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(6, 23, 28, NULL, NULL, NULL, '$1,677/mo. for 2 months', '2016-06-01 12:00:00', '2016-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(7, 17, 22, NULL, NULL, NULL, 'sl;kfdj', '2016-07-01 12:00:00', '2016-07-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(10, 18, 23, NULL, NULL, NULL, '$1,500/mo Mammoth', '2016-03-01 12:00:00', '2016-07-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(11, 17, 22, NULL, NULL, NULL, 'This is a test.', '2016-03-01 12:00:00', '2016-05-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(12, 19, 24, NULL, NULL, NULL, 'Love Communications - $3,250', '2016-09-01 12:00:00', '2016-11-08 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(13, 20, 25, NULL, NULL, NULL, 'S&J $1,500/mo.', '2016-04-01 12:00:00', '2016-05-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(14, 28, 32, NULL, NULL, NULL, 'Siegfried & Jensen ($2,100/mo.)', '2016-02-01 12:00:00', '2016-05-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(15, 29, 35, NULL, NULL, NULL, 'Chic-fil-a ($1000/mo.)', '2016-04-01 12:00:00', '2016-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(16, 31, 39, NULL, NULL, NULL, 'Mc Donalds ($4,000/mo.)', '2016-03-01 12:00:00', '2016-06-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(17, 33, 42, NULL, NULL, NULL, 'In-n-Out ($2,500/mo.)', '2016-03-01 12:00:00', '2016-10-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(18, 28, 32, NULL, NULL, NULL, 'Political Donation (Comp)', '2016-09-01 12:00:00', '2016-11-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(19, 34, 45, NULL, NULL, NULL, 'Ivory Homes ($1,200/mo.)', '2016-02-01 12:00:00', '2016-10-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(20, 30, 37, NULL, NULL, NULL, 'LDS Church ($2,000/mo.)', '2016-03-01 12:00:00', '2016-09-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(21, 32, 41, NULL, NULL, NULL, 'Jay\'s Radiator ($7,500/mo.)', '2016-01-01 12:00:00', '2016-05-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(22, 32, 41, NULL, NULL, NULL, 'Flourishing Families ($6,500/mo.)', '2016-07-01 12:00:00', '2016-12-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(23, 68, 81, NULL, NULL, NULL, 'Hi', '2016-04-01 12:00:00', '2016-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(24, 76, 94, NULL, NULL, NULL, 'McDonalds - $2,500/mo.', '2017-01-01 12:00:00', '2017-07-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(25, 74, 91, NULL, NULL, NULL, 'Michael 1', '2017-03-01 12:00:00', '2017-06-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(26, 72, 87, NULL, NULL, NULL, 'Michael 2', '2017-04-01 12:00:00', '2017-07-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(27, 75, 92, NULL, NULL, NULL, 'Michael 3', '2017-04-01 12:00:00', '2017-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(28, 77, 97, NULL, NULL, NULL, 'Michael 4', '2017-05-01 12:00:00', '2017-09-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(29, 67, 86, NULL, NULL, NULL, 'Michael 4', '2017-02-01 12:00:00', '2017-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(31, 81, 103, 2, 2, 84, '3300 South 355 E (WEST)', '2017-03-01 00:00:00', '2018-02-28 00:00:00', '200', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, '039ca2b69344659e669bca89781b22e1.jpg', 0),
(32, 86, 113, 2, 2, 84, 'I-1 Springville (North) (NORTH)', '2017-03-01 00:00:00', '2018-02-28 00:00:00', '600', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, '280b525a64a4fdc655f4b600d7a66b73.jpg', 0),
(33, 81, 104, 2, 2, 84, '3300 South 355 E (EAST)', '2017-03-01 00:00:00', '2018-02-28 00:00:00', '200', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, '3f1ceaf151157175d230306ccd73b9a8.jpg', 0),
(34, 87, 115, 2, 2, 85, 'I-1 Springville (South) (NORTH)', '2017-04-01 00:00:00', '2017-06-30 00:00:00', '4000', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, 'a62c49b37fd94cd945a293ce1d485408.jpg', 0),
(35, 80, 101, 2, 2, 85, 'Centerville (Parrish) (NORTH)', '2017-04-01 00:00:00', '2017-06-30 00:00:00', '5000', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, '8b1c1d45b5e7e51ba846899d047b020a.jpg', 0),
(36, 82, 105, 2, 2, 85, '3900 SOUTH Street (WEST)', '2017-04-01 00:00:00', '2017-06-30 00:00:00', '1000', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, '57f7487b7b76aa116ebdcc9cec377997.jpg', 0),
(37, 80, 102, 2, 2, 85, 'Centerville (Parrish) (SOUTH)', '2017-04-01 00:00:00', '2017-06-30 00:00:00', '250', NULL, '0000-00-00 00:00:00', '2017-05-31 00:00:00', NULL, 0, '3cf55c54363bdcd4b98b7e16071baf9c.jpg', 0),
(38, 84, 109, NULL, NULL, NULL, 'Michael Test', '2017-08-01 12:00:00', '2018-02-28 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(39, 83, 108, NULL, NULL, NULL, '$2,000 per month', '2017-08-01 12:00:00', '2018-11-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(40, 83, 107, NULL, NULL, NULL, 'Demo.', '2016-11-01 12:00:00', '2017-08-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(41, 84, 109, NULL, NULL, NULL, 'test', '2014-11-06 12:00:00', '2014-11-20 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(42, 85, 112, NULL, NULL, NULL, 'test', '2014-10-01 12:00:00', '2014-10-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(43, 87, 116, NULL, NULL, NULL, 'test for test', '2015-05-01 12:00:00', '2015-05-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(44, 82, 105, NULL, NULL, NULL, 'yggg', '2014-06-01 12:00:00', '2014-06-30 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(45, 83, 107, NULL, NULL, NULL, 'yuyuyuyu', '2014-05-01 12:00:00', '2014-05-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(46, 80, 101, NULL, NULL, NULL, 'fffff', '2014-01-01 12:00:00', '2014-10-31 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0),
(47, 84, 110, NULL, NULL, NULL, '9 Day example', '2018-02-09 12:00:00', '2018-02-28 12:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `email_to` varchar(255) NOT NULL,
  `email_cc` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `instance`
--

CREATE TABLE `instance` (
  `id` int(11) NOT NULL,
  `instance` varchar(255) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instance`
--

INSERT INTO `instance` (`id`, `instance`, `notes`) VALUES
(1, 'Main Instance', 'Main Instance'),
(2, 'Kennedy Outdoor', 'Beta-User'),
(3, 'Circle City Billboards', ''),
(4, 'Independent Outdoor', '');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone1` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `billing_address` text COLLATE utf8_bin,
  `billing_city` text COLLATE utf8_bin,
  `billing_state` text COLLATE utf8_bin,
  `billing_zipcode` text COLLATE utf8_bin,
  `logo` text COLLATE utf8_bin,
  `contact_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `first_name`, `last_name`, `email`, `phone1`, `phone2`, `fax`, `billing_address`, `billing_city`, `billing_state`, `billing_zipcode`, `logo`, `contact_name`, `company`, `updated_at`, `created_at`, `deleted_at`, `instance_id`) VALUES
(1, 'John', 'Doe', 'john.doe@test.com', '1234567', '1234567', '1234567', 'test', 'test', 'test', 'test', NULL, NULL, 'J&M Company', NULL, NULL, NULL, 0),
(2, 'Dave', 'Tomei', 'david@reaganusa.com', '(801) 521-1775', '801-555-5555', '(801) 521-9741', '1775 North Warm Springs Road', 'Salt Lake City', 'UT', '84116', NULL, NULL, 'Reagan', NULL, NULL, NULL, 0),
(3, 'Matt', 'Reid', 'matt@mammothbillboards.com', '801-898-2420', '801-898-2420', '801-898-2420', '1728 27th ST', 'Ogden', 'UT', '84403', NULL, NULL, 'Mammoth Outdoor', NULL, NULL, NULL, 0),
(4, 'R.C.', 'Channel', 'kennedyoutdoor9@gmail.com', '740-258-7083', '740-258-7083', '740-258-7083', '9327 Martinsburg Rd', ' St Louisville', 'OH', '43071', NULL, NULL, 'Kennedy Outdoor', NULL, NULL, NULL, 0),
(5, 'R.C.', 'Kennedy', 'kennedyoutdoor9@gmail.com', '740-258-7083', '740-258-7083', '740-258-7083', '9327 Martinsburg Rd', ' St Louisville', 'OH', '43071', NULL, NULL, 'Kennedy Outdoor', NULL, NULL, NULL, 2),
(6, 'Eric', 'Lambert', 'eric@independentoutdoor.com', '203-318-9097', '203-318-9097', '203-318-9097', '1, 346 Quinnipiac St.', 'Wallingford', 'CT', '06492', NULL, NULL, 'Independent Outdoor', NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `budget` decimal(10,0) DEFAULT NULL,
  `budget_validity` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `map_area_lat` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `map_area_long` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `hash` text COLLATE utf8_bin,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL,
  `booked` int(11) NOT NULL DEFAULT '0',
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `client_id`, `name`, `budget`, `budget_validity`, `start_date`, `end_date`, `map_area_lat`, `map_area_long`, `hash`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `accepted`, `booked`, `instance_id`) VALUES
(4, 4, 'Sweetie', '1000000', 'Week', '2015-08-10', '2015-08-10', NULL, NULL, 'aea7d19b7890703006e56b16b5fbf4c7', NULL, NULL, NULL, 1, 0, 0, 0),
(5, 4, 'Matt\'s', '87878', 'Week', '2015-08-04', '2016-04-29', NULL, NULL, 'ceb658eddf71814eea21212deb08deab', NULL, NULL, NULL, 1, 0, 0, 0),
(6, 1, 'Mike\'s Test Proposal', '50000', 'Month', '2015-11-06', '2016-03-10', NULL, NULL, '063389020202701d6289ca94fa7cbcc8', NULL, NULL, NULL, 1, 0, 0, 0),
(7, 2, 'Show off to J', '50000', 'Year', '2015-11-09', '2016-11-09', NULL, NULL, '831d11995955ed168c0501b7851dbe2a', NULL, NULL, NULL, 1, 0, 0, 0),
(8, 1, 'New Boards for Ned', '15000', 'Month', '2015-12-23', '2016-02-29', NULL, NULL, '3bbd474cdb6575d18ae1033e59fc25a4', NULL, NULL, NULL, 1, 0, 0, 0),
(9, 1, 'tester', '3000', 'Month', '2015-12-1', '2016-03-31', NULL, NULL, '45c48cce2e2d7fbdea1afc51c7c6ad26', NULL, NULL, NULL, 1, 0, 0, 0),
(10, 4, 'Test User Proposal', '10000', 'Week', '2016-01-04', '2016-01-04', NULL, NULL, '2d5c04770d6d73aceb812574a55eb4d9', NULL, NULL, NULL, 5, 0, 0, 0),
(11, 4, 'My New Test Proposal', '10000', 'Week', '2016-01-05', '2016-01-05', NULL, NULL, 'c0f54a0eb3ae4302fba56a2d1c3fab19', NULL, NULL, NULL, 5, 0, 0, 0),
(12, 2, 'Clip Earring Shop', '5000', 'Month', '2016-01-21', '2016-04-21', NULL, NULL, 'd0c0ed84d041a2cc5a1a45d9e6ec67f2', NULL, NULL, NULL, 6, 0, 0, 0),
(15, 4, 'Test User Proposal', '10000', 'Week', '2016-01-1', '2016-01-1', NULL, NULL, '9bf31c7ff062936a96d3c8bd1f8f2ff3', NULL, NULL, NULL, 1, 0, 0, 0),
(19, 1, 'My New Test Proposal', '100000', 'Week', '2016-01-01', '2016-02-29', NULL, NULL, 'f45581dce368ecc53386d0ff5058f17b', NULL, NULL, NULL, 1, 0, 0, 0),
(34, 2, 'My New User Locking Test Proposal', '200000', 'Week', '2016-02-19', '2016-02-19', NULL, NULL, 'a653c6bdba6d477c165ad250add8211f', NULL, NULL, NULL, 7, 0, 0, 0),
(38, 5, 'signly scrrenshot', '1000', 'Week', '2016-03-1', '2016-03-1', NULL, NULL, 'cc1bd048c5784806a842f453ebe7558d', NULL, NULL, NULL, 9, 0, 0, 0),
(41, 6, '25 Mar 2016 - Signly', '5000', 'Month', '2016-04-01', '2016-06-30', NULL, NULL, '3416a75f4cea9109507cacd8e2f2aefc', NULL, NULL, NULL, 2, 1, 1, 0),
(42, 6, '30 Mar 2016 Hoogle Zoo', '5000', 'Month', '2016-09-01', '2016-12-31', NULL, NULL, 'a1d0c6e83f027327d8461063f4ac58a6', NULL, NULL, NULL, 2, 1, 1, 0),
(44, 1, '22 Apr 2016 - Test', '5000', 'Month', '2016-04-01', '2016-05-31', NULL, NULL, 'f7177163c833dff4b38fc8d2872f1ec6', NULL, NULL, NULL, 2, 1, 1, 0),
(45, 6, '22 Apr 2016 - Karen Demo', '5000', 'Month', '2016-07-01', '2016-08-31', NULL, NULL, '6c8349cc7260ae62e3b1396831a8398f', NULL, NULL, NULL, 2, 1, 1, 0),
(46, 7, '26 Apr 2016 - Jared Test', '5000', 'Month', '2016-08-01', '2016-09-30', NULL, NULL, 'd9d4f495e875a2e075a1a4a6e1b9770f', NULL, NULL, NULL, 2, 1, 1, 0),
(83, 1, '#11 #12 #21 mammoth deal', '1000', 'Week', '2017-02-06', '2017-02-06', NULL, NULL, '5828e13641dba1e5760fc91288615b13', NULL, NULL, NULL, 7, 0, 0, 0),
(84, 1, 'S&J - Fire Sale', '1000', 'Week', '2017-03-01', '2018-02-28', NULL, NULL, '36ba0baf8dd2683f5fcf44c4194db0b4', NULL, NULL, NULL, 2, 0, 1, 0),
(85, 1, '11 Mar 2017', '10000', 'Week', '2017-04-01', '2017-06-30', NULL, NULL, '419e886416fa01c05fdea200e3c72818', NULL, NULL, NULL, 2, 1, 1, 0),
(87, 1, 'demo', '5000', 'Week', '2017-04-22', '2017-04-22', NULL, NULL, '6619530c2aa3d0cf74145acda7e1db0e', NULL, NULL, NULL, 2, 1, 0, 0),
(88, 1, 'Demo for Lee', '5000', 'Week', '2017-05-01', '2017-07-31', NULL, NULL, 'ab4c0f8f84ec97e90ce1423e70405926', NULL, NULL, NULL, 2, 0, 0, 0),
(89, 1, 'Demo 3 May', '5000', 'Week', '2017-05-01', '2017-07-31', NULL, NULL, 'af211804fe2ca754621ed78ae97611ab', NULL, NULL, NULL, 2, 0, 0, 0),
(90, 1, 'May Rotary Posters', '15000', 'Week', '2017-05-1', '2017-06-1', NULL, NULL, 'c93faebac05a730f14451e5cc4274a14', NULL, NULL, NULL, 2, 0, 0, 0),
(91, 1, 'June Rotary Posters', '3000', 'Week', '2017-06-1', '2017-07-1', NULL, NULL, '7d0b8db5b9761551d858021a989eff97', NULL, NULL, NULL, 2, 0, 0, 0),
(92, 1, 'June Rotary Posters', '3000', 'Week', '2017-06-1', '2017-07-1', NULL, NULL, 'f97fd948ae91b9e4bd259682ada5b818', NULL, NULL, NULL, 2, 1, 0, 0),
(93, 1, '6 Jun 2017 - Big Proposal', '30000', 'Week', '2017-06-01', '2017-08-31', NULL, NULL, 'a7759ca8d3748450ee8b8487b6f351e6', NULL, NULL, NULL, 2, 0, 0, 0),
(94, 1, 'Dave\'s demo', '5000', 'Week', '2017-06-19', '2017-06-19', NULL, NULL, 'd63ed23c053651c706a2b27fcee2232f', NULL, NULL, NULL, 2, 1, 0, 0),
(95, 1, 'Test', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '0b85c9d8b43c1a6af73324d664066140', NULL, NULL, NULL, 2, 1, 0, 0),
(96, 1, 'RC Demo', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '226f6fff4c0b887ee7477870d4729ac9', NULL, NULL, NULL, 2, 1, 0, 0),
(97, 1, 'adsf', '1000', 'Week', '2017-06-26', '2017-06-26', NULL, NULL, 'fa25bd59362661ae8f54a5f2ad086f57', NULL, NULL, NULL, 2, 0, 0, 0),
(98, 1, 'Don\'s Demo', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '7137f34be9b93a04856053672a0053c6', NULL, NULL, NULL, 2, 0, 0, 0),
(99, 1, 'Eric Demo', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '969fd7534e54fe4d2fb69e0b6b0668bc', NULL, NULL, NULL, 2, 0, 0, 0),
(100, 1, 'RC\'s Boards', '750', 'Week', '2017-07-12', '2017-07-12', NULL, NULL, 'e4cb0afc1aca321962f24a8330efbd72', NULL, NULL, NULL, 2, 0, 0, 0),
(101, 1, '17 Jun - Signly', '500', 'Week', '2017-07-17', '2018-06-30', NULL, NULL, '3829f449faf255f3edce7401d85045b7', NULL, NULL, NULL, 17, 0, 0, 2),
(102, 1, 'Signly', '500', 'Week', '2017-07-18', '2017-07-18', NULL, NULL, 'c284575f12b04a0cc883ff6259dceb14', NULL, NULL, NULL, 17, 0, 0, 2),
(103, 7, 'demo felipe', '45000', 'Week', '2017-08-04', '2017-08-04', NULL, NULL, 'fbeb20baa82f627e2322a8b9f3e91f85', NULL, NULL, NULL, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_billboard`
--

CREATE TABLE `proposal_billboard` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `billboard_face_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_accepted` int(11) NOT NULL,
  `client_rejected` int(11) NOT NULL,
  `proposal_price` double DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `proposal_billboard`
--

INSERT INTO `proposal_billboard` (`id`, `proposal_id`, `billboard_id`, `billboard_face_id`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `client_accepted`, `client_rejected`, `proposal_price`, `instance_id`) VALUES
(24, 5, 4, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(25, 5, 10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, NULL, 0),
(26, 7, 10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, NULL, 0),
(27, 7, 4, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(28, 7, 6, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, NULL, 0),
(29, 7, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(30, 8, 11, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(31, 8, 12, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, NULL, 0),
(32, 8, 13, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(33, 8, 14, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(42, 9, 12, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, NULL, 0),
(43, 9, 4, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, NULL, 0),
(44, 9, 10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, NULL, 0),
(45, 12, 4, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 0, 0, NULL, 0),
(46, 12, 6, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 0, 1, NULL, 0),
(47, 12, 10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 1, 0, NULL, 0),
(64, 15, 10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, NULL, 0),
(65, 15, 6, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, NULL, 0),
(189, 38, 16, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 1, 0, 2000, 0),
(190, 38, 20, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 0, 1, 11500, 0),
(191, 38, 21, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 1, 0, 2500, 0),
(200, 41, 20, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 1, 1500, 0),
(201, 41, 23, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1800, 0),
(202, 41, 23, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1700, 0),
(215, 42, 23, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 2500, 0),
(216, 42, 21, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1000, 0),
(217, 42, 16, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1500, 0),
(242, 44, 16, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1500, 0),
(243, 44, 22, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1000, 0),
(244, 44, 21, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1500, 0),
(245, 44, 19, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1000, 0),
(246, 45, 16, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1000, 0),
(247, 45, 19, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 2000, 0),
(248, 45, 21, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 2000, 0),
(271, 46, 20, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 1, 2000, 0),
(272, 46, 23, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1000, 0),
(273, 46, 21, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 1000, 0),
(274, 46, 22, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 5000, 0),
(275, 46, 16, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1, 0, 546, 0),
(276, 46, 18, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 1, 6546, 0),
(277, 46, 17, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 1, 654, 0),
(1033, 83, 86, 113, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 0, 0, 600, 0),
(1034, 83, 81, 103, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 0, 0, 200, 0),
(1035, 83, 81, 104, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 0, 0, 200, 0),
(1053, 84, 81, 103, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 200, 0),
(1054, 84, 86, 113, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 600, 0),
(1055, 84, 81, 104, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 200, 0),
(1092, 85, 87, 115, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 4000, 0),
(1093, 85, 80, 101, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 5000, 0),
(1094, 85, 82, 105, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1095, 85, 80, 102, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 250, 0),
(1181, 92, 104, 133, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1182, 92, 90, 119, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1183, 92, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1184, 92, 102, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1185, 87, 82, 105, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2500, 0),
(1186, 87, 87, 115, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2500, 0),
(1221, 93, 80, 102, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 3000, 0),
(1222, 93, 84, 109, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1500, 0),
(1223, 93, 102, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 500, 0),
(1224, 93, 91, 120, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2750, 0),
(1225, 93, 92, 121, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1750, 0),
(1226, 93, 80, 101, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 3000, 0),
(1227, 93, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1228, 93, 96, 125, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 5000, 0),
(1229, 93, 98, 127, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2500, 0),
(1230, 93, 103, 132, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1231, 93, 88, 117, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 3350, 0),
(1232, 93, 109, 138, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2650, 0),
(1293, 90, 90, 119, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1294, 90, 91, 120, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1295, 90, 92, 121, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1296, 90, 93, 122, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1297, 90, 96, 125, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1298, 90, 95, 124, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1299, 90, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1300, 90, 98, 127, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1301, 90, 99, 128, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1302, 90, 100, 129, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1303, 90, 101, 130, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1304, 90, 102, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1305, 90, 103, 132, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1306, 90, 104, 133, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1307, 90, 105, 134, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1308, 90, 106, 135, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1309, 90, 107, 136, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1310, 90, 108, 137, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1311, 90, 109, 138, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1312, 90, 110, 139, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1322, 94, 88, 117, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1323, 94, 85, 111, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2150, 0),
(1324, 94, 82, 106, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1850, 0),
(1328, 95, 100, 129, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1329, 95, 86, 113, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1330, 95, 98, 127, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1337, 96, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1338, 96, 86, 113, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1339, 96, 102, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1345, 97, 84, 109, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 50, 0),
(1346, 97, 102, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 200, 0),
(1347, 97, 89, 118, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 200, 0),
(1348, 97, 103, 132, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 300, 0),
(1349, 97, 83, 107, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 250, 0),
(1354, 98, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1355, 98, 100, 129, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1356, 98, 82, 105, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1000, 0),
(1357, 98, 84, 110, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1361, 91, 87, 115, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1362, 91, 98, 127, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1363, 91, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 750, 0),
(1372, 99, 97, 126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1500, 0),
(1373, 99, 100, 129, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1500, 0),
(1374, 99, 103, 132, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 2000, 0),
(1412, 102, 121, 155, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17, 0, 0, 125, 2),
(1849, 101, 118, 149, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17, 0, 0, 400, 0),
(1850, 101, 122, 158, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17, 0, 0, 100, 0),
(1851, 101, 121, 155, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17, 0, 0, 150, 0),
(1852, 101, 124, 161, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17, 0, 0, 375, 0),
(1872, 88, 80, 101, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1, 0),
(1873, 88, 84, 109, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1, 0),
(1874, 88, 85, 112, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1, 0),
(1875, 88, 82, 106, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1, 0),
(1876, 88, 88, 117, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 1, 0),
(1877, 88, 98, 127, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 0, 5000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_comments`
--

CREATE TABLE `proposal_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `message_from` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proposal_comments`
--

INSERT INTO `proposal_comments` (`id`, `user_id`, `proposal_id`, `client_id`, `message`, `message_from`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 2, 62, 1, 'test', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(8, 2, 62, 1, 'These boards look great.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(9, 2, 62, 1, 'Sweet.  Let\'s do it.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(10, 2, 62, 1, 'Can we switch out the i-80 board?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(11, 2, 13, 1, 'I like this one but not that one.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(12, 2, 13, 1, 'I like this one but not that one.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(13, 2, 13, 1, 'Okay check out this version.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(14, 2, 63, 1, 'I like the Lindon but not the Springville Board', 'client', '0000-00-00 00:00:00', NULL, NULL),
(15, 2, 63, 1, 'I added the Centerville board.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(16, 2, 63, 1, 'This is great.  Thanks!', 'client', '0000-00-00 00:00:00', NULL, NULL),
(17, 2, 64, 1, 'Love the Lindon and Springville Boards but don\'t like the St. George Board.  Anything else in that area?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(18, 2, 64, 1, 'Thanks, I removed St. George and added Mesquite.  What do you think?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(19, 2, 64, 1, 'Awesome.  Thanks!', 'client', '0000-00-00 00:00:00', NULL, NULL),
(20, 2, 65, 8, 'add north side', 'client', '0000-00-00 00:00:00', NULL, NULL),
(21, 2, 65, 8, 'here it is', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(22, 2, 65, 8, '˙ere is the final', 'client', '0000-00-00 00:00:00', NULL, NULL),
(23, 2, 66, 8, 'Great.  Add Lindon.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(24, 2, 66, 8, 'There you go.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(25, 2, 66, 8, 'This is great.  I really like these boards.  Can we add more south facing boards to this proposal?  Our team really likes those.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(26, 2, 66, 8, 'This is wonderful.  THanks for adding this.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(27, 2, 14, 1, 'These boards look awesome.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(28, 2, 14, 1, 'Another cool comment', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(29, 2, 14, 1, 'Great.  Thanks!  I really like this.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(30, 2, 14, 1, 'If you\'re using video strategically, chances are you\'re considering the bigger picture.\r\n\r\nYou\'re setting specific goals to make sure your video helps you achieve them. You\'re customizing your player color and choosing enticing thumbnails to increase your play rates. You\'re adding specific CTAs to your videos to help direct your viewers to the next relevant page or step. And maybe you\'re even considering the context your video\'s in.\r\n\r\nBut have you ever made explicit connections between your video and its environment?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(31, 2, 14, 1, 'Alec also spoke to the importance of keeping concepts simple for a humorous video. \"If you have to try too hard to make a joke, it\'s probably not funny. If you have to explain too much to understand a joke, it\'s probably not funny. Everyone is being pulled in a thousand different directions. Nobody will stop to try to understand your humor. They\'ll just ignore it. So keep it simple.\"\r\n\r\nLastly, we asked about the inspiration for the following well-known video:', 'client', '0000-00-00 00:00:00', NULL, NULL),
(32, 2, 14, 1, 'ATLANTA (CNN) — Haunted houses, horror films, scary novels and chilling art: Do you ever wonder why we seek out situations that terrify us?\r\n\r\nExperts say that being scared, at least when we can control it, can be healthy.\r\n\r\n\"People like to be scared, but there is scared, and there is \'scared,\' \" said Jeffrey Goldstein, a psychology professor and expert in violence and entertainment at Utrecht University in the Netherlands. \"You can be frightened in a movie or a play that is designed that way, and that can be a good kind of scared.\"\r\n\r\nBut, he said, there\'s a difference between real and fake fright.\r\n\r\nTake the scary clown phenomenon that has plagued the United States and Europe. That is not a scare that people enjoy, because we don\'t know the scary clowns\' motivation. \"This plays with the border of what is unpleasant and threatening and may be violent,\" Goldstein said.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(33, 2, 14, 1, '\r\n6-year-old girl defends autistic brother with viral letter\r\nJessica Ivins, KSL.com Contributor  |  Posted  Oct 28th - 9:20am\r\nWhen a 6-year-old girl heard another child calling her autistic brother “weird,” she decided she needed to take action.\r\n \r\nJury awards more than $70M to woman in baby powder lawsuit\r\nThe Associated Press  |  Posted  Oct 28th - 8:52am\r\nA St. Louis jury on Thursday awarded a California woman more than $70 million in her lawsuit alleging that years of using Johnson & Johnson\'s baby powder caused her cancer, the latest case raising concerns about the health ramifications of extended talcum powder use.\r\n \r\nTalk of Clinton winning Texas has GOP craving reality check\r\n Paul J. Weber, Associated Press  |  Posted  Oct 28th - 8:40am\r\nIt\'s no surprise that Hillary Clinton hasn\'t gambled much on Texas, a state no Democratic presidential candidate has won in 40 years. What\'s surprising is the scare she\'s giving Republicans anyway.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(34, 2, 67, 9, 'Hi Ned,  Here are the billboards for this next rotary period.  Please let us know your thoughts.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(35, 2, 68, 9, 'I want the lindon and 3900 boards', 'client', '0000-00-00 00:00:00', NULL, NULL),
(36, 2, 68, 9, 'Hi Matt, I\'ve added Lindon, and removed the others.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(37, 2, 68, 9, 'This looks great I will accept it', 'client', '0000-00-00 00:00:00', NULL, NULL),
(38, 2, 69, 2, 'I really don\'t like the Lindon board.  Do you have any others in St. George.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(39, 2, 69, 2, 'These are the only ones available that are in your price range.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(40, 2, 70, 3, 'I really like the Provo board but not the Centerville board.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(41, 2, 70, 3, 'Sounds good.  I got rid of the Centerville board and added a Salt Lake board.  Do you like that one?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(42, 2, 70, 3, 'Yeah, that one is pretty sweet.  Thanks.  I did notice that my spend went up.  Any way we could meet half way on that one?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(43, 2, 70, 3, 'I could do $1,750 but not $1,500.  Will that work for you?  I\'m going to run you extra on some digitals anyway so the overall value will be even more than that $4K/mo. cost.  It will probably be more like $6K/mo. in overall value.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(44, 2, 70, 3, 'Sounds good.  What do I do now?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(45, 2, 70, 3, 'Just accept the proposal (right below the calculator on the proposal pane.)  Then it will send me an email and I\'ll get everything booked in our system.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(46, 2, 70, 3, 'Awesome.  Thanks for adding \"Julianna\".', 'client', '0000-00-00 00:00:00', NULL, NULL),
(47, 2, 73, 2, 'I don\'t like the Michael Spencer board.  Anything else?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(48, 2, 73, 2, 'I have removed Michael Spencer, but I don\'t have anything else.  Would you like me to add Michael Spencer back on?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(49, 2, 73, 2, 'Okay.  Let\'s leave it off.  What do I do now?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(50, 2, 73, 2, 'Just click \"Accept Proposal\" above this comments section.  Anything else I can do to help?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(51, 2, 75, 1, 'This looks great.  I\'m not a fan of the Parrish Board but I love the 3900 South board.\r\n\r\nAnything else you can show me?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(52, 2, 75, 1, 'This is a comment.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(53, 2, 75, 1, 'This is another comment.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(54, 2, 75, 1, 'Okay, thank you.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(55, 2, 75, 1, 'This is comment\r\n', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(56, 2, 76, 1, 'This all look great, although I\'m not a huge fan of the 3900 South board.  Anything else in that area?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(57, 2, 77, 1, 'I like the Lindon Digital but not the 4300 South Board.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(58, 2, 77, 1, 'Awesome.  I removed the 4300 South Board and added the 3900 South Board.  Thoughts?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(59, 2, 77, 1, 'Looks great.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(60, 2, 78, 1, 'I like everything but the 4300 South Board.  Anything else?', 'client', '0000-00-00 00:00:00', NULL, NULL),
(61, 2, 78, 1, 'I\'ve removed the 4300 South Board and added the Centerville Board.  Do you like that?', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(62, 2, 78, 1, 'Looks great.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(63, 2, 79, 1, 'Spanish fork is great.  But Lindon stinks.', 'client', '0000-00-00 00:00:00', NULL, NULL),
(64, 2, 79, 1, 'Great.  I deleted the Lindon boards and have added the 4300 South.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(65, 2, 81, 1, 'Check out these billboards and let me know what you think.', 'admin', '0000-00-00 00:00:00', NULL, NULL),
(66, 2, 81, 1, 'This is great.', 'client', '2017-01-16 04:18:53', NULL, NULL),
(67, 2, 81, 1, 'This is great.', 'client', '2017-01-16 04:18:57', NULL, NULL),
(68, 2, 81, 1, 'Awesome.  Okay.', 'admin', '2017-01-16 04:19:16', NULL, NULL),
(69, 2, 84, 1, 'This looks pretty cool.', 'client', '2017-03-11 09:36:20', NULL, NULL),
(70, 2, 84, 1, 'Awesome.  Let me know if there\'s anything else you need.', 'admin', '2017-03-11 09:38:55', NULL, NULL),
(71, 2, 85, 1, 'Love everything but the Lindon Digital.', 'client', '2017-03-11 10:12:35', NULL, NULL),
(72, 2, 85, 1, 'Awesome.  What do you think now?', 'admin', '2017-03-11 10:13:16', NULL, NULL),
(73, 2, 85, 1, 'That sucks.  Get me something else.', 'client', '2017-03-22 06:31:33', NULL, NULL),
(74, 2, 85, 1, 'How about that.', 'admin', '2017-03-22 06:32:30', NULL, NULL),
(75, 2, 85, 1, 'I love this.', 'admin', '2017-04-01 03:20:47', NULL, NULL),
(76, 2, 87, 1, 'What do you think about these boards?', 'admin', '2017-04-22 11:59:32', NULL, NULL),
(77, 2, 87, 1, 'I don\'t like the Lindon Digital.  Anything else in that area?', 'client', '2017-04-23 12:00:36', NULL, NULL),
(78, 2, 87, 1, 'How about these?', 'admin', '2017-04-23 12:01:35', NULL, NULL),
(79, 2, 87, 1, 'Looks good.', 'client', '2017-04-23 12:01:47', NULL, NULL),
(80, 2, 88, 1, 'You can also send messages to clients so you can modify these proposals until they\'re exactly how you want them.  Then they click \"Accept Proposal\".  We\'re currently building in an e-signature app to complete contracts after they click the \"Accept\" button.', 'admin', '2017-05-02 05:39:26', NULL, NULL),
(81, 2, 90, 1, 'Hi Jessica!', 'admin', '2017-05-08 10:36:34', NULL, NULL),
(82, 2, 90, 1, 'Hi Michael,', 'client', '2017-05-08 10:57:57', NULL, NULL),
(83, 2, 90, 1, 'Hi Michael,\n', 'client', '2017-05-08 10:57:57', NULL, NULL),
(84, 2, 90, 1, 'Bonjour!  Do you like Signly?  :-)', 'admin', '2017-05-08 11:03:34', NULL, NULL),
(85, 2, 87, 1, 'This appears to be working.', 'admin', '2017-06-01 01:37:41', NULL, NULL),
(86, 2, 93, 1, 'How does this look?', 'admin', '2017-06-06 05:38:39', NULL, NULL),
(87, 2, 93, 1, 'Looks great.  What next?', 'client', '2017-06-06 05:40:08', NULL, NULL),
(88, 2, 93, 1, 'This is awesome.', 'client', '2017-06-12 04:48:11', NULL, NULL),
(89, 2, 88, 1, 'Example Message', 'admin', '2017-06-1 02:12:06', NULL, NULL),
(90, 2, 90, 1, 'Yes, I love it.', 'client', '2017-06-19 02:16:56', NULL, NULL),
(91, 2, 90, 1, 'Great.', 'admin', '2017-06-19 02:17:35', NULL, NULL),
(92, 2, 94, 1, '#2 looks good ', 'client', '2017-06-19 07:22:28', NULL, NULL),
(93, 2, 94, 1, 'Great.', 'admin', '2017-06-19 07:22:35', NULL, NULL),
(94, 2, 95, 1, 'Is this illuminated?', 'client', '2017-06-23 04:28:52', NULL, NULL),
(95, 2, 95, 1, 'Yes it\'s illuminated.', 'admin', '2017-06-23 04:29:07', NULL, NULL),
(96, 2, 96, 1, 'I don\'t like #3 what else?', 'client', '2017-06-23 08:08:39', NULL, NULL),
(97, 2, 96, 1, 'Okay, what about this.', 'admin', '2017-06-23 08:09:06', NULL, NULL),
(98, 2, 98, 1, 'I like 3 but not 4.  Anything else?', 'client', '2017-06-26 06:20:45', NULL, NULL),
(99, 2, 98, 1, 'What about this?', 'admin', '2017-06-26 06:21:33', NULL, NULL),
(100, 2, 98, 1, 'Looks good to me.', 'client', '2017-06-28 12:31:00', NULL, NULL),
(101, 2, 98, 1, 'Nice', 'admin', '2017-06-28 12:31:1', NULL, NULL),
(102, 2, 91, 1, 'Demo message.', 'admin', '2017-07-04 12:09:10', NULL, NULL),
(103, 2, 91, 1, 'Sounds good.', 'client', '2017-07-04 12:09:56', NULL, NULL),
(104, 2, 91, 1, 'Test this message with auto refresh', 'client', '2017-07-04 01:03:01', NULL, NULL),
(105, 2, 91, 1, 'testing the new refresh chat message from admin', 'admin', '2017-07-04 01:1:27', NULL, NULL),
(106, 2, 91, 1, 'admin', 'admin', '2017-07-04 01:19:30', NULL, NULL),
(107, 2, 91, 1, 'client', 'client', '2017-07-04 01:19:42', NULL, NULL),
(108, 2, 91, 1, 'Client #2', 'client', '2017-07-04 01:25:52', NULL, NULL),
(109, 2, 91, 1, 'Bonjour', 'client', '2017-07-05 05:00:23', NULL, NULL),
(110, 2, 91, 1, 'Thanks.', 'admin', '2017-07-05 05:00:36', NULL, NULL),
(111, 2, 91, 1, 'Awesome.', 'client', '2017-07-05 05:00:45', NULL, NULL),
(112, 2, 91, 1, 'No problem.', 'admin', '2017-07-05 05:00:53', NULL, NULL),
(113, 2, 91, 1, 'I like the way this looks.', 'client', '2017-07-05 05:01:30', NULL, NULL),
(114, 2, 91, 1, 'Sure do.', 'admin', '2017-07-05 05:01:39', NULL, NULL),
(115, 2, 91, 1, 'Love this.', 'client', '2017-07-05 05:03:10', NULL, NULL),
(116, 2, 91, 1, 'Looking good', 'admin', '2017-07-05 05:04:06', NULL, NULL),
(117, 2, 91, 1, 'Indeed', 'client', '2017-07-05 05:04:47', NULL, NULL),
(118, 2, 91, 1, 'Bonjour', 'client', '2017-07-05 02:36:32', NULL, NULL),
(119, 2, 91, 1, 'Looking good so far.', 'admin', '2017-07-05 02:36:44', NULL, NULL),
(120, 2, 91, 1, 'I like how this is scrolling automatically.', 'admin', '2017-07-05 02:36:58', NULL, NULL),
(121, 2, 91, 1, 'Me too.', 'client', '2017-07-05 02:37:05', NULL, NULL),
(122, 2, 91, 1, 'What do you think?', 'client', '2017-07-05 02:37:13', NULL, NULL),
(123, 2, 91, 1, 'I think it looks good.', 'admin', '2017-07-05 02:37:24', NULL, NULL),
(124, 2, 91, 1, 'Yeah, me too.', 'client', '2017-07-05 02:37:33', NULL, NULL),
(125, 2, 91, 1, 'I lik this.', 'admin', '2017-07-05 02:37:58', NULL, NULL),
(126, 2, 91, 1, 'Yeah, me too.', 'client', '2017-07-05 02:38:07', NULL, NULL),
(127, 2, 99, 1, 'I don\'t like 3900 South.  Anything else?', 'client', '2017-07-06 07:19:51', NULL, NULL),
(128, 2, 99, 1, 'I updated to redwood road.  How\'s this?', 'admin', '2017-07-06 07:20:33', NULL, NULL),
(129, 2, 99, 1, 'I think it looks great.', 'client', '2017-07-08 05:46:49', NULL, NULL),
(130, 17, 101, 1, ' hey', 'client', '2017-07-18 01:33:07', NULL, NULL),
(131, 17, 101, 1, 'bonjour', 'admin', '2017-07-18 01:33:16', NULL, NULL),
(132, 17, 101, 1, 'Want the boa5rd', 'client', '2017-07-18 01:34:17', NULL, NULL),
(133, 17, 102, 1, 'Hi there.', 'client', '2017-07-18 02:05:38', NULL, NULL),
(134, 17, 102, 1, 'I don\'t like the second main street board.  Anything else?', 'client', '2017-07-18 02:06:00', NULL, NULL),
(135, 17, 102, 1, 'how bout this', 'admin', '2017-07-18 02:06:57', NULL, NULL),
(136, 17, 102, 1, 'That looks great.  Send the contract.', 'client', '2017-07-18 02:07:10', NULL, NULL),
(137, 2, 88, 1, 'Hi', 'client', '2017-08-04 10:30:59', NULL, NULL),
(138, 2, 100, 1, 'Does this still work?', 'client', '2017-08-04 10:31:05', NULL, NULL),
(139, 2, 88, 1, 'ssssss', 'client', '2017-08-11 10:46:35', NULL, NULL),
(140, 2, 88, 1, 'aaaaaaaa', 'admin', '2017-08-11 10:46:43', NULL, NULL),
(141, 2, 88, 1, 'juj', 'admin', '2017-08-11 10:47:1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_permissions`
--

CREATE TABLE `proposal_permissions` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(50) COLLATE utf8_bin NOT NULL,
  `company` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `about_me` text COLLATE utf8_bin,
  `password` text COLLATE utf8_bin,
  `remember_token` text COLLATE utf8_bin,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL,
  `is_founder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `photo`, `first_name`, `last_name`, `email`, `phone`, `company`, `about_me`, `password`, `remember_token`, `updated_at`, `created_at`, `deleted_at`, `instance_id`, `is_founder`) VALUES
(1, 0, '', 'John', 'Doe', 'cesar.benedicto.espinosa@gmail.com', '', NULL, NULL, '$2a$10$btFdgfVD74eLeYeOzS0JvO0uQZPOywcSQJrOeJ98UsAeroATHKb8W', 'ABdqJGxag4j1Lc5Xuk5AvToZpDRDJ5H0eCTwfHCss5GpIQ5YfMw1rHyUjYsd', '2016-04-12 03:35:02', '2015-02-21 08:29:13', NULL, 0, 1),
(2, 0, '', 'Michael', 'Spencer', 'mike@mikeandjewels.com', '', NULL, NULL, '$2y$10$dEMsdMd6pc52Sx0NWfdwv.dFEr8cMr8FoQqnIsbEFMhg52jROzdj.', 'jmKGyul0HLiyGxvK3uXJgmy5y0J8wbnyQupcpuWl2AqX4QDU3AD4IUWIQcF7', '2017-08-03 13:27:1', '2015-04-06 16:48:45', NULL, 0, 1),
(3, 0, '', 'Marian', 'Pop', 'marian@creatiph.com', '', NULL, NULL, '$2y$10$U9dKW2L/eOGrbO8ugHKbiOWtJLvYB8fVSE7p2OfsYWk32w1iZz6B6', NULL, '2015-04-08 18:46:25', '2015-04-08 18:46:25', NULL, 0, 0),
(5, 1, '', 'Test', 'User', 'test@test.com', '', NULL, NULL, '$2a$10$btFdgfVD74eLeYeOzS0JvO0uQZPOywcSQJrOeJ98UsAeroATHKb8W', 'VXVBU5Jzs5TDyWr6oSsBcYDD3QXD0DJ0dyEAyScgRkuzvwN9mgZPrdzCQmWl', '2016-01-13 00:18:30', NULL, NULL, 0, 0),
(6, 0, '', 'Juliana', 'Spencer', 'jewels@mikeandjewels.com', '', NULL, NULL, '$2y$10$dEMsdMd6pc52Sx0NWfdwv.dFEr8cMr8FoQqnIsbEFMhg52jROzdj.', NULL, NULL, NULL, NULL, 0, 0),
(7, 1, '', 'Matt', '', 'matt@mammothbillboards.com', '', NULL, NULL, '$2a$10$qqqGWrz9A.doo1u4w3OKuu8WM5rpxt4VGasE85ND3xXROLjrAS1bW', 'hrmeaqfpdE7dtWGGLLBZ36XnET0sPCJ7kLkn3qEquzhmnqwkp89ncfeh6tA1', '2017-06-01 00:10:25', NULL, NULL, 0, 0),
(8, 0, '', 'a', 'a', 'fluflux2003@gmail.com', '', NULL, NULL, '$2y$10$ipOfMELulkeR.V8AJlRcv.3mCevzhFLWI4VKjgkTh3lgMRr3ZYpLK', 'XVi7naNeXVIbB5EAi1FHDfQ0e2Jv51KhCCuBDS1W0PYihbwBle4kbKvzg0og', '2016-01-1 13:34:56', '2016-01-1 13:33:49', NULL, 0, 0),
(9, 0, '', 'H Le', 'Spencer', 'hlespencer@yahoo.com', '', NULL, NULL, '$2y$10$NJAHEmigHsVjoyFOQXI.x.uKR8LLnTtmZ.cInmzta2FzSshct1CUi', NULL, '2016-03-1 01:51:52', '2016-03-1 01:51:52', NULL, 0, 0),
(10, 0, '', 'Jared', 'Spencer', 'jaredspencer12@gmail.com', '', NULL, NULL, '$2a$06$ZVcdkzjUkyLvMzsqXLT15uWQzv.BUaulrLExJ2AUF7FEn2cUmS4OW', NULL, '2016-05-11 10:41:1', '2016-05-11 10:41:20', NULL, 0, 0),
(11, 1, '', 'Chase', 'Chase', 'chase@yellowbus.media', '12355556', NULL, NULL, '$2a$06$hkGLDs2U7D3Oj6icxaHkZucQUyGVVflmNIRSmlyL5rgo.XU.hdTf2', NULL, NULL, NULL, NULL, 0, 0),
(17, 0, '', 'R.C.', 'Kennedy', 'kennedyoutdoor9@gmail.com', '', NULL, NULL, '$2a$06$vADOw4zEYHs4LZYtJ5gqZeq2FNVlg894NIaewgAQHDxo1pYq0q.JW', 'bTdL2YFMpN7xDsx6qyraoqCkPnpYels2pYONWqUI7A14h13pDXbz2ay4BiU0', '2017-07-12 00:18:12', '2017-06-27 00:00:00', NULL, 2, 0),
(18, 0, '', 'Dave', 'Westburg', 'circlecitybillboards@gmail.com', '', NULL, NULL, '$2a$06$Qkzyhj1cFJ3.UC0lNUgDv.tkdhdAXiUR9niDXXluXscI0u0suxIWy', NULL, '2017-06-27 00:00:00', '2017-06-27 00:00:00', NULL, 2, 0),
(19, 0, '', 'Michael', 'Spencer', 'jim@mikeandjewels.com', '', NULL, NULL, '$2y$10$sJA8lrac290LS4OlgEm7i.YS3taypI.hXEd7cDxgoHm5vWTkR/aqq', NULL, '2017-06-27 00:00:00', '2017-06-27 00:00:00', NULL, 2, 0),
(20, 0, '', 'Dave', 'Westburg', 'circlecitybillboards@gmail.com', '', NULL, NULL, '$2y$10$veq8btbWItB0/DcvI9vnBeRA1k.1igUDberCp9KLSCsU8mQu/im4W', NULL, '2017-06-27 00:00:00', '2017-06-27 00:00:00', NULL, 3, 0),
(21, 0, '', 'Test', 'Test', 'test@test.com', '', NULL, NULL, '$2y$10$dgsinB8.oTsdJfUGUvt4J.gPmZJbiG343iPV8JArRkq/SPu1v3FiC', NULL, '2017-07-04 00:00:00', '2017-07-04 00:00:00', NULL, 1, 0),
(22, 0, '', 'Eric', 'Lambert', 'eric@independentoutdoor.com', '', NULL, NULL, '$2y$10$Uodmgn.Fd3AGvyUWa9uTZuWyd3cWKzmWJxiBIFiVVT846SCQPg0qu', 'b6TGZRyIKXhg8N8hEUEeJ61RC5Pb87DwF8BDu7sZXNAZAmyzMOzzyQjEGeq2', '2017-07-26 00:41:50', '2017-07-26 00:00:00', NULL, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_settings`
--

CREATE TABLE `users_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `posting_cycle` int(11) NOT NULL,
  `can_hold` int(11) NOT NULL,
  `release_hold_value` decimal(10,0) NOT NULL,
  `release_hool_period` int(11) NOT NULL,
  `allow_remove` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_role_permission`
--

CREATE TABLE `user_role_permission` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_proposal`
--
ALTER TABLE `active_proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `active_proposal_billboards`
--
ALTER TABLE `active_proposal_billboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billboard`
--
ALTER TABLE `billboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billboard_faces`
--
ALTER TABLE `billboard_faces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billboard_image`
--
ALTER TABLE `billboard_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_booking`
--
ALTER TABLE `client_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instance`
--
ALTER TABLE `instance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_billboard`
--
ALTER TABLE `proposal_billboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_comments`
--
ALTER TABLE `proposal_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_permissions`
--
ALTER TABLE `proposal_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_settings`
--
ALTER TABLE `users_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role_permission`
--
ALTER TABLE `user_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_proposal`
--
ALTER TABLE `active_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `active_proposal_billboards`
--
ALTER TABLE `active_proposal_billboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;
--
-- AUTO_INCREMENT for table `billboard`
--
ALTER TABLE `billboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `billboard_faces`
--
ALTER TABLE `billboard_faces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `client_booking`
--
ALTER TABLE `client_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instance`
--
ALTER TABLE `instance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `proposal_billboard`
--
ALTER TABLE `proposal_billboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1878;
--
-- AUTO_INCREMENT for table `proposal_comments`
--
ALTER TABLE `proposal_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
