-- SQL QUERIES FOR MYSTUDYKPI DATABASE

-- CREATE DATABASE mystudykpi;

START TRANSACTION;

-- Database: 'mystudykpi'

-- Table structure for account

DROP TABLE IF EXISTS account;
CREATE TABLE IF NOT EXISTS account (
	accountID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	matricNumber varchar(12) NOT NULL,
	accountEmail varchar(128) NOT NULL UNIQUE,
	accountPwd varchar(255) NOT NULL,
	accountRoles int NOT NULL DEFAULT 2 COMMENT '1 - Admin, 2 - User',
	registrationDate date NOT NULL DEFAULT CURRENT_DATE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data entries for account

INSERT INTO account (matricNumber, accountEmail, accountPwd, accountRoles) VALUES
('BI21110236', 'chiew_cheng_bi21@iluv.ums.edu.my', '$2y$10$tgizLoDffy4HEMviHFsMwet3/Nk3PaTIv9Lj4XR0qujRM//BO6CvK', 2), -- unhashed password is testTEST123!
('BI23110001', 'just_testing@iluv.ums.edu.my', '$2y$10$NTyLlG1dJL4LCXzzVLwACe2GhUYg9tRBW04sn7wZO9fyFoVpNW6da', 2); -- unhashed password is myPassword123!

-- Table structure for profile

DROP TABLE IF EXISTS profile;
CREATE TABLE IF NOT EXISTS profile (
	profileID int PRIMARY KEY AUTO_INCREMENT,
	username varchar(255),
	program varchar(4),
	intakeBatch int,
	phoneNumber varchar(20),
	mentor varchar(255),
	profileState varchar(64),
	profileAddress varchar(255),
	motto varchar(255),
	profileImagePath varchar(255),
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data entries for profile

INSERT INTO profile (username, program, intakeBatch, phoneNumber, mentor, profileState, profileAddress, motto, profileImagePath, accountID) VALUES
('Chiew Cheng Yi', 'hc00', 2021, '0123456789', 'Dr. Samsul Ariffin bin Abdul Karim', 'Sabah', 'Kolombong, Kota Kinabalu', 'The secret to getting ahead is getting started.', 'uploads/profile_images/1_chiew.png', 1),
('Just Testing', 'hc05', 2023, '0198765000', 'Dr. Suraya Alias', 'Sarawak', 'Kuching, Sarawak', 'Test it until you make it.', 'uploads/profile_images/2_justTesting.jpg', 2);

-- Table structure for challenge

DROP TABLE IF EXISTS challenge;
CREATE TABLE IF NOT EXISTS challenge (
	challengeID int PRIMARY KEY AUTO_INCREMENT,
	challengeSem int,
	challengeYear varchar(16),
	challengeDetails varchar(255),
	challengeFuturePlan varchar(255),
	challengeRemark varchar(255),
	challengeImagePath varchar(255),
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data entries for challenge
INSERT INTO challenge (challengeSem, challengeYear, challengeDetails, challengeFuturePlan, challengeRemark, challengeImagePath, accountID) VALUES
(1, '2021/2022', 'Do not know much about programming', 'More self study using online resources', 'No remarks', '', 1),
(2, '2021/2022', 'Thinking C++ is hard', 'Read a C++ textbook', 'Image inserted', 'uploads/challenges/2_someCode.png', 1);

-- Table structure for activity

DROP TABLE IF EXISTS activity;
CREATE TABLE IF NOT EXISTS activity (
	activityID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	activitySem int,
	activityYear int,
	activityType varchar(4) COMMENT '1 - Activity, 2 - Club, 3 - Association, 4 - Competition',
	activityLevel varchar(4) COMMENT '1 - Faculty, 2 - University, 3 - National, 4 - International',
	activityDetails varchar(255),
	activityRemarks varchar(255),
    activityImagePath varchar(255),
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data dump for activity

INSERT INTO activity (activitySem, activityYear, activityType, activityLevel, activityDetails, activityRemarks, activityImagePath, accountID) VALUES
(1, 1, 1, 1, "Activity at my faculty", "No remarks", '', 1),
(1, 2, 3, 2, "Activiy at PMFKI, university level", "No remarks", '', 1),
(1, 3, 4, 3, "Joined a coding competition", "Won a small trophy", 'uploads/activities/3_trophy.png', 1);

-- Table structure for indicator

DROP TABLE IF EXISTS indicator;
CREATE TABLE IF NOT EXISTS indicator (
	indicatorID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	indicatorSem int,
	indicatorYear int,
	indicatorCGPA float,
	indicatorLeadership int,
	indicatorGraduateAim varchar(32), /* as in On Time, or Delayed, or Ahead of Schedule */
	indicatorProfCert int,
	indicatorEmployability int, /* as in months after industrial training */
	indicatorMobProg int,
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data dump for indicator

INSERT INTO indicator (indicatorSem, indicatorYear, indicatorCGPA, indicatorLeadership, indicatorGraduateAim, indicatorProfCert, indicatorEmployability, indicatorMobProg, accountID) VALUES
(1, 1, 3.56, 1, 'On Time', 1, 6, 1, 1),
(2, 1, 3.50, 1, 'On Time', 1, 6, 1, 1),
(1, 2, 3.43, 1, 'On Time', 1, 6, 1, 1),
(2, 2, 3.00, 1, 'On Time', 1, 6, 1, 1),
(1, 3, 2.95, 1, 'On Time', 1, 6, 1, 1),
(2, 3, 3.92, 1, 'On Time', 1, 6, 1, 1),
(1, 4, 3.87, 1, 'On Time', 1, 6, 1, 1),
(2, 4, 3.78, 1, 'On Time', 1, 6, 1, 1);
INSERT INTO indicator (indicatorSem, indicatorYear, indicatorCGPA, indicatorLeadership, indicatorGraduateAim, indicatorProfCert, indicatorEmployability, indicatorMobProg, accountID) VALUES
(1, 1, 3.57, 1, 'On Time', 1, 6, 1, 2),
(2, 1, 3.40, 1, 'On Time', 1, 6, 1, 2),
(1, 2, 3.82, 1, 'On Time', 1, 6, 1, 2),
(2, 2, 2.77, 1, 'On Time', 1, 6, 1, 2),
(1, 3, 3.00, 1, 'On Time', 1, 6, 1, 2),
(2, 3, 3.29, 1, 'On Time', 1, 6, 1, 2),
(1, 4, 3.78, 1, 'On Time', 1, 6, 1, 2),
(2, 4, 4.00, 1, 'On Time', 1, 6, 1, 2);