DROP USER IF EXISTS 'ladmin'@'localhost';
CREATE USER 'ladmin'@'localhost' IDENTIFIED BY 'ladmin';
DROP DATABASE IF exists med;
CREATE DATABASE med;
USE med;
GRANT ALL PRIVILEGES ON med.* TO 'ladmin'@'localhost' IDENTIFIED BY 'ladmin';

CREATE TABLE users
(
    username varchar(15),
    password varchar(32),
    role varchar(15),
    PRIMARY KEY(username, password, role)
);

-- Insert admin, owner
INSERT INTO users VALUES ('admin','admin','med_admin');
INSERT INTO users VALUES ('owner','owner','owner');

CREATE TABLE medicine (
	name varchar(60) NOT NULL,
	buy_timestamp timestamp NOT NULL,
	expiry_date date NOT NULL,
	chem_amount varchar(10) NOT NULL,
	qty int NOT NULL,
	cp int NOT NULL,
	sp int NOT NULL,
	PRIMARY KEY(name, buy_timestamp, expiry_date, chem_amount, cp)
);

CREATE TABLE name_pharma (
	name varchar(60) references medicine(name),
	pharmaco varchar(50) NOT NULL,
	PRIMARY KEY(name, pharmaco)
);

CREATE TABLE name_compound (
	name varchar(60) references medicine(name),
	compound varchar(50) NOT NULL,
	PRIMARY KEY(name, compound)
);

CREATE TABLE transaction (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	txn_timestamp timestamp NOT NULL,
	buy_sell char(1) NOT NULL,
	notes text
);

CREATE TABLE person (
	pid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name varchar(60) NOT NULL,
	address text NOT NULL
);

CREATE TABLE person_email (
	pid int references person(pid),
	email varchar(45) PRIMARY KEY NOT NULL
);

CREATE TABLE person_tel_no (
	pid int references person(pid),
	tel_no int PRIMARY KEY NOT NULL
);

CREATE TABLE supplier_pharmaco (
	pid int references person(pid),
	pharmaco varchar(50) NOT NULL,
	PRIMARY KEY(pid, pharmaco)
);

CREATE TABLE employee (
	pid int references person(pid),
	salary int NOT NULL,
	duty_timings varchar(20) NOT NULL
);

CREATE TABLE txn_on (
	name varchar(60) NOT NULL,
	buy_timestamp timestamp NOT NULL,
	chem_amount varchar(10) NOT NULL,
	expiry_date date NOT NULL,
	cp int NOT NULL,
	id int NOT NULL,
	qty_buy_sell int NOT NULL,
	PRIMARY KEY(name, buy_timestamp, chem_amount, expiry_date, cp,
	id),
	FOREIGN KEY(id) REFERENCES transaction(id)
);

CREATE TABLE txn_person (
	id int NOT NULL,
	pid_person int NOT NULL,
	pid_employee int NOT NULL,
	PRIMARY KEY(id, pid_person, pid_employee),
	FOREIGN KEY(id) REFERENCES transaction(id)
);

CREATE TABLE request (
    req_id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    recep_id int references employee(pid),
    req text NOT NULL,
    status int(1) NOT NULL
);
