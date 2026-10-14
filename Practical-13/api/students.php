
<?php
require "db.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON data"]);
    exit;
}

if ($method === "POST") {
    $name = trim($data["name"] ?? "");
    $studentId = trim($data["student_id"] ?? "");

    if ($name === "" || $studentId === "") {
        http_response_code(400);
        echo json_encode(["error" => "Name and Student ID are required"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO students
            (student_id, name, gender, mobile, college, branch, address, hobbies)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $studentId,
            $name,
            $data["gender"] ?? null,
            $data["mobile"] ?? null,
            $data["college"] ?? null,
            $data["branch"] ?? null,
            $data["address"] ?? null,
            implode(", ", $data["hobbies"] ?? [])
        ]);

        http_response_code(201);
        echo json_encode(["message" => "Student added successfully"]);
    } catch (PDOException $e) {
        http_response_code(409);
        echo json_encode(["error" => "Student ID already exists or data could not be saved"]);
    }
    exit;
}

if ($method === "PUT") {
    $id = (int)($data["id"] ?? 0);

    if ($id <= 0 || trim($data["name"] ?? "") === "" ||
        trim($data["student_id"] ?? "") === "") {
        http_response_code(400);
        echo json_encode(["error" => "Valid ID, Name and Student ID are required"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare(
            "UPDATE students SET student_id=?, name=?, gender=?, mobile=?,
            college=?, branch=?, address=?, hobbies=? WHERE id=?"
        );

        $stmt->execute([
            trim($data["student_id"]),
            trim($data["name"]),
            $data["gender"] ?? null,
            $data["mobile"] ?? null,
            $data["college"] ?? null,
            $data["branch"] ?? null,
            $data["address"] ?? null,
            implode(", ", $data["hobbies"] ?? []),
            $id
        ]);

        echo json_encode(["message" => "Student updated successfully"]);
    } catch (PDOException $e) {
        http_response_code(409);
        echo json_encode(["error" => "Student ID already exists or update failed"]);
    }
    exit;
}

if ($method === "DELETE") {
    $id = (int)($data["id"] ?? 0);

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(["error" => "Valid student ID is required"]);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(["error" => "Student not found"]);
        exit;
    }

    echo json_encode(["message" => "Student deleted successfully"]);
    exit;
}

header("Allow: GET, POST, PUT, DELETE");
http_response_code(405);
echo json_encode(["error" => "Method not allowed"]);
?>