-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2018 at 08:04 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `articles`
--

-- --------------------------------------------------------

--
-- Table structure for table `articlerelations`
--

CREATE TABLE `articlerelations` (
  `id` int(11) NOT NULL,
  `articleid` int(11) NOT NULL DEFAULT '0',
  `relationid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `languagekey` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT 'en',
  `iconid` int(11) NOT NULL DEFAULT '0',
  `slidercollectionid` int(11) NOT NULL DEFAULT '0',
  `publishid` int(11) NOT NULL DEFAULT '0',
  `pagetitle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `listtitle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `listdescription` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `seotitle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seodescription` text CHARACTER SET utf8 NOT NULL,
  `seokeywords` text CHARACTER SET utf8 NOT NULL,
  `websitetitle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `websiteurl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `trash` enum('no','yes') CHARACTER SET utf8 NOT NULL DEFAULT 'no',
  `adddate` date NOT NULL DEFAULT '1970-01-01',
  `modifydate` date NOT NULL DEFAULT '1970-01-01',
  `publishdate` date NOT NULL DEFAULT '1970-01-01',
  `expiredate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `languagekey`, `iconid`, `slidercollectionid`, `publishid`, `pagetitle`, `listtitle`, `listdescription`, `content`, `seotitle`, `seodescription`, `seokeywords`, `websitetitle`, `websiteurl`, `filename`, `ordernumber`, `trash`, `adddate`, `modifydate`, `publishdate`, `expiredate`) VALUES
(1, 'en', 0, 0, 1, 'Adventure World', 'Adventure World', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Adventure World', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'amusement,leisure,recreation,sport,circus,fairground,themepark,rollercoasters,manufacturers,suppliers,redemption,midway,carnivals,zoos,aquariums,pyrotechnics', 'Adventure World', 'http://www.adventureworld.net.au/', 'adventure-world', 76, 'no', '2018-01-02', '2018-01-03', '2018-01-02', '2020-12-31'),
(2, 'en', 0, 0, 1, 'Adventure Planet', 'Adventure Planet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Adventure Planet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Adventure Planet', 'http://www.adventureworld.net.au/', 'adventure-world', 76, 'no', '2018-01-03', '2018-01-04', '2018-01-03', '2020-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `languagekey` varchar(3) NOT NULL DEFAULT 'en',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `iconid` int(11) NOT NULL DEFAULT '0',
  `slidercollectionid` int(11) NOT NULL DEFAULT '0',
  `pagetitle` varchar(255) NOT NULL,
  `listtitle` varchar(255) NOT NULL,
  `listdescription` text NOT NULL,
  `content` text NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seodescription` text NOT NULL,
  `seokeywords` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `depth` int(11) NOT NULL DEFAULT '1',
  `ordernumber` int(11) NOT NULL,
  `trash` enum('no','yes') NOT NULL DEFAULT 'no',
  `idrange` text NOT NULL,
  `titlerange` text NOT NULL,
  `filenamerange` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `languagekey`, `parentid`, `iconid`, `slidercollectionid`, `pagetitle`, `listtitle`, `listdescription`, `content`, `seotitle`, `seodescription`, `seokeywords`, `filename`, `depth`, `ordernumber`, `trash`, `idrange`, `titlerange`, `filenamerange`) VALUES
(1, 'en', 0, 0, 0, 'Amusement Parks', 'Amusement Parks', 'Listings of individual amusement parks selected on countries', '&lt;p&gt;&lt;strong&gt;Listings of individual amusement parks selected on countries&lt;/strong&gt;&lt;/p&gt;', 'Amusement Parks', 'Listings of individual amusement parks selected on countries', 'theme park,park,rollercoaster,amusement,ride fairground,funfair,safety,accident,recreation,sport,turnstyle,swing,slide,playground,fitness,gazebos,prev', 'amusement-parks', 1, 1, 'no', '1', 'Amusement Parks', 'amusement-parks');

-- --------------------------------------------------------

--
-- Table structure for table `categoryarticles`
--

CREATE TABLE `categoryarticles` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `articleid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoryarticles`
--

INSERT INTO `categoryarticles` (`id`, `categoryid`, `articleid`) VALUES
(7830, 1, 1),
(7831, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categoryrelations`
--

CREATE TABLE `categoryrelations` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `relationid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `extension` varchar(6) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `active`) VALUES
(1, 'administrator', 'yes'),
(2, 'staff', 'yes'),
(3, 'editor', 'yes'),
(4, 'webmaster', 'yes'),
(5, 'writer', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL DEFAULT '0',
  `languagekey` varchar(3) NOT NULL DEFAULT 'en',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `emailaddress` varchar(255) NOT NULL,
  `trash` enum('no','yes') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleid`, `languagekey`, `username`, `password`, `realname`, `emailaddress`, `trash`) VALUES
(1, 1, 'en', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 'admin@localhost', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articlerelations`
--
ALTER TABLE `articlerelations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articlerelations_articlendx` (`articleid`),
  ADD KEY `articlerelations_relationndx` (`relationid`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_languagekey_ndx` (`languagekey`),
  ADD KEY `articles_iconid_ndx` (`iconid`),
  ADD KEY `articles_userid_ndx` (`publishid`),
  ADD KEY `articles_pagetitle_ndx` (`pagetitle`),
  ADD KEY `articles_listtitle_ndx` (`listtitle`),
  ADD KEY `articles_seotitle_ndx` (`seotitle`),
  ADD KEY `articles_filename_ndx` (`filename`),
  ADD KEY `articles_websitetitle_ndx` (`websitetitle`),
  ADD KEY `articles_websiteurl_ndx` (`websiteurl`),
  ADD KEY `articles_slidercollectionid_ndx` (`slidercollectionid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_languagekey_ndx` (`languagekey`),
  ADD KEY `categories_parentid_ndx` (`parentid`),
  ADD KEY `categories_iconid_ndx` (`iconid`),
  ADD KEY `categories_pagetitle_ndx` (`pagetitle`),
  ADD KEY `categories_listtitle_ndx` (`listtitle`),
  ADD KEY `categories_seotitle_ndx` (`seotitle`),
  ADD KEY `categories_filename_ndx` (`filename`),
  ADD KEY `categories_slidercollectionid_ndx` (`slidercollectionid`);

--
-- Indexes for table `categoryarticles`
--
ALTER TABLE `categoryarticles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `categoryarticles_categoryndx` (`categoryid`),
  ADD KEY `categoryarticles_articlendx` (`articleid`);

--
-- Indexes for table `categoryrelations`
--
ALTER TABLE `categoryrelations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryrelations_categoryndx` (`categoryid`),
  ADD KEY `categoryrelations_relationndx` (`relationid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_name_ndx` (`filename`),
  ADD KEY `images_path_ndx` (`path`),
  ADD KEY `images_extension_ndx` (`extension`),
  ADD KEY `images_thumbnail_ndx` (`thumbnail`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_username_ndx` (`username`),
  ADD KEY `users_password_ndx` (`password`),
  ADD KEY `users_realname_ndx` (`realname`),
  ADD KEY `users_emailaddress_ndx` (`emailaddress`),
  ADD KEY `users_roleid_ndx` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articlerelations`
--
ALTER TABLE `articlerelations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4359;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=634;
--
-- AUTO_INCREMENT for table `categoryarticles`
--
ALTER TABLE `categoryarticles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7832;
--
-- AUTO_INCREMENT for table `categoryrelations`
--
ALTER TABLE `categoryrelations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articlerelations`
--
ALTER TABLE `articlerelations`
  ADD CONSTRAINT `articlerelations_ibfk_1` FOREIGN KEY (`articleid`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articlerelations_ibfk_2` FOREIGN KEY (`relationid`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`publishid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categoryarticles`
--
ALTER TABLE `categoryarticles`
  ADD CONSTRAINT `categoryarticles_ibfk_1` FOREIGN KEY (`articleid`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categoryarticles_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categoryrelations`
--
ALTER TABLE `categoryrelations`
  ADD CONSTRAINT `categoryrelations_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categoryrelations_ibfk_2` FOREIGN KEY (`relationid`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
