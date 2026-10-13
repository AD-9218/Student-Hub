<?php
require_once "db.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: index.php?message=" . urlencode("Invalid event ID."));
    exit;
}
$stmt = $conn->prepare("SELECT poster FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
if (!$event) {
    header("Location: index.php?message=" . urlencode("Event not found."));
    exit;
}
$delete = $conn->prepare("DELETE FROM events WHERE id = ?");
$delete->bind_param("i", $id);
if ($delete->execute()) {
    if (!empty($event["poster"]) && is_file(__DIR__ . "/uploads/" . $event["poster"])) {
        unlink(__DIR__ . "/uploads/" . $event["poster"]);
    }
    header("Location: index.php?message=" . urlencode("Event deleted successfully."));
} else {
    header("Location: index.php?message=" . urlencode("Unable to delete event."));
}
exit;
?>