
<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successSell']) && $_SESSION['successSell'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Sell Record Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successSell']);
}

if (isset($_SESSION['errorSell']) && $_SESSION['errorSell'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorStell']);
}

if (isset($_SESSION['dublicateSell']) && $_SESSION['dublicateSell'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Sell Record. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateSell']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bootstrap Boilerplate</title>

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
  width: 40%;
  margin-left: 30%;
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

    .small-btn {
        background-color: grey;
        color: black;
        border: none;
        padding: 5px 10px;
        font-size: 12px;
        cursor: pointer;
        border-radius: 3px;
    }

    .small-btn:hover {
        background-color: darkgrey;
    }


    /* Align the radio buttons and labels side by side */
    input[type="radio"] {
        vertical-align: middle; /* Aligns radio buttons vertically with text */
        margin-right: 5px; /* Adds space between the radio button and the label */
    }

    label {
        vertical-align: middle; /* Aligns the label text vertically with the radio button */
        margin-right: 20px; /* Adds space after each label */
        font-size: 14px; /* Optional: Adjust the font size for consistency */
    }

    /* Optional: Add spacing between groups (radio buttons with labels) */
    .radio-group {
        display: inline-block;
        margin-right: 20px; /* Spacing between groups */
    }


    .container_search {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #container_search h2 {
            text-align: center;
            color: #333;
        }

        #searchResults {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .searchResults p {
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

<!-- Notification Area -->
<div id="notification" style="display: none; position: fixed; top: 20px; right: 20px; padding: 10px 20px; background-color: #444; color: #fff; border-radius: 5px; font-family: Arial, sans-serif; font-size: 14px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); z-index: 1000;"></div>



      <h1 class="title">Opening Balance Account Management</h1>
<!-- Buttons Container -->
<div class="button-container"> 
  <button id="AddSellrecordBtn" class="btn custom-btn">Add Selling Record</button>
  <button id="SearchSellrecordBtn" class="btn custom-btn">Search Record</button>
</div>
<!-- Add Opening Balance Form -->
<div id="addSellingDetaileFormContainer" class="form-container" style="display: none;">
    <h2>Add Selling Detail Form</h2>
    <form action="add_temp_invoice.php" method="POST">
        <!-- Include Database Connection -->
        <?php include 'db_connection.php'; ?>

        <!-- Temp Customer ID -->
        <label for="temp_Customer_id">Customer:</label>
        <select id="temp_Customer_id" name="temp_Customer_id" required>
            <option value="">Select Customer</option>
            <?php
            // Fetch customer data from the database
            $customer_query = "SELECT Customer_id, Customer_name FROM customer";
            $customer_result = $conn->query($customer_query);

            if ($customer_result->num_rows > 0) {
                while ($row = $customer_result->fetch_assoc()) {
                    echo "<option value='{$row['Customer_id']}'>{$row['Customer_id']} - {$row['Customer_name']}</option>";
                }
            } else {
                echo "<option value=''>No customers available</option>";
            }
            ?>
        </select>
        <br><br>

        <!-- Temp Product ID -->
        <label for="temp_Product_id">Product:</label>
        <select id="temp_Product_id" name="temp_Product_id" required>
            <option value="">Select Product</option>
            <?php
            // Fetch product data from the database
            $product_query = "SELECT Product_id, Product_name, Product_category FROM product";
            $product_result = $conn->query($product_query);

            if ($product_result->num_rows > 0) {
                while ($row = $product_result->fetch_assoc()) {
                    echo "<option value='{$row['Product_id']}'>{$row['Product_id']} - {$row['Product_name']} - {$row['Product_category']}</option>";
                }
            } else {
                echo "<option value=''>No products available</option>";
            }
            ?>
        </select>
        <br><br>

        <!-- Temp Invoice Quantity -->
        <label for="temp_Inv_quantity">Quantity:</label>
        <input type="number" id="temp_Inv_quantity" name="temp_Inv_quantity" min="1" required>
        <button type="button" id="addToCartButton" class="btn small-btn">Add</button>
        <br><br>

        <!-- Payment Method -->
        <p>Payment Method:</p>
        <input style="margin-top:20px;" type="radio" id="payment_cheque" name="payment_method" value="cheque" required>
        <label style="margin-top:-30px;" for="payment_cheque">Cheque</label>
        <input type="radio" id="payment_cash" name="payment_method" value="cash">
        <label style="margin-top:-30px;" for="payment_cash">Cash</label>
        <br><br>

        <!-- Cheque Field -->
        <div id="chequeField">
            <label for="temp_Cheque_id">Cheque:</label>
            <select id="temp_Cheque_id" name="temp_Cheque_id">
                <option value="">Select Cheque</option>
                <?php
                // Fetch cheque data from the database
                $cheque_query = "SELECT Cheque_id, Cheque_number FROM cheque";
                $cheque_result = $conn->query($cheque_query);

                if ($cheque_result->num_rows > 0) {
                    while ($row = $cheque_result->fetch_assoc()) {
                        echo "<option value='{$row['Cheque_id']}'>{$row['Cheque_number']}</option>";
                    }
                } else {
                    echo "<option value=''>No cheques available</option>";
                }
                ?>
            </select>
        </div>

        <!-- Transaction Field -->
        <div id="transactionField">
            <label for="temp_Transaction_id">Transaction:</label>
            <select id="temp_Transaction_id" name="temp_Transaction_id">
                <option value="">Select Transaction</option>
                <?php
                // Fetch transaction data from the database
                $transaction_query = "SELECT Transaction_id, Recipt_Number FROM cash_transaction";
                $transaction_result = $conn->query($transaction_query);

                if ($transaction_result->num_rows > 0) {
                    while ($row = $transaction_result->fetch_assoc()) {
                        echo "<option value='{$row['Transaction_id']}'>{$row['Recipt_Number']}</option>";
                    }
                } else {
                    echo "<option value=''>No transactions available</option>";
                }
                ?>
            </select>
        </div>
        <br><br>

        <!-- Submit Button -->
        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>


<div id="searchSellingDetaileFormContainer" class="form-container">
    <h2>Search Selling Detail Form</h2>
    <form id="searchForm">
        <!-- Search Option -->
        <p>Search By:</p>
        <div class="radio-group">
        <label for="search_option_id">Invoice ID</label>
            <input type="radio" id="search_option_id" name="search_option_id" value="invoice_id" required>

        </div>
        <div class="radio-group">
        <label for="search_option_name">Customer Name</label>
            <input type="radio" id="search_option_name" name="search_option_name" value="customer_name">

        </div>
        <br><br>

        <!-- Select Invoice ID -->
        <div id="selectInvoiceID">
            <label for="invoice_id">Select Invoice:</label>
            <select id="invoice_id" name="invoice_id">
                <option value="">Select Invoice</option>
                <?php
                $invoice_query = "SELECT temp_Invoice_id, temp_Inv_date FROM temp_invoice";
                $invoice_result = $conn->query($invoice_query);

                if ($invoice_result->num_rows > 0) {
                    while ($row = $invoice_result->fetch_assoc()) {
                        echo "<option value='{$row['temp_Invoice_id']}'>ID: {$row['temp_Invoice_id']} - Date: {$row['temp_Inv_date']}</option>";
                    }
                } else {
                    echo "<option value=''>No invoices available</option>";
                }
                ?>
            </select>
        </div>

        <!-- Select Customer Name -->
        <div id="selectCustomerName">
            <label for="customer_id">Select Customer:</label>
            <select id="customer_id" name="customer_id">
                <option value="">Select Customer</option>
                <?php
                $customer_query = "SELECT Customer_id, Customer_name FROM customer";
                $customer_result = $conn->query($customer_query);

                if ($customer_result->num_rows > 0) {
                    while ($row = $customer_result->fetch_assoc()) {
                        echo "<option value='{$row['Customer_id']}'>ID: {$row['Customer_id']} - Name: {$row['Customer_name']}</option>";
                    }
                } else {
                    echo "<option value=''>No customers available</option>";
                }
                ?>
            </select>
        </div>
        <br><br>

        <!-- Submit Button -->
        <button type="button" id="submitButton" class="btn custom-btn submitBtn">Search</button>

    </form>
</div>

<!-- Results Container -->
<div id="container_search" class="container_search" style="display:none;">
    <h2>Invoice Details</h2>
    <div id="searchResults"></div>
    <button id="closesearchBtn" class="back-btn">Close</button>
</div>



<!-- Edit Existing Opening Balance Form -->
<div id="editBalanceFormContainer" class="form-container" style="display: none;">
  <h3>Edit Existing Opening Balance</h3>
  <form id="editBalanceForm">
      <label for="editAccountId">Account ID:</label>
      <input type="number" id="editAccountId" name="editAccountId" required><br>

      <button type="submit" class="btn custom-btn submitBtn">Search</button>
  </form>

  <div id="editBalanceDetails" style="display:none;">
      <h4>Edit Balance Details</h4>
      <form id="editBalanceDetailsForm">
          <label for="editAccountName">Account Name:</label>
          <input type="text" id="editAccountName" name="editAccountName"><br>

          <label for="editBalanceAmount">Balance Amount:</label>
          <input type="number" id="editBalanceAmount" name="editBalanceAmount"><br>

          <label for="editBalanceDate">Date:</label>
          <input type="date" id="editBalanceDate" name="editBalanceDate"><br>

          <button type="submit" class="btn custom-btn submitBtn">Submit</button>
      </form>
  </div>
</div>

<!-- Opening Balance Summary Table -->
<div id="summaryBalanceContainer" class="form-container" style="display: none;">
  <h3>Opening Balance Summary</h3>
  <table id="balanceSummaryTable">
      <thead>
          <tr>
              <th style="padding: 20px;">Account ID</th>
              <th style="padding: 20px;">Account Name</th>
              <th style="padding: 20px;">Balance Amount</th>
              <th style="padding: 20px;">Date</th>
              <th style="padding: 20px;">Actions</th>
          </tr>
      </thead>
      <tbody>
          <!-- Opening balance records will be dynamically added here -->
      </tbody>
  </table>
</div>

<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    console.log('Document is ready!');
      // Initially hide all forms
      $(".form-container").hide();

      // Show Add Opening Balance Form
      $("#AddSellrecordBtn").click(function() {
          $(".form-container").fadeOut();
          $("#addSellingDetaileFormContainer").fadeIn();
      });

      // Show Edit Opening Balance Form
      $("#SearchSellrecordBtn").click(function() {
          $(".form-container").fadeOut();
          $("#searchSellingDetaileFormContainer").fadeIn();
      });

      // Show Summary Table
      $("#SummaryBalanceBtn").click(function() {
          $(".form-container").fadeOut();
          $("#summaryBalanceContainer").fadeIn();
      });

// Initially hide both select fields
$('#selectInvoiceID').hide();
$('#selectCustomerName').hide();

// Show/hide dropdowns based on radio button selection
$('input[name="search_option_id"], input[name="search_option_name"]').change(function () {
    // Uncheck both radio buttons and then check the selected one
    $('input[name="search_option_id"], input[name="search_option_name"]').prop('checked', false);  // Uncheck all
    $(this).prop('checked', true);  // Check the selected one

    // Show/hide dropdowns based on the selected radio button
    if ($('#search_option_id').is(':checked')) {
        $('#selectInvoiceID').show();
        $('#selectCustomerName').hide();
    } else if ($('#search_option_name').is(':checked')) {
        $('#selectCustomerName').show();
        $('#selectInvoiceID').hide();
    }
});



     // Handle changes to the payment method
     $('input[name="payment_method"]').on('change', function () {
        const paymentMethod = $(this).val();
        
        // Show/hide fields based on selected payment method
        if (paymentMethod === 'cheque') {
            $('#chequeField').show();     // Show cheque field
            $('#transactionField').hide(); // Hide transaction field
        } else if (paymentMethod === 'cash') {
            $('#transactionField').show(); // Show transaction field
            $('#chequeField').hide();      // Hide cheque field
        }
    });

    // Initially hide both fields
    $('#chequeField').hide();
    $('#transactionField').hide();

        $("#addToCartButton").click(function () {
    const productId = $("#temp_Product_id").val();
    const quantity = $("#temp_Inv_quantity").val();


    if (!productId || !quantity) {
        alert("Please select a product and enter a valid quantity.");
        return;
    }

 // AJAX Request
$.ajax({
    url: "add_to_cart.php",  // URL to send the request to
    type: "POST",            // Request method
    data: { 
        product_id: productId, 
        quantity: quantity 
    },  // Data to be sent in the request
    success: function (response) {
        const result = JSON.parse(response);

        // Check the response status
        if (result.status === "success") {
            // Success: Show success message in the notification
            $("#notification").text(result.message).show().delay(3000).fadeOut();
        } else {
            // Error: Show the error message in the notification
            $("#notification").text(result.message).addClass("error").show().delay(3000).fadeOut();
        }
    },
    error: function () {
        // In case of an error with the AJAX request itself
        $("#notification").text("An error occurred while adding the product to the cart.").addClass("error").show().delay(3000).fadeOut();
    }
});
    });


        // Handle form submission
        $('#submitButton').click(function (e) {
        e.preventDefault(); // Prevent default form submission behavior (page reload)

  

        // Create a data object to hold the form data
        var data = {};

        // Get the selected search option (invoice_id or customer_name)
        var searchOption = $('input[name="search_option_id"]:checked').val() || $('input[name="search_option_name"]:checked').val();
        data.search_option = searchOption;

        // Validate that only one option is selected
        if (searchOption === 'invoice_id') {
            data.invoice_id = $('#invoice_id').val();
            if (data.invoice_id === "") {
                alert("Please select an Invoice ID.");
                return;
            }
            // Ensure customer_name is not selected when searching by invoice_id
            data.customer_id = "";
        } else if (searchOption === 'customer_name') {
            data.customer_id = $('#customer_id').val();
            if (data.customer_id === "") {
                alert("Please select a Customer Name.");
                return;
            }
            // Ensure invoice_id is not selected when searching by customer_name
            data.invoice_id = "";
        } else {
            alert("Please select a search option.");
            return;
        }

        // AJAX request
        $.ajax({
            url: 'search_temp_invoice.php', // Backend script
            type: 'POST',
            data: data, // Use the manually created data object
            success: function (response) {
                // Show results in the container
                $('#searchResults').html(response);
                $('#container_search').show();
            },
            error: function () {
                alert('Error fetching results. Please try again.');
            }
        });
 });


    // Close search results
    $('#closesearchBtn').on('click', function () {
        $('#container_search').hide();
        $('#searchResults').html('');
    });

  });
 



</script>


<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
