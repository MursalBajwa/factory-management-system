
<?php
session_start();


// Check if 'sent' parameter exists in the URL
if (isset($_SESSION['successProduct']) && $_SESSION['successProduct'] === 'true') {
  // Show the success popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Product Added successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['successProduct']);
}

if (isset($_SESSION['errorProduct']) && $_SESSION['errorProduct'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> An error occure . Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['errorProduct']);
}

if (isset($_SESSION['dublicateProduct']) && $_SESSION['dublicateProduct'] === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Trying to insert dublicate Product. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['dublicateProduct']);
}


if (isset($_SESSION['updatedProduct']) && $_SESSION['updatedProduct']  === 'true') {
  // Show the failure popup
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Product Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['updatedProduct']);
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
  width: 33%;
  margin-left: 33%;
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




      <h1 class="title">Product Management</h1>

<!-- Buttons Container -->
<div class="button-container"> 
    <button id="AddProduct" class="btn custom-btn">Add Product</button>
    <button id="SearchProduct" class="btn custom-btn">Search Product</button>
    <button id="UpdateProduct" class="btn custom-btn">Update Product</button>
</div>

<!-- Add Product Form -->
<div id="addProductForm" class="form-container">
    <h3>Add Product</h3>
    <form method="POST" action="add_product.php">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br>

        <label for="productDescription">Description:</label>
        <textarea id="productDescription" name="productDescription" rows="3" required></textarea><br>

        <label for="productPrice">Price:</label>
        <input type="number" id="productPrice" name="productPrice" step="0.01" required><br>

        <label for="productCategory">Category:</label>
        <input type="text" id="productCategory" name="productCategory" required><br>

        <label for="productQuantity">Quantity:</label>
        <input type="number" id="productQuantity" name="productQuantity" required><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>


<!-- Search Product Form -->
<div id="searchProductForm" class="form-container">
    <h3>Search Products by Product ID</h3>
    <form id="searchForm">
        <label for="searchProductId">Product ID:</label>
        <select id="searchProductId" name="searchProductId" required>
            <option value="">Select Product</option>
            <!-- Options will be populated dynamically from the database -->
            <?php
                // Include the database connection
                include('db_connection.php');

                // Fetch all products from the database
                $sql = "SELECT Product_id, Product_name, Product_category FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Product_id'] . "'>" . $row['Product_id'] . " - " . $row['Product_name'] . " - " . $row['Product_category'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No products available</option>";
                }

                // Close the database connection
                $conn->close();
            ?>
        </select><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>


<div id="container_display" class="container" style="display: none;">
    <h2>Stock Details</h2>
    <div id="stockResults"></div> <!-- Results will be inserted here -->
    <button id="closeBtn" class="back-btn">Close</button>
</div>

<!-- Update Product Form -->
<div id="updateProductForm" class="form-container">
    <h3>Update Product</h3>
    <form method="POST" action="update_product.php">
        <label for="updateProductId">Product ID:</label>
        <select id="updateProductId" name="updateProductId" required>
            <option value="">Select Product</option>
            <!-- Options will be populated dynamically from the database -->
            <?php
                // Include the database connection
                include('db_connection.php');

                // Fetch all products from the database
                $sql = "SELECT Product_id, Product_name, Product_category FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Product_id'] . "'>" . $row['Product_id'] . " - " . $row['Product_name'] . " - " . $row['Product_category'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No products available</option>";
                }

                // Close the database connection
                $conn->close();
            ?>
        </select><br>

        <label for="updateProductName">New Name:</label>
        <input type="text" id="updateProductName" name="updateProductName"><br>

        <label for="updateProductDescription">New Description:</label>
        <textarea id="updateProductDescription" name="updateProductDescription" rows="3"></textarea><br>

        <label for="updateProductPrice">New Price:</label>
        <input type="number" id="updateProductPrice" name="updateProductPrice" step="0.01"><br>

        <label for="updateProductCategory">New Category:</label>
        <input type="text" id="updateProductCategory" name="updateProductCategory"><br>

        <label for="updateProductQuantity">Quantity:</label>
        <input type="number" id="updateProductQuantity" name="updateProductQuantity" required><br>

        <button type="submit" class="btn custom-btn submitBtn">Submit</button>
    </form>
</div>



<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initially hide all forms and search results
        $(".form-container").hide();
        $("#searchResults").hide();

        // Toggle Add Product form
        $("#AddProduct").click(function() {
            $(".form-container").fadeOut();
            $("#addProductForm").fadeToggle();
        });

        // Toggle Search Product form
        $("#SearchProduct").click(function() {
            $(".form-container").fadeOut();
            $("#searchProductForm").fadeToggle();
        });

        // Toggle Update Product form
        $("#UpdateProduct").click(function() {
            $(".form-container").fadeOut();
            $("#updateProductForm").fadeToggle();
        });

        $('#searchForm').submit(function(event) {
        event.preventDefault(); // Prevent normal form submission

        var productId = $('#searchProductId').val();

        // Ensure a product is selected
        if (productId) {
            $.ajax({
                type: 'POST',
                url: 'search_product.php',
                data: { searchProductId: productId },
                success: function(response) {
                    // Insert the response into the 'stockResults' div
                    $('#stockResults').html(response);

                    // Show the container for displaying results
                    $('#container_display').show();
                },
                error: function() {
                    $('#stockResults').html("Error: Unable to fetch product data.");
                }
            });
        } else {
            alert("Please select a product ID.");
        }
    });

          // Close button functionality
          $('#closeBtn').click(function() {
              $('#container_display').hide();
          });
    });
</script>
<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

