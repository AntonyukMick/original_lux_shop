<?php

// Laravel router for PHP built-in server
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Handle static files
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Handle all other requests through Laravel
require_once __DIR__ . '/index.php';
