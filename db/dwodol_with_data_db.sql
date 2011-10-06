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

 Date: 10/04/2011 04:40:06 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `blog_category`
-- ----------------------------
BEGIN;
INSERT INTO `blog_category` VALUES ('13', 'uncategories', '', 'uncategories'), ('14', 'Design', '', 'design'), ('15', 'Work', '', 'work');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `blog_comment`
-- ----------------------------
BEGIN;
INSERT INTO `blog_comment` VALUES ('51', '45', 'zIdni', 'zidmubarock@gmail.com', 'aajgdsjagdj', 'To remove a file from a stack, just open the stack and drag the item to another location. To delete a file, move it to the Trash. In fact, when you’re done reading this document, feel free to throw it out ', '2011-09-22 03:18:45', '0000-00-00 00:00:00', ''), ('52', '48', 'Name', 'Email', 'URL', 'hell y\n', '2011-09-23 00:10:47', '0000-00-00 00:00:00', ''), ('53', '48', 'Name', 'Email', 'URL', 'hell y\n', '2011-09-23 00:10:54', '0000-00-00 00:00:00', ''), ('54', '48', 'Name', 'Email', 'URL', 'hell y\n', '2011-09-23 00:11:07', '0000-00-00 00:00:00', ''), ('55', '48', 'Zidni Mubarock', 'zidmubarock@gmail.com', 'asasdasasa', 'asdasasdas', '2011-09-23 00:16:03', '0000-00-00 00:00:00', '');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `blog_post`
-- ----------------------------
BEGIN;
INSERT INTO `blog_post` VALUES ('47', 'Culture Update is Cooming', 'Culture_Update_is_Cooming', '2011-09-22 00:52:55', '2011-09-26 05:28:58', '0000-00-00 00:00:00', '<p>\n	When sending data to the server, use this content-type. Default is &quot;application/x-www-form-urlencoded&quot;, which is fine for most cases. If you explicitly pass in a content-type to $.ajax() then it&#39;ll always be sent to the server (even if no data is sent). Data will always be transmitted to the server using UTF-8 charset; you must decode this appropriately on the server side.</p>\n', '1', '15', 'publish'), ('48', 'Me and Jquery', 'Me_and_Jquery', '2011-09-22 00:55:27', '2011-09-23 00:03:40', '0000-00-00 00:00:00', '<p>\n	<img alt=\"Kucing\" src=\"http://localhost/dwodol//assets/media/images/cute-grass-kitten.jpg\" style=\"width: 215px; height: 170px; float: right;\" />The jQuery documentation is great, very complete, nicely written and with a lot of examples and demos. The only thing that bugs me is the way we have to find the right documentation for what we search for. Try to search for the <code>.is()</code> function for example. Over 100 matches before the actual function I am looking for?!<i>*)</i> And it is a fixed layout which means even on my big screen I have to scroll all the way down and have to scan for it. There have to be a better way, obviously.</p>\n<p>\n	The alternative <a href=\"http://rubyonrails.org/\">Rails</a> documentation <a href=\"http://railsapi.com/\">Rails API</a> is my favorite documentation for my favorite server-side tool. Unfortunately my favorite client-side tool did not have such a fast and slick documentation. Inspired by the Rails API and desperate for a better navigation I coded one myself. Of course with jQuery!</p>\n', '1', '14', 'publish'), ('49', 'We will release soon RC1', 'We_will_release_soon_RC1', '2011-09-24 06:12:25', '2011-09-26 05:30:45', '0000-00-00 00:00:00', '<p>\n	<img alt=\"We Are the Team\" src=\"http://localhost/dwodol//assets/media/images/166134_1721743534077_1552998572_31700420_2538587_n.jpg\" style=\"width: 282px; height: 211px; float: left;\" />Carabiner is a library for managing JavaScript and CSS assets.&nbsp; It&rsquo;s different from others that currently exist (for CodeIgniter, anyway) in that it acts differently depending on whether it is in a <i>production</i> or <i>development</i> environment.&nbsp; In a production environment, it will combine, minify, and cache assets. (As files are changed, new cache files will be generated.) In a development environment, it will simply include references to the original assets.</p>\n<p>\n	<span style=\"font-size:14px;\"><b>Requirements</b></span><br />\n	Carabiner requires the <a href=\"http://codeigniter.com/forums/viewthread/103039/\">JSMin</a> and <a href=\"http://codeigniter.com/forums/viewthread/103269/\">CSSMin</a> libraries that I previously ported.&nbsp; They&rsquo;re both included in this release.&nbsp; You don&rsquo;t need to load them, unless you&rsquo;ll be using them elsewhere.&nbsp; Carabiner will load them automatically as needed. <i>(Note: the only reason they&rsquo;re included as separate libraries is that it allows you to use them independently of Carabiner.&nbsp; If desired, you could probably include them in the carabiner.php file itself.&nbsp; You&rsquo;d have to edit the Carabiner functions, but it could work.)</i></p>\n', '2', '13', 'publish');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cron_task`
-- ----------------------------
BEGIN;
INSERT INTO `cron_task` VALUES ('24', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@email or twittera\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 02:02:47'), ('22', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@barockzid\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 02:02:47'), ('23', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@ojankill\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 02:02:47'), ('25', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@asa\",\"product_name\":\"Alexandra\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/330\"}', '', '2011-09-23 13:58:47'), ('26', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 14:16:41'), ('27', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@alentalzid\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 14:16:41'), ('28', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@as\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 14:16:41'), ('29', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@valentia\",\"product_name\":\"Alysaw\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/331\"}', '', '2011-09-23 20:28:54'), ('30', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@email or twitter\",\"product_name\":\"Alexandra\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/330\"}', '', '2011-09-28 19:57:47'), ('31', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@\",\"product_name\":\"Alexandra\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/330\"}', '', '2011-09-28 19:57:47'), ('32', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@baroczid\",\"product_name\":\"Alexandra\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/330\"}', '', '2011-09-28 19:57:47'), ('33', 'site/twitter/sendUpdateStock', '{\"twuser\":\"@45\",\"product_name\":\"Alexandra\",\"link\":\"http:\\/\\/localhost\\/dwodol\\/store\\/prod\\/330\"}', '', '2011-09-28 19:57:47');
COMMIT;

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
--  Records of `dodol_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `dodol_sessions` VALUES ('b4eabd4351f2ed5c88905cc59e00e622', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:6.', '1317673260', 'a:2:{s:8:\"messages\";a:4:{s:7:\"warning\";a:0:{}s:11:\"information\";a:0:{}s:7:\"success\";a:0:{}s:5:\"error\";a:0:{}}s:15:\"back_login_data\";a:3:{s:5:\"login\";b:1;s:4:\"role\";s:5:\"owner\";s:7:\"user_id\";s:1:\"1\";}}'), ('402f01a9881d47c97bd29b3dfb684d5f', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:6.', '1317677953', 'a:1:{s:8:\"messages\";a:4:{s:7:\"warning\";a:0:{}s:11:\"information\";a:0:{}s:7:\"success\";a:0:{}s:5:\"error\";a:0:{}}}');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `modularizer`
-- ----------------------------
BEGIN;
INSERT INTO `modularizer` VALUES ('14', 'Bottom Global Menu', 'menu', '{\"id_menu\":\"5\",\"type\":\"horizontal\"}', '0000-00-00 00:00:00', 'y', '', 'bottom_left', 'front', '1', '{\"hide_title\":\"y\"}'), ('19', 'mini_cart', 'cart_widget', '[]', '0000-00-00 00:00:00', 'y', '', 'top_right', 'front', '1', '{\"hide_title\":\"y\"}'), ('13', 'Top Menu', 'menu', '{\"id_menu\":\"1\",\"type\":\"horizontal\"}', '0000-00-00 00:00:00', 'y', '', 'topmenu', 'front', '1', '{\"hide_title\":\"y\"}'), ('20', 'Front Menu', 'menu', '{\"id_menu\":\"8\",\"type\":\"vertical\"}', '0000-00-00 00:00:00', 'y', '', 'front_right_bottom', 'front', '1', '{\"hide_title\":\"y\"}'), ('21', 'Store Category', 'menu', '{\"id_menu\":\"1\",\"type\":\"vertical\"}', '0000-00-00 00:00:00', 'y', '', '#', 'front', '1', '{\"hide_title\":\"y\"}'), ('23', 'Backend Top Menu', 'menu', '{\"id_menu\":\"9\",\"type\":\"horizontal\"}', '0000-00-00 00:00:00', 'y', '', 'toppest', 'front', '1', '{\"hide_title\":\"y\"}'), ('24', 'testing', 'custom_html', '{\"content\":\"<p>\\n\\tdaasfdafsafsafasfafaasfasfa<\\/p>\\n\"}', '0000-00-00 00:00:00', 'y', '', 'testing', 'front', '1', '{\"hide_title\":\"y\"}'), ('25', 'Category Store', 'cat_store_menu', '[]', '0000-00-00 00:00:00', 'y', '', '#', 'front', '2', '{\"hide_title\":\"y\"}'), ('34', 'Statistic', 'statistic', '{\"statistic_member\":[{\"function\":\"store\\/order\\/data_report\",\"metric\":\"order\"}]}', '0000-00-00 00:00:00', 'y', '', 'backend_front', 'admin', '2', '{\"hide_title\":\"y\"}'), ('36', 'Blog', 'latest_blog', 'false', '0000-00-00 00:00:00', 'y', '', 'front_left_bottom', 'front', '1', '{\"hide_title\":\"n\"}'), ('37', 'Newsletter for', 'custom_html', '{\"content\":\"<p>\\n\\tsafasasfdasfasfasf<\\/p>\\n\"}', '0000-00-00 00:00:00', 'y', '', 'front_right_bottom', 'front', '2', '{\"hide_title\":\"y\"}'), ('38', 'New Arrival', 'store_new_arrival', 'false', '0000-00-00 00:00:00', 'y', '', 'front_main', 'front', '1', '{\"hide_title\":\"y\"}');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `newsletter_tpl`
-- ----------------------------
BEGIN;
INSERT INTO `newsletter_tpl` VALUES ('5', 'suh 1', '3', '<p>\n	asacsacsca</p>\n'), ('4', 'temp 1', '2', '{PRODNAME} is in stock, would you check {LINK} {TWUSER}\n\n'), ('6', 'temp 2', '2', 'Halo {TWUSER}, product Kita {PRODNAME} sudah Ready Stok, nih liknnya {LINK}\n'), ('7', 'Here we go again', '2', '{TWUSER}, your waiting is over, {PRODNAME} is Already come {LINK}\n');
COMMIT;

-- ----------------------------
--  Table structure for `newsletter_tpl_group`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_tpl_group`;
CREATE TABLE `newsletter_tpl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `newsletter_tpl_group`
-- ----------------------------
BEGIN;
INSERT INTO `newsletter_tpl_group` VALUES ('2', 'tw restock mention', '<p>\n	sasas vd</p>\n'), ('3', 'Reply Stock', '');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `page`
-- ----------------------------
BEGIN;
INSERT INTO `page` VALUES ('5', 'Contact', '<p>\n	Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores</p>\n', '', '9', '2011-06-10 13:40:31', '2011-06-21 05:23:53'), ('6', 'Store Policies', '<p>\n	Lorem Ipsum<br />\n	<br />\n	is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\n	<br />\n	It is a long established fact<br />\n	<br />\n	that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '', '2', '2011-06-21 05:24:20', '0000-00-00 00:00:00'), ('7', 'Privacy', '<p>\n	Lorem Ipsum<br />\n	<br />\n	is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\n	<br />\n	It is a long established fact<br />\n	<br />\n	that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\n	<br />\n	&nbsp;</p>\n', '', '2', '2011-06-21 05:25:17', '0000-00-00 00:00:00'), ('8', 'How To', '<p>\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n<p>\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '', '8', '2011-06-22 05:58:20', '0000-00-00 00:00:00'), ('9', 'About', '<div class=\"heading_img\">\n	<img alt=\"About\" src=\"http://olineworkrobe.com/assets/theme/theme_front/ow/img/about_header.jpg\" style=\"width: 860px;\" /></div>\n<div class=\"grid_640 right\">\n	<br />\n	<p>\n		<strong>It is a long established fact</strong></p>\n	<p>\n		that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n</div>\n', '', '8', '2011-07-14 15:41:08', '2011-07-14 18:29:28');
COMMIT;

-- ----------------------------
--  Table structure for `page_category`
-- ----------------------------
DROP TABLE IF EXISTS `page_category`;
CREATE TABLE `page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `page_category`
-- ----------------------------
BEGIN;
INSERT INTO `page_category` VALUES ('1', 'uncategory', '0'), ('2', 'Term', '0'), ('9', 'Site Page', '0'), ('8', 'Resource', '0');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_conf`
-- ----------------------------
BEGIN;
INSERT INTO `site_conf` VALUES ('11', 'store', '2011-09-19 03:02:20', '2011-07-13 23:37:53', '{\"owner_mail\":\"zidmubarock@gmail.com\",\"store_addres\":\"jl. Anggrek XI Blok l4 Taman CIbodas, Tangerang\",\"store_phone\":\"02183379220\",\"store_phone_2\":\"0865446777\",\"store_zip\":\"15132\",\"store_currency\":\"IDR\",\"store_country_id\":\"ID\",\"manager_mail\":\"alent.alzid@gmail.com\",\"currency\":\"IDR\",\"barcode_prefix\":\"cu\"}', ''), ('12', 'site', '2011-09-19 04:21:12', '2011-08-06 04:15:43', '{\"name\":\"Culture-Update.com\",\"tag_line\":\"some line goes here\",\"front_theme\":\"cu\"}', ''), ('13', 'Twitter', '2011-09-19 04:39:42', '2011-09-03 05:02:39', '{\"account_name\":\"ojan_kill\",\"consumer_key\":\"oCIWzdSpnNi7Q3rxUl5uNQ\",\"consumer_secret\":\"rqGV5lEELKYEYSEk7p12uazr9J6VCdnKX5MH29wW4U\",\"oauth_token\":\"17579993-YhDRc9dfrV4CcHIm46ptxvVF1lsnGz3c5FenWnYDk\",\"oauth_token_secret\":\"yoZNpSGXiz1gE6NLPMbyTaxGJpNV1VDaVn95z1gsTc\",\"friend\":\"ojan_kill\"}', ''), ('14', 'google analytics', '0000-00-00 00:00:00', '2011-09-08 15:30:02', '{\"ga_account\":\"zidmubarock@gmail.com\",\"ga_password\":\"alzid4evermail\",\"ga_profile\":\"17866436\"}', '');
COMMIT;

-- ----------------------------
--  Table structure for `site_nav`
-- ----------------------------
DROP TABLE IF EXISTS `site_nav`;
CREATE TABLE `site_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_nav`
-- ----------------------------
BEGIN;
INSERT INTO `site_nav` VALUES ('1', 'Top Menu', '<p>\n	Menu For All Page on The top</p>\n'), ('5', 'Bottom Menu', ''), ('8', 'Front Menu', ''), ('9', 'Backend Top Menu', '');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_nav_item`
-- ----------------------------
BEGIN;
INSERT INTO `site_nav_item` VALUES ('10', '0', '5', '1', 'About Us', '', 'page/view/3', '', '', ''), ('11', '0', '5', '2', 'Store Policies', '', 'page/view/6', '', '', ''), ('12', '0', '5', '3', 'Privacy', '', 'page/view/7', '', '', ''), ('13', '0', '5', '4', 'Contact', '', 'page/view/5', '', '', ''), ('16', '0', '1', '3', 'Sale', '', 'store/sale', '', '', ''), ('17', '0', '1', '2', 'Collection', '', 'store/collection', '', '', ''), ('18', '0', '1', '1', 'New Arrival', '', 'store/new_arrival', '', '', ''), ('19', '0', '1', '4', 'Blog', '', 'blog/posts', '', '', ''), ('20', '0', '1', '5', 'Contact', '', 'page/contact', '', '', ''), ('60', '0', '8', '6', 'Privacy', '', '#', '', '', ''), ('61', '0', '8', '6', 'Register', '', '', '', '', ''), ('59', '0', '8', '6', 'Store Policies', '', '#', '', '', ''), ('58', '0', '8', '6', 'About Us', '', '#', '', '', ''), ('43', '0', '9', '7', 'User', '', 'backend/user/b_user/browse', '', '', ''), ('28', '0', '9', '1', 'Dashboard', '', 'backend/', '', '', ''), ('29', '0', '9', '2', 'Store', '', '#', '', '', ''), ('30', '29', '9', '8', 'Product', '', 'backend/store/b_product/listprod', '', '', ''), ('32', '29', '9', '10', 'Collection', '', 'backend/store/b_collection/browse', '', '', ''), ('33', '29', '9', '11', 'Customer', '', 'backend/store/b_customer/browse', '', '', ''), ('34', '29', '9', '12', 'Order', '', 'backend/store/b_order/browse', '', '', ''), ('35', '0', '9', '6', 'Page', '', 'backend/page/b_page/browse', '', '', ''), ('36', '37', '9', '16', 'Navigation', '', 'backend/nav/b_nav/browse', '', '', ''), ('37', '0', '9', '4', 'Site', '', '#', '', '', ''), ('38', '37', '9', '17', 'Configuration', '', 'backend/conf/b_conf/browse', '', '', ''), ('39', '37', '9', '15', 'Widget', '', 'backend/modularizer/b_modularizer/browse', '', '', ''), ('44', '0', '9', '3', 'Blog', '', '#', '', '', ''), ('62', '0', '8', '6', 'Register', '', '', '', '', ''), ('46', '44', '9', '20', 'Posts', '', '/backend/blog/b_blog/post_browse', '', '', ''), ('47', '44', '9', '21', 'Comment', '', '/backend/blog/b_blog/comment_browse', '', '', ''), ('48', '44', '9', '22', 'Categories', '', '/backend/blog/b_blog/category_browse', '', '', ''), ('50', '0', '9', '5', 'Newsletter', '', '#', '', '', ''), ('51', '50', '9', '23', 'Subcribers', '', '', '', '', ''), ('52', '50', '9', '24', 'Create letter', '', '', '', '', ''), ('53', '50', '9', '25', 'List Letter', '', '', '', '', ''), ('54', '50', '9', '26', 'Mail Template', '', 'backend/newsletter/b_template/browse_tpl', '', '', ''), ('55', '37', '9', '18', 'Cron', '', '', '', '', ''), ('56', '37', '9', '14', 'FIle Manager', '', '', '', '', ''), ('57', '29', '9', '13', 'Extension', '', 'backend/store/b_extension', '', '', '');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_category`
-- ----------------------------
BEGIN;
INSERT INTO `store_category` VALUES ('30', 'Outwear', '', '0', 'y'), ('31', 'Woman', '', '0', 'y'), ('32', 'Accesories', '', '0', 'y'), ('33', 'Top', '', '0', 'y'), ('34', 'Shirt', '', '0', 'y'), ('35', 'Office', '', '0', 'y');
COMMIT;

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
--  Records of `store_country`
-- ----------------------------
BEGIN;
INSERT INTO `store_country` VALUES ('1', '1', 'Afghanistan', 'AFG', 'AF'), ('2', '1', 'Albania', 'ALB', 'AL'), ('3', '1', 'Algeria', 'DZA', 'DZ'), ('4', '1', 'American Samoa', 'ASM', 'AS'), ('5', '1', 'Andorra', 'AND', 'AD'), ('6', '1', 'Angola', 'AGO', 'AO'), ('7', '1', 'Anguilla', 'AIA', 'AI'), ('8', '1', 'Antarctica', 'ATA', 'AQ'), ('9', '1', 'Antigua and Barbuda', 'ATG', 'AG'), ('10', '1', 'Argentina', 'ARG', 'AR'), ('11', '1', 'Armenia', 'ARM', 'AM'), ('12', '1', 'Aruba', 'ABW', 'AW'), ('13', '1', 'Australia', 'AUS', 'AU'), ('14', '1', 'Austria', 'AUT', 'AT'), ('15', '1', 'Azerbaijan', 'AZE', 'AZ'), ('16', '1', 'Bahamas', 'BHS', 'BS'), ('17', '1', 'Bahrain', 'BHR', 'BH'), ('18', '1', 'Bangladesh', 'BGD', 'BD'), ('19', '1', 'Barbados', 'BRB', 'BB'), ('20', '1', 'Belarus', 'BLR', 'BY'), ('21', '1', 'Belgium', 'BEL', 'BE'), ('22', '1', 'Belize', 'BLZ', 'BZ'), ('23', '1', 'Benin', 'BEN', 'BJ'), ('24', '1', 'Bermuda', 'BMU', 'BM'), ('25', '1', 'Bhutan', 'BTN', 'BT'), ('26', '1', 'Bolivia', 'BOL', 'BO'), ('27', '1', 'Bosnia and Herzegowina', 'BIH', 'BA'), ('28', '1', 'Botswana', 'BWA', 'BW'), ('29', '1', 'Bouvet Island', 'BVT', 'BV'), ('30', '1', 'Brazil', 'BRA', 'BR'), ('31', '1', 'British Indian Ocean Territory', 'IOT', 'IO'), ('32', '1', 'Brunei Darussalam', 'BRN', 'BN'), ('33', '1', 'Bulgaria', 'BGR', 'BG'), ('34', '1', 'Burkina Faso', 'BFA', 'BF'), ('35', '1', 'Burundi', 'BDI', 'BI'), ('36', '1', 'Cambodia', 'KHM', 'KH'), ('37', '1', 'Cameroon', 'CMR', 'CM'), ('38', '1', 'Canada', 'CAN', 'CA'), ('39', '1', 'Cape Verde', 'CPV', 'CV'), ('40', '1', 'Cayman Islands', 'CYM', 'KY'), ('41', '1', 'Central African Republic', 'CAF', 'CF'), ('42', '1', 'Chad', 'TCD', 'TD'), ('43', '1', 'Chile', 'CHL', 'CL'), ('44', '1', 'China', 'CHN', 'CN'), ('45', '1', 'Christmas Island', 'CXR', 'CX'), ('46', '1', 'Cocos (Keeling) Islands', 'CCK', 'CC'), ('47', '1', 'Colombia', 'COL', 'CO'), ('48', '1', 'Comoros', 'COM', 'KM'), ('49', '1', 'Congo', 'COG', 'CG'), ('50', '1', 'Cook Islands', 'COK', 'CK'), ('51', '1', 'Costa Rica', 'CRI', 'CR'), ('52', '1', 'Cote D\'Ivoire', 'CIV', 'CI'), ('53', '1', 'Croatia', 'HRV', 'HR'), ('54', '1', 'Cuba', 'CUB', 'CU'), ('55', '1', 'Cyprus', 'CYP', 'CY'), ('56', '1', 'Czech Republic', 'CZE', 'CZ'), ('57', '1', 'Denmark', 'DNK', 'DK'), ('58', '1', 'Djibouti', 'DJI', 'DJ'), ('59', '1', 'Dominica', 'DMA', 'DM'), ('60', '1', 'Dominican Republic', 'DOM', 'DO'), ('61', '1', 'East Timor', 'TMP', 'TP'), ('62', '1', 'Ecuador', 'ECU', 'EC'), ('63', '1', 'Egypt', 'EGY', 'EG'), ('64', '1', 'El Salvador', 'SLV', 'SV'), ('65', '1', 'Equatorial Guinea', 'GNQ', 'GQ'), ('66', '1', 'Eritrea', 'ERI', 'ER'), ('67', '1', 'Estonia', 'EST', 'EE'), ('68', '1', 'Ethiopia', 'ETH', 'ET'), ('69', '1', 'Falkland Islands (Malvinas)', 'FLK', 'FK'), ('70', '1', 'Faroe Islands', 'FRO', 'FO'), ('71', '1', 'Fiji', 'FJI', 'FJ'), ('72', '1', 'Finland', 'FIN', 'FI'), ('73', '1', 'France', 'FRA', 'FR'), ('74', '1', 'France, Metropolitan', 'FXX', 'FX'), ('75', '1', 'French Guiana', 'GUF', 'GF'), ('76', '1', 'French Polynesia', 'PYF', 'PF'), ('77', '1', 'French Southern Territories', 'ATF', 'TF'), ('78', '1', 'Gabon', 'GAB', 'GA'), ('79', '1', 'Gambia', 'GMB', 'GM'), ('80', '1', 'Georgia', 'GEO', 'GE'), ('81', '1', 'Germany', 'DEU', 'DE'), ('82', '1', 'Ghana', 'GHA', 'GH'), ('83', '1', 'Gibraltar', 'GIB', 'GI'), ('84', '1', 'Greece', 'GRC', 'GR'), ('85', '1', 'Greenland', 'GRL', 'GL'), ('86', '1', 'Grenada', 'GRD', 'GD'), ('87', '1', 'Guadeloupe', 'GLP', 'GP'), ('88', '1', 'Guam', 'GUM', 'GU'), ('89', '1', 'Guatemala', 'GTM', 'GT'), ('90', '1', 'Guinea', 'GIN', 'GN'), ('91', '1', 'Guinea-bissau', 'GNB', 'GW'), ('92', '1', 'Guyana', 'GUY', 'GY'), ('93', '1', 'Haiti', 'HTI', 'HT'), ('94', '1', 'Heard and Mc Donald Islands', 'HMD', 'HM'), ('95', '1', 'Honduras', 'HND', 'HN'), ('96', '1', 'Hong Kong', 'HKG', 'HK'), ('97', '1', 'Hungary', 'HUN', 'HU'), ('98', '1', 'Iceland', 'ISL', 'IS'), ('99', '1', 'India', 'IND', 'IN'), ('100', '1', 'Indonesia', 'IDN', 'ID'), ('101', '1', 'Iran (Islamic Republic of)', 'IRN', 'IR'), ('102', '1', 'Iraq', 'IRQ', 'IQ'), ('103', '1', 'Ireland', 'IRL', 'IE'), ('104', '1', 'Israel', 'ISR', 'IL'), ('105', '1', 'Italy', 'ITA', 'IT'), ('106', '1', 'Jamaica', 'JAM', 'JM'), ('107', '1', 'Japan', 'JPN', 'JP'), ('108', '1', 'Jordan', 'JOR', 'JO'), ('109', '1', 'Kazakhstan', 'KAZ', 'KZ'), ('110', '1', 'Kenya', 'KEN', 'KE'), ('111', '1', 'Kiribati', 'KIR', 'KI'), ('112', '1', 'Korea, Democratic People\'s Republic of', 'PRK', 'KP'), ('113', '1', 'Korea, Republic of', 'KOR', 'KR'), ('114', '1', 'Kuwait', 'KWT', 'KW'), ('115', '1', 'Kyrgyzstan', 'KGZ', 'KG'), ('116', '1', 'Lao People\'s Democratic Republic', 'LAO', 'LA'), ('117', '1', 'Latvia', 'LVA', 'LV'), ('118', '1', 'Lebanon', 'LBN', 'LB'), ('119', '1', 'Lesotho', 'LSO', 'LS'), ('120', '1', 'Liberia', 'LBR', 'LR'), ('121', '1', 'Libyan Arab Jamahiriya', 'LBY', 'LY'), ('122', '1', 'Liechtenstein', 'LIE', 'LI'), ('123', '1', 'Lithuania', 'LTU', 'LT'), ('124', '1', 'Luxembourg', 'LUX', 'LU'), ('125', '1', 'Macau', 'MAC', 'MO'), ('126', '1', 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK'), ('127', '1', 'Madagascar', 'MDG', 'MG'), ('128', '1', 'Malawi', 'MWI', 'MW'), ('129', '1', 'Malaysia', 'MYS', 'MY'), ('130', '1', 'Maldives', 'MDV', 'MV'), ('131', '1', 'Mali', 'MLI', 'ML'), ('132', '1', 'Malta', 'MLT', 'MT'), ('133', '1', 'Marshall Islands', 'MHL', 'MH'), ('134', '1', 'Martinique', 'MTQ', 'MQ'), ('135', '1', 'Mauritania', 'MRT', 'MR'), ('136', '1', 'Mauritius', 'MUS', 'MU'), ('137', '1', 'Mayotte', 'MYT', 'YT'), ('138', '1', 'Mexico', 'MEX', 'MX'), ('139', '1', 'Micronesia, Federated States of', 'FSM', 'FM'), ('140', '1', 'Moldova, Republic of', 'MDA', 'MD'), ('141', '1', 'Monaco', 'MCO', 'MC'), ('142', '1', 'Mongolia', 'MNG', 'MN'), ('143', '1', 'Montserrat', 'MSR', 'MS'), ('144', '1', 'Morocco', 'MAR', 'MA'), ('145', '1', 'Mozambique', 'MOZ', 'MZ'), ('146', '1', 'Myanmar', 'MMR', 'MM'), ('147', '1', 'Namibia', 'NAM', 'NA'), ('148', '1', 'Nauru', 'NRU', 'NR'), ('149', '1', 'Nepal', 'NPL', 'NP'), ('150', '1', 'Netherlands', 'NLD', 'NL'), ('151', '1', 'Netherlands Antilles', 'ANT', 'AN'), ('152', '1', 'New Caledonia', 'NCL', 'NC'), ('153', '1', 'New Zealand', 'NZL', 'NZ'), ('154', '1', 'Nicaragua', 'NIC', 'NI'), ('155', '1', 'Niger', 'NER', 'NE'), ('156', '1', 'Nigeria', 'NGA', 'NG'), ('157', '1', 'Niue', 'NIU', 'NU'), ('158', '1', 'Norfolk Island', 'NFK', 'NF'), ('159', '1', 'Northern Mariana Islands', 'MNP', 'MP'), ('160', '1', 'Norway', 'NOR', 'NO'), ('161', '1', 'Oman', 'OMN', 'OM'), ('162', '1', 'Pakistan', 'PAK', 'PK'), ('163', '1', 'Palau', 'PLW', 'PW'), ('164', '1', 'Panama', 'PAN', 'PA'), ('165', '1', 'Papua New Guinea', 'PNG', 'PG'), ('166', '1', 'Paraguay', 'PRY', 'PY'), ('167', '1', 'Peru', 'PER', 'PE'), ('168', '1', 'Philippines', 'PHL', 'PH'), ('169', '1', 'Pitcairn', 'PCN', 'PN'), ('170', '1', 'Poland', 'POL', 'PL'), ('171', '1', 'Portugal', 'PRT', 'PT'), ('172', '1', 'Puerto Rico', 'PRI', 'PR'), ('173', '1', 'Qatar', 'QAT', 'QA'), ('174', '1', 'Reunion', 'REU', 'RE'), ('175', '1', 'Romania', 'ROM', 'RO'), ('176', '1', 'Russian Federation', 'RUS', 'RU'), ('177', '1', 'Rwanda', 'RWA', 'RW'), ('178', '1', 'Saint Kitts and Nevis', 'KNA', 'KN'), ('179', '1', 'Saint Lucia', 'LCA', 'LC'), ('180', '1', 'Saint Vincent and the Grenadines', 'VCT', 'VC'), ('181', '1', 'Samoa', 'WSM', 'WS'), ('182', '1', 'San Marino', 'SMR', 'SM'), ('183', '1', 'Sao Tome and Principe', 'STP', 'ST'), ('184', '1', 'Saudi Arabia', 'SAU', 'SA'), ('185', '1', 'Senegal', 'SEN', 'SN'), ('186', '1', 'Seychelles', 'SYC', 'SC'), ('187', '1', 'Sierra Leone', 'SLE', 'SL'), ('188', '1', 'Singapore', 'SGP', 'SG'), ('189', '1', 'Slovakia (Slovak Republic)', 'SVK', 'SK'), ('190', '1', 'Slovenia', 'SVN', 'SI'), ('191', '1', 'Solomon Islands', 'SLB', 'SB'), ('192', '1', 'Somalia', 'SOM', 'SO'), ('193', '1', 'South Africa', 'ZAF', 'ZA'), ('194', '1', 'South Georgia and the South Sandwich Islands', 'SGS', 'GS'), ('195', '1', 'Spain', 'ESP', 'ES'), ('196', '1', 'Sri Lanka', 'LKA', 'LK'), ('197', '1', 'St. Helena', 'SHN', 'SH'), ('198', '1', 'St. Pierre and Miquelon', 'SPM', 'PM'), ('199', '1', 'Sudan', 'SDN', 'SD'), ('200', '1', 'Suriname', 'SUR', 'SR'), ('201', '1', 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ'), ('202', '1', 'Swaziland', 'SWZ', 'SZ'), ('203', '1', 'Sweden', 'SWE', 'SE'), ('204', '1', 'Switzerland', 'CHE', 'CH'), ('205', '1', 'Syrian Arab Republic', 'SYR', 'SY'), ('206', '1', 'Taiwan', 'TWN', 'TW'), ('207', '1', 'Tajikistan', 'TJK', 'TJ'), ('208', '1', 'Tanzania, United Republic of', 'TZA', 'TZ'), ('209', '1', 'Thailand', 'THA', 'TH'), ('210', '1', 'Togo', 'TGO', 'TG'), ('211', '1', 'Tokelau', 'TKL', 'TK'), ('212', '1', 'Tonga', 'TON', 'TO'), ('213', '1', 'Trinidad and Tobago', 'TTO', 'TT'), ('214', '1', 'Tunisia', 'TUN', 'TN'), ('215', '1', 'Turkey', 'TUR', 'TR'), ('216', '1', 'Turkmenistan', 'TKM', 'TM'), ('217', '1', 'Turks and Caicos Islands', 'TCA', 'TC'), ('218', '1', 'Tuvalu', 'TUV', 'TV'), ('219', '1', 'Uganda', 'UGA', 'UG'), ('220', '1', 'Ukraine', 'UKR', 'UA'), ('221', '1', 'United Arab Emirates', 'ARE', 'AE'), ('222', '1', 'United Kingdom', 'GBR', 'GB'), ('223', '1', 'United States', 'USA', 'US'), ('224', '1', 'United States Minor Outlying Islands', 'UMI', 'UM'), ('225', '1', 'Uruguay', 'URY', 'UY'), ('226', '1', 'Uzbekistan', 'UZB', 'UZ'), ('227', '1', 'Vanuatu', 'VUT', 'VU'), ('228', '1', 'Vatican City State (Holy See)', 'VAT', 'VA'), ('229', '1', 'Venezuela', 'VEN', 'VE'), ('230', '1', 'Viet Nam', 'VNM', 'VN'), ('231', '1', 'Virgin Islands (British)', 'VGB', 'VG'), ('232', '1', 'Virgin Islands (U.S.)', 'VIR', 'VI'), ('233', '1', 'Wallis and Futuna Islands', 'WLF', 'WF'), ('234', '1', 'Western Sahara', 'ESH', 'EH'), ('235', '1', 'Yemen', 'YEM', 'YE'), ('236', '1', 'Yugoslavia', 'YUG', 'YU'), ('237', '1', 'The Democratic Republic of Congo', 'DRC', 'DC'), ('238', '1', 'Zambia', 'ZMB', 'ZM'), ('239', '1', 'Zimbabwe', 'ZWE', 'ZW'), ('240', '1', 'East Timor', 'XET', 'XE'), ('241', '1', 'Jersey', 'XJE', 'XJ'), ('242', '1', 'St. Barthelemy', 'XSB', 'XB'), ('243', '1', 'St. Eustatius', 'XSE', 'XU'), ('244', '1', 'Canary Islands', 'XCA', 'XC');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_order`
-- ----------------------------
BEGIN;
INSERT INTO `store_order` VALUES ('129', '1', '2011-09-22 04:44:00', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '560000', '560000', 'IDR', '0', '0', '0', '', '2414645bf479d403161783b791e55bbf', 'confirm'), ('130', '1', '2011-09-23 01:19:25', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '250000', '250000', 'IDR', '0', '0', '0', '', 'c726e1694e1e1bd3264ac2b6d3127af8', 'confirm'), ('131', '1', '2011-09-01 02:02:01', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '567000', '560000', 'IDR', 'JNE', 'REG (Regular)', '7000', '', '394df055d61cd75a71e1d949b81337c4', 'pending'), ('132', '1', '2011-09-23 02:39:33', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '567000', '560000', 'IDR', 'JNE', 'REG (Regular)', '7000', '', '6791299b60af39e9c0eee25c70b7a719', 'pending'), ('133', '1', '2011-09-23 07:44:37', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '2544378', '1120000', 'IDR', 'UPS', 'UPS Express Saver', '1424378', '', '4daec2821d98731f16f0f0bc729c6cad', 'confirm'), ('134', '1', '2011-09-23 14:28:11', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '3610000', '3610000', 'IDR', '0', '0', '0', '', 'b9750f3b384db21c9c6cfad6393ead07', 'pending'), ('135', '1', '2011-09-23 14:58:36', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '1340000', '1340000', 'IDR', '0', '0', '0', '', 'de06cde772c3483484cfea8e08a5e060', 'pending'), ('136', '1', '2011-09-23 21:41:35', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '1120000', '1120000', 'IDR', '0', '0', '0', '', '53d60186fb8154ef05e776558465f875', 'pending'), ('137', '1', '2011-09-23 22:26:08', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '607000', '600000', 'IDR', 'JNE', 'REG (Regular)', '7000', '', '1a67d72ac8a1bf18dfc61083950a7769', 'pending'), ('138', '43', '2011-09-24 18:16:33', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '574000', '567000', 'IDR', 'JNE', 'REG (Regular)', '7000', '', '06a0c06866770a7be6122d6d5969e736', 'pending'), ('139', '2', '2011-09-27 01:29:05', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '560000', '560000', 'IDR', '0', '0', '0', '', '47dd614c3f9e879a6449b9660968b497', 'pending'), ('140', '2', '2011-09-27 01:56:25', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '670000', '670000', 'IDR', '0', '0', '0', '', 'c9a710ff73bb0188defef69444ac3da7', 'pending'), ('141', '1', '2011-09-20 19:30:52', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '1200000', '1200000', 'IDR', '0', '0', '0', '', '1f52318cd964c84bc5f16604dfac39c0', 'pending'), ('142', '1', '2011-09-27 14:42:52', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '1067000', '1067000', 'IDR', '0', '0', '0', '', '6333f9c93897eccae1b17f3980406497', 'pending'), ('143', '1', '2011-09-28 15:04:48', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '4587000', '4587000', 'IDR', '0', '0', '0', '', '3dcf71156bd38cc022e886486db928c1', 'pending'), ('144', '1', '2011-09-28 18:24:04', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '900000', '900000', 'IDR', '0', '0', '0', '', 'eb7f42afada5b398449287b5d3bbf6f9', 'pending'), ('145', '1', '2011-09-28 20:03:44', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '200000', '200000', 'IDR', '0', '0', '0', '', '4f55bdf1ab01f1fd2fc0611d907cb50b', 'pending'), ('146', '1', '2011-09-28 20:05:06', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '75000', '75000', 'IDR', '0', '0', '0', '', '930b35c84c381713c672c68759453c44', 'pending'), ('147', '1', '2011-09-28 20:05:45', null, 'Transfer Mandiri NO 97978688979, AN Laurence Muljono', '450000', '450000', 'IDR', '0', '0', '0', '', '2783ed3161c8bcc895645c906037c177', 'pending');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_order_billing_data`
-- ----------------------------
BEGIN;
INSERT INTO `store_order_billing_data` VALUES ('82', '129', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('83', '130', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('84', '131', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'jl. Angrrek Xi', '02165765', ''), ('85', '132', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'jl. Angrrek Xi', '02165765', ''), ('86', '133', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('87', '134', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tan', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('88', '135', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('89', '136', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('90', '137', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'jl. Angrrek Xi', '02165765', ''), ('91', '138', 'alental@gmail.com', 'Valentia', 'Maniz', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15124', 'Jl Anggrek XI Blok L4', '', '612121'), ('92', '139', 'capung_ungu@yahoo.com', 'Fransisca ', 'Agustini', '0', 'Jakarta', 'jakarta', '', '15624', '', '', ''), ('93', '140', 'capung_ungu@yahoo.com', 'Fransisca ', 'Agustini', '2', 'Jakarta', 'jakarta', '', '15624', '', '', ''), ('94', '141', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('95', '142', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('96', '143', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('97', '144', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('98', '145', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('99', '146', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('100', '147', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', '');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_order_product_item`
-- ----------------------------
BEGIN;
INSERT INTO `store_order_product_item` VALUES ('137', '129', '331', '0', '560000', '560000', '1'), ('138', '130', '330', '0', '250000', '250000', '1'), ('139', '131', '331', '131', '560000', '560000', '1'), ('140', '132', '331', '131', '560000', '560000', '1'), ('141', '133', '331', '131', '560000', '1120000', '2'), ('142', '134', '330', '0', '250000', '250000', '1'), ('143', '134', '331', '131', '560000', '3360000', '6'), ('144', '135', '332', '0', '670000', '1340000', '2'), ('145', '136', '344', '0', '560000', '1120000', '2'), ('146', '137', '342', '0', '300000', '600000', '2'), ('147', '138', '333', '0', '567000', '567000', '1'), ('148', '139', '331', '132', '560000', '560000', '1'), ('149', '140', '335', '0', '670000', '670000', '1'), ('150', '141', '342', '0', '300000', '1200000', '4'), ('151', '142', '345', '134', '67000', '67000', '1'), ('152', '142', '336', '0', '500000', '1000000', '2'), ('153', '143', '343', '0', '500000', '1500000', '3'), ('154', '143', '344', '0', '560000', '1680000', '3'), ('155', '143', '332', '0', '670000', '1340000', '2'), ('156', '143', '345', '133', '67000', '67000', '1'), ('157', '144', '346', '0', '450000', '900000', '2'), ('158', '145', '330', '0', '200000', '200000', '1'), ('159', '146', '340', '0', '75000', '75000', '1'), ('160', '147', '346', '0', '450000', '450000', '1');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `store_order_shipto_data`
-- ----------------------------
BEGIN;
INSERT INTO `store_order_shipto_data` VALUES ('115', '129', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('116', '130', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('117', '131', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'jl. Angrrek Xi', '02165765', ''), ('118', '132', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'jl. Angrrek Xi', '02165765', ''), ('119', '133', 'Valentia Maniz', 'Mubarock', '99', 'Bombay', 'Delhi', '', '44556', 'Jl Sultan Agung 9 No 13', '124124124', '1212314124'), ('120', '134', 'Zidni', 'Mubarock', '100', 'Banten', 'Tan', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('121', '135', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('122', '136', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('123', '137', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'jl. Angrrek Xi', '02165765', ''), ('124', '138', 'Valentia', 'Maniz', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15124', 'Jl Anggrek XI Blok L4', '', '612121'), ('125', '139', 'Fransisca ', 'Agustini', '0', 'Jakarta', 'jakarta', '', '15624', '', '', ''), ('126', '140', 'Fransisca ', 'Agustini', '2', 'Jakarta', 'jakarta', '', '15624', '', '', ''), ('127', '141', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('128', '142', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('129', '143', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('130', '144', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('131', '145', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('132', '146', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', ''), ('133', '147', 'Zidni', 'Mubarock', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', '');
COMMIT;

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
--  Records of `store_payment`
-- ----------------------------
BEGIN;
INSERT INTO `store_payment` VALUES ('1', 'Transfer BCA aks', '', '0908080', 'Laurence Muljono'), ('2', 'Transfer Mandiri', '<p>\n	Silakan Lakukan Transfer ke rekening BCA Atas Name <strong>Laurence Muljono</strong>, dengan No. 97978688979</p>\n', '97978688979', 'Laurence Muljono');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=347 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product`
-- ----------------------------
BEGIN;
INSERT INTO `store_product` VALUES ('330', 'Alexandra', 'MA688', '0.3', '0', null, '<p>\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et turpis sed metus fermentum pellentesque. Vestibulum auctor neque ac nunc elementum malesuada. Praesent non est sed libero vestibulum consectetuer. Sed vehicula. Vivamus quis tellus sit amet erat ultrices luctus. Fusce a ligula. Fusce viverra libero vitae velit. Aenean bibendum nibh non lorem. Suspendisse quis velit. Integer sit amet lacus. Curabitur tristique. Morbi eu lectus. Vestibulum tristique aliquam quam. Sed neque.</p>\n', '2011-09-28 19:56:47', null, '30', 'y', '', '250000', '%:20', '', ''), ('331', 'Alysaw', 'WM01', '0.3', '6', null, '<p>\n	When sending data to the server, use this content-type. Default is &quot;application/x-www-form-urlencoded&quot;, which is fine for most cases. If you explicitly pass in a content-type to $.ajax() then it&#39;ll always be sent to the server (even if no data is sent). Data will always be transmitted to the server using UTF-8 charset; you must decode this appropriately on the server side.</p>\n', null, null, '31', 'y', '', '560000', '', '', ''), ('332', 'Anise Vintage', 'AN01', '0.2', '26', null, '<p style=\"text-align: center;\">\n	The jQuery documentation is great, very complete,</p>\n<p style=\"text-align: center;\">\n	nicely written and with a lot of examples and demos.</p>\n', null, null, '31', 'y', '', '670000', '', '', ''), ('333', 'Big Dolly', 'WM04', '0.2', '88', null, '<p>\n	Data to be sent to the server. It is converted to a query string, if not already a string. It&#39;s appended to the url for GET-requests. See processData option to prevent this automatic processing. Object must be Key/Value pairs. If value is an Array, jQuery serializes multiple values with same key based on the value of the traditional setting (described below).</p>\n', null, null, '31', 'y', '', '567000', '', '', ''), ('334', 'Short Bar', 'WM89', '0.2', '5', null, '<p>\n	A function to be called if the request fails. The function receives three arguments: The jqXHR (in jQuery 1.4.x, XMLHttpRequest) object, a string describing the type of error that occurred and an optional exception object, if one occurred. Possible values for the second argument (besides <code>null</code>) are <code>&quot;timeout&quot;</code>, <code>&quot;error&quot;</code>, <code>&quot;abort&quot;</code>, and <code>&quot;parsererror&quot;</code>. When an HTTP error occurs, <code>errorThrown</code> receives the textual portion of the HTTP status, such as &quot;Not Found&quot; or &quot;Internal Server Error.&quot; <strong>As of jQuery 1.5</strong>, the <code>error</code> setting can accept an array of functions. Each function will be called in turn. <strong>Note:</strong> <em>This handler is not called for cross-domain script and JSONP requests.</em> This is an <a href=\"http://docs.jquery.com/Ajax_Events\">Ajax Event</a>.</p>\n', null, null, '31', 'y', '', '750000', '', '', ''), ('335', 'Benedicte', 'WM05', '0.2', '5', null, '<p>\n	Allow the request to be successful only if the response has changed since the last request. This is done by checking the Last-Modified header. Default value is <code>false</code>, ignoring the header. In jQuery 1.4 this technique also checks the &#39;etag&#39; specified by the server to catch unmodified data.</p>\n', null, null, '31', 'y', '', '670000', '', '', ''), ('336', 'Boudoir', 'WM78', '0.2', '3', null, '<p>\n	Specify the callback function name for a JSONP request. This value will be used instead of the random name automatically generated by jQuery. It is preferable to let jQuery generate a unique name as it&#39;ll make it easier to manage the requests and provide callbacks and error handling. You may want to specify the callback when you want</p>\n', null, null, '31', 'y', '', '500000', '', '', ''), ('337', 'Britcardi', 'MN09', '0.3', '6', null, '<p>\n	By default, data passed in to the data option as an object (technically, anything other than a string) will be processed and transformed into a query string, fitting to the</p>\n', null, null, '30', 'y', '', '76000', '', '', ''), ('338', 'Flourish', 'MAN08', '0.3', '2', null, '<p>\n	A map of numeric HTTP codes and functions to be called when the response has the corresponding code. For example, the following will alert when the response status is a 404:</p>\n', null, null, '30', 'y', '', '567000', '', '', ''), ('339', 'Campbell', 'M890', '0.3', '8', null, '<p>\n	JSONP requests as expected should the request fail due to a timeout in Firefox 3.0+. This is a browser-based issue due to FF currently not providing a way to abort cross-domain requests once the script tag has been appended. This issue does not currently affect other browsers</p>\n', null, null, '30', 'y', '', '670000', '', '', ''), ('340', 'Casaknot', 'M560', '0.3', '75', null, '<p>\n	Callback for creating the XMLHttpRequest object. Defaults to the ActiveXObject when available (IE), the XMLHttpRequest otherwise. Override to provide your own implementation for XMLHttpRequest or enhancements to the factory.</p>\n', null, null, '30', 'y', '', '75000', '', '', ''), ('341', 'Chainette', 'M7850', '0.3', '20', null, '<p>\n	A map of fieldName-fieldValue pairs to set on the native <code><abbr title=\"XMLHttpRequest\">XHR</abbr></code> object. For example, you can use it to set <code>withCredentials</code> to <code>true</code> for cross-domain requests if needed.</p>\n', null, null, '30', 'y', '', '450000', '', '', ''), ('342', 'Clara', 'ACC87', '0.3', '61', null, '<p>\n	the <code>withCredentials</code> property was not propagated to the native <code>XHR</code> and thus CORS requests requiring it would ignore this flag. For this reason, we recommend using jQuery 1.5.1+ should you require the use of it.</p>\n', null, null, '32', 'y', '', '300000', '', '', ''), ('343', 'Dempsey', 'ACC89', '0.5', '53', null, '<p>\n	The jQuery XMLHttpRequest (jqXHR) object returned by <code>$.ajax()</code> <strong>as of jQuery 1.5</strong> is a superset of the browser&#39;s native XMLHttpRequest object. For example, it contains <code>responseText</code> and <code>responseXML</code> properties, as well as a <code>getResponseHeader()</code> method</p>\n', null, null, '32', 'y', '', '500000', '', '', ''), ('344', 'Kendrabrecelet', 'ACC45', '0.3', '0', null, '<p>\n	When the transport mechanism is something other than XMLHttpRequest (for example, a script tag for a JSONP request) the <code>jqXHR</code> object simulates native XHR functionality where possible.</p>\n', null, null, '32', 'y', '', '560000', '', '', ''), ('345', 'Tester Product', 'YU989', '0.33', '45', null, '<p>\n	orem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et turpis sed metus fermentum pellentesque. Vestibulum auctor neque ac nunc elementum malesuada. Praesent non est sed libero vestibulum consectetuer. Sed vehicula. Vivamus quis tellus sit amet erat ultrices luctus. Fusce a ligula. Fusce viverra libero vitae ve</p>\n', null, null, '31', 'y', '', '67000', '', '', ''), ('346', 'Vintage May', 'OT09', '0.33', '0', null, '<p>\n	Praesent non est sed libero vestibulum consectetuer. Sed vehicula. Vivamus quis tellus sit amet erat ultrices luctus. Fusce a ligula. Fusce viverra libero vitae velit. Aenean bibendum nibh non lorem. Suspendisse quis velit. Integer sit amet lacus.</p>\n', '2011-10-04 02:32:42', '2011-09-28 17:35:55', '30', 'y', '', '450000', '', '', '');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product_attrb`
-- ----------------------------
BEGIN;
INSERT INTO `store_product_attrb` VALUES ('131', '331', 'color:red;size:m', '', '0'), ('132', '331', 'color:blu;size:xl', '', '0'), ('133', '345', 'color:red;size:xl', '', '1'), ('134', '345', 'color:blue;size:m', '', '0');
COMMIT;

-- ----------------------------
--  Table structure for `store_product_label_tag`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_label_tag`;
CREATE TABLE `store_product_label_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `label_img` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_product_label_xref`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_label_xref`;
CREATE TABLE `store_product_label_xref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=340 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product_media`
-- ----------------------------
BEGIN;
INSERT INTO `store_product_media` VALUES ('267', '330', 'Right', 'alexandra2l.jpg', 'y', '0', '1'), ('268', '330', 'alexandra3l', 'alexandra3l.jpg', 'y', '0', '2'), ('269', '330', 'alexandra4l', 'alexandra4l.jpg', 'y', '0', '3'), ('270', '330', 'alexandra5l', 'alexandra5l.jpg', 'y', '0', '4'), ('271', '331', 'alysaw2l', 'alysaw2l.jpg', 'y', '0', '1'), ('272', '331', 'alysaw4l', 'alysaw4l.jpg', 'y', '0', '2'), ('273', '331', 'alysaw5l', 'alysaw5l.jpg', 'y', '0', '3'), ('274', '331', 'alysawhite1l', 'alysawhite1l.jpg', 'y', '0', '4'), ('276', '332', 'anise-vintage4l', 'anise-vintage4l.jpg', 'y', '0', '1'), ('277', '332', 'anise-vintage5l', 'anise-vintage5l.jpg', 'y', '0', '2'), ('278', '332', 'anisevintage1l', 'anisevintage1l.jpg', 'y', '0', '3'), ('279', '332', 'anisevintage2l', 'anisevintage2l.jpg', 'y', '0', '4'), ('280', '333', 'badut2l', 'badut2l.jpg', 'y', '0', '1'), ('281', '333', 'badut3l', 'badut3l.jpg', 'y', '0', '2'), ('282', '333', 'badut4l', 'badut4l.jpg', 'y', '0', '3'), ('283', '333', 'badut5l', 'badut5l.jpg', 'y', '0', '4'), ('284', '334', 'bar1l', 'bar1l.jpg', 'y', '0', '1'), ('285', '334', 'bar2l', 'bar2l.jpg', 'y', '0', '2'), ('286', '334', 'bar3l', 'bar3l.jpg', 'y', '0', '3'), ('287', '334', 'bar4l', 'bar4l.jpg', 'y', '0', '4'), ('292', '336', 'boudoir2l', 'boudoir2l.jpg', 'y', '0', '1'), ('289', '335', 'BENEDICET4l', 'BENEDICET4l.jpg', 'y', '0', '2'), ('290', '335', 'BENEDICTE1l', 'BENEDICTE1l.jpg', 'y', '0', '3'), ('291', '335', 'BENEDICTE2l', 'BENEDICTE2l.jpg', 'y', '0', '4'), ('293', '336', 'boudoir3l', 'boudoir3l.jpg', 'y', '0', '2'), ('294', '336', 'boudoir4l', 'boudoir4l.jpg', 'y', '0', '3'), ('303', '338', 'bunga3l', 'bunga3l.jpg', 'y', '0', '3'), ('301', '338', 'bunga1l', 'bunga1l.jpg', 'y', '0', '1'), ('302', '338', 'bunga2l', 'bunga2l.jpg', 'y', '0', '2'), ('298', '337', 'britcardi1l', 'britcardi1l.jpg', 'y', '0', '4'), ('299', '337', 'britcardi5l', 'britcardi5l.jpg', 'y', '0', '5'), ('300', '337', 'britcardibrown4l', 'britcardibrown4l.jpg', 'y', '0', '6'), ('304', '338', 'bunga4l', 'bunga4l.jpg', 'y', '0', '4'), ('313', '340', 'casa-knot-1l', 'casa-knot-1l.jpg', 'y', '0', '1'), ('314', '340', 'casaknot3l', 'casaknot3l.jpg', 'y', '0', '2'), ('315', '340', 'casaknot4l', 'casaknot4l.jpg', 'y', '0', '3'), ('316', '340', 'casaknot5l', 'casaknot5l.jpg', 'y', '0', '4'), ('309', '339', 'campbell1l', 'campbell1l.jpg', 'y', '0', '5'), ('310', '339', 'campbell2l', 'campbell2l.jpg', 'y', '0', '6'), ('311', '339', 'campbell4l', 'campbell4l.jpg', 'y', '0', '7'), ('312', '339', 'campbell5l', 'campbell5l.jpg', 'y', '0', '8'), ('321', '341', 'chainetteblue1l', 'chainetteblue1l.jpg', 'y', '0', '1'), ('318', '341', 'chainetteblue3l', 'chainetteblue3l.jpg', 'y', '0', '2'), ('319', '341', 'chainetteblue4l', 'chainetteblue4l.jpg', 'y', '0', '3'), ('320', '341', 'chainetteblue5l', 'chainetteblue5l.jpg', 'y', '0', '4'), ('322', '342', 'clara1l', 'clara1l.jpg', 'y', '0', '1'), ('323', '342', 'clara2l', 'clara2l.jpg', 'y', '0', '2'), ('324', '342', 'clara3l', 'clara3l.jpg', 'y', '0', '3'), ('332', '343', 'dempseybagd3large', 'dempseybagd3large.jpg', 'y', '0', '1'), ('326', '343', 'dempseybagd4large', 'dempseybagd4large.jpg', 'y', '0', '2'), ('327', '343', 'dempseybg-large', 'dempseybg-large.jpg', 'y', '0', '3'), ('328', '343', 'dempseyd2large', 'dempseyd2large.jpg', 'y', '0', '4'), ('329', '344', 'kendra2l', 'kendra2l.jpg', 'y', '0', '1'), ('330', '344', 'kendra3l', 'kendra3l.jpg', 'y', '0', '2'), ('331', '344', 'kendrabracelet1l', 'kendrabracelet1l.jpg', 'y', '0', '3'), ('333', '345', 'marveille1l', 'marveille1l.jpg', 'y', '0', '1'), ('334', '345', 'marveille2l', 'marveille2l.jpg', 'y', '0', '2'), ('335', '345', 'marveille3l', 'marveille3l.jpg', 'y', '0', '3'), ('336', '345', 'marveille4l', 'marveille4l.jpg', 'y', '0', '4'), ('337', '346', 'vintagemay1l', 'vintagemay1l.jpg', 'y', '0', '2'), ('338', '346', 'vintagemay3l', 'vintagemay3l.jpg', 'y', '0', '3'), ('339', '346', 'vintagemay4l', 'vintagemay4l.jpg', 'y', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `store_product_rel`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_rel`;
CREATE TABLE `store_product_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_own` int(11) NOT NULL,
  `p_rel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product_rel`
-- ----------------------------
BEGIN;
INSERT INTO `store_product_rel` VALUES ('57', '331', '330'), ('58', '330', '331'), ('59', '330', '332'), ('60', '332', '331'), ('61', '332', '330');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_waiting_restock`
-- ----------------------------
BEGIN;
INSERT INTO `store_waiting_restock` VALUES ('18', 'barockzid', null, null, '331', null, null, '2011-09-23 01:45:00'), ('19', 'ojankill', null, null, '331', null, null, '2011-09-23 01:46:51'), ('20', 'email or twittera', null, null, '331', null, null, '2011-09-23 01:49:10'), ('21', null, 'zidmubarock@gmail.com', null, '331', null, null, '2011-09-23 04:47:05'), ('22', 'alentalzid', null, null, '331', null, null, '2011-09-23 04:48:11'), ('23', 'as', null, null, '331', null, null, '2011-09-23 06:41:50'), ('24', 'asa', null, null, '330', null, null, '2011-09-23 06:43:47'), ('25', 'valentia', null, null, '331', null, null, '2011-09-23 15:04:32'), ('26', 'email or twitter', null, null, '330', null, null, '2011-09-23 16:40:30'), ('27', null, 'zidmubarock@gmail.com', null, '330', null, null, '2011-09-23 16:40:36'), ('28', 'baroczid', null, null, '330', null, null, '2011-09-24 05:12:44'), ('29', '45', null, null, '330', null, null, '2011-09-26 01:01:48'), ('30', 'barockzid', null, null, '330', null, null, '2011-09-28 20:22:44'), ('31', '12', null, null, '346', null, null, '2011-09-30 04:44:03');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', null, '2011-09-20 12:37:14', 'aca9fd21ff5e08cf88a3929ef5c4f346', 'owner', '100', 'Banten', 'Tangerang', '', '15132', 'jl. Angrrek Xi', '02165765', '', 'm', '0000-00-00'), ('2', 'capung_ungu@yahoo.com', 'Fransisca ', 'Agustini', null, '2011-09-24 06:07:01', 'db6ae64dfa9e78039db6df5b8edbc38c', 'owner', '0', 'Jakarta', 'jakarta', '', '15624', '', '', '', 'f', '0000-00-00'), ('43', 'alental@gmail.com', 'Valentia', 'Maniz', null, '2011-09-24 18:15:54', 'aca9fd21ff5e08cf88a3929ef5c4f346', 'user', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15124', 'Jl Anggrek XI Blok L4', '', '612121', 'f', '1989-02-14');
COMMIT;

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
