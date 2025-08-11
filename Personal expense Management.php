<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successExpense']) && $_SESSION['successExpense'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Expense Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successExpense']);
}

if (isset($_SESSION['errorExpense']) && $_SESSION['errorExpense'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorExpense']);
}

if (isset($_SESSION['dublicateExpense']) && $_SESSION['dublicateExpense'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Expense. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateExpense']);
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
  width: 45%;
  margin-left: 27%;
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
    margin-bottom: 15px;
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #000;
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
    cursor: pointer;
}

#closeBtn:hover {
    background-color: #555;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.container h2 {
    text-align: center;
    color: #333;
}

#expenseSummaryTable {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

#expenseSummaryTable th, #expenseSummaryTable td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

#closeSummaryBtn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

#closeSummaryBtn:hover {
    background-color: #555;
}



.container_history {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.container_history h2 {
    text-align: center;
    color: #333;
}

#expensehistorytable {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

#expensehistorytable th, #expensehistorytable td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

#closeHistoryBtn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

#closeHistoryBtn:hover {
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




      <h1 class="title">Personal Expense Management</h1>

    
<!-- Buttons Container -->
<div class="button-container"> 
  <button id="AddExpense" class="btn custom-btn">Add Expense</button>
  <button id="SearchExpense" class="btn custom-btn">Search Expense</button>
  <button id="ExpenseSummary" class="btn custom-btn">Expense Summary</button>
  <button id="ExpenseHistory" class="btn custom-btn">Expense History</button>
</div>

   <!-- Add Expense Form -->
   <div id="addExpenseForm" class="form-container">
        <h3>Add New Personal Expense</h3>
        <form action="add_expense.php" method="post" id="expenseForm">
            <label for="expenseDescription">Description:</label>
            <input type="text" id="expenseDescription" name="expenseDescription" required><br>

            <label for="expenseAmount">Amount:</label>
            <input type="number" id="expenseAmount" name="expenseAmount" required><br>

            <label for="expenseCategory">Category:</label>
            <select id="expenseCategory" name="expenseCategory">
                <option value="food">Food</option>
                <option value="rent">Rent</option>
                <option value="transportation">Transportation</option>
                <option value="utilities">Utilities</option>
                <option value="entertainment">Entertainment</option>
                <option value="other">Other</option>
            </select><br>

            <button type="submit" class="btn custom-btn submitBtn">Submit</button>
        </form>
    </div>

<!-- Search Expense Form -->
<div id="searchExpenseForm" class="form-container">
  <h3>Search Expense by Category</h3>
  <form id="searchExpenseForm">
      <label for="searchCategory">Category:</label>
      <select id="searchCategory" name="searchCategory">
          <option value="food">Food</option>
          <option value="rent">Rent</option>
          <option value="transportation">Transportation</option>
          <option value="utilities">Utilities</option>
          <option value="entertainment">Entertainment</option>
      </select><br>

      <label for="FromexpenseDate">From:</label>
      <input type="date" id="FromexpenseDate" name="FromexpenseDate"><br>

      <label for="UntillexpenseDate">Until:</label>
      <input type="date" id="UntillexpenseDate" name="UntillexpenseDate"><br>

      <button type="submit" class="btn custom-btn submitBtn">Submit</button>
  </form>
</div>


<div id="container_display" class="container_display" style="display: none;">
    <h2>Expense Details</h2>
    <div id="stockResults"></div> <!-- Results will be inserted here -->
    <button id="closeBtn" class="back-btn">Close</button>
</div>





<!-- The container to display the summary results -->
<div id="container_display_summary" class="container" style="display: none;">
    <h2>Expense Summary</h2>
    <table id="expenseSummaryTable" class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic rows will be inserted here -->
        </tbody>
    </table>
    <button id="closeSummaryBtn" class="back-btn">Close</button>
</div>


<!-- The container to display the expense history -->
<div id="container_history" class="container_history" style="display: none;">
    <h2>Expense History</h2>
    <table id="expensehistorytable" class="table">
        <thead>
            <tr>
                <th>Expense ID</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic rows will be inserted here -->
        </tbody>
    </table>
    <button id="closeHistoryBtn" class="back-btn">Close</button>
</div>


<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      // Initially hide all forms
      $(".form-container").hide();

      // Toggle Log Expense form
      $("#AddExpense").click(function() {
          $(".form-container").fadeOut();
          $("#addExpenseForm").fadeIn();
      });

      // Toggle Search Expense form
      $("#SearchExpense").click(function() {
          $(".form-container").fadeOut();
          $("#searchExpenseForm").fadeIn();
      });

      // Toggle Expense Summary
      $("#ExpenseSummary").click(function() {
          $(".form-container").fadeOut();
          $("#expenseSummaryForm").fadeIn();
      });

      // Toggle Expense History form
      $("#ExpenseHistory").click(function() {
          $(".form-container").fadeOut();
          $("#expenseHistoryForm").fadeIn();
      });

      $("#searchExpenseForm").on("submit", function (event) {
        event.preventDefault();

        // Collect form data
        const category = $("#searchCategory").val();
        let fromDate = $("#FromexpenseDate").val();
        let untilDate = $("#UntillexpenseDate").val();

        // Format dates to yyyy-mm-dd if needed (ensure input type="date" does this natively)
        fromDate = new Date(fromDate).toISOString().slice(0, 10);
        untilDate = new Date(untilDate).toISOString().slice(0, 10);

        // AJAX request
        $.ajax({
            url: "search_expense.php", // PHP file to handle search
            type: "POST",
            data: {
                searchCategory: category,
                FromexpenseDate: fromDate,
                UntillexpenseDate: untilDate
            },
            success: function (response) {
                // Display results in the container
                $("#stockResults").html(response);
                $("#container_display").show();
            },
            error: function () {
                alert("Error processing request.");
            }
        });
    });

    // Close button functionality
    $("#closeBtn").on("click", function () {
        $("#container_display").hide();
    });


        // Trigger action when the "Fetch Summary" button is clicked
        $("#ExpenseSummary").click(function() {
        // Send AJAX request to fetch the expense summary for the current month
        $.ajax({
            url: 'fetch_expense_summary.php', // Your PHP file that handles the data fetch
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                // Display results in the table
                const tableBody = $('#expenseSummaryTable tbody');
                tableBody.empty(); // Clear previous results

                // Add new rows
                if (data.length > 0) {
                    data.forEach(function(item) {
                        const row = $('<tr>');
                        row.append('<td>' + item.Expense_category + '</td>');
                        row.append('<td>' + item.total_amount + '</td>');
                        tableBody.append(row);
                    });
                } else {
                    // If no data is found, display a message
                    const row = $('<tr><td colspan="2">No records found.</td></tr>');
                    tableBody.append(row);
                }

                // Show the container
                $('#container_display_summary').show();
            },
            error: function(error) {
                console.log('Error fetching expense summary:', error);
            }
        });
    });

    // Close button functionality
    $("#closeSummaryBtn").click(function() {
        $('#container_display_summary').hide();
    });


    $("#ExpenseHistory").click(function() {
        // Send AJAX request to fetch the expense history from the database
        $.ajax({
            url: 'fetch_expense_history.php', // PHP file to handle the request
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                // Display results in the table
                const tableBody = $('#expensehistorytable tbody');
                tableBody.empty(); // Clear previous results

                // Check if there are records to display
                if (data.length > 0) {
                    data.forEach(function(item) {
                        const row = $('<tr>');
                        row.append('<td>' + item.Expense_id + '</td>');
                        row.append('<td>' + item.Expense_description + '</td>');
                        row.append('<td>' + item.Expense_amount + '</td>');
                        row.append('<td>' + item.Expense_category + '</td>');
                        row.append('<td>' + item.Expense_date + '</td>');
                        tableBody.append(row);
                    });
                } else {
                    // If no records are found, display a message
                    const row = $('<tr><td colspan="5">No records found.</td></tr>');
                    tableBody.append(row);
                }

                // Show the container with the results
                $('#container_history').show();
            },
            error: function(error) {
                console.log('Error fetching expense history:', error);
            }
        });
    });

    // Close button functionality
    $("#closeHistoryBtn").click(function() {
        $('#container_history').hide();
    });

  });
</script>

    <!-- Bootstrap JS Bundle (includes Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
