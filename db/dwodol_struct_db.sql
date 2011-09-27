/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50144
 Source Host           : localhost
 Source Database       : cultureupdate_db

 Target Server Type    : MySQL
 Target Server Version : 50144
 File Encoding         : utf-8

 Date: 09/20/2011 12:28:10 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `blog_category`
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_email` varchar(50) NOT NULL,
  `author_url` varchar(150) NOT NULL,
  `comment` text NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `blog_post`
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `p_date` datetime NOT NULL,
  `content` text NOT NULL,
  `author` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `blog_post_tag_xref`
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_tag_xref`;
CREATE TABLE `blog_post_tag_xref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `blog_tag`
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `cron_task`
-- ----------------------------
DROP TABLE IF EXISTS `cron_task`;
CREATE TABLE `cron_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `parameter` text NOT NULL,
  `have_done` varchar(1) NOT NULL,
  `do_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `dodol_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `dodol_sessions`;
CREATE TABLE `dodol_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `modularizer`
-- ----------------------------
DROP TABLE IF EXISTS `modularizer`;
CREATE TABLE `modularizer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `widget_name` varchar(100) NOT NULL,
  `parameter` text NOT NULL,
  `m_date` datetime NOT NULL,
  `publish` varchar(1) NOT NULL,
  `permission` text NOT NULL,
  `spot` varchar(50) NOT NULL,
  `state` varchar(10) NOT NULL,
  `sort` int(11) NOT NULL,
  `mod_param` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `newsletter_campaign`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_campaign`;
CREATE TABLE `newsletter_campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `template_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `p_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `newsletter_subcriber`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_subcriber`;
CREATE TABLE `newsletter_subcriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `newsletter_tpl`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_tpl`;
CREATE TABLE `newsletter_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `template` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `newsletter_tpl_group`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_tpl_group`;
CREATE TABLE `newsletter_tpl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `route` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `page_category`
-- ----------------------------
DROP TABLE IF EXISTS `page_category`;
CREATE TABLE `page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_conf`
-- ----------------------------
DROP TABLE IF EXISTS `site_conf`;
CREATE TABLE `site_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `m_date` datetime NOT NULL,
  `c_date` datetime NOT NULL,
  `config_object` text NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_nav`
-- ----------------------------
DROP TABLE IF EXISTS `site_nav`;
CREATE TABLE `site_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_nav_item`
-- ----------------------------
DROP TABLE IF EXISTS `site_nav_item`;
CREATE TABLE `site_nav_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `nav_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `route` varchar(100) NOT NULL,
  `anchor` varchar(255) NOT NULL,
  `publish` varchar(1) NOT NULL,
  `class_suffix` varchar(50) NOT NULL,
  `id_suffix` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_category`
-- ----------------------------
DROP TABLE IF EXISTS `store_category`;
CREATE TABLE `store_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `desc` text,
  `parent_id` int(11) DEFAULT NULL,
  `publish` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_collection`
-- ----------------------------
DROP TABLE IF EXISTS `store_collection`;
CREATE TABLE `store_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `p_date` datetime NOT NULL,
  `description` text NOT NULL,
  `img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_collection_ref`
-- ----------------------------
DROP TABLE IF EXISTS `store_collection_ref`;
CREATE TABLE `store_collection_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_country`
-- ----------------------------
DROP TABLE IF EXISTS `store_country`;
CREATE TABLE `store_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL DEFAULT '1',
  `country_name` varchar(64) DEFAULT NULL,
  `country_3_code` varchar(3) DEFAULT NULL,
  `country_2_code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  KEY `idx_country_name` (`country_name`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COMMENT='Country records';

-- ----------------------------
--  Table structure for `store_order`
-- ----------------------------
DROP TABLE IF EXISTS `store_order`;
CREATE TABLE `store_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `sub_amount` int(11) NOT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `ship_carrier` varchar(20) DEFAULT NULL,
  `ship_carrier_service` varchar(100) DEFAULT NULL,
  `ship_fee` int(11) DEFAULT NULL,
  `customer_note` text,
  `uniq_id` varchar(40) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_billing_data`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_billing_data`;
CREATE TABLE `store_order_billing_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_history`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_history`;
CREATE TABLE `store_order_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `information` text NOT NULL,
  `c_date` datetime NOT NULL,
  `read` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_product_item`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_product_item`;
CREATE TABLE `store_order_product_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_attr` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `price_total` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_shipto_data`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_shipto_data`;
CREATE TABLE `store_order_shipto_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `store_payment`
-- ----------------------------
DROP TABLE IF EXISTS `store_payment`;
CREATE TABLE `store_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `nm_rek` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_product`
-- ----------------------------
DROP TABLE IF EXISTS `store_product`;
CREATE TABLE `store_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `s_desc` text,
  `l_desc` text,
  `m_date` datetime DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `publish` varchar(1) DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `disc` varchar(20) NOT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `meta_key` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=330 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_product_attrb`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_attrb`;
CREATE TABLE `store_product_attrb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `attribute` varchar(50) DEFAULT NULL,
  `price_opt` varchar(20) DEFAULT NULL,
  `stock` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_product_media`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_media`;
CREATE TABLE `store_product_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `publish` varchar(1) DEFAULT '1',
  `default` int(1) DEFAULT '0',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=262 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_product_rel`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_rel`;
CREATE TABLE `store_product_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_own` int(11) NOT NULL,
  `p_rel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_waiting_restock`
-- ----------------------------
DROP TABLE IF EXISTS `store_waiting_restock`;
CREATE TABLE `store_waiting_restock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `id_prod` int(11) NOT NULL,
  `attrb_key` varchar(50) DEFAULT NULL,
  `id_attrb` int(11) DEFAULT NULL,
  `c_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `m_date` datetime DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` varchar(400) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user_ext_data`
-- ----------------------------
DROP TABLE IF EXISTS `user_ext_data`;
CREATE TABLE `user_ext_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(500) NOT NULL,
  `group` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
