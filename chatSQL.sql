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

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` INTEGER NOT NULL, 
  `roomPass` VARCHAR(255) NOT NULL, 
  `userCount` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;


#
# Table structure for table 'Users'
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userID` INTEGER NOT NULL AUTO_INCREMENT, 
  `name` VARCHAR(12), 
  PRIMARY KEY (`userID`) 
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;


#
# Table structure for table 'RoomLogs'
#

DROP TABLE IF EXISTS `roomlogs`;

CREATE TABLE `roomlogs` (
  `roomID` INTEGER NOT NULL, 
  `senderID` int(11) NOT NULL, 
  `msgID` int(11) NOT NULL AUTO_INCREMENT, 
  `msg` text NOT NULL,
  `isGif` BIT NOT NULL,
  PRIMARY KEY(`msgID`),
  FOREIGN KEY (roomID) REFERENCES rooms(id),
  FOREIGN KEY (senderID) REFERENCES users(userID)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;


#
# Table structure for table 'RoomUsers'
#

DROP TABLE IF EXISTS `roomusers`;

CREATE TABLE `roomusers` (
  `roomID` INTEGER NOT NULL, 
  `userID` INTEGER NOT NULL,
  FOREIGN KEY (roomID) REFERENCES rooms(id),
  FOREIGN KEY (userID) REFERENCES users(userID)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;



