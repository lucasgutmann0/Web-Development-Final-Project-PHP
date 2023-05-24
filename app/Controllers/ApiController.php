<?php

namespace App\Controllers;
// get global variables
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $_SERVER['REQUEST_URI'])[3];
$method = $_SERVER['REQUEST_METHOD'];
$query = explode('&', $_SERVER['QUERY_STRING']);

$folder = dirname(__DIR__) . '/Controllers/api/';

$routes = [
  'personas' => 'PersonApiController.php'
];

// simplify path to endpoint - no query
$arr_path = explode('?', $path);
// check and return routes 
if (array_key_exists($arr_path[0], $routes)) {
  require $folder . $routes[$arr_path[0]];
} else {
  http_response_code(404);
  $res = array("message" => "Couldn't find requested path");
  echo json_encode($res);
}

