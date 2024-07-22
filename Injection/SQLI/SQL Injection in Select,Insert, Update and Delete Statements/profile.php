<?php
include("connection.php");
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Update username
    if (isset($_POST['update_username'])) {
        $new_username = $_POST['username'];
        $update_query = "UPDATE users SET username='$new_username' WHERE username='$username'";
        if (mysqli_query($connection, $update_query)) {
            echo '<div class="message success">Username updated successfully!</div>';
        } else {
            echo '<div class="message error">Error: ' . mysqli_error($connection) . '</div>';
        }
    }

    // Update Email
    if (isset($_POST['update_email'])) {
        $new_email = $_POST['email'];
        $update_query = "UPDATE users SET email='$new_email' WHERE username='$username'";
        if (mysqli_query($connection, $update_query)) {
            echo '<div class="message success">Email updated successfully!</div>';
        } else {
            echo '<div class="message error">Error: ' . mysqli_error($connection) . '</div>';
        }
    }

    // Update password
    if (isset($_POST['update_password'])) {
        $new_password = $_POST['password'];
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password='$new_password_hashed' WHERE username='$username'";
        if (mysqli_query($connection, $update_query)) {
            echo '<div class="message success">Password updated successfully!</div>';
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
    <title>User Profile</title>
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
            max-width: 600px;
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

        .panel h2 {
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
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
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
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
    <h1>User Profile</h1>

    <!-- Update Username Section -->
    <div class="panel">
        <h2>Update Username</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required />
            </div>
            <div class="form-group">
                <input type="submit" name="update_username" value="Update Username" />
            </div>
        </form>
    </div>

    <!-- Update Email Section -->
    <div class="panel">
        <h2>Update Email</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />
            </div>
            <div class="form-group">
                <input type="submit" name="update_email" value="Update Email" />
            </div>
        </form>
    </div>

    <!-- Update Password Section -->
    <div class="panel">
        <h2>Update Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required />
            </div>
            <div class="form-group">
                <input type="submit" name="update_password" value="Update Password" />
            </div>
        </form>
    </div>

    <a href="logout.php">Logout</a>
</div>
</body>
</html>
