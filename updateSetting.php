
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
// Start a session to access session variables
session_start();

$servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$dbname = "rwanxypu_fit";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in (user_code session variable is set)
if (isset($_SESSION['user_code'])) {
    $user_id = $_SESSION['user_code'];

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newFirstName = $_POST['new-first-name'];
        $newCode = $_POST['code'];
        $newPhone = $_POST['new-phone'];

        // Update user data in the database
        $updateQuery = "UPDATE user SET first_name = ?, code = ?, phone = ? WHERE code = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssss", $newFirstName, $newCode, $newPhone, $user_id);

        if ($stmt->execute()) {
          
                            echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">User Updated Successfully</strong>
    <a href=" dashboard.php" class="text-blue-500 hover:text-blue-700">Back </a>
</div>';
            // header("Location: dashboard.php"); // Redirect to the dashboard or any other page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php"); // Replace 'login.php' with the actual login page URL
    exit();
}
?>
