<?php

header('Content-Type: application/json');

// Define the base path for the API
$basePath = '/native_api/index.php/api';

// Extract the requested route from the URL
$requestUri = $_SERVER['REQUEST_URI'];
$route = str_replace($basePath . '/', '', $requestUri);
$routeParts = explode('/', $route);

// Get the resource and remove any query parameters
$resource = array_shift($routeParts);
$resource = strtok($resource, '?');

// Define the file path based on the resource
$filePath = __DIR__ . '/routes/' . $resource . '.php';

// Check if the file exists and include it
if (file_exists($filePath)) {
    // Pass the remaining route parts as parameters to the included file
    include_once $filePath;
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Route not found.'));
}
