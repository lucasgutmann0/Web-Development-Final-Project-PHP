<?php
// get global variables
$uri = explode('/', $_SERVER['REQUEST_URI']);
$uri_clean = explode('?', $uri[2]);

$folder = dirname(__DIR__);
$path = '';

if (count($uri_clean) < 2) {
  $path = '/views/orden_de_trabajo.php';
} else {
  $path = '/views/detalle_orden_trabajo.php';
}

include $folder . $path;
