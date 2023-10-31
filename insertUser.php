
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
// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['register-full_name'];
    $code = $_POST['register-code'];
    $phone = $_POST['register-phone'];
    $password = $_POST['register-password'];

    // Validation (you should add more validation as needed)
    if (empty($first_name) ||  empty($code) || empty($phone) || empty($password)) {
        echo "All fields are required.";
    } else {
        $first_name = mysqli_real_escape_string($conn, $first_name);
        $code = mysqli_real_escape_string($conn, $code);
        $phone = mysqli_real_escape_string($conn, $phone);
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the code already exists in the database
        $check_query = "SELECT code FROM user WHERE code = '$code'";
        $result = $conn->query($check_query);
        if ($result->num_rows > 0) {
         
            

            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Device code FOUND</strong>
            <span class="block sm:inline">Please Choose another device.</span>
            <a href="index.php" class="text-blue-500 hover:text-blue-700">Create an account</a>
        </div>';


        } else {
            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO user (first_name, code, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $first_name, $code, $phone, $password);

            if ($stmt->execute()) {
                
                            echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">New Device Registered Successfully</strong>
    <a href="index.php" class="text-blue-500 hover:text-blue-700">Back to Login</a>
</div>
';
                //header("Location: index.php");
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
}
?>
