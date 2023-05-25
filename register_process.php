<?php
// register.php

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Create a database connection (replace with your own credentials)
$servername = "localhost";
$dbname = "demo2";
$dbuser = "root";
$dbpass = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Insert user data into the database
  $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
  $conn->exec($sql);

  // Registration successful

  header("location: login.php");
} catch (PDOException $e) {
  // Registration failed
  echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>