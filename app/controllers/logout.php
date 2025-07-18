<?php

class Logout {
    use Controller;

    public function index() {
        session_start();

        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session.
        session_destroy();

        // Redirect to login view page
        header("Location: " . ROOT . "/login");
        exit();
    }
}
?>
