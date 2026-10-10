<?php
require_once "auth.php";

if ($_SESSION["role"] != "admin") {
    http_response_code(403);
    exit("Access denied. Admin only.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["username"]); ?>
    </p>

    <p>You are logged in as Admin.</p>

    <a href="logout.php">Logout</a>

</body>
</html>