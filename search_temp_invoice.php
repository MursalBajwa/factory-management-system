<?php
include 'db_connection.php'; // Include database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_option = $_POST['search_option'];
    $result = '';

    // Validation for mutually exclusive search options
    if ($search_option == 'invoice_id') {
        if (!empty($_POST['invoice_id'])) {
            $invoice_id = $_POST['invoice_id'];

            // Fetch data by Invoice ID
            $query = "SELECT * FROM temp_invoice WHERE temp_Invoice_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $invoice_id);
            $stmt->execute();
            $result_data = $stmt->get_result();

            if ($result_data->num_rows > 0) {
                while ($row = $result_data->fetch_assoc()) {
                    $result .= "<li><strong>Invoice ID:</strong> " . $row['temp_Invoice_id'] . 
                                ", <strong>Customer ID:</strong> " . $row['temp_Customer_id'] . 
                                ", <strong>Product ID:</strong> " . $row['temp_Product_id'] . 
                                ", <strong>Quantity:</strong> " . $row['temp_Inv_quantity'] . 
                                ", <strong>Amount:</strong> $" . $row['temp_Inv_amount'] . 
                                ", <strong>Cheque ID:</strong> " . $row['temp_Cheque_id'] . 
                                ", <strong>Transaction ID:</strong> " . $row['temp_Transaction_id'] . 
                                ", <strong>Invoice Date:</strong> " . $row['temp_Inv_date'] . 
                                ", <strong>Acceptance Status:</strong> " . $row['Acceptence_status'] . "</li>";

                }
            } else {
                $result = '<p>No invoice found for the selected ID.</p>';
            }
        } else {
            $result = '<p>Please select a valid Invoice ID.</p>';
        }
    } elseif ($search_option == 'customer_name') {
        if (!empty($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];

            // Fetch data by Customer ID
            $query = "SELECT * FROM temp_invoice WHERE temp_Customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $result_data = $stmt->get_result();

            if ($result_data->num_rows > 0) {
                while ($row = $result_data->fetch_assoc()) {
                    $result .= "<li><strong>Invoice ID:</strong> " . $row['temp_Invoice_id'] . 
                                ", <strong>Customer ID:</strong> " . $row['temp_Customer_id'] . 
                                ", <strong>Product ID:</strong> " . $row['temp_Product_id'] . 
                                ", <strong>Quantity:</strong> " . $row['temp_Inv_quantity'] . 
                                ", <strong>Amount:</strong> $" . $row['temp_Inv_amount'] . 
                                ", <strong>Cheque ID:</strong> " . $row['temp_Cheque_id'] . 
                                ", <strong>Transaction ID:</strong> " . $row['temp_Transaction_id'] . 
                                ", <strong>Invoice Date:</strong> " . $row['temp_Inv_date'] . 
                                ", <strong>Acceptance Status:</strong> " . $row['Acceptence_status'] . "</li>";
                                $result .="<br>";
                }
            } else {
                $result = '<p>No invoices found for the selected customer.</p>';
            }
        } else {
            $result = '<p>Please select a valid Customer Name.</p>';
        }
    } else {
        $result = '<p>Please select a valid search option.</p>';
    }

    echo $result;
}
?>
