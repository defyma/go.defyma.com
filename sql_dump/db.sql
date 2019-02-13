/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : shorturl

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 13/02/2019 21:16:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_click
-- ----------------------------
DROP TABLE IF EXISTS `t_click`;
CREATE TABLE `t_click`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_link` int(11) NOT NULL,
  `click_date` datetime(0) NOT NULL,
  `click_ip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `browser` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_link`(`id_link`) USING BTREE,
  CONSTRAINT `t_click_ibfk_1` FOREIGN KEY (`id_link`) REFERENCES `t_link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_hash
-- ----------------------------
DROP TABLE IF EXISTS `t_hash`;
CREATE TABLE `t_hash`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_link` int(11) NOT NULL,
  `hash` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_link`(`id_link`) USING BTREE,
  CONSTRAINT `t_hash_ibfk_1` FOREIGN KEY (`id_link`) REFERENCES `t_link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_link
-- ----------------------------
DROP TABLE IF EXISTS `t_link`;
CREATE TABLE `t_link`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_date` datetime(0) NOT NULL,
  `created_ip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 100 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
