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
  width: 20%;
  margin-left: 40%;
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

#stockResults {
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #000;
}

#stockResults table {
    margin-top: 10px;
    width: 100%;
    border-collapse: collapse;
}

#stockResults th, #stockResults td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ccc;
}

#stockResults tr:nth-child(even) {
    background-color: #f9f9f9;
}

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




      <h1 class="title">Debt Management</h1>


    <!-- Buttons Container -->
    <div class="button-container">
        <button id="ViewDebts" class="btn custom-btn">View Debts</button>
        <button id="SearchDebts" class="btn custom-btn">Search Debts</button>
    </div>




<!-- Container to display the table of debts -->
<div id="stockResults" class="container_display" style="display: none;">
    <h2>Customer Debts</h2>
    <table id="debtTable">
        <thead>
            <tr>
                <th>Debt ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th> <!-- New column for customer name -->
                <th>Debt Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>
    <a href="javascript:void(0);" id="closeBtn">Close</a>
</div>

<?php
include 'db_connection.php'; // Include the database connection

// Your existing HTML and PHP code for the debt form...
?>

<!-- Search Debt Form Container (Initially hidden) -->
<div id="searchDebtFormContainer" class="form-container" style="display: none;">
    <h2>Search Debt</h2>
    <form id="searchDebtForm">
        <!-- Select Debt -->
        <label for="debt_id">Select Debt:</label>
        <select id="debt_id" name="debt_id">
            <option value="">Select Debt</option>
            <?php
            // Query the database for debts and customers
            $debt_query = "SELECT d.Debt_id, d.Debt_amount, d.Debt_date, c.Customer_name FROM debt d
                           JOIN customer c ON d.Customer_id = c.Customer_id";
            $debt_result = $conn->query($debt_query);

            if ($debt_result->num_rows > 0) {
                while ($row = $debt_result->fetch_assoc()) {
                    echo "<option value='{$row['Debt_id']}'>ID: {$row['Debt_id']} - Customer: {$row['Customer_name']} </option>";
                }
            } else {
                echo "<option value=''>No debts available</option>";
            }
            ?>
        </select>
        <br><br>

        <!-- Submit Button -->
        <button type="button" id="submitDebtButton" class="btn custom-btn submitBtn">Search</button>
    </form>
</div>

<!-- Results Container -->
<div id="container_search" class="container_search" style="display: none;">
    <h2>Debt Details</h2> 
    <div id="searchResults"></div>
    <button id="closesearchBtn" class="back-btn">Close</button>
</div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
  

       // Initially hide the search debt form
       $(".form-container").hide();

// Show the form when 'Search Debts' button is clicked
$("#SearchDebts").click(function() {
    $(".form-container").fadeIn();  // Show the debt search form
});

// Hide the form when 'View Debts' button is clicked
$("#ViewDebts").click(function() {
    $("#searchDebtFormContainer").fadeOut();  // Hide the debt search form
});



// When the 'View Debts' button is clicked
$('#ViewDebts').on('click', function () {
    // Perform an AJAX request to fetch debt data
    $.ajax({
        url: 'fetch_debts.php', // Replace with the actual PHP script path
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Clear any previous table data
            $('#debtTable tbody').empty();

            if (response.debts) {
                // Loop through each debt record and append to the table
                response.debts.forEach(function (debt) {
                    var row = `<tr>
                        <td>${debt.Debt_id}</td>
                        <td>${debt.Customer_id}</td>
                        <td>${debt.Customer_name}</td> <!-- Display customer name -->
                        <td>${debt.Debt_amount}</td>
                    </tr>`;
                    $('#debtTable tbody').append(row);
                });

                // Show the debt results container
                $('#stockResults').show();
            } else {
                // Handle no debts found
                $('#debtTable tbody').append('<tr><td colspan="4">No debts found.</td></tr>');
                $('#stockResults').show();
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('Error fetching debt data:', error);
        }
    });
});

// Close the debt results container when the 'Close' button is clicked
$('#closeBtn').on('click', function () {
    $('#stockResults').hide();
});


$('#submitDebtButton').on('click', function () {
        var debtId = $('#debt_id').val(); // Get the selected Debt ID
        if (debtId != '') {
            $.ajax({
                url: 'fetch_debt_details.php', // PHP script to fetch debt details
                type: 'GET',
                data: { debt_id: debtId },
                success: function(response) {
                    // Display the results in the results container
                    $('#searchResults').html(response);
                    $('#container_search').show(); // Show the results container
                    $('#searchDebtFormContainer').hide(); // Hide the search form container
                },
                error: function() {
                    alert('Error fetching debt details.');
                }
            });
        } else {
            alert('Please select a debt.');
        }
    });

    // Handle close button click
    $('#closesearchBtn').on('click', function () {
        $('#container_search').hide(); // Hide the results container
        $('#searchDebtFormContainer').show(); // Show the search form container
    });



 });
    </script>
<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
