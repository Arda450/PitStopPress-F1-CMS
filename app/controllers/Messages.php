<?php

class MessagesController {

    public static function displayMessages($errors, $success) {
        if (!empty($errors)) {
            echo '<div class="messages error">';
            foreach ($errors as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>';
            }
            echo '</div>';
        }

        if (!empty($success)) {
            echo '<div class="messages success">';
            foreach ($success as $message) {
                echo '<p>' . htmlspecialchars($message) . '</p>';
            }
            echo '</div>';
        }
    }
}
