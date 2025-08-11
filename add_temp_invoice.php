<?php
// Start session to access the cart
session_start();

// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $customerId = $conn->real_escape_string($_POST['temp_Customer_id']);
    $tempChequeId = $conn->real_escape_string($_POST['temp_Cheque_id'] ?? null);
    $tempTransactionId = $conn->real_escape_string($_POST['temp_Transaction_id'] ?? null);

    // Check for an existing cart
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "No items in the cart to process.";
        exit;
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Fetch the latest `temp_Invoice_id`
        $tempInvoiceIdQuery = "SELECT MAX(temp_Invoice_id) AS maxInvoiceId FROM temp_invoice";
        $result = $conn->query($tempInvoiceIdQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $latestInvoiceId = $row['maxInvoiceId'];
            $tempInvoiceId = $latestInvoiceId ? $latestInvoiceId + 1 : 1;
        } else {
            $tempInvoiceId = 1; // Default to 1 if no records found
        }

        // Get the current date for `temp_Inv_date`
        $tempInvDate = date('Y-m-d');

        // Process each item in the cart
        foreach ($_SESSION['cart'] as $cartItem) {
            $tempProductId = $cartItem['product_id'];
            $tempInvQuantity = $cartItem['quantity'];

            // Fetch product details
            $productQuery = "SELECT Product_price, Product_quantity FROM product WHERE Product_id = ?";
            $stmt = $conn->prepare($productQuery);
            if (!$stmt) {
                throw new Exception("Failed to prepare product query: " . $conn->error);
            }
            $stmt->bind_param("i", $tempProductId);
            $stmt->execute();
            $productResult = $stmt->get_result();
            $productData = $productResult->fetch_assoc();

            if (!$productData) {
                throw new Exception("Product with ID $tempProductId not found.");
            }

            $productPrice = $productData['Product_price'];
            $availableQuantity = $productData['Product_quantity'];

            if ($tempInvQuantity > $availableQuantity) {
                throw new Exception("Insufficient stock for product ID $tempProductId.");
            }

            $tempInvAmount = $productPrice * $tempInvQuantity;
            $status = 'Pending';

            // Insert the record into `temp_invoice`
            $insertQuery = "
                INSERT INTO temp_invoice (
                    temp_Invoice_id,
                    temp_Customer_id,
                    temp_Product_id,
                    temp_Inv_quantity,
                    temp_Inv_amount,
                    temp_Cheque_id,
                    temp_Transaction_id,
                    temp_Inv_date,
                    Acceptence_status
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            if (!$insertStmt) {
                throw new Exception("Failed to prepare insert query: " . $conn->error);
            }
            $insertStmt->bind_param(
                "iiiidisss",
                $tempInvoiceId,
                $customerId,
                $tempProductId,
                $tempInvQuantity,
                $tempInvAmount,
                $tempChequeId,
                $tempTransactionId,
                $tempInvDate,
                $status
            );

            if (!$insertStmt->execute()) {
                throw new Exception("Error adding invoice for product ID $tempProductId.");
            }

            // Update product quantity
            $newQuantity = $availableQuantity - $tempInvQuantity;
            $updateQuery = "UPDATE product SET Product_quantity = ? WHERE Product_id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            if (!$updateStmt) {
                throw new Exception("Failed to prepare update query: " . $conn->error);
            }
            $updateStmt->bind_param("ii", $newQuantity, $tempProductId);
            if (!$updateStmt->execute()) {
                throw new Exception("Error updating stock for product ID $tempProductId.");
            }
        }

        // Commit transaction
        $conn->commit();

        // Clear cart
        unset($_SESSION['cart']);
        $_SESSION['successSell'] = 'true';
        header("Location: Selling record Management.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        $_SESSION['errorSell'] = 'true';
        header("Location: Selling record Management.php");
        exit();
    }
}
?>
