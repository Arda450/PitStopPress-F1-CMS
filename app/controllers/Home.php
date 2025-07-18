<?php
/**
 * home class
 */

# the Home class extends the Controller class
# we import the functions from Controller into the class Home
class Home {
  use Controller;
  # it is a public function, so that we can call it from outside the class
  # the index function is inside the Home class
  public function index() {

    $articleModel = new Article();
    $articles = $articleModel->findAll();
    $this->view('home', ['articles' => $articles]);
    }  

    public function schedule() {
      $this->view('schedule');
    } 
    
    public function results() {
      $resultModel = new Result();
      $results = $resultModel->findAll();
      $this->view('results', ['results' => $results]);
    }

    public function drivers() {
      $this->view('drivers');
    }  

    public function blog() {

      $blogModel = new Blog();
      $blogs = $blogModel->findAll();
      $this->view('blog', ['blogs' => $blogs]);
    }  

    public function register() {
      $this->view('register');
    }  
    
    public function login() {
      $this->view('login');
    }  

    public function impressum() {
      $this->view('impressum');
    }  

    public function contact() {
      $this->view('contact');
    }  
    
    public function policy() {
      $this->view('policy');
    }  

  

}

