<?php
require_once "db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) exit("Invalid student ID.");

$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: index.php?message=Student deleted successfully");
exit;
?>