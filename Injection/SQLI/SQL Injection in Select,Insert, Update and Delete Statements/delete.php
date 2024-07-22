<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_account'])) {
        $username = $_POST['username']; // Get username from the form

        $delete_query = "DELETE FROM users WHERE username='$username'";
        if (mysqli_query($connection, $delete_query)) {
            // Redirect to index page after successful deletion
            header("Location: index.php");
            exit();
        } else {
            echo '<div class="message error">Error: ' . mysqli_error($connection) . '</div>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
        }

        .panel {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #dc3545;
            color: white;
            cursor: pointer;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #c82333;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Delete Account</h1>

    <!-- Delete Account Section -->
    <div class="panel">
        <h2>Delete Your Account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <input type="submit" name="delete_account" value="Delete Account" />
            </div>
        </form>
    </div>

    <a href="profile.php">Back to Profile</a>
</div>
</body>
</html>
