

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register Page</title>
    <style>
        body {
            background: url('your-background-image.jpg') center/cover no-repeat; /* Replace 'your-background-image.jpg' with your background image URL */
        }
    </style>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 flex justify-center items-center min-h-screen">
    </body>
    </html>





<?php
// Database connection configuration
$hostname = 'localhost'; // Replace with your database hostname
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'heart'; // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["login-email"];
    $password = $_POST["login-password"];
    $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // SQL query to update user data in the database
    $sql = "UPDATE user SET password='$password' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        // Set a session message for success
        $_SESSION['success_message'] = "Data updated successfully";
    } else {
        $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Redirect back to the previous page
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
