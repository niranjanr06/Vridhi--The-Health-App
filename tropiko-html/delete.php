<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vridhi";  // Replace with your actual database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
    // Delete the record from the database
    $delete_sql = "DELETE FROM patients WHERE id = $id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: db.php"); // Redirect back to the table page after delete
    }
