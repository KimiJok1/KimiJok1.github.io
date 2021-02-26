--
-- Rakenne taululle `games`
--

CREATE TABLE `games` (
  `gameid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `company` varchar(60) NOT NULL,
  `release` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `games`
--

INSERT INTO `games` (`gameid`, `name`, `company`, `release`) VALUES
(1, 'Grand Theft Auto IV', 'Rockstar Games', 2008),
(2, 'Fallout 3', 'Bethesda Game Studios', 2008),
(3, 'The Elder Scrolls III: Morrowind', 'Bethesda Game Studios', 2002),
(4, 'Fallout 76', 'Bethesda Game Studios', 2018),
(5, 'The Elder Scrolls IV: Oblivion', 'Bethesda Game Studios', 2006),
(6, 'The Elder Scrolls V: Skyrim', 'Bethesda Game Studios', 2011),
(7, 'Assassin\'s Creed', 'Ubisoft', 2007),
(8, 'Assassin\'s Creed II', 'Ubisoft', 2009),
(9, 'Assassin\'s Creed: Brotherhood', 'Ubisoft', 2010),
(10, 'Assassin\'s Creed: Revelations', 'Ubisoft', 2011),
(11, 'Assassin\'s Creed III', 'Ubisoft', 2012),
(12, 'Assassin\'s Creed IV: Black Flag', 'Ubisoft', 2013),
(13, 'Grand Theft Auto III', 'Rockstar Games', 2001),
(14, 'Max Payne', 'Remedy Entertainment', 2002),
(15, 'Grand Theft Auto: Vice City', 'Rockstar Games', 2002),
(16, 'Grand Theft Auto: San Andreas', 'Rockstar Games', 2004);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
