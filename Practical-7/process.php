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

    $file = "student.csv";

    $fileExists = file_exists($file);
    $handle = fopen($file, "a");

    if ($handle) {

        if (!$fileExists || filesize($file) == 0) {
            fputcsv($handle, [
                "Name",
                "Gender",
                "Student ID",
                "Mobile",
                "College",
                "Branch",
                "Address",
                "Hobbies"
            ]);
        }

        fputcsv($handle, [
            $name,
            $gender,
            $student_id,
            $mobile,
            $college,
            $branch,
            $address,
            implode(", ", $hobbies)
        ]);

        fclose($handle);

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

        echo "<p>Data saved successfully in students.csv</p>";

    } else {
        echo "<h2>Error: CSV file could not be opened.</h2>";
    }

} else {
    echo "Invalid Request.";
}

?>