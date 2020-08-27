-- -------------------------------------------------------------
-- TablePlus 3.8.0(335)
--
-- https://tableplus.com/
--
-- Database: loveswapsy-db
-- Generation Time: 2020-08-27 16:18:33.3620
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `role` smallint(6) NOT NULL,
  `status` smallint(6) NOT NULL,
  `avatar_count` int(11) NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_visit_time` int(11) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `administrator_auth_assignment`;
CREATE TABLE `administrator_auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `administrator_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `administrator_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `administrator_auth_item`;
CREATE TABLE `administrator_auth_item` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `is_able_log` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `administrator_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `administrator_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `administrator_auth_item_child`;
CREATE TABLE `administrator_auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `administrator_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `administrator_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `administrator_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `administrator_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `administrator_auth_rule`;
CREATE TABLE `administrator_auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `administrator_login_history`;
CREATE TABLE `administrator_login_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `administrator_id` int(11) unsigned NOT NULL,
  `login_time` int(11) unsigned NOT NULL,
  `login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk-administrator_login_history-administrator_id` (`administrator_id`),
  CONSTRAINT `fk-administrator_login_history-administrator_id` FOREIGN KEY (`administrator_id`) REFERENCES `administrator` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `administrator_operation_log`;
CREATE TABLE `administrator_operation_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `index` varchar(50) DEFAULT NULL,
  `create_time` int(11) unsigned DEFAULT NULL,
  `logged_user_id` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;

INSERT INTO `administrator` (`id`, `user_id`, `username`, `first_name`, `last_name`, `auth_key`, `password_hash`, `email`, `email_verified`, `role`, `status`, `avatar_count`, `password_reset_token`, `last_visit_time`, `create_time`, `update_time`) VALUES
('1', '888', 'taoyu65', 'Tao', 'Yu', 'RWOuA6DzqYil-PCt4d4e2FyoB42VnjQ6', '$2y$13$k8/kSeSKp2sjNpomMkkAXOYvbrdxDWsDgWIFgDuz4SydpdqbiWaJm', 'taoyu65@gmail.com', '1', '10', '10', '0', NULL, NULL, '0', '1563737904');

INSERT INTO `administrator_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', '1560632662'),
('manager', '1', '1598557571');

INSERT INTO `administrator_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `is_able_log`) VALUES
('account-other/change-password', '2', 'account-other', NULL, NULL, '1560632662', '1560632662', '1'),
('account-other/setting', '2', 'account-other', NULL, NULL, '1560632662', '1560632662', '0'),
('admin', '1', 'admin', NULL, NULL, '1560632662', '1560632662', '0'),
('administrator/create', '2', 'administrator', NULL, NULL, '1578600632', '1578600632', '1'),
('administrator/index', '2', 'administrator', NULL, NULL, '1560632662', '1560632662', '0'),
('administrator/update', '2', 'administrator', NULL, NULL, '1560632662', '1560632662', '1'),
('administrator/view', '2', 'administrator', NULL, NULL, '1560632662', '1560632662', '1'),
('manager', '1', NULL, NULL, NULL, '1598500175', '1598500175', '0'),
('permission/able-log', '2', 'permission', NULL, NULL, '1565893316', '1565893316', '1'),
('permission/add-permission', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1'),
('permission/add-role', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1'),
('permission/add-user', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1'),
('permission/index', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '0'),
('permission/log', '2', 'permission', NULL, NULL, '1565893323', '1565893323', '0'),
('permission/remove-permission', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1'),
('permission/remove-role', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1'),
('permission/remove-user', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1'),
('permission/update-permission', '2', 'permission', NULL, NULL, '1560632664', '1560632664', '1');

INSERT INTO `administrator_auth_item_child` (`parent`, `child`) VALUES
('admin', 'account-other/change-password'),
('admin', 'account-other/setting'),
('admin', 'administrator/create'),
('admin', 'administrator/index'),
('admin', 'administrator/update'),
('admin', 'administrator/view'),
('admin', 'permission/able-log'),
('admin', 'permission/add-permission'),
('admin', 'permission/add-role'),
('admin', 'permission/add-user'),
('admin', 'permission/index'),
('admin', 'permission/log'),
('admin', 'permission/remove-permission'),
('admin', 'permission/remove-role'),
('admin', 'permission/remove-user'),
('admin', 'permission/update-permission');

INSERT INTO `administrator_operation_log` (`id`, `admin_id`, `action`, `index`, `create_time`, `logged_user_id`) VALUES
('1', '1', 'account-other', 'change-password', '1598390310', '0'),
('2', '1', 'account-other', 'change-password', '1598390319', '0'),
('3', '1', 'account-other', 'change-password', '1598391096', '0'),
('4', '1', 'account-other', 'change-password', '1598391125', '0'),
('5', '1', 'account-other', 'change-password', '1598391207', '0'),
('6', '1', 'account-other', 'change-password', '1598391242', '0'),
('7', '1', 'account-other', 'change-password', '1598391290', '0'),
('8', '1', 'account-other', 'change-password', '1598391327', '0'),
('9', '1', 'account-other', 'change-password', '1598391370', '0'),
('10', '1', 'account-other', 'change-password', '1598391411', '0'),
('11', '1', 'account-other', 'change-password', '1598391429', '0'),
('12', '1', 'account-other', 'change-password', '1598391432', '0'),
('13', '1', 'account-other', 'change-password', '1598391479', '0'),
('14', '1', 'account-other', 'change-password', '1598391494', '0'),
('15', '1', 'account-other', 'change-password', '1598391516', '0'),
('16', '1', 'account-other', 'change-password', '1598391541', '0'),
('17', '1', 'account-other', 'change-password', '1598391573', '0'),
('18', '1', 'account-other', 'change-password', '1598391738', '0'),
('19', '1', 'account-other', 'change-password', '1598391764', '0'),
('20', '1', 'account-other', 'change-password', '1598391792', '0'),
('21', '1', 'account-other', 'change-password', '1598391887', '0'),
('22', '1', 'account-other', 'change-password', '1598391896', '0'),
('23', '1', 'account-other', 'change-password', '1598391903', '0'),
('24', '1', 'account-other', 'change-password', '1598391955', '0'),
('25', '1', 'account-other', 'change-password', '1598392033', '0'),
('26', '1', 'account-other', 'change-password', '1598392038', '0'),
('27', '1', 'account-other', 'change-password', '1598392046', '0'),
('28', '1', 'account-other', 'change-password', '1598392070', '0'),
('29', '1', 'account-other', 'change-password', '1598392090', '0'),
('30', '1', 'account-other', 'change-password', '1598392115', '0'),
('31', '1', 'account-other', 'change-password', '1598392147', '0'),
('32', '1', 'account-other', 'change-password', '1598396109', '0'),
('33', '1', 'account-other', 'change-password', '1598396125', '0'),
('34', '1', 'account-other', 'change-password', '1598396169', '0'),
('35', '1', 'account-other', 'change-password', '1598396223', '0'),
('36', '1', 'account-other', 'change-password', '1598396308', '0'),
('37', '1', 'account-other', 'change-password', '1598396348', '0'),
('38', '1', 'account-other', 'change-password', '1598396403', '0'),
('39', '1', 'account-other', 'change-password', '1598396435', '0'),
('40', '1', 'account-other', 'change-password', '1598396530', '0'),
('41', '1', 'account-other', 'change-password', '1598396551', '0'),
('42', '1', 'account-other', 'change-password', '1598396627', '0'),
('43', '1', 'account-other', 'change-password', '1598396636', '0'),
('44', '1', 'account-other', 'change-password', '1598396864', '0'),
('45', '1', 'account-other', 'change-password', '1598396867', '0'),
('46', '1', 'account-other', 'change-password', '1598396883', '0'),
('47', '1', 'account-other', 'change-password', '1598396883', '0'),
('48', '1', 'account-other', 'change-password', '1598396890', '0'),
('49', '1', 'account-other', 'change-password', '1598396909', '0'),
('50', '1', 'account-other', 'change-password', '1598396926', '0'),
('51', '1', 'account-other', 'change-password', '1598397065', '0'),
('52', '1', 'account-other', 'change-password', '1598397085', '0'),
('53', '1', 'account-other', 'change-password', '1598397110', '0'),
('54', '1', 'account-other', 'change-password', '1598397174', '0'),
('55', '1', 'account-other', 'change-password', '1598397179', '0'),
('56', '1', 'account-other', 'change-password', '1598397215', '0'),
('57', '1', 'account-other', 'change-password', '1598397341', '0'),
('58', '1', 'account-other', 'change-password', '1598397358', '0'),
('59', '1', 'account-other', 'change-password', '1598397455', '0'),
('60', '1', 'account-other', 'change-password', '1598397555', '0'),
('61', '1', 'account-other', 'change-password', '1598397658', '0'),
('62', '1', 'account-other', 'change-password', '1598397791', '0'),
('63', '1', 'account-other', 'change-password', '1598397801', '0'),
('64', '1', 'account-other', 'change-password', '1598398619', '0'),
('65', '1', 'account-other', 'change-password', '1598398627', '0'),
('66', '1', 'account-other', 'change-password', '1598398663', '0'),
('67', '1', 'account-other', 'change-password', '1598398685', '0'),
('68', '1', 'account-other', 'change-password', '1598398842', '0'),
('69', '1', 'account-other', 'change-password', '1598398851', '0'),
('70', '1', 'account-other', 'change-password', '1598398958', '0'),
('71', '1', 'account-other', 'change-password', '1598398975', '0'),
('72', '1', 'account-other', 'change-password', '1598399078', '0'),
('73', '1', 'account-other', 'change-password', '1598399094', '0'),
('74', '1', 'account-other', 'change-password', '1598399156', '0'),
('75', '1', 'account-other', 'change-password', '1598399170', '0'),
('76', '1', 'account-other', 'change-password', '1598399333', '0'),
('77', '1', 'account-other', 'change-password', '1598399348', '0'),
('78', '1', 'account-other', 'change-password', '1598399741', '0'),
('79', '1', 'account-other', 'change-password', '1598399902', '0'),
('80', '1', 'account-other', 'change-password', '1598399909', '0'),
('81', '1', 'account-other', 'change-password', '1598399988', '0'),
('82', '1', 'account-other', 'change-password', '1598400042', '0'),
('83', '1', 'account-other', 'change-password', '1598400056', '0'),
('84', '1', 'account-other', 'change-password', '1598400068', '0'),
('85', '1', 'account-other', 'change-password', '1598400133', '0'),
('86', '1', 'account-other', 'change-password', '1598400362', '0'),
('87', '1', 'account-other', 'change-password', '1598400480', '0'),
('88', '1', 'account-other', 'change-password', '1598400551', '0'),
('89', '1', 'account-other', 'change-password', '1598400675', '0'),
('90', '1', 'account-other', 'change-password', '1598400761', '0'),
('91', '1', 'account-other', 'change-password', '1598400791', '0'),
('92', '1', 'account-other', 'change-password', '1598400854', '0'),
('93', '1', 'account-other', 'change-password', '1598400866', '0'),
('94', '1', 'account-other', 'change-password', '1598400878', '0'),
('95', '1', 'account-other', 'change-password', '1598400898', '0'),
('96', '1', 'account-other', 'change-password', '1598401043', '0'),
('97', '1', 'account-other', 'change-password', '1598401927', '0'),
('98', '1', 'account-other', 'change-password', '1598411513', '0'),
('99', '1', 'account-other', 'change-password', '1598478688', '0'),
('100', '1', 'account-other', 'change-password', '1598479079', '0'),
('101', '1', 'account-other', 'change-password', '1598479086', '0'),
('102', '1', 'account-other', 'change-password', '1598484581', '0'),
('103', '1', 'account-other', 'change-password', '1598485109', '0'),
('104', '1', 'account-other', 'change-password', '1598485192', '0'),
('105', '1', 'account-other', 'change-password', '1598485201', '0'),
('106', '1', 'account-other', 'change-password', '1598485307', '0'),
('107', '1', 'account-other', 'change-password', '1598485369', '0'),
('108', '1', 'account-other', 'change-password', '1598485542', '0'),
('109', '1', 'account-other', 'change-password', '1598485612', '0'),
('110', '1', 'account-other', 'change-password', '1598485817', '0'),
('111', '1', 'account-other', 'change-password', '1598485886', '0'),
('112', '1', 'account-other', 'change-password', '1598485897', '0'),
('113', '1', 'account-other', 'change-password', '1598485917', '0'),
('114', '1', 'account-other', 'change-password', '1598485938', '0'),
('115', '1', 'account-other', 'change-password', '1598485950', '0'),
('116', '1', 'account-other', 'change-password', '1598486040', '0'),
('117', '1', 'account-other', 'change-password', '1598486086', '0'),
('118', '1', 'account-other', 'change-password', '1598486125', '0'),
('119', '1', 'account-other', 'change-password', '1598486138', '0'),
('120', '1', 'account-other', 'change-password', '1598486161', '0'),
('121', '1', 'account-other', 'change-password', '1598486167', '0'),
('122', '1', 'account-other', 'change-password', '1598486223', '0'),
('123', '1', 'account-other', 'change-password', '1598486355', '0'),
('124', '1', 'account-other', 'change-password', '1598486389', '0'),
('125', '1', 'account-other', 'change-password', '1598486420', '0'),
('126', '1', 'account-other', 'change-password', '1598486471', '0'),
('127', '1', 'account-other', 'change-password', '1598486679', '0'),
('128', '1', 'account-other', 'change-password', '1598487070', '0'),
('129', '1', 'account-other', 'change-password', '1598487075', '0'),
('130', '1', 'account-other', 'change-password', '1598487084', '0'),
('131', '1', 'account-other', 'change-password', '1598487112', '0'),
('132', '1', 'account-other', 'change-password', '1598487115', '0'),
('133', '1', 'account-other', 'change-password', '1598487124', '0'),
('134', '1', 'account-other', 'change-password', '1598487217', '0'),
('135', '1', 'account-other', 'change-password', '1598487454', '0'),
('136', '1', 'account-other', 'change-password', '1598487465', '0'),
('137', '1', 'account-other', 'change-password', '1598487470', '0'),
('138', '1', 'account-other', 'change-password', '1598487861', '0'),
('139', '1', 'account-other', 'change-password', '1598489187', '0'),
('140', '1', 'account-other', 'change-password', '1598489269', '0'),
('141', '1', 'account-other', 'change-password', '1598490226', '0'),
('142', '1', 'account-other', 'change-password', '1598490428', '0'),
('143', '1', 'account-other', 'change-password', '1598490430', '0'),
('144', '1', 'account-other', 'change-password', '1598490587', '0'),
('145', '1', 'permission', 'remove-role', '1598499964', '0'),
('146', '1', 'permission', 'remove-role', '1598499976', '0'),
('147', '1', 'permission', 'remove-role', '1598500051', '0'),
('148', '1', 'permission', 'remove-role', '1598500088', '0'),
('149', '1', 'permission', 'add-role', '1598500175', '0'),
('150', '1', 'permission', 'add-role', '1598500209', '0'),
('151', '1', 'permission', 'add-role', '1598554407', '0'),
('152', '1', 'permission', 'update-permission', '1598555531', '0'),
('153', '1', 'permission', 'update-permission', '1598555553', '0'),
('154', '1', 'permission', 'add-user', '1598555570', '0'),
('155', '1', 'permission', 'remove-user', '1598557460', '0'),
('156', '1', 'permission', 'remove-user', '1598557470', '0'),
('157', '1', 'permission', 'remove-user', '1598557477', '0'),
('158', '1', 'permission', 'add-user', '1598557495', '0'),
('159', '1', 'permission', 'add-user', '1598557497', '0'),
('160', '1', 'permission', 'add-user', '1598557501', '0'),
('161', '1', 'permission', 'remove-user', '1598557511', '0'),
('162', '1', 'permission', 'add-user', '1598557565', '0'),
('163', '1', 'permission', 'add-user', '1598557571', '0'),
('164', '1', 'permission', 'remove-role', '1598557581', '0'),
('165', '1', 'permission', 'able-log', '1598560559', '0'),
('166', '1', 'permission', 'able-log', '1598560561', '0'),
('167', '1', 'permission', 'able-log', '1598560563', '0'),
('168', '1', 'permission', 'able-log', '1598560569', '0'),
('169', '1', 'permission', 'able-log', '1598560577', '0'),
('170', '1', 'permission', 'able-log', '1598560577', '0'),
('171', '1', 'account-other', 'change-password', '1598561152', '0'),
('172', '1', 'account-other', 'change-password', '1598561234', '0'),
('173', '1', 'account-other', 'change-password', '1598561243', '0'),
('174', '1', 'account-other', 'change-password', '1598561314', '0'),
('175', '1', 'account-other', 'change-password', '1598561324', '0'),
('176', '1', 'administrator', 'view', '1598561645', '0'),
('177', '1', 'administrator', 'view', '1598561663', '0'),
('178', '1', 'administrator', 'view', '1598561679', '0'),
('179', '1', 'administrator', 'view', '1598561722', '0'),
('180', '1', 'administrator', 'update', '1598561803', '0'),
('181', '1', 'administrator', 'view', '1598561803', '0'),
('182', '1', 'administrator', 'view', '1598561830', '0'),
('183', '1', 'administrator', 'view', '1598561917', '0'),
('184', '1', 'administrator', 'view', '1598561976', '0'),
('185', '1', 'account-other', 'change-password', '1598561999', '0'),
('186', '1', 'administrator', 'view', '1598562003', '0'),
('187', '1', 'administrator', 'view', '1598562056', '0'),
('188', '1', 'administrator', 'update', '1598562063', '0'),
('189', '1', 'administrator', 'view', '1598562064', '0'),
('190', '1', 'administrator', 'update', '1598562552', '0'),
('191', '1', 'administrator', 'view', '1598562573', '0'),
('192', '1', 'administrator', 'update', '1598562583', '0'),
('193', '1', 'administrator', 'update', '1598562588', '0'),
('194', '1', 'administrator', 'view', '1598562638', '0'),
('195', '1', 'administrator', 'view', '1598562658', '0'),
('196', '1', 'administrator', 'view', '1598562694', '0'),
('197', '1', 'administrator', 'update', '1598562726', '0'),
('198', '1', 'administrator', 'view', '1598562727', '0'),
('199', '1', 'administrator', 'view', '1598569588', '0'),
('200', '1', 'administrator', 'update', '1598569726', '0'),
('201', '1', 'administrator', 'update', '1598569888', '0'),
('202', '1', 'administrator', 'view', '1598569931', '0'),
('203', '1', 'administrator', 'update', '1598569959', '0'),
('204', '1', 'administrator', 'view', '1598569960', '0'),
('205', '1', 'administrator', 'update', '1598569997', '0'),
('206', '1', 'administrator', 'update', '1598570087', '0'),
('207', '1', 'administrator', 'view', '1598570089', '0'),
('208', '1', 'account-other', 'change-password', '1598570127', '0'),
('209', '1', 'permission', 'remove-role', '1598570154', '0');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;