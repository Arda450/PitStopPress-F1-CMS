<?php
# create basic functionalities to load views

Trait Controller{
  # this function will be used outside the class, hence the tag "public"
  public function view($name, $data = []) {
    // Extrahiere die Daten als Variablen
    extract($data);

    # whatever the name of the file is, add a .view.php to it
    # and find it in the views folder
    $filename = "../app/views/".$name.".view.php";
    if(file_exists($filename)) {
      require_once $filename;

    } else {

      $filename = "../app/views/404.view.php";
      require_once $filename;
    }
  }

  public function model($model) {
    require_once '../app/models/' . $model . '.php';
    return new $model();
}


}
