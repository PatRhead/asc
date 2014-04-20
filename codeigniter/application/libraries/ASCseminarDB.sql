DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Seminars;
DROP TABLE IF EXISTS Request;
DROP TABLE IF EXISTS College;
DROP TABLE IF EXISTS Col_Contact;
DROP TABLE IF EXISTS Logging;
DROP TABLE IF EXISTS Location;

CREATE TABLE Student(
	s_id int(5) NOT NULL AUTO_INCREMENT,
	Fname varchar(20) NOT NULL,
	Lname varchar(20) NOT NULL,
	password varchar(20) NOT NULL,
	salt char(15) NOT NULL,
	student_password varchar(65) NOT NULL,
	Phone varchar(20),
	Email varchar(23) NOT NULL,
	College varchar(50) NOT NULL,
	PRIMARY KEY (s_id)
);

CREATE TABLE Admin(
	a_id int(5) NOT NULL AUTO_INCREMENT,
	username varchar(20) NOT NULL,
	password varchar(65) NOT NULL,
	email varchar(23) NOT NULL,
	PRIMARY KEY (a_id)
);

CREATE TABLE Faculty(
	f_id int(5) NOT NULL AUTO_INCREMENT,
	Fname varchar(20) NOT NULL,
	Lname varchar(20) NOT NULL,
	faculty_password varchar(20) NOT NULL,
	salt char(15) NOT NULL,
	Phone varchar(20),
	Email varchar(23) NOT NULL,
	College varchar(50) NOT NULL,
	PRIMARY KEY (f_id)
);

CREATE TABLE Request(
	r_id int NOT NULL AUTO_INCREMENT,
	user_id varchar(5) NOT NULL,
	Description varchar(255) NOT NULL,
	PRIMARY KEY (r_id)
);

CREATE TABLE College(
	c_id int(5) NOT NULL AUTO_INCREMENT,
	College varchar(50) NOT NULL,
	Contact	varchar(40),
	PRIMARY KEY (c_id)
);

CREATE Table Col_Contact(
	cc_id int(5) NOT NULL AUTO_INCREMENT,
	Fname varchar(20) NOT NULL,
	Lname varchar(20) NOT NULL,
	Email varchar(23) NOT NULL,
	Phone varchar(20),
	College varchar(50) NOT NULL,
	PRIMARY KEY (cc_id)
);

CREATE TABLE Location(
	l_id int(5) NOT NULL AUTO_INCREMENT,
	Building varchar(20) NOT NULL,
	Rm_num varchar(5) NOT NULL,
	Capacity int(5) NOT NULL,
	PRIMARY KEY (l_id)

);

CREATE TABLE Logging(
	log_id int(5) NOT NULL AUTO_INCREMENT,
	user_id int(5) NOT NULL,
	created datetime default now(),
	query_desc varchar(255),
	PRIMARY KEY (log_id)
);


CREATE TABLE Seminars(
	sem_id int(5) NOT NULL AUTO_INCREMENT,
	Name varchar(50) NOT NULL,
	Location varchar(20),
	timedate datetime NOT NULL,
	Capacity int(4) NOT NULL,
	Description varchar(255),
	Materials varchar(255),
	created TIMESTAMP,
	PRIMARY KEY (sem_id)
);
