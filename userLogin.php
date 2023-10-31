

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

$servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$dbname = "rwanxypu_fit";

// In login.php and Setting.php
session_start();

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['login-code'];
    $password = $_POST['login-password'];

    // Sanitize and validate user input (you should implement proper validation)
    $code = mysqli_real_escape_string($conn, $code);

    // Check if the user exists with the provided code
    $query = "SELECT * FROM user WHERE code = '$code'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, fetch the user data
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Store user's code in a session variable
            $_SESSION['user_code'] = $row['code'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">Code or Password you provided is not correct.</span>
                <a href="index.php" class="text-blue-500 hover:text-blue-700">Back to Login</a>
            </div>';
        }
    } else {
        // User with the provided code does not exist
        echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">User not found!</strong>
            <span class="block sm:inline">The account associated with this code does not exist.</span>
            <a href="index.php" class="text-blue-500 hover:text-blue-700">Create an account</a>
        </div>';
    }

    // Close the database connection
    $conn->close();
}
?>
