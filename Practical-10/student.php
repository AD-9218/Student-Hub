<?php
require_once "auth.php";

if ($_SESSION["role"] != "student") {
    http_response_code(403);
    exit("Access denied. Student only.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
</head>

<body>

    <h1>Student Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["username"]); ?>
    </p>

    <p>You are logged in as Student.</p>

    <a href="logout.php">Logout</a>

</body>
</html>