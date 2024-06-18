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

 Date: 18/06/2024 16:22:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for club_student
-- ----------------------------
DROP TABLE IF EXISTS `club_student`;
CREATE TABLE `club_student`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `studentid` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `clubid` int NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_student_club`(`studentid` ASC, `clubid` ASC) USING BTREE,
  INDEX `clubid`(`clubid` ASC) USING BTREE,
  CONSTRAINT `club_student_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `club_student_ibfk_2` FOREIGN KEY (`clubid`) REFERENCES `clubs` (`clubid`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of club_student
-- ----------------------------
INSERT INTO `club_student` VALUES (5, '52213122387', 3, 'Member', '2024-06-18');
INSERT INTO `club_student` VALUES (6, '52213122387', 4, 'Member', '2024-06-18');

-- ----------------------------
-- Table structure for clubs
-- ----------------------------
DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs`  (
  `clubid` int NOT NULL AUTO_INCREMENT,
  `club_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `club_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`clubid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of clubs
-- ----------------------------
INSERT INTO `clubs` VALUES (1, 'Software Engineering & Programming Club', 'Dive into the dynamic world of coding and innovation with UniKL MIIT\'s Software Engineering & Programming Club! We are a vibrant community of tech enthusiasts, coders, and future software engineers dedicated to pushing the boundaries of technology. Whether you\'re a seasoned programmer or just starting, our club offers a platform to enhance your skills, collaborate on exciting projects, and connect with industry experts. Join us to explore cutting-edge technologies, participate in hackathons, and turn your ideas into reality. Elevate your university experience and shape the future of tech with us!');
INSERT INTO `clubs` VALUES (2, 'UniKL MIIT\'s Futsal (Male) Club', 'Join the UniKL MIIT Futsal (Male) Club and immerse yourself in the thrill of the game! Our club is dedicated to fostering sportsmanship, teamwork, and athleticism among students. Whether you\'re a seasoned player or just starting out, our inclusive environment welcomes all skill levels. Expect exhilarating matches, rigorous training sessions, and opportunities to compete in intervarsity tournaments. Beyond the field, we prioritize camaraderie and personal growth, creating lasting friendships and unforgettable experiences. Discover your potential with UniKL MIIT\'s Futsal (Male) Club and become part of our winning team today!');
INSERT INTO `clubs` VALUES (3, 'Developer Studenet Clubs by Google Developers', 'Developer Student Clubs (DSC) UniKL by Google Developers are developers and leaders community group supported by Google via the Google Developers. It is the first step and part of the developers\' ecosystem, bridging the gap between theoretical knowledge and real-world application.');
INSERT INTO `clubs` VALUES (4, 'Sekretariat Rukun Negara Club', 'The Sekretariat Rukun Negara (SRN) is one of the co-curricular activities carried out in Higher Education Institutions. In line with its name, most of the activities carried out through this secretariat aim to instill and promote the values and principles outlined in the Rukun Negara, Malaysia\'s national philosophy. These activities include community service projects, cultural events, educational seminars, and discussions on national unity and patriotism. By participating in SRN, students not only enhance their understanding of the Rukun Negara but also develop a sense of civic responsibility, leadership skills, and a deeper appreciation for Malaysia\'s diverse cultural heritage.');

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
  `progress` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_student_course`(`studentid` ASC, `course_id` ASC) USING BTREE,
  INDEX `course_id`(`course_id` ASC) USING BTREE,
  CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_course
-- ----------------------------
INSERT INTO `student_course` VALUES (1, '52213122387', 1, 'L01', 'L01-B02', '80');
INSERT INTO `student_course` VALUES (2, '52213122387', 2, 'L01', 'L01-B01', '23');
INSERT INTO `student_course` VALUES (3, '52213122387', 3, 'L01', 'L01-B01', '87');
INSERT INTO `student_course` VALUES (4, '52213122387', 4, 'L01', 'L01-B01', '45');
INSERT INTO `student_course` VALUES (5, '52213122387', 5, 'L01', 'L01-B01', '67');
INSERT INTO `student_course` VALUES (6, '52213122387', 6, 'L02', '', '43');
INSERT INTO `student_course` VALUES (7, '52215122117', 7, 'L02', 'L02-T01', '23');
INSERT INTO `student_course` VALUES (8, '52215122117', 8, 'L01', 'L01-B01', '87');
INSERT INTO `student_course` VALUES (9, '52215122117', 9, 'L01', 'L01-B01', '12');
INSERT INTO `student_course` VALUES (10, '52215122117', 10, 'L01', 'L01-B01', '55');
INSERT INTO `student_course` VALUES (11, '52215122117', 5, 'L03', 'L03-T02', '37');
INSERT INTO `student_course` VALUES (12, '52215122117', 6, 'L02', '', '54');

SET FOREIGN_KEY_CHECKS = 1;
