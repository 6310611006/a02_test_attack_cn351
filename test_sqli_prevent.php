<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>SQL Injection Test</h1>
    <form method="GET">
        <label for="id">User ID:</label>
        <input type="text" name="id" id="id">
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php
    // Get the user input from the request
    $id = $_GET['id'];

    $servername = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "demo2";

    $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query using a prepared statement
    $sql = "SELECT id, username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    //ระบุกับผู้ใช้ว่า input เป็น string
    $stmt->bind_param("s", $id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Output each row
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Username: " . $row["username"] . "<br>";
        }
    } else {
        echo "No results found.";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>