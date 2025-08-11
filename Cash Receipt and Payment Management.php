<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successCash']) && $_SESSION['successCash'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Cash Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successCash']);
}

if (isset($_SESSION['errorCash']) && $_SESSION['errorCash'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorCash']);
}

if (isset($_SESSION['dublicateCash']) && $_SESSION['dublicateCash'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Cash. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateCash']);
}


if (isset($_SESSION['updatedCash']) && $_SESSION['updatedCash']  === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Cash Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updatedCash']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cash Receipt and Payment Management</title>

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

    /* Container for forms */
    .form-container {
        display: block; /* Hide forms by default */
        margin: 20px auto ;
        padding: 20px;
        border: 1px solid #ccc;
        width: 300px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    /* Show form when activated */
    .form-container.active {
        display: block;
    }

    /* Form elements styling */
    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    input, select {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .button-container {
  padding: 10px 20px;
  border: none;
  background-color: #f0f0f0;
  cursor: pointer;
  position: relative;
  width: 50%;
  margin-left: 25%;
  border-radius: 10px;
}

.submitBtn
{
  background-color: #fff !important;
}


 /* Styling for the Admin Panel Title */
 .title {
      font-family: 'Arial', sans-serif; /* Font style */
      font-size: 36px; /* Text size */
      color: #333; /* Text color */
      text-align: center; /* Center align */
      text-transform: uppercase; /* Make text uppercase */
      letter-spacing: 2px; /* Add spacing between letters */
      background: black; /* Gradient background */
      -webkit-background-clip: text; /* Clip background to text */
      -webkit-text-fill-color: transparent; /* Make the text transparent to show gradient */
      padding: 20px 0; /* Padding around the text */
      border-bottom: 2px solid #ddd; /* Bottom border for emphasis */
      margin: 20px auto; /* Space around the title */
      width: fit-content; /* Adjust width based on content */
    }


    .container_search {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.container_search h2 {
    text-align: center;
    color: #333;
}

.stock-card {
    margin-bottom: 15px;
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.stock-card p {
    margin: 5px 0;
    color: #000;
}

.back-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.back-btn:hover {
    background-color: #555;
}


  </style>
  
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Optional: Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
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




      <h1 class="title">Cash Receipt and Payment Management</h1>

    <!-- Buttons Container -->
    <div class="button-container">
        <button id="AddReceiptPayment" class="btn custom-btn">Add Receipt/Payment</button>
        <button id="updateReceiptPayment" class="btn custom-btn">Update Receipt/Payment</button>
        <button id="SearchCashRecords" class="btn custom-btn">Search Cash Records</button>
    </div>

<!-- Add/Update Cash Receipt/Payment Form -->
<div id="addReceiptPaymentForm" class="form-container">
    <h3>Record Cash Receipt/Payment</h3>
    <form id="receiptPaymentForm" action="add_transaction.php" method="POST">

    
    <label for="receiptNumber">Receipt Number:</label>
        <input type="text" id="receiptNumber" name="receiptNumber" required><br>

        <label for="customerId">Customer ID:</label>
        <select id="customerId" name="customerId" required>
            <option value="">Select Customer</option>
            <!-- Customer options will be populated here by AJAX -->
        </select><br>
        <label for="transactionAmount">Amount:</label>
        <input type="number" id="transactionAmount" name="transactionAmount" step="0.01" required><br>

        <label for="transactionDate">Payment Date:</label>
        <input type="date" id="transactionDate" name="transactionDate" required><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>


<!-- Update Cash Transaction Form -->
<div id="updateReceiptPaymentForm" class="form-container">
    <h3>Update Cash Receipt/Payment</h3>
    <form  action="update_transaction.php" method="POST">
        <label for="updatereceiptNumber">Receipt Number:</label>
        <select id="updatereceiptNumber" name="updatereceiptNumber" required>
            <option value="">Select Receipt Number</option>
            <!-- Receipt numbers will be populated here by AJAX -->
        </select><br>

        <label for="updatecustomerId">Customer ID:</label>
        <select id="updatecustomerId" name="updatecustomerId" required>
            <option value="">Select Customer</option>
            <!-- Customer options will be populated here by AJAX -->
        </select><br>

        <label for="updatetransactionAmount">Amount:</label>
        <input type="number" id="updatetransactionAmount" name="updatetransactionAmount" step="0.01" required><br>

        <label for="updatetransactionDate">Transaction Date:</label>
        <input type="date" id="updatetransactionDate" name="updatetransactionDate" required><br>

        <button type="submit" class="btn custom-btn submitBtn">Update</button>
    </form>
</div>




<!-- Search Cash Records Section -->
<div id="searchCashRecordsForm" class="form-container">
    <h3>Search Cash Records</h3>
    <form id="searchForm">
        <label for="searchreceiptNumber">Receipt Number:</label>
        <select id="searchreceiptNumber" name="searchreceiptNumber" required>
            <option value="">Select Receipt Number</option>
            <!-- Receipt numbers will be populated here by AJAX -->
        </select><br>
        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>

<!-- Results Container -->
<div id="container_search" class="container_search" style="display:none;">
    <h2>Cheque Details</h2>
    <div id="searchResults"></div> <!-- The result will be inserted here -->
    <button id="closesearchBtn" class="back-btn">Close</button>
</div>



    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially hide all forms and sections
            $(".form-container").hide();

            // Toggle Add/Update Receipt/Payment form
            $("#AddReceiptPayment").click(function() {
                $(".form-container").fadeOut();
                $("#addReceiptPaymentForm").fadeToggle();
            });

            $("#updateReceiptPayment").click(function() {
                $(".form-container").fadeOut();
                $("#updateReceiptPaymentForm").fadeToggle();
            });

            // Toggle Generate Report Section
            $("#GenerateReport").click(function() {
                $(".form-container").fadeOut();
                $("#generateReportSection").fadeToggle();
            });

            // Toggle Search Cash Records form
            $("#SearchCashRecords").click(function() {
                $(".form-container").fadeOut();
                $("#searchCashRecordsForm").fadeToggle();
            });


                // Fetch customers from the database and populate the dropdown
    $.ajax({
        url: 'fetch_customers.php',  // PHP script to fetch customer data
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var customerSelect = $('#customerId');
                customerSelect.empty().append('<option value="">Select Customer</option>'); // Clear existing options

                // Loop through each customer and add it as an option
                response.data.forEach(function(customer) {
                    customerSelect.append('<option value="' + customer.Customer_id + '">' + customer.Customer_id + ' - ' + customer.Customer_name + '</option>');

                    $("#updatecustomerId").append('<option value="' + customer.Customer_id + '">' + customer.Customer_id + ' - ' + customer.Customer_name + '</option>');
                });

            } else {
                alert('No customers found.');
            }
        },
        error: function() {
            alert('Error fetching customer data.');
        }
    });


        // Fetch Receipt Numbers from the database and populate the dropdown
        $.ajax({
        url: 'fetch_receipt_numbers.php',  // PHP script to fetch receipt numbers
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var receiptSelect = $('#updatereceiptNumber');
                receiptSelect.empty().append('<option value="">Select Receipt Number</option>');
                // Loop through receipt numbers and add as options
                response.data.forEach(function(receipt) {
                    receiptSelect.append('<option value="' + receipt.Recipt_Number + '">' + receipt.Recipt_Number + '</option>');
                    $('#searchreceiptNumber').append('<option value="' + receipt.Recipt_Number + '">' + receipt.Recipt_Number + '</option>');
                  });
            } else {
                alert('No receipt numbers found.');
            }
        },
        error: function() {
            alert('Error fetching receipt numbers.');
        }
    });

    // Handle the form submission
    $('#searchForm').submit(function(event) {
        event.preventDefault();  // Prevent form submission

        var receiptNumber = $('#searchreceiptNumber').val();

        // Check if Receipt Number is selected
        if (receiptNumber) {
            // AJAX to fetch cash transaction details based on Receipt Number
            $.ajax({
                url: 'search_cash_records.php',  // PHP script to search records
                method: 'GET',
                data: { receiptNumber: receiptNumber },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var resultContainer = $('#container_search');
                        resultContainer.show();  // Show the results container
                        $('#searchResults').empty();  // Clear previous results
                        // Loop through the data and display it
                        response.data.forEach(function(record) {
                            $('#searchResults').append(
                                '<div class="stock-card">' +
                                '<p><strong>Customer ID:</strong> ' + record.Customer_id + '</p>' +
                                '<p><strong>Amount:</strong> ' + record.Transaction_amount + '</p>' +
                                '<p><strong>Transaction Date:</strong> ' + record.Transaction_date + '</p>' +
                                '<p><strong>Receipt Number:</strong> ' + record.Recipt_Number + '</p>' +
                                '</div>'
                            );
                        });
                    } else {
                        $('#searchResults').html('<p>No records found for the selected receipt number.</p>');
                    }
                },
                error: function() {
                    alert('Error fetching transaction records.');
                }
            });
        } else {
            alert('Please select a receipt number.');
        }
    });

    // Close the search results container when the "Close" button is clicked
    $('#closesearchBtn').click(function() {
        $('#container_search').hide();  // Hide the results container
    });

        });
    </script>
    <!-- Bootstrap JS Bundle (includes Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
