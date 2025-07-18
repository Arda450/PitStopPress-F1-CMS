<?php
/**
 * Login class
 */

# the Home class extends the Controller class
# we import the functions from Controller into the class Home
class Login {

    use Controller, Model;

    private $userModel; // Variable to hold the User model instance

    public function __construct() {
        $this->userModel = new User(); // Initialize the User model
    }

    public function index() {
        $this->view('login');
    }

    public function authenticate() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and retrieve username and password
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));

            // Initialize errors array
            $errors = [];

            // Check if username or password is empty
            if (empty($username) || empty($password)) {
                $errors['login'] = 'Invalid username or password. Please try again.';
            } else {
                // Perform login validation and database check
                $user = $this->userModel->first(['username' => $username]);

                // Check if user exists and password is correct
                if ($user && password_verify($password, $user['hash'])) {
                    // Login successful
                    session_start();
                    $_SESSION['user_id'] = $user['id']; // Store user ID in session
                    $_SESSION['username'] = $user['username']; // Store username in session
                    $_SESSION['login_time'] = time();    // Store login time
                    header('Location: ' . ROOT . '/dashboard/home');
                    exit();
                } else {
                    // Login failed
                    $errors['login'] = 'Invalid username or password. Please try again.';
                }
            }

            // If there are errors, redirect back to login with errors
            if (!empty($errors)) {
                $errorString = http_build_query($errors);
                $inputsString = http_build_query(['username' => $username]);
                header("Location: " . ROOT . "/login?" . $errorString . '&' . $inputsString);
                exit();
            }
        } else {
            // Handle invalid request method
            http_response_code(404);
            header('Location: ' . ROOT . '/home/404');
            exit();
        }
    }
}
?>
