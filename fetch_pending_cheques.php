<?php
// Include database connection
include 'db_connection.php';

$currentDate = date('Y-m-d');  // Ensure this matches the format in the database
$query = "
    SELECT c.Cheque_id, c.Cheque_number, c.Cheque_amount, c.Cheque_date, cu.Customer_name, cu.Customer_contact, c.Cheque_status
    FROM cheque c 
    JOIN customer cu ON c.Customer_id = cu.Customer_id 
    WHERE c.Cheque_status = 'Pending' 
      AND (DATEDIFF(DATE(c.Cheque_date), '$currentDate') <= 2 OR DATE(c.Cheque_date) < '$currentDate')
";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Cheque ID</th>
                    <th>Cheque Number</th>
                    <th>Amount</th>
                    <th>Cheque Date</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Status</th>
                    <th>Days Left</th>
                </tr>
            </thead>
            <tbody>";
    
    while ($row = $result->fetch_assoc()) {
        $chequeId = $row['Cheque_id'];
        $chequeNumber = $row['Cheque_number'];
        $chequeAmount = $row['Cheque_amount'];
        $chequeDate = $row['Cheque_date'];
        $customerName = $row['Customer_name'];
        $customerContact = $row['Customer_contact'];
        $status = $row['Cheque_status'];

        // Calculate the days left
        $daysLeft = (strtotime($chequeDate) - strtotime($currentDate)) / 86400;
        if ($daysLeft > 1) {
            $daysLeft = "$daysLeft days left";
        } elseif ($daysLeft == 1) {
            $daysLeft = "1 day left";
        } elseif ($daysLeft == 0) {
            $daysLeft = "0 days left";
        } else {
            $daysLeft = "Cheque date passed";
        }

        // Display cheque details in table
        echo "<tr>
                <td>$chequeId</td>
                <td>$chequeNumber</td>
                <td>$chequeAmount</td>
                <td>$chequeDate</td>
                <td>$customerName</td>
                <td>$customerContact</td>
                <td>$status</td>
                <td>$daysLeft</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No pending cheques found.</p>";
}

// Close connection
$conn->close();
?>
