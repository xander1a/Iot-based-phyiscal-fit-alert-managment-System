<!DOCTYPE html>
<html>

<head>
    <title>Email Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md">
        <h1 class="text-2xl font-semibold mb-6">Contact Us</h1>

        <form action="" method="post">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="form-input" required>
            </div>

            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700">Message:</label>
                <textarea name="message" id="message" rows="4" class="form-textarea" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Send Email</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer autoloader

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get email and message from the form
    $recipientEmail = $_POST["email"];
    $message = $_POST["message"];

    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Configure the SMTP settings (replace with your SMTP details)
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set the sender and recipient
    $mail->setFrom('dushimimanaalexandre1@gmail.com', 'Alexandre');
    $mail->addAddress($recipientEmail);

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = 'Message from Contact Form';
    $mail->Body = $message;

    // Send the email
    if ($mail->send()) {
        echo 'Email has been sent!';
    } else {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
}
