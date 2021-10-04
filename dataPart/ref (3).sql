
--
-- Table structure for table `assignment`
--

DROP TABLE IF EXISTS `assignment`;
CREATE TABLE IF NOT EXISTS `assignment` (
  `assignmentID` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(256) DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL,
  `refID` int(11) DEFAULT NULL,
  `gameID` int(11) DEFAULT NULL,
  PRIMARY KEY (`assignmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `gameID` int(11) NOT NULL AUTO_INCREMENT,
  `field` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `assignmentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`gameID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `referee`
--

DROP TABLE IF EXISTS `referee`;
CREATE TABLE IF NOT EXISTS `referee` (
  `refID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `refGrade` int(11) DEFAULT NULL,
  `refRating` int(11) DEFAULT NULL,
  PRIMARY KEY (`refID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  `role` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
