# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: crawfinder
# Generation Time: 2013-09-29 19:12:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table boils
# ------------------------------------------------------------

DROP TABLE IF EXISTS `boils`;

CREATE TABLE `boils` (
  `boils_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `datetime` datetime NOT NULL,
  `address` varchar(80) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(5) unsigned NOT NULL,
  `description` text,
  `website` varchar(2083) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `twitter` varchar(140) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`boils_id`),
  KEY `datetime` (`datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `boils` WRITE;
/*!40000 ALTER TABLE `boils` DISABLE KEYS */;

INSERT INTO `boils` (`boils_id`, `name`, `datetime`, `address`, `city`, `state`, `zip`, `description`, `website`, `email`, `phone`, `price`, `twitter`, `timestamp`)
VALUES
	(1,'Mojo Boil','2013-02-09 13:00:00','5705 Canal Blvd','New Orleans','LA',70124,'From the corner to the block.','http://www.elliotfleming.com','elliotfleming@gmail.com','2564046093',15,'elliotfleming','2013-02-26 17:24:02'),
	(2,'Super Block Party','2013-02-10 14:00:00','S. Bernadott St. and Palmayra St.','New Orleans','LA',70119,'With special guests NFL Films, RollingStone.com, the Times-Picyune, and more','','','',25,'','2013-02-06 20:56:48'),
	(17,'CrawFest','2013-04-20 11:00:00','Tulane University, 31 McAlister Dr','New Orleans','LA',70118,'Crawfest is an annual music, food and arts festival, located on Tulane University\'s uptown campus. Each year 10,000 - 12,000 community members and students enjoy 12 bands, 16,000+ pounds of crawfish and stand after stand of local food and art vendors. Crawfest 2013 will be held on April 20th.\r\n\r\n11:00 am - 9:00 pm,\r\nKids under 12 - $5','http://crawfest.tulane.edu','tulanecrawfest@gmail.com',NULL,10,'CrawFest','2013-02-26 20:27:47'),
	(10,'Mid City Yacht Club','2013-03-08 18:00:00','440 S St Patrick St','New Orleans','LA',70119,'','http://midcityyachtclub.com/','info@midcityyachtclub.com','504-483-2517',NULL,'mcycNOLA','2013-02-26 17:38:51'),
	(15,'Breaux Bridge Crawfish Festival','2013-05-03 16:00:00','Parc Hardy, 2090 Rees Street','Breaux Bridge','LA',70517,'Festival runs Friday thru Sunday','http://www.bbcrawfest.com',NULL,NULL,5,'bbcrawfest','2013-02-21 18:16:38');

/*!40000 ALTER TABLE `boils` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ci_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`)
VALUES
	('014a65e039855b66a2e48e9089a5b7fa','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36',1380479136,'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"flexi_auth\";a:7:{s:15:\"user_identifier\";s:19:\"user@crawfinder.com\";s:7:\"user_id\";s:1:\"3\";s:5:\"admin\";b:0;s:5:\"group\";a:1:{i:1;s:6:\"Public\";}s:10:\"privileges\";a:0:{}s:22:\"logged_in_via_password\";b:1;s:19:\"login_session_token\";s:40:\"76137083406a6ec4934bfb16271e06789d304ba6\";}}');

/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table master
# ------------------------------------------------------------

DROP TABLE IF EXISTS `master`;

CREATE TABLE `master` (
  `master_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(60) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(4) NOT NULL,
  `zip` int(5) unsigned NOT NULL,
  `phone` varchar(20) NOT NULL,
  `website` varchar(60) DEFAULT NULL,
  `hours` varchar(50) DEFAULT NULL,
  `live_price` decimal(4,2) unsigned DEFAULT NULL,
  `boiled_price` decimal(4,2) unsigned DEFAULT NULL,
  `dine_in_price` decimal(4,2) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`master_id`),
  KEY `name` (`name`,`city`,`state`,`zip`,`live_price`,`boiled_price`,`dine_in_price`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `master` WRITE;
/*!40000 ALTER TABLE `master` DISABLE KEYS */;

INSERT INTO `master` (`master_id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `website`, `hours`, `live_price`, `boiled_price`, `dine_in_price`, `timestamp`)
VALUES
	(1,'Deanie\'s Seafood Bucktown','1713 Lake Ave.','Metairie','LA',70005,'504-831-4141','http://www.deanies.com/',NULL,2.40,3.69,6.99,'2013-02-01 02:51:56'),
	(2,'Deanie\'s Seafood French Quarter','841 Iberville Street','New Orleans','LA',70112,'504-581-1316','http://www.deanies.com/',NULL,2.99,4.19,8.99,'2013-02-01 02:51:56'),
	(3,'Dennis\' Seafood','4428 Lorino St.','Metairie','LA',70006,'504-885-2209',NULL,NULL,2.20,4.25,NULL,'2013-02-01 02:56:58'),
	(4,'Big Fisherman Seafood','3301 Magazine St','New Orleans','LA',70115,'504-897-9907','http://www.bigfishermanseafood.com/','10am-6pm',3.09,4.99,NULL,'2013-02-01 02:56:58');

/*!40000 ALTER TABLE `master` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_accounts`;

CREATE TABLE `user_accounts` (
  `uacc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uacc_group_fk` smallint(5) unsigned NOT NULL,
  `uacc_email` varchar(100) NOT NULL,
  `uacc_username` varchar(15) NOT NULL,
  `uacc_password` varchar(60) NOT NULL,
  `uacc_ip_address` varchar(40) NOT NULL,
  `uacc_salt` varchar(40) NOT NULL,
  `uacc_activation_token` varchar(40) NOT NULL,
  `uacc_forgotten_password_token` varchar(40) NOT NULL,
  `uacc_forgotten_password_expire` datetime NOT NULL,
  `uacc_update_email_token` varchar(40) NOT NULL,
  `uacc_update_email` varchar(100) NOT NULL,
  `uacc_active` tinyint(1) unsigned NOT NULL,
  `uacc_suspend` tinyint(1) unsigned NOT NULL,
  `uacc_fail_login_attempts` smallint(5) NOT NULL,
  `uacc_fail_login_ip_address` varchar(40) NOT NULL,
  `uacc_date_fail_login_ban` datetime NOT NULL COMMENT 'Time user is banned until due to repeated failed logins',
  `uacc_date_last_login` datetime NOT NULL,
  `uacc_date_added` datetime NOT NULL,
  PRIMARY KEY (`uacc_id`),
  UNIQUE KEY `uacc_id` (`uacc_id`),
  KEY `uacc_group_fk` (`uacc_group_fk`),
  KEY `uacc_email` (`uacc_email`),
  KEY `uacc_username` (`uacc_username`),
  KEY `uacc_fail_login_ip_address` (`uacc_fail_login_ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_accounts` WRITE;
/*!40000 ALTER TABLE `user_accounts` DISABLE KEYS */;

INSERT INTO `user_accounts` (`uacc_id`, `uacc_group_fk`, `uacc_email`, `uacc_username`, `uacc_password`, `uacc_ip_address`, `uacc_salt`, `uacc_activation_token`, `uacc_forgotten_password_token`, `uacc_forgotten_password_expire`, `uacc_update_email_token`, `uacc_update_email`, `uacc_active`, `uacc_suspend`, `uacc_fail_login_attempts`, `uacc_fail_login_ip_address`, `uacc_date_fail_login_ban`, `uacc_date_last_login`, `uacc_date_added`)
VALUES
	(1,3,'elliotfleming@gmail.com','','$2a$08$7uGn9wb4fg0kqXG22bTOme8mM5SLpzgncuEmdo.bkilbmXrLbe15O','127.0.0.1','P8Wph48FNN','','','0000-00-00 00:00:00','','',1,0,0,'','0000-00-00 00:00:00','2013-09-29 20:00:32','2013-03-01 17:45:18'),
	(2,1,'elliotfleming7@gmail.com','','$2a$08$Mvp8Ny8E0cM58WDQwT1cf.JxoEoY8QqCBlJmHUNiHn.nAZzGp4E6e','127.0.0.1','HnS4h9twnB','','','0000-00-00 00:00:00','','',1,0,5,'127.0.0.1','0000-00-00 00:00:00','2013-03-01 17:54:44','2013-03-01 17:54:44'),
	(3,1,'user@crawfinder.com','','$2a$08$KW0H9hvP98IHwZ.cZtLDVOnNPbWiLALFDUIzZ7qk4DavLybD2SXhS','127.0.0.1','SfZ4JQjqtn','','','0000-00-00 00:00:00','','',1,0,0,'','0000-00-00 00:00:00','2013-09-29 20:26:11','2013-09-29 20:18:12');

/*!40000 ALTER TABLE `user_accounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `ugrp_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `ugrp_name` varchar(20) NOT NULL,
  `ugrp_desc` varchar(100) NOT NULL,
  `ugrp_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`ugrp_id`),
  UNIQUE KEY `ugrp_id` (`ugrp_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;

INSERT INTO `user_groups` (`ugrp_id`, `ugrp_name`, `ugrp_desc`, `ugrp_admin`)
VALUES
	(1,'Public','Public User : has no admin access rights.',0),
	(2,'Moderator','Admin Moderator : has partial admin access rights.',1),
	(3,'Master Admin','Master Admin : has full admin access rights.',1);

/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_login_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_login_sessions`;

CREATE TABLE `user_login_sessions` (
  `usess_uacc_fk` int(11) NOT NULL,
  `usess_series` varchar(40) NOT NULL,
  `usess_token` varchar(40) NOT NULL,
  `usess_login_date` datetime NOT NULL,
  PRIMARY KEY (`usess_token`),
  UNIQUE KEY `usess_token` (`usess_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_login_sessions` WRITE;
/*!40000 ALTER TABLE `user_login_sessions` DISABLE KEYS */;

INSERT INTO `user_login_sessions` (`usess_uacc_fk`, `usess_series`, `usess_token`, `usess_login_date`)
VALUES
	(3,'710d8b6a1d5f16ce42eca455e5152c8bbdc85e7b','524dfc6bf094c8e6a3d6e659b17a42ecc1b7f6fb','2013-09-29 20:26:11'),
	(3,'','76137083406a6ec4934bfb16271e06789d304ba6','2013-09-29 20:26:11');

/*!40000 ALTER TABLE `user_login_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_privilege_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_privilege_groups`;

CREATE TABLE `user_privilege_groups` (
  `upriv_groups_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `upriv_groups_ugrp_fk` smallint(5) unsigned NOT NULL,
  `upriv_groups_upriv_fk` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`upriv_groups_id`),
  UNIQUE KEY `upriv_groups_id` (`upriv_groups_id`) USING BTREE,
  KEY `upriv_groups_ugrp_fk` (`upriv_groups_ugrp_fk`),
  KEY `upriv_groups_upriv_fk` (`upriv_groups_upriv_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_privilege_groups` WRITE;
/*!40000 ALTER TABLE `user_privilege_groups` DISABLE KEYS */;

INSERT INTO `user_privilege_groups` (`upriv_groups_id`, `upriv_groups_ugrp_fk`, `upriv_groups_upriv_fk`)
VALUES
	(1,3,1),
	(3,3,3),
	(4,3,4),
	(5,3,5),
	(6,3,6),
	(7,3,7),
	(8,3,8),
	(9,3,9),
	(10,3,10),
	(11,3,11),
	(12,2,1),
	(13,2,3),
	(14,2,4),
	(15,2,5),
	(16,2,6),
	(17,2,7),
	(18,2,8);

/*!40000 ALTER TABLE `user_privilege_groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_privilege_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_privilege_users`;

CREATE TABLE `user_privilege_users` (
  `upriv_users_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `upriv_users_uacc_fk` int(11) NOT NULL,
  `upriv_users_upriv_fk` smallint(5) NOT NULL,
  PRIMARY KEY (`upriv_users_id`),
  UNIQUE KEY `upriv_users_id` (`upriv_users_id`) USING BTREE,
  KEY `upriv_users_uacc_fk` (`upriv_users_uacc_fk`),
  KEY `upriv_users_upriv_fk` (`upriv_users_upriv_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_privileges
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_privileges`;

CREATE TABLE `user_privileges` (
  `upriv_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `upriv_name` varchar(20) NOT NULL,
  `upriv_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`upriv_id`),
  UNIQUE KEY `upriv_id` (`upriv_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_privileges` WRITE;
/*!40000 ALTER TABLE `user_privileges` DISABLE KEYS */;

INSERT INTO `user_privileges` (`upriv_id`, `upriv_name`, `upriv_desc`)
VALUES
	(1,'View Users','User can view user account details.'),
	(2,'View User Groups','User can view user groups.'),
	(3,'View Privileges','User can view privileges.'),
	(4,'Insert User Groups','User can insert new user groups.'),
	(5,'Insert Privileges','User can insert privileges.'),
	(6,'Update Users','User can update user account details.'),
	(7,'Update User Groups','User can update user groups.'),
	(8,'Update Privileges','User can update user privileges.'),
	(9,'Delete Users','User can delete user accounts.'),
	(10,'Delete User Groups','User can delete user groups.'),
	(11,'Delete Privileges','User can delete user privileges.');

/*!40000 ALTER TABLE `user_privileges` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
