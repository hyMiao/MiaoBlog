-- MySQL dump 10.13  Distrib 5.5.29, for Win64 (x86)
--
-- Host: localhost    Database: miaoblogtest
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `blog_article`
--

DROP TABLE IF EXISTS `blog_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_article` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `summary` text,
  `categoryid` int(8) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `content` longtext NOT NULL,
  `password` varchar(80) DEFAULT NULL,
  `visibility` int(2) DEFAULT NULL,
  `comment_count` int(8) DEFAULT '0',
  `read_count` int(8) DEFAULT '0',
  `useful_count` int(8) DEFAULT '0',
  `submit_time` datetime NOT NULL,
  `last_update_time` datetime NOT NULL,
  `date_category` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`articleid`),
  KEY `FK_article_category` (`categoryid`),
  CONSTRAINT `FK_article_category` FOREIGN KEY (`categoryid`) REFERENCES `blog_category` (`categoryid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_article`
--

LOCK TABLES `blog_article` WRITE;
/*!40000 ALTER TABLE `blog_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_attachment`
--

DROP TABLE IF EXISTS `blog_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_attachment` (
  `attachmentid` int(11) NOT NULL AUTO_INCREMENT,
  `articleid` int(11) DEFAULT NULL,
  `name` varchar(90) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `submit_time` datetime NOT NULL,
  `description` text,
  PRIMARY KEY (`attachmentid`),
  KEY `FK_attachment_article` (`articleid`),
  CONSTRAINT `FK_attachment_article` FOREIGN KEY (`articleid`) REFERENCES `blog_article` (`articleid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_attachment`
--

LOCK TABLES `blog_attachment` WRITE;
/*!40000 ALTER TABLE `blog_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_category` (
  `categoryid` int(8) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(90) NOT NULL,
  `comment` text,
  `article_count` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`),
  UNIQUE KEY `UK_categoryname` (`categoryname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category`
--

LOCK TABLES `blog_category` WRITE;
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
INSERT INTO `blog_category` VALUES (1,'未分类',NULL,0);
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `articleid` int(11) NOT NULL,
  `relyid` int(11) DEFAULT NULL,
  `commenttype` int(1) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `submit_time` datetime NOT NULL,
  `nickname` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`commentid`),
  KEY `FK_comment_article` (`articleid`),
  KEY `FK_comment_comment` (`relyid`),
  CONSTRAINT `FK_comment_article` FOREIGN KEY (`articleid`) REFERENCES `blog_article` (`articleid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_comment` FOREIGN KEY (`relyid`) REFERENCES `blog_comment` (`commentid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comment`
--

LOCK TABLES `blog_comment` WRITE;
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_log`
--

DROP TABLE IF EXISTS `blog_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_log`
--

LOCK TABLES `blog_log` WRITE;
/*!40000 ALTER TABLE `blog_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_siteinfo`
--

DROP TABLE IF EXISTS `blog_siteinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_siteinfo` (
  `blogid` int(11) NOT NULL AUTO_INCREMENT,
  `blogtitle` varchar(120) NOT NULL DEFAULT 'En!MiaoBlog~!',
  `blogsubtitle` varchar(255) DEFAULT NULL,
  `blogdescription` text,
  `blogurl` varchar(255) DEFAULT NULL,
  `userdescription` text,
  `blogaccess_count` int(11) DEFAULT '0',
  PRIMARY KEY (`blogid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_siteinfo`
--

LOCK TABLES `blog_siteinfo` WRITE;
/*!40000 ALTER TABLE `blog_siteinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_siteinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_user`
--

DROP TABLE IF EXISTS `blog_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `nickname` varchar(60) NOT NULL,
  `pwd` varchar(80) NOT NULL,
  `sign_time` datetime NOT NULL,
  `last_access_time` datetime DEFAULT NULL,
  `last_access_ip` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_user`
--

LOCK TABLES `blog_user` WRITE;
/*!40000 ALTER TABLE `blog_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-02 23:02:28
