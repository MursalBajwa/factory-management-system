<?php
session_start();
// Include the database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $productQuantity = $_POST['productQuantity'];

    // Sanitize the input to prevent SQL injection
    $productName = mysqli_real_escape_string($conn, $productName);
    $productDescription = mysqli_real_escape_string($conn, $productDescription);
    $productPrice = mysqli_real_escape_string($conn, $productPrice);
    $productCategory = mysqli_real_escape_string($conn, $productCategory);
    $productQuantity = mysqli_real_escape_string($conn, $productQuantity);

    // Check if the product already exists in the database based on Product_name and Product_category
    $sql_check = "SELECT * FROM product WHERE Product_name = '$productName' AND Product_category = '$productCategory'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // If a record already exists, show an error message
        echo "<div style='color: red; text-align: center;'>Product already exists in this category!</div>";
    } else {
        // If no duplicate record is found, insert the new product
        $sql_insert = "INSERT INTO product (Product_name, Product_description, Product_price, Product_category, Product_quantity)
                       VALUES ('$productName', '$productDescription', '$productPrice', '$productCategory', '$productQuantity')";

        if ($conn->query($sql_insert) === TRUE) {
            // Success message
            echo $_SESSION['successProduct'] = 'true';
            header("location: Product Management.php");
            exit();
        } else {
            // Error message
            echo $_SESSION['errorProduct'] = 'true';
            header("location: Product Management.php");
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>
