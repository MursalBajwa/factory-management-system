<?php
// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the form values
    $chequeNumber = $conn->real_escape_string($_POST['updatechequeNumber']);
    $chequeAmount = $conn->real_escape_string($_POST['updatechequeAmount']);
    $chequeDate = $conn->real_escape_string($_POST['updatechequeDate']);
    $chequeStatus = $conn->real_escape_string($_POST['updatechequeStatus']);
    $customerId = $conn->real_escape_string($_POST['updatecustomerId']);

    // Fetch Cheque ID based on the selected Cheque Number
    $chequeQuery = "SELECT Cheque_id FROM cheque WHERE Cheque_number = '$chequeNumber'";
    $result = $conn->query($chequeQuery);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $chequeId = $row['Cheque_id'];

        // Update the record in the database
        $updateQuery = "UPDATE cheque 
                        SET Cheque_number = '$chequeNumber', 
                            Cheque_amount = '$chequeAmount', 
                            Cheque_date = '$chequeDate', 
                            Customer_id = '$customerId', 
                            Cheque_status = '$chequeStatus' 
                        WHERE Cheque_id = '$chequeId'";

        if ($conn->query($updateQuery) === TRUE) {
            $_SESSION['updatedCheque'] = 'true';
            header("Location: Cheque Management.php");
            exit();
        } else {
            $_SESSION['errorCheque'] = 'true';
            header("Location: Cheque Management.php");
            exit();
        }
    } else {
        $_SESSION['errorCheque'] = 'true';
        header("Location: Cheque Management.php");
        exit();
    }
}

// Close the connection
$conn->close();
?>
