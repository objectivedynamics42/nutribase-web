<?php

// Function to handle /gettags
function getTags($conn) {
    // Placeholder for logic to get tags
    header('Content-Type: application/json');
    echo json_encode([
        ["id" => 1, "name" => "Fruit"],
        ["id" => 2, "name" => "Vegetable"]
    ]);
}

// Function to handle /getfoods
function getFoods($conn, $tagId) {
    // Placeholder for logic to get foods by tag ID
    header('Content-Type: application/json');
    echo json_encode([
        ["id" => 101, "name" => "Apple", "tagId" => $tagId],
        ["id" => 102, "name" => "Carrot", "tagId" => $tagId]
    ]);
}

// Function to handle /getSingleFood
function getSingleFood($conn, $foodId) {
    // Placeholder for logic to get a specific food by food ID
    header('Content-Type: application/json');
    echo json_encode([
        "id" => $foodId,
        "name" => "Sample Food",
        "details" => "Details about the food"
    ]);
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

//START
// Handle routing for /nutribase.php
if (isset($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $query = [];
    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query);

    switch ($uri) {
        case '/nutribase.php/gettags':
            getTags($conn);
            break;

        case '/nutribase.php/getfoods':
            if (isset($query['tagid'])) {
                getFoods($conn, $query['tagid']);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Missing required parameter: tagid"]);
            }
            break;

        case '/nutribase.php/getSingleFood':
            if (isset($query['foodid'])) {
                getSingleFood($conn, $query['foodid']);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Missing required parameter: foodid"]);
            }
            break;

        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"]);
            break;
    }
} else {
    http_response_code(500);
    echo json_encode(["error" => "Invalid request"]);
}
//END
























// Close connection
$conn->close();

?>
