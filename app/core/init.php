<?php
/* this function is called when php tries
to run a class and it can't find it,
it tells what the classname is, its trying to find */
spl_autoload_register(function($classname) {
  
    require $filename = "../app/models/".ucfirst($classname).".php";
});

require 'config.php';
require 'functions.php';

require 'Database.php';
require 'Model.php';
require 'Controller.php';
# App.php should be loaded last, because it runs the website
require 'App.php';

# Model will expand Database and the Controller will also expand the Database