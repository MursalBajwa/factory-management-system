<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successCheque']) && $_SESSION['successCheque'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Cheque Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successCheque']);
}

if (isset($_SESSION['errorCheque']) && $_SESSION['errorCheque'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorCheque']);
}

if (isset($_SESSION['dublicateCheque']) && $_SESSION['dublicateCheque'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Cheque. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateCheque']);
}


if (isset($_SESSION['updatedCheque']) && $_SESSION['updatedCheque']  === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Cheque Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updatedCheque']);
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


    .container_display {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.container_display h2 {
    text-align: center;
    color: #333;
}

/* Remove margin from the #stockResults container */
#stockResults {
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #000;
}

/* Add margin only around the table */
#stockResults table {
    margin-top: 10px;
    width: 100%;
    border-collapse: collapse;
}

/* Style for table headers */
#stockResults th, #stockResults td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ccc;
}

/* Add alternating row background colors for better readability */
#stockResults tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Button styling */
#closeBtn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

#closeBtn:hover {
    background-color: #555;
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





      <h1 class="title">Cheque Management</h1>

    <!-- Buttons Container -->
    <div class="button-container">
        <button id="AddCheque" class="btn custom-btn">Add Cheque</button>
        <button id="UpdateCheque" class="btn custom-btn">Update Cheque</button>
        <button id="ViewUpcomingCheques" class="btn custom-btn">View Upcoming Cheques</button>
    </div>

<!-- Record Cheque Form -->
<div id="addChequeForm" class="form-container">
    <h3>Add Cheque Details</h3>
    <form action="add_cheque.php" method="post">
        <label for="chequeNumber">Cheque Number:</label>
        <input type="text" id="chequeNumber" name="chequeNumber" required><br>

        <label for="chequeAmount">Amount:</label>
        <input type="number" id="chequeAmount" name="chequeAmount" step="0.01" required><br>

        <label for="chequeDate">Cheque Date:</label>
        <input type="date" id="chequeDate" name="chequeDate" required><br>

        <label for="chequeStatus">Status:</label>
        <select id="chequeStatus" name="chequeStatus" required>
            <option value="Pending">Pending</option>
            <option value="Paid">Paid</option>
        </select><br>

        <label for="customerId">Customer:</label>
        <select id="customerId" name="customerId" required>
            <option value="">Select Customer</option>
            <!-- Customer options will be populated here by AJAX -->
        </select><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>

<!-- Update Cheque Form -->
<div id="UpdateChequeForm" class="form-container">
    <h3>Update Cheque Details</h3>
    <form id="updateChequeForm" action="update_cheque.php" method="post">
        <label for="updatechequeNumber">Cheque Number:</label>
        <select id="updatechequeNumber" name="updatechequeNumber" required>
            <option value="">Select Cheque Number</option>
            <!-- Cheque numbers will be populated here by AJAX -->
        </select><br>

        <label for="updatechequeAmount">Amount:</label>
        <input type="number" id="updatechequeAmount" name="updatechequeAmount" step="0.01" required><br>

        <label for="updatechequeDate">Cheque Date:</label>
        <input type="date" id="updatechequeDate" name="updatechequeDate" required><br>

        <label for="updatechequeStatus">Status:</label>
        <select id="updatechequeStatus" name="updatechequeStatus" required>
            <option value="Pending">Pending</option>
            <option value="Paid">Paid</option>
        </select><br>

        <label for="updatecustomerId">Customer:</label>
        <select id="updatecustomerId" name="updatecustomerId" required>
            <option value="">Select Customer</option>
            <!-- Customer options will be populated here by AJAX -->
        </select><br>

        <button type="submit" class="btn custom-btn submitBtn">Update</button>
    </form>
</div>


<!-- Display container -->
<div id="container_display" class="container_display" style="display: none;">
    <h2>Upcoming cheque Details</h2>
    <div id="stockResults"></div> <!-- Results will be inserted here -->
    <button id="closeBtn" class="back-btn">Close</button>
</div>

<!-- Search Cheque Form -->
<div id="searchChequeForm" class="form-container">
    <h3>Search Cheque</h3>
    <form id="searchChequeForm">
        <label for="searchChequeNumber">Cheque Number:</label>
        <select id="searchChequeNumber" name="searchChequeNumber">
            <option value="">Select Cheque Number</option>
            <!-- Dynamic cheque numbers will be populated here -->
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


    <!-- Mark Cheque Status Form -->
    <div id="markChequeStatusForm" class="form-container">
        <h3>Mark Cheque Status</h3>
        <form>
            <label for="markChequeNumber">Cheque Number:</label>
            <input type="text" id="markChequeNumber" name="markChequeNumber" required><br>

            <label for="markChequeStatus">Status:</label>
            <select id="markChequeStatus" name="markChequeStatus" required>
                <option value="cleared">Cleared</option>
                <option value="bounced">Bounced</option>
            </select><br>

            <button type="submit" class="btn custom-btn submitBtn">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially hide all forms and sections
            $(".form-container").hide();

            // Toggle Record Cheque form
            $("#AddCheque").click(function() {
                $(".form-container").fadeOut();
                $("#addChequeForm").fadeToggle();
            });

            $("#UpdateCheque").click(function() {
                $(".form-container").fadeOut();
                $("#UpdateChequeForm").fadeToggle();
            });

            

            // Toggle View Upcoming Cheques
            $("#ViewUpcomingCheques").click(function() {
                $(".form-container").fadeOut();
                $("#viewUpcomingCheques").fadeToggle();
            });

            // Toggle Search Cheque form
            $("#SearchCheque").click(function() {
                $(".form-container").fadeOut();
                $("#searchChequeForm").fadeToggle();
            });

            // Toggle Mark Cheque Status form
            $("#MarkChequeStatus").click(function() {
                $(".form-container").fadeOut();
                $("#markChequeStatusForm").fadeToggle();
            });


            $.ajax({
    url: 'fetch_customers.php',  // PHP script to fetch customer data
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            var customerSelect = $('#customerId');
            var updatecustomerSelect = $('#updatecustomerId');
            // Clear existing options and add a default option
            customerSelect.empty().append('<option value="">Select Customer</option>');
            updatecustomerSelect.empty().append('<option value="">Select Customer</option>');
            
            // Loop through each customer and add it as an option for both select elements
            response.data.forEach(function(customer) {
                // Add option to the first customer dropdown (for adding cheque)
                customerSelect.append('<option value="' + customer.Customer_id + '">' + customer.Customer_id + ' - ' + customer.Customer_name + '</option>');
                
                // Add option to the second customer dropdown (for updating cheque)
                updatecustomerSelect.append('<option value="' + customer.Customer_id + '">' + customer.Customer_id + ' - ' + customer.Customer_name + '</option>');
            });
        } else {
            alert('No customers found.');
        }
    },
    error: function() {
        alert('Error fetching customer data.');
    }
});


                    // Handle button click for fetching pending cheques
        $('#ViewUpcomingCheques').on('click', function () {
            $.ajax({
                url: 'fetch_pending_cheques.php',
                method: 'POST',
                success: function (response) {
                    $('#stockResults').html(response); // Insert fetched data into stockResults
                    $('#container_display').show();    // Show the container
                },
                error: function () {
                    alert('Error fetching data. Please try again.');
                }
            });
        });

        // Handle close button functionality
        $('#closeBtn').on('click', function () {
            $('#container_display').hide(); // Hide the container
        });


            // AJAX call to get cheque numbers from the database
    $.ajax({
        url: 'get_cheque_numbers.php', // PHP script to fetch cheque numbers
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Populate the select dropdown with cheque numbers
                response.data.forEach(function(cheque) {
                    $('#searchChequeNumber').append(
                        `<option value="${cheque.Cheque_number}">${cheque.Cheque_number}</option>`
                    );

                    $('#updatechequeNumber').append(
                        `<option value="${cheque.Cheque_number}">${cheque.Cheque_number}</option>`
                    );
                });
            } else {
                alert('Failed to load cheque numbers.');
            }
        }
    });

    // Handle form submission
    $('#searchChequeForm').submit(function(event) {
        event.preventDefault(); // Prevent form from reloading the page

        var chequeId = $('#searchChequeNumber').val();

        if (chequeId) {
            $.ajax({
                url: 'fetch_cheque_details.php', // PHP script to fetch cheque details
                method: 'POST',
                data: { chequeId: chequeId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Show the result container
                        $('#container_search').show();
                        $('#searchResults').html(`
                            <div class="stock-card">
                                <p><strong>Cheque Number:</strong> ${response.data.Cheque_number}</p>
                                <p><strong>Cheque Amount:</strong> ${response.data.Cheque_amount}</p>
                                <p><strong>Cheque Date:</strong> ${response.data.Cheque_date}</p>
                                <p><strong>Cheque Status:</strong> ${response.data.Cheque_status}</p>
                            </div>
                        `);
                    } else {
                        alert('Cheque not found.');
                    }
                }
            });
        } else {
            alert('Please select a cheque number.');
        }
    });

    // Close the result container
    $('#closesearchBtn').click(function() {
        $('#container_search').hide();
    });

 

        });
    </script>
    <!-- Bootstrap JS Bundle (includes Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
