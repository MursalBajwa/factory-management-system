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
<?php
// Start the session at the very beginning of your script
session_start();

// Check if the session variable 'Customer_id' is set
if (isset($_SESSION['Customer_id'])) {
    // Get the logged-in customer ID from the session
    $customer_id = $_SESSION['Customer_id'];

    // Include the database connection
    include 'db_connection.php';

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
} else {
    // If the session variable is not set, you can handle the case (e.g., redirect to login page)
    $pending_count = 0;
    // Optionally, redirect the user to the login page or show an error message
    // header("Location: login.php");
    // exit();
}
?>

<!-- Now use the $pending_count variable to display the count in the navigation list -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Factory Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
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





      <h1 class="title">View Reports</h1>


<!-- Buttons Container -->
<div class="button-container">
    <button id="GenerateInvoiceBtn" class="btn custom-btn">Generate Invoice Report</button>
    <button id="DebtReport" class="btn custom-btn">View Debt</button>
</div>

<?php


// Check if the session variable 'Customer_id' is set
if (isset($_SESSION['Customer_id'])) {
    $customer_id = $_SESSION['Customer_id'];  // Get the logged-in customer ID from the session

    // Include the database connection
    include 'db_connection.php';

    // Query to fetch invoices for the logged-in customer
    $query = "SELECT temp_Invoice_id, temp_Inv_date FROM temp_invoice WHERE temp_Customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);  // Bind the customer ID to the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Create an array to hold the invoice data
    $invoices = [];
    while ($row = $result->fetch_assoc()) {
        $invoices[] = [
            'invoice_id' => $row['temp_Invoice_id'],
            'invoice_date' => $row['temp_Inv_date']
        ];
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!-- Transaction Report Form -->
<div id="GenerateInvoiceReportForm" class="form-container">
    <h3>Generate Invoice Report</h3>
    <form method="POST" action="Invoice.php">
        <label for="invoice">Select Invoice:</label>
        <select name="invoice_id" id="invoice" class="form-select" required>
            <option value="" disabled selected>Select an invoice</option>
            <?php
            // Display the invoices in the dropdown
            if (!empty($invoices)) {
                foreach ($invoices as $invoice) {
                    echo '<option value="' . $invoice['invoice_id'] . '">';
                    echo $invoice['invoice_id'] . ' - ' . $invoice['invoice_date'];
                    echo '</option>';
                }
            } else {
                echo '<option value="">No invoices found</option>';
            }
            ?>
        </select>

        <button type="submit" class="btn custom-btn submitBtn">Generate Report</button>
    </form>
</div>



<!-- Results Container -->
<div id="container_search" class="container_search" style="display:none;">
    <h2>Debt Details</h2>
    <div id="searchResults"></div>
    <button id="closesearchBtn" class="back-btn">Close</button>
</div>



<!-- Financial Report Form -->
<div id="financialReportForm" class="form-container">
    <h3>Generate Financial Report</h3>
    <form>
        <label for="financialStartDate">Start Date:</label>
        <input type="date" id="financialStartDate" name="financialStartDate"><br>

        <label for="financialEndDate">End Date:</label>
        <input type="date" id="financialEndDate" name="financialEndDate"><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
    <div id="financialReportResult" class="report-result">
        <!-- Financial Report Results will appear here -->
    </div>
</div>

<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initially hide all forms
        $(".form-container").hide();

        // Toggle Transaction Report form
        $("#GenerateInvoiceBtn").click(function() {
            $(".form-container").fadeOut();
            $("#GenerateInvoiceReportForm").fadeToggle();
        });

        // Toggle Debt Report form
        $("#DebtReport").click(function() {
            $(".form-container").fadeOut();
            $("#debtReportForm").fadeToggle();
        });

        // Toggle Financial Report form
        $("#FinancialReport").click(function() {
            $(".form-container").fadeOut();
            $("#financialReportForm").fadeToggle();
        });

              // On button click, initiate the AJAX request
    $('#DebtReport').click(function() {
        $.ajax({
            url: 'fetch_user_debt.php', // Replace with the actual PHP script URL
            type: 'GET',
            data: {
                action: 'fetch_debt', // You can use this to identify the action in PHP
            },
            success: function(response) {
                // Display the result in the container
                $('#searchResults').html(response);
                $('#container_search').show();
            },
            error: function() {
                alert("An error occurred while fetching debt details.");
            }
        });
    });

    // Close the search results container
    $('#closesearchBtn').click(function() {
        $('#container_search').hide();
    });


    });
</script>
<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
