-- SQL QUERIES FOR MYSTUDYKPI DATABASE

START TRANSACTION;

-- Database: 'mystudykpidb'

-- Table structure for STUDENT_PROFILE

DROP TABLE IF EXISTS student_profile;
CREATE TABLE IF NOT EXISTS student_profile (
	student_id varchar(12) PRIMARY KEY,
	student_name varchar(128),
	student_program varchar(4),
	student_email varchar(64),
	student_intakebatch int,
	student_phone varchar(16),
	student_mentor varchar(128),
	student_state varchar(4),
	student_address varchar(192),
	student_motto varchar(192)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table 'whateverItIsNamed'

INSERT INTO student_profile (student_id, student_name, student_program, student_email, student_intakebatch, student_phone, student_mentor, student_state, student_address, student_motto) VALUES
('BI21110236', 'Chiew Cheng Yi', 'HC00', 'test@email.com', 2021, '0142704730', 'Dr. Syamsul', 'SBH', 'Kota Kinabalu', 'I am just testing this database.');