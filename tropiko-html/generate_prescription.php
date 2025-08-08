<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $patient_name = $_POST['name'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $prescription = $_POST['prescription'];
    
    // Create the text content
    $content = "Patient Prescription\n\n";
    $content .= "Name: $patient_name\n";
    $content .= "Age: $age\n";
    $content .= "Height: $height cm\n";
    $content .= "Weight: $weight kg\n";
    $content .= "\nPrescription:\n";
    $content .= "$prescription\n";
    
    // Save it to a .txt file
    $fileName = "prescription_" . time() . ".txt";
    file_put_contents("prescriptions/" . $fileName, $content);
    
    // Provide a link to download
    echo "<a href='prescriptions/$fileName'>Download Prescription</a>";
}
?>
