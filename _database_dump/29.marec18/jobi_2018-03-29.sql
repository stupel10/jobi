# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.35)
# Database: jobi
# Generation Time: 2018-03-29 08:43:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_profile` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `email`, `password`, `isactive`, `dt`, `active_profile`)
VALUES
	(19,'company@company.sk','$2y$10$PCjyCM4BibhZLX1mUGemiOmoz44kPDrOfso/RX99nntBbthYJ/fWC',1,'2018-03-24 19:07:05',13);

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table company_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company_attempts`;

CREATE TABLE `company_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table company_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company_profiles`;

CREATE TABLE `company_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `name` varchar(20) DEFAULT '',
  `photo_link` varchar(100) DEFAULT NULL,
  `qr_link` varchar(100) DEFAULT NULL,
  `address_street` varchar(100) DEFAULT NULL,
  `address_street_number` varchar(10) DEFAULT NULL,
  `address_PSC` int(5) DEFAULT NULL,
  `address_city` varchar(30) DEFAULT NULL,
  `address_country` varchar(20) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `company_profiles` WRITE;
/*!40000 ALTER TABLE `company_profiles` DISABLE KEYS */;

INSERT INTO `company_profiles` (`id`, `email`, `name`, `photo_link`, `qr_link`, `address_street`, `address_street_number`, `address_PSC`, `address_city`, `address_country`, `date_registered`, `phone`)
VALUES
	(13,'company@company.sk','Interway',NULL,'/assets/images/qr_codes/company/company_13.png','Mlynske Nivy ','19/A',91917,'Blava, ne?','Slovacja','2018-03-24 19:07:05','0915125789');

/*!40000 ALTER TABLE `company_profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table company_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company_sessions`;

CREATE TABLE `company_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;

INSERT INTO `config` (`setting`, `value`)
VALUES
	('attack_mitigation_time','+30 minutes'),
	('attempts_before_ban','30'),
	('attempts_before_verify','5'),
	('bcrypt_cost','10'),
	('cookie_domain',NULL),
	('cookie_forget','+30 minutes'),
	('cookie_http','0'),
	('cookie_name','authID'),
	('cookie_path','/'),
	('cookie_remember','+1 month'),
	('cookie_secure','0'),
	('emailmessage_suppress_activation','0'),
	('emailmessage_suppress_reset','0'),
	('mail_charset','UTF-8'),
	('password_min_score','3'),
	('request_key_expiration','+10 minutes'),
	('site_activation_page','activate'),
	('site_email','no-reply@phpauth.cuonic.com'),
	('site_key','fghuior.)/!/jdUkd8s2!7HVHG7777ghg'),
	('site_name','PHPAuth'),
	('site_password_reset_page','reset'),
	('site_timezone','Europe/Paris'),
	('site_url','https://github.com/PHPAuth/PHPAuth'),
	('smtp','0'),
	('smtp_auth','1'),
	('smtp_debug','0'),
	('smtp_host','smtp.example.com'),
	('smtp_password','password'),
	('smtp_port','25'),
	('smtp_security',NULL),
	('smtp_username','email@example.com'),
	('table_companies','companies'),
	('table_company_attempts','company_attempts'),
	('table_company_profiles','company_profiles'),
	('table_company_requests','company_requests'),
	('table_company_sessions','company_sessions'),
	('table_users','users'),
	('table_user_attempts','user_attempts'),
	('table_user_profiles','user_profiles'),
	('table_user_requests','user_requests'),
	('table_user_sessions','user_sessions'),
	('verify_email_max_length','100'),
	('verify_email_min_length','5'),
	('verify_email_use_banlist','1'),
	('verify_password_min_length','3');

/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `title` varchar(100) DEFAULT '',
  `text` text,
  `qr_link` varchar(100) DEFAULT NULL,
  `users_registered` varchar(2000) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `area` varchar(40) DEFAULT NULL,
  `send_email` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;

INSERT INTO `jobs` (`id`, `company_id`, `title`, `text`, `qr_link`, `users_registered`, `category`, `area`, `send_email`)
VALUES
	(28,13,'Senior Java developer ','Hladame nahradu za Bocka. Chces ho zastupit?','/assets/images/qr_codes/job/job_28.png','11,11',NULL,NULL,NULL),
	(29,13,'Junior Frontend Developer','<p>Hladame praveho frontendaka. Javascript, html css povinne. <strong>Frameworky vyhodou.</strong></p>\r\n','/assets/images/qr_codes/job/job_29.png',NULL,'','','0'),
	(30,13,'Asistentka veduceho marketingovej spolocnosti','Hladame novu peknu milu asistentku pre nasho sefinka.','/assets/images/qr_codes/job/job_30.png',NULL,'Administratívny pracovník, referent','Bánovce nad Bebravou','1'),
	(32,13,'novinka','<h1>Ahoj, ako?</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ponukame toto a toto a este zelene hrusky a gombiky na kozenne vetrovky.</p>\r\n','/assets/images/qr_codes/job/job_32.png',NULL,'Procesný inžinier','Čadca','1');

/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rkey` varchar(20) NOT NULL,
  `expire` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table resumes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resumes`;

CREATE TABLE `resumes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL DEFAULT '',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `resumes` WRITE;
/*!40000 ALTER TABLE `resumes` DISABLE KEYS */;

INSERT INTO `resumes` (`id`, `user_id`, `title`, `text`, `date_created`)
VALUES
	(11,34,'my first CV','<p>This is my<strong> first CV</strong>. Not good i know.</p>\r\n','2018-03-28 13:58:46');

/*!40000 ALTER TABLE `resumes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_attempts`;

CREATE TABLE `user_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` varchar(6) DEFAULT 'MALE',
  `title` varchar(30) DEFAULT NULL,
  `photo_link` varchar(100) DEFAULT NULL,
  `qr_link` varchar(100) DEFAULT NULL,
  `address_street` varchar(100) DEFAULT NULL,
  `address_street_number` varchar(10) DEFAULT NULL,
  `address_PSC` int(5) DEFAULT NULL,
  `address_city` varchar(30) DEFAULT NULL,
  `address_country` varchar(20) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jobs_registered` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;

INSERT INTO `user_profiles` (`id`, `email`, `name`, `surname`, `birthdate`, `sex`, `title`, `photo_link`, `qr_link`, `address_street`, `address_street_number`, `address_PSC`, `address_city`, `address_country`, `phone`, `date_registered`, `jobs_registered`)
VALUES
	(34,'jakub.vyskoc@gmail.com','Jakub','Vyskoc','1993-10-02','MALE','Bc.',NULL,'/assets/images/qr_codes/user/user_34.png','Orechova ','36',91927,'Brestovany','Slovakia','0915125789','2018-03-24 19:16:50',',28');

/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_sessions`;

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_sessions` WRITE;
/*!40000 ALTER TABLE `user_sessions` DISABLE KEYS */;

INSERT INTO `user_sessions` (`id`, `uid`, `hash`, `expiredate`, `ip`, `agent`, `cookie_crc`)
VALUES
	(42,38,'6e91e3339595dc0b62609be8f315ad4d3708f5f7','2018-04-28 17:42:42','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','12cf18b66c39aac9dccdd2ec2e9cf49f7b05cb4a');

/*!40000 ALTER TABLE `user_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_profile` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `isactive`, `dt`, `active_profile`)
VALUES
	(38,'jakub.vyskoc@gmail.com','$2y$10$ohhNZG75UPVGEzgQF3j1HOX68SneyJs.oVW3of2VKoq7mCKyv3uQi',1,'2018-03-24 19:00:27',34);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
