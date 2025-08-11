<?php
// Include the database connection
include('db_connection.php');

// Check if the stockId parameter is passed
if (isset($_GET['stockId'])) {
    $stockId = $_GET['stockId'];

    // Fetch the stock details based on the selected Stock ID (Supplier_id)
    $sql = "SELECT Raw_id, Raw_product_name, Raw_quantity, Raw_category, Raw_price, Supplier_id 
            FROM raw_material WHERE Raw_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $stockId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output the stock details as HTML
        while ($row = $result->fetch_assoc()) {
            echo "<div class='stock-card'>
                    <p><strong>Raw ID:</strong> " . $row['Raw_id'] . "</p>
                    <p><strong>Product Name:</strong> " . $row['Raw_product_name'] . "</p>
                    <p><strong>Quantity:</strong> " . $row['Raw_quantity'] . "</p>
                    <p><strong>Category:</strong> " . $row['Raw_category'] . "</p>
                    <p><strong>Price:</strong> " . $row['Raw_price'] . "</p>
                    <p><strong>Supplier ID:</strong> " . $row['Supplier_id'] . "</p>
                </div>";
        }
    } else {
        echo ""; // No stock found
    }

    // Close the database connection
    $conn->close();
}
?>
