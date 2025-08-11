<?php
// Start the session to access user data
session_start();

    // Check if the session variable 'came_from_fetch_users' is set to true
    if (isset($_SESSION['came_from_fetch_users']) && $_SESSION['came_from_fetch_users'] === true) {
        // Unset the session variable as it's no longer needed
        unset($_SESSION['came_from_fetch_users']);

    } else {
        // If the session variable is not set to true, redirect to fetch_users.php
        $_SESSION['came_from_Customer']=true;
        header('Location: fetch_users.php');
        exit(); // Don't forget to call exit after the header redirection
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

      <?php
// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['success']) && $_SESSION['success'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Customer Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['success']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['error']);
}

if (isset($_SESSION['dublicate']) && $_SESSION['dublicate'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Customer. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicate']);
}


if (isset($_SESSION['updated']) && $_SESSION['updated']  === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> User Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updated']);
}
?>


      <h1 class="title">Customer Management</h1>


    <!-- Buttons Container -->
    <div class="button-container">
        <button id="AddCustomer" class="btn custom-btn">Add Customer</button>
        <button id="SearchCustomer" class="btn custom-btn">Search Customer</button>
        <button id="UpdateCustomer" class="btn custom-btn">Update Customer</button>
    </div>

    <!-- Add Customer Form -->
    <div id="addCustomerForm" class="form-container">
        <h3>Add Customer</h3>
        <form action="add_customer.php" method="POST">
            <label for="customerName">Name:</label>
            <input type="text" id="customerName" name="customerName" required>
            <label for="customerContact">Contact:</label>
            <input type="text" id="customerContact" name="customerContact" required>
            <label for="UserId">Select User ID :</label>
              <select id="UserId" name="UserId" required>
                  <option value="">Select</option>
                  <?php
                // Check if user IDs are stored in session
                if (isset($_SESSION['$only_ids']) && !empty($_SESSION['$only_ids'])) {
                    // Loop through session user IDs and create options dynamically
                    foreach ($_SESSION['$only_ids'] as $user_id) {
                        echo "<option value=\"$user_id\">$user_id</option>";
                    }
                }
                ?>
              </select>
            <label for="customerAddress">Address:</label>
            <textarea id="customerAddress" name="customerAddress" rows="3" required></textarea>
            <button type="submit" class="btn custom-btn submitBtn">Submit</button>
        </form>
    </div>

    <!-- Search Customer Form -->
    <div id="searchCustomerForm" class="form-container">
        <h3>Search Customer</h3>
        <form form action="search_customer.php" method="POST">
            <label for="searchBy">Search By:</label>
            <select id="searchBy" name="searchBy" required>
                <option value="">Select</option>
                <option value="name">Name</option>
                <option value="id">ID</option>
            </select>
            <label for="searchValue">Enter Value:</label>
            <input type="text" id="searchValue" name="searchValue" required>
            <button type="submit" class="btn custom-btn submitBtn">Submit</button>
        </form>
    </div>



    <!-- Update Customer Form -->
    <?php
// Include the database connection
include('db_connection.php');

// Fetch user IDs from the database
$sql = "SELECT Customer_id, Customer_name FROM customer";
$result = $conn->query($sql);
?>
<div id="updateCustomerForm" class="form-container">
    <h3>Update Customer</h3>
    <form action="Update_Customer.php" method="POST"> <!-- Add form action and method -->
        <label for="updateCustomerId">Customer ID:</label>
        <select id="updateCustomerId" name="updateCustomerId" required>
            <option value="" disabled selected>Select a Customer ID</option>
            <?php
            // Check if there are any rows in the result set
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Customer_id'] . "'>". $row['Customer_id']. "-" . $row['Customer_name'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No customers found</option>";
            }
            ?>
        </select>

        <label for="updateCustomerName">Name:</label>
        <input type="text" id="updateCustomerName" name="updateCustomerName">

        <label for="updateCustomerContact">Contact:</label>
        <input type="text" id="updateCustomerContact" name="updateCustomerContact">

        <label for="updateCustomerAddress">Address:</label>
        <textarea id="updateCustomerAddress" name="updateCustomerAddress" rows="3"></textarea>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>

<?php
// Close the database connection
$conn->close();
?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially hide all forms
            $(".form-container").hide();

            // Toggle Add Customer form
            $("#AddCustomer").click(function() {
                $(".form-container").fadeOut();
                $("#addCustomerForm").fadeToggle();
            });

            // Toggle Search Customer form
            $("#SearchCustomer").click(function() {
                $(".form-container").fadeOut();
                $("#searchCustomerForm").fadeToggle();
            });

            // Toggle Generate Report form
            $("#GenerateReport").click(function() {
                $(".form-container").fadeOut();
                $("#generateReportForm").fadeToggle();
            });

            // Toggle Update Customer form
            $("#UpdateCustomer").click(function() {
                $(".form-container").fadeOut();
                $("#updateCustomerForm").fadeToggle();
            });

            $("#closeBtn").click(function(e) {
    // Prevent the default behavior of the link (if it's a link tag)
    e.preventDefault();
    
    // Hide the element with the class 'container_body'
    $("#NoRecord").css("display", "none");

    // You can optionally redirect the user, but it won't trigger if you prevent the default action.
    // window.location.href = "Customer Management.php?clear=true"; // Uncomment this to navigate to another page if needed
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
    exit();
}

// Check if customer data exists in the session
if (isset($_SESSION['customer_data']) && !empty($_SESSION['customer_data'])) {
    $customers = $_SESSION['customer_data'];
    unset($_SESSION['customer_data']);
}else
{
  if (isset($_SESSION['Not_record']) && ($_SESSION['Not_record'] == true)) {
    echo "<div id='NoRecord' style='color: red; text-align: center;'>No customer data to display <a href='#' id='closeBtn' style='display: inline-block; color: red;'>Close</a>.</div>";
    $_SESSION['Not_record'] =false;
   }
  exit();
}
 
?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .container_body {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container_body h2 {
            text-align: center;
            color: #333;
        }

        .customer-card {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .customer-card p {
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

<body>
    <div class="container_body">
        <h2>Customer Details</h2>

        <?php foreach ($customers as $customer): ?>
            <div class="customer-card">
                <p><strong>ID:</strong> <?= $customer['Customer_id']; ?></p>
                <p><strong>Name:</strong> <?= $customer['Customer_name']; ?></p>
                <p><strong>Contact:</strong> <?= $customer['Customer_contact']; ?></p>
                <p><strong>Address:</strong> <?= $customer['Customer_address']; ?></p>
                <p><strong>User ID:</strong> <?= $customer['User_id']; ?></p>
            </div>
        <?php endforeach; ?>

        <a id="ClearBtn" href="Customer Management.php" class="back-btn">Clear</a>
    </div>


      </body>
      </html>

