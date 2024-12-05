# ProjectADS

#Database Structure

CREATE DATABASE adv_project;

USE adv_project;

CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    department VARCHAR(50) NOT NULL
);


CREATE TABLE subjects (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL
);


CREATE TABLE grades (
    grade_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    grade DECIMAL(4, 2) NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE
);


DELIMITER //
CREATE TRIGGER calculate_grade_avg
AFTER INSERT ON grades
FOR EACH ROW
BEGIN
    DECLARE avg_grade DECIMAL(4, 2);
    SELECT AVG(grade) INTO avg_grade FROM grades WHERE student_id = NEW.student_id;
    INSERT INTO student_averages (student_id, average_grade) VALUES (NEW.student_id, avg_grade)
    ON DUPLICATE KEY UPDATE average_grade = avg_grade;
END;
//
DELIMITER ;
