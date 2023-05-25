<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
// process.php

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Create a database connection (replace with your own credentials)
$servername = "localhost";
$dbname = "demo2";
$dbuser = "root";
$dbpass = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);

// Simulate SQL injection vulnerability (for testing purposes only)
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    session_start();
                            
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;                            
    // Redirect user to welcome page
    header("location: welcome.php");
  

} else {
  // Authentication failed
  echo "Invalid username or password.";
}

// Close the database connection
$conn = null;
?>