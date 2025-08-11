<?php
session_start();
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $supplierName = $_POST['supplierName'];
    $supplierContact = $_POST['supplierContact'];
    $supplierAddress = $_POST['supplierAddress'];
    $supplierEmail = $_POST['supplierEmail'];

    // Sanitize the input data (optional but recommended)
    $supplierName = mysqli_real_escape_string($conn, $supplierName);
    $supplierContact = mysqli_real_escape_string($conn, $supplierContact);
    $supplierAddress = mysqli_real_escape_string($conn, $supplierAddress);
    $supplierEmail = mysqli_real_escape_string($conn, $supplierEmail);

    // Check for duplicates
    $sqlCheck = "SELECT * FROM supplier WHERE Supplier_name = '$supplierName' OR Supplier_email = '$supplierEmail' OR Supplier_contact_number = '$supplierContact'";
    $resultCheck = $conn->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        // If a duplicate record exists, show an error message
        echo "Duplicate record found. Supplier name, contact number, or email already exists.";
    } else {
        // Insert the supplier data into the database
        $sqlInsert = "INSERT INTO supplier (Supplier_name, Supplier_contact_number, Supplier_address, Supplier_email)
                      VALUES ('$supplierName', '$supplierContact', '$supplierAddress', '$supplierEmail')";

        if ($conn->query($sqlInsert) === TRUE) {
            // If insertion is successful, show a success message
            $_SESSION['successSupplier'] = 'true';
            header("Location: Supplier Management.php");
            exit();
        } else {
            // If there's an error in the query, show an error message
            $_SESSION['errorSupplier'] = 'true';
            header("Location: Supplier Management.php");
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>
