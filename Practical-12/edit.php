<?php
require_once "db.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) { header("Location: index.php?message=" . urlencode("Invalid event ID.")); exit; }
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
if (!$event) { header("Location: index.php?message=" . urlencode("Event not found.")); exit; }

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $date = trim($_POST["event_date"] ?? "");
    $time = trim($_POST["event_time"] ?? "");
    $venue = trim($_POST["venue"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $status = ($_POST["status"] ?? "Open") === "Closed" ? "Closed" : "Open";
    $posterName = $event["poster"];

    if ($title === "" || $date === "") {
        $error = "Event title and date are required.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || !checkdate((int)substr($date,5,2), (int)substr($date,8,2), (int)substr($date,0,4))) {
        $error = "Please enter a valid event date.";
    } elseif (!empty($_FILES["poster"]["name"])) {
        $file = $_FILES["poster"];
        $maxSize = 2 * 1024 * 1024;
        $allowed = ["image/jpeg" => "jpg", "image/png" => "png", "image/gif" => "gif", "image/webp" => "webp"];
        if ($file["error"] !== UPLOAD_ERR_OK) {
            $error = "Poster upload failed. Please try again.";
        } elseif ($file["size"] > $maxSize) {
            $error = "Poster must be 2 MB or smaller.";
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file["tmp_name"]);
            if (!isset($allowed[$mime])) {
                $error = "Invalid poster type. Use JPG, PNG, GIF, or WEBP.";
            } else {
                $posterName = bin2hex(random_bytes(12)) . "." . $allowed[$mime];
                if (!move_uploaded_file($file["tmp_name"], __DIR__ . "/uploads/" . $posterName)) {
                    $error = "Could not save the poster. Check the uploads folder permissions.";
                }
            }
        }
    }

    if ($error === "") {
        $timeValue = $time === "" ? null : $time;
        $update = $conn->prepare("UPDATE events SET title=?, event_date=?, event_time=?, venue=?, description=?, status=?, poster=? WHERE id=?");
        $update->bind_param("sssssssi", $title, $date, $timeValue, $venue, $description, $status, $posterName, $id);
        if ($update->execute()) {
            if ($posterName !== $event["poster"] && $event["poster"] && is_file(__DIR__ . "/uploads/" . $event["poster"])) unlink(__DIR__ . "/uploads/" . $event["poster"]);
            header("Location: index.php?message=" . urlencode("Event updated successfully."));
            exit;
        }
        $error = "Unable to update event: " . $update->error;
    }
    $event = array_merge($event, ["title"=>$title, "event_date"=>$date, "event_time"=>$time, "venue"=>$venue, "description"=>$description, "status"=>$status, "poster"=>$posterName]);
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Edit Event</title><link rel="stylesheet" href="style.css"></head>
<body><main class="form-page">
<h1>Edit Event</h1>
<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data" class="event-form">
<label>Event Title *<input type="text" name="title" required maxlength="150" value="<?= htmlspecialchars($event["title"]) ?>"></label>
<label>Date *<input type="date" name="event_date" required value="<?= htmlspecialchars($event["event_date"]) ?>"></label>
<label>Time<input type="time" name="event_time" value="<?= htmlspecialchars(substr((string)$event["event_time"],0,5)) ?>"></label>
<label>Venue<input type="text" name="venue" maxlength="150" value="<?= htmlspecialchars($event["venue"] ?? "") ?>"></label>
<label>Description<textarea name="description" rows="4"><?= htmlspecialchars($event["description"] ?? "") ?></textarea></label>
<label>Status<select name="status"><option value="Open" <?= $event["status"] === "Open" ? "selected" : "" ?>>Open</option><option value="Closed" <?= $event["status"] === "Closed" ? "selected" : "" ?>>Closed</option></select></label>
<?php if (!empty($event["poster"]) && is_file(__DIR__ . "/uploads/" . $event["poster"])): ?><p>Current poster:</p><img class="current-poster" src="uploads/<?= rawurlencode($event["poster"]) ?>" alt="Current poster"><?php endif; ?>
<label>Replace Poster (JPG, PNG, GIF, WEBP; max 2 MB)<input type="file" name="poster" accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp"></label>
<div class="form-actions"><button type="submit">Update Event</button><a class="button secondary" href="index.php">Cancel</a></div>
</form></main></body></html>