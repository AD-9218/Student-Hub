<?php

ini_set("session.use_strict_mode", "1");

session_set_cookie_params([
    "httponly" => true,
    "secure" => false,
    "samesite" => "Lax"
]);

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../Practical-2/login_page.html");
    exit;
}

$timeout = 900;

if (
    !isset($_SESSION["last_activity"]) ||
    time() - $_SESSION["last_activity"] > $timeout
) {
    $_SESSION = [];
    session_destroy();

    header("Location: ../Practical-2/login_page.html?timeout=1");
    exit;
}

$_SESSION["last_activity"] = time();

?>