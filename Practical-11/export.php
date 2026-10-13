<?php
require_once "db.php";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=students.csv");

$output = fopen("php://output", "w");
fputcsv($output, ["ID", "Name", "Email", "Course", "Status"]);

$result = $conn->query(
    "SELECT id, name, email, course, status FROM students ORDER BY id"
);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
exit;
?>