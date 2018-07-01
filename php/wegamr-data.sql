-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Jul-2018 às 02:23
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wegamr-data`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consoles`
--

CREATE TABLE `consoles` (
  `consoleId` int(11) NOT NULL,
  `guid` varchar(6) NOT NULL,
  `cname` varchar(15) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `apiId` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `games`
--

CREATE TABLE `games` (
  `gameId` int(11) NOT NULL,
  `apiId` varchar(20) NOT NULL,
  `gname` varchar(128) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `rating` varchar(15) DEFAULT NULL,
  `release_date` varchar(10) DEFAULT NULL,
  `platform` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `owned_consoles`
--

CREATE TABLE `owned_consoles` (
  `consoleID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `owned_games`
--

CREATE TABLE `owned_games` (
  `gameId` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recommendation`
--

CREATE TABLE `recommendation` (
  `userID` int(11) DEFAULT NULL,
  `gameId` int(11) DEFAULT NULL,
  `rec` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relationship`
--

CREATE TABLE `relationship` (
  `user_one_id` int(11) NOT NULL,
  `user_two_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `action_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE `tags` (
  `userID` int(11) DEFAULT NULL,
  `gameId` int(11) DEFAULT NULL,
  `tag` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `image` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`consoleId`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameId`),
  ADD KEY `platform` (`platform`);

--
-- Indexes for table `owned_consoles`
--
ALTER TABLE `owned_consoles`
  ADD KEY `consoleID` (`consoleID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `owned_games`
--
ALTER TABLE `owned_games`
  ADD KEY `gameId` (`gameId`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD KEY `userID` (`userID`),
  ADD KEY `gameId` (`gameId`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD KEY `user_one_id` (`user_one_id`),
  ADD KEY `user_two_id` (`user_two_id`),
  ADD KEY `action_user_id` (`action_user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD KEY `userID` (`userID`),
  ADD KEY `gameId` (`gameId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `consoleId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`platform`) REFERENCES `consoles` (`consoleId`);

--
-- Limitadores para a tabela `owned_consoles`
--
ALTER TABLE `owned_consoles`
  ADD CONSTRAINT `consoleID` FOREIGN KEY (`consoleID`) REFERENCES `consoles` (`consoleId`),
  ADD CONSTRAINT `owned_consoles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `owned_games`
--
ALTER TABLE `owned_games`
  ADD CONSTRAINT `owned_games_ibfk_1` FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`),
  ADD CONSTRAINT `owned_games_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `recommendation`
--
ALTER TABLE `recommendation`
  ADD CONSTRAINT `recommendation_ibfk_1` FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`),
  ADD CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`user_one_id`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`user_two_id`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `relationship_ibfk_3` FOREIGN KEY (`action_user_id`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `tags_ibfk_2` FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
