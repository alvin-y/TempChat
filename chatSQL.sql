# Dump File
#
# Database is ported from MS Access
#--------------------------------------------------------
# Program Version 5.1.232

DROP DATABASE IF EXISTS `tempchat`;
CREATE DATABASE IF NOT EXISTS `tempchat`;
USE `tempchat`;

#
# Table structure for table 'Rooms'
#

DROP TABLE IF EXISTS `Rooms`;

CREATE TABLE `Rooms` (
  `id` INTEGER NOT NULL, 
  `roomPass` VARCHAR(255) NOT NULL, 
  `userCount` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;


#
# Table structure for table 'Users'
#

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `userID` INTEGER NOT NULL AUTO_INCREMENT, 
  `name` VARCHAR(12), 
  PRIMARY KEY (`userID`) 
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;


#
# Table structure for table 'RoomLogs'
#

DROP TABLE IF EXISTS `RoomLogs`;

CREATE TABLE `RoomLogs` (
  `roomID` INTEGER NOT NULL, 
  `senderID` int(11) NOT NULL, 
  `msgID` int(11) NOT NULL, 
  `msg` text NOT NULL
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;


#
# Table structure for table 'RoomUsers'
#

DROP TABLE IF EXISTS `RoomUsers`;

CREATE TABLE `RoomUsers` (
  `roomID` INTEGER NOT NULL, 
  `userID` INTEGER NOT NULL 
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;



