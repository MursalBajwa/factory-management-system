<?php
session_start();



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>

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


  </style>
  
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Optional: Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<?php

    // Check if the session variable 'came_from_fetch_users' is set to true
    if (isset($_SESSION['came_from_fetch_users']) && $_SESSION['came_from_fetch_users'] === true) {
        // Unset the session variable as it's no longer needed
        unset($_SESSION['came_from_fetch_users']);

    } else {
        // If the session variable is not set to true, redirect to fetch_users.php
        header('Location: fetch_users.php');
        exit(); // Don't forget to call exit after the header redirection
    }
?>




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
          <strong>Success!</strong> User Added successfully.
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
          <strong>Oops!</strong> Trying to insert dublicate user. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicate']);
}
if (isset($_SESSION['deleted']) && $_SESSION['deleted'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> User Deleted successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['deleted']);
}

if (isset($_SESSION['updated']) && $_SESSION['updated'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> User Updated\ successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updated']);
}
?>



      <h1 class="title">Admin Panel</h1>

      <!-- Buttons Container -->
      <div class="button-container">
          <button id="AddUser" class="btn custom-btn">Add</button>

            <button id="DeleteUser" class="btn custom-btn">Delete</button>

          <button id="UpdateUser" class="btn custom-btn">Update</button>

      </div>
      
      
      <!-- Add User Form -->
      <div id="addUserForm" class="form-container">
          <h3>Add User</h3>
          <form action="add_user.php" method="POST">
                  
              <label for="userEmail">Email :</label>
              <input type="email" id="userEmail" name="userEmail" required>
              <br>
                  
              <label for="userPassword">Password :</label>
              <input type="password" id="userPassword" name="userPassword" required>
              <br>
                  
              <button type="submit" class="btn custom-btn submitBtn">Submit</button>
          </form>
      </div>
      
      <!-- Delete User Form -->
      <div id="deleteUserForm" class="form-container">
          <h3>Delete User</h3>
          <form action="delete_user.php" method="POST">
              <label for="deleteUserId">Select User ID to Delete :</label>
              <select id="deleteUserId" name="deleteUserId" required>
                  <option value="">Select</option>
                  <?php
                // Check if user IDs are stored in session
                if (isset($_SESSION['user_ids']) && !empty($_SESSION['user_ids'])) {
                    // Loop through session user IDs and create options dynamically
                    foreach ($_SESSION['user_ids'] as $user_id) {
                        echo "<option value=\"$user_id\">$user_id</option>";
                    }
                }
                ?>
              </select>
              <br>
                  
              <button type="submit"  class="btn custom-btn submitBtn">Submit</button>
          </form>
      </div>

      
      <!-- Update User Form -->
      <div id="updateUserForm" class="form-container">
          <h3>Update User</h3>
          <form action="update_user.php" method="POST">
              <label for="updateUserId">Select User ID to Update :</label>
              <select id="updateUserId" name="updateUserId" required>
              <option value="">Select</option>
              <?php
                // Check if user IDs are stored in session
                if (isset($_SESSION['user_ids']) && !empty($_SESSION['user_ids'])) {
                    // Loop through session user IDs and create options dynamically
                    foreach ($_SESSION['user_ids'] as $user_id) {
                        echo "<option value=\"$user_id\">$user_id</option>";
                    }
                }
                ?>
              </select>
              <br>
              <label for="updateUserEmail">New Email :</label>
              <input type="email" id="updateUserEmail" name="updateUserEmail" required>
              <br>
              <label for="updateUserPassword">Password :</label>
              <input type="password" id="updateUserPassword" name="updateUserPassword" required>
              <br>
              <button type="submit" class="btn custom-btn submitBtn">Submit</button>
          </form>
      </div>


      
      
      <!-- jQuery Script -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
      <script>
          $(document).ready(function() {
              // Initially hide all forms
              $(".form-container").hide();
      
              // When the Add User button is clicked, show the Add User form and hide others
              $("#AddUser").click(function() {
                  $(".form-container").fadeOut(); // Hide all forms
                  $("#addUserForm").fadeToggle();   // Show Add User form
              });
              
              // When the Delete User button is clicked, show the Delete User form and hide others
              $("#DeleteUser").click(function() {
                  $(".form-container").fadeOut();  // Hide all forms
                  $("#deleteUserForm").fadeToggle();   // Show Delete User form
              });
        
      
              // When the Update User button is clicked, show the Update User form and hide others
              $("#UpdateUser").click(function() {
                  $(".form-container").fadeOut();  // Hide all forms
                  $("#updateUserForm").fadeToggle();   // Show Update User form
              });
          });
      </script>
      

  <!-- Bootstrap JS Bundle (includes Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

