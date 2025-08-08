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

// Initialize the search query
$search_query = '';

// Check if there's a search term entered by the user
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// SQL query to fetch data, including gender and doctor, with an optional search condition
$sql = "SELECT id, name, phone, age, gender, doctor, consulted_status, date FROM patients WHERE name LIKE '%$search_query%' OR phone LIKE '%$search_query%'"; // Modify columns as needed
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Database Data</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Patient Data</h2>

    <!-- Search Form -->
    <form method="get" action="db.php" class="mb-3">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" class="form-control" placeholder="Search by Name or Phone">
      <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>
    
    <?php
    if ($result->num_rows > 0) {
      echo '<table class="table table-bordered table-striped table-hover">';
      echo '<thead><tr><th>ID</th><th>Name</th><th>Phone</th><th>Age</th><th>Gender</th><th>Doctor</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>';
      echo '<tbody>';
  
      // Output data of each row
      while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["phone"] . "</td>";
          echo "<td>" . $row["age"] . "</td>";
          echo "<td>" . $row["gender"] . "</td>";  
          echo "<td>" . $row["doctor"] . "</td>";  
          echo "<td>" . $row["consulted_status"] . "</td>";
          echo "<td>" . $row["date"] . "</td>";
          echo "<td>
                  <a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a> 
                  <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                </td>";
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
