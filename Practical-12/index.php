<?php
require_once "db.php";

$q = trim($_GET["q"] ?? "");
$status = $_GET["status"] ?? "All";
$sql = "SELECT * FROM events WHERE (title LIKE ? OR venue LIKE ? OR description LIKE ?)";
$search = "%" . $q . "%";

if ($status === "Open" || $status === "Closed") {
    $sql .= " AND status = ?";
    $sql .= " ORDER BY event_date ASC, id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $search, $search, $search, $status);
} else {
    $sql .= " ORDER BY event_date ASC, id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $search, $search, $search);
}
$stmt->execute();
$events = $stmt->get_result();
$message = $_GET["message"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Management</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<main class="page">
    <h1>Event Management</h1>
    <?php if ($message !== ""): ?>
        <div class="notice"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <div class="top-actions">
        <a class="button" href="add.php">Add Event</a>
        <a class="button secondary" href="../Practical-2/event.html">View Events Page</a>
    </div>

    <form class="search-form" method="get" action="index.php">
        <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search event, venue or description">
        <select name="status">
            <option value="All" <?= $status === "All" ? "selected" : "" ?>>All Status</option>
            <option value="Open" <?= $status === "Open" ? "selected" : "" ?>>Open</option>
            <option value="Closed" <?= $status === "Closed" ? "selected" : "" ?>>Closed</option>
        </select>
        <button type="submit">Search / Filter</button>
        <a class="clear" href="index.php">Clear</a>
    </form>

    <div class="table-wrap">
    <table>
        <thead>
            <tr><th>ID</th><th>Poster</th><th>Title</th><th>Date</th><th>Time</th><th>Venue</th><th>Description</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php if ($events->num_rows > 0): ?>
            <?php while ($event = $events->fetch_assoc()): ?>
            <tr>
                <td><?= (int)$event["id"] ?></td>
                <td>
                    <?php if (!empty($event["poster"]) && is_file(__DIR__ . "/uploads/" . $event["poster"])): ?>
                        <img class="poster-thumb" src="uploads/<?= rawurlencode($event["poster"]) ?>" alt="Event poster">
                    <?php else: ?>No Poster<?php endif; ?>
                </td>
                <td><?= htmlspecialchars($event["title"]) ?></td>
                <td><?= htmlspecialchars($event["event_date"]) ?></td>
                <td><?= htmlspecialchars(substr((string)$event["event_time"], 0, 5)) ?></td>
                <td><?= htmlspecialchars($event["venue"] ?? "") ?></td>
                <td><?= htmlspecialchars($event["description"] ?? "") ?></td>
                <td class="<?= $event["status"] === "Open" ? "open" : "closed" ?>"><?= htmlspecialchars($event["status"]) ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= (int)$event["id"] ?>">Edit</a> |
                    <a href="delete.php?id=<?= (int)$event["id"] ?>" onclick="return confirm('Delete this event?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9" class="empty">No events found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
</main>
</body>
</html>