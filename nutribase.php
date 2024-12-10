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
$sqlCheck = "SELECT COUNT(*) as count FROM $table";
$result = $conn->query($sqlCheck);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $sqlInsert = getStandingFoodData($table);
        insertStandingData($table, $sqlInsert, $conn);
    } else {
        echo "Table already contains data. No action taken.";
    }






    

    $sqlSelect = "SELECT id, name, kCalPerUnit, proteinGramsPerUnit, unitCaptionOverride from $table";
    $result = $conn->query($sqlSelect);
    if( $result->num_rows > 0){
        echo "<table border='1'>";

        while($row = $result->fetch_assoc()){
            echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['name']) . "</td></tr>";
        }

        echo "</table>";
    }
} else {
    echo "Error checking table: " . $conn->error;
}

// Close connection
$conn->close();

function getStandingFoodData($table){
    if (empty($table)) {
        throw new Exception("Table name is required");
    }

    $sqlInsert = "
        INSERT INTO $table (name, kCalPerUnit, proteinGramsPerUnit, unitCaptionOverride)
        VALUES 
        ('Chickpeas - Freshona (LIDL) - In Water', 125, 6.4, NULL),
        ('Kidney Beans', 93, 7.2, NULL),
        ('Greek Yoghurt', 126, 4, NULL);
    ";

    return $sqlInsert;
}

function insertStandingData(string $table, string $sqlInsert, $conn){
        if ($conn->query($sqlInsert) !== TRUE) {
            echo "Error inserting data: " . $conn->error;
        }
}

?>
