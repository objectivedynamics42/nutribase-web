<?php

function doQuery(string $sql, $params, $conn) {
    // Prepare the query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ["error" => "Failed to prepare statement: " . $conn->error];
    }

    // Bind parameters if provided
    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assume all parameters are strings for simplicity
        $stmt->bind_param($types, ...$params);
    }

    // Execute the query
    if (!$stmt->execute()) {
        return ["error" => "Execution error: " . $stmt->error];
    }

    // Fetch results if the query returns any
    $result = $stmt->get_result();
    $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

    // Free resources and return data
    $stmt->close();
    return $data;
}

function sendResponse($content, $contentType = 'application/json', $httpStatus = 200) {
    http_response_code($httpStatus);
    header("Content-Type: $contentType; charset=utf-8");
    if (is_array($content)) {
        echo json_encode($content);
    } else {
        echo $content;
    }
    exit;
}

function getTags($conn) {
    $sql = "SELECT id AS TagId, name AS TagName FROM tag ORDER BY name";
    $result = doQuery($sql, [], $conn);

    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }

    $html = "<div>";
    foreach ($result as $row) {
        $tagName = htmlspecialchars($row['TagName']);
        $tagId = htmlspecialchars($row['TagId']);
        $html .= "<div data-tag-id='" . $tagId . "'>" . getAnchorForTaggedFoods($tagId, $tagName) . "</div>";
    }
    $html .= "</div>";

    sendResponse($html, 'text/html');
}

function getFoods($conn, $tagId) {
    $sql = "SELECT food.id AS FoodId, food.name AS FoodName FROM food 
            INNER JOIN tagged_food ON tagged_food.food_id = food.id 
            WHERE tagged_food.tag_id = ? ORDER BY food.name";
    $result = doQuery($sql, [$tagId], $conn);

    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }

    $html = "<div";
    foreach ($result as $row) {
        $foodId = htmlspecialchars($row['FoodId']);
        $foodName = htmlspecialchars($row['FoodName']);
        $html .= "<div data-food-id='" . $foodId . "'>" . getAnchorForFood($foodId, $foodName) . "</div>";
    }
    $html .= "</div>";

    sendResponse($html, 'text/html');
}

function getAnchorForTaggedFoods($tagId, $tagName) {

    $url = "https://objectivedynamics.co.uk/nutribase/getFoods?tagId=" . $tagId;
    return "<a href=\"". $url . "\">" . $tagName . "</a>";
}

function getAnchorForFood($foodId, $foodName){
    $url = "https://objectivedynamics.co.uk/nutribase/getSingleFood?foodId=" . $foodId;
    return "<a href=\"". $url . "\">" . $foodName . "</a>";
}

function getSingleFood($conn, $foodId) {
    $sql = "SELECT id AS FoodId, name AS FoodName, kcal_per_unit AS kCal, 
                   protein_grams_per_unit AS Protein, unit_caption_override AS Override 
            FROM food WHERE id = ?";
    $result = doQuery($sql, [$foodId], $conn);

    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }

    if (count($result) === 0) {
        sendResponse(["error" => "No food item found with the given ID."], 'application/json', 404);
    }

    $row = $result[0];
    $html = "<div data-food-id='" . htmlspecialchars($row['FoodId']) . "'>
                <div>Item: " . htmlspecialchars($row['FoodName']) . "</div>
                <div>kCal: " . htmlspecialchars($row['kCal']) . "</div>
                <div>Protein: " . htmlspecialchars($row['Protein']) . "</div>
                <div>Override: " . htmlspecialchars($row['Override']) . "</div>
            </div>";

    sendResponse($html, 'text/html');
}

// Database connection details
$servername = "localhost";
$username = "object_nutribase_admin";
$password = "NKR@bjp6uab0kpv8fut";
$dbname = "object_nutribase";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    sendResponse(["error" => "Connection failed: " . $conn->connect_error], 'application/json', 500);
}

// Handle routing
if (isset($_SERVER['REQUEST_URI'])) {
    $uri = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $query = [];
    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query);
    $query = array_change_key_case($query, CASE_LOWER);

    switch ($uri) {
        case '/nutribase.php/gettags':
        case '/nutribase/gettags':
        case '/':
            getTags($conn);
            break;

        case '/nutribase.php/getfoods':
        case '/nutribase/getfoods':
            if (isset($query['tagid'])) {
                getFoods($conn, $query['tagid']);
            } else {
                sendResponse(["error" => "Missing required parameter: tagid"], 'application/json', 400);
            }
            break;

        case '/nutribase.php/getsinglefood':
        case '/nutribase/getsinglefood':
            if (isset($query['foodid'])) {
                getSingleFood($conn, $query['foodid']);
            } else {
                sendResponse(["error" => "Missing required parameter: foodid"], 'application/json', 400);
            }
            break;

        default:
            sendResponse(["error" => "Endpoint not found", "uri" => $uri], 'application/json', 404);
            break;
    }
} else {
    sendResponse(["error" => "Invalid request"], 'application/json', 500);
}

$conn->close();
?>
