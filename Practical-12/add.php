<?php
require_once "db.php";

$error = "";
$title = $date = $time = $venue = $description = "";
$status = "Open";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $date = trim($_POST["event_date"] ?? "");
    $time = trim($_POST["event_time"] ?? "");
    $venue = trim($_POST["venue"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $status = ($_POST["status"] ?? "Open") === "Closed" ? "Closed" : "Open";
    $posterName = null;

    if ($title === "" || $date === "") {
        $error = "Event title and date are required.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || !checkdate((int)substr($date,5,2), (int)substr($date,8,2), (int)substr($date,0,4))) {
        $error = "Please enter a valid event date.";
    } elseif (!empty($_FILES["poster"]["name"])) {
        $file = $_FILES["poster"];
        $maxSize = 2 * 1024 * 1024;
        $allowed = ["image/jpeg" => "jpg", "image/png" => "png", "image/gif" => "gif", "image/webp" => "webp"];
        $mime = "";
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
        $stmt = $conn->prepare("INSERT INTO events (title, event_date, event_time, venue, description, status, poster) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $title, $date, $timeValue, $venue, $description, $status, $posterName);
        if ($stmt->execute()) {
            header("Location: index.php?message=" . urlencode("Event added successfully."));
            exit;
        }
        if ($posterName && is_file(__DIR__ . "/uploads/" . $posterName)) unlink(__DIR__ . "/uploads/" . $posterName);
        $error = "Unable to add event: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Add Event</title><link rel="stylesheet" href="style.css"></head>
<body><main class="form-page">
<h1>Add Event</h1>
<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data" class="event-form">
<label>Event Title *<input type="text" name="title" required maxlength="150" value="<?= htmlspecialchars($title) ?>"></label>
<label>Date *<input type="date" name="event_date" required value="<?= htmlspecialchars($date) ?>"></label>
<label>Time<input type="time" name="event_time" value="<?= htmlspecialchars($time) ?>"></label>
<label>Venue<input type="text" name="venue" maxlength="150" value="<?= htmlspecialchars($venue) ?>"></label>
<label>Description<textarea name="description" rows="4"><?= htmlspecialchars($description) ?></textarea></label>
<label>Status<select name="status"><option value="Open" <?= $status === "Open" ? "selected" : "" ?>>Open</option><option value="Closed" <?= $status === "Closed" ? "selected" : "" ?>>Closed</option></select></label>
<label>Event Poster (JPG, PNG, GIF, WEBP; max 2 MB)<input type="file" name="poster" accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp"></label>
<div class="form-actions"><button type="submit">Save Event</button><a class="button secondary" href="index.php">Cancel</a></div>
</form></main></body></html>