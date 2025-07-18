<?php
// Router für PHP Development Server
// Ersetzt .htaccess-Funktionalität

// Prüfe, ob die angeforderte Datei tatsächlich existiert (CSS, JS, Bilder, etc.)
$requestedFile = __DIR__ . $_SERVER['REQUEST_URI'];
if (is_file($requestedFile)) {
    return false; // Lade die Datei direkt
}

// Für alle anderen Anfragen: Route zu index.php mit URL als Parameter
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// Debug: Zeige die verarbeitete URL
error_log("Router: Processing URI: " . $uri);

// Setze die URL als GET-Parameter für das MVC-System
$_GET['url'] = $uri;

// Lade die Haupt-index.php
require 'index.php';
?> 