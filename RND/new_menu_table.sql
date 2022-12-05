/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.0.45-community-nt : Database - textile
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`textile` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `textile`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL auto_increment,
  `menu_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL default '0' COMMENT '0 if menu is root level or menuid if this is child on any menu',
  `link` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL default '1' COMMENT '0 for disabled menu or 1 for enabled menu',
  `user_role` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

LOCK TABLES `menu` WRITE;

insert  into `menu`(`menu_id`,`menu_name`,`parent_id`,`link`,`status`,`user_role`) values (1,'Home',0,'#home','0',''),(2,'Web development',0,'#web-dev','0',''),(3,'WordPress Development',0,'#wp-dev','0',''),(4,'About w3school.info',0,'#w3school-info','0',''),(5,'AWS ADMIN',2,'#','0',''),(6,'PHP',2,'#','0',''),(7,'Javascript',2,'#','0',''),(8,'Elastic Ip',5,'#electic-ip','0',''),(9,'Load balacing',5,'#load-balancing','0',''),(10,'Cluster Indexes',5,'#cluster-indexes','0',''),(11,'Rds Db setup',5,'#rds-db','0',''),(12,'Framework Development',6,'#','0',''),(13,'Ecommerce Development',6,'#','0',''),(14,'Cms Development',6,'#','0',''),(21,'News & Media',6,'#','0',''),(22,'Codeigniter',12,'#codeigniter','0',''),(23,'Cake',12,'#cake-dev','0',''),(24,'Opencart',13,'#opencart','0',''),(25,'Magento',13,'#magento','0',''),(26,'Wordpress',14,'#wordpress-dev','0',''),(27,'Joomla',14,'#joomla-dev','0',''),(28,'Drupal',14,'#drupal-dev','0',''),(29,'Ajax',7,'#ajax-dev','0',''),(30,'Jquery',7,'#jquery-dev','0',''),(31,'Themes',3,'#theme-dev','0',''),(32,'Plugins',3,'#plugin-dev','0',''),(33,'Custom Post Types',3,'#','0',''),(34,'Options',3,'#wp-options','0',''),(35,'Testimonials',33,'#testimonial-dev','0',''),(36,'Portfolios',33,'#portfolio-dev','0',''),(37,'Home',0,'#','1','Admin'),(38,'Master',0,'#','1','Admin'),(39,'Transaction',0,'#','1','Admin'),(40,'Reports',0,'#','1','Admin'),(41,'Group Master',38,'#','1','Admin'),(42,'Company Master',38,'#','1','Admin'),(43,'User Master',38,'#','1','Admin'),(44,'Bill Entry',39,'#','1','Admin'),(45,'Payment Entry',39,'#','1','Admin'),(46,'Buyers Outstanding',40,'#','1','Admin'),(47,'Supplier Outstanding',40,'#','1','Admin'),(48,'Buyer Outstanding Search',46,'#','1','Admin'),(49,'Supplier Outstanding Search',47,'#','1','Admin'),(50,'Master Reports',0,'#','1','Admin'),(51,'Commission Summary',50,'#','1','Admin'),(52,'Commission Detail Report',50,'#','1','Admin'),(53,'Buyer Outstanding All',46,'#','1','Admin'),(54,'Suppliler Outstanding All',47,'#','1','Admin');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
