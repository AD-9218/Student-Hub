CREATE DATABASE IF NOT EXISTS studenthub
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE studenthub;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NULL,
    mobile VARCHAR(15),
    college VARCHAR(150),
    branch VARCHAR(100),
    address TEXT,
    photo_path VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS hobbies (
    hobby_id INT AUTO_INCREMENT PRIMARY KEY,
    hobby_name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS student_hobbies (
    student_id INT NOT NULL,
    hobby_id INT NOT NULL,
    PRIMARY KEY (student_id, hobby_id),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (hobby_id) REFERENCES hobbies(hobby_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(150) NOT NULL,
    event_date DATE,
    description TEXT
);

CREATE TABLE IF NOT EXISTS event_registrations (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    event_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (student_id, event_id),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

INSERT INTO students
(student_id, name, gender, mobile, college, branch, address)
VALUES
('25DCE021', 'Anandi Dihora', 'Female', '', 'CHARUSAT', 'CE', '')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT IGNORE INTO hobbies (hobby_name)
VALUES ('Reading'), ('Music'), ('Sports'), ('Traveling'), ('Gaming');

INSERT IGNORE INTO student_hobbies (student_id, hobby_id)
SELECT s.id, h.hobby_id
FROM students s
JOIN hobbies h ON h.hobby_name IN ('Reading', 'Music')
WHERE s.student_id = '25DCE021';

INSERT INTO events (event_name, event_date, description)
SELECT 'Coding Challenge', '2026-08-15', 'Coding Challenge'
WHERE NOT EXISTS (SELECT 1 FROM events WHERE event_name = 'Coding Challenge');

INSERT INTO events (event_name, event_date, description)
SELECT 'AI Workshop', '2026-08-22', 'AI and Machine Learning Workshop'
WHERE NOT EXISTS (SELECT 1 FROM events WHERE event_name = 'AI Workshop');

INSERT INTO events (event_name, event_date, description)
SELECT 'Web Development Bootcamp', '2026-08-28', 'Web Development Bootcamp'
WHERE NOT EXISTS (SELECT 1 FROM events WHERE event_name = 'Web Development Bootcamp');

SHOW TABLES;
SELECT * FROM students;
SELECT * FROM hobbies;
SELECT * FROM student_hobbies;
SELECT * FROM events;
