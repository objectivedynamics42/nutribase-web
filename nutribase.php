<?php

function prettifyJson($json) {
    // Decode the JSON string to make sure it's valid
    $decodedJson = json_decode($json, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        return 'Invalid JSON string';
    }
    
    // Encode the array back to a JSON string with pretty print
    $prettyJson = json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    
    // Wrap it in <pre> tags for better formatting in HTML
    return '<pre>' . htmlspecialchars($prettyJson) . '</pre>';
}

function fetchFoodTagDataAsJson($conn) {

    // Prepare the SQL query
    $sql = "SELECT 
                food.name AS FoodName,
                food.kcal_per_unit as kCal,
                food.protein_grams_per_unit as Protein,
                tag.name AS TagName
            FROM 
                tagged_food
            INNER JOIN 
                food ON tagged_food.food_id = food.id
            INNER JOIN 
                tag ON tagged_food.tag_id = tag.id
            ORDER BY 
                food.name, tag.name";

    // Execute the query
    $result = $conn->query($sql);

    if ($result === false) {
        return json_encode([
            "error" => "Query error: " . $conn->error
        ]);
    }

    // Fetch all rows as an associative array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Free result set and close connection
    $result->free();

    // Convert the data to JSON format
    return json_encode($data);
}

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

$jsonData = fetchFoodTagDataAsJson($conn);

echo prettifyJson($jsonData);

// Close connection
$conn->close();

?>
