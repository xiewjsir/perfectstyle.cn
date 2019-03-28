/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 8.0.15 : Database - perfectstyle
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perfectstyle` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `perfectstyle`;

/*Table structure for table `admin_node` */

DROP TABLE IF EXISTS `admin_node`;

CREATE TABLE `admin_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menu' COMMENT '类型 menu 菜单,function 功能',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `method` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'ANY',
  `uri` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '层级 从0开始',
  `path` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '路径 包含自身ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_node` */

insert  into `admin_node`(`id`,`type`,`parent_id`,`sort`,`name`,`icon`,`method`,`uri`,`level`,`path`,`created_at`,`updated_at`) values (1,'menu',0,1,'导航','-','ANY','#',0,'-1-','2018-12-27 07:17:19','2018-12-27 07:18:02'),(2,'menu',0,2,'组件','-','ANY','#',0,'-2-','2018-12-27 07:17:19','2018-12-27 07:17:54'),(3,'menu',0,3,'其它','-','ANY','#',0,'-3-','2018-12-27 07:17:19','2018-12-27 07:17:44'),(4,'menu',2,1,'权限管理','demo-psi-happy','ANY','#',1,'-2-4-','2018-12-27 07:17:19','2018-12-27 09:47:36'),(5,'menu',4,1,'管理员','-','GET,HEAD','adminUser.index',2,'-2-4-5-','2018-12-27 07:17:19','2018-12-28 06:14:16'),(6,'menu',4,0,'节点','-','GET,HEAD','adminNode.index',2,'-2-4-6-','2018-12-27 07:17:19','2018-12-28 06:13:09'),(7,'menu',2,0,'文章管理','demo-psi-pen-5','ANY','#',1,'-2-7-','2018-12-27 07:21:20','2018-12-27 07:47:12'),(8,'menu',7,0,'文章','-','GET,HEAD','post.index',2,'-2-7-8-','2018-12-27 07:47:01','2018-12-28 06:13:26'),(9,'menu',2,0,'多媒体','demo-psi-receipt-4','ANY','#',1,'-2-9-','2018-12-27 07:47:48','2018-12-27 07:49:05'),(10,'menu',9,0,'图片','-','GET,HEAD','file.index',2,'-2-9-10-','2018-12-27 07:48:25','2018-12-28 06:13:42'),(11,'menu',1,0,'仪表盘','demo-psi-home','ANY','admin.index',1,'-1-11-','2018-12-27 08:16:46','2018-12-27 08:16:46'),(12,'menu',3,0,'邮件','demo-psi-mail','ANY','#',1,'-3-12-','2018-12-27 08:17:26','2018-12-27 08:17:26'),(13,'function',5,0,'新增管理员','-','POST','adminUser.create',3,'-2-4-5-13-','2018-12-27 09:44:58','2018-12-28 05:01:25'),(14,'menu',4,0,'角色','-','GET,HEAD','adminRole.index',2,'-2-4-14-','2018-12-27 10:43:29','2018-12-28 06:15:57'),(19,'function',4,0,'权限','-','GET,HEAD','adminPermission.index',2,'-2-4-19-','2018-12-28 07:35:28','2018-12-28 07:35:28');

/*Table structure for table `admin_role` */

DROP TABLE IF EXISTS `admin_role`;

CREATE TABLE `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '英文名称',
  `name_cn` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中文名称',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name_en`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_role` */

insert  into `admin_role`(`id`,`name_en`,`name_cn`,`description`,`created_at`,`updated_at`) values (1,'admin','超级管理员','a superman','2018-12-24 05:56:21','2018-12-28 09:08:35'),(2,'user','普通管理员','normal','2018-12-24 05:56:21','2018-12-28 09:19:12'),(3,'finance','财务专员','cc','2018-12-28 09:18:55','2018-12-28 09:18:55');

/*Table structure for table `admin_role_node_pivot` */

DROP TABLE IF EXISTS `admin_role_node_pivot`;

CREATE TABLE `admin_role_node_pivot` (
  `role_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`node_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_role_node_pivot` */

insert  into `admin_role_node_pivot`(`role_id`,`node_id`) values (1,1),(1,2),(1,3),(1,4),(1,5),(2,1),(2,3);

/*Table structure for table `admin_user` */

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `file_id` int(10) DEFAULT NULL COMMENT '头像文件ID',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_user` */

insert  into `admin_user`(`id`,`username`,`password`,`name`,`email`,`file_id`,`avatar`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','$2y$10$YCpf/88xERAIxGN7CI6Tt.tFk7PItjg.ACsNWPiYARNhWhp2yaER.','Administrator','183778766@qq.com',102,'/avatars/5c24ac85609c4.jpg','qK0c0nDhpMpkkuSvsu4sEGoBjo1AOoLshYAh8LYIY0Bk3Ur6eZPpwngcH0FO','2018-11-01 07:26:27','2018-12-27 10:42:15'),(2,'wayne','$2y$10$ZfJU7rdgdfGGTC.HiEz/yOykF/PWbH2QlMdMxM/LnpDzEHh7Qhmu.','大鱼','perfectlystyle@gmail.com',101,'/avatars/5c21e857c6c8b.jpg',NULL,'2018-12-25 06:17:17','2018-12-27 10:39:50');

/*Table structure for table `admin_user_role_pivot` */

DROP TABLE IF EXISTS `admin_user_role_pivot`;

CREATE TABLE `admin_user_role_pivot` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admin_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_user_role_pivot` */

insert  into `admin_user_role_pivot`(`user_id`,`role_id`) values (1,1),(1,2),(2,2);

/*Table structure for table `column` */

DROP TABLE IF EXISTS `column`;

CREATE TABLE `column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级',
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `slug` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '盐',
  `status` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish' COMMENT '发布状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `column` */

insert  into `column`(`id`,`parent_id`,`name`,`slug`,`status`,`created_at`,`updated_at`) values (1,0,'好好学习','learn','publish','2018-12-18 17:38:24','2018-12-18 17:38:28'),(2,0,'好好生活','life','publish','2018-12-18 18:23:49','2018-12-18 18:23:52');

/*Table structure for table `file` */

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片标题',
  `type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `path` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `file` */

insert  into `file`(`id`,`title`,`type`,`path`,`created_at`,`updated_at`) values (1,'timg','jpg','/images/201812/00000000005c1b544a1ef31.jpg','2018-12-20 08:35:22','2018-12-20 08:35:22'),(2,'timg (2)','jpg','/images/201812/00000000005c1b577f39b9d.jpg','2018-12-20 08:49:03','2018-12-20 08:49:03'),(3,'timg (2)','jpg','/images/201812/00000000005c1b5dd23274c.jpg','2018-12-20 09:16:02','2018-12-20 09:16:02'),(4,'timg (2)','jpg','/images/201812/00000000005c1b5efdd5942.jpg','2018-12-20 09:21:01','2018-12-20 09:21:01'),(5,'timg (2)','jpg','/images/201812/00000000005c1b5fda1f9f6.jpg','2018-12-20 09:24:42','2018-12-20 09:24:42'),(6,'timg (2)','jpg','/images/201812/00000000005c1b60954b709.jpg','2018-12-20 09:27:49','2018-12-20 09:27:49'),(7,'timg (2)','jpg','/images/201812/00000000005c1b60f884a84.jpg','2018-12-20 09:29:28','2018-12-20 09:29:28'),(8,'timg (2)','jpg','/images/201812/00000000005c1b62869fb39.jpg','2018-12-20 09:36:06','2018-12-20 09:36:06'),(9,'timg (2)','jpg','/images/201812/00000000005c1b62e336f20.jpg','2018-12-20 09:37:39','2018-12-20 09:37:39'),(10,'timg (2)','jpg','/images/201812/00000000005c1b63b8a9d64.jpg','2018-12-20 09:41:12','2018-12-20 09:41:12'),(11,'timg','jpg','/images/201812/00000000005c1b644dd2aa9.jpg','2018-12-20 09:43:41','2018-12-20 09:43:41'),(12,'timg','jpg','/images/201812/00000000005c1b6471ce823.jpg','2018-12-20 09:44:17','2018-12-20 09:44:17'),(13,'timg (2)','jpg','/images/201812/00000000005c1b64c395f17.jpg','2018-12-20 09:45:39','2018-12-20 09:45:39'),(14,'timg','jpg','/images/201812/00000000005c1b64cf15eda.jpg','2018-12-20 09:45:51','2018-12-20 09:45:51'),(15,'timg','jpg','/images/201812/00000000005c1b6503b4379.jpg','2018-12-20 09:46:43','2018-12-20 09:46:43'),(16,'timg (2)','jpg','/images/201812/00000000005c1b65f439aa0.jpg','2018-12-20 09:50:44','2018-12-20 09:50:44'),(17,'timg (2)','jpg','/images/201812/00000000005c1b65fdaa095.jpg','2018-12-20 09:50:53','2018-12-20 09:50:53'),(18,'timg (2)','jpg','/images/201812/00000000005c1b664bbf676.jpg','2018-12-20 09:52:11','2018-12-20 09:52:11'),(19,'timg (2)','jpg','/images/201812/00000000005c1b66cc996d5.jpg','2018-12-20 09:54:20','2018-12-20 09:54:20'),(20,'timg (2)','jpg','/images/201812/00000000005c1b67445faa6.jpg','2018-12-20 09:56:20','2018-12-20 09:56:20'),(21,'timg (2)','jpg','/images/201812/00000000005c1b698f87e2a.jpg','2018-12-20 10:06:07','2018-12-20 10:06:07'),(22,'timg (2)','jpg','/images/201812/00000000005c1b6faa4d098.jpg','2018-12-20 10:32:10','2018-12-20 10:32:10'),(23,'timg (2)','jpg','/images/201812/00000000005c1c52a4a77c9.jpg','2018-12-21 02:40:36','2018-12-21 02:40:36'),(24,'timg (2)','jpg','/images/201812/00000000005c1c52fb2abc4.jpg','2018-12-21 02:42:03','2018-12-21 02:42:03'),(25,'timg (1)','jpg','/images/201812/00000000005c1c5a66c3d50.jpg','2018-12-21 03:13:42','2018-12-21 03:13:42'),(26,'timg (2)','jpg','/images/201812/00000000005c1c5ab04c7b7.jpg','2018-12-21 03:14:56','2018-12-21 03:14:56'),(27,'timg (2)','jpg','/images/201812/00000000005c1c5b041670f.jpg','2018-12-21 03:16:20','2018-12-21 03:16:20'),(28,'timg (1)','jpg','/images/201812/00000000005c1c5b643694f.jpg','2018-12-21 03:17:56','2018-12-21 03:17:56'),(29,'timg (1)','jpg','/images/201812/00000000005c1c5c359e650.jpg','2018-12-21 03:21:25','2018-12-21 03:21:25'),(30,'timg (2)','jpg','/images/201812/00000000005c1c5c59ec1ed.jpg','2018-12-21 03:22:01','2018-12-21 03:22:01'),(31,'timg (2)','jpg','/images/201812/00000000005c1c5eaacbbb7.jpg','2018-12-21 03:31:54','2018-12-21 03:31:54'),(32,'timg (2)','jpg','/images/201812/00000000005c1c5ec4c7812.jpg','2018-12-21 03:32:20','2018-12-21 03:32:20'),(33,'timg (2)','jpg','/images/201812/00000000005c1c613604b5e.jpg','2018-12-21 03:42:46','2018-12-21 03:42:46'),(34,'timg (2)','jpg','/images/201812/00000000005c1c616a4a419.jpg','2018-12-21 03:43:38','2018-12-21 03:43:38'),(35,'timg (2)','jpg','/images/201812/00000000005c1c629982f44.jpg','2018-12-21 03:48:41','2018-12-21 03:48:41'),(36,'timg (1)','jpg','/images/201812/00000000005c1c63ba40124.jpg','2018-12-21 03:53:30','2018-12-21 03:53:30'),(37,'timg (2)','jpg','/images/201812/00000000005c1c642d53986.jpg','2018-12-21 03:55:25','2018-12-21 03:55:25'),(38,'timg','jpg','/images/201812/00000000005c1c64315ea6a.jpg','2018-12-21 03:55:29','2018-12-21 03:55:29'),(39,'timg','jpg','/images/201812/00000000005c1c64797c57d.jpg','2018-12-21 03:56:41','2018-12-21 03:56:41'),(40,'timg (2)','jpg','/images/201812/00000000005c1c64797c60a.jpg','2018-12-21 03:56:41','2018-12-21 03:56:41'),(41,'timg (2)','jpg','/images/201812/00000000005c1c648ca8547.jpg','2018-12-21 03:57:00','2018-12-21 03:57:00'),(42,'timg','jpg','/images/201812/00000000005c1c64924e356.jpg','2018-12-21 03:57:06','2018-12-21 03:57:06'),(43,'timg (2)','jpg','/images/201812/00000000005c1c81028ec3e.jpg','2018-12-21 05:58:26','2018-12-21 05:58:26'),(44,'timg','jpg','/images/201812/00000000005c1c81098727c.jpg','2018-12-21 05:58:33','2018-12-21 05:58:33'),(45,'timg (2)','jpg','/images/201812/00000000005c1c81656ff4c.jpg','2018-12-21 06:00:05','2018-12-21 06:00:05'),(46,'timg','jpg','/images/201812/00000000005c1c81757050f.jpg','2018-12-21 06:00:21','2018-12-21 06:00:21'),(47,'timg','jpg','/images/201812/00000000005c1c819f315d4.jpg','2018-12-21 06:01:03','2018-12-21 06:01:03'),(48,'u=373375732,3730067111&fm=200&gp=0','jpg','/images/201812/00000000005c1c81b1f13f6.jpg','2018-12-21 06:01:22','2018-12-21 06:01:22'),(49,'timg','jpg','/images/201812/00000000005c1c81d7e0463.jpg','2018-12-21 06:01:59','2018-12-21 06:01:59'),(50,'timg (2)','jpg','/images/201812/00000000005c1c81de04066.jpg','2018-12-21 06:02:06','2018-12-21 06:02:06'),(51,'timg','jpg','/images/201812/00000000005c1c823df02e6.jpg','2018-12-21 06:03:42','2018-12-21 06:03:42'),(52,'timg','jpg','/images/201812/00000000005c1c82521c386.jpg','2018-12-21 06:04:02','2018-12-21 06:04:02'),(53,'timg (1)','jpg','/images/201812/00000000005c1c8256aa9fa.jpg','2018-12-21 06:04:06','2018-12-21 06:04:06'),(54,'timg','jpg','/images/201812/00000000005c1c82776da6b.jpg','2018-12-21 06:04:39','2018-12-21 06:04:39'),(55,'timg (1)','jpg','/images/201812/00000000005c1c827ce26f6.jpg','2018-12-21 06:04:44','2018-12-21 06:04:44'),(56,'timg (2)','jpg','/images/201812/00000000005c1c845f882d6.jpg','2018-12-21 06:12:47','2018-12-21 06:12:47'),(57,'timg','jpg','/images/201812/00000000005c1c845f8836e.jpg','2018-12-21 06:12:47','2018-12-21 06:12:47'),(58,'timg (2)','jpg','/images/201812/00000000005c1c849144f14.jpg','2018-12-21 06:13:37','2018-12-21 06:13:37'),(59,'timg','jpg','/images/201812/00000000005c1c849144e7d.jpg','2018-12-21 06:13:37','2018-12-21 06:13:37'),(60,'timg','jpg','/images/201812/00000000005c1c858b2f366.jpg','2018-12-21 06:17:47','2018-12-21 06:17:47'),(61,'timg (2)','jpg','/images/201812/00000000005c1c858b2f403.jpg','2018-12-21 06:17:47','2018-12-21 06:17:47'),(62,'timg (2)','jpg','/images/201812/00000000005c1c891b78d56.jpg','2018-12-21 06:32:59','2018-12-21 06:32:59'),(63,'timg (1)','jpg','/images/201812/00000000005c1c8cf0e3961.jpg','2018-12-21 06:49:20','2018-12-21 06:49:20'),(64,'timg (1)','jpg','/images/201812/00000000005c1cb0d54b052.jpg','2018-12-21 09:22:29','2018-12-21 09:22:29'),(65,'timg','jpg','/images/201812/00000000005c1cb0df9b84b.jpg','2018-12-21 09:22:39','2018-12-21 09:22:39'),(66,'timg (1)','jpg','/images/201812/00000000005c1cbfaddec4a.jpg','2018-12-21 10:25:49','2018-12-21 10:25:49'),(67,'timg (2)','jpg','/images/201812/00000000005c1cc1690de90.jpg','2018-12-21 10:33:13','2018-12-21 10:33:13'),(68,'timg (2)','jpg','/images/201812/00000000005c1cc28897213.jpg','2018-12-21 10:38:00','2018-12-21 10:38:00'),(69,'timg (1)','jpg','/images/201812/00000000005c1cc28897419.jpg','2018-12-21 10:38:00','2018-12-21 10:38:00'),(70,'timg','jpg','/images/201812/00000000005c1cc288b8173.jpg','2018-12-21 10:38:00','2018-12-21 10:38:00'),(71,'timg (2)','jpg','/images/201812/00000000005c1cc29bd541e.jpg','2018-12-21 10:38:19','2018-12-21 10:38:19'),(72,'img','jpg','/images/201812/00000000005c1cc30166e66.jpg','2018-12-21 10:40:01','2018-12-21 10:40:01'),(73,'timg (1)','jpg','/avatars/00000000005c21988d8c9ed.jpg','2018-12-25 02:40:13','2018-12-25 02:40:13'),(74,'timg (1)','jpg','/avatars/00000000005c21994389292.jpg','2018-12-25 02:43:15','2018-12-25 02:43:15'),(75,'timg (1)','jpg','/avatars/00000000005c219a24704e6.jpg','2018-12-25 02:47:00','2018-12-25 02:47:00'),(76,'timg (1)','jpg','/avatars/00000000005c219a87a43a8.jpg','2018-12-25 02:48:39','2018-12-25 02:48:39'),(77,'timg (1)','avatar','/avatars/0000000000jpg','2018-12-25 02:51:45','2018-12-25 02:51:45'),(78,'timg (1)','avatar','/avatars/0000000000.jpg','2018-12-25 02:52:18','2018-12-25 02:52:18'),(79,'timg (1)','avatar','/avatars/0000000000.jpg','2018-12-25 02:56:25','2018-12-25 02:56:25'),(85,'timg (1)','avatar','/avatars/5c21a0db09aa3.jpg','2018-12-25 03:15:39','2018-12-25 03:15:39'),(86,'timg (1)','avatar','/avatars/5c21a11ed53f4.jpg','2018-12-25 03:16:46','2018-12-25 03:16:46'),(88,'timg (1)','avatar','/avatars/5c21a12c23014.jpg','2018-12-25 03:17:00','2018-12-25 03:17:00'),(89,'timg (2)','avatar','/avatars/5c21a12c477c2.jpg','2018-12-25 03:17:00','2018-12-25 03:17:00'),(90,'timg','avatar','/avatars/5c21a12c5388f.jpg','2018-12-25 03:17:00','2018-12-25 03:17:00'),(92,'timg (2)','avatar','/avatars/5c21aa9fb606d.jpg','2018-12-25 03:57:19','2018-12-25 03:57:19'),(93,'timg (2)','avatar','/avatars/5c21ab0151ef6.jpg','2018-12-25 03:58:57','2018-12-25 03:58:57'),(98,'timg (1)','avatar','/avatars/5c21c85d9ac6e.jpg','2018-12-25 06:04:13','2018-12-25 06:04:13'),(99,'timg (1)','avatar','/avatars/5c21c9c1716c4.jpg','2018-12-25 06:10:09','2018-12-25 06:10:09'),(101,'timg (2)','avatar','/avatars/5c21e857c6c8b.jpg','2018-12-25 08:20:39','2018-12-25 08:20:39'),(102,'timg','avatar','/avatars/5c24ac85609c4.jpg','2018-12-27 10:42:13','2018-12-27 10:42:13');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_11_28_033038_create_admin_users_table',1),(4,'2018_12_17_103254_entrust_setup_tables',2),(5,'2018_12_18_065539_create_posts_table',3),(6,'2018_12_18_080724_create_tags_table',3),(7,'2018_12_18_081637_create_post_tag_pivots_table',3),(8,'2018_12_18_081731_create_columns_table',3),(9,'2018_12_20_074350_create_files_table',4),(13,'2018_12_21_024956_create_post_file_pivots',6),(14,'2018_12_25_093045_create_admin_menu_table',7);

/*Table structure for table `password_reset` */

DROP TABLE IF EXISTS `password_reset`;

CREATE TABLE `password_reset` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset` */

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `author` int(10) unsigned NOT NULL COMMENT '作者',
  `column_id` smallint(5) unsigned NOT NULL COMMENT '栏目',
  `summary` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '摘要',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `post_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT '发布状态',
  `comment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open' COMMENT '评论状态',
  `post_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '查看密码',
  `views` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_column_id_index` (`column_id`),
  KEY `posts_title_index` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `post` */

insert  into `post`(`id`,`title`,`author`,`column_id`,`summary`,`content`,`post_status`,`comment_status`,`post_password`,`views`,`sort`,`created_at`,`updated_at`) values (1,'设计模式UML类图详解',1,1,'设计模式UML类图详解','Emphasis, aka italics, with *asterisks* or _underscores_.\r\n					\r\nStrong emphasis, aka bold, with **asterisks** or __underscores__.\r\n					\r\nCombined emphasis with **asterisks and _underscores_**.\r\n					\r\nStrikethrough uses two tildes. ~~Scratch this.~~\r\n\r\n\r\n* Unordered list can use asterisks\r\n- Or minuses\r\n+ Or pluses','publish','open','',0,1,'2018-12-19 04:51:42','2018-12-21 08:56:02'),(2,'Redis的缓存策略和主键失效机制',1,1,'Redis的缓存策略和主键失效机制','Redis的缓存策略和主键失效机制','publish','open','',0,2,'2018-12-19 04:53:02','2018-12-21 09:48:41'),(3,'cc',1,1,'cc','cc','publish','open','',0,3,'2018-12-19 04:53:37','2018-12-19 04:53:37');

/*Table structure for table `post_file_pivot` */

DROP TABLE IF EXISTS `post_file_pivot`;

CREATE TABLE `post_file_pivot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL COMMENT '文章ID',
  `file_id` int(10) unsigned NOT NULL COMMENT '文件ID',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '文件ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_post_file` (`post_id`,`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `post_file_pivot` */

insert  into `post_file_pivot`(`id`,`post_id`,`file_id`,`type`,`sort`,`created_at`,`updated_at`) values (1,1,60,'normal',0,NULL,NULL),(3,1,62,'normal',0,NULL,NULL),(4,2,63,'normal',0,NULL,NULL),(5,1,66,'normal',0,NULL,NULL),(6,3,67,'normal',0,NULL,NULL);

/*Table structure for table `post_tag_pivot` */

DROP TABLE IF EXISTS `post_tag_pivot`;

CREATE TABLE `post_tag_pivot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL COMMENT '文章ID',
  `tag_id` int(10) unsigned NOT NULL COMMENT '标签ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_post_tag` (`post_id`,`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `post_tag_pivot` */

insert  into `post_tag_pivot`(`id`,`post_id`,`tag_id`,`created_at`,`updated_at`) values (2,2,3,NULL,NULL),(4,2,1,NULL,NULL),(5,2,7,NULL,NULL),(6,1,8,NULL,NULL),(7,1,9,NULL,NULL),(8,1,10,NULL,NULL),(14,3,6,NULL,NULL);

/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `slug` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '盐',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tag` */

insert  into `tag`(`id`,`name`,`slug`,`created_at`,`updated_at`) values (1,'cc','','2018-12-19 04:53:03','2018-12-19 04:53:03'),(3,'DD','','2018-12-19 10:11:56','2018-12-19 10:11:56'),(6,'gg','','2018-12-19 10:37:18','2018-12-19 10:37:18'),(7,'ff','','2018-12-19 10:39:20','2018-12-19 10:39:20'),(8,'PHP','','2018-12-20 02:18:51','2018-12-20 02:18:51'),(9,'java','','2018-12-20 02:18:51','2018-12-20 02:18:51'),(10,'python','','2018-12-20 02:18:51','2018-12-20 02:18:51'),(15,'','','2018-12-21 10:32:59','2018-12-21 10:32:59');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
