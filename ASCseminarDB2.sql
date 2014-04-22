DROP TABLE IF EXISTS Register;
DROP TABLE IF EXISTS Seminars;
DROP TABLE IF EXISTS Location;
DROP TABLE IF EXISTS College;
DROP TABLE IF EXISTS Request;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Student;

CREATE TABLE Student(
	s_id int(5) NOT NULL AUTO_INCREMENT,
	FnameLname varchar(40) NOT NULL,
	Email varchar(50) NOT NULL,
        username varchar(25) NOT NULL,
	College varchar(50) NOT NULL,
	PRIMARY KEY (s_id)
);

CREATE TABLE Admin(
	a_id int(5) NOT NULL AUTO_INCREMENT,
	username varchar(20) NOT NULL,
	email varchar(23) NOT NULL,
	PRIMARY KEY (a_id)
);

CREATE TABLE Request(
	r_id int(5) NOT NULL AUTO_INCREMENT,
	Name varchar(50) NOT NULL,
	timedate datetime NOT NULL,
	Description varchar(255) NOT NULL,
	Materials varchar(255),
	PRIMARY KEY (r_id)
);

CREATE TABLE College(
	c_id int(5) NOT NULL AUTO_INCREMENT,
	College varchar(50) NOT NULL,
	Contact	varchar(40),
	PRIMARY KEY (c_id)
);

CREATE TABLE Location(
	l_id int(5) NOT NULL AUTO_INCREMENT,
	Building varchar(20) NOT NULL,
	Rm_num varchar(5) NOT NULL,
	Capacity int(5) NOT NULL,
	PRIMARY KEY (l_id)
);

CREATE TABLE Seminars(
	sem_id int(5) NOT NULL AUTO_INCREMENT,
	Name varchar(50) NOT NULL,
	Building varchar(20),
	l_id int(5) NOT NULL,
	timedate datetime NOT NULL,
	Description varchar(255),
	Materials varchar(255),
	created TIMESTAMP,
	PRIMARY KEY (sem_id),
	FOREIGN KEY (l_id)
	REFERENCES Location(l_id)
);

CREATE TABLE Register(
	s_id int(5) NOT NULL,
	sem_id int(5) NOT NULL,
	PRIMARY KEY (s_id, sem_id)
);
