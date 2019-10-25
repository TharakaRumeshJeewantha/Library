-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2019 at 03:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE IF NOT EXISTS `tbl_books` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `bk_no` int(11) NOT NULL,
  `bk_category_no` varchar(15) NOT NULL,
  `bk_name` varchar(250) NOT NULL,
  `bk_edition` varchar(5) NOT NULL,
  `bk_author` varchar(250) NOT NULL,
  `bk_publisher` varchar(250) NOT NULL,
  `bk_grade` int(11) NOT NULL,
  `bk_cost` varchar(10) NOT NULL,
  `bk_qty` int(11) NOT NULL,
  `bk_available` int(11) NOT NULL,
  `bk_damages` int(11) NOT NULL,
  `year` varchar(15) DEFAULT 'undefined',
  `page` int(11) NOT NULL,
  `path` varchar(150) NOT NULL,
  PRIMARY KEY (`bid`,`bk_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`bid`, `bk_no`, `bk_category_no`, `bk_name`, `bk_edition`, `bk_author`, `bk_publisher`, `bk_grade`, `bk_cost`, `bk_qty`, `bk_available`, `bk_damages`, `year`, `page`, `path`) VALUES
(10, 1, 'Green', 'Upandhina Saadhaya', 'i', 'Melani Amarathunga', 'Ashirwada', 0, '130', 5, 5, 0, '2018', 12, ''),
(11, 2, 'Green', 'Kageda me Bole', 'i', 'Melani Amarathunga', 'Ashirwada', 0, '150', 5, 5, 0, '0', 0, ''),
(12, 3, 'Green', 'Mata Badagini na', 'i', 'Melani Amarathunga', 'Ashirwada', 0, '150', 5, 5, 0, '2018', 12, ''),
(13, 4, 'Green', 'Man Asama kema', 'i', 'Melani Amarathunga', 'Ashirwada', 0, '150', 5, 5, 0, '', 12, ''),
(14, 5, 'Green', 'Kela Koochchiya', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 17, ''),
(15, 6, 'Green', 'Benso', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 24, ''),
(16, 7, 'Green', 'Rathu', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 16, ''),
(17, 8, 'Green', 'Ape Waththa', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 17, ''),
(18, 9, 'Green', 'Puduma Mala', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 17, ''),
(19, 10, 'Green', 'Kadima Ilakkaya', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 17, ''),
(20, 11, 'Green', 'Rabu Alaya Galawiyo', 'i', 'Prasanasa Kalukottage', 'Child World Picture Book', 0, '250', 5, 5, 0, '2015', 27, ''),
(21, 12, 'Green', 'Mage Muhuna', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(22, 13, 'Green', 'Pokune Saadhaya', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 8, ''),
(23, 14, 'Green', 'Punchi Tikiri', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '300', 5, 5, 0, '2019', 10, ''),
(24, 15, 'Green', 'Nayanage Thegga', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '300', 5, 5, 0, '2017', 15, ''),
(25, 16, 'Green', 'Ha Pimma', 'i', 'S. Sedara Hetti', 'Rankekulu', 0, '160', 5, 5, 0, '', 11, ''),
(26, 17, 'Green', 'Punchi Samanalige Udawwa', 'i', 'Thushari Indhika', 'Rankekulu', 0, '185', 5, 5, 0, '', 14, ''),
(27, 18, 'Green', 'Kauda Mama', 'i', 'N.I. Bandaranayaka', 'Rantharu Publications', 0, '140', 5, 5, 0, '', 8, ''),
(28, 19, 'Green', 'Punchi Thaara', 'i', 'N.I. Bandaranayaka', 'Rantharu Publications', 0, '140', 5, 5, 0, '', 8, ''),
(29, 20, 'Green', 'pancha', 'i', 'N.I. Bandaranayaka', 'Rantharu Publications', 0, '150', 5, 5, 0, '', 16, ''),
(30, 21, 'Red', 'Nattukkarayo', 'i', 'Sibil Weththasinha', 'Adith', 0, '175', 5, 5, 0, '', 13, ''),
(31, 22, 'Red', 'Kalu Manikaa', 'i', 'Sibil Weththasinha', 'Adith', 0, '150', 5, 5, 0, '2015', 12, ''),
(32, 23, 'Red', 'Wanduru Pancha', 'i', 'Ruwanthika Jayalath', 'Ashirwada', 0, '150', 5, 5, 0, '2016', 8, ''),
(33, 24, 'Red', 'Hoda Paadama', 'i', 'Ruwanthika Jayalath', 'Ashirwada', 0, '150', 5, 5, 0, '2016', 8, ''),
(34, 25, 'Red', 'Tikirige Udasana', 'i', 'Madhuri Pathmakanthi', 'As', 0, '150', 5, 5, 0, '2016', 8, ''),
(35, 26, 'Red', 'Mata Puluwan', 'i', 'Ruwanthika Jayalath', 'Ashirwada', 0, '150', 5, 5, 0, '', 8, ''),
(36, 27, 'Red', 'Amaalita Paadamak', 'i', 'Ruwanthika Jayalath', 'Ashirwada', 0, '150', 5, 5, 0, '2016', 8, ''),
(37, 28, 'Red', 'Sewanalla', 'i', 'Indra Seemathi', 'Ashirwada', 0, '500', 5, 5, 0, '', 16, ''),
(38, 29, 'Red', 'Kabeege Oralosuwa', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 16, ''),
(39, 30, 'Red', 'Polige Maligaawa', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 17, ''),
(40, 31, 'Red', 'Mama Saneepen', 'i', 'S.A.I.S. Perera', 'Ceylan Books Distributors', 0, '150', 5, 5, 0, '', 17, ''),
(41, 32, 'Red', 'Punchi Balu', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(42, 33, 'Red', 'Holi', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(43, 34, 'Red', 'Gembi Haaminege Pokuna', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(44, 35, 'Red', 'Nai Haamige Hinaawa', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(45, 36, 'Red', 'Dagakaara mee Pancha', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(46, 37, 'Red', 'Teri', 'i', 'W.G.S.R. Bandara', 'E & S', 0, '180', 5, 5, 0, '2017', 9, ''),
(47, 38, 'Red', 'Biththara ko', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 8, ''),
(48, 39, 'Red', 'Udaw Karanno', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 8, ''),
(49, 40, 'Red', 'Ha Sellama', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(50, 41, 'Red', 'Hewanella', 'i', 'S.A.I.S. Perera', 'E & S', 0, '150', 5, 5, 0, '', 16, ''),
(51, 42, 'Red', 'Binduge Pinthuraya', 'i', 'Sepali De Silva', 'E & S Print Solutions', 0, '250', 5, 5, 0, '', 20, ''),
(52, 43, 'Red', 'Binduge Upaaya', 'i', 'Sepali De Silva', 'E & S Print Solutions', 0, '250', 5, 5, 0, '', 16, ''),
(53, 44, 'Red', 'Nilu saha Sudu', 'i', 'Ranjani Premachandra', 'E & S Print Solutions', 0, '250', 5, 5, 0, '', 16, ''),
(54, 45, 'Red', 'Kauda Heda', 'i', 'Thanuja N. Ayagama', 'Graphicare', 0, '1', 5, 5, 0, '2017', 16, ''),
(55, 46, 'Red', 'Puus Pataw Thundena', 'i', 'Padma Harsha Kuranage', 'Kanol', 0, '125', 5, 5, 0, '', 12, ''),
(56, 47, 'Red', 'Mal Gawma', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '300', 5, 5, 0, '2015', 6, ''),
(57, 48, 'Red', 'Ha Haami', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '300', 5, 5, 0, '', 8, ''),
(58, 49, 'Red', 'Api Kawda', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '300', 5, 5, 0, '2019', 8, ''),
(59, 50, 'Red', 'Babage Kathawa', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '325', 5, 5, 0, '2011', 20, ''),
(60, 51, 'Red', 'Ali Raalage ali Lede', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '325', 5, 5, 0, '', 16, ''),
(61, 52, 'Red', 'Hangi Muththo Hangiyo', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '490', 5, 5, 0, '2017', 16, ''),
(62, 53, 'Red', 'Ha Ha Hachis', 'i', 'Ramya Nawarathna', 'Ramya Nawarathna', 0, '600', 1, 1, 0, '', 15, ''),
(63, 54, 'Red', 'Kale Perahera', 'i', 'S. Sedara Hetti', 'Rankekulu', 0, '160', 5, 5, 0, '2017', 11, ''),
(64, 55, 'Red', 'Atharaman wu Yaluwo', 'i', 'H.A. Binula Deemantha', 'Rankekulu', 0, '260', 5, 5, 0, '2017', 11, ''),
(65, 58, 'Red', 'Apata Sahayawanno', 'i', 'Thushari Indhika Bandara', 'Rankekulu', 0, '160', 5, 5, 0, '2017', 11, ''),
(66, 56, 'Red', 'Lassana Kurulu Kuuduwa', 'i', 'Thushari Indhika', 'Rankekulu', 0, '260', 5, 5, 0, '2017', 10, ''),
(67, 57, 'Red', 'Kumbal Gedara', 'i', 'S. Sedara Hetti', 'Rankekulu', 0, '160', 5, 5, 0, '2017', 11, ''),
(68, 59, 'Red', 'Thoppi Baba', 'i', 'N.I. Bandaranayaka', 'Rantharu Publications', 0, '150', 5, 5, 0, '', 12, ''),
(69, 60, 'Red', 'Punchi Weeraya', 'i', 'N.I. Bandaranayaka', 'Rantharu Publications', 0, '150', 5, 5, 0, '', 16, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books_damages`
--

CREATE TABLE IF NOT EXISTS `tbl_books_damages` (
  `bk_id` int(11) NOT NULL AUTO_INCREMENT,
  `bk_no` int(11) NOT NULL,
  `reason` varchar(12) NOT NULL,
  `comment` varchar(150) NOT NULL,
  PRIMARY KEY (`bk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_day_time`
--

CREATE TABLE IF NOT EXISTS `tbl_day_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(10) NOT NULL,
  `time` varchar(50) NOT NULL,
  `tid` varchar(20) NOT NULL,
  `grade` int(11) NOT NULL,
  `class` varchar(2) NOT NULL,
  `students` int(11) NOT NULL,
  `status` varchar(5) NOT NULL,
  `day_time` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_day_time`
--

INSERT INTO `tbl_day_time` (`id`, `day`, `time`, `tid`, `grade`, `class`, `students`, `status`, `day_time`) VALUES
(1, 'Monday', '11 a.m. To 11.30 a.m.', '86-7442-863 (v)', 1, 'A', 30, 'yes', 'Monday (11 a.m. To 11.30 a.m.)'),
(2, 'Monday', '12 p.m. To 12.30 p.m.', '88-6753-403 (v)', 1, 'B', 30, 'yes', 'Monday (12 p.m. To 12.30 p.m.)'),
(3, 'Tuesday', '11 a.m. To 11.30 a.m.', '88-5751-504 (v)', 2, 'A', 30, 'yes', 'Tuesday (11 a.m. To 11.30 a.m.)'),
(4, 'Tuesday', '12 p.m. To 12.30 p.m.', '78-5620-771 (v)', 2, 'B', 30, 'yes', 'Tuesday (12 p.m. To 12.30 p.m.)'),
(5, 'Wednesday', '11 a.m. To 11.30 a.m.', '65-7774-200 (v)', 3, 'A', 30, 'yes', 'Wednesday (11 a.m. To 11.30 a.m.)'),
(6, 'Wednesday', '12 p.m. To 12.30 p.m.', '81-8323-360 (v)', 3, 'B', 30, 'yes', 'Wednesday (12 p.m. To 12.30 p.m.)'),
(7, 'Thursday', '11 a.m. To 11.30 a.m.', '79-5162-283 (v)', 4, 'A', 30, 'yes', 'Thursday (11 a.m. To 11.30 a.m.)'),
(8, 'Thursday', '12 p.m. To 12.30 p.m.', '79-5400-290 (v)', 4, 'B', 30, 'yes', 'Thursday (12 p.m. To 12.30 p.m.)'),
(9, 'Friday', '11 a.m. To 11.30 a.m.', '79-6541-130 (v)', 5, 'A', 30, 'yes', 'Friday (11 a.m. To 11.30 a.m.)'),
(10, 'Friday', '12 p.m. To 12.30 p.m.', '79-7090-794 (v)', 5, 'B', 30, 'yes', 'Friday (12 p.m. To 12.30 p.m.)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE IF NOT EXISTS `tbl_students` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `std_fname` varchar(250) NOT NULL,
  `std_lname` varchar(250) NOT NULL,
  `std_reg_no` int(11) NOT NULL,
  `std_gender` varchar(10) NOT NULL,
  `std_grade` int(11) NOT NULL,
  `std_class` varchar(2) NOT NULL,
  `teacher` varchar(250) NOT NULL,
  `std_read` int(11) NOT NULL,
  PRIMARY KEY (`sid`,`std_reg_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE IF NOT EXISTS `tbl_teachers` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_fname` varchar(250) NOT NULL,
  `t_lname` varchar(250) NOT NULL,
  `t_birthday` date NOT NULL,
  `t_nic` varchar(15) NOT NULL,
  `t_phone` varchar(15) NOT NULL,
  `t_address` varchar(500) NOT NULL,
  `t_gender` varchar(10) NOT NULL,
  `t_subject` varchar(50) NOT NULL,
  `t_grade` int(11) NOT NULL,
  `t_class` varchar(2) NOT NULL,
  `t_day` varchar(15) NOT NULL,
  `t_period` varchar(25) NOT NULL,
  `t_students` int(11) NOT NULL,
  `day_time` varchar(150) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`t_id`, `t_fname`, `t_lname`, `t_birthday`, `t_nic`, `t_phone`, `t_address`, `t_gender`, `t_subject`, `t_grade`, `t_class`, `t_day`, `t_period`, `t_students`, `day_time`) VALUES
(11, 'P.M. Udeshika', 'Priyadarshani Kumari', '1986-08-31', '86-7442-863 (v)', '(071) 789-7980', 'No 2, Wikramasingha Mawatha, Maoya, Bendiwewa\r\nJayanthipura, Polonnaruwa', 'Female', 'Class Teacher', 1, 'A', '', '', 30, 'Monday (11 a.m. To 11.30 a.m.)'),
(12, 'B.G. Madhushi Neelanayani', 'Basnayaka', '1988-06-23', '88-6753-403 (v)', '(078) 344-9825', 'Hunugalhena, Galathara, Mawanella', 'Female', 'Class Teacher', 1, 'B', '', '', 30, 'Monday (12 p.m. To 12.30 p.m.)'),
(13, 'P.W. Thilini', 'Sandamali', '1988-03-15', '88-5751-504 (v)', '(071) 954-1210', 'No 41, Galthalawa, Dewagala, Polonnaruwa', 'Female', 'Class Teacher', 2, 'A', '', '', 30, 'Tuesday (11 a.m. To 11.30 a.m.)'),
(14, 'S. Rasika Hemamali', 'Vipulasena', '1978-03-02', '78-5620-771 (v)', '(071) 679-7359', 'No 170, Rathmalthenna, Aralaganvila', 'Female', 'Class Teacher', 2, 'B', '', '', 30, 'Tuesday (12 p.m. To 12.30 p.m.)'),
(15, 'P.K.G. Wijitha', 'Mallika', '1965-10-03', '65-7774-200 (v)', '(076) 471-1223', 'No 61, Youngama, Aralaganvila', 'Female', 'Class Teacher', 3, 'A', '', '', 30, 'Wednesday (11 a.m. To 11.30 a.m.)'),
(16, 'A.P.G. Kanchana Widarshika', 'Priyadarshani', '1981-11-27', '81-8323-360 (v)', '(070) 298-2367', 'No 38, Track 05, Aralaganvila', 'Female', 'Class Teacher', 3, 'B', '', '', 30, 'Wednesday (12 p.m. To 12.30 p.m.)'),
(17, 'D.M. Chandani', 'Dissanayake', '1979-01-16', '79-5162-283 (v)', '(075) 889-8215', 'No 103, Yaya 05, Aralaganvila', 'Female', 'Class Teacher', 4, 'A', '', '', 30, 'Thursday (11 a.m. To 11.30 a.m.)'),
(18, 'W.K.A. Champika Deepthi', 'Weerasinghe', '1979-02-09', '79-5400-290 (v)', '(077) 938-4780', 'No 35, Alawakumbura, Maduruoya', 'Female', 'Class Teacher', 4, 'B', '', '', 30, 'Thursday (12 p.m. To 12.30 p.m.)'),
(19, 'P.G. Damayanthi Jayalath', 'Menike', '1979-06-02', '79-6541-130 (v)', '(070) 294-2995', 'No 23/4, Yaya 04, Wewa road, Aralaganvila', 'Female', 'Class Teacher', 5, 'A', '', '', 30, 'Friday (11 a.m. To 11.30 a.m.)'),
(20, 'P.K.G. Wasantha Nandani', 'Wijewardhana', '1979-07-27', '79-7090-794 (v)', '(071) 468-8609', 'No 116A, Track 05, Aralaganvila', 'Female', 'Class Teacher', 5, 'B', '', '', 30, 'Friday (12 p.m. To 12.30 p.m.)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `bk_issued_date` date NOT NULL,
  `bk_should_return_date` date NOT NULL,
  `bk_returned_date` date NOT NULL,
  `std_no` int(11) NOT NULL,
  `bk_no` int(11) NOT NULL,
  `t_status` varchar(10) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tp` varchar(15) NOT NULL,
  `un` varchar(250) NOT NULL,
  `pw` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `info` varchar(1000) NOT NULL,
  `birthday` date DEFAULT NULL,
  `school` varchar(250) NOT NULL,
  `nic` varchar(15) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`uid`, `first_name`, `last_name`, `email`, `tp`, `un`, `pw`, `image`, `address`, `info`, `birthday`, `school`, `nic`) VALUES
(16, 'Tharaka Rumesh', 'Jeewantha', 'wm.tharaka.rumesh@gmail.com', '(078) 387-0064', 'tharaka', 'c9b359951c09c5d04de4f852746671ab2b2d0994', 'upload/IMG_1078_1564307771.JPG', 'Pothanegama', 'Software Engineer, Developer', '1992-04-09', '', '92-1000-103 (v)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
