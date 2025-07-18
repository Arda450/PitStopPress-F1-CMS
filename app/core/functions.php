<?php

# "stuff" ist der platzhalter hier;
function show($stuff)
{
echo "<pre>";
print_r($stuff);
// try var_dump and die();
echo "</pre>";
}

/* prevents javascript inputs from users */
function esc($str) {
  return htmlspecialchars($str);
}

function redirect($path) {

  header("Location: " . ROOT ."/".$path);
  die;
}

// add as many functions as you need in here