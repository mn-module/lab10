<?php
session_start();

// Redirect user if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once("settings.php");

// Connect to the database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get username from the current session
$username = $_SESSION['username'];

if (isset($_POST['email'])) {
    // Clean the new email input
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Update user email
    $sql = "UPDATE users
            SET email='$email'
            WHERE username='$username'";

    mysqli_query($conn, $sql);
}

mysqli_close($conn);

// Return to profile page
header("Location: profile.php");
exit();
?>
