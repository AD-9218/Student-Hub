<?php
require_once "db.php";

$search = trim($_GET["search"] ?? "");
$course = trim($_GET["course"] ?? "");

$sql = "SELECT id, name, email, course, status FROM students WHERE 1=1";
$params = [];
$types = "";

if ($search !== "") {
    $sql .= " AND (name LIKE ? OR email LIKE ? OR course LIKE ?)";
    $like = "%" . $search . "%";
    $params = [$like, $like, $like];
    $types = "sss";
}

if ($course !== "") {
    $sql .= " AND course = ?";
    $params[] = $course;
    $types .= "s";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$courses = $conn->query("SELECT DISTINCT course FROM students ORDER BY course");
$message = $_GET["message"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Management</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Student Management</h1>

<?php if ($message !== ""): ?>
<div class="message"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<div class="top-actions">
<a class="btn" href="add.php">Add Student</a>
<a class="btn secondary" href="export.php">Export CSV</a>
</div>

<form method="GET" class="filter-form">
<input type="text" name="search" placeholder="Search name, email or course"
value="<?php echo htmlspecialchars($search); ?>">

<select name="course">
<option value="">All Courses</option>
<?php while ($row = $courses->fetch_assoc()): ?>
<option value="<?php echo htmlspecialchars($row["course"]); ?>"
<?php echo $course === $row["course"] ? "selected" : ""; ?>>
<?php echo htmlspecialchars($row["course"]); ?>
</option>
<?php endwhile; ?>
</select>

<button type="submit">Search / Filter</button>
<a class="clear" href="index.php">Clear</a>
</form>

<table>
<thead>
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Status</th><th>Actions</th>
</tr>
</thead>
<tbody>
<?php if ($result->num_rows > 0): ?>
<?php while ($student = $result->fetch_assoc()): ?>
<tr>
<td><?php echo $student["id"]; ?></td>
<td><?php echo htmlspecialchars($student["name"]); ?></td>
<td><?php echo htmlspecialchars($student["email"]); ?></td>
<td><?php echo htmlspecialchars($student["course"]); ?></td>
<td><?php echo htmlspecialchars($student["status"]); ?></td>
<td>
<a href="edit.php?id=<?php echo $student["id"]; ?>">Edit</a> |
<a href="delete.php?id=<?php echo $student["id"]; ?>"
onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
</td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr><td colspan="6">No students found.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>