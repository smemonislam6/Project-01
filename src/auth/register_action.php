<?php
session_start();

require "../helpers/file.php";

// Main registration process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Validate form fields
    $error_name = form_empty($_POST['name']);
    $error_email = form_empty($_POST['email']);
    $error_password = form_empty($_POST['password']);
    $error_confirm_password = form_empty($_POST['confirm_password']);

    // Collect errors for empty fields
    if ($error_name || $error_email || $error_password || $error_confirm_password) {
        $errors[] = $error_name;
        $errors[] = $error_email;
        $errors[] = $error_password;
        $errors[] = $error_confirm_password;
    } else {
        // Sanitize and validate inputs
        $name = form_validation($_POST['name']);
        $email = form_validation($_POST['email']);
        $password = form_validation($_POST['password']);
        $confirm_password = form_validation($_POST['confirm_password']);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please provide a valid email.";
        }

        // Validate password length and match
        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        } elseif ($password !== $confirm_password) {
            $errors[] = "Password and Confirm Password do not match.";
        }

        // If no validation errors, proceed to store user data
        if (empty($errors)) {
            $filePath = "../../database/db.json";
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            // Write user data to file
            if (file_exists($filePath) && is_writable($filePath)) {
                write($filePath, $data);
                header("Location: login.php");
                exit;
            } else {
                $errors[] = "Unable to write to the database file.";
            }
        }
    }

    // Store errors in session and redirect to register page
    $_SESSION['error'] = $errors;
    header("Location: register.php");
    exit;
} else {
    // Redirect to register page if accessed directly
    header("Location: register.php");
    exit;
}
