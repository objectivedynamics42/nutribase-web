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

function bootstrapWrap($content){
    $bootstrapUrl = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css";

    $customBackground =
    "<style>" .
        ".custom-blue-bg {" .
            "background-color: #17a2b8;".
        "}" .
    "</style>";

    $preContent = "<!DOCTYPE html>" .
        "<html lang=\"en\">" .
        "<!-- Version 1 -->" .
        "<head>" .
        "<meta charset=\"UTF-8\">" .
        "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">" .
        "<title>Nutribase</title>" .
        "<link href=\"". $bootstrapUrl . "\" rel=\"stylesheet\">" .
        $customBackground .
        "</head><body>";
    $postContent =  "</body></html>";

    $html = $preContent . $content . $postContent;

    return $html;
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

function getAnchorForTaggedFoods($tagId, $tagName) {

    $url = "https://objectivedynamics.co.uk/nutribase/getFoods?tagId=" . $tagId;

    return "<a href=\"". $url . "\" class=\"text-decoration-none\">" . $tagName . "</a>";
}

function getAnchorForFood($foodId, $foodName){
    $url = "https://objectivedynamics.co.uk/nutribase/getSingleFood?foodId=" . $foodId;

    return "<a href=\"". $url . "\" class=\"text-decoration-none\">" . $foodName . "</a>";
}

function getTags($conn) {
    $sql = "SELECT id AS TagId, name AS TagName FROM tag ORDER BY name";
    $result = doQuery($sql, [], $conn);

    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }

    $preContent = "<div class=\"container\">" .
        "<div class=\"row " . "custom-blue-bg" . " text-white text-center py-3\">" .
            "<h1>nutribase</h1>" .
        "</div>" .
        "<div class=\"row bg-secondary text-white py-2\">" .
            "<h2 class=\"text-center\">Categories</h2>" .
        "</div>" .
        "<div class=\"row mt-4\">" .
            "<div class=\"col\">" .
                "<ul class=\"list-group\">";

    $postContent = "</ul>" .
            "</div>" .
        "</div>" .
    "</div>" .
    "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";

    $content = "";
    foreach ($result as $row) {
        $tagName = htmlspecialchars($row['TagName']);
        $tagId = htmlspecialchars($row['TagId']);
        $item =
        "<li class=\"list-group-item text-center\">" .
            getAnchorForTaggedFoods($tagId, $tagName) .
        "</li>";
        $content .= $item;
    }

    $html = bootstrapWrap($preContent . $content . $postContent);

    sendResponse($html, 'text/html');
}

function getFoods($conn, $tagId) {

    //  Get tag name
    $sql = "SELECT tag.name AS tagName FROM tag
            WHERE tag.id = ? ORDER BY tag.name";
    $result = doQuery($sql, [$tagId], $conn);
    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }
    $row = $result[0];
    $tagName = $row['tagName'];

    //  Get foods
    $sql = "SELECT food.id AS FoodId, food.name AS FoodName FROM food 
            INNER JOIN tagged_food ON tagged_food.food_id = food.id 
            WHERE tagged_food.tag_id = ? ORDER BY food.name";
    $result = doQuery($sql, [$tagId], $conn);

    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }

    $preContent = "<div class=\"container\">" .
        "<div class=\"row " . "custom-blue-bg" . " text-white text-center py-3\">" .
            "<h1>nutribase</h1>" .
        "</div>" .
        "<div class=\"row bg-secondary text-white py-2\">" .
            "<h2 class=\"text-center\">" . $row['tagName'] . "</h2>" .
        "</div>" .
        "<div class=\"row mt-4\">" .
            "<div class=\"col\">" .
                "<ul class=\"list-group\">";

    $postContent = "</ul>" .
            "</div>" .
        "</div>" .
    "</div>" .
    "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";

    $content = "";
    foreach ($result as $row) {
        $foodId = htmlspecialchars($row['FoodId']);
        $foodName = htmlspecialchars($row['FoodName']);

        $item =
        "<li class=\"list-group-item text-center\">" .
            getAnchorForFood($foodId, $foodName) .
        "</li>";
        $content .= $item;
    }

    $html = bootstrapWrap($preContent . $content . $postContent);

    sendResponse($html, 'text/html');
}

function getSingleFood($conn, $foodId) {
    $sql = "SELECT id AS FoodId, name AS FoodName, kcal_per_unit AS kCal, 
                   protein_grams_per_unit AS protein, unit_caption_override AS override 
            FROM food WHERE id = ?";
    $result = doQuery($sql, [$foodId], $conn);

    if (isset($result["error"])) {
        sendResponse(["error" => $result["error"]], 'application/json', 500);
    }

    if (count($result) === 0) {
        sendResponse(["error" => "No food item found with the given ID."], 'application/json', 404);
    }

    $row = $result[0];
    $foodName = htmlspecialchars($row['FoodName']);

    $preContent = "<div class=\"container\">" .
        "<div class=\"row " . "custom-blue-bg" . " text-white text-center py-3\">" .
            "<h1>nutribase</h1>" .
        "</div>" .
        "<div class=\"row bg-secondary text-white py-2\">" .
            "<h2 class=\"text-center\">" . $foodName . "</h2>" .
        "</div>" .
        "<div class=\"row mt-4\">" .
            "<div class=\"col\">" .
                "<ul class=\"list-group\">";

    $postContent = "</ul>" .
            "</div>" .
        "</div>" .
    "</div>" .
    "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js\"></script>";

    $unit = $row['override'] ?? 'Per 100g';
    $proteinGrams = $row['protein'] ?? '0.0';
    $kCal = $row['kCal'];

    $content =
        "<h3 class=\"text-center\">" . htmlspecialchars($unit) . "</h2>" .
        "<li class=\"list-group-item d-flex justify-content-between align-items-center\">" .
            "<span>Calories:</span>" . 
            "<span class=\"ms-4\">" . htmlspecialchars($kCal)  . "</span>" .
            "</li>" .
        "<li class=\"list-group-item d-flex justify-content-between align-items-center\">" .
            "<span>Grams of Protein:</span>" . 
            "<span class=\"ms-4\">" . htmlspecialchars($proteinGrams)  . "</span>" .
        "</li>";

    $html = bootstrapWrap($preContent  . $content . $postContent);

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
        case '/nutribase':
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
