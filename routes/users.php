<?php

header('Content-Type: application/json');

include_once 'config.php';
include_once 'utils/Database.php';
include_once 'models/User.php';
include_once 'controllers/UserController.php';

$database = new Database();
$db = $database->connect();

$userController = new UserController($db);

// Handle HTTP requests
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $userController->show($_GET['id']);
        } else {
            $userController->index();
        }
        break;
    case 'POST':
        $userController->store();
        break;
    case 'PUT':
        $userController->store();
        break;
    default:
        echo json_encode(array('message' => 'Invalid request method.'));
        break;
}
