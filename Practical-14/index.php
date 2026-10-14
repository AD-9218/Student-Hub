<?php

require_once "../Practical-10/auth.php";
require_once "db.php";

if ($_SESSION["role"] !== "admin") {
    http_response_code(403);
    exit("Access denied. Admin only.");
}

$result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$row = $result->fetch_assoc();
$total_users = $row["total_users"];

$result = $conn->query("SELECT COUNT(*) AS total_students FROM students");
$row = $result->fetch_assoc();
$total_students = $row["total_students"];

$result = $conn->query("SELECT COUNT(*) AS total_events FROM events");
$row = $result->fetch_assoc();
$total_events = $row["total_events"];

$registrations = $conn->query("
    SELECT
        er.registration_id,
        s.name AS student_name,
        e.title AS event_title,
        er.registration_date
    FROM event_registrations er
    JOIN students s ON er.student_id = s.id
    JOIN events e ON er.event_id = e.id
    ORDER BY er.registration_date DESC
    LIMIT 5
");

$audit_logs = $conn->query("
    SELECT
        id,
        user_id,
        action,
        created_at
    FROM audit_logs
    ORDER BY created_at DESC
    LIMIT 10
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - Student Hub</title>

</head>

<body>

    <h1>Admin Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["username"]); ?>
    </p>

    <hr>

    <h2>Dashboard Statistics</h2>

    <p>
        <strong>Total Users:</strong>
        <?php echo $total_users; ?>
    </p>

    <p>
        <strong>Total Students:</strong>
        <?php echo $total_students; ?>
    </p>

    <p>
        <strong>Total Events:</strong>
        <?php echo $total_events; ?>
    </p>

    <hr>

    <h2>Latest Registrations</h2>

    <?php if ($registrations && $registrations->num_rows > 0) { ?>

        <table border="1" cellpadding="8">

            <tr>
                <th>Registration ID</th>
                <th>Student</th>
                <th>Event</th>
                <th>Registration Date</th>
            </tr>

            <?php while ($registration = $registrations->fetch_assoc()) { ?>

                <tr>

                    <td>
                        <?php echo $registration["registration_id"]; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($registration["student_name"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($registration["event_title"]); ?>
                    </td>

                    <td>
                        <?php echo $registration["registration_date"]; ?>
                    </td>

                </tr>

            <?php } ?>

        </table>

    <?php } else { ?>

        <p>No registrations found.</p>

    <?php } ?>

    <hr>

    <h2>Audit Logs</h2>

    <?php if ($audit_logs && $audit_logs->num_rows > 0) { ?>

        <table border="1" cellpadding="8">

            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Action</th>
                <th>Date & Time</th>
            </tr>

            <?php while ($log = $audit_logs->fetch_assoc()) { ?>

                <tr>

                    <td>
                        <?php echo $log["id"]; ?>
                    </td>

                    <td>
                        <?php echo $log["user_id"]; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($log["action"]); ?>
                    </td>

                    <td>
                        <?php echo $log["created_at"]; ?>
                    </td>

                </tr>

            <?php } ?>

        </table>

    <?php } else { ?>

        <p>No audit logs found.</p>

    <?php } ?>

    <hr>

    <p>
        <a href="../Practical-11/index.php">
            Student Management
        </a>
    </p>

    <p>
        <a href="../Practical-12/index.php">
            Event Management
        </a>
    </p>

    <p>
        <a href="../Practical-10/logout.php">
            Logout
        </a>
    </p>

</body>

</html>