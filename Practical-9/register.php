<?php

require_once "db_mysqli.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Please submit the registration form.");
}

$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($username === "" || $email === "" || $password === "") {
    exit("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email address.");
}

if (strlen($password) < 8) {
    exit("Password must be at least 8 characters.");
}

/* Check duplicate username or email */
$stmt = $conn->prepare(
    "SELECT id FROM users WHERE username = ? OR email = ?"
);

$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    exit("Username or email already exists.");
}

$stmt->close();

/* Hash password */
$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

/* Insert user */
$stmt = $conn->prepare(
    "INSERT INTO users (username, email, password)
     VALUES (?, ?, ?)"
);

$stmt->bind_param(
    "sss",
    $username,
    $email,
    $hashedPassword
);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Registration failed.";
}

$stmt->close();
$conn->close();

?>