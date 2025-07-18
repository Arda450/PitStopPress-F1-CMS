<?php

session_start();

# this line loads everything in the core folder
require "../app/core/init.php";

DEBUG ? ini_set('display_errors', 1) :  ini_set('display_errors', 0);
 
$app = new App;
$app->loadController();


?>
