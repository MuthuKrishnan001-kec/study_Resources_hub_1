CREATE DATABASE IF NOT EXISTS srh;
USE srh;

CREATE TABLE IF NOT EXISTS members (
    firstname      VARCHAR(100) NOT NULL,
    lastname       VARCHAR(100) NOT NULL,
    dob            DATE NOT NULL,
    gender         ENUM('Male','Female','Other') NOT NULL,
    email          VARCHAR(255) NOT NULL PRIMARY KEY,
    password_hash  VARCHAR(255) NOT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


