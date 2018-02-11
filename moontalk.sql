-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-02-11 10:41:13
-- 伺服器版本: 10.1.16-MariaDB
-- PHP 版本： 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `moontalk`
--

-- --------------------------------------------------------

--
-- 資料表結構 `moontalk_chat`
--

CREATE TABLE `moontalk_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_user` varchar(32) NOT NULL,
  `chat_color` varchar(32) NOT NULL,
  `chat_head` varchar(32) NOT NULL,
  `chat_msg` varchar(1024) NOT NULL,
  `chat_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `moontalk_room`
--

CREATE TABLE `moontalk_room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(32) NOT NULL,
  `room_lock` tinyint(1) NOT NULL,
  `room_pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `moontalk_chat`
--
ALTER TABLE `moontalk_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `room` (`chat_room`);

--
-- 資料表索引 `moontalk_room`
--
ALTER TABLE `moontalk_room`
  ADD PRIMARY KEY (`room_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `moontalk_chat`
--
ALTER TABLE `moontalk_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- 使用資料表 AUTO_INCREMENT `moontalk_room`
--
ALTER TABLE `moontalk_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `moontalk_chat`
--
ALTER TABLE `moontalk_chat`
  ADD CONSTRAINT `room` FOREIGN KEY (`chat_room`) REFERENCES `moontalk_room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
