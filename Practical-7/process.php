<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $gender = htmlspecialchars(trim($_POST["gender"] ?? ""));
    $student_id = htmlspecialchars(trim($_POST["student_id"] ?? ""));
    $mobile = htmlspecialchars(trim($_POST["mobile"] ?? ""));
    $college = htmlspecialchars(trim($_POST["college"] ?? ""));
    $branch = htmlspecialchars(trim($_POST["branch"] ?? ""));
    $address = htmlspecialchars(trim($_POST["address"] ?? ""));

    $hobbies = $_POST["hobbies"] ?? [];

    if ($name == "" || $student_id == "" || $mobile == "") {
        echo "<h2>Error: Please fill all required fields.</h2>";
        exit;
    }

    $data = [
        "name" => $name,
        "gender" => $gender,
        "student_id" => $student_id,
        "mobile" => $mobile,
        "college" => $college,
        "branch" => $branch,
        "address" => $address,
        "hobbies" => implode(", ", $hobbies)
    ];

    $file = "students.json";

    $students = [];

    if (file_exists($file)) {
        $students = json_decode(file_get_contents($file), true) ?? [];
    }

    $students[] = $data;

    if (file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT))) {

        echo "<h1>Form Submitted Successfully!</h1>";

        echo "<p><b>Name:</b> $name</p>";
        echo "<p><b>Gender:</b> $gender</p>";
        echo "<p><b>Student ID:</b> $student_id</p>";
        echo "<p><b>Mobile:</b> $mobile</p>";
        echo "<p><b>College:</b> $college</p>";
        echo "<p><b>Branch:</b> $branch</p>";
        echo "<p><b>Address:</b> $address</p>";
        echo "<p><b>Hobbies:</b> " .
             (!empty($hobbies) ? implode(", ", $hobbies) : "None") .
             "</p>";

    } else {
        echo "<h2>Error: Data could not be saved.</h2>";
    }

} else {
    echo "Invalid Request.";
}

?>