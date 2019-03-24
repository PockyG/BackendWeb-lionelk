CREATE DATABASE first_database;

use first_database;

CREATE TABLE works(
  id INT(10) AUTO_INCREMENT PRIMARY KEY,
  artistname VARCHAR(30) NOT NULL,
  worktitle VARCHAR(30) NOT NULL,
  workdate VARCHAR(30),
  worktype VARCHAR(30),
  date TIMESTAMP
);



CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
