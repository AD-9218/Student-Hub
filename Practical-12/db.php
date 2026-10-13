<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "student_hub";

$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS `$database`");
$conn->select_db($database);
$conn->set_charset("utf8mb4");

$sql = "CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NULL,
    venue VARCHAR(150) NULL,
    description TEXT NULL,
    status ENUM('Open','Closed') NOT NULL DEFAULT 'Open',
    poster VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($sql)) {
    die("Table creation failed: " . $conn->error);
}

$countResult = $conn->query("SELECT COUNT(*) AS total FROM events");
$count = (int)$countResult->fetch_assoc()["total"];
if ($count === 0) {
    $stmt = $conn->prepare("INSERT INTO events (title, event_date, description, status) VALUES (?, ?, ?, 'Open')");
    $samples = [
        ["Coding Challenge", "2026-08-15", "Coding Challenge"],
        ["AI Workshop", "2026-08-22", "AI and Machine Learning Workshop"],
        ["Web Development Bootcamp", "2026-08-28", "Web Development Bootcamp"]
    ];
    foreach ($samples as $sample) {
        $stmt->bind_param("sss", $sample[0], $sample[1], $sample[2]);
        $stmt->execute();
    }
    $stmt->close();
}
?>