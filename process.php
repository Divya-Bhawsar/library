<?php
// process_registration.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST["student_name"];
    $student_id = $_POST["student_id"];

    // Generate a library card number
    $library_card_number = "LC" . strtoupper(substr(md5($student_id), 0, 8));

    // Store information in the database
    $conn = new mysqli("localhost", "root", "", "library");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into the members table
    $sql = "INSERT INTO members (student_name, student_id, library_card_number) VALUES ('$student_name', '$student_id', '$library_card_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. Library Card Number: $library_card_number";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
