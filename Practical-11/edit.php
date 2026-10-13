<?php
require_once "db.php";

$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);
if ($id <= 0) exit("Invalid student ID.");

$stmt = $conn->prepare("SELECT id, name, email, course, status FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$student) exit("Student not found.");

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
            "UPDATE students SET name = ?, email = ?, course = ?, status = ? WHERE id = ?"
        );
        $stmt->bind_param("ssssi", $name, $email, $course, $status, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: index.php?message=Student updated successfully");
            exit;
        }

        $error = "Could not update student.";
        $stmt->close();
    }

    $student["name"] = $name;
    $student["email"] = $email;
    $student["course"] = $course;
    $student["status"] = $status;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Student</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
<h1>Edit Student</h1>
<?php if ($error !== ""): ?>
<div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="POST">
<input type="hidden" name="id" value="<?php echo $student["id"]; ?>">
<label>Name</label>
<input type="text" name="name" value="<?php echo htmlspecialchars($student["name"]); ?>" required>
<label>Email</label>
<input type="email" name="email" value="<?php echo htmlspecialchars($student["email"]); ?>" required>
<label>Course</label>
<input type="text" name="course" value="<?php echo htmlspecialchars($student["course"]); ?>" required>
<label>Status</label>
<select name="status">
<option value="active" <?php echo $student["status"] === "active" ? "selected" : ""; ?>>Active</option>
<option value="inactive" <?php echo $student["status"] === "inactive" ? "selected" : ""; ?>>Inactive</option>
</select>
<button type="submit">Update Student</button>
<a class="clear" href="index.php">Back</a>
</form>
</div>
</body>
</html>