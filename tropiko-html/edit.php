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

    // Fetch the record to edit
    $sql = "SELECT * FROM patients WHERE id = $id";
    $result = $conn->query($sql);

    // Check if the record exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found");
    }
} else {
    die("No ID provided");
}

// Update the record when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $consulted_status = $_POST['consulted_status'];
    $date = $_POST['date'];

    // Update the database record
    $update_sql = "UPDATE patients SET name = '$name', phone = '$phone', age = $age, consulted_status = '$consulted_status', date = '$date' WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: db.php"); // Redirect back to the table page after update
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Patient</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Edit Patient</h2>

    <form method="post" action="edit.php?id=<?php echo $id; ?>">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
      </div>
      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
      </div>
      <div class="form-group">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="<?php echo $row['age']; ?>" required>
      </div>
      <div class="form-group">
        <label>Consulted Status</label>
        <select name="consulted_status" class="form-control">
          <option value="Previously Consulted" <?php echo ($row['consulted_status'] == 'Previously Consulted') ? 'selected' : ''; ?>>Previously Consulted</option>
          <option value="Not Consulted" <?php echo ($row['consulted_status'] == 'Not Consulted') ? 'selected' : ''; ?>>Not Consulted</option>
        </select>
      </div>
      <div class="form-group">
        <label>Date</label>
        <input type="date" name="date" class="form-control" value="<?php echo $row['date']; ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>

  <!-- Optional: Bootstrap JS for better table styling -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
