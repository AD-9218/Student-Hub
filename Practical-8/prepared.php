<?php

require_once "db.php";

try {
    $sql = "SELECT * FROM students WHERE student_id = :student_id";

    $stmt = $pdo->prepare($sql);

    $student_id = "25DCE021";

    $stmt->execute([
        "student_id" => $student_id
    ]);

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        echo "<h2>Student Profile</h2>";
        echo "Name: " . htmlspecialchars($student["name"]) . "<br>";
        echo "Student ID: " . htmlspecialchars($student["student_id"]) . "<br>";
        echo "College: " . htmlspecialchars($student["college"]) . "<br>";
        echo "Branch: " . htmlspecialchars($student["branch"]);
    } else {
        echo "Student not found";
    }

} catch (PDOException $e) {
    echo "Query failed";
}

?>