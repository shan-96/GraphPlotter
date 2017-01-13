-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2016 at 01:40 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graphs`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) UNSIGNED NOT NULL COMMENT 'Primary Key ',
  `postTitle` varchar(255) DEFAULT NULL COMMENT 'Title of each Blog Post',
  `postDesc` text COMMENT 'Small Description of each Blog Post',
  `postCont` text COMMENT 'Contents of blog post ',
  `postDate` datetime DEFAULT NULL COMMENT 'Post creation time',
  `graphUrl` varchar(100) NOT NULL COMMENT 'External link to any page'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`, `graphUrl`) VALUES
(1, 'trial', '<p>xm,cnKXN&nbsp;</p>\r\n<p>xznclkZX</p>\r\n<p>xzm,,m.</p>\r\n<p>&nbsp;</p>', '<p>fkjha;k</p>\r\n<p>c,xvbzk;j</p>\r\n<p>lvhldnv</p>\r\n<p>vndf,mvkdfv;</p>\r\n<p>&nbsp;53e6528236876827</p>', '2016-11-14 12:43:12', 'http://localhost/7/plotter2.php?id=3');

--
-- Triggers `blog_posts`
--
DELIMITER $$
CREATE TRIGGER `blog_delete` BEFORE DELETE ON `blog_posts` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.postID as CHAR));

insert into log (type,tablename,comment) values ('delete','blog_posts',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `blog_insert` AFTER INSERT ON `blog_posts` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.postID as CHAR));

insert into log (type,tablename,comment) values ('insert','blog_posts',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `blog_update` BEFORE UPDATE ON `blog_posts` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.postID as CHAR));

insert into log (type,tablename,comment) values ('update','blog_posts',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL COMMENT 'Primary Key ',
  `blog_id` int(11) NOT NULL COMMENT 'Foreign Key (blog_posts)',
  `memberId` int(11) NOT NULL COMMENT 'Foreign key (users)',
  `text` varchar(100) NOT NULL COMMENT 'content of comment',
  `timestamp` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'comment time'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `blog_id`, `memberId`, `text`, `timestamp`) VALUES
(2, 1, 14, 'sss', '2016-11-14 16:35:11'),
(3, 1, 14, '"asdnjnds"', '2016-11-14 16:37:06'),
(14, 1, 14, 'fuck you ', '2016-11-14 16:42:23'),
(15, 1, 14, 'er', '2016-11-14 16:44:27');

--
-- Triggers `comments`
--
DELIMITER $$
CREATE TRIGGER `comment_delete` BEFORE DELETE ON `comments` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.c_id as CHAR));

insert into log (type,tablename,comment) values ('delete','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `comment_insert` AFTER INSERT ON `comments` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.c_id as CHAR));

insert into log (type,tablename,comment) values ('insert','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `comment_update` BEFORE UPDATE ON `comments` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.c_id as CHAR));

insert into log (type,tablename,comment) values ('update','comments',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `comment_view`
--
CREATE TABLE `comment_view` (
`username` varchar(40)
,`memberId` int(11)
,`blog_id` int(11)
,`text` varchar(100)
,`timestamp` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(10) NOT NULL COMMENT 'Primary Key',
  `name` varchar(100) DEFAULT NULL COMMENT 'Name of Dataset',
  `label_x` varchar(50) DEFAULT NULL COMMENT 'X-Axis Label',
  `label_y` varchar(50) NOT NULL COMMENT 'Y-Axis Label'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `name`, `label_x`, `label_y`) VALUES
(2, 'volume vs temperature', 'Volume ', 'temeperature'),
(3, 'SALES', 'QUARTER', 'QUANTITY'),
(4, 'Football Ratings(2k16)', 'skill', 'score'),
(5, 'test', 'x', 'y'),
(6, 'trial', 'k', 't'),
(8, 'shantanu', 'xlabel', 'ylabel');

--
-- Triggers `dataset`
--
DELIMITER $$
CREATE TRIGGER `dataset_delete` BEFORE DELETE ON `dataset` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.id as CHAR));

insert into log (type,tablename,comment) values ('delete','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `dataset_insert` AFTER INSERT ON `dataset` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.id as CHAR));

insert into log (type,tablename,comment) values ('insert','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `dataset_update` BEFORE UPDATE ON `dataset` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.id as CHAR));

insert into log (type,tablename,comment) values ('update','comments',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `graph1`
--

CREATE TABLE `graph1` (
  `gid` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(100) DEFAULT NULL COMMENT 'Graph Name',
  `did` int(11) NOT NULL COMMENT 'Foreign Key (dataset)',
  `type` varchar(32) NOT NULL COMMENT 'Type of Graph',
  `subtitle` text NOT NULL COMMENT 'Subtitle for Graph',
  `tooltip` varchar(32) NOT NULL COMMENT 'Text for tooltip',
  `mousetracking` tinyint(1) NOT NULL COMMENT 'Boolean - is mouse tracking required?',
  `datalabels` tinyint(1) NOT NULL COMMENT 'Boolean - datalabels required?',
  `shadow` tinyint(1) NOT NULL COMMENT 'Boolean - is shadow required?',
  `backgroundColor` varchar(10) NOT NULL,
  `legendBackgroundColor` varchar(10) NOT NULL,
  `plotBackgroundColor` varchar(10) NOT NULL,
  `borderColor` varchar(10) NOT NULL,
  `borderWidth` int(11) NOT NULL,
  `height` int(11) NOT NULL COMMENT 'height of graph in pixels',
  `width` int(11) NOT NULL COMMENT 'width of graph in pixels',
  `minimum` int(11) NOT NULL DEFAULT '0' COMMENT 'minimum value on Y Axis'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graph1`
--

INSERT INTO `graph1` (`gid`, `name`, `did`, `type`, `subtitle`, `tooltip`, `mousetracking`, `datalabels`, `shadow`, `backgroundColor`, `legendBackgroundColor`, `plotBackgroundColor`, `borderColor`, `borderWidth`, `height`, `width`, `minimum`) VALUES
(2, 'Sales (2013 - 2015)', 3, 'bar', 'Quarterly  Sales', 'Units', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', '000000', 4, 500, 500, 0),
(3, 'test3', 2, 'column', 'sub3', 'sq mtrs', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', 'FFFFFF', 3, 400, 400, -5),
(4, 'thegraph', 2, 'bar', 'subtitle', 'units', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', '000000', 3, 600, 600, 0),
(5, 'Sales (2015 -2016)', 3, 'area', 'Quarterly sales', 'units', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFF2F2', 'FFFFFF', 7, 450, 450, 0),
(6, 'Sales Complete', 3, 'line', 'Quartely Sales', 'units', 1, 1, 1, 'D1EDFF', 'FFFFFF', 'D1EDFF', '78FFE7', 10, 600, 600, 0),
(7, 'Player Comparison1', 4, 'column', 'Messi vs Ronaldo', 'Points', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', 'FFFFFF', 2, 500, 500, 70),
(8, 'Player Comparison2', 4, 'line', 'All players', 'Points', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', '2E2E2E', 3, 500, 500, 20),
(9, 'g', 2, 'pie', 'g', 'atm', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', 'FFFFFF', 5, 500, 500, 0),
(10, 't', 5, 'bar', 't', 'j', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', 'FFFFFF', 2, 500, 500, 0),
(11, 'acd', 6, 'bar', 'a', 'a', 1, 1, 1, 'FFFFFF', 'FFFFFF', 'FFFFFF', 'FFFFFF', 10, 400, 400, 0);

--
-- Triggers `graph1`
--
DELIMITER $$
CREATE TRIGGER `graph1_delete` BEFORE DELETE ON `graph1` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.gid as CHAR));

insert into log (type,tablename,comment) values ('delete','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `graph1_insert` AFTER INSERT ON `graph1` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.gid as CHAR));

insert into log (type,tablename,comment) values ('insert','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `graph1_update` BEFORE UPDATE ON `graph1` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.gid as CHAR));

insert into log (type,tablename,comment) values ('update','comments',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `graph2`
--

CREATE TABLE `graph2` (
  `gid` int(11) NOT NULL COMMENT 'Foreign Key(graph1)',
  `vid` int(11) NOT NULL COMMENT 'Valueset to be displayed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graph2`
--

INSERT INTO `graph2` (`gid`, `vid`) VALUES
(2, 1),
(2, 2),
(4, 1),
(4, 2),
(4, 4),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(3, 1),
(3, 2),
(9, 1),
(7, 1),
(7, 2),
(10, 1),
(10, 2),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tablename` varchar(20) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `type`, `timestamp`, `tablename`, `comment`) VALUES
(1, 'insert', '2016-11-14 17:15:54', 'users', 'ID=15'),
(2, 'update', '2016-11-14 17:28:35', 'blog_posts', 'ID=1');

-- --------------------------------------------------------

--
-- Table structure for table `uac`
--

CREATE TABLE `uac` (
  `id` int(10) NOT NULL COMMENT 'Primary Key',
  `uid` int(10) NOT NULL COMMENT 'Foreign Key(users)',
  `did` int(10) NOT NULL COMMENT 'Foreign Key(dataset)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uac`
--

INSERT INTO `uac` (`id`, `uid`, `did`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 12, 4),
(4, 13, 5),
(5, 13, 4),
(6, 13, 6),
(7, 14, 7),
(8, 14, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `memberID` int(11) NOT NULL COMMENT 'Primary Key',
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`memberID`, `username`, `password`, `email`) VALUES
(1, '733GuiltySpark', '$2y$10$od6QF6CcmI6l9rsioF5YjOI5pAK6TbEZgLNy3mmQdbDNBMAU1gUWK', 'mh18ab3632@gmail.com'),
(12, 's', '$2y$10$tAw2zjgKQres8.jbEN3ssuysaeIhLgmc4itbNs.OVml1ZY9fxfW7K', 's@s.c'),
(13, 'v', '$2y$10$AOJe/tjWoj4z9/5YY4GI7u.BdLRQMDHnjcSlO88auDGG5ri90Gdu6', 'v@v.c'),
(14, 'sc', '$2y$10$oIbS4wpCd4V/dAFcamXaBuxj3A28DkeCrHlfuPQvU.XfqbApNTmfK', 'sc@sc.com');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `user_delete` BEFORE DELETE ON `users` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.MemberID as CHAR));

insert into log (type,tablename,comment) values ('delete','users',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_insert` AFTER INSERT ON `users` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.MemberID as CHAR));

insert into log (type,tablename,comment) values ('insert','users',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_update` BEFORE UPDATE ON `users` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.MemberID as CHAR));

insert into log (type,tablename,comment) values ('update','users',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `valueset`
--

CREATE TABLE `valueset` (
  `id` int(10) NOT NULL COMMENT 'Primary Key',
  `dataset_id` int(10) NOT NULL COMMENT 'Foreign Key(dataset)',
  `valueset_id` int(10) NOT NULL,
  `coord_x` varchar(100) NOT NULL COMMENT 'Label x coordinate',
  `coord_y` float(30,3) NOT NULL COMMENT 'Value of y coordinate',
  `pos_no` int(10) NOT NULL COMMENT 'position number'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valueset`
--

INSERT INTO `valueset` (`id`, `dataset_id`, `valueset_id`, `coord_x`, `coord_y`, `pos_no`) VALUES
(1, 2, 1, '2', 5.000, 1),
(2, 2, 1, '7', 15.000, 2),
(3, 2, 2, '2', 10.000, 1),
(4, 2, 2, '7', 20.000, 2),
(5, 2, 1, '8', 17.000, 3),
(6, 2, 1, '9', 65.000, 4),
(7, 2, 2, '8', 34.000, 3),
(8, 2, 2, '9', 73.000, 4),
(9, 3, 1, 'quarter 1', 25.000, 1),
(10, 3, 1, 'quarter 2', 45.000, 2),
(11, 3, 1, 'quarter 3', 23.000, 3),
(12, 3, 1, 'quarter 4', 42.000, 4),
(13, 3, 2, 'quarter 1', 45.000, 1),
(14, 3, 2, 'quarter 2', 45.000, 2),
(15, 3, 2, 'quarter 3', 15.000, 3),
(16, 3, 2, 'quarter 4', 21.000, 4),
(17, 3, 3, 'quarter 1', 55.000, 1),
(18, 3, 3, 'quarter 2', 10.000, 2),
(19, 3, 3, 'quarter 3', 35.000, 3),
(20, 3, 3, 'quarter 4', 41.000, 4),
(21, 3, 4, 'quarter 1', 21.000, 1),
(22, 3, 4, 'quarter 2', 60.000, 2),
(23, 3, 4, 'quarter 3', 5.000, 3),
(24, 3, 4, 'quarter 4', 62.000, 4),
(25, 4, 1, 'Pass', 89.000, 1),
(26, 4, 1, 'shoot', 94.000, 2),
(27, 4, 1, 'dribble', 92.000, 3),
(28, 4, 2, 'Pass', 90.000, 1),
(29, 4, 2, 'shoot', 95.000, 2),
(30, 4, 2, 'dribble', 89.000, 3),
(31, 4, 3, 'Pass', 84.000, 1),
(32, 4, 3, 'shoot', 91.000, 2),
(34, 4, 4, 'Pass', 55.000, 1),
(35, 4, 4, 'shoot', 34.000, 2),
(36, 4, 4, 'dribble', 38.000, 3),
(37, 5, 1, '5', 10.000, 1),
(38, 5, 2, '5', 15.000, 1),
(39, 4, 3, 'dribble', 88.000, 3),
(41, 6, 1, '1', 1.000, 1),
(42, 6, 1, '2', 2.000, 2),
(43, 6, 1, '3', 56.000, 3),
(48, 8, 1, 'xv001', 0.000, 1),
(49, 8, 1, 'xv001', 0.000, 2),
(50, 8, 2, 'xv011', 0.000, 1),
(51, 8, 2, 'xv012', 0.000, 2),
(52, 8, 2, 'xv013', 0.000, 3);

--
-- Triggers `valueset`
--
DELIMITER $$
CREATE TRIGGER `valueset_delete` BEFORE DELETE ON `valueset` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(oldold.id as CHAR));

insert into log (type,tablename,comment) values ('delete','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `valueset_insert` AFTER INSERT ON `valueset` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.id as CHAR));

insert into log (type,tablename,comment) values ('insert','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `valueset_update` BEFORE UPDATE ON `valueset` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(oldold.id as CHAR));

insert into log (type,tablename,comment) values ('update','comments',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `valueset_name`
--

CREATE TABLE `valueset_name` (
  `dataset_id` int(10) NOT NULL COMMENT 'Foreign Key(dataset)',
  `valueset_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Name for the given valueset'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valueset_name`
--

INSERT INTO `valueset_name` (`dataset_id`, `valueset_id`, `name`) VALUES
(2, 1, 'Pressure = 100 atm'),
(2, 2, 'Preassure = 200 atm'),
(3, 1, 'year 2014'),
(3, 2, 'Year 2015'),
(3, 3, 'Year 2016'),
(3, 4, 'Year 2013'),
(4, 1, 'Messi'),
(4, 2, 'Ronaldo'),
(4, 3, 'Lewandowski'),
(4, 4, 'Rooney'),
(5, 1, 't1'),
(5, 2, 't2'),
(6, 1, '1'),
(8, 1, 'v001'),
(8, 2, 'v002');

--
-- Triggers `valueset_name`
--
DELIMITER $$
CREATE TRIGGER `valuesetname_delete` BEFORE DELETE ON `valueset_name` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.dataset_id as CHAR),' & ',cast(old.valueset_id as CHAR));

insert into log (type,tablename,comment) values ('delete','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `valuesetname_insert` AFTER INSERT ON `valueset_name` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(new.dataset_id as CHAR),' & ',cast(new.valueset_id as CHAR));

insert into log (type,tablename,comment) values ('insert','comments',msg);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `valuesetname_update` BEFORE UPDATE ON `valueset_name` FOR EACH ROW begin
DECLARE msg varchar(200);

set msg = CONCAT('ID=',cast(old.dataset_id as CHAR),' & ',cast(new.valueset_id as CHAR));

insert into log (type,tablename,comment) values ('update','comments',msg);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `comment_view`
--
DROP TABLE IF EXISTS `comment_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `comment_view`  AS  select `users`.`username` AS `username`,`comments`.`memberId` AS `memberId`,`comments`.`blog_id` AS `blog_id`,`comments`.`text` AS `text`,`comments`.`timestamp` AS `timestamp` from (`comments` join `users` on((`comments`.`memberId` = `users`.`memberID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graph1`
--
ALTER TABLE `graph1`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uac`
--
ALTER TABLE `uac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `valueset`
--
ALTER TABLE `valueset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valueset_name`
--
ALTER TABLE `valueset_name`
  ADD PRIMARY KEY (`dataset_id`,`valueset_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key ', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `graph1`
--
ALTER TABLE `graph1`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `uac`
--
ALTER TABLE `uac`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `valueset`
--
ALTER TABLE `valueset`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
