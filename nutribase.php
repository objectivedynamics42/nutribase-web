<?php

// Database connection details
$servername = "localhost";
$username = "object_nutribase_admin";
$password = "NKR@bjp6uab0kpv8fut";
$dbname = "object_nutribase";

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Table name to populate
$table = "food";

// Step 1: Check if the table is empty
$sql_check = "SELECT COUNT(*) as count FROM $table";
$result = $conn->query($sql_check);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        // Step 2: Insert standing data
        $sql_insert = "

            INSERT INTO $table (name, kCalPerUnit, proteinGramsPerUnit, unitCaptionOverride)
            VALUES 
            ('Chickpeas - Freshona (LIDL) - In Water', 125, 6.4, ''),
            ('Kidney Beans', 93, 72, '');
        ";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Standing data inserted successfully.";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    } else {
        echo "Table already contains data. No action taken.";
    }
} else {
    echo "Error checking table: " . $conn->error;
}

// Close connection
$conn->close();
?>
