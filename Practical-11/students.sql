CREATE DATABASE IF NOT EXISTS studenthub;

USE studenthub;

DROP TABLE IF EXISTS students;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'active'
);

INSERT INTO students (name, email, course, status) VALUES
('Anandi Dihora', 'anandi@example.com', 'Computer Engineering', 'active'),
('Princy', 'Princy@example.com', 'Computer Engineering', 'active'),
('Priya  ', 'priya@example.com', 'Information Technology', 'active'),
('Dhruvi  ', 'Dhruvi@example.com', 'Computer Engineering', 'inactive'),
('Neha Desai', 'neha@example.com', 'Information Technology', 'active'),
('Riya Patel', 'riya@example.com', 'Computer Science', 'active'),
(' Yesha  ', ' Yesha@example.com', 'Computer Engineering', 'active'),
('Meera Joshi', 'meera@example.com', 'Information Technology', 'active'),
(' Isha Patel', ' Isha@example.com', 'Computer Science', 'inactive'),
('Pooja  ', 'pooja@example.com', 'Computer Engineering', 'active');