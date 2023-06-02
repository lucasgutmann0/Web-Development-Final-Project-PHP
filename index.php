<?php
// load .env file
require('./vendor/autoload.php');
include('./config/secrets.php');

// get global variables
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $_SERVER['REQUEST_URI'])[2];
$path_clean = explode('?', $path);

// define routes
$routes = [
  '' => '/views/home.php',
  'home' => '/views/home.php',
  'autos' => '/views/autos.php',
  'trabajadores' => '/views/trabajadores.php',
  'personas' => '/views/personas.php',
  'cargos' => '/views/cargos.php',
  'orden_de_trabajo' => '/views/router_orden_de_trabajo.php',
  'generar_pdf' => '/views/generate_pdf.php',
  'inform' => '/templates/inform.php',
  'api' => '/app/Controllers/ApiController.php'
];

// check and return routes 
if (array_key_exists($path_clean[0], $routes)) {
  require __DIR__ . $routes[$path_clean[0]];
} else {
  require(__DIR__ . '/views/404.php');
}
