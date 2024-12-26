<?php

//  Examples
//  https://objectivedynamics.co.uk/nutribase.php/getTags
//  https://objectivedynamics.co.uk/nutribase.php/getFoods?tagId=13
//  https://objectivedynamics.co.uk/nutribase.php/getSingleFood?foodId=66

function doQuery(string $sql, $conn){
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

//  gettags handler
function getTags($conn) {
    header('Content-Type: application/json');

    //  TODO - mysqli_real_escape_string
    $sql = "SELECT 
                tag.id AS TagId,
                tag.name AS TagName
            FROM 
                tag
            ORDER BY 
                tag.name";

    echo doQuery($sql, $conn);
}

// Function to handle /getfoods
function getFoods($conn, $tagId) {
    header('Content-Type: application/json');

    $sql = sprintf("SELECT 
                food.id AS FoodId,
                food.name AS FoodName,
                tagged_food.tag_id
            FROM 
                food
            INNER JOIN 
                tagged_food ON tagged_food.food_id = food.id
            WHERE
                tagged_food.tag_id = '%s'
            ORDER BY 
                food.name",
                mysqli_real_escape_string($conn, $tagId));

    echo doQuery($sql, $conn);
}

// Function to handle /getSingleFood
function getSingleFood($conn, $foodId) {
    header('Content-Type: application/json');

    //  TODO - mysqli_real_escape_string
    $sql = "SELECT 
                food.id AS FoodId,
                food.name AS FoodName,
                food.kcal_per_unit As kCal,
                food.protein_grams_per_unit as Protein,
                food.unit_caption_override As Override
            FROM 
                food
            WHERE
                food.id = $foodId";

    echo doQuery($sql, $conn);
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

    // Convert $uri to lowercase to make it case-insensitive
    $uri = strtolower($uri);    
    
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

        case '/nutribase.php/getsinglefood':
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
