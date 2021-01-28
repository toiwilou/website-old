
-- CRÉATION DE LA BASE DE DONNÉES WEBSITE --

CREATE DATABASE WEBSITE;
USE WEBSITE;

CREATE TABLE skill (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	star INT NOT NULL,
	content TEXT NOT NULL
);

CREATE TABLE image (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	code VARCHAR(30) NOT NULL,
	url VARCHAR(255) NOT NULL
);