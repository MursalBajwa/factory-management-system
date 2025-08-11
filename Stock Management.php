
<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successStock']) && $_SESSION['successStock'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Stock Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successStock']);
}

if (isset($_SESSION['errorStock']) && $_SESSION['errorStock'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorStock']);
}

if (isset($_SESSION['dublicateStock']) && $_SESSION['dublicateStock'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Stock. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateStock']);
}


if (isset($_SESSION['updatedStock']) && $_SESSION['updatedStock']  === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Stock Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updatedStock']);
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
  width: 57%;
  margin-left: 20%;
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

    .container_table {
            width: 90%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            display: none; /* Initially hidden */
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .high {
            color: green;
        }
        .low {
            color: red;
        }
        .btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #555;
        }
        .close-btn {
            background-color: #f44336; /* Red color for close button */
            margin-top: 10px;
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
}

#closeBtn:hover {
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







      <h1 class="title">Stock Management</h1>
<h1></h1>

<!-- Buttons Container -->
<div class="button-container">
    <button id="AddStock" class="btn custom-btn">Add Stock</button>
    <button id="ViewStockLevels" class="btn custom-btn">View Stock Levels</button>
    <button id="UpdateStock" class="btn custom-btn">Update Stock</button>
    <button id="SearchStock" class="btn custom-btn">Search Stock by ID</button>
</div>

<?php
// Include the database connection
include('db_connection.php');

// Fetch supplier data for the Supplier ID dropdown
$sql = "SELECT Supplier_id, Supplier_name FROM supplier";
$result = $conn->query($sql);
?>

<!-- Add Stock Form -->
<div id="addStockForm" class="form-container">
    <h3>Add New Product to Inventory</h3>
    <form action="add_raw_material.php" method="POST">
        <label for="stockName">Product Name:</label>
        <input type="text" id="stockName" name="stockName" required><br>

        <label for="stockQuantity">Quantity:</label>
        <input type="number" id="stockQuantity" name="stockQuantity" required><br>

        <label for="stockCategory">Category:</label>
        <input type="text" id="stockCategory" name="stockCategory" required><br>

        <label for="stockPrice">Price Per Unit:</label>
        <input type="number" id="stockPrice" name="stockPrice" step="0.01" required><br>

        <label for="supplierId">Supplier ID:</label>
        <select id="supplierId" name="supplierId" required>
            <option value="" disabled selected>Select Supplier</option>
            <?php
            if ($result->num_rows > 0) {
                // Populate supplier dropdown
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Supplier_id'] . "'>" . $row['Supplier_id'] . " - " . $row['Supplier_name'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No suppliers found</option>";
            }
            ?>
        </select><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>

<?php
// Close the database connection
$conn->close();
?>





<!-- Track Stock Transactions Section -->
<div id="trackHistory" class="form-container">
    <h3>Transaction History</h3>
    <table id="transactionHistoryTable" border="1">
        <thead>
            <tr>
                <th style="padding: 20px;">Transaction ID</th>
                <th style="padding: 20px;">Product Name</th>
                <th style="padding: 20px;">Quantity</th>
                <th style="padding: 20px;">Type</th>
                <th style="padding: 20px;">Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>
</div>

<?php
// Include the database connection
include('db_connection.php');

// Fetch stock data for the Stock ID dropdown
$sql = "SELECT Raw_id, Raw_product_name, Raw_category, Supplier_id FROM raw_material";
$result = $conn->query($sql);
?>

<!-- Update Stock Form -->
<div id="updateStockForm" class="form-container">
    <h3>Update Stock Details</h3>
    <form action="update_stock.php" method="POST">
        <label for="updateStockId">Stock ID:</label>
        <select id="updateStockId" name="updateStockId" required>
            <option value="" disabled selected>Select Stock</option>
            <?php
            if ($result->num_rows > 0) {
                // Populate the Stock ID dropdown
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Raw_id'] . "'>" . $row['Raw_id'] . " - " . $row['Raw_product_name'] . " - " . $row['Raw_category'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No stock found</option>";
            }
            ?>
        </select><br>

        <label for="updateStockName">New Product Name:</label>
        <input type="text" id="updateStockName" name="updateStockName"><br>

        <label for="updateStockQuantity">New Quantity:</label>
        <input type="number" id="updateStockQuantity" name="updateStockQuantity"><br>

        <label for="updateStockCategory">New Category:</label>
        <input type="text" id="updateStockCategory" name="updateStockCategory"><br>

        <label for="updateStockPrice">New Price Per Unit:</label>
        <input type="number" id="updateStockPrice" name="updateStockPrice" step="0.01"><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>

<?php
// Close the database connection
$conn->close();
?>


<?php
// Include the database connection
include('db_connection.php');

// Fetch Stock data from the 'raw_material' table
$sql = "SELECT Raw_id, Raw_product_name, Raw_category, Supplier_id FROM raw_material";
$result = $conn->query($sql);
?>

<!-- Search Stock Form -->
<div id="searchStockForm" class="form-container">
    <h3>Search Stock by ID</h3>
    <form id="searchStockByIdForm" > <!-- Add action and method -->
        <label for="searchStockId">Stock ID:</label>
        <select id="searchStockId" name="searchStockId" required>
            <option value="" disabled selected>Select Stock</option>
            <?php
            if ($result->num_rows > 0) {
                // Populate the Stock ID dropdown
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Raw_id'] . "'>" . $row['Raw_id'] . " - " . $row['Raw_product_name'] . " - " . $row['Raw_category'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No stock found</option>";
            }
            ?>
        </select><br>
        <button type="Button" id="searchStockBtn" class="btn custom-btn">Search</button>
    </form>
</div>

<?php
// Close the database connection
$conn->close();
?>

<!-- Container for displaying the search results -->
<div id="container_display" class="container" style="display: none;">
    <h2>Stock Details</h2>
    <div id="stockResults"></div> <!-- Results will be inserted here -->
    <button id="closeBtn" class="back-btn">Close</button>
</div>



<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initially hide all forms and sections
        $(".form-container").hide();

        // Toggle Add Stock form
        $("#AddStock").click(function() {
            $(".form-container").fadeOut();
            $("#addStockForm").fadeToggle();
        });

        // Toggle View Stock Levels
        $("#ViewStockLevels").click(function() {
            $(".form-container").fadeOut();
            $("#viewStockLevels").fadeToggle();
            $("#stockTable").show(); // Show the table
            $("#CloseTable").show(); // Show the close button
        });

        // Toggle Track Transactions
        $("#TrackHistory").click(function() {
            $(".form-container").fadeOut();
            $("#trackHistory").fadeToggle();
        });

                // Close the stock table and show the "View Stock Levels" button
         $("#CloseTable").click(function() {
            $("#stockTable").hide(); // Hide the table
            $("#CloseTable").hide(); // Hide the close button
                  
        });

        // Toggle Update Stock form
        $("#UpdateStock").click(function() {
            $(".form-container").fadeOut();
            $("#updateStockForm").fadeToggle();
        });

        // Toggle Search Stock form
        $("#SearchStock").click(function() {
            $(".form-container").fadeOut();
            $("#searchStockForm").fadeToggle();
        });

        // When the search button is clicked
$('#searchStockBtn').on('click', function() {
    var stockId = $('#searchStockId').val();  // Get the selected Stock ID
    if (!stockId) {
        alert('Please select a Stock ID.');
        return;
    }

    // Send AJAX request to fetch stock details by Stock ID
    $.ajax({
        url: 'search_stock.php',  // The PHP file that will process the search
        type: 'GET',  // Send a GET request
        data: { stockId: stockId },  // Pass the Stock ID as a parameter
        success: function(response) {
            // If response contains data, show the container with results
            if (response) {
                $('#stockResults').html(response);  // Display the results
                $('#container_display').show();  // Show the results container
            } else {
                $('#stockResults').html('<p>No stock found for this ID.</p>');
                $('#container_display').show();  // Show the results container
            }
        },
        error: function() {
            alert('Error fetching stock details.');
        }
    });
});

      // When the close button is clicked
      $('#closeBtn').on('click', function() {
          $('#container_display').hide();  // Hide the results container
      });

    });
</script>

    

<?php
// Include the database connection
include('db_connection.php');

// Fetch stock data along with the supplier name
$sql = "SELECT rm.Raw_id, rm.Raw_product_name, rm.Raw_quantity, rm.Raw_category, rm.Raw_price, rm.Supplier_id, s.Supplier_name
        FROM raw_material rm
        JOIN supplier s ON rm.Supplier_id = s.Supplier_id"; // Assuming suppliers table exists
$result = $conn->query($sql);
?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->


<div class="container_table">
    <button id="CloseTable" class="btn close-btn" style="display:none;">Close Table</button> <!-- Hidden initially -->

    <table id="stockTable">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Status</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Determine the status based on Raw_quantity
                    $status = ($row['Raw_quantity'] > 30) ? 'High' : 'Low';
                    $statusClass = ($row['Raw_quantity'] > 30) ? 'high' : 'low';

                    // Display the row
                    echo "<tr>";
                    echo "<td>" . $row['Raw_id'] . "</td>";
                    echo "<td>" . $row['Raw_product_name'] . "</td>";
                    echo "<td>" . $row['Raw_quantity'] . "</td>";
                    echo "<td>" . $row['Raw_category'] . "</td>";
                    echo "<td class='$statusClass'>" . $status . "</td>";
                    echo "<td>" . $row['Supplier_id'] . " - " . $row['Supplier_name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align: center;'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Close the database connection
$conn->close();
?>







<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>