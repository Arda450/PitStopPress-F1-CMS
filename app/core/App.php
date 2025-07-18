<?php


class App {

  // 
  private $controller = 'Home';
  private $method = 'index';

  // This splitURL method splits url into parts and returns an array
  private function splitURL() {
    $URL = $_GET['url'] ?? 'home';
    $URL = explode("/", trim($URL, "/"));
    return $URL;
  }

  // the loadController method attempts to load the controller based on the URL
  // it calls the correct controller for the view file
  public function loadController() {

    $URL = $this->splitURL();
  # everything is based on the public folder
  # once the url is split, it will load the first item of the url
    $controllerName = ucfirst($URL[0]);
  /** Select controller */
    $filename = "../app/controllers/{$controllerName}.php";
  
    if(file_exists($filename)) {
      require $filename;
      $this->controller = $controllerName;
      unset($URL[0]);
    } else {
        $this->controller = "_404";
        $filename = "../app/controllers/_404.php";
        require $filename;
      
    }

    $controllerInstance = new $this->controller;
    // instantiates the controller class
    // $controller is equal to whatever is in the $this->controller variable

    /** Select method */
    if(!empty($URL[1])) {
      if(method_exists($controllerInstance, $URL[1])) {
        $this->method = $URL[1];
        unset($URL[1]);
        } 
      } else {
          if (!method_exists($controllerInstance, $this->method)) {
              $this->method = 'index';
          }
    }
  
    # the first parameter is the callback func or method
    # the second parameter is an array containing parameters
    # that you want to pass to the callback function
    # default method is index
    call_user_func_array([$controllerInstance, $this->method], $URL ? array_values($URL) : []);
  }


}