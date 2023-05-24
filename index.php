<?php
// load .env file
require('./vendor/autoload.php');
include('./config/secrets.php');

// get global variables
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $_SERVER['REQUEST_URI'])[2];

// define routes
$routes = [
  '' => '/views/home.php',
  'home' => '/views/home.php',
  'autos' => '/views/autos.php',
  'trabajadores' => '/views/trabajadores.php',
  'personas' => '/views/personas.php',
  'api' => '/app/Controllers/ApiController.php'
];

// check and return routes 
if (array_key_exists($path, $routes)) {
  require __DIR__ . $routes[$path];
} else {
  require(__DIR__ . '/views/404.php');
}

