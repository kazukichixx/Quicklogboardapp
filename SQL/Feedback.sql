-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql642.db.sakura.ne.jp
-- 生成日時: 2024 年 10 月 05 日 14:48
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
-- テーブルの構造 `Feedback`
--

CREATE TABLE `Feedback` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Cause` varchar(255) NOT NULL,
  `Countermeasure` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `Feedback`
--

INSERT INTO `Feedback` (`ID`, `Username`, `Cause`, `Countermeasure`, `CreatedDate`) VALUES
(2, 'user014', '新入社員で操作方法不明', 'マニュアルの読み込み', '2024-09-29 17:41:05'),
(3, 'user014', '体調不良', 'ケア', '2024-09-29 17:58:20'),
(5, 'user018', '不明', '本人にヒアリング', '2024-09-29 19:49:25'),
(6, 'user018', '操作ミス', 'マニュアルの読み込み', '2024-10-05 13:33:38'),
(7, 'user018', '不明', '不明', '2024-10-05 13:53:33'),
(8, 'user01', '操作ミス', 'マニュアルの読み込み', '2024-10-05 14:03:47'),
(9, 'user018', 'ウイルス感染', 'バッチ適用', '2024-10-05 14:07:32'),
(10, 'user01', '新入社員', 'マニュアルの読み込み、セキュリティ教育の実施', '2024-10-05 14:18:11');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`ID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
