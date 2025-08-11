<?php
session_start();

include 'db_connection.php'; // Include the database connection

if (isset($_SESSION['Customer_id'])) {
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
                $updateDebtStmt->close();
            } else {
                // Insert a new debt record
                $insertDebtQuery = "
                    INSERT INTO debt (Customer_id, Debt_amount, Debt_date)
                    VALUES (?, ?, NOW())";
                $insertDebtStmt = $conn->prepare($insertDebtQuery);
                $insertDebtStmt->bind_param("id", $customerId, $debt_amount);
                $insertDebtStmt->execute();
                $insertDebtStmt->close();
            }
            $debtStmt->close();
            $debtResult->free();
        }

        // Fetch the debt ID using the Customer_id from session
        $customerId = $_SESSION['Customer_id'];

        // Query to get the latest debt_id for the logged-in customer
        $debt_query = "SELECT Debt_id, Debt_amount, Debt_date FROM debt WHERE Customer_id = ? ORDER BY Debt_date DESC LIMIT 1";

        if ($stmt = $conn->prepare($debt_query)) {
            $stmt->bind_param("i", $customerId); // Bind the Customer_id
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                // Fetch the debt details
                $row = $result->fetch_assoc();
                echo "<div class='stock-card'>";
                echo "<p><strong>Debt ID:</strong> " . $row['Debt_id'] . "</p>";
                echo "<p><strong>Amount:</strong> ". "$" . $row['Debt_amount'] . "</p>";

                echo "</div>";
            } else {
                echo "<p>No debt record found for this customer.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Error executing query.</p>";
        }
    
        // Commit the transaction
        $conn->commit();
    
    } catch (Exception $e) {
        // If an error occurs, roll back the transaction
        $conn->rollback();
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    $conn->close();
}
?>
