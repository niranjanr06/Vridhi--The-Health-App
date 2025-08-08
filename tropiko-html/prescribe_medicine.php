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

// Fetch all patients from the database
$sql = "SELECT id, name FROM patients";
$patients = $conn->query($sql);

// Check if a patient is selected and fetch their details
$patient_details = null;
if (isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];
    $patient_sql = "SELECT * FROM patients WHERE id = $patient_id";
    $patient_details = $conn->query($patient_sql)->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Vridhi - Prescribe Medicine</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Custom Styles -->
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center">Doctor's Prescription Form</h2>

    <!-- Patient Selection Form -->
    <form method="post" action="prescribe_medicine.php" class="mb-4">
      <div class="form-group">
        <label for="patient_id">Select Patient</label>
        <select name="patient_id" id="patient_id" class="form-control">
          <option value="">-- Select a Patient --</option>
          <?php
            if ($patients->num_rows > 0) {
                while($row = $patients->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No patients found</option>";
            }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Select Patient</button>
    </form>

    <!-- Prescription Form -->
    <?php if ($patient_details): ?>
    <form method="post" action="generate_prescription.php">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $patient_details['name']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $patient_details['phone']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" id="age" class="form-control" value="<?php echo $patient_details['age']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="height">Height (cm)</label>
        <input type="text" name="height" id="height" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="weight">Weight (kg)</label>
        <input type="text" name="weight" id="weight" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="prescription">Prescribed Medicine</label>
        <textarea name="prescription" id="prescription" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Generate Prescription</button>
    </form>
    <?php endif; ?>
  </div>

  <!-- Optional: Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>
