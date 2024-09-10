<?php
// Get the requested URL
$request_uri = $_SERVER['REQUEST_URI'];

// Remove query string and leading/trailing slashes
echo $request_uri = htmlentities(trim(parse_url($request_uri, PHP_URL_PATH), '/'));
echo '<br>';
// Define your routes
$routes = [
    'redirect/tes' => 'home.php',
    'redirect/tes/about' => 'about.php',
    'contact' => 'contact.php',
];
echo 'this is index';
echo '<br>';
// Check if the requested route exists
if (array_key_exists($request_uri, $routes)) {
    include $routes[$request_uri];
} else {
    // echo 'not found';
    include '404.php'; // Page not found
}
