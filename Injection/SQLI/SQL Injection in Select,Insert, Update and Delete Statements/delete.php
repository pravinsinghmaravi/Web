<?php
session_start();
include("connection.php");

// Redirect if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle POST request to delete account
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection
    $username_to_delete = mysqli_real_escape_string($connection, $_POST['username']);

    // Check if the current user is attempting to delete their own account
    $current_username = $_SESSION['username'];
    if ($username_to_delete === $current_username) {
        echo '<font color="#ff0000">You cannot delete your own account using this form.</font>';
    } else {
        // SQL query to delete user
        $delete_query = "DELETE FROM users WHERE username = '$username_to_delete'";

        if (mysqli_query($connection, $delete_query)) {
            // Account deleted successfully
            echo '<font color="#0000ff">Account deleted successfully!</font>';
        } else {
            // Error in deletion query
            echo '<font color="#ff0000">Error deleting account: ' . mysqli_error($connection) . '</font>';
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
            height: 100vh;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Account</h1>
        <p>Enter the username of the account you want to delete:</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required />
            </div>
            <input type="submit" class="btn" value="Delete Account" />
        </form>
        <a href="protected_page.php" class="btn">Cancel</a>
    </div>
</body>
</html>
