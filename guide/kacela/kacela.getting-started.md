# Create a simple database

Create the following database and tables in MySQL:

	CREATE DATABASE kacela;

	USE kacela;

	CREATE TABLE users (
		id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
		role ENUM('admin', 'client') NOT NULL,
		first_name,
		last_name,
		email_address,
		is_deleted
	) ENGINE=Innodb;

	CREATE TABLE admins (

	) ENGINE=Innodb;

	CREATE TABLE clients (
		
	) ENGINE=Innodb;

	CREATE TABLE addresses (
	
	) ENGINE=Innodb;


# Create Mappers

# Create Models

