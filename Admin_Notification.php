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
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="Home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="Customer Management.php">Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Stock Management.php">Stock</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Product Management.php">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="Cheque Management.php">Cheque</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Cash Receipt and Payment Management.php">Cash</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Supplier Management.php">Supplier</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="Debt Management.php">Debt</a>
              </li>
              <?php
// Include the database connection
include 'db_connection.php';

// Query to count the number of rejected invoices
$query = "SELECT COUNT(*) AS rejected_count FROM temp_invoice WHERE acceptence_status = 'rejected'";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $rejected_count = $row['rejected_count']; // Store the count of rejected invoices
} else {
    // In case of an error, set the rejected count to 0
    $rejected_count = 0;
}

$conn->close();
?>

<!-- Now use the $rejected_count variable to display the count in the navigation list -->
<li class="nav-item">
    <a class="nav-link" href="Admin_Notification.php">Notifications(<?php echo $rejected_count; ?>)</a>
</li>

              <li class="nav-item">
                <a class="nav-link" href="Personal expense Management.php">Expense</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Selling record Management.php">Selling Record</a>
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
    <h1>Invoices</h1>
    <div id="invoice-list"></div> <!-- Placeholder for dynamic content -->
</div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>

$(document).ready(function() {
    // Function to fetch and display the invoices
    $.ajax({
        url: 'fetch_Invoice_data_Rejected.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Response:', response); // Log the response
            if (response.status === 'success') {
                let invoiceListHtml = '';
                let currentInvoiceId = null;
                let invoiceRows = [];

                response.data.forEach(function(invoice) {
                    // Start new table for each unique invoice_id
                    if (currentInvoiceId !== invoice.temp_Invoice_id) {
                        if (currentInvoiceId !== null) {
                            invoiceListHtml += invoiceRows.join('') + `
                                <tr>
                                    <td colspan="7">
                                        <button class="btn btn-primary ok-button" data-invoice-id="${currentInvoiceId}">Ok</button>
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

                invoiceListHtml += invoiceRows.join('') +
                    `<tr>
                        <td colspan="7">
                            <button class="btn btn-primary ok-button" data-invoice-id="${currentInvoiceId}">Ok</button>
                        </td>
                    </tr>
                    </tbody></table>`;

                $('#invoice-list').html(invoiceListHtml);
            } else {
                $('#invoice-list').html('<p>No records found.</p>');
            }
        },
        error: function() {
            console.log('Error fetching data.'); // Log error message
            alert('Error fetching data.');
        }
    });


    // Ok button clicked to delete the invoice
    $(document).on('click', '.ok-button', function() {
        let invoiceId = $(this).data('invoice-id');
        deleteInvoice(invoiceId);
        location.reload();
    });

    // Function to delete an invoice
    function deleteInvoice(invoiceId) {
        $.ajax({
            url: 'delete_Invoice.php', // PHP file to delete the invoice
            type: 'POST',
            dataType: 'json',
            data: {
                invoice_id: invoiceId
            },
            success: function(response) {
                console.log(response);
                if (response.status === 'success') {
     
                    fetchInvoices(); // Refresh the invoices after deletion
                } else {
                    alert('Error deleting invoice.');
                }
            },
            error: function() {
                alert('Error deleting invoice.');
            }
        });
    }

    // Call the function to load the invoices when the page loads
 
});
</script>

</body>
</html>
