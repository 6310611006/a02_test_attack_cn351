<?php
// Database credentials
$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "demo2";

// Create a connection
$conn = mysqli_connect($servername, $dbuser, $dbpass, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$userid = null;
if ($stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?")) {
    mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userid);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    
    // Prepare the INSERT statement
    $sql = "INSERT INTO messages (user_id, message) VALUES (?, ?)";
    
    // Prepare and bind the parameters
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $userid, $message);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Message stored successfully";
    } else {
        echo "Error storing message: " . mysqli_stmt_error($stmt);
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo $_SESSION["username"]; ?></b>. Welcome to our site.</h1>
    <form method="POST" action="">
        <input type="text" name="message" placeholder="Enter a message">
        <button type="submit">Submit</button>
    </form>
    
    <div class="message-container">
        <?php
        // Retrieve messages from the database
        $sql = "SELECT messages.message, users.username 
                FROM messages 
                INNER JOIN users ON messages.user_id = users.id
                ORDER BY messages.created_at DESC";
        $result = mysqli_query($conn, $sql);
        
        // Display the messages
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p><strong>" . $row["username"] . ":</strong> " . $row["message"] . "</p>";
            }
        } else {
            echo "No messages found.";
        }
        
        // Free the result set
        mysqli_free_result($result);
        ?>
    </div>
    
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="test_sqli.php" class="btn btn-warning">test sql injection</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>