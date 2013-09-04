# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: willog
# Generation Time: 2013-09-04 15:29:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table w_login_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_login_logs`;

CREATE TABLE `w_login_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '尝试用户名',
  `password` varchar(50) DEFAULT NULL COMMENT '尝试密码',
  `login_ip` varchar(16) DEFAULT NULL COMMENT '登录IP',
  `login_ua` varchar(255) DEFAULT NULL COMMENT '登录UserAgent',
  `login_valid` tinyint(1) unsigned DEFAULT '0' COMMENT '0:失败Fail,1:成功Success',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `w_login_logs` WRITE;
/*!40000 ALTER TABLE `w_login_logs` DISABLE KEYS */;

INSERT INTO `w_login_logs` (`id`, `username`, `password`, `login_ip`, `login_ua`, `login_valid`, `created_at`)
VALUES
	(1,'willin','willin','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.22 Safari/537.36',1,'2013-09-01 15:03:59'),
	(2,'willin','willin','192.168.0.18','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.22 Safari/537.36',1,'2013-09-01 15:08:41'),
	(3,'willin','willin','192.168.0.18','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.22 Safari/537.36',1,'2013-09-01 15:31:25'),
	(4,'willin','willin','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:23.0) Gecko/20100101 Firefox/23.0',1,'2013-09-03 22:13:51');

/*!40000 ALTER TABLE `w_login_logs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table w_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_options`;

CREATE TABLE `w_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '选项id',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '选项名称',
  `value` longtext NOT NULL COMMENT '选项内容',
  `desc` varchar(255) DEFAULT NULL COMMENT '说明',
  `autoload` varchar(20) NOT NULL DEFAULT 'no' COMMENT '系统自动加载 yes|no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `w_options` WRITE;
/*!40000 ALTER TABLE `w_options` DISABLE KEYS */;

INSERT INTO `w_options` (`id`, `key`, `value`, `desc`, `autoload`)
VALUES
	(1,'site_name','{\"cn\":\"WillogCN\",\"en\":\"WillogEN\"}','站点标题','yes'),
	(2,'site_desc','{\"cn\":\"\",\"en\":\"\"}','站点副标题','yes'),
	(3,'site_key','{\"cn\":\"\",\"en\":\"\"}','站点关键词','yes'),
	(4,'site_lang','cn','默认语言','yes'),
	(5,'site_langs','cn,en','站点启用语言','yes'),
	(6,'sys_langs','{\"cn\":\"中文\",\"en\":\"English\"}','系统可用语言','yes'),
	(7,'site_theme','default','默认主题','yes');

/*!40000 ALTER TABLE `w_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table w_post_terms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_post_terms`;

CREATE TABLE `w_post_terms` (
  `post_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`term_id`),
  KEY `term_id` (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table w_postmeta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_postmeta`;

CREATE TABLE `w_postmeta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table w_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_posts`;

CREATE TABLE `w_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL COMMENT '别名',
  `name` longtext COMMENT '名称',
  `content` longtext COMMENT '正文',
  `thumb` varchar(512) DEFAULT NULL COMMENT '缩略图',
  `views` bigint(20) unsigned DEFAULT '0' COMMENT '访问量',
  `comments` bigint(20) unsigned DEFAULT '0' COMMENT '评论量',
  `status` varchar(32) DEFAULT 'draft' COMMENT '状态：draft/publish/protect',
  `type` varchar(32) DEFAULT 'post' COMMENT '类型：post/wish',
  `lng` float DEFAULT NULL COMMENT '经纬度',
  `lat` float DEFAULT NULL COMMENT '经纬度',
  `address` longtext COMMENT '具体地址',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table w_terms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_terms`;

CREATE TABLE `w_terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL COMMENT '别名',
  `name` longtext COMMENT '名称',
  `taxonomy` varchar(32) DEFAULT NULL COMMENT '分类Category，城市City，标签Tag',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '上级id',
  `count` int(11) unsigned DEFAULT '0' COMMENT '计数',
  `desc` longtext COMMENT '简介',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table w_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `w_users`;

CREATE TABLE `w_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `salt` varchar(50) DEFAULT NULL COMMENT '密码SALT',
  `reset_key` varchar(255) DEFAULT NULL COMMENT '重置密码KEY',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `w_users` WRITE;
/*!40000 ALTER TABLE `w_users` DISABLE KEYS */;

INSERT INTO `w_users` (`id`, `username`, `email`, `nickname`, `password`, `salt`, `reset_key`, `created_at`, `updated_at`)
VALUES
	(1,'willin','willin@willin.org','长岛冰泪','c50b1bc753c0d51f6f9f6479c53a8b5e7ae4364f','SZJKzepQzt',NULL,'2013-08-30 14:36:18','2013-08-30 14:36:18');

/*!40000 ALTER TABLE `w_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
