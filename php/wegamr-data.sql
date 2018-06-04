-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jun-2018 às 04:15
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
-- Estrutura da tabela `console`
--

CREATE TABLE `console` (
  `consoleID` int(11) NOT NULL,
  `cname` varchar(15) DEFAULT NULL,
  `manufacturer` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Extraindo dados da tabela `consoles`
--

INSERT INTO `consoles` (`consoleId`, `guid`, `cname`, `icon`, `picture`, `apiId`) VALUES
(3, '', 'Nintendo 3DS', 'https://www.giantbomb.com/api/image/square_avatar/1686079-3dshw11911.jpg', 'https://www.giantbomb.com/api/image/scale_medium/1686079-3dshw11911.jpg', '3045-117'),
(4, '', 'Android', 'https://www.giantbomb.com/api/image/square_avatar/1465136-android_robot_logo.jpg', 'https://www.giantbomb.com/api/image/scale_medium/1465136-android_robot_logo.jpg', '3045-123'),
(5, '', 'PlayStation 3', 'https://www.giantbomb.com/api/image/square_avatar/1426360-logo.jpg', 'https://www.giantbomb.com/api/image/scale_medium/1426360-logo.jpg', '3045-35'),
(6, '', 'Super Nintendo ', 'https://www.giantbomb.com/api/image/square_avatar/2287891-snes_sfc.jpg', 'https://www.giantbomb.com/api/image/scale_medium/2287891-snes_sfc.jpg', '3045-9'),
(7, '', 'GameCube', 'https://www.giantbomb.com/api/image/square_avatar/1426256-logo.jpg', 'https://www.giantbomb.com/api/image/scale_medium/1426256-logo.jpg', '3045-23'),
(8, '', 'Wii U', 'https://www.giantbomb.com/api/image/square_avatar/2228024-hero.jpg', 'https://www.giantbomb.com/api/image/scale_medium/2228024-hero.jpg', '3045-139'),
(9, '', 'Game Boy Color', 'https://www.giantbomb.com/api/image/square_avatar/1426240-logo.jpg', 'https://www.giantbomb.com/api/image/scale_medium/1426240-logo.jpg', '3045-57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `friend`
--

CREATE TABLE `friend` (
  `requesterID` int(11) DEFAULT NULL,
  `friendID` int(11) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `friend`
--

INSERT INTO `friend` (`requesterID`, `friendID`, `accepted`) VALUES
(3, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `game`
--

CREATE TABLE `game` (
  `gameID` int(11) NOT NULL,
  `gname` varchar(30) DEFAULT NULL,
  `publisher` varchar(15) DEFAULT NULL,
  `rating` varchar(1) DEFAULT NULL,
  `consolename` int(11) DEFAULT NULL
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

--
-- Extraindo dados da tabela `games`
--

INSERT INTO `games` (`gameId`, `apiId`, `gname`, `icon`, `picture`, `rating`, `release_date`, `platform`) VALUES
(24, '3030-20669', 'Metal Gear Solid 4: Guns of the Patriots', 'https://www.giantbomb.com/api/image/square_avatar/2355512-ps3_mgs4gunsofthepatriots_8.jpg', 'https://www.giantbomb.com/api/image/scale_medium/2355512-ps3_mgs4gunsofthepatriots_8.jpg', NULL, NULL, NULL),
(25, '3030-42245', 'Batman: Arkham Origins', 'https://www.giantbomb.com/api/image/square_avatar/2485321-486263.jpg', 'https://www.giantbomb.com/api/image/scale_medium/2485321-486263.jpg', NULL, NULL, NULL),
(26, '3030-3095', 'Kirby & The Amazing Mirror', 'https://www.giantbomb.com/api/image/square_avatar/1865068-box_katam.png', 'https://www.giantbomb.com/api/image/scale_medium/1865068-box_katam.png', NULL, NULL, NULL),
(27, '3030-11552', 'PokÃ©mon Emerald', 'https://www.giantbomb.com/api/image/square_avatar/2179495-box_pkmnev.png', 'https://www.giantbomb.com/api/image/scale_medium/2179495-box_pkmnev.png', NULL, '2004-09-16', NULL),
(28, '3030-53529', 'Fire Emblem Heroes', 'https://www.giantbomb.com/api/image/square_avatar/2913569-8525313756-X10Ws2JNPcrfbWH0RmKZ1E_kks9UmSUPwum6dZFVdI1iAQiF1vM5FVykuWrzlEoXhzk=w300', 'https://www.giantbomb.com/api/image/scale_medium/2913569-8525313756-X10Ws2JNPcrfbWH0RmKZ1E_kks9UmSUPwum6dZFVdI1iAQiF1vM5FVykuWrzlEoXhzk=w300', NULL, '2017-02-02', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `owned_consoles`
--

CREATE TABLE `owned_consoles` (
  `consoleID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `owned_consoles`
--

INSERT INTO `owned_consoles` (`consoleID`, `userID`) VALUES
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `owned_games`
--

CREATE TABLE `owned_games` (
  `gameId` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `owned_games`
--

INSERT INTO `owned_games` (`gameId`, `userID`) VALUES
(25, 1),
(28, 1);

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
-- Estrutura da tabela `tags`
--

CREATE TABLE `tags` (
  `userID` int(11) DEFAULT NULL,
  `gameId` int(11) DEFAULT NULL,
  `tag` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tags`
--

INSERT INTO `tags` (`userID`, `gameId`, `tag`) VALUES
(1, 24, 'Jogando'),
(1, 25, 'Jogando'),
(1, 26, 'Jogando'),
(1, 27, 'Jogando'),
(1, 28, 'Jogando');

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
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `dob`, `image`) VALUES
(1, 'teste', 'teste', '1991-02-27', NULL),
(2, 'biasimafer', 'teste', '2001-07-05', NULL),
(3, 'emanubit', 'teste', '1994-02-27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`consoleID`);

--
-- Indexes for table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`consoleId`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD KEY `requesterID` (`requesterID`),
  ADD KEY `friendID` (`friendID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameID`),
  ADD KEY `consolename` (`consolename`);

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
-- AUTO_INCREMENT for table `console`
--
ALTER TABLE `console`
  MODIFY `consoleID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `consoleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`friendID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `requesterID` FOREIGN KEY (`requesterID`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`consolename`) REFERENCES `console` (`consoleID`);

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
-- Limitadores para a tabela `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `tags_ibfk_2` FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
