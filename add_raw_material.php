<?php
session_start();
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productName = $_POST['stockName'];
    $quantity = $_POST['stockQuantity'];
    $category = $_POST['stockCategory'];
    $price = $_POST['stockPrice'];
    $supplierId = $_POST['supplierId'];

    // Validate required fields
    if (empty($productName) || empty($quantity) || empty($category) || empty($price) || empty($supplierId)) {
        echo "All fields are required.";
        exit;
    }

    // Check if the record already exists
    $checkSql = "SELECT COUNT(*) AS count 
                 FROM raw_material 
                 WHERE Raw_product_name = ? AND Raw_category = ? AND Supplier_id = ?";
    $checkStmt = $conn->prepare($checkSql);

    if ($checkStmt) {
        // Bind parameters
        $checkStmt->bind_param("ssi", $productName, $category, $supplierId);
        $checkStmt->execute();

        // Get the result
        $result = $checkStmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $_SESSION['dublicateStock'] = 'true';
            header("Location: Stock Management.php");
            exit();
        }
        $checkStmt->close();
    } else {
        $_SESSION['errorStock'] = 'true';
        header("Location: Stock Management.php");
        exit();
    }

    // Prepare SQL query to insert data into raw_material table
    $sql = "INSERT INTO raw_material (Raw_product_name, Raw_quantity, Raw_category, Raw_price, Supplier_id) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sisdi", $productName, $quantity, $category, $price, $supplierId);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['successStock'] = 'true';
            header("Location: Stock Management.php");
            exit();
        } else {
            $_SESSION['errorStock'] = 'true';
            header("Location: Stock Management.php");
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['errorStock'] = 'true';
        header("Location: Stock Management.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
