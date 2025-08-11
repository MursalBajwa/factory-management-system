<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successSupplier']) && $_SESSION['successSupplier'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Supplier Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successSupplier']);
}

if (isset($_SESSION['errorSupplier']) && $_SESSION['errorSupplier'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorSupplier']);
}

if (isset($_SESSION['dublicateSupplier']) && $_SESSION['dublicateSupplier'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Supplier. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateSupplier']);
}


if (isset($_SESSION['updatedSupplier']) && $_SESSION['updatedSupplier']  === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Supplier Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updatedSupplier']);
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

        .supplier-card {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .supplier-card p {
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




      <h1 class="title">Supplier Management</h1>


<!-- Buttons Container -->
<div class="button-container">
    <button id="AddSupplier" class="btn custom-btn">Add Supplier</button>
    <button id="UpdateSupplier" class="btn custom-btn">Update Supplier</button>
    <button id="SearchSupplier" class="btn custom-btn">Search Supplier</button>
</div>

<!-- Add Supplier Form -->
<div id="addSupplierForm" class="form-container">
    <h3>Add Supplier</h3>
    <form action="add_supplier.php" method="POST">

        <label for="supplierName">Supplier Name:</label>
        <input type="text" id="supplierName" name="supplierName" required><br>

        <label for="supplierContact">Contact Number:</label>
        <input type="text" id="supplierContact" name="supplierContact" required><br>

        <label for="supplierAddress">Address:</label>
        <input type="text" id="supplierAddress" name="supplierAddress" required><br>

        <label for="supplierEmail">Email:</label>
        <input type="email" id="supplierEmail" name="supplierEmail" required><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>


    </form>
</div>

<!-- Generate Supplier Transaction Report Form -->
<?php
// Include the database connection
include('db_connection.php');

// Fetch supplier data from the database
$sql = "SELECT Supplier_id, Supplier_name FROM supplier";
$result = $conn->query($sql);
?>

<div id="updateSupplierForm" class="form-container">
    <h3>Update Supplier</h3>
    <form action="update_supplier.php" method="POST">
        
        <label for="supplierId">Supplier ID:</label>
        <select id="supplierId" name="supplierId">
            <option value="" disabled selected>Select a Supplier ID</option>
            
            <?php
            // Check if there are any suppliers in the database
            if ($result->num_rows > 0) {
                // Loop through all suppliers and create an option for each
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['Supplier_id'] . "'>" . $row['Supplier_id'] . " - " . $row['Supplier_name'] . "</option>";
                }
            } else {
                // If no suppliers are found, show a message
                echo "<option value='' disabled>No suppliers found</option>";
            }
            ?>

        </select>
        
        <!-- These fields will be populated when a supplier ID is selected -->
        <label for="supplierName">Supplier Name:</label>
        <input type="text" id="supplierName" name="supplierName" value="" required><br>

        <label for="supplierContact">Contact Number:</label>
        <input type="text" id="supplierContact" name="supplierContact" value="" required><br>

        <label for="supplierAddress">Address:</label>
        <input type="text" id="supplierAddress" name="supplierAddress" value="" required><br>

        <label for="supplierEmail">Email:</label>
        <input type="email" id="supplierEmail" name="supplierEmail" value="" required><br>

        <button type="submit" class="btn custom-btn submitBtn">Update</button>
    </form>
</div>

<?php
// Close the database connection
$conn->close();
?>


<?php
// Include the database connection
include('db_connection.php');

// Fetch supplier data from the database for the Supplier ID dropdown
$sql = "SELECT Supplier_id, Supplier_name FROM supplier";
$result = $conn->query($sql);
?>

<div id="searchSupplierForm" class="form-container">
    <h3>Search Suppliers</h3>
    <form action="search_supplier.php" method="GET">
        
        <label for="searchSupplierId">Supplier ID:</label>
        <select id="searchSupplierId" name="searchSupplierId">
            <option value="" disabled selected>Select a Supplier ID</option>
            
            <?php
            // Check if there are any suppliers in the database
            if ($result->num_rows > 0) {
                // Loop through all suppliers and create an option for each
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Supplier_id'] . "'>" . $row['Supplier_id'] . " - " . $row['Supplier_name'] . "</option>";
                }
            } else {
                // If no suppliers are found, show a message
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

    <div id="searchResults" class="form-container">
        <h4>Search Results</h4>
        <table id="searchResultsTable" border="1">
            <thead>
                <tr>
                    <th style="padding: 20px;">Supplier ID</th>
                    <th style="padding: 20px;">Supplier Name</th>
                    <th style="padding: 20px;">Contact</th>
                    <th style="padding: 20px;">Email</th>
                </tr>
            </thead>
            <tbody>
                <!-- Search results will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>






<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initially hide all forms and sections
        $(".form-container").hide();

        // Toggle Add Supplier form
        $("#AddSupplier").click(function() {
            $(".form-container").fadeOut();
            $("#addSupplierForm").fadeToggle();
        });

        // Toggle Generate Supplier Report form
        $("#UpdateSupplier").click(function() {
            $(".form-container").fadeOut();
            $("#updateSupplierForm").fadeToggle();
        });

        // Toggle Search Supplier form
        $("#SearchSupplier").click(function() {
            $(".form-container").fadeOut();
            $("#searchSupplierForm").fadeToggle();
        });

        // Example dynamic report population (replace with actual data from backend)
        $("#generateReportBtn").click(function() {
            const supplierId = $("#reportSupplierId").val();
            const startDate = $("#reportStartDate").val();
            const endDate = $("#reportEndDate").val();
            const mockData = [
                { supplierId: 1, transactionType: "Payment", amount: 2000.00, date: "2024-12-05" },
                { supplierId: 2, transactionType: "Payment", amount: 500.00, date: "2024-12-06" },
            ];
            const results = mockData.filter(item => 
                (!supplierId || item.supplierId == supplierId) &&
                (!startDate || item.date >= startDate) &&
                (!endDate || item.date <= endDate)
            );
            if (results.length > 0) {
                $("#reportTable tbody").empty();
                results.forEach(item => {
                    $("#reportTable tbody").append(
                        `<tr>
                            <td>${item.supplierId}</td>
                            <td>${item.transactionType}</td>
                            <td>${item.amount}</td>
                            <td>${item.date}</td>
                        </tr>`
                    );
                });
                $("#reportResult").fadeIn();
            } else {
                alert("No records found for the selected criteria.");
            }
        });

        // Example dynamic search result population (replace with actual data from backend)
        $("#searchSupplierBtn").click(function() {
            const supplierId = $("#searchSupplierId").val();
            const supplierName = $("#searchSupplierName").val();
            const mockData = [
                { supplierId: 1, supplierName: "Supplier A", contact: "1234567890", email: "supplierA@example.com" },
                { supplierId: 2, supplierName: "Supplier B", contact: "0987654321", email: "supplierB@example.com" },
            ];
            const results = mockData.filter(item => 
                (!supplierId || item.supplierId == supplierId) &&
                (!supplierName || item.supplierName.toLowerCase().includes(supplierName.toLowerCase()))
            );
            if (results.length > 0) {
                $("#searchResultsTable tbody").empty();
                results.forEach(item => {
                    $("#searchResultsTable tbody").append(
                        `<tr>
                            <td>${item.supplierId}</td>
                            <td>${item.supplierName}</td>
                            <td>${item.contact}</td>
                            <td>${item.email}</td>
                        </tr>`
                    );
                });
                $("#searchResults").fadeIn();
            } else {
                alert("No matching suppliers found.");
            }
        });
    });
</script>
<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Check if there's an error message in the session
if (isset($_SESSION['error'])) {
  echo "<div style='color: red; text-align: center;'>" . $_SESSION['error'] . "</div>";
  // Clear the error message
  unset($_SESSION['error']);
}

// Check if supplier data exists in the session
if (isset($_SESSION['supplier_data']) && !empty($_SESSION['supplier_data'])) {
  $supplier = $_SESSION['supplier_data'];
} else {
  if (isset($_SESSION['Not_record_supplier']) && ($_SESSION['Not_record_supplier'] == true)) {
    echo "<div id='NoRecord' style='color: red; text-align: center;'>No Supplier data to display <a href='#' id='closeBtn' style='display: inline-block; color: red;'>Close</a>.</div>";
    $_SESSION['Not_record_supplier'] =false;
   }
  exit();
}
?>
    <div class="container_display">
        <h2>Supplier Details</h2>

        <div class="supplier-card">
            <p><strong>ID:</strong> <?= $supplier['Supplier_id']; ?></p>
            <p><strong>Name:</strong> <?= $supplier['Supplier_name']; ?></p>
            <p><strong>Contact Number:</strong> <?= $supplier['Supplier_contact_number']; ?></p>
            <p><strong>Address:</strong> <?= $supplier['Supplier_address']; ?></p>
            <p><strong>Email:</strong> <?= $supplier['Supplier_email']; ?></p>
        </div>

        <a href="Supplier Management.php" class="back-btn">Close</a>
    </div>


<?php
// Clear the session data for security
unset($_SESSION['supplier_data']);
?>


</body>
</html>



