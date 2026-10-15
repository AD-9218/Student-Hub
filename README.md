# 🎓 Student Hub

A responsive **Student Hub Website** developed using **HTML5, CSS3, JavaScript, JSON, PHP, MySQL, and MySQLi**. This project provides students with an easy-to-use platform to manage academic activities such as attendance, courses, assignments, results, profile information, events, feedback, registration, and student data.

The project was developed progressively from **Practical 1 to Practical 14**, integrating frontend development, JavaScript, JSON, PHP, MySQL, authentication, CRUD operations, event registration, APIs, AJAX/Fetch, and an admin dashboard.

---

## 🌟 Features

- 🏠 Home Page
- 📊 Dashboard
- 📅 Attendance Management
- 📚 Courses
- 📝 Assignments
- 📄 Results
- 👤 Student Profile
- 📝 User Registration
- 🔐 Login and Logout
- 📞 Contact Page
- ⚙️ Settings
- 💬 Feedback
- 📅 Events
- 🔍 Search and Filter Functionality
- 🌙 Dark/Light Theme
- 📱 Responsive Design
- 🔄 Dynamic Data Handling using JSON
- 🖥️ Server-Side Processing using PHP
- 💾 MySQL Database Integration
- 🔗 MySQLi Database Connection
- 🔐 Password Hashing
- 🚫 Duplicate Username and Email Checking
- 👨‍🎓 Student Management CRUD
- 📅 Event Management CRUD
- 🖼️ Event Poster Upload
- 📝 Event Registration
- 👨‍💼 Admin and Student Roles
- 🛡️ Role-Based Access Control
- ⚡ AJAX/Fetch-Based Operations
- 📦 PHP JSON API
- 📊 Admin Dashboard
- 📝 Audit Logs

---

## 🛠️ Technologies Used

- HTML5
- CSS3
- JavaScript
- JSON
- PHP
- MySQL
- MySQLi
- PDO
- AJAX / Fetch API
- Visual Studio Code
- XAMPP
- phpMyAdmin
- Git & GitHub

---

## 🔧 Technologies and Their Role

### HTML5

Used to create the structure of the Student Hub website and its different pages.

### CSS3

Used for styling, layouts, navigation bars, cards, forms, buttons, responsive design, and the overall user interface.

### JavaScript

Used for DOM manipulation, form validation, search, theme switching, interactive components, local storage, and AJAX/Fetch operations.

### JSON

Used for structured data handling and communication between the frontend and backend.

### PHP

Used for server-side processing, user registration, login authentication, database operations, CRUD operations, session management, role-based access control, and JSON API endpoints.

### MySQL

Used to store users, students, events, registrations, and other project data.

### MySQLi

Used for MySQL database connection and database operations in PHP.

### PDO

Used for secure database connections and prepared statements in PHP.

### AJAX / Fetch API

Used for asynchronous communication between the frontend and PHP backend without requiring a full page reload.

---

## 📚 Practical Work

The **Student Hub** project was developed progressively through **Practical 1 to Practical 14**. The complete project combines frontend development, JavaScript, JSON, PHP, MySQL, authentication, CRUD operations, event registration, APIs, and an admin dashboard.

### ✨ Key Implementations

- 🌐 HTML5 website structure and responsive design
- 🎨 CSS3 styling and UI components
- ⚡ JavaScript DOM manipulation and interactive features
- ✅ Form validation and regular expressions
- 📄 JSON data handling
- 🐘 PHP server-side processing
- 🗄️ MySQL database integration
- 🔗 MySQLi and PDO database connections
- 🔐 Secure user registration
- 🚫 Duplicate username and email checking
- 🔒 Password hashing
- 🔑 Login and logout
- 🧑‍💻 Session management
- 👨‍💼 Admin and Student roles
- 🛡️ Role-Based Access Control
- 👨‍🎓 Student Management CRUD operations
- 📅 Event Management CRUD operations
- 🖼️ Event poster upload and validation
- 📝 Event registration
- 🔍 Search and filtering
- 🔄 PHP JSON API
- ⚡ AJAX/Fetch API operations
- 📊 Dynamic database-based Admin Dashboard
- 🕒 Latest registration display
- 📝 Audit log management
- 🧪 Final project integration and testing

---

## 🗄️ Database

The project uses the following **MySQL database**:

**Database Name:** `studenthub`

### 📋 Main Database Tables

| Table | Description |
|---|---|
| `users` | Stores user account and authentication information |
| `students` | Stores student information |
| `events` | Stores event information |
| `event_registrations` | Stores event registration records |
| `hobbies` | Stores available hobbies |
| `student_hobbies` | Stores student-hobby relationships |
| `audit_logs` | Stores important system activity logs |

---

## 🚀 How to Run

Follow these steps to run the Student Hub project locally:

### 1️⃣ Install XAMPP

Install and open **XAMPP**.

### 2️⃣ Start Services

Start the following services:

- Apache
- MySQL

### 3️⃣ Place the Project

Place the project folder inside:

```text
C:\xampp\htdocs\

The final project path should be:
C:\xampp\htdocs\Student-Hub\

4️⃣ Open phpMyAdmin
Open:
http://localhost/phpmyadmin

5️⃣ Create the Database
Create or use the database:
studenthub

6️⃣ Import SQL Files
Import the required SQL files into the studenthub database.
7️⃣ Open Student Hub
Open the project in your browser:
http://localhost/Student-Hub/

🔐 Authentication
Student Hub supports two user roles:
👨‍💼 Admin
Admin can access:
- 📊 Admin Dashboard
- 👨‍🎓 Student Management
- 📅 Event Management
- 📝 Event Registrations
- 📝 Audit Logs
👨‍🎓 Student
Students can access student-side features and are restricted from admin-only pages.
🧪 Testing
The complete project is tested for:
- ✅ User registration
- 🔑 Login and logout
- 👨‍💼 Admin and Student roles
- 🛡️ Role-Based Access Control
- 🔐 Session management
- 👨‍🎓 Student CRUD
- 📅 Event CRUD
- 📝 Event registration
- 🔍 Search and filtering
- 🖼️ Poster upload
- 🔄 PHP JSON API
- ⚡ AJAX/Fetch operations
- 🗄️ Database operations
- 📊 Admin Dashboard
- 📝 Audit logs
🌐 Important URLs
Feature	URL
🏠 Student Hub	http://localhost/Student-Hub/
👨‍🎓 Student Management	http://localhost/Student-Hub/Practical-11/index.php
📅 Event Management	http://localhost/Student-Hub/Practical-12/index.php
📊 Admin Dashboard	http://localhost/Student-Hub/Practical-14/index.php
🗄️ phpMyAdmin	http://localhost/phpmyadmin


📦 GitHub Repository
🔗 Student Hub Repository
Student Hub on GitHub
💡 Project Demo
The final project demonstrates the complete Student Hub system, including:
- 🔑 Student Login
- 👨‍💼 Admin Login
- 👨‍🎓 Student Management
- 📅 Event Management
- 📝 Event Registration
- 🔄 JSON/AJAX Functionality
- 📊 Admin Dashboard
- 🛡️ Role-Based Access
- 📝 Audit Logs
- 🗄️ Database Integration
👨‍💻 Developer
 Anandi Dihora
🎓 Computer Engineering Student
📜 License
This project is developed for educational purposes.

### ✅ This version fixes your problem

- No unwanted **“Why this version is better”** section.
- Proper headings and spacing.
- Database is presented as a **clean table**.
- URLs are in a proper table.
- Code blocks are correctly closed.
- GitHub link is proper Markdown.
- Developer section is clean.
- README ends correctly at **License**.
