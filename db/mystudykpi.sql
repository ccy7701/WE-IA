-- SQL QUERIES FOR MYSTUDYKPI DATABASE

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
(1, 2, 1, 1, "TEST_ACTIVITY_DETAILS", "TEST_ACTIVITY_REMARKS", "", 11),
(1, 2, 2, 1, "TEST_CLUB_DETAILS", "TEST_CLUB_REMARKS", "", 11),
(1, 2, 3, 1, "TEST_ASSOCIATION_DETAILS", "TEST_ASSOCIATION_REMARKS", "", 11),
(1, 2, 4, 1, "TEST_COMPETITION_DETAILS", "TEST_COMPETITION_REMARKS", "", 11);

-- Table structure for indicator

DROP TABLE IF EXISTS indicator;
CREATE TABLE IF NOT EXISTS indicator (
	indicatorID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	indicatorSem int,
	indicatorYear int,
	indicatorCGPA float,
	/*indicatorActCount can be obtained by doing query on 'activity' WHERE activityType = 1 or 2 or 3 */
	/*indicatorCompCount can be obtained by doing query on 'activity' WHERE activityType = 4 */
	indicatorLeadership int,
	indicatorGraduateAim varchar(32), /* as in On Time, or Delayed, or Ahead of Schedule */
	indicatorProfCert int,
	indicatorEmployability int, /* as in months after industrial training */
	indicatorMobProg int,
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data dump for indicator

INSERT INTO indicator (indicatorSem, indicatorYear, indicatorCGPA, indicatorLeadership, indicatorGraduateAim, indicatorProfCert, indicatorEmployability, indicatorMobProg, accountID) VALUES
(1, 1, 3.56, 1, 'On Time', 1, 6, 1, 11),
(2, 1, 3.50, 1, 'On Time', 1, 6, 1, 11),
(1, 2, 3.43, 1, 'On Time', 1, 6, 1, 11),
(2, 2, 3.00, 1, 'On Time', 1, 6, 1, 11),
(1, 3, 2.95, 1, 'On Time', 1, 6, 1, 11),
(2, 3, 3.92, 1, 'On Time', 1, 6, 1, 11),
(1, 4, 3.87, 1, 'On Time', 1, 6, 1, 11),
(2, 4, 3.78, 1, 'On Time', 1, 6, 1, 11);