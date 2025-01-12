<?php

define('APP_ROOT', __DIR__ . '/');

require_once APP_ROOT . 'app/helpers/helpers.php';
require_once APP_ROOT . 'app/repositories/NutribaseRepository.php';
require_once APP_ROOT . 'app/controllers/FoodItemController.php';
require_once APP_ROOT . 'app/controllers/LoginController.php';
require_once APP_ROOT . 'app/controllers/TagsController.php';
require_once APP_ROOT . 'app/controllers/TaggedFoodsController.php';

// Database connection details
$servername = "localhost";
$username = "object_nutribase_admin";
$password = "NKR@bjp6uab0kpv8fut";
$dbname = "object_nutribase";

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/error.log');  // Adjust path as needed

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $repository = new NutribaseRepository($conn);

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
                $tagsController = new TagsController($repository);
                $tagsController->getTags();
                break;

            case '/nutribase.php/getfoods':
            case '/nutribase/getfoods':
                if (!isset($query['tagid'])) {
                    sendResponse(["error" => "Missing required parameter: tagid"], 'application/json', 400);
                    break;
                }
                $taggedFoodsController = new TaggedFoodsController($repository, (int)$query['tagid']);
                $taggedFoodsController->getTaggedFoods();
                break;

            case '/nutribase.php/getsinglefood':
            case '/nutribase/getsinglefood':
                if (!isset($query['foodid'])) {
                    sendResponse(["error" => "Missing required parameter: foodid"], 'application/json', 400);
                    break;
                }
                $foodItemController = new FoodItemController($repository, (int)$query['foodid']);
                $foodItemController->getFoodItem();
                break;

            case '/login':
                $loginController = new LoginController($repository);
                $loginController->login();
                break;

            default:
                sendResponse(["error" => "Endpoint not found", "uri" => $uri], 'application/json', 404);
                break;
        }
    }
} catch (Exception $e) {
    sendResponse(["error" => $e->getMessage()], 'application/json', 500);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
