<?php
// Database connection
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

// SQL query to fetch data
$sql = "SELECT id, name, phone, age, consulted_status, date FROM patients";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Data</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Patient Data</h2>
    
    <?php
    if ($result->num_rows > 0) {
      echo '<table class="table table-bordered">';
      echo '<thead><tr><th>ID</th><th>Name</th><th>Phone</th><th>Age</th><th>Status</th><th>Date</th></tr></thead>';
      echo '<tbody>';
      
      // Output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["consulted_status"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "</tr>";
      }
      
      echo '</tbody></table>';
    } else {
      echo "<p>No data found</p>";
    }

    $conn->close();
    ?>
  </div>

  <!-- Optional: Bootstrap JS for better table styling -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
