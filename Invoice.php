<?php
session_start();

// Check if invoice_id is set from the form submission
if (isset($_POST['invoice_id'])) {
    $invoice_id = $_POST['invoice_id'];

    // Include the database connection
    include 'db_connection.php';

    // Query to fetch invoice details
    $query = "
        SELECT 
            p.Product_name,
            p.Product_category,
            ti.temp_Inv_quantity,
            ti.temp_Inv_amount
        FROM temp_invoice ti
        JOIN product p ON ti.temp_Product_id = p.Product_id
        WHERE ti.temp_Invoice_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $invoice_id); // Bind the invoice ID to the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the invoice items
    $invoice_items = [];
    $total_amount = 0;
    while ($row = $result->fetch_assoc()) {
        $invoice_items[] = $row;
        $total_amount += $row['temp_Inv_amount']; // Sum the amount for total
    }

            // Fetch the invoice date from the database
        $query = "SELECT temp_Inv_date FROM temp_invoice WHERE temp_Invoice_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $stmt->bind_result($invoice_date);
        $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .invoice-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .invoice-details th {
            background-color: #333;
            color: #fff;
        }
        .invoice-footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .invoice-footer button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .back-button {
            background-color: #333;
            color: #fff;
        }
        .print-button {
            background-color: gray;
            color: #fff;
        }
        .back-button:hover {
            background-color: #555;
        }
        .print-button:hover {
            background-color: black;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="invoice-header">
        <h1>Invoice Details</h1>
        <p>Invoice ID: <?php echo $invoice_id; ?></p>
        <p>Invoice Date: <?php echo $invoice_date; ?></p> <!-- Displaying the invoice date -->
        <p>Customer Name: <?php echo $_SESSION['User_name']; ?></p> <!-- Displaying the customer name -->
    </div>


        <div class="invoice-details">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
                <?php
                // Display each product detail
                if (!empty($invoice_items)) {
                    foreach ($invoice_items as $item) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($item['Product_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($item['Product_category']) . '</td>';
                        echo '<td>' . htmlspecialchars($item['temp_Inv_quantity']) . '</td>';
                        echo '<td>$' . htmlspecialchars(number_format($item['temp_Inv_amount'], 2)) . '</td>';
                        echo '</tr>';
                    }

                    // Display total amount
                    echo '<tr>';
                    echo '<th colspan="3">Total Amount</th>';
                    echo '<th>$' . htmlspecialchars(number_format($total_amount, 2)) . '</th>';
                    echo '</tr>';
                } else {
                    echo '<tr><td colspan="4">No products found for this invoice.</td></tr>';
                }
                ?>
            </table>
        </div>

        <div class="invoice-footer">
            <button class="back-button" onclick="history.back()">Back</button>
            <button class="print-button" onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
