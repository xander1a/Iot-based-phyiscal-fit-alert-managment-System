<?php
session_start();

$servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$dbname = "rwanxypu_fit";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in (user_code session variable is set)
if (isset($_SESSION['user_code'])) {
    $user_id = $_SESSION['user_code'];

    // Fetch user-specific data using prepared statement
    $query = "SELECT * FROM user WHERE code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
    } else {
        echo "User not found.";
    }

    $stmt->close();

    // Handle form submission


    // Close the database connection
    $conn->close();
} else {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php"); // Replace 'login.php' with the actual login page URL
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Update User Data</h2>
                <form action=updateSetting.php method="post"  >
                    <div class="mb-4">
                        <label for="new-first-name" class="block text-gray-600">Full Name</label>
                        <input type="text" name="new-first-name" id="new-first-name" class="w-full p-2 border rounded-md" value="<?php echo $user_data['first_name']; ?>" required>
                    </div>
                 
                    <div class="mb-4">
                        <label for="new-email" class="block text-gray-600">Code</label>
                        <input type="number" name="code" id="new-email" class="w-full p-2 border rounded-md" value="<?php echo $user_data['code']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="new-phone" class="block text-gray-600">Phone</label>
                        <input type="tel" name="new-phone" id="new-phone" class="w-full p-2 border rounded-md" value="<?php echo $user_data['phone']; ?>" required>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition duration-150 ease-in-out">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
