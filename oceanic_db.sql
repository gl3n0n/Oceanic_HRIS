-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: oceanic
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `dept_code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `location_id` int(11) NOT NULL,
  `headed_by` varchar(100) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`dept_id`),
  UNIQUE KEY `dept_uk` (`org_id`,`dept_code`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (19,1,'FIN','FINANCE DIVISION',1,NULL,1,1,'2013-07-20 10:37:16',0,'2013-07-20 10:37:16'),(20,1,'ENG','ENGINEERING DIVISION',1,'supervisor',1,1,'2013-07-20 10:38:53',0,'2013-07-20 10:38:53'),(17,1,'CSD','SALES AND MARKETING DIVISION',1,NULL,1,1,'2013-07-20 10:28:18',6,'2013-07-20 10:28:18'),(26,1,'ASM','ASSET AND SUPPLY MANAGEMENT',1,'supervisor',1,6,'2014-03-04 07:03:06',6,'2014-03-04 07:03:06'),(27,1,'ASM - PRC','PROCUREMENT',1,'supervisor',15,6,'2014-03-04 07:03:34',0,'2014-03-04 07:03:34'),(28,1,'ENG - SRM','SHIP REPAIRS & MAINTENANCE',1,'supervisor',15,6,'2014-03-04 07:04:48',0,'2014-03-04 07:04:48'),(29,1,'ASM - PI','PROPERTY & INVENTORY',1,'supervisor',15,6,'2014-03-04 07:05:50',0,'2014-03-04 07:05:50'),(30,1,'ENG - TRM','TERMINAL REPAIRS & MAINTENANCE',1,'supervisor',15,6,'2014-03-04 07:07:37',0,'2014-03-04 07:07:37'),(32,1,'CSD - HR','HR and ADMINISTRATION DEPT.',1,NULL,15,6,'2014-03-04 07:09:37',1,'2015-10-26 08:25:15'),(33,1,'CSD - IT','INFORMATION TECHNOLOGY',1,NULL,15,6,'2014-03-04 07:10:14',0,'2014-03-04 07:10:14'),(34,1,'CSD - LC','LEGAL AND CLAIMS',1,NULL,15,6,'2014-03-04 07:10:51',0,'2014-03-04 07:10:51'),(35,1,'CSD - DPACSO','DPA / CSO',1,NULL,15,6,'2014-03-04 07:11:55',0,'2014-03-04 07:11:55'),(36,1,'LOG','LOGISTICS DIVISION',1,NULL,NULL,6,'2014-03-04 07:12:54',0,'2014-03-04 07:12:54'),(37,1,'LOG - TO','TERMINAL OPERATIONS',1,NULL,14,6,'2014-03-04 07:13:46',0,'2014-03-04 07:13:46'),(38,1,'LOG - TS','TRANSPORT SERVICES',1,NULL,14,6,'2014-03-04 07:14:24',0,'2014-03-04 07:14:24'),(39,1,'LOG - BR','BRANCH OPERATIONS',1,NULL,14,6,'2014-03-04 07:14:59',0,'2014-03-04 07:14:59'),(40,1,'FIN - ACC','ACCOUNTIING',1,NULL,14,6,'2014-03-04 07:15:52',0,'2014-03-04 07:15:52'),(41,1,'FIN - CC','CREDIT AND COLLECTION',1,NULL,14,6,'2014-03-04 07:16:18',0,'2014-03-04 07:16:18'),(42,1,'FIN - TR','TREASURY',1,NULL,14,6,'2014-03-04 07:16:44',0,'2014-03-04 07:16:44'),(43,1,'FIN - BRAC','BRANCH ACCOUNTING',1,NULL,14,6,'2014-03-04 07:17:22',0,'2014-03-04 07:17:22'),(44,1,'SMD','SALES AND MARKETING DIVISION',1,'supervisor2',1,6,'2014-03-04 07:17:54',6,'2014-03-04 07:17:54'),(45,1,'SMD - SALES','SALES',1,'supervisor2',14,6,'2014-03-04 07:18:27',0,'2014-03-04 07:18:27'),(46,1,'SMD - MRK','MARKETING',1,'supervisor2',14,6,'2014-03-04 07:18:51',0,'2014-03-04 07:18:51'),(47,1,'SMD - BOOK','BOOKING',1,'supervisor2',14,6,'2014-03-04 07:19:28',0,'2014-03-04 07:19:28'),(48,1,'FMD','FLEET MANAGEMENT DIVISION',1,NULL,1,6,'2014-03-04 07:20:07',6,'2014-03-04 07:20:07'),(49,1,'FMD - MAR','MARINE',1,NULL,1,6,'2014-03-04 07:20:43',0,'2014-03-04 07:20:43'),(50,1,'FMD - VES','VESSEL',1,NULL,1,6,'2014-03-04 07:21:02',0,'2014-03-04 07:21:02'),(51,1,'FMD - RC','RADIO COMMUNICATION',1,NULL,1,6,'2014-03-04 07:21:32',0,'2014-03-04 07:21:32'),(52,1,'OP','OFFICE OF THE PRESIDENT',1,NULL,NULL,6,'2014-03-04 09:44:33',0,'2014-03-04 09:44:33'),(53,1,'HRD','HUMAN RESOURCES DEPT',1,NULL,NULL,1,'2015-10-01 03:53:19',0,'0000-00-00 00:00:00'),(54,1,'GRINDEPT','test',1,NULL,NULL,1,'2015-10-23 08:39:20',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `division`
--

DROP TABLE IF EXISTS `division`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `division_code` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`division_id`),
  UNIQUE KEY `division_code_uk` (`org_id`,`division_code`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `division`
--

LOCK TABLES `division` WRITE;
/*!40000 ALTER TABLE `division` DISABLE KEYS */;
INSERT INTO `division` VALUES (1,1,'DIV1','DIVISION 1',1,'2013-06-12 14:43:17',6,'2013-06-12 14:43:17'),(15,1,'RND','RESEARCH AND DEVELOPMENT',6,'2014-03-24 19:20:58',0,'2014-03-24 19:20:58'),(14,1,'DIV2','DIVISION 2',6,'2014-03-24 19:20:48',0,'2014-03-24 19:20:48'),(13,1,'TMPDIV','TEMPORARY DIVISION',6,'2014-03-24 19:20:31',0,'2014-03-24 19:20:31'),(16,1,'1','123',1,'2015-04-06 00:44:36',1,'2016-01-08 06:29:09'),(17,1,'CSD','CORPORATE SERVICES DIVISION',1,'2015-10-01 03:51:38',0,'0000-00-00 00:00:00'),(18,1,'TESTDIVCODE','update test division',1,'2015-10-23 08:36:51',1,'2015-10-23 08:37:28'),(19,1,'ddd','ddd',1,'2016-02-04 16:05:05',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `division` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_education`
--

DROP TABLE IF EXISTS `employee_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_education` (
  `empl_education_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `school` varchar(100) NOT NULL DEFAULT '',
  `level` enum('COLLEGE','TERTIARY','ELEMENTARY','MASTER') DEFAULT 'COLLEGE',
  `course` varchar(50) NOT NULL DEFAULT '',
  `degree` varchar(100) DEFAULT '',
  `honors` text,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_education_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_education`
--

LOCK TABLES `employee_education` WRITE;
/*!40000 ALTER TABLE `employee_education` DISABLE KEYS */;
INSERT INTO `employee_education` VALUES (1,1,3,'test','COLLEGE','test','test','test',1,'2013-06-27 02:54:39',0,'2013-06-27 02:54:39'),(2,1,1,'test','COLLEGE','test','test','test',1,'2013-08-27 03:46:24',0,'2013-08-27 03:46:24'),(3,1,12,'test','TERTIARY','test','test','test',1,'2014-04-10 02:07:08',1,'2015-03-30 00:00:13'),(4,1,5,'GRADE','ELEMENTARY','GRADE','GRADE','GRADE',8,'2015-03-31 19:53:56',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `employee_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_employment`
--

DROP TABLE IF EXISTS `employee_employment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_employment` (
  `empl_employment_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `effectivity_date` date NOT NULL,
  `job_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_employment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_employment`
--

LOCK TABLES `employee_employment` WRITE;
/*!40000 ALTER TABLE `employee_employment` DISABLE KEYS */;
INSERT INTO `employee_employment` VALUES (1,1,12,'2013-09-13',17,24,'TEST1',1,'2013-09-17 02:02:39',1,'2015-03-30 12:59:08'),(2,1,12,'2015-03-13',21,25,'what the',1,'2015-03-30 12:16:39',0,'2015-03-30 12:16:39'),(3,1,8,'2015-04-10',19,23,'asd',10,'2015-03-31 20:59:49',10,'2015-03-31 20:59:53');
/*!40000 ALTER TABLE `employee_employment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_family`
--

DROP TABLE IF EXISTS `employee_family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_family` (
  `empl_family_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT '',
  `birthdate` date DEFAULT NULL,
  `gender` enum('MALE','FEMALE') DEFAULT 'MALE',
  `relationship` enum('FATHER','MOTHER','SON','DAUGHTER','COUSIN','BROTHER','SISTER') DEFAULT 'FATHER',
  `civil_status` enum('SINGLE','MARRIED','SEPERATED','WIDOWED') DEFAULT 'SINGLE',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_family_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_family`
--

LOCK TABLES `employee_family` WRITE;
/*!40000 ALTER TABLE `employee_family` DISABLE KEYS */;
INSERT INTO `employee_family` VALUES (1,1,12,'test12 t. test','0000-00-00','MALE','FATHER','MARRIED',1,'2013-06-27 03:05:40',1,'2015-03-30 13:08:17'),(2,1,3,'test12 t. test','0000-00-00','MALE','FATHER','MARRIED',1,'2013-06-27 03:05:44',0,'2013-06-27 03:05:44'),(3,1,3,'gasfdghfashd','0000-00-00','MALE','FATHER','MARRIED',1,'2013-06-27 03:07:21',0,'2013-06-27 03:07:21'),(4,1,3,'hgsadjasgdjhsagdh','0000-00-00','MALE','FATHER','SINGLE',1,'2013-06-27 03:08:18',0,'2013-06-27 03:08:18'),(5,1,3,'sdjhflksdjf','1988-12-30','MALE','FATHER','SINGLE',1,'2013-06-27 03:26:32',0,'2013-06-27 03:26:32'),(6,1,12,'test','0000-00-00','MALE','BROTHER','MARRIED',1,'2013-06-27 14:35:47',0,'2013-06-27 14:35:47'),(7,1,1,'test','2004-04-22','MALE','FATHER','SINGLE',1,'2013-08-13 03:17:27',0,'2013-08-13 03:17:27');
/*!40000 ALTER TABLE `employee_family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_infraction`
--

DROP TABLE IF EXISTS `employee_infraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_infraction` (
  `empl_infraction_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `policy_id` int(11) DEFAULT NULL,
  `description` varchar(100) NOT NULL DEFAULT '',
  `date_received` date DEFAULT NULL,
  `sanction` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_infraction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_infraction`
--

LOCK TABLES `employee_infraction` WRITE;
/*!40000 ALTER TABLE `employee_infraction` DISABLE KEYS */;
INSERT INTO `employee_infraction` VALUES (1,1,12,5,'absent','0000-00-00','probation',1,'2013-06-27 03:55:09',0,'2013-06-27 03:55:09'),(2,1,3,5,'test','0000-00-00','test',1,'2013-07-05 06:09:24',0,'2013-07-05 06:09:24'),(3,1,12,5,'test12','2009-09-09','test12',1,'2013-07-23 03:50:37',0,'2013-07-23 03:50:37'),(4,1,12,1,'test123','0000-00-00','test',1,'2013-07-23 03:51:32',0,'2013-07-23 03:51:32'),(5,1,1,5,'test','2013-09-12','test',1,'2013-08-13 03:09:57',0,'2013-08-13 03:09:57'),(6,1,12,1,'dddd','2015-03-20','asd',1,'2015-03-31 01:31:53',0,'2015-03-31 07:31:53');
/*!40000 ALTER TABLE `employee_infraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_licenses`
--

DROP TABLE IF EXISTS `employee_licenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_licenses` (
  `empl_license_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `license_type` varchar(100) DEFAULT '',
  `license_no` varchar(100) DEFAULT '',
  `date_issued` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_license_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_licenses`
--

LOCK TABLES `employee_licenses` WRITE;
/*!40000 ALTER TABLE `employee_licenses` DISABLE KEYS */;
INSERT INTO `employee_licenses` VALUES (1,1,12,'test','001','2013-09-01','2014-07-18','test',1,'2013-09-10 04:07:48',0,'2013-09-10 04:07:48'),(2,1,12,'test1','test1','2014-01-01','2014-12-27','test1',1,'2014-01-14 03:32:39',0,'2014-01-14 03:32:40'),(3,1,5,'DRIVERS','NO3-A3R2WE','2015-10-23','2016-01-22','NON PRO',8,'2015-10-23 08:57:03',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `employee_licenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_medical`
--

DROP TABLE IF EXISTS `employee_medical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_medical` (
  `empl_medical_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT '',
  `prescription` varchar(100) DEFAULT '',
  `hospital` varchar(100) DEFAULT '',
  `physician` varchar(100) DEFAULT '',
  `checkup_date` date DEFAULT NULL,
  `vac_exp` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_medical_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_medical`
--

LOCK TABLES `employee_medical` WRITE;
/*!40000 ALTER TABLE `employee_medical` DISABLE KEYS */;
INSERT INTO `employee_medical` VALUES (1,1,1,'test t. test','test','test','test','0000-00-00','2016-12-12',1,'2013-06-27 05:34:32',0,'2013-06-27 05:34:32'),(2,1,12,'test1','test1','test1','test1','2008-12-17','2016-12-12',1,'2013-06-27 05:35:47',0,'2013-06-27 05:35:47'),(3,1,3,'test','test','test','test','0000-00-00','2016-12-12',1,'2013-06-27 06:11:56',0,'2013-06-27 06:11:56'),(4,1,12,'test123','test123','test123','test123','0000-00-00','2016-12-12',1,'2013-07-16 07:13:59',0,'2013-07-16 07:13:59'),(5,1,12,'test','test','test','test','0000-00-00','2016-12-12',1,'2013-08-13 03:14:48',0,'2013-08-13 03:14:48');
/*!40000 ALTER TABLE `employee_medical` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_reward`
--

DROP TABLE IF EXISTS `employee_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_reward` (
  `empl_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `reward` varchar(100) DEFAULT '',
  `description` varchar(100) DEFAULT '',
  `date_received` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_reward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_reward`
--

LOCK TABLES `employee_reward` WRITE;
/*!40000 ALTER TABLE `employee_reward` DISABLE KEYS */;
INSERT INTO `employee_reward` VALUES (1,1,3,'test t. test','test','0000-00-00',1,'2013-06-27 05:18:16',0,'2013-06-27 05:18:16'),(2,1,1,'test','test','0000-00-00',1,'2013-06-27 05:39:23',0,'2013-06-27 05:39:23'),(3,1,12,'test','test','2013-10-04',1,'2013-08-13 03:13:01',0,'2013-08-13 03:13:01'),(4,1,12,'test1','test1','2013-08-17',1,'2013-08-27 03:49:12',0,'2013-08-27 03:49:12');
/*!40000 ALTER TABLE `employee_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_training`
--

DROP TABLE IF EXISTS `employee_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_training` (
  `empl_training_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `training_type` varchar(100) DEFAULT '',
  `description` varchar(100) DEFAULT '',
  `date_attended` date DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_training_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_training`
--

LOCK TABLES `employee_training` WRITE;
/*!40000 ALTER TABLE `employee_training` DISABLE KEYS */;
INSERT INTO `employee_training` VALUES (1,1,12,'test','test','2013-09-12','test',1,'2013-09-10 04:07:13',0,'2013-09-10 04:07:13'),(2,1,12,'TEST001','TEST001','2013-10-24','TEST001',1,'2014-01-14 06:58:57',0,'2014-01-14 06:58:57');
/*!40000 ALTER TABLE `employee_training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_type`
--

DROP TABLE IF EXISTS `employee_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_type` (
  `empl_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `empl_type` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`empl_type_id`),
  UNIQUE KEY `rank_uk` (`org_id`,`empl_type`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_type`
--

LOCK TABLES `employee_type` WRITE;
/*!40000 ALTER TABLE `employee_type` DISABLE KEYS */;
INSERT INTO `employee_type` VALUES (12,1,'REG','REGULAR EMPLOYEE',6,'2014-03-06 03:23:26',0,'2014-03-06 03:23:27'),(5,1,'PROBA-6MONTH','PROBATIONARY FOR 6 MONTH ONLY',1,'2013-05-18 03:47:13',1,'2013-05-18 03:47:13'),(13,1,'1YEAR','ONE YEAR',1,'2015-10-23 08:45:44',0,'0000-00-00 00:00:00'),(10,1,'CONT','CONTRACTUAL',6,'2014-02-04 05:59:10',0,'2014-02-04 05:59:10'),(11,1,'6MO','6 MONTHS CONTRACT',6,'2014-02-04 06:03:48',0,'2014-02-04 06:03:48');
/*!40000 ALTER TABLE `employee_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `middlename` varchar(50) NOT NULL DEFAULT '',
  `dept_id` varchar(100) NOT NULL DEFAULT '',
  `position_id` varchar(100) NOT NULL DEFAULT '',
  `empl_type_id` varchar(100) NOT NULL DEFAULT '',
  `gender` enum('MALE','FEMALE') DEFAULT 'MALE',
  `address` text,
  `tel_no` varchar(100) DEFAULT '',
  `cell_no` varchar(100) DEFAULT '',
  `civil_status` enum('SINGLE','MARRIED','SEPERATED','WIDOWED') DEFAULT 'SINGLE',
  `religion` varchar(100) DEFAULT '',
  `date_hired` date DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT '',
  `empl_status` enum('ACTIVE','INACTIVE','TERMINATED') DEFAULT 'ACTIVE',
  `sss` varchar(100) DEFAULT '',
  `tin` varchar(100) DEFAULT '',
  `pagibig` varchar(100) DEFAULT '',
  `philhealth` varchar(100) DEFAULT '',
  `tax_type` varchar(100) DEFAULT '',
  `salary_grade` varchar(100) DEFAULT '',
  `passport_no` varchar(100) DEFAULT '',
  `passport_exp` varchar(100) DEFAULT '',
  `date_resigned` date DEFAULT NULL,
  `seaman_book_no` varchar(100) DEFAULT '',
  `seaman_book_exp` varchar(100) DEFAULT '',
  `biometric_no` varchar(100) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (12,1,'bacudo','john','banez','52','29','11','MALE','sampaloc','4127248','09178491582','SINGLE',NULL,NULL,'2013-03-20','apayao','ACTIVE','09090909090','090909090909',NULL,'0909090909','090909090909','09090909090909','09090909090909','0909090909090',NULL,'09090909090','9090909090','090909090909',1,'2014-04-10 02:02:04',0,'2014-04-10 02:02:04'),(9,1,'supervisor2','supervisor2','sup2','36','18','7','FEMALE','manila','123456789','1234567','MARRIED',NULL,NULL,'1989-08-29','manila','ACTIVE','11111111','1111111',NULL,'111111','1111111','7','1111111',NULL,NULL,'111111',NULL,'11111111',6,'2014-03-04 09:35:21',0,'2014-03-04 09:35:22'),(1,1,'engemp','engemp','ee','28','19','12','MALE','manila','1111111','11111111111','SINGLE',NULL,NULL,'2014-02-24','manila','ACTIVE','22222','22222',NULL,'22222','22222','5','22222',NULL,NULL,'22222',NULL,'22222',6,'2014-03-06 03:27:56',0,'2014-03-06 03:27:56'),(11,1,'empsmd','empsmd','emp','45','19','12','MALE','manila','222222','222222','SINGLE',NULL,NULL,'2014-02-24','manila','ACTIVE','2222','2222',NULL,'3333','22222','3','22222',NULL,NULL,'22222',NULL,'22222',6,'2014-03-06 09:20:55',0,'2014-03-06 09:20:55'),(5,1,'linson','mikael','salvacion','20','11','7','MALE','new manila, quezon city','412 12 12','09065021650','SEPERATED',NULL,NULL,'1989-10-08','cavite','ACTIVE','111111','111111',NULL,'1111111','111111','100,000','111111','12,12,2067',NULL,'1212121','12,12,2034','12121212',1,'2014-01-15 08:01:47',0,'2014-01-15 08:01:47'),(6,1,'abrenica','ric','talanay','19','11','7','MALE','quiapo','4112273','09328823283','MARRIED',NULL,NULL,'1960-12-04','quiapo','ACTIVE','11111111','1111111111',NULL,'111111111111','1111111111111','12,000','111111111111111','12,12,2015',NULL,'111111111111','12,12,2016','11111111111111',7,'2014-01-15 08:14:23',0,'2014-01-15 08:14:23'),(7,1,'employee','employee','emp','25','17','10','FEMALE','qc','123','123','WIDOWED',NULL,NULL,'2013-10-01','manila','ACTIVE','123','123',NULL,'123','123',NULL,'123','123','2013-10-08','123','123','123',6,'2014-02-05 05:58:18',0,'2014-02-05 05:58:18'),(8,1,'supervisor','supervisor','sup','19','23','11','FEMALE','new manila','456','567','SEPERATED',NULL,NULL,'2014-02-14','quiapo','ACTIVE','890','890',NULL,'890','890','890','890','890','2014-02-14','890','890','890',6,'2014-02-05 06:23:43',10,'2015-03-31 21:05:18'),(13,1,'bacudo','john','banez','52','29','11','MALE','sampaloc','4127248','09178491582','SINGLE',NULL,NULL,'2013-03-20','apayao','ACTIVE','09090909090','090909090909',NULL,'0909090909','090909090909','09090909090909','09090909090909','0909090909090',NULL,'09090909090','9090909090','090909090909',1,'2014-04-10 02:02:09',0,'2014-04-10 02:02:09');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_events`
--

DROP TABLE IF EXISTS `hr_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_events` (
  `hr_events_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(100) NOT NULL DEFAULT '',
  `location` varchar(100) NOT NULL DEFAULT '',
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`hr_events_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_events`
--

LOCK TABLES `hr_events` WRITE;
/*!40000 ALTER TABLE `hr_events` DISABLE KEYS */;
INSERT INTO `hr_events` VALUES (1,1,'april fool\'s','at your back','2015-04-01 00:00:01','2015-04-02 15:59:59',1,'2015-04-06 04:59:56',0,'0000-00-00 00:00:00'),(2,1,'april fool\'s2','at your back','2015-04-01 00:00:01','2015-04-02 15:59:59',1,'2015-04-06 04:59:56',0,'0000-00-00 00:00:00'),(3,1,'april fool\'s3','at your back','2015-04-01 00:00:01','2015-04-02 15:59:59',1,'2015-04-06 04:59:56',0,'0000-00-00 00:00:00'),(4,1,'april fool\'s4','at your back','2015-04-01 00:00:01','2015-04-02 15:59:59',1,'2015-04-06 04:59:56',0,'0000-00-00 00:00:00'),(5,1,'april fool\'s5','at your back','2015-04-01 00:00:01','2015-04-02 15:59:59',1,'2015-04-06 04:59:56',0,'0000-00-00 00:00:00'),(6,1,'no title','somewhere','2015-04-06 06:40:36','2015-04-06 10:33:20',1,'2015-04-06 00:39:18',0,'0000-00-00 00:00:00'),(7,1,'this is it','this is where','2015-04-07 06:40:57','2015-04-07 06:41:01',1,'2015-04-06 00:41:06',0,'0000-00-00 00:00:00'),(30,1,'2','2','2015-04-11 06:51:03','2015-04-11 06:53:07',1,'2015-04-06 00:51:14',0,'0000-00-00 00:00:00'),(29,1,'1','1','2015-04-06 06:50:21','2015-04-06 06:52:25',1,'2015-04-06 00:50:30',0,'0000-00-00 00:00:00'),(26,1,'2','2','2015-04-26 06:47:53','2015-04-26 06:54:59',1,'2015-04-06 00:48:13',0,'0000-00-00 00:00:00'),(27,1,'2','2','2015-04-26 06:47:53','2015-04-26 06:54:59',1,'2015-04-06 00:48:13',0,'0000-00-00 00:00:00'),(28,1,'2','2','2015-04-26 06:47:53','2015-04-26 06:54:59',1,'2015-04-06 00:48:13',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `hr_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_offer`
--

DROP TABLE IF EXISTS `job_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_offer` (
  `job_offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL DEFAULT '',
  `jb_date` varchar(50) NOT NULL DEFAULT '',
  `position` varchar(100) NOT NULL DEFAULT '',
  `department` varchar(50) NOT NULL DEFAULT '',
  `division` varchar(50) NOT NULL DEFAULT '',
  `job_summary` varchar(150) NOT NULL DEFAULT '',
  `emp_status` varchar(50) NOT NULL DEFAULT '',
  `classification` varchar(50) NOT NULL DEFAULT '',
  `compensation` varchar(50) NOT NULL DEFAULT '',
  `benefits` varchar(50) NOT NULL DEFAULT '',
  `reporting_date` varchar(50) NOT NULL DEFAULT '',
  `remarks` varchar(50) NOT NULL DEFAULT '',
  `status` enum('ACCEPTED','REJECTED','PENDING') DEFAULT 'PENDING',
  `reject_reason` varchar(50) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`job_offer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_offer`
--

LOCK TABLES `job_offer` WRITE;
/*!40000 ALTER TABLE `job_offer` DISABLE KEYS */;
INSERT INTO `job_offer` VALUES (1,1,'GUILBERT LENON','JUNE 19, 2013','MANAGER','HRDEPT','ENGINEERING','TEST JOB SUMMARY','TEST','TEST','TEST','MEDICAL, DENTAL','JULY 23, 2013','RESRSSFSD','PENDING','',1,'2013-06-19 11:57:27',0,'2013-06-19 11:57:27'),(2,1,'TEST','12-12-2013','TEST','TEST1','TEST','TEST','TEST','TEST','TEST','TEST','12-12-2013','TEST','PENDING','',1,'2013-06-28 05:39:00',0,'2013-06-28 05:39:00'),(3,1,'TEST','07-23-2013','TESTING','FIN','TESTING','TEST','TEST','TEST','TEST','TEST','TEST','TEST','PENDING','',1,'2013-07-23 04:36:37',0,'2013-07-23 04:36:37');
/*!40000 ALTER TABLE `job_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `job_code` varchar(50) NOT NULL DEFAULT '',
  `job_description` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`job_id`),
  UNIQUE KEY `job_uk` (`org_id`,`job_code`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (19,1,'RF2SS','RF2 - SEMI SKILLED',6,'2014-03-24 11:07:16',0,'2014-03-24 11:07:16'),(18,1,'RF1U','RF1 - UNSKILLED',6,'2014-03-24 11:06:39',0,'2014-03-24 11:06:39'),(17,1,'DRV','DRIVERS',6,'2014-03-24 11:06:20',0,'2014-03-24 11:06:20'),(20,1,'RF2ST','RF2 - SKILLED TECHNICAL',6,'2014-03-24 11:07:33',0,'2014-03-24 11:07:33'),(21,1,'TLO','TEAM LEAD - OPERATIONS',6,'2014-03-24 11:07:50',0,'2014-03-24 11:07:50'),(22,1,'TLT','TEAM LEAD - TECHNICAL',6,'2014-03-24 11:08:05',0,'2014-03-24 11:08:05'),(23,1,'SUPNT','SUPERVISOR - NON TECHNICAL',6,'2014-03-24 11:08:29',0,'2014-03-24 11:08:29'),(24,1,'SUPB','SUPERVISOR - BRANCH',6,'2014-03-24 11:08:43',0,'2014-03-24 11:08:43'),(25,1,'SUPT','SUPERVISOR - TECHNICAL',6,'2014-03-24 11:09:13',0,'2014-03-24 11:09:13'),(26,1,'JMNT','JUNIOR MANAGER - NON TECHNICAL',6,'2014-03-24 11:09:30',0,'2014-03-24 11:09:30'),(27,1,'JMT','JUNIOR MANAGER - TECHNICAL',6,'2014-03-24 11:09:44',0,'2014-03-24 11:09:44'),(28,1,'SMNT','SENIOR MANAGER - NON TECHNICAL',6,'2014-03-24 11:10:14',0,'2014-03-24 11:10:14'),(29,1,'SMB','SENIOR MANAGER - BRANCH',6,'2014-03-24 11:10:27',0,'2014-03-24 11:10:27'),(30,1,'SMT','SENIOR MANAGER - TECHNICAL',6,'2014-03-24 11:10:37',0,'2014-03-24 11:10:37'),(31,1,'EVP','EXECUTIVE - VICE PRESIDENT',6,'2014-03-24 11:11:06',0,'2014-03-24 11:11:06'),(32,1,'HR STAFF','STFFAASF',1,'2015-10-01 03:55:08',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_applications`
--

DROP TABLE IF EXISTS `leave_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_applications` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` varchar(50) NOT NULL DEFAULT '',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `leave_type` enum('VACATION','SICK','BIRTHDAY') DEFAULT 'VACATION',
  `reason` varchar(100) DEFAULT '',
  `status` enum('PENDING','SUP-APPROVED','MAN-APPROVED','REJECTED') DEFAULT 'PENDING',
  `sup_approved_by` int(11) NOT NULL DEFAULT '0',
  `sup_approved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sup_rejected_by` int(11) NOT NULL DEFAULT '0',
  `sup_rejected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `man_approved_by` int(11) NOT NULL DEFAULT '0',
  `man_approved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `man_rejected_by` int(11) NOT NULL DEFAULT '0',
  `man_rejected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reject_reason` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`leave_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_applications`
--

LOCK TABLES `leave_applications` WRITE;
/*!40000 ALTER TABLE `leave_applications` DISABLE KEYS */;
INSERT INTO `leave_applications` VALUES (1,1,'5','2016-03-09 00:00:00','2016-03-10 00:00:00','SICK','test','PENDING',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',NULL,8,'2016-03-09 09:30:44',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `leave_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_type` (
  `lv_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `lv_code` varchar(50) NOT NULL DEFAULT '',
  `lv_description` varchar(100) NOT NULL DEFAULT '',
  `lv_credits` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lv_id`),
  UNIQUE KEY `lv_type_uk` (`org_id`,`lv_code`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_type`
--

LOCK TABLES `leave_type` WRITE;
/*!40000 ALTER TABLE `leave_type` DISABLE KEYS */;
INSERT INTO `leave_type` VALUES (1,1,'vl','VACATION LEAVE REGULAR','15',1,'2013-03-29 01:32:23',1,'2013-03-29 08:32:23'),(2,1,'ml60','MATERNAL LEAVE','60',1,'2013-04-23 06:58:55',1,'2013-04-23 06:58:55'),(7,1,'TEST SL','SICK LEAVE','5D',1,'2013-06-26 02:58:38',0,'2013-06-26 02:58:38'),(9,1,'BL','BIRTHDAY LEAVE','2',6,'2014-02-04 06:06:07',6,'2014-02-04 06:06:07'),(10,1,'BON','BONUS LEAVE','5',6,'2014-02-04 06:07:44',0,'2014-02-04 06:07:44');
/*!40000 ALTER TABLE `leave_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `location_code` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`location_id`),
  UNIQUE KEY `location_code_uk` (`org_id`,`location_code`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,1,'MANILA','MANILA',1,'2013-06-12 22:43:17',6,'2013-06-12 22:43:17'),(15,1,'DAV','DAVAO',6,'2014-03-25 03:20:58',0,'2014-03-25 03:20:58'),(14,1,'CEBU','CEBU',6,'2014-03-25 03:20:48',0,'2014-03-25 03:20:48'),(13,1,'CDO','CAGAYAN DE ORO',6,'2014-03-25 03:20:31',0,'2014-03-25 03:20:31'),(12,1,'BCD','BACOLOD',6,'2014-03-25 03:20:01',0,'2014-03-25 03:20:01'),(16,1,'DUM','DUMAGETE',6,'2014-03-25 03:21:09',0,'2014-03-25 03:21:09'),(17,1,'GSAN','GENERAL SANTOS',6,'2014-03-25 03:21:31',0,'2014-03-25 03:21:31'),(18,1,'ILO','ILOILO',6,'2014-03-25 03:21:49',0,'2014-03-25 03:21:49'),(19,1,'ORM','ORMOC',6,'2014-03-25 03:21:57',0,'2014-03-25 03:21:57'),(20,1,'PAL','PALAWAN',6,'2014-03-25 03:22:05',0,'2014-03-25 03:22:05'),(21,1,'ZMB','ZAMBOANGA',6,'2014-03-25 03:22:35',0,'2014-03-25 03:22:35');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ob_applications`
--

DROP TABLE IF EXISTS `ob_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ob_applications` (
  `ob_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` varchar(50) NOT NULL DEFAULT '',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `purpose` varchar(100) DEFAULT '',
  `location` text NOT NULL,
  `status` enum('PENDING','SUP-APPROVED','MAN-APPROVED','REJECTED') DEFAULT 'PENDING',
  `sup_approved_by` int(11) NOT NULL DEFAULT '0',
  `sup_approved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sup_rejected_by` int(11) NOT NULL DEFAULT '0',
  `sup_rejected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `man_approved_by` int(11) NOT NULL DEFAULT '0',
  `man_approved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `man_rejected_by` int(11) NOT NULL DEFAULT '0',
  `man_rejected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reject_reason` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ob_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ob_applications`
--

LOCK TABLES `ob_applications` WRITE;
/*!40000 ALTER TABLE `ob_applications` DISABLE KEYS */;
INSERT INTO `ob_applications` VALUES (1,1,'5','2016-03-10 00:00:00','2016-03-11 00:00:00','work remotely','bataan','SUP-APPROVED',10,'2016-03-09 09:13:20',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',NULL,8,'2016-03-09 09:11:15',0,'0000-00-00 00:00:00'),(2,1,'5','2016-03-10 00:00:00','2016-03-10 00:00:00','remote 2','zambales','REJECTED',0,'0000-00-00 00:00:00',10,'2016-03-09 09:14:49',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','double filing',8,'2016-03-09 09:12:11',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ob_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(50) NOT NULL,
  `logo` varchar(40) NOT NULL DEFAULT 'logo.png',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`org_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES (1,'main','logo.png',1,'2015-03-31 16:47:49',0,'0000-00-00 00:00:00'),(2,'org2','logo2.png',1,'2015-03-31 16:48:11',0,'0000-00-00 00:00:00'),(3,'de ocho','logo.png',14,'2015-04-06 03:05:30',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_applications`
--

DROP TABLE IF EXISTS `ot_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_applications` (
  `ot_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `ot_start` datetime DEFAULT NULL,
  `ot_end` datetime DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `total_hours` varchar(100) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `output` varchar(100) DEFAULT NULL,
  `status` enum('PENDING','SUP-APPROVED','MAN-APPROVED','REJECTED') DEFAULT 'PENDING',
  `sup_approved_by` int(11) NOT NULL DEFAULT '0',
  `sup_approved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sup_rejected_by` int(11) NOT NULL DEFAULT '0',
  `sup_rejected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `man_approved_by` int(11) NOT NULL DEFAULT '0',
  `man_approved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `man_rejected_by` int(11) NOT NULL DEFAULT '0',
  `man_rejected_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reject_reason` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_applications`
--

LOCK TABLES `ot_applications` WRITE;
/*!40000 ALTER TABLE `ot_applications` DISABLE KEYS */;
INSERT INTO `ot_applications` VALUES (1,1,'2016-03-09 00:00:00',NULL,5,'5','filing of forms','completed forms','MAN-APPROVED',10,'2016-03-09 09:21:16',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',NULL,8,'2016-03-09 09:15:39',0,'0000-00-00 00:00:00'),(2,1,'2016-03-10 00:00:00',NULL,5,'9','75r7','test','PENDING',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',NULL,8,'2016-03-09 09:34:24',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ot_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policies`
--

DROP TABLE IF EXISTS `policies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies` (
  `policy_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `policy_code` varchar(50) NOT NULL DEFAULT '',
  `policy_description` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`policy_id`),
  UNIQUE KEY `policy_uk` (`org_id`,`policy_code`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policies`
--

LOCK TABLES `policies` WRITE;
/*!40000 ALTER TABLE `policies` DISABLE KEYS */;
INSERT INTO `policies` VALUES (1,1,'policy1','test policy',1,'2013-04-17 11:16:51',0,'2013-04-17 11:16:51'),(2,1,'01','leave policy',1,'2013-05-06 10:13:29',0,'2013-05-06 10:13:29'),(3,1,'POL01','POLICY',1,'2013-06-12 22:41:36',0,'2013-06-12 22:41:36'),(5,1,'TEST POL','TEST POLICY 1',1,'2013-06-26 03:00:22',1,'2013-06-26 03:00:22'),(7,1,'NOPOL','NO POLICY',6,'2014-02-04 06:13:11',0,'2014-02-04 06:13:11');
/*!40000 ALTER TABLE `policies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `position_code` varchar(50) NOT NULL DEFAULT '',
  `position_title` varchar(100) NOT NULL DEFAULT '',
  `position_description` varchar(100) NOT NULL DEFAULT '',
  `job_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (23,1,'POS-1837462058','BOOKING OFFICER','BOOKING OFFICER',19,47,6,'2014-03-25 03:18:41',0,'2015-03-23 02:19:03'),(22,1,'POS-2898207206','BOOK KEEPER','BOOK KEEPER',18,47,6,'2014-03-25 03:17:56',0,'2015-03-23 02:19:03'),(21,1,'POS-4289597147','ACCOUNTING SUPERVISOR','ACCOUNTING SUPERVISOR',25,40,6,'2014-03-25 03:16:38',0,'2015-03-23 02:19:03'),(20,1,'POS-1459920097','ACCOUNTING STAFF','ACCOUNTING STAFF',19,40,6,'2014-03-25 03:12:47',0,'2015-03-23 02:19:03'),(24,1,'POS-1245957268','ASSISTANT MECHANIC','ASSISTANT MECHANIC',18,28,6,'2014-03-25 03:25:55',0,'2015-03-23 02:19:03'),(25,1,'POS-3505066502','DRIVER','DRIVER ',17,38,6,'2014-03-25 03:26:43',0,'2015-03-23 02:19:03'),(26,1,'POS-3557685194','DRIVER/HELPER','DRIVER/HELPER',17,38,6,'2014-03-25 03:27:15',0,'2015-03-23 02:19:03'),(27,1,'POS-2537415391','IT SUPPORT','IT SUPPORT',20,33,6,'2014-03-25 03:28:01',0,'2015-03-23 02:19:03'),(28,1,'POS-4995275015','IT MANAGER','IT MANAGER',22,33,6,'2014-03-25 03:28:24',0,'2015-03-23 02:19:03'),(29,1,'POS-3313853496','LOGISTICS MANAGER','LOGISTICS MANAGER',26,36,6,'2014-03-25 03:29:21',0,'2015-03-23 02:19:03'),(30,1,'HR STAFF1','HR STAFF COMBEN','HR STAFF COMBEN',32,53,1,'2015-10-01 03:56:42',1,'2015-10-01 03:58:45');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranks` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `rank_code` varchar(50) NOT NULL DEFAULT '',
  `rank_short_description` varchar(100) DEFAULT NULL,
  `job_description` varchar(100) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rank_id`),
  UNIQUE KEY `rank_uk` (`org_id`,`rank_code`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranks`
--

LOCK TABLES `ranks` WRITE;
/*!40000 ALTER TABLE `ranks` DISABLE KEYS */;
INSERT INTO `ranks` VALUES (19,1,'RF2SS',NULL,'RF2 - SEMI SKILLED',6,'2014-03-25 03:07:16',0,'2014-03-25 03:07:16'),(18,1,'RF1U',NULL,'RF1 - UNSKILLED',6,'2014-03-25 03:06:39',0,'2014-03-25 03:06:39'),(17,1,'DRV',NULL,'DRIVERS',6,'2014-03-25 03:06:20',0,'2014-03-25 03:06:20'),(20,1,'RF2ST',NULL,'RF2 - SKILLED TECHNICAL',6,'2014-03-25 03:07:33',0,'2014-03-25 03:07:33'),(21,1,'TLO',NULL,'TEAM LEAD - OPERATIONS',6,'2014-03-25 03:07:50',0,'2014-03-25 03:07:50'),(22,1,'TLT',NULL,'TEAM LEAD - TECHNICAL',6,'2014-03-25 03:08:05',0,'2014-03-25 03:08:05'),(23,1,'SUPNT',NULL,'SUPERVISOR - NON TECHNICAL',6,'2014-03-25 03:08:29',0,'2014-03-25 03:08:29'),(24,1,'SUPB',NULL,'SUPERVISOR - BRANCH',6,'2014-03-25 03:08:43',0,'2014-03-25 03:08:43'),(25,1,'SUPT',NULL,'SUPERVISOR - TECHNICAL',6,'2014-03-25 03:09:13',0,'2014-03-25 03:09:13'),(26,1,'JMNT',NULL,'JUNIOR MANAGER - NON TECHNICAL',6,'2014-03-25 03:09:30',0,'2014-03-25 03:09:30'),(27,1,'JMT',NULL,'JUNIOR MANAGER - TECHNICAL',6,'2014-03-25 03:09:44',0,'2014-03-25 03:09:44'),(28,1,'SMNT',NULL,'SENIOR MANAGER - NON TECHNICAL',6,'2014-03-25 03:10:14',0,'2014-03-25 03:10:14'),(29,1,'SMB',NULL,'SENIOR MANAGER - BRANCH',6,'2014-03-25 03:10:27',0,'2014-03-25 03:10:27'),(30,1,'SMT',NULL,'SENIOR MANAGER - TECHNICAL',6,'2014-03-25 03:10:37',0,'2014-03-25 03:10:37'),(31,1,'EVP',NULL,'EXECUTIVE - VICE PRESIDENT',6,'2014-03-25 03:11:06',0,'2014-03-25 03:11:06');
/*!40000 ALTER TABLE `ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_grade`
--

DROP TABLE IF EXISTS `salary_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salary_grade` (
  `sal_grd_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `gr_lvl` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `classification` varchar(50) DEFAULT NULL,
  `minimum` int(11) DEFAULT NULL,
  `median` int(11) DEFAULT NULL,
  `maximum` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sal_grd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_grade`
--

LOCK TABLES `salary_grade` WRITE;
/*!40000 ALTER TABLE `salary_grade` DISABLE KEYS */;
INSERT INTO `salary_grade` VALUES (1,1,2,18,'Unskilled',1,3,6,0,'0000-00-00 00:00:00',1,'2015-10-23 08:45:02'),(2,1,2,18,'Unskilled',1,3,6,0,'0000-00-00 00:00:00',1,'2015-10-23 08:45:03'),(3,1,3,19,'Semi-Skilled',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(4,1,3,19,'Skilled-Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(5,1,4,21,'Operations',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(6,1,4,21,'Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(7,1,5,23,'Non-technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(8,1,5,23,'Branches',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(9,1,5,23,'Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(10,1,6,26,'Non-Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(11,1,6,26,'Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(12,1,7,30,'Non-Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(13,1,7,30,'Branches',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(14,1,7,30,'Technical',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47'),(15,1,7,31,'VP and up',NULL,NULL,NULL,0,'0000-00-00 00:00:00',0,'2015-03-21 07:03:47');
/*!40000 ALTER TABLE `salary_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) DEFAULT NULL,
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `level` enum('EMPLOYEES','SUPERVISORS','HR MANAGERS','SYS ADMINS') DEFAULT 'EMPLOYEES',
  `status_flag` tinyint(1) NOT NULL DEFAULT '1',
  `session_id` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `dt_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_uk` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,1,'admin','hrjt/QAMcR89k','yuri.santos@gmail.com','HR MANAGERS',1,'pjlqb004fmfbjve5mq36kcuv26',0,'2013-05-26 10:27:48',0,'2013-05-26 06:27:48'),(6,1,6,'MIK','hrUUqAqKYwR2k','yurei15@yahoo.com','HR MANAGERS',1,'30d7b36d1d981d75d2fd2b2c88f70f2b',1,'2014-01-15 00:02:24',1,'2014-01-15 08:02:24'),(8,1,5,'emp','hrjt/QAMcR89k','yuri.santos@gmail.com','EMPLOYEES',1,'bd5ju0ufmqblmmj92pqc6ufll2',7,'2014-01-15 00:15:00',1,'2015-10-23 08:48:54'),(9,1,7,'EMPLOYEE1','hrMUMndTBsXdc','EMPLOYEE1@YAHOO.COM','EMPLOYEES',1,'19a1f338d24144df6eed4121f554e50e',6,'2014-02-04 22:00:15',0,'2014-02-05 06:00:15'),(10,1,8,'sup','hrjt/QAMcR89k','SUPERVISOR1','SUPERVISORS',1,'ehur332sgrncquug26t09lu590',6,'2014-02-04 22:26:32',0,'2014-02-05 06:26:32'),(11,1,9,'SUPERVISOR2','hrfOTNVWn08D.','SUPERVISOR2@YAHOO.COM','SUPERVISORS',1,'1908ea35e70d711e5dc7f7d959c83f65',6,'2014-03-04 01:36:01',1,'2014-03-04 09:36:01'),(12,1,11,'EMPSMD','hriwBDq4/FLQ6','EMPSMD@YAHOO.COM','EMPLOYEES',1,'b6ee99ef0345ee5fcb5b752216cef299',6,'2014-03-06 01:21:31',1,'2015-03-26 19:44:57'),(13,2,1,'admin2','hrjt/QAMcR89k','yuri.santos@gmail.com','HR MANAGERS',1,'lb0lfhmr0i9i1okpkg84aka542',0,'2013-05-26 10:27:48',0,'2013-05-26 06:27:48'),(14,1,1,'super','hrjt/QAMcR89k','yuri.santos@gmail.com','SYS ADMINS',1,'i6b1lpi9tltbocpe5fdlj2ddd2',1,'2015-04-06 08:36:42',0,'0000-00-00 00:00:00'),(15,1,12,'super2','hrjt/QAMcR89k',NULL,'SYS ADMINS',1,NULL,14,'2015-04-06 10:52:49',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-09 18:07:03
