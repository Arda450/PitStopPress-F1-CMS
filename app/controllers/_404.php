<?php

# the _404 class extends the Controller class
# we import the functions in Controller into the class _404
class _404 {

  use Controller;
  # it is a public function, so that we can call it from outside the class
  public function index() {
    

      
      $this->view('404');
    
    # if we get this message, it means things have worked
  }
}

