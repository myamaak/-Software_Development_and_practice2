-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- 생성 시간: 18-06-17 10:29
-- 서버 버전: 5.7.19
-- PHP 버전: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `proj`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `pn` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(48) DEFAULT NULL,
  `pdir` varchar(100) NOT NULL,
  `pinfo` varchar(100) NOT NULL,
  `userID` varchar(48) NOT NULL,
  `pdate` date DEFAULT NULL,
  PRIMARY KEY (`pn`),
  KEY `fk_userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `picture`
--

INSERT INTO `picture` (`pn`, `pname`, `pdir`, `pinfo`, `userID`, `pdate`) VALUES
(4, 'DAWr6zaUwAAR6c4.jpg', 'dir.DAWr6zaUwAAR6c4.jpg', 'iloveu', 'DY', '2018-06-16'),
(2, '1519198889841.jpg', 'dir.1519198889841.jpg', 'futurehusband', '1111', '2018-06-16'),
(3, '1522159959191.jpg', 'dir.1522159959191.jpg', 'Mr. sunshine', '1111', '2018-06-16'),
(5, '1520401591882.jpg', 'dir.1520401591882.jpg', 'yeaaa', 'DY', '2018-06-17'),
(6, 'Df4ip30U0AEp7Bo.jpg', 'dir.Df4ip30U0AEp7Bo.jpg', 'í™í™ëª¨ëž˜ëª¨ëž˜ìžê°ˆìžê°ˆ', 'DY', '2018-06-17'),
(7, 'Df4k3RwUEAEeIcx.jpg', 'dir.Df4k3RwUEAEeIcx.jpg', 'hanasakuinari', 'evlan', '2018-06-17'),
(8, 'Df4icXzUcAAdTTc.jpg', 'dir.Df4icXzUcAAdTTc.jpg', 'werenotlonely', 'sangchu', '2018-06-17'),
(9, 'Df4j86OVAAIFNQT.jpg', 'dir.Df4j86OVAAIFNQT.jpg', 'xoxo', 'bana', '2018-06-17'),
(10, 'Df4plObVMAICBtc.jpg', 'dir.Df4plObVMAICBtc.jpg', 'thankyou!', 'gyeonu', '2018-06-17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
