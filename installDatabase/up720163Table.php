
<?php
//Table structure for table `comment`
$sqlTable = "
CREATE TABLE IF NOT EXISTS `comment` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(2000) NOT NULL,
  `question_idquestion` int(11) NOT NULL,
  `users_userID` int(11) NOT NULL,
  `child` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcomment`,`question_idquestion`,`users_userID`),
  KEY `fk_comment_question1_idx` (`question_idquestion`),
  KEY `fk_comment_users1_idx` (`users_userID`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userOne` varchar(45) NOT NULL,
  `userTwo` varchar(45) NOT NULL,
  `eTagHash` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `filer` (
  `fileID` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(45) DEFAULT NULL,
  `fileLink` varchar(45) DEFAULT NULL,
  `fileTags` varchar(45) DEFAULT NULL,
  `users_userID` int(11) NOT NULL,
  `protect` int(11) NOT NULL,
  PRIMARY KEY (`fileID`,`users_userID`),
  KEY `fk_file_users1_idx` (`users_userID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `follow` (
  `followID` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  PRIMARY KEY (`followID`)
) ENGINE=MyISAM AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `group` (
  `idgroup` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(45) DEFAULT NULL,
  `groupAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idgroup`,`groupAdmin`),
  KEY `fk_group_users1_idx` (`groupAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `groupFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `Link` varchar(200) NOT NULL,
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `groupMessage` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `groupMessage` text,
  `group_idgroup` int(11) NOT NULL,
  `users_userID` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`,`group_idgroup`,`users_userID`),
  KEY `fk_groupMessage_group1_idx` (`group_idgroup`),
  KEY `fk_groupMessage_users1_idx` (`users_userID`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `group_has_users` (
  `group_idgroup` int(11) NOT NULL,
  `users_userID` int(11) NOT NULL,
  PRIMARY KEY (`group_idgroup`,`users_userID`),
  KEY `fk_group_has_users_users1_idx` (`users_userID`),
  KEY `fk_group_has_users_group1_idx` (`group_idgroup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversationETag` int(11) NOT NULL,
  `sender` varchar(45) NOT NULL,
  `toWho` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `userRead` varchar(5) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `question` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `note` text NOT NULL,
  `tags` varchar(45) DEFAULT NULL,
  `users_userID` int(11) NOT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idquestion`,`users_userID`),
  KEY `fk_question_users1_idx` (`users_userID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `subject` (
  `subjectID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` char(200) NOT NULL,
  `school` varchar(500) NOT NULL,
  `course` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `usersFollowsSubject` (
  `users_userID` int(11) NOT NULL,
  `subject_subjectID` int(11) NOT NULL,
  PRIMARY KEY (`users_userID`,`subject_subjectID`),
  KEY `fk_users_has_subject_subject1_idx` (`subject_subjectID`),
  KEY `fk_users_has_subject_users1_idx` (`users_userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
?>
