-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018 m. Rgp 12 d. 15:04
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autdata105`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `bans`
--

CREATE TABLE `bans` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `reason` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `friends`
--

CREATE TABLE `friends` (
  `ID` int(11) NOT NULL,
  `userID1` int(11) NOT NULL,
  `userID2` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `friends`
--

INSERT INTO `friends` (`ID`, `userID1`, `userID2`, `accepted`) VALUES
(5, 1, 4, 1),
(6, 4, 6, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL DEFAULT '0',
  `receiverID` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `sentTime` int(11) NOT NULL,
  `msgOwner` int(11) NOT NULL,
  `msgRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `messages`
--

INSERT INTO `messages` (`ID`, `senderID`, `receiverID`, `title`, `content`, `sentTime`, `msgOwner`, `msgRead`) VALUES
(192, 1, 0, 'asdasd', '<p>asdasdasdas</p>', 1527009346, 0, 0),
(193, 0, 0, 'aasdadsa', '<p>asdasdas</p>', 1527009374, 0, 0),
(195, 0, 3, 'aasdadsa', '<p>asdasdas</p>', 1527009374, 3, 0),
(196, 0, 4, 'aasdadsa', '<p>asdasdas</p>', 1527009374, 4, 0),
(197, 0, 5, 'aasdadsa', '<p>asdasdas</p>', 1527009374, 5, 0),
(198, 0, 6, 'aasdadsa', '<p>asdasdas</p>', 1527009374, 6, 0),
(199, 0, 7, 'aasdadsa', '<p>asdasdas</p>', 1527009374, 7, 1),
(207, 1, 0, 'asdasd', '<p>&nbsp;&nbsp;&nbsp;&nbsp;</p><p>asdasdasdasdasd</p>', 1533473228, 0, 0),
(201, 1, 3, 'asdasda', '<p>asdasdadasda</p>', 1527009590, 3, 0),
(203, 1, 3, 'asdasdasd', '<p>asdaksdkasd</p>', 1527009699, 3, 0),
(205, 1, 0, 'fgdfg', '<p>mnmbmn</p>', 1531057585, 0, 0),
(217, 1, 4, 'sdfsdf', '<p>sdfsdf</p>', 1533478615, 4, 0),
(215, 1, 0, 'asdjkskd', '<p><u><b>adsasdasdasadsadsa</b>adasd</u>dasda</p>', 1533473661, 0, 0),
(183, 0, 7, 'Yes? really?', '<p>Creating best system</p>', 1527008529, 7, 1),
(184, 0, 0, 'fgdfg', '<p>dfgd</p>', 1527009283, 0, 0),
(209, 1, 0, 'sadjasdk', '<p>asjkdakjsd</p><p><br></p>', 1533473444, 0, 0),
(186, 0, 3, 'fgdfg', '<p>dfgd</p>', 1527009283, 3, 0),
(187, 0, 4, 'fgdfg', '<p>dfgd</p>', 1527009283, 4, 0),
(188, 0, 5, 'fgdfg', '<p>dfgd</p>', 1527009283, 5, 0),
(189, 0, 6, 'fgdfg', '<p>dfgd</p>', 1527009283, 6, 0),
(190, 0, 7, 'fgdfg', '<p>dfgd</p>', 1527009283, 7, 1),
(166, 4, 1, 'sv lavone', '<p>Sveikas lavone, kodel editini mano sita shouta??</p>', 1526487832, 4, 0),
(180, 0, 4, 'Yes? really?', '<p>Creating best system</p>', 1527008529, 4, 0),
(181, 0, 5, 'Yes? really?', '<p>Creating best system</p>', 1527008529, 5, 0),
(182, 0, 6, 'Yes? really?', '<p>Creating best system</p>', 1527008529, 6, 0),
(107, 0, 3, 'Sveikas atvykes i zaidima', 'Sveikas, tai ka tik atsidares naujas zaidimas, kuriame vis dar gali pasiekti viska, svarbiausia jau dabar pradeti zaisti.<Br>Gali rasti GUIDE kaip zaisti stai cia, paspausk arba ne <p>Sekmes zaidime ;)</p>', 1525803912, 3, 0),
(106, 0, 3, 'Sveikas atvykes i zaidima', 'Sveikas, tai ka tik atsidares naujas zaidimas, kuriame vis dar gali pasiekti viska, svarbiausia jau dabar pradeti zaisti.<Br>Gali rasti GUIDE kaip zaisti stai cia, paspausk arba ne <p>Sekmes zaidime ;)</p>', 1525803897, 3, 1),
(179, 0, 3, 'Yes? really?', '<p>Creating best system</p>', 1527008529, 3, 0),
(177, 0, 0, 'Yes? really?', '<p>Creating best system</p>', 1527008529, 0, 0),
(176, 0, 7, 'Hello!!!', '<p>Hi, we want to just test this system.<br>asd<br>Asd<br><b>ASd</b></p><p><b><br></b></p><p><u>asd</u></p>', 1527008489, 7, 1),
(175, 0, 6, 'Hello!!!', '<p>Hi, we want to just test this system.<br>asd<br>Asd<br><b>ASd</b></p><p><b><br></b></p><p><u>asd</u></p>', 1527008489, 6, 0),
(174, 0, 5, 'Hello!!!', '<p>Hi, we want to just test this system.<br>asd<br>Asd<br><b>ASd</b></p><p><b><br></b></p><p><u>asd</u></p>', 1527008489, 5, 0),
(211, 1, 0, 'askdjaskjd', '<p>askdjskdj</p><p><br></p>', 1533473452, 0, 0),
(172, 0, 3, 'Hello!!!', '<p>Hi, we want to just test this system.<br>asd<br>Asd<br><b>ASd</b></p><p><b><br></b></p><p><u>asd</u></p>', 1527008489, 3, 0),
(173, 0, 4, 'Hello!!!', '<p>Hi, we want to just test this system.<br>asd<br>Asd<br><b>ASd</b></p><p><b><br></b></p><p><u>asd</u></p>', 1527008489, 4, 0),
(170, 0, 0, 'Hello!!!', '<p>Hi, we want to just test this system.<br>asd<br>Asd<br><b>ASd</b></p><p><b><br></b></p><p><u>asd</u></p>', 1527008489, 0, 0),
(213, 1, 0, 'asdaksjdksajd', '<p>ksjdskjfsdfjksdfs</p><p><span style="background-color: rgb(255, 255, 0);">sdfsdfsdf</span></p>', 1533473646, 0, 0),
(140, 4, 1, '.    .', 'Hi, why you banned me? :/ I did nothing wrong', 1525888032, 4, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mutes`
--

CREATE TABLE `mutes` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `reason` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `writerID` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `writeTime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `news`
--

INSERT INTO `news` (`ID`, `writerID`, `title`, `content`, `writeTime`) VALUES
(7, 1, 'Game start', 'Game startings right now, this week on wednesday, please donate euros to me, very thank you', 1526394507),
(8, 1, 'asdasdas', 'dasdads', 1526394567),
(9, 1, 'test!!!', 'NEWWWWWWWWWWWWWWWWWWWWWWW\r\n\r\n\r\nedited by Inn :)', 1526394648),
(24, 1, 'UPDATE #5', '<p style="text-align: center; "><img src="http://i.nusphere.com/images/as/logo-nusphere.png" style="width: 215px;"></p><p style="text-align: center; ">Sistema leidzia viska siame zaidima</p><p style="text-align: center; ">ar ne?</p>\r\n\r\n<div class="messageSection"><h1>- Nauja editComment.php sistema</h1><h1>- Daugiau masinu</h1><h1>- Daugiau galimybiu naujiems zaidejams<br>- Nauji namai<br></h1></div><br>Kodel verta rinktis mus?<br>Mes verta rinktis, nes esame geriausi pasaulyje programmeriai ir t.t. ir t.t., todel galite mumis pasitiketi ir tiketi.<br><br>+REP', 1526480936),
(16, 1, 'OLD', 'OLDOLDOLD', 1516399087),
(17, 1, 'Update (#3)', 'Compalining is about jyouasda ska dlas kdals dklask dalsd kalsd klask dlasd jsnf skjd fkhsd ', 1526407145);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `newscomments`
--

CREATE TABLE `newscomments` (
  `ID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `writerID` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `newscomments`
--

INSERT INTO `newscomments` (`ID`, `postID`, `writerID`, `content`, `time`) VALUES
(19, 24, 1, '<p>sdfsdfsfsdf</p>', 1527063232),
(18, 24, 1, '<p>aaaaaa<span style="color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 14px; white-space: pre-wrap;">Chester Young &amp; Jasted - Sorry (Extended Mix)</span></p>', 1526919669),
(9, 17, 1, '<p>Hi bitches ;)</p>', 1526800343);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `sentTime` int(11) NOT NULL,
  `notificationRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `notifications`
--

INSERT INTO `notifications` (`ID`, `receiverID`, `title`, `content`, `sentTime`, `notificationRead`) VALUES
(162, 4, '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted you from his friendlist', '', 1526560163, 1),
(159, 4, 'Shout', 'You shout was edited by <a  href=\'user.php?ID=1\'>Inn_Progress</a>', 1526489582, 1),
(160, 4, 'Shout', 'You shout was deleted by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a><br>Shout: <p><u>Labukas</u></p>', 1526533416, 1),
(161, 4, 'Shout', 'You shout was deleted by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a><br>Shout: <p>S</p>', 1526542344, 1),
(157, 4, 'Shout', 'You shout was edited by <a  href=\'user.php?ID=1\'>Inn_Progress</a>', 1526488676, 1),
(158, 4, 'Shout', 'You shout was deleted by <a  href=\'user.php?ID=1\'>Inn_Progress</a><br>Shout: <p>Sveikasssssssssssssssssveikasssssssssssssssss<br><br>&gt;&gt;&gt;&gt;&gt; TAIP?</p><p>&gt;&gt;&gt;&gt; NE?</p>', 1526488683, 1),
(145, 38, 'You shout was edited by ', '', 1526487325, 0),
(144, 38, 'You shout was edited by <a  href=\'user.php?ID=1\'>Inn_Progress</a>', '', 1526487306, 0),
(111, 3, ':)', 'Sveikas atvykes i zaidiam', 1525803912, 0),
(110, 3, ':)', 'Sveikas atvykes i zaidiam', 1525803897, 1),
(163, 4, '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> invited you to be friends. <br><a href=\'inviteFriend.php?ID1\'>Click here</a> to accept friend request', '', 1526560899, 1),
(170, 4, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> accepted your friend request', 1526561360, 1),
(171, 4, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted you from his friendlist', 1526561411, 1),
(172, 4, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> invited you to be friends. <br><a href=\'inviteFriend.php?ID=1\'>Click here</a> to accept friend request', 1526561415, 1),
(174, 6, 'Friends', '<a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> invited you to be friends. <br><a href=\'inviteFriend.php?ID=4\'>Click here</a> to accept friend request', 1526561632, 1),
(175, 4, 'Friends', '<a  href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> accepted your friend request', 1526561727, 1),
(178, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> invited you to be friends. <br><a href=\'inviteFriend.php?ID=1\'>Click here</a> to accept friend request', 1526562099, 1),
(179, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> canceled his friend request', 1526562159, 1),
(181, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> accepted your friend request', 1526562279, 1),
(182, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted you from his friendlist', 1526562380, 1),
(183, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> invited you to be friends. <br><a href=\'inviteFriend.php?ID=1\'>Click here</a> to accept friend request', 1526562382, 1),
(184, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> canceled his friend request', 1526562497, 1),
(186, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> accepted your friend request', 1526562618, 1),
(410, 1, '3', '3333333333333333', 1534071001, 1),
(191, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> declined your friend request', 1526562714, 1),
(193, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> declined your friend request', 1526562868, 1),
(194, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> invited you to be friends. <br><a href=\'acceptFriend.php?ID=1\'>Click here</a> to accept friend request or <a href=\'deleteFromFriends.php?ID=1\'>click here to decline</a>', 1526563770, 1),
(196, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> invited you to be friends. <br><a href=\'acceptFriend.php?ID=1\'>Click here</a> to accept friend request or <a href=\'deleteFromFriends.php?ID=1\'>click here to decline</a>', 1526563797, 1),
(198, 6, 'Friends', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted you from his friendlist', 1526563819, 1),
(247, 4, 'Mute', 'You were muted BY user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. <br>Reason: fsdfsdf for 6 minutes', 1533478482, 0),
(257, 6, 'Shout', 'You shout was deleted by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a><br>Shout: <p><span style="background-color: rgb(255, 255, 0);">fffffffffffffffffffffffffffffffffunk</span></p>', 1533490017, 0),
(201, 4, 'Comment', 'You comment was edited by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526817504, 0),
(202, 4, 'Comment', 'You comment was edited by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526817512, 0),
(203, 4, 'Comment', 'You comment was edited by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526817694, 0),
(206, 6, 'Shout', 'You shout was deleted by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a><br>Shout: <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>', 1526995836, 0),
(207, 6, 'Shout', 'You shout was edited by <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526995914, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `password_resets`
--

CREATE TABLE `password_resets` (
  `confirmCode` varchar(65) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `reps`
--

CREATE TABLE `reps` (
  `ID` int(11) NOT NULL,
  `giverID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `reps`
--

INSERT INTO `reps` (`ID`, `giverID`, `receiverID`, `postID`, `type`) VALUES
(1, 4, 1, 24, 0),
(16, 1, 1, 24, 0),
(19, 1, 1, 17, 0),
(17, 1, 1, 18, 1),
(18, 1, 1, 19, 1),
(20, 1, 1, 16, 0),
(21, 7, 1, 19, 1),
(22, 7, 1, 18, 1),
(23, 7, 1, 24, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `shouts`
--

CREATE TABLE `shouts` (
  `ID` int(11) NOT NULL,
  `writerID` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `shouts`
--

INSERT INTO `shouts` (`ID`, `writerID`, `content`, `time`) VALUES
(57, 1, '<p>Ieskau darbo uz golda, kas ka gali pasiulyti, tik uz <b>normalia</b> kaina?</p>', 1526534059),
(58, 1, '<p>ssssssssssssssssssssssssssss</p>', 1526534099),
(59, 1, '<p><span style="background-color: rgb(206, 0, 0); color: rgb(255, 255, 255);">Sveiki visi, noriÅ³ praneÅ¡ti, jog negalima taip daug laiko skirti Å¡itam Å¡udui</span></p>', 1526534196),
(60, 1, '<p>sdasdasdasds</p>', 1526534509),
(61, 1, '<p>asdasdasdasdsa</p>', 1526534513),
(62, 1, '<p>asdasdasd</p>', 1526534516),
(63, 1, '<p><u>adsasdasdasd</u></p>', 1526534520),
(64, 1, '<p>asdasdasdasdas</p>', 1526534524),
(65, 1, '<p>asdasdasdasdasdasd</p>', 1526534527),
(66, 1, '<p>adsasdasdasdasdadasd</p>', 1526534532),
(67, 1, '<p>asdasdasdasdsadadas</p>', 1526534536),
(68, 1, '<p>adasdasdads</p>', 1526534539);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `emailVerified` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `registrationIP` varchar(15) NOT NULL DEFAULT 'notfound',
  `lastIP` varchar(15) NOT NULL DEFAULT 'notfound',
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `registerDate` int(11) NOT NULL,
  `loginDate` int(11) NOT NULL DEFAULT '0',
  `miniMsg` text,
  `errorMsg` text,
  `lastShout` int(11) NOT NULL DEFAULT '0',
  `mute` int(11) NOT NULL DEFAULT '0',
  `lastPage` varchar(100) NOT NULL DEFAULT 'home.php',
  `lastComment` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '10',
  `vip` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `emailVerified`, `password`, `registrationIP`, `lastIP`, `role`, `registerDate`, `loginDate`, `miniMsg`, `errorMsg`, `lastShout`, `mute`, `lastPage`, `lastComment`, `credits`, `vip`) VALUES
(1, 'Inn_Progress', 'arnoldautuch4@gmail.com', 0, '$2y$10$WTjyFegtd6coTkUwi3ntDO2G8rTHv0eWe9tyAujHcf59P/VUUKUt6', 'notfound', '::1', 4, 0, 1534058864, '', '', 1527009911, 0, 'notifications.php?deleteID=405', 1527063472, 500, 1536070580),
(0, 'Admin', 'admin@gmail.com', 0, '$2y$10$WTjyFegtd6coTkUwi3ntDO2G8rTHv0eWe9tyAujHcf59P/VUUKUt6', 'notfound', '::1', 0, 0, 0, '', '', 0, 0, 'home.php', 0, 10, 0),
(3, 'Arnas', 'arnas@gmail.com', 0, '$2y$10$aU9p.okdzzqO2VNBOM7pAubNqALafcttf0/FcLF7qbcYLj7tA9hMK', '::1', '::1', 0, 0, 1525347742, '', '', 0, 0, 'home.php', 0, 10, 0),
(4, 'duxas@gmail.com', 'duxas@gmail.com', 0, '$2y$10$EOSdJ//E8ONKliZDZWyPeeyF41rKyXVyuOBadCKyrJR/hp4NKeBA6', '::1', '::1', 0, 0, 1526801903, '', '', 1526535120, 0, 'home.php', 1526806611, 10, 0),
(5, 'testeris', 'testeris@gmail.com', 0, '$2y$10$dBWYOygEztOvKiUoWH6Rwelv4qRNfAqvAqJbUI0pmOj5L5cHD.MA2', '::1', '::1', 0, 1526543494, 1526543502, '', NULL, 0, 0, 'home.php', 0, 10, 0),
(6, 'mazas', 'mazas@gmail.com', 0, '$2y$10$ISG0g/sSuN.1UBZch528yeEPYucbTlKs1LPmeHQ4fsfvapVtNyUQG', '::1', '::1', 0, 1526543947, 1526561690, '', '', 1526549882, 0, 'home.php', 0, 10, 0),
(7, 'naujokas@gmail.com', 'naujokas@gmail.com', 1, '$2y$10$.eJS0RxvNQbO3B7kPsPez.RK5nvyN57/QcqmlhkXxL8sheVzKKn6a', '::1', '::1', 0, 1526997585, 1527063419, '', '', 0, 0, 'home.php', 0, 65, 1529590614);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `userslogs`
--

CREATE TABLE `userslogs` (
  `ID` bigint(20) NOT NULL,
  `userID` int(11) NOT NULL,
  `additionalID` int(11) NOT NULL DEFAULT '-1',
  `type` text NOT NULL,
  `content` text NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `userslogs`
--

INSERT INTO `userslogs` (`ID`, `userID`, `additionalID`, `type`, `content`, `time`, `ip`) VALUES
(1, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address <b>::1</b>', 1525789866, ''),
(2, 1, -1, 'Home', 'You are very good player', 1525794704, ''),
(3, 1, -1, 'Home', 'You are very good player', 1525794709, ''),
(4, 1, -1, 'Home', 'You are very good player', 1525794711, ''),
(5, 3, -1, 'Login', 'User Arnas (ID: 3) logged in with IP address <b>::1</b>', 1525797206, ''),
(6, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address <b>::1</b>', 1525797371, ''),
(7, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address <b>::1</b>', 1525798197, ''),
(8, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address <b>::1</b>', 1525801028, ''),
(9, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address <b>::1</b>', 1525801295, ''),
(10, 3, -1, 'Login', 'User Arnas (ID: 3) logged in with IP address <b>::1</b>', 1525802842, ''),
(11, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address <b>::1</b>', 1525803943, ''),
(12, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address <b>::1</b>', 1525804896, ''),
(13, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1525805079, ''),
(14, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1525876231, ''),
(15, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1525885650, ''),
(16, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1525885682, ''),
(17, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1525885742, ''),
(18, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1525885789, ''),
(19, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1525885864, ''),
(20, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1525885939, ''),
(21, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by 1. Reason: asdasda', 1525886896, ''),
(22, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by asd. Reason: asdadasd', 1525887389, ''),
(23, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by user.php?ID=1. Reason: sdfsdfsdf', 1525887517, ''),
(24, 4, 1, 'Unban', 'Player  (ID: ) unbanned by user ID=1', 1525887644, ''),
(25, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by user ID=1. Reason: asdadsa', 1525887681, ''),
(26, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1525887699, ''),
(27, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1525887968, ''),
(28, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1525888038, ''),
(29, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1525888047, ''),
(30, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526066210, ''),
(31, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526066220, ''),
(32, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526130101, ''),
(33, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526149067, ''),
(34, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526149366, ''),
(35, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526150439, ''),
(36, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526150579, ''),
(37, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526150712, ''),
(38, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526150715, ''),
(39, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526150733, ''),
(40, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526150812, ''),
(41, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526151763, ''),
(42, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526208743, ''),
(43, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526208793, ''),
(44, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526208888, ''),
(45, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526210060, ''),
(46, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: just testing :)', 1526210473, ''),
(47, 3, 1, 'Unban', 'Player 3 (ID: ) unbanned by user ID: 1', 1526210685, ''),
(48, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by user ID: 1. Reason: asdasdasd', 1526211014, ''),
(49, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526211705, ''),
(50, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526211716, ''),
(51, 4, 1, 'Unban', 'Player ID: 4 unbanned by user ID: 1', 1526211727, ''),
(52, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526211742, ''),
(53, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by user ID: 1. Reason: justforprikolas', 1526211815, ''),
(54, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: testformessages', 1526211880, ''),
(55, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526211913, ''),
(56, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225333, ''),
(57, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225390, ''),
(58, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225413, ''),
(59, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225419, ''),
(60, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225460, ''),
(61, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225506, ''),
(62, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225579, ''),
(63, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225598, ''),
(64, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225680, ''),
(65, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225687, ''),
(66, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225777, ''),
(67, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225787, ''),
(68, 1, -1, 'Just', 'hiiiiiiiiiiiiiiii', 1526225787, ''),
(69, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526225935, ''),
(70, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526225956, ''),
(71, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526226028, ''),
(72, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526226046, ''),
(73, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526226073, ''),
(74, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526226081, ''),
(75, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526226330, ''),
(76, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526226338, ''),
(77, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526226784, ''),
(78, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526226791, ''),
(79, 0, 1, 'Ban', 'Player Admin (ID: 0) banned by user ID: 1. Reason: just kidding', 1526226923, ''),
(80, 3, 1, 'Ban', 'Player <B>Arnas</b> (ID: 3) banned by user ID: 1. Reason: asdasdasd', 1526227751, ''),
(81, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526227812, ''),
(82, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526227976, ''),
(83, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526228039, ''),
(84, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526228085, ''),
(85, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: 55555555555555', 1526228091, ''),
(86, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526228103, ''),
(87, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526228163, ''),
(88, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526385657, ''),
(89, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: asdasdsdas', 1526390868, ''),
(90, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526406961, ''),
(91, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526406968, ''),
(92, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: asdasdd<H1>as', 1526410516, ''),
(93, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: asda<h1>Asdasd', 1526411124, ''),
(94, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526411141, ''),
(95, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: <p>asasdasdasd', 1526411174, ''),
(96, 3, 1, 'Unban', 'Player ID: 3 unbanned by user ID: 1', 1526411182, ''),
(97, 3, 1, 'Ban', 'Player Arnas (ID: 3) banned by user ID: 1. Reason: asdaksdkald', 1526411190, ''),
(98, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526476234, ''),
(99, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526482443, ''),
(100, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526482500, ''),
(101, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526482507, ''),
(102, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526482538, ''),
(103, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526483443, ''),
(104, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526483451, ''),
(105, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526487678, ''),
(106, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526487686, ''),
(107, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526487727, ''),
(108, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526487733, ''),
(109, 4, 1, 'Ban', 'Player duxas@gmail.com (ID: 4) banned by user ID: 1. Reason: Just testing', 1526487752, ''),
(110, 4, 1, 'Unban', 'Player ID: 4 unbanned by user ID: 1', 1526487796, ''),
(111, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526487798, ''),
(112, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526487804, ''),
(113, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526487842, ''),
(114, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526487848, ''),
(115, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526488311, ''),
(116, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526488322, ''),
(117, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526488628, ''),
(118, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526488635, ''),
(119, 1, 1, 'Moderating', 'asd deleted shout', 1526489008, ''),
(120, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'>Inn_Progress</a> deleted shout', 1526489249, ''),
(121, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'>Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'>Inn_Progress</a> shout', 1526489336, ''),
(122, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526489386, ''),
(123, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526489393, ''),
(124, 4, 4, 'Moderating', '<a  href=\'user.php?ID=4\'>duxas@gmail.com</a> edited <a  href=\'user.php?ID=4\'>duxas@gmail.com</a> shout', 1526489492, ''),
(125, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526489568, ''),
(126, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526489574, ''),
(127, 1, 4, 'Moderating', '<a  href=\'user.php?ID=1\'>Inn_Progress</a> edited <a  href=\'user.php?ID=4\'>duxas@gmail.com</a> shout', 1526489582, ''),
(128, 4, 1, 'Ban', 'Player <a class=\'banned-text danger\' href=\'user.php?ID=4\'>duxas@gmail.com</a> banned by user ID: <a  href=\'user.php?ID=1\'>Inn_Progress</a>. Reason: Nu nezinau', 1526489742, ''),
(129, 4, 1, 'Unban', 'Player <a  href=\'user.php?ID=4\'>duxas@gmail.com</a> unbanned by user <a  href=\'user.php?ID=1\'>Inn_Progress</a>', 1526489858, ''),
(130, 1, -1, 'Moderating', '<a  href=\'user.php?ID=1\'>Inn_Progress</a> deleted all shouts', 1526489975, ''),
(131, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'>Inn_Progress</a> edited <a  href=\'user.php?ID=1\'>Inn_Progress</a> shout', 1526491042, '::1'),
(132, 3, 1, 'Ban', 'Player <a class=\'banned-text danger\' href=\'user.php?ID=3\'><i class="fas fa-ban"></i> Arnas</a> banned by user ID: <a  href=\'user.php?ID=1\'><i class=\'far fa-address-card\'></i> Inn_Progress</a>. Reason: asdasdasd asd ', 1526492204, '::1'),
(133, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526493837, '::1'),
(134, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526493955, '::1'),
(135, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526493969, '::1'),
(136, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526493976, '::1'),
(137, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526531905, '::1'),
(138, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1526533050, '::1'),
(139, 1, 4, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> shout', 1526533416, '::1'),
(140, 1, -1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted all shouts', 1526533934, '::1'),
(141, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526534937, '::1'),
(142, 4, -1, 'Login', 'User duxas@gmail.com (ID: 4) logged in with IP address ::1', 1526534980, '::1'),
(143, 4, -1, 'Logout', 'User (ID: 4) logged out with IP address ::1', 1526535381, '::1'),
(144, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526535401, '::1'),
(145, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526542314, '::1'),
(146, 1, 4, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> shout', 1526542345, '::1'),
(147, 1, -1, 'Logout', 'User (ID: 1) logged out with IP address ::1', 1526543118, '::1'),
(148, 5, -1, 'Login', 'User testeris (ID: 5) logged in with IP address ::1', 1526543502, '::1'),
(149, 5, -1, 'Logout', 'User (ID: 5) logged out with IP address ::1', 1526543725, '::1'),
(150, 6, -1, 'Login', 'User mazas (ID: 6) logged in with IP address ::1', 1526543984, '::1'),
(151, 6, 6, 'Moderating', '<a  href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> edited <a  href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> shout', 1526545867, '::1'),
(152, 6, -1, 'Logout', 'User (ID: 6) logged out with IP address ::1', 1526550211, '::1'),
(153, 1, -1, 'Login', 'User Inn_Progress (ID: 1) logged in with IP address ::1', 1526550221, '::1'),
(154, 4, 1, 'Mute', 'Player <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> muted by user player<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: Just testing :) for 3 minutes', 1526552542, '::1'),
(155, 1, 1, 'Mute', 'Player <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> muted by user player<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: TESTINU ;) for 5 minutes', 1526552778, '::1'),
(156, 1, 1, 'Unmute', 'Player <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> unmuted by user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526552825, '::1'),
(157, 5, 1, 'Mute', 'Player <a  href=\'user.php?ID=5\'><i class="fas fa-user"></i> testeris</a> muted by user player<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: nezinau prieazsties jtus for 120 minutes', 1526553181, '::1'),
(158, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1526557403, '::1'),
(159, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526557436, '::1'),
(160, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1526561281, '::1'),
(161, 4, -1, 'Login', 'User <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> logged in', 1526561287, '::1'),
(162, 4, -1, 'Logout', 'User <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> logged out', 1526561329, '::1'),
(163, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526561335, '::1'),
(164, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1526561421, '::1'),
(165, 4, -1, 'Login', 'User <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> logged in', 1526561425, '::1'),
(166, 6, -1, 'Login', 'User <a  href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> logged in', 1526561690, '::1'),
(167, 4, -1, 'Logout', 'User <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> logged out', 1526561932, '::1'),
(168, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526562063, '::1'),
(169, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1526581136, '::1'),
(170, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526649595, '::1'),
(171, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526743405, '::1'),
(172, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526796184, '::1'),
(173, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1526801889, '::1'),
(174, 4, -1, 'Login', 'User <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> logged in', 1526801903, '::1'),
(175, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526816980, '::1'),
(176, 1, 4, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> comment', 1526817504, '::1'),
(177, 1, 4, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> comment', 1526817512, '::1'),
(178, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> comment', 1526817672, '::1'),
(179, 1, 4, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=4\'><i class="fas fa-user"></i> duxas@gmail.com</a> comment', 1526817694, '::1'),
(180, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526908981, '::1'),
(181, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1526908996, '::1'),
(182, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526918612, '::1'),
(183, 1, 1, 'Mute', 'Player <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> muted BY user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: assssssssssss for 10 minutes', 1526918630, '::1'),
(184, 1, 1, 'Unmute', 'Player <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> unmuted by user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526918943, '::1'),
(185, 1, 1, 'Mute', 'Player <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> muted BY user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: test for 3 minutes', 1526919108, '::1'),
(186, 1, 1, 'Unmute', 'Player <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> unmuted by user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>', 1526919184, '::1'),
(187, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526995593, '::1'),
(188, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1526995814, '::1'),
(189, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1526995826, '::1'),
(190, 1, 6, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> shout', 1526995836, '::1'),
(191, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1526995853, '::1'),
(192, 1, 6, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> shout', 1526995914, '::1'),
(193, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1526997564, '::1'),
(194, 7, -1, 'Login', 'User <a  href=\'user.php?ID=7\'><i class="fas fa-user"></i> naujokas@gmail.com</a> logged in', 1526997590, '::1'),
(195, 7, -1, 'Logout', 'User <a  href=\'user.php?ID=7\'><i class="far fa-star"></i> naujokas@gmail.com</a> logged out', 1526998782, '::1'),
(196, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1526998790, '::1'),
(197, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1527010033, '::1'),
(198, 7, -1, 'Login', 'User <a  href=\'user.php?ID=7\'><i class="far fa-star"></i> naujokas@gmail.com</a> logged in', 1527010116, '::1'),
(199, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1527062879, '::1'),
(200, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1527063414, '::1'),
(201, 7, -1, 'Login', 'User <a  href=\'user.php?ID=7\'><i class="far fa-star"></i> naujokas@gmail.com</a> logged in', 1527063419, '::1'),
(202, 7, -1, 'Logout', 'User <a  href=\'user.php?ID=7\'><i class="far fa-star"></i> naujokas@gmail.com</a> logged out', 1527063532, '::1'),
(203, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1527063542, '::1'),
(204, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1527087435, '::1'),
(205, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1531057163, '::1'),
(206, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1531057656, '::1'),
(207, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1533191778, '::1'),
(208, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1533472124, '::1'),
(209, 1, -1, 'Logout', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged out', 1533475296, '::1'),
(210, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1533475317, '::1'),
(211, 4, 1, 'Ban', 'Player <a class=\'banned-text danger\' href=\'user.php?ID=4\'><i class="fas fa-ban"></i> duxas@gmail.com</a> banned by user ID: <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: sdfsdfsdfsdfsd', 1533478434, '::1'),
(212, 4, 1, 'Mute', 'Player <a class=\'banned-text danger\' href=\'user.php?ID=4\'><i class="fas fa-ban"></i> duxas@gmail.com</a> muted BY user <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a>. Reason: fsdfsdf for 6 minutes', 1533478481, '::1'),
(213, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> edited <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1533478502, '::1'),
(214, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1533490014, '::1'),
(215, 1, 6, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a class=\'muted-text\' href=\'user.php?ID=6\'><i class="fas fa-user"></i> mazas</a> shout', 1533490017, '::1'),
(216, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1533627841, '::1'),
(217, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1533989467, '::1'),
(218, 1, 1, 'Moderating', '<a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> deleted <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> shout', 1534005888, '::1'),
(219, 1, -1, 'Login', 'User <a  href=\'user.php?ID=1\'><i class="fas fa-crown"></i> Inn_Progress</a> logged in', 1534058864, '::1');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user_online`
--

CREATE TABLE `user_online` (
  `session` char(100) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `user_online`
--

INSERT INTO `user_online` (`session`, `time`, `userID`) VALUES
('p2hseb5pteik929uqod0q7vjj3', 1534071036, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `verifications`
--

CREATE TABLE `verifications` (
  `confirmCode` varchar(65) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mutes`
--
ALTER TABLE `mutes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `newscomments`
--
ALTER TABLE `newscomments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reps`
--
ALTER TABLE `reps`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shouts`
--
ALTER TABLE `shouts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userslogs`
--
ALTER TABLE `userslogs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
--
-- AUTO_INCREMENT for table `mutes`
--
ALTER TABLE `mutes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `newscomments`
--
ALTER TABLE `newscomments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;
--
-- AUTO_INCREMENT for table `reps`
--
ALTER TABLE `reps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `shouts`
--
ALTER TABLE `shouts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `userslogs`
--
ALTER TABLE `userslogs`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
