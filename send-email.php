<?php
$your_email = "ict.teacher.ktm@gmail.com"; // Your email address where you want to receive the form data
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for required fields
if (empty($_POST['demo-name'])) {
        $errors[] = 'Name is required.';
    }
    if (empty($_POST['demo-email'])) {
        $errors[] = 'Email is required.';
    }
    if (empty($_POST['demo-category'])) {
        $errors[] = 'Subject category is required.';
    }
    if (empty($_POST['demo-message'])) {
        $errors[] = 'Message is required.';
    }

    // Validate and sanitize the input data
if (!filter_var($_POST['demo-email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        $name = filter_input(INPUT_POST, 'demo-name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'demo-email', FILTER_SANITIZE_EMAIL);
        $subject_category = filter_input(INPUT_POST, 'demo-category', FILTER_SANITIZE_STRING);
        $priority = filter_input(INPUT_POST, 'demo-priority', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'demo-message', FILTER_SANITIZE_STRING);
        $email_content = "Name: $name\nEmail Address: $email\nSubject Category: $subject_category\nPriority: $priority\nMessage:\n$message\n";

        // Mail it
mail($your_email, 'Contact Form Submission', $email_content);
        header("Location: index.html?contact=success");
        exit;
    }
}
?>
