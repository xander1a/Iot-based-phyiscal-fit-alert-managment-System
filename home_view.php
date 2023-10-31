<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Energy Meter Dashboard</title>
</head>
<body class="bg-gray-100">

            <div id="data-container">
        <!-- The fetched data will be displayed here -->
        
        
        
    </div>
    
    
    
    
    
    <script>
        function fetchDataAndRefresh() {
            $.ajax({
                url: 'dashboard.php', // Replace with the actual URL of your server-side script
                type: 'GET', // Or 'POST' depending on your server script
                dataType: 'html',
                success: function(data) {
                    // Update the content of the div with the fetched data
                    $('#data-container').html(data);
                }
            });
        }

        // Call fetchDataAndRefresh initially
        fetchDataAndRefresh();

        // Set a timer to refresh the data every X seconds
        setInterval(fetchDataAndRefresh, 1000); // Replace 5000 with your desired refresh interval in milliseconds
    </script>
</body>
</html>
