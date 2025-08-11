<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap & jQuery Example</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<style>
       .custom-logout-btn {
  color: black !important;
  background-color: var(--bs-body-bg) !important;

  border-radius: 4px !important;
  transition: all 0.3s ease !important;
}

.custom-logout-btn:hover {
  background-color: black !important;
  color: white !important;
  border-radius: 8px !important;
}

      /* Page Content Styling */
      .pagebody {
          background-color: #000;
          color: #fff;
          border-radius: 5px;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          padding: 20px;
      }
</style>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Factory Management System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
            <?php
// Include the database connection
include 'db_connection.php';

// Get the logged-in customer ID from the session
$customer_id = $_SESSION['Customer_id'];  // Assuming Customer_id is set in the session

// Query to count the number of pending invoices for the logged-in customer
$query = "SELECT COUNT(*) AS pending_count FROM temp_invoice WHERE acceptence_status = 'pending' AND temp_Customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id); // Bind the customer ID to the query
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $row = $result->fetch_assoc();
    $pending_count = $row['pending_count']; // Store the count of pending invoices
} else {
    // In case of an error, set the pending count to 0
    $pending_count = 0;
}

$stmt->close();
$conn->close();
?>

<!-- Now use the $pending_count variable to display the count in the navigation list -->
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="Customer_notification.php">
        Notification(<?php echo $pending_count; ?>)
    </a>
</li>

              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="View Reports.php">Report</a>
              </li>

            </ul>

            <!-- Updated Logout Button -->
            <form class="d-flex" action="logout.php" method="POST">
                <button class="btn custom-logout-btn" type="submit">Logout</button>
            </form>
  
          </div>
        </div>
      </nav>


      <div class="container">
    <h1>Newly Added Invoices</h1>
    <div id="invoice-list"></div> <!-- Placeholder for dynamic content -->
</div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
$(document).ready(function() {
    // Function to fetch and display the invoices


    function fetchInvoices() {
    $.ajax({
        url: 'fetch_Invoice_data.php', // PHP file that fetches the data
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                let invoiceListHtml = '';
                let currentInvoiceId = null;
                let invoiceRows = [];

                // Loop through the fetched data and display it in tables
                response.data.forEach(function(invoice) {
                    // Start new table for each unique invoice_id
                    if (currentInvoiceId !== invoice.temp_Invoice_id) {
                        if (currentInvoiceId !== null) {
                            // Close the current table and add buttons for this invoice
                            invoiceListHtml += invoiceRows.join('') + `
                                <tr>
                                    <td colspan="7">
                                        <button class="btn btn-success accept-all" data-invoice-id="${currentInvoiceId}">Accept All</button>
                                        <button class="btn btn-danger reject-all" data-invoice-id="${currentInvoiceId}">Reject All</button>
                                    </td>
                                </tr>
                                </tbody></table><br>`;
                            invoiceRows = [];
                        }

                        currentInvoiceId = invoice.temp_Invoice_id;
                        invoiceListHtml += `<h3>Invoice ID: ${invoice.temp_Invoice_id}</h3>
                                             <table class="table table-bordered">
                                                 <thead>
                                                     <tr>
                                                         <th>Product ID</th>
                                                         <th>Product Name</th>
                                                         <th>Product Category</th>
                                                         <th>Quantity</th>
                                                         <th>Amount</th>
                                                         <th>Date</th>
                                                         <th>Status</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>`; 
                    }

                    // Add the invoice row with product name and category
                    invoiceRows.push(`<tr id="invoice_${invoice.temp_Invoice_id}_product_${invoice.temp_Product_id}">
                                        <td>${invoice.temp_Product_id}</td>
                                        <td>${invoice.product_name}</td>
                                        <td>${invoice.product_category}</td>
                                        <td>${invoice.temp_Inv_quantity}</td>
                                        <td>${invoice.temp_Inv_amount}</td>
                                        <td>${invoice.temp_Inv_date}</td>
                                        <td>${invoice.Acceptence_status}</td>
                                    </tr>`);
                });

                // Append the rows and add the accept/reject buttons for each invoice
                invoiceListHtml += invoiceRows.join('') +
                    `<tr>
                        <td colspan="7">
                            <button class="btn btn-success accept-all" data-invoice-id="${currentInvoiceId}">Accept All</button>
                            <button class="btn btn-danger reject-all" data-invoice-id="${currentInvoiceId}">Reject All</button>
                        </td>
                    </tr>
                    </tbody></table>`;

                $('#invoice-list').html(invoiceListHtml);
            } else {
                $('#invoice-list').hide;
            }
        },
        error: function() {
            alert('Error fetching data.');
        }
    });
}


    // Accept all invoices of a particular invoice ID
    $(document).on('click', '.accept-all', function() {
        let invoiceId = $(this).data('invoice-id');
        updateInvoiceStatus(invoiceId, 'accept');
    });

    // Reject all invoices of a particular invoice ID
    $(document).on('click', '.reject-all', function() {
        let invoiceId = $(this).data('invoice-id');
        updateInvoiceStatus(invoiceId, 'reject');
    });

    // Function to update status of all products in a specific invoice
    function updateInvoiceStatus(invoiceId, action) {
        $.ajax({
            url: 'update_Invoice_status.php', // PHP file to update the invoice status
            type: 'POST',
            dataType: 'json',
            data: {
                action: action,
                invoice_id: invoiceId
            },
            success: function(response) {
                if (response.status === 'success') {
                    fetchInvoices(); // Refresh the invoices
                } else {
                    alert('Error updating status.');
                }
            },
            error: function() {
                alert('Error updating status.');
            }
        });
    }

    // Call the function to load the invoices when the page loads
    fetchInvoices();


  






});
</script>



</body>
</html>
