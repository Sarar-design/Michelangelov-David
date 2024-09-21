DROP DATABASE IF EXISTS michelangelo_quiz;
CREATE DATABASE michelangelo_quiz;
USE michelangelo_quiz;


CREATE TABLE quiz_submissions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(100) NOT NULL,
    question1 TEXT NOT NULL,
    question2 TEXT NOT NULL,
    question3 TEXT NOT NULL,
    question4 TEXT NOT NULL,
    question5 TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
