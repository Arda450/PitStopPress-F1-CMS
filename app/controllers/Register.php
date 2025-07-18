<?php
ob_start();

class Register {
    
    use Database, Model;

    private $registerErrors = [];
    private $userModel;

    public function __construct() {
        $this->userModel = new User(); // Instanziieren des User-Modells für Datenbankoperationen
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars(trim($_POST['password']));
            $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));


            // Validation logic
            if (empty($username)) {
                $this->registerErrors['usernameEmptyError'] = 'Username is required';
            } elseif (strlen($username) < 4 || strlen($username) > 16) {
                $this->registerErrors['usernameLengthError'] = 'Username must be between 4 and 16 characters long';
            } elseif (strpos($username, ' ') !== false) {
                $this->registerErrors['usernameSpaceError'] = 'Username cannot contain spaces';
            }

            if (empty($email)) {
                $this->registerErrors['emailError'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->registerErrors['emailError'] = 'Invalid email format';
            }

            if (empty($password)) {
                $this->registerErrors['passwordEmptyError'] = 'Password is required';
            } elseif (strlen($password) < 8) {
                $this->registerErrors['passwordLongError'] = 'Password must be at least 8 characters long';
            } elseif (!preg_match('/[a-z]/', $password)) {
                $this->registerErrors['passwordLowercaseError'] = "Password must contain at least one lowercase letter";
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $this->registerErrors['passwordUppercaseError'] = "Password must contain at least one uppercase letter";
            } elseif (!preg_match('/\d/', $password)) {
                $this->registerErrors['passwordOnedigitError'] = "Password must contain at least one digit";
            } elseif (!preg_match('/[^\w\d]/', $password)) {
                $this->registerErrors['passwordSpecialcharsError'] = "Password must contain at least one special character";
            }

            if ($password !== $confirm_password) {
                $this->registerErrors['passwordMismatchError'] = 'Passwords do not match';
            }

            if (!empty($this->registerErrors)) {
                $errorString = http_build_query($this->registerErrors);
                $inputsString = http_build_query($_POST);
                // header('location: ../views/register.view.php?' . $errorString .'&' . $inputsString);
                header("Location:" . ROOT . "/home/register?" .  $errorString .'&' . $inputsString);
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

           // Insert user into database
            $this->userModel->insert(['username' => $username, 'email' => $email, 'hash' => $hashed_password]);


            
            header('Location: ' . ROOT . '/home/login?success=Registration successful. Please log in.');
            exit();
        } else {
            http_response_code(404);
            header('Location: ../views/home/404');
            exit();
        
            }
        }
    }

    $register = new Register();
    $register->register();
?>
