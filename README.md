# 🎓 Student Hub

A responsive **Student Hub Website** developed using **HTML5, CSS3, JavaScript, JSON, PHP, MySQL, and MySQLi**. This project provides students with an easy-to-use interface to manage academic activities such as attendance, courses, assignments, results, profile information, events, feedback, registration, and student data.

---

## 🌟 Features

* 🏠 Home Page
* 📊 Dashboard
* 📅 Attendance Management
* 📚 Courses
* 📝 Assignments
* 📄 Results
* 👤 Student Profile
* 📝 User Registration
* 🔐 Login Page
* 📞 Contact Page
* ⚙️ Settings
* 💬 Feedback
* 📅 Events
* 🔍 Search Functionality
* 🌙 Dark/Light Theme
* 📱 Responsive Design
* 🔄 Dynamic Data Handling using JSON
* 🖥️ Server-side Processing using PHP
* 💾 MySQL Database Integration
* 🔗 MySQLi Database Connection
* ✅ Frontend and Backend Form Validation
* 🔐 Password Hashing
* 🚫 Duplicate Username and Email Checking
* 💾 Student Data Management

---

## 🛠️ Technologies Used

* **HTML5** – Structure of the website
* **CSS3** – Styling and responsive design
* **JavaScript** – Interactive features, DOM manipulation and validations
* **JSON** – Storing and handling structured student data
* **PHP** – Server-side processing and form handling
* **MySQL** – Storing user and student data
* **MySQLi** – Connecting PHP with MySQL database
* **Visual Studio Code** – Development environment
* **XAMPP** – Local PHP and MySQL server environment
* **Git & GitHub** – Version control and project hosting

---

## ⚙️ Technologies and Their Role

### HTML5

Used to create the structure and different pages of the Student Hub website.

### CSS3

Used for styling, layouts, navigation bars, cards, forms, buttons, and responsive design.

### JavaScript

Used for:

* Form validation
* DOM manipulation
* Search functionality
* Theme toggle
* Dashboard interactions
* Dynamic content updates
* Local storage
* Interactive components

### JSON

Used to store and manage structured data such as:

* Student information

### PHP

Used for server-side operations such as:

* Form processing
* User registration
* Backend validation
* Database operations

### MySQL

Used to store user registration and student-related data.

### MySQLi

**MySQLi means MySQL Improved.** It is a PHP extension used to connect PHP applications with MySQL databases and perform database operations.

---

## 📚 Practical Work

The Student Hub project was developed step-by-step from **Practical 1 to Practical 9**, including:

* HTML website structure and pages
* CSS styling and responsive design
* JavaScript and DOM manipulation
* Form validation and regular expressions
* JSON data handling
* PHP form processing
* MySQL database connection
* User registration using PHP and MySQLi
* Frontend and backend validation
* Duplicate username and email checking
* Secure password hashing using `password_hash()`

---

## 🔐 User Registration

The registration system uses PHP, MySQL and MySQLi.

Registration process:

```text
Registration Form
       ↓
    PHP Code
       ↓
 Validate Input
       ↓
Check Username/Email
       ↓
  Hash Password
       ↓
 Insert into MySQL
       ↓
Registration Successful
````

The system checks:

* Empty fields
* Valid email
* Minimum password length
* Duplicate username
* Duplicate email
* Secure password hashing

---

## 🗄️ Database

The project uses a MySQL database named:

```text
studenthub
```

The `users` table stores information such as:

```text
id
username
email
password
created_at
```

Passwords are stored using secure password hashing.

---

## 🚀 How to Run

### For HTML, CSS and JavaScript

1. Open the project in **Visual Studio Code**.
2. Open `index.html`.
3. Run it using **Live Server** or open it directly in a web browser.

### For PHP and MySQL

PHP requires a local server such as **XAMPP**.

1. Install and open **XAMPP**.
2. Start **Apache** from the XAMPP Control Panel.
3. Start **MySQL** from the XAMPP Control Panel.
4. Place the project folder inside:

```text
C:\xampp\htdocs\
```

5. Open the project in your browser using:

```text
http://localhost/Student-Hub/
```

### phpMyAdmin

Open:

```text
http://localhost/phpmyadmin
```

Use the `studenthub` database for the PHP and MySQL functionality.

---

## 💡 Implemented Features

* ✅ HTML5 Website Structure
* ✅ CSS3 Styling
* ✅ Responsive Web Design
* ✅ JavaScript Form Validation
* ✅ DOM Manipulation
* ✅ Dark/Light Theme Toggle
* ✅ Search Functionality
* ✅ Student Dashboard Interactions
* ✅ Local Storage Support
* ✅ JSON Data Handling
* ✅ PHP Form Processing
* ✅ MySQL Database Integration
* ✅ MySQLi Database Connection
* ✅ User Registration
* ✅ Frontend Validation
* ✅ Backend Validation
* ✅ Duplicate Username Checking
* ✅ Duplicate Email Checking
* ✅ Password Hashing

---

## 🔮 Future Improvements

* 🔐 Secure Login and Logout System
* 👨‍🏫 Faculty and Student Roles
* ⏱️ Session Management
* 📤 Assignment Upload System
* 📊 Advanced Attendance Analytics
* 🔔 Assignment and Event Notifications
* 📱 Progressive Web App (PWA) Support

---

## 👨‍💻 Developer

**Anandi Dihora**

Computer Engineering Student

---

## 📜 License

This project is developed for educational purposes.

Feel free to use, modify, and improve it for learning.

⭐ If you found this project useful, please consider giving it a **Star** on GitHub!

```


