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
    <style>
        .container {
            width: 400px; /* Set your desired fixed width */
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-200">
<div class="container">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h1 class="text-xl font-semibold mb-6">Physical Fitting and Coaching Tracker</h1>
        <?php
        session_start();
        if (isset($_SESSION['success_message'])) {
            echo '<div class="bg-green-500 text-white py-1 px-2 rounded-md mb-4">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']); // Clear the success message
        }

        if (isset($_SESSION['error_message'])) {
            echo '<div class="bg-red-500 text-white py-1 px-2 rounded-md mb-4">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Clear the error message
        }
        ?>

        <div>
            <h2 class="text-xl font-semibold mb-4">Reset Password</h2>
            <form action="" method="post">
                <div class="mb-4">
                    <label for="login-email" class="block text-gray-600 font-medium">Device code</label>
                    <input type="number" id="login-email" name="code" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400">
                </div>
                <div class="mb-4">
                    <label for="login-password" class="block text-gray-600 font-medium">New Password</label>
                    <input type="password" id="login-password" name="login-password" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400">
                </div>
                
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Reset</button>
                <a href="index.php" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Back to Login</a>
            </form>
        </div>
    </div>
</div>
<script>
    function showAlert(message) {
        alert(message);
    }
</script>

</body>
</html>


<?php
// Database connection configuration
    $servername = "localhost";
   $username = "rwanxypu_fit";
   $password = "WJqVqL=&g?%b";
  $dbname = "rwanxypu_fit";
    // Create a database connection
    $conn = new mysqli( $servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST["code"];
    $password = $_POST["login-password"];
    $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM user WHERE code='$code'";
    $result = $conn->query($checkEmailQuery);
  // $use_email=$result->num_rows['email'];
    if ($result->num_rows > 0) {
        // Email exists, proceed with the update
        // SQL query to update user data in the database
        $updateQuery = "UPDATE user SET password='$password' WHERE code='$code'";
        
       if ($conn->query($updateQuery) === TRUE) {
    // Set a session message for success
    $_SESSION['success_message'] = "Password updated successfully";
 header("Location: forgot.php"); // Replace 'dashboard.php' with the actual URL of the page you want to return to
    // Call the JavaScript function to display the alert
   // echo '<script>alert("Password updated successfully");</script>';
}

    } 
    
    else {
        // Email does not exist
        $_SESSION['error_message'] = "User with this email does not exist. <a href='index.php' class='text-blue-500 hover:text-blue-700'>Create an account</a>";
    }
}

// Close the database connection
$conn->close();
?>
