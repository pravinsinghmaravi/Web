<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the query (using prepared statements is recommended for better security)
    $query = "INSERT INTO users (username, email, password) VALUES ('$username','$email' , '$hashed_password')";
    
    if (mysqli_query($connection, $query)) {
        echo '<div style="text-align:center; margin-top: 20px; color: #007bff; font-size: 18px;">Registration successful! You can now <a href="login.php">login</a>.</div>';
    } else {
        echo '<div style="text-align:center; margin-top: 20px; color: #dc3545; font-size: 18px;">Error: ' . mysqli_error($connection) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #17a2b8; /* Changed color to #17a2b8 */
            color: #ffffff;
            cursor: pointer;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #138496; /* Darker shade on hover */
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }
        .message a {
            color: #007bff;
            text-decoration: none;
        }
        .message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> 
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
        <?php if(isset($message)) { echo '<div class="message">' . $message . '</div>'; } ?>
    </div>
</body>
</html>
