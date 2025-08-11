<?php
// Start the session
session_start();

// Include the database connection
include('db_connection.php');

// Check if the search form was submitted
if (isset($_GET['searchSupplierId']) && !empty($_GET['searchSupplierId'])) {
    // Get the selected supplier ID
    $supplierId = $_GET['searchSupplierId'];

    // Fetch the supplier data from the database based on the selected Supplier ID
    $sql = "SELECT Supplier_id, Supplier_name, Supplier_contact_number, Supplier_address, Supplier_email FROM supplier WHERE Supplier_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $supplierId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a supplier was found
    if ($result->num_rows > 0) {
        // Fetch the supplier data
        $supplierData = $result->fetch_assoc();

        // Store the supplier data in the session
        $_SESSION['supplier_data'] = $supplierData;

        // Redirect to the display_supplier.php page
        header('Location: Supplier Management.php');
        exit();
    } else {
        // If no supplier found, set an error message
        $_SESSION['Not_record_supplier'] = True;
        header('Location: Supplier Management.php'); // Redirect back to the search form
        exit();
    }
} else {
    // If no Supplier ID is selected, redirect back to the search form
    $_SESSION['error'] = "Please select a Supplier ID to search.";
    header('Location: Supplier Management.php');
    exit();
}
?>
