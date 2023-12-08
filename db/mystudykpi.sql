-- SQL QUERIES FOR MYSTUDYKPI DATABASE

START TRANSACTION;

-- Database: 'mystudykpidb'

-- Table structure for student_profile

DROP TABLE IF EXISTS student_profile;
CREATE TABLE IF NOT EXISTS student_profile (
	student_id varchar(12) PRIMARY KEY,
	student_name varchar(256),
	student_password varchar(256),
	student_program varchar(4),
	student_email varchar(64),
	student_intakebatch int,
	student_phone varchar(16),
	student_mentor varchar(256),
	student_state varchar(64),
	student_address varchar(256),
	student_motto varchar(256),
	student_imgpath varchar(256)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- Data dump for student_profile

INSERT INTO student_profile (student_id, student_name, student_password, student_program, student_email, student_intakebatch,
student_phone, student_mentor, student_state, student_address, student_motto, student_imgpath) VALUES
('BI21110236', 'Chiew Cheng Yi', 'unhashed', 'hc00', 'chiew_cheng_bi21@iluv.ums.edu.my', 2021, '0142704730', 'Dr. Syamsul', 'Sabah', 
'Kolombong, 88450 Kota Kinabalu', 'The secret to getting ahead is getting started.', 'uploads/student_profile_imgs/chiew.png'),
('BI23110001', 'Welt Yang', 'alsounhashed', 'hc05', 'welt_yang_bi23@iluv.ums.edu.my', 2023, '01234567890', 'Dr. Florence', 'Sabah',
'Astral Express, Milky Way', 'Work is a very worthwhile thing. It brings dreams to life.', 'uploads/student_profile_imgs/welt.jpeg');

DROP TABLE IF EXISTS activity;
CREATE TABLE IF NOT EXISTS activity (
	activity_index int PRIMARY KEY AUTO_INCREMENT,
	activity_sem int,
	activity_year varchar(12),
	activity_name varchar(256),
	activity_remarks varchar(256),
	student_id varchar(12),
	FOREIGN KEY (student_id) REFERENCES student_profile(student_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- Data dump for activity

INSERT INTO activity (activity_sem, activity_year, activity_name, activity_remarks, student_id) VALUES
(1, '2021/2022', 'Resume Writing Workshop - UMS SPRINT event for EK00703 Pidato', 'Member of technical committee', 'BI21110236'),
(2, '2022/2023', 'Into The Industry 3.0 S1', 'Participant', 'BI21110236'),
(1, '2023/2024', 'BIMP-EAGA Cybersecurity Summit', 'Participant', 'BI21110236'),
(1, '2023/2024', 'MyStartup NXT', 'Participant', 'BI21110236'),
(1, '2023/2024', 'Expedition of Belobog', 'Spectator', 'BI23110001');

