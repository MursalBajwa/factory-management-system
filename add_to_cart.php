<?php
session_start();
include 'db_connection.php'; // Include the database connection file

// Check if the connection object exists and is valid
if (!$conn || $conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed."
    ]);
    exit;
}

// Process the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity <= 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid quantity."
        ]);
        exit;
    }

    // Prepare a statement to fetch the product details
    $stmt = $conn->prepare("SELECT Product_quantity FROM Product WHERE Product_id = ?");
    $stmt->bind_param("i", $productId);
    if (!$stmt->execute()) {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to fetch product: " . $stmt->error
        ]);
        exit;
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = intval($row['Product_quantity']);

        if ($quantity <= $availableQuantity) {
            // Add the product to the session cart
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $productExists = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] += $quantity;
                    $productExists = true;
                    break;
                }
            }

            if (!$productExists) {
                $_SESSION['cart'][] = [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ];
            }

            echo json_encode([
                "status" => "success",
                "message" => "Product added to cart successfully."
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Only '{$availableQuantity}' products are left."
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Product not found."
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request."
    ]);
}
?>
