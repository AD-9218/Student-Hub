<?php
require_once __DIR__ . "/db.php";
header("Content-Type: application/json; charset=UTF-8");

function respond($status, $data) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $result = $conn->query("SELECT event_id, event_name, event_date, description FROM events ORDER BY event_id DESC");
    if (!$result) respond(500, ["success" => false, "message" => "Could not fetch events. Check the events table columns."]);
    $events = [];
    while ($row = $result->fetch_assoc()) $events[] = $row;
    respond(200, ["success" => true, "data" => $events]);
}

$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input)) $input = [];

if ($method === "POST") {
    $name = trim($input["event_name"] ?? "");
    $date = trim($input["event_date"] ?? "");
    $description = trim($input["description"] ?? "");
    if ($name === "") respond(422, ["success" => false, "message" => "Event name is required."]);
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, description) VALUES (?, NULLIF(?, ''), ?)");
    if (!$stmt) respond(500, ["success" => false, "message" => "Could not prepare insert query."]);
    $stmt->bind_param("sss", $name, $date, $description);
    if (!$stmt->execute()) respond(500, ["success" => false, "message" => "Could not add event."]);
    respond(201, ["success" => true, "message" => "Event added successfully.", "event_id" => $stmt->insert_id]);
}

if ($method === "PUT") {
    $id = filter_var($input["event_id"] ?? null, FILTER_VALIDATE_INT);
    $name = trim($input["event_name"] ?? "");
    $date = trim($input["event_date"] ?? "");
    $description = trim($input["description"] ?? "");
    if (!$id || $name === "") respond(422, ["success" => false, "message" => "Valid event ID and event name are required."]);
    $stmt = $conn->prepare("UPDATE events SET event_name = ?, event_date = NULLIF(?, ''), description = ? WHERE event_id = ?");
    if (!$stmt) respond(500, ["success" => false, "message" => "Could not prepare update query."]);
    $stmt->bind_param("sssi", $name, $date, $description, $id);
    if (!$stmt->execute()) respond(500, ["success" => false, "message" => "Could not update event."]);
    if ($stmt->affected_rows === 0) {
        $check = $conn->prepare("SELECT event_id FROM events WHERE event_id = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $check->store_result();
        if ($check->num_rows === 0) respond(404, ["success" => false, "message" => "Event not found."]);
    }
    respond(200, ["success" => true, "message" => "Event updated successfully."]);
}

if ($method === "DELETE") {
    $id = filter_var($input["event_id"] ?? null, FILTER_VALIDATE_INT);
    if (!$id) respond(422, ["success" => false, "message" => "Valid event ID is required."]);
    $stmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
    if (!$stmt) respond(500, ["success" => false, "message" => "Could not prepare delete query."]);
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) respond(500, ["success" => false, "message" => "Could not delete event."]);
    if ($stmt->affected_rows === 0) respond(404, ["success" => false, "message" => "Event not found."]);
    respond(200, ["success" => true, "message" => "Event deleted successfully."]);
}

header("Allow: GET, POST, PUT, DELETE");
respond(405, ["success" => false, "message" => "Method not allowed."]);
?>