<?php
session_start();
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $stock_id = isset($_POST['updateStockId']) ? $_POST['updateStockId'] : ''; // Get selected Stock ID
    $new_product_name = isset($_POST['updateStockName']) ? $_POST['updateStockName'] : ''; // New Product Name
    $new_quantity = isset($_POST['updateStockQuantity']) ? $_POST['updateStockQuantity'] : ''; // New Quantity
    $new_category = isset($_POST['updateStockCategory']) ? $_POST['updateStockCategory'] : ''; // New Category
    $new_price = isset($_POST['updateStockPrice']) ? $_POST['updateStockPrice'] : ''; // New Price

    // Check if all required fields are not empty
    if (!empty($stock_id) && (!empty($new_product_name) || !empty($new_quantity) || !empty($new_category) || !empty($new_price))) {
        // Prepare the SQL update query
        $query = "UPDATE raw_material SET ";

        // Add fields to update only if they are not empty
        if (!empty($new_product_name)) {
            $query .= "Raw_product_name = '$new_product_name', ";
        }
        if (!empty($new_quantity)) {
            $query .= "Raw_quantity = '$new_quantity', ";
        }
        if (!empty($new_category)) {
            $query .= "Raw_category = '$new_category', ";
        }
        if (!empty($new_price)) {
            $query .= "Raw_price = '$new_price', ";
        }

        // Remove the trailing comma and space
        $query = rtrim($query, ', ');

        // Add the condition to update based on the selected Stock ID
        $query .= " WHERE Raw_id = '$stock_id'"; // Update stock based on selected Stock ID

        // Execute the query
        if ($conn->query($query) === TRUE) {
            $_SESSION['updatedStock'] = 'true';
            header("location: Stock Management.php");
            exit();
        } else {
            $_SESSION['errorStock'] = 'true';
            header("location: Stock Management.php");
            exit();
        }
    } else {
        $_SESSION['errorStock'] = 'true';
        header("location: Stock Management.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
