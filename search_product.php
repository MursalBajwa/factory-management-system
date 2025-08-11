<?php
// Include the database connection
include('db_connection.php');

// Check if the searchProductId is set and not empty
if (isset($_POST['searchProductId']) && !empty($_POST['searchProductId'])) {
    $searchProductId = $_POST['searchProductId'];

    // Sanitize the input to prevent SQL injection
    $searchProductId = mysqli_real_escape_string($conn, $searchProductId);

    // Prepare the SQL query to fetch product details based on the selected Product ID
    $sql_search = "SELECT * FROM product WHERE Product_id = '$searchProductId'";

    // Execute the query
    $result = $conn->query($sql_search);

    if ($result->num_rows > 0) {
        // Fetch the product data
        $product = $result->fetch_assoc();
        echo "<h3>Product Details</h3>";
        echo "<p><strong>Product ID:</strong> " . $product['Product_id'] . "</p>";
        echo "<p><strong>Product Name:</strong> " . $product['Product_name'] . "</p>";
        echo "<p><strong>Description:</strong> " . $product['Product_description'] . "</p>";
        echo "<p><strong>Price:</strong> " . $product['Product_price'] . "</p>";
        echo "<p><strong>Category:</strong> " . $product['Product_category'] . "</p>";
        echo "<p><strong>Quantity:</strong> " . $product['Product_quantity'] . "</p>";
    } else {
        echo "<p>No product found with the selected Product ID.</p>";
    }

    // Close the database connection
    $conn->close();
}
?>
