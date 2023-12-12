<?php
include("password.php");
$conn = new mysqli("localhost", "ethan-engebretson", $password, "ethan-engebretson_app");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $message = $_POST["message"];
    // query to insert data into table
    $sql = "INSERT INTO messages(name, message) VALUES ('$name', '$message')";
    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Clear all messages from the database
if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
    // query to truncate (clear) table
    $clearSql = "TRUNCATE TABLE messages";
    // Execute the query and check for success
    if ($conn->query($clearSql) === TRUE) {
        echo "messages cleared successfully";
    } else {
        echo "Error clearing messages: " . $conn->error;
    }
}

// Retrieve chat messages from the database
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
// Check if there are any rows in the result set
if ($result->num_rows > 0) {
    // Loop through each row and output the data
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>" . $row["name"]. ":</strong> " . $row["message"]. "</p>";
    }
} else {
    // If there are no messages, display a default message
    echo "No messages yet.";
}

// Close the connection
$conn->close();
?>
