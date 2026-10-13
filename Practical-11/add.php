<?php
require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $status = trim($_POST["status"] ?? "active");

    if ($name === "" || $email === "" || $course === "") {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO students (name, email, course, status) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $name, $email, $course, $status);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: index.php?message=Student added successfully");
            exit;
        }

        $error = "Could not add student. Email may already exist.";
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
<h1>Add Student</h1>
<?php if ($error !== ""): ?>
<div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="POST">
<label>Name</label>
<input type="text" name="name" required>
<label>Email</label>
<input type="email" name="email" required>
<label>Course</label>
<input type="text" name="course" placeholder="Computer Engineering" required>
<label>Status</label>
<select name="status">
<option value="active">Active</option>
<option value="inactive">Inactive</option>
</select>
<button type="submit">Add Student</button>
<a class="clear" href="index.php">Back</a>
</form>
</div>
</body>
</html>