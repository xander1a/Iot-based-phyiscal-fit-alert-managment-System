


<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in (user_id session variable is set)
if (isset($_SESSION['user_code'])) {
    $user_id = $_SESSION['user_code'];

    // Database connection configuration
    // $hostname = 'localhost'; // Replace with your database hostname
    // $username = 'root'; // Replace with your database username
    // $password = ''; // Replace with your database password
    // $database = 'heart'; // Replace with your database name
    

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

    // Fetch user-specific data using $user_id
    $query = "SELECT * FROM user WHERE code = '$user_id'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        // Display user-specific data on the dashboard
        //echo "Welcome, " . $user_data['name']; // Replace 'name' with the actual column name in your database
        // You can display other user data as needed
    } else {
        header("Location: noData.php");
    }

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
    <title>Dashboard</title>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 font-sans">
    <div class="min-h-screen flex flex-col sm:flex-row">
        <!-- Sidebar -->
        <aside class="bg-blue-600 text-white w-64 sm:w-1/5 py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <ul class="mt-6 space-y-4">
                <li>
                    <a href="dashboard.php" class="block text-gray-300 hover:text-white transition duration-150 ease-in-out">Dashboard</a>
                </li>
               
                <li>
                    <a href="Setting.php" class="block text-gray-300 hover:text-white transition duration-150 ease-in-out">Settings</a>
                </li>

                <li>
                    <a href="index.php" class="block text-gray-300 hover:text-white transition duration-150 ease-in-out">Logout</a>
                </li>
            </ul>
            <!-- Logout Button -->
            <!-- <button class="mt-auto block w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Logout</button> -->
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
         





            <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-semibold mb-4">User Data</h2>
        <!-- Search Bar -->
        <!-- <input type="text" id="search" class="w-full p-2 border rounded-md mb-4" placeholder="Search by name or email...">
         -->
        <!-- Data Table -->
        <table class="w-full bg-white border rounded-md shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Full Name</th>
                    <th class="px-6 py-3 text-left">Code</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-left">Password</th>
                    <th class="px-6 py-3 text-left">Update</th>
                    <th class="px-6 py-3 text-left">Delete</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Sample data rows -->
         
                <tr>
                <td class="px-6 py-4"><?php echo $user_data['first_name']; ?></td>
            
                <td class="px-6 py-4"><?php echo $user_data['code']; ?></td>
                <td class="px-6 py-4"><?php echo $user_data['phone']; ?></td>
          
                    <td class="px-6 py-4">********</td>

                    <td class="px-6 py-4">
                        
                    <a href="updateMe.php" class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" value="<?php echo $user_data['id']; ?>">Update</a>

</td>
<td class="px-6 py-4">
    <a href="delete_user.php?user_id=<?php echo $user_data['id']; ?>" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Delete</a>
</td>

                </tr>
                <!-- Add more data rows here -->
            </tbody>
        </table>
    </div>








            </div>
        </main>
    </div>




    <!-- JavaScript for Search Functionality -->
    <script>
        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('table-body');

        searchInput.addEventListener('input', () => {
            const searchValue = searchInput.value.toLowerCase();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach((row) => {
                const columns = row.querySelectorAll('td');
                let found = false;

                columns.forEach((column) => {
                    const text = column.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
