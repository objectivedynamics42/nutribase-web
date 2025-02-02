<?php

define('APP_ROOT', __DIR__ . '/');

require_once APP_ROOT . 'app/Logger.php';

require_once APP_ROOT . 'app/controllers/AddUserController.php';
require_once APP_ROOT . 'app/controllers/AdminController.php';
require_once APP_ROOT . 'app/controllers/FoodItemController.php';
require_once APP_ROOT . 'app/controllers/LoginController.php';
require_once APP_ROOT . 'app/controllers/TagsController.php';
require_once APP_ROOT . 'app/controllers/TaggedFoodsController.php';

require_once APP_ROOT . 'app/helpers/helpers.php';
require_once APP_ROOT . 'app/helpers/Navigation.php';
require_once APP_ROOT . 'app/helpers/SharedConstants.php';

require_once APP_ROOT . 'app/repositories/NutribaseRepository.php';
require_once APP_ROOT . 'app/repositories/AuthRepository.php';

require_once APP_ROOT . 'app/views/AdminView.php';
require_once APP_ROOT . 'app/views/FoodItemView.php';
require_once APP_ROOT . 'app/views/LoginView.php';
require_once APP_ROOT . 'app/views/TaggedFoodsView.php';
require_once APP_ROOT . 'app/views/TagsView.php';


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
    Logger::log("Request recieved");
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

        Logger::log("Checking request uri: " . $uri);
        $path = preg_replace('#^/nutribase(?:\.php)?/(.+)$#', '$1', $uri);
        Logger::log("Preprocessed request uri as: " . $path);

        switch ($path) {
            case 'get-categories':
            case '/nutribase':
            case '/':
                $controller = new TagsController($repository);
                $controller->getTags();
                break;

            case 'add-user':
                //  /nutribase/add-user?email=popeye@home.com&password=sesame
                $email = $query['email'];
                $password = $query['password'];


                Logger::log("Creating auth repository");
                $repository = new AuthRepository($conn);
                $controller = new AddUserController($repository);
                $controller->addUser($email,$password);
                break;

            case 'get-foods':

                $tagID = $query['cat'];
                Logger::log("Request for /nutribase/get-foods with tagId: " . $tagID);

                if (!isset($tagID)) {
                    sendResponse(["error" => "Missing required parameter: tagid"], 'application/json', 400);
                    break;
                }
                $controller = new TaggedFoodsController($repository, (int)$tagID);
                $controller->getTaggedFoods();
                break;

            case 'get-food-item':

                $foodId = $query['foodid'];
                if (!isset($foodId)) {
                    sendResponse(["error" => "Missing required parameter: foodid"], 'application/json', 400);
                    break;
                }
                $backLinkTagId = $query['cat'];
                if (!isset($backLinkTagId)) {
                    sendResponse(["error" => "Missing required parameter: tagid"], 'application/json', 400);
                    break;
                }

                $controller = new FoodItemController($repository, (int)$foodId, (int)$backLinkTagId);
                $controller->getFoodItem();
                break;

            case 'admin':
                $controller = new AdminController();
                $controller->handleAdmin();
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
