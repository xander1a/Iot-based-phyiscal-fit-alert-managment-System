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
<div class="bg-image p-4 sm:p-8 md:p-12 lg:p-16 rounded-lg shadow-md w-full sm:w-11/12 md:w-10/12 lg:w-9/12 mx-auto">
    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-semibold mb-6 text-center">Physical Fitting and Coaching Tracker</h1>
    <div class="flex flex-col sm:flex-row justify-between">
        <div class="mb-4 sm:mb-0 sm:mr-4 w-full sm:w-1/2 md:w-1/2 lg:w-1/2">
            <h2 class="text-xl sm:text-2xl font-semibold mb-4">Login</h2>
                <form action="userLogin.php" method="post">
                <div class="mb-4">
                    <label for="login-code" class="block text-gray-600 font-medium">Device Code</label>
                    <input type="number" id="login-password" name="login-code" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400"
                    placeholder="Enter Device code">
                </div>
                <div class="mb-4">
                    <label for="login-password" class="block text-gray-600 font-medium">Password</label>
                    <input type="password" id="login-password" name="login-password" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400"
                    placeholder="Enter Password">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
                <br><a href="forgot.php" class="text-blure">Forgot password</a>
            </form>
        </div>
        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2">
            <h2 class="text-xl sm:text-2xl font-semibold mb-4">Register</h2>
            
 <div id="validation-message" class="text-red-500 text-sm"></div>
            <form action="insertUser.php" method="post" onsubmit="return validateForm()">
                <div class="mb-4">
                    <label for="register-name" class="block text-gray-600 font-medium">Your name</label>
                    <input type="text" id="register-name" name="register-full_name" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400"
                    placeholder="Enter Your name">
                </div>
                <div class="mb-4">
                    <label for="register-email" class="block text-gray-600 font-medium">Phone</label>
                    <input type="number"  id="new-phone" name="register-phone" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400"
                    placeholder="Enter Phone number">
                </div>
                <div class="mb-4">
                    <label for="register-email" class="block text-gray-600 font-medium">Device Code</label>
                    <input type="number" id="register-code" name="register-code" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400"
                    placeholder="Enter device code">
                </div>
                <div class="mb-4">
                    <label for="register-password" class="block text-gray-600 font-medium">Password</label>
                    <input type="password" id="register-password" name="register-password" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-400"
                    placeholder="Enter password">
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Register</button>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-image {
        background: url('fit.jpg') center/cover no-repeat; /* Replace 'your-image-background.jpg' with your background image URL */
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>
<script>
    function validateForm() {
        var phoneInput = document.getElementById("new-phone");
        var phoneValue = phoneInput.value;
        var validationMessage = document.getElementById("validation-message");

        // Use a regular expression to validate the phone number
        var phoneRegex = /^078\d{7}$/;

        if (!phoneRegex.test(phoneValue)) {
            validationMessage.textContent = "Phone number must start with '078' and have 10 digits.";
            phoneInput.focus();
            return false;
        } else {
            validationMessage.textContent = ""; // Clear the validation message
        }

        return true;
    }
</script>
</body>
</html>
