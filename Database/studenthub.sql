/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : studenthub

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 18/06/2024 02:44:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `course_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `credit_hour` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES (1, 'ISB26504', 'Software Design and Integration', 4);
INSERT INTO `course` VALUES (2, 'ISB26603', 'Mobile and Ubiquitous Computing', 3);
INSERT INTO `course` VALUES (3, 'ISB42603', 'Web Application Development', 3);
INSERT INTO `course` VALUES (4, 'ISB46803', 'Advanced Programming', 3);
INSERT INTO `course` VALUES (5, 'MPU3242', 'Innovation Management', 2);
INSERT INTO `course` VALUES (6, 'WKD10101', 'Korean Language 1', 1);
INSERT INTO `course` VALUES (7, 'IDB30303', 'IT Project Management', 3);
INSERT INTO `course` VALUES (8, 'IKB21103', 'Operating System Security', 3);
INSERT INTO `course` VALUES (9, 'IKB21204', 'Secure Software Development', 4);
INSERT INTO `course` VALUES (10, 'INB23304', 'Network Security', 4);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `studentid` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level_of_study` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `programme` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `institute` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semester` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`studentid`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('52213122387', 'haziq.aziz19@s.unikl.edu.my', 'Ahmad Haziq Bin Abdul Aziz', '019-4110974', 'Bachelor', 'Bachelor of Information Technology (Hons) In Software Engineering', 'Malaysian Institute of Information Technology', '4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO `student` VALUES ('52215122117', 'hannan.hakimi@s.unikl.edu.my', 'Hannan Hakimi Bin Mazeri', '017-9200611', 'Bachelor', 'Bachelor of Information Technology (Hons) In Computer System Security', 'Malaysian Institute of Information Technology', '4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- ----------------------------
-- Table structure for student_course
-- ----------------------------
DROP TABLE IF EXISTS `student_course`;
CREATE TABLE `student_course`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `studentid` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_id` int NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lab_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_student_course`(`studentid` ASC, `course_id` ASC) USING BTREE,
  INDEX `course_id`(`course_id` ASC) USING BTREE,
  CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_course
-- ----------------------------
INSERT INTO `student_course` VALUES (1, '52213122387', 1, 'L01', 'L01-B02');
INSERT INTO `student_course` VALUES (2, '52213122387', 2, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (3, '52213122387', 3, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (4, '52213122387', 4, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (5, '52213122387', 5, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (6, '52213122387', 6, 'L02', '');
INSERT INTO `student_course` VALUES (7, '52215122117', 7, 'L02', 'L02-T01');
INSERT INTO `student_course` VALUES (8, '52215122117', 8, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (9, '52215122117', 9, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (10, '52215122117', 10, 'L01', 'L01-B01');
INSERT INTO `student_course` VALUES (11, '52215122117', 5, 'L03', 'L03-T02');
INSERT INTO `student_course` VALUES (12, '52215122117', 6, 'L02', '');

SET FOREIGN_KEY_CHECKS = 1;
