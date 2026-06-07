<?php
session_start();
require_once("settings.php");

// Connect to the database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (isset($_POST['login'])) {
    // Get and clean user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check user login details
    $sql = "SELECT * FROM users
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Store username in the session
        $_SESSION['username'] = $username;

        header("Location: profile.php");
        exit();
    } else {
        echo "<p>Invalid username or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h1>Login</h1>

    <form method="post">
        Username:
        <input type="text" name="username" required>
        <br><br>

        Password:
        <input type="password" name="password" required>
        <br><br>

        <input type="submit" name="login" value="Login">
    </form>

</body>
</html>
