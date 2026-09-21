<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "<h1>Form Submitted Successfully!</h1>";

    echo "<p><b>Name:</b> " . ($_POST["name"] ?? "Not received") . "</p>";
    echo "<p><b>Gender:</b> " . ($_POST["gender"] ?? "Not received") . "</p>";
    echo "<p><b>Student ID:</b> " . ($_POST["student_id"] ?? "Not received") . "</p>";
    echo "<p><b>Mobile:</b> " . ($_POST["mobile"] ?? "Not received") . "</p>";
    echo "<p><b>College:</b> " . ($_POST["college"] ?? "Not received") . "</p>";
    echo "<p><b>Branch:</b> " . ($_POST["branch"] ?? "Not received") . "</p>";
    echo "<p><b>Address:</b> " . ($_POST["address"] ?? "Not received") . "</p>";

    $hobbies = $_POST["hobbies"] ?? [];

    echo "<p><b>Hobbies:</b> ";

    if (!empty($hobbies)) {
        echo implode(", ", $hobbies);
    } else {
        echo "None";
    }

    echo "</p>";

} else {

    echo "Invalid Request.";

}

?>