<?php
session_start();
include 'config.php';

$userId = $_GET['user_id'] ; // Assuming the user ID is stored in the 'user_id' session variable
if (!isset($_SESSION['cart_inserted'])) {
    $cart = $_SESSION['cart'] ; //the cart details are stored in the 'cart' session variable

$query = "INSERT INTO cart (userid, productId, title, price, quantity) VALUES (?, ?, ?, ?,?)";
$stmt = $conn->prepare($query);

// Loop through the cart items and insert each item into the database
foreach ($cart as $item) {
    $productId = $item['id'] ;
    $productName = $item['title']   ;
    $price = $item['price']    ;
    $quantity = $item['quantity'] ;

    // Bind the values to the prepared statement parameters
    $stmt->bind_param("iisid", $userId, $productId, $productName, $price, $quantity);

    // Execute the statement
    $stmt->execute();

    // Check if the insertion was successful for each item
    if ($stmt->affected_rows === 0) {
        // Failed to insert cart item into the database
        // Handle the error appropriately
    }
}

// Set a flag indicating that the cart data has been inserted into the database
$_SESSION['cart_inserted'] = true;
}

$userId = $_GET['user_id'];
// Calculate the timestamp for a few minutes ago
$minutesAgo = 3; // Adjust the number of minutes as needed
$timestampAgo = date('Y-m-d H:i:s', strtotime("-{$minutesAgo} minutes"));

// Prepare the SQL query to retrieve the last order details within a few minutes
$query = "SELECT * FROM cart WHERE userid = ? AND created_at >= ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $userId, $timestampAgo);
$stmt->execute();

// Fetch the result
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Display the thank you message and order details
    echo "<h2>Thank you for your order!</h2>";
    echo "<p>Order Details:</p>";

    // Loop through the rows and display each order detail
    while ($row = $result->fetch_assoc()) {
        echo "<p>Product: " . $row['title'] . "</p>";
        echo "<p>Quantity: " . $row['price'] . "</p>";
        echo "<p>Price: " . $row['quantity'] . "</p>";
        echo "<hr>";
        $totalPrice = 0;
        // Calculate the subtotal for each item and add it to the total price
        $subtotal = $row['quantity'] * $row['price'];
        $totalPrice += $subtotal;
    }
    // Display the total price
    echo "<p>Total Price: " . $totalPrice . "</p>";

    // Retrieve the address information from the 'registration' table
    $addressQuery = "SELECT address FROM registration WHERE id = ?";
    $addressStmt = $conn->prepare($addressQuery);
    $addressStmt->bind_param("i", $userId);
    $addressStmt->execute();
    $addressResult = $addressStmt->get_result();

    // Check if the address was found
    if ($addressResult->num_rows > 0) {
        // Fetch the address
        $addressRow = $addressResult->fetch_assoc();
        $address = $addressRow['address'];

        // Display the shipping details with the retrieved address
        echo "<h4>Shipping Details: </h4>";
        echo "<p>takes 20-60 minutes to your address: <p>";
        echo "<p>" . $address . "<p>";
    } else {
        // No address found for the user
        echo "<p>No address found for the user.</p>";
    }
// Close the address statement and result
$addressStmt->close();
$addressResult->close();
} else {
    // No order details found for the user
    echo "<p>No order details found for the user.</p>";
}
// Close the statement and database connection
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Checkout Page</title>
</head>
<body>
    <div class="row">
      <div class="col-sm-12">
        <a href="index1.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : $_GET['user_id']; ?>" class="btn btn-primary">Back to Home Page</a>
      </div>
    </div>
</body>
</html>

