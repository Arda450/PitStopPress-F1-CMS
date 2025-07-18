<?php


  // database config
  define('DBNAME', 'pitstoppress_db');
  define('DBHOST', 'localhost');
  define('DBUSER', 'root');
  define('DBPASS', '');
  
// Dynamische ROOT-URL basierend auf Server
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
define('ROOT', $protocol . '://' . $host);

define('APP_NAME', "My Website");
define('APP_DESC', "Best website on the planet");

/** true means show errors */
define('DEBUG', true);
