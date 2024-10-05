-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql642.db.sakura.ne.jp
-- 生成日時: 2024 年 10 月 05 日 14:49
-- サーバのバージョン： 5.7.40-log
-- PHP のバージョン: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `kazucahxx_kadai10-4_phpdbc`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `UserActions`
--

CREATE TABLE `UserActions` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `Action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `UserActions`
--

INSERT INTO `UserActions` (`ID`, `UserID`, `Timestamp`, `Action`) VALUES
(136, 'user018', '2024-08-24 15:42:15', 'Failed Login Attempt'),
(137, 'user015', '2024-08-22 20:25:15', 'Logout'),
(138, 'user019', '2024-08-28 18:48:15', 'Login'),
(139, 'user018', '2024-09-09 02:58:15', 'Logout'),
(140, 'user012', '2024-09-02 07:06:15', 'Login'),
(141, 'user020', '2024-09-10 03:20:15', 'Login'),
(142, 'user014', '2024-09-19 01:20:15', 'Login'),
(145, 'user01', '2024-09-19 01:20:15', 'Failed Login Attempt');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `UserActions`
--
ALTER TABLE `UserActions`
  ADD PRIMARY KEY (`ID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `UserActions`
--
ALTER TABLE `UserActions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
