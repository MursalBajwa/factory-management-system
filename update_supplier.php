<?php
session_start();
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $supplierId = $_POST['supplierId'];
    $supplierName = $_POST['supplierName'];
    $supplierContact = $_POST['supplierContact'];
    $supplierAddress = $_POST['supplierAddress'];
    $supplierEmail = $_POST['supplierEmail'];

    // Update query to modify the supplier information
    $sql = "UPDATE supplier 
            SET Supplier_name = ?, 
                Supplier_contact_number = ?, 
                Supplier_address = ?, 
                Supplier_email = ? 
            WHERE Supplier_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the SQL statement
        $stmt->bind_param("ssssi", $supplierName, $supplierContact, $supplierAddress, $supplierEmail, $supplierId);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a success page or show a success message
            $_SESSION['updatedSupplier'] = 'true';
            header("Location: Supplier Management.php");
            exit();
        } else {
            // If the query fails, show an error message
            $_SESSION['errorSupplier'] = 'true';
            header("Location: Supplier Management.php");
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['errorSupplier'] = 'true';
        header("Location: Supplier Management.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
