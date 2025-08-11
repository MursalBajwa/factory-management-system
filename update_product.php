<?php
session_start();
// Include the database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $productId = $_POST['updateProductId'];
    $productName = $_POST['updateProductName'];
    $productDescription = $_POST['updateProductDescription'];
    $productPrice = $_POST['updateProductPrice'];
    $productCategory = $_POST['updateProductCategory'];
    $productQuantity = $_POST['updateProductQuantity'];

    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $productId);
    $productName = mysqli_real_escape_string($conn, $productName);
    $productDescription = mysqli_real_escape_string($conn, $productDescription);
    $productPrice = mysqli_real_escape_string($conn, $productPrice);
    $productCategory = mysqli_real_escape_string($conn, $productCategory);
    $productQuantity = mysqli_real_escape_string($conn, $productQuantity);

    // Prepare the SQL update statement
    $sql_update = "UPDATE product 
                   SET Product_name = '$productName', 
                       Product_description = '$productDescription', 
                       Product_price = '$productPrice', 
                       Product_category = '$productCategory', 
                       Product_quantity = '$productQuantity' 
                   WHERE Product_id = '$productId'";

    // Execute the update query
    if ($conn->query($sql_update) === TRUE) {
        // Success message
        echo $_SESSION['updatedProduct'] = 'true';
        header("location: Product Management.php");
        exit();
    } else {
        // Error message
        echo $_SESSION['updatedProduct'] = 'true';
        header("location: Product Management.php");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
