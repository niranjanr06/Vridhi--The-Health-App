<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vridhi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$consulted_status = $_POST['consulted_status'];
$date = $_POST['date'];
$doctor = $_POST['doctor'];

// Insert into table
$sql = "INSERT INTO patients (name, phone, age, gender, consulted_status, date, doctor) 
        VALUES ('$name', '$phone', '$age', '$gender', '$consulted_status', '$date', '$doctor')";

if ($conn->query($sql) === TRUE) {
  // Redirect to the same page after successful insert
  header("Location: adddata.html");
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
