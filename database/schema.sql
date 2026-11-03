CREATE DATABASE IF NOT EXISTS touche_pas_au_klaxon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE touche_pas_au_klaxon;
DROP TABLE IF EXISTS trips;
DROP TABLE IF EXISTS agencies;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 lastname VARCHAR(100) NOT NULL,
 firstname VARCHAR(100) NOT NULL,
 phone VARCHAR(20) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 role ENUM('user','admin') NOT NULL DEFAULT 'user',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE agencies (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 city VARCHAR(100) NOT NULL UNIQUE,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE trips (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 departure_agency_id INT UNSIGNED NOT NULL,
 arrival_agency_id INT UNSIGNED NOT NULL,
 departure_datetime DATETIME NOT NULL,
 arrival_datetime DATETIME NOT NULL,
 total_seats TINYINT UNSIGNED NOT NULL,
 available_seats TINYINT UNSIGNED NOT NULL,
 contact_user_id INT UNSIGNED NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT fk_trip_departure FOREIGN KEY (departure_agency_id) REFERENCES agencies(id),
 CONSTRAINT fk_trip_arrival FOREIGN KEY (arrival_agency_id) REFERENCES agencies(id),
 CONSTRAINT fk_trip_user FOREIGN KEY (contact_user_id) REFERENCES users(id),
 CONSTRAINT chk_trip_agencies CHECK (departure_agency_id <> arrival_agency_id),
 CONSTRAINT chk_trip_dates CHECK (arrival_datetime >= departure_datetime),
 CONSTRAINT chk_trip_seats CHECK (total_seats > 0 AND available_seats <= total_seats)
) ENGINE=InnoDB;
