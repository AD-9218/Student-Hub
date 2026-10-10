<?php

require_once "../Practical-8/db.php";

ini_set("session.use_strict_mode", "1");

session_set_cookie_params([
    "httponly" => true,
    "secure" => false,
    "samesite" => "Lax"
]);

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../Practical-2/login_page.html");
    exit;
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";
$role = $_POST["role"] ?? "";

if ($email === "" || $password === "" || $role === "") {
    exit("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email address.");
}

if ($role !== "student" && $role !== "admin") {
    exit("Invalid role.");
}

try {

    $stmt = $pdo->prepare(
        "SELECT id, username, email, password, role
         FROM users
         WHERE email = :email"
    );

    $stmt->execute([
        "email" => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        exit("Invalid email or password.");
    }

    if (!password_verify($password, $user["password"])) {
        exit("Invalid email or password.");
    }

    if ($user["role"] !== $role) {
        exit("You are not authorized for this role.");
    }

    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["role"] = $user["role"];
    $_SESSION["last_activity"] = time();

    if ($user["role"] === "admin") {
        header("Location: admin.php");
        exit;
    }

    if ($user["role"] === "student") {
        header("Location: student.php");
        exit;
    }

} catch (PDOException $e) {
    exit("Login failed. Please try again.");
}

?>