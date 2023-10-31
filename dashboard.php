<?php
// Check if a task deletion request is made
if (isset($_POST['delete_task'])) {
    $task_id = $_POST['task_id']; // Assuming the task ID is passed as 'task_id'

    // // Connect to your database
    // $servername = "your_server";
    // $username = "your_username";
    // $password = "your_password";
    // $database = "your_database";
    
    $servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$database = "rwanxypu_fit";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the task from the database
    $sql = "DELETE FROM task WHERE id = $task_id"; // Replace 'your_table' with your actual table name

    if ($conn->query($sql) === TRUE) {
      //  echo "Task deleted successfully.";
    } else {
        echo "Error deleting task: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// ... Your existing code for displaying the tasks goes here ...
?>









<!DOCTYPE html>
<html lang="en">
<head>
     <!--<meta http-equiv="refresh" content="5">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Tailwind CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<style>
    @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

.animate-blink {
    animation: blink 1s linear infinite;
}

</style>

</head>
<?php
session_start();

// Check if the user is logged in and the user_code session variable exists
if (isset($_SESSION['user_code'])) {
    $user_code = $_SESSION['user_code'];
    // You can display the code on the dashboard page as needed.
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit();
}

// Database connection settings (modify these)
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

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve the latest record from the 'nodemcu' table for the user's code
$node = "SELECT * FROM nodemcu WHERE code='$user_code' ORDER BY id DESC LIMIT 1";
$out = $conn->query($node);



if ($out !== false) { // Check if the query executed successfully
    if ($out->num_rows > 0) { // Check if there are rows returned
        $data = $out->fetch_assoc();

        if ($data['bitrate'] < 60) {
            $take = "Deasese:Bradycardia
            Meaning:The heartbeat is under proposed one
            Treatment:Visting a doctor";
        } 
        else if( $data['bitrate'] >60&& $data['bitrate'] < 110){
            
            $take="Condtion:Normal
            Recomandation:You need physical activities
            to keep your heart heslthy.";
            
        }
        else
        
        {
            $take = "Desease:Tachycardia:
                Meaning:the heart rate is greater than normal .
                Treatment:Drinking less alcohol or
                caffeine,sleeping more,massage,Phyiscal exercises and Visting doctors for medication 
                and ablation at the time all proposed activities did not do anything for your heartbeat or when you get pain";
        }
    } else {
        header("Location: noData.php");
    }
} 

// ...
 else {
    // Redirect to a page indicating that there's no device
    header("Location: noDevice.php");
    exit();
}
date_default_timezone_set('Africa/Kigali');
$currentDate = date("Y-m-d"); // Get the current date in "YYYY-MM-DD" format

$sql = "SELECT * FROM task WHERE date = '$currentDate'";

$result = $conn->query($sql);

// Check if there are tasks for the current time
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $taskName = $row['task'];
}}

else {
      // echo "No tasks found for the current time.";
      //echo $currentTime;
      $taskName ="No task To day";
}
// ...
// Query to retrieve saved data from the 'task' table
$sql = "SELECT * FROM task";
$result = $conn->query($sql);
?>

<body class="bg-gray-200 font-sans">
    <div class="min-h-screen flex flex-col sm:flex-row">
        <!-- Sidebar -->
        <aside class="bg-blue-600 text-white w-64 sm:w-1/5 py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <ul class="mt-6 space-y-4">
                <li>
             
                    <a href="#dashboard.php" class="block text-gray-300 hover:text-white transition duration-150 ease-in-out">Dashboard</a>
                </li>

                <li>
                    <a href="Setting.php" class="block text-gray-300 hover:text-white transition duration-150 ease-in-out">Settings</a>
                </li>
                <li>
                    <a href="index.php" class="block text-gray-300 hover:text-white transition duration-150 ease-in-out">Logout</a>
                </li>
            </ul>
            <!-- Logout Button -->
            <!-- <button class="mt-auto block w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">
               <a href="index.php"></a>  Logout</button> -->
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <h2 class="text-2xl font-semibold mb-4">Welcome 
            <?php


if (isset($_SESSION['message'])) {
    echo "<script>alert('".$_SESSION['message']."');</script>";
    unset($_SESSION['message']); // Clear the session message
}
?>
 </h2>
            <!-- <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <p><strong>Name:</strong> John Doe</p>
                <p><strong>Email:</strong> john.doe@example.com</p>
                Add more user information here 
            </div> -->
            
            <!-- Sensor Readings -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
             
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Oxygen</h3>
                    <p><?php echo $data['oxgen'];?>% </p>
                </div>
              
                <div class="bg-white p-4 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-2">Time</h3>
                <p><?php echo $data['date'];?></p>
    <!--<p id="current-time">12:00 AM</p>-->
</div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Heart Rate</h3>
                    <p><?php  echo $data['bitrate'];?></p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                   





    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Event Registration</h1>
        <form action="task.php" method="POST">
        <div class="mb-4">
    <label for="place" class="block text-sm font-medium text-gray-700">Tasks</label>
    <select name="place" id="place" class="form-select mt-1 block w-full" required>
        <option value="Run">Run</option>
        <option value="Push up">Push up</option>
        <option value="Yoga">Yoga</option>
        <option value="Travel">Travel</option>
    </select>
</div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="form-input mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                <input type="time" name="time" id="time" class="form-input mt-1 block w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register</button>
        </form>
    </div>



     </div>

   <div class="bg-white p-4 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-2">Selected Tasks</h3>
    <?php
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output the table with retrieved data
        echo '<div class="overflow-x-auto">'; // Add this container for horizontal scrolling if needed
        echo '<table class="max-w-md w-full divide-y divide-gray-200">'; // Adjust the max-width here (e.g., max-w-md)
        echo '<thead class="bg-gray-50">';
        echo '<tr>';
        echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tasks</th>';
        echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>';
        echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>';
        echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody class="bg-white divide-y divide-gray-200">';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
             echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row['task']) . '</td>';
            echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row['date']) . '</td>';
            echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row['set_time']) . '</td>';
            // echo '<td class="px-6 py-4 whitespace-nowrap"><button class="text-red-500 hover:text-red-700" onclick="deleteTask(' . $row['id'] . ')"><i class="fas fa-trash-alt"></i></button></td>';
            echo '<td class="px-6 py-4 whitespace-nowrap"><form method="post"><input type="hidden" name="task_id" value="' . $row['id'] . '"><button type="submit" name="delete_task" class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt"></i> Delete</button></form></td>';

            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // Close the overflow-x-auto container
    } else {
        echo 'No data found.';
    }

    // Close the database connection
 ?>
</div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    
    <h3 class="text-xl font-semibold mb-2">Urgence</h3>

    <p class="text-red-500 animate-blink"><?php echo $take ?></p>
    
    
<h1 class="text-2xl font-semibold text-blue-500"><?php echo $taskName; ?></h1>
<?php
       $conn->close();
    ?>
</div>

              

               
    </div>


            </div>
        </main>
    </div>
</body>
</html>


<script>
    // Function to load content into the container div
    function loadContent(url) {
        var container = document.getElementById("content-container");

        // Use AJAX to fetch the content
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                container.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Add click event listeners to your navigation links
    document.querySelector('a[href="#settings"]').addEventListener("click", function (e) {
        e.preventDefault();
        loadContent("Settings.php");
    });

    document.querySelector('a[href="#profile"]').addEventListener("click", function (e) {
        e.preventDefault();
        loadContent("dashboard.php");
    });
</script>
<script>
    function updateTime() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        const formattedTime = `${hours}:${minutes} ${ampm}`;
        currentTimeElement.textContent = formattedTime;
    }

    setInterval(updateTime, 1000); // Update the time every second
    updateTime(); // Call the function to set the initial time
</script>