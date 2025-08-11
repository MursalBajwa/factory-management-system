<?php
// Start session to access the cart
session_start();

// Include the database connection
include 'db_connection.php';

// Initialize variables for processing each customer
$Total_inv_amount = 0;
$total_paid = 0;

// Start a transaction
$conn->begin_transaction();

try {
    // Query to fetch all customer IDs
    $customerQuery = "SELECT Customer_id FROM customer";
    $customerResult = $conn->query($customerQuery);

    if (!$customerResult) {
        throw new Exception("Error fetching customer IDs: " . $conn->error);
    }

    // Loop through each customer ID
    while ($customer = $customerResult->fetch_assoc()) {
        $customerId = $customer['Customer_id'];

        // Query to fetch all invoices grouped by Invoice ID for this customer
        $invoicesQuery = "
            SELECT temp_Invoice_id, SUM(temp_Inv_amount) AS total_inv_amount
            FROM temp_invoice
            WHERE temp_Customer_id = ? AND (acceptence_status = 'accepted' OR acceptence_status = 'pending')
            GROUP BY temp_Invoice_id";

        $invoicesStmt = $conn->prepare($invoicesQuery);
        $invoicesStmt->bind_param("i", $customerId); // Bind customer ID parameter
        $invoicesStmt->execute();
        $invoicesResult = $invoicesStmt->get_result();

        // Reset the totals for each customer
        $Total_inv_amount = 0;
        $total_paid = 0;

        // Loop through each unique invoice ID to calculate total invoice amount and total paid
        while ($invoice = $invoicesResult->fetch_assoc()) {
            $Total_inv_amount += $invoice['total_inv_amount']; // Get total invoice amount for the grouped invoice ID

            // Query to get all payment details for this invoice ID (both Cheque and Transaction)
            $paymentQuery = "
                SELECT temp_Cheque_id, temp_Transaction_id
                FROM temp_invoice
                WHERE temp_Invoice_id = ?";

            $paymentStmt = $conn->prepare($paymentQuery);
            $paymentStmt->bind_param("i", $invoice['temp_Invoice_id']);
            $paymentStmt->execute();
            $paymentResult = $paymentStmt->get_result();

            // Loop through payments associated with this invoice ID
            while ($payment = $paymentResult->fetch_assoc()) {
                // Check payment details
                if ($payment['temp_Cheque_id'] != 0) {
                    // Fetch the Cheque amount
                    $chequeQuery = "SELECT Cheque_amount FROM cheque WHERE Cheque_id = ?";
                    $chequeStmt = $conn->prepare($chequeQuery);
                    $chequeStmt->bind_param("i", $payment['temp_Cheque_id']);
                    $chequeStmt->execute();
                    $chequeResult = $chequeStmt->get_result();
                    if ($cheque = $chequeResult->fetch_assoc()) {
                        $total_paid += $cheque['Cheque_amount'];
                    }
                    $chequeStmt->close();
                    $chequeResult->free();
                }

                if ($payment['temp_Transaction_id'] != 0) {
                    // Fetch the Transaction amount
                    $transactionQuery = "
                        SELECT Transaction_amount FROM cash_transaction WHERE Transaction_id = ?";
                    $transactionStmt = $conn->prepare($transactionQuery);
                    $transactionStmt->bind_param("i", $payment['temp_Transaction_id']);
                    $transactionStmt->execute();
                    $transactionResult = $transactionStmt->get_result();
                    if ($transaction = $transactionResult->fetch_assoc()) {
                        $total_paid += $transaction['Transaction_amount'];
                    }
                    $transactionStmt->close();
                    $transactionResult->free();
                }
            }
            $paymentStmt->close();
            $paymentResult->free();
        }

        $invoicesStmt->close();
        $invoicesResult->free();

        // Calculate the debt amount for this customer
        $debt_amount = $Total_inv_amount - $total_paid;

        // Check if a debt record exists for this customer
        $debtQuery = "SELECT * FROM debt WHERE Customer_id = ?";
        $debtStmt = $conn->prepare($debtQuery);
        $debtStmt->bind_param("i", $customerId);
        $debtStmt->execute();
        $debtResult = $debtStmt->get_result();

        if ($debtResult->num_rows > 0) {
            // Update the existing debt record
            $updateDebtQuery = "
                UPDATE debt
                SET Debt_amount = ?, Debt_date = NOW()
                WHERE Customer_id = ?";
            $updateDebtStmt = $conn->prepare($updateDebtQuery);
            $updateDebtStmt->bind_param("di", $debt_amount, $customerId);
            $updateDebtStmt->execute();
            // You can log or track success for each customer here if necessary
            $updateDebtStmt->close();
        } else {
            // Insert a new debt record
            $insertDebtQuery = "
                INSERT INTO debt (Customer_id, Debt_amount, Debt_date)
                VALUES (?, ?, NOW())";
            $insertDebtStmt = $conn->prepare($insertDebtQuery);
            $insertDebtStmt->bind_param("id", $customerId, $debt_amount);
            $insertDebtStmt->execute();
            // You can log or track success for each customer here if necessary
            $insertDebtStmt->close();
        }
        $debtStmt->close();
        $debtResult->free();
    }

    // Commit the transaction
    $conn->commit();

    // Return the data as JSON for AJAX to process
    $response = ['debts' => fetchDebts($conn)]; // A function to fetch the debts as an array
    echo json_encode($response);
} catch (Exception $e) {
    // If something goes wrong, rollback the transaction
    $conn->rollback();
    echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
}

// Fetch the debts along with the customer name for AJAX to return as JSON
function fetchDebts($conn) {
    $query = "
        SELECT 
            debt.Debt_id, 
            debt.Customer_id, 
            debt.Debt_amount, 
            customer.Customer_name
        FROM debt
        JOIN customer ON debt.Customer_id = customer.Customer_id";
    
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}


?>
