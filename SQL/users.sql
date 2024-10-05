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
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `Email`, `CreatedDate`) VALUES
(1, 'test4', '$2y$10$KUXGPTfoa6JyFJX7c.Th0..a5qO/lc3bEw5ctwsZBOt7R1V.mxjca', 'kazuki1114shukatu@gmail.com', '2024-09-29 14:06:54'),
(9, 'test2', '$2y$10$01YiDmF7vOvXW0.wVfkVSeDFbSum.zqm.DY.S961r/Xqh7gPm89Be', 'kazuki1115atu@gmail.com', '2024-09-29 14:48:10'),
(10, 'test5', '$2y$10$2ISSseWpduHY5LNhoZxfJO.vlKX87pQzWnc4ll4vvXOEEs/ejT.cO', 'kazuki1115shukatu@gmail.com', '2024-09-29 14:52:51'),
(11, 'test6', '$2y$10$Li2fh1UD5gyKh4rifjwQquhse/s65dwU9bGa8CiTsiYrPmDTwn0cm', 'kazuki1116shukatu@gmail.com', '2024-09-29 14:56:57'),
(13, 'test7', '$2y$10$Hj7HGbSCOz3GfsFqfL68F.1eO0fC0U2w2RlxRws9F/qinugheLoRC', 'kazuki1117shukatu@gmail.com', '2024-09-29 17:02:37'),
(14, 'test8', '$2y$10$zYmT9k2SOL5M0Y/lLeDXOeo6qVK2zE5jwNhypmX9lAfGk1fkA36by', 'kazuki1118shukatu@gmail.com', '2024-09-29 17:13:25'),
(15, 'test9', '$2y$10$V9bFN27E5zskJkcUGixzXOD6/Gv3cAXIheF3GTXlfrzYBJfGd.mYC', 'kazuki1119shukatu@gmail.com', '2024-09-29 17:39:15'),
(16, 'test1', '$2y$10$sxdctoVph130FpywnJRKf.mqRmqb4c68JtOQkQD/J.pqcvw6pZtP.', 'kazuki1111shukatu@gmail.com', '2024-09-29 17:56:38');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
