<?php
session_start();
include 'config.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <!-- Add the link to Bootstrap CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php 
    // Retrieve the user ID from the URL parameter
$userId = isset($_GET['id']) ? $_GET['id'] : $_GET['user_id'];

// Retrieve the user's orders from the cart table
$query = "SELECT cart.id, registration.address, cart.created_at, 
          cart.price, cart.quantity, cart.status
          FROM cart
          INNER JOIN registration ON cart.userid = registration.id
          WHERE cart.userid = $userId";
$result = mysqli_query($conn, $query);
echo "<h4 class=\"text-center\">MY ORDERS</h4>";
// Check if the user has any orders
if (mysqli_num_rows($result) > 0) {
    echo "<table class=\"table table-striped\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Order ID</th>";
    echo "<th>Order Address</th>";
    echo "<th>Order Date</th>";
    echo "<th>Order Total</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through the user's orders and generate table rows dynamically
    while ($row = mysqli_fetch_assoc($result)) {
        $orderId = $row['id'];
        $customeraddress = $row['address'];
        $orderDate = $row['created_at'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $orderTotal = $price * $quantity;
        $status = $row['status'];

        echo "<tr>";
        echo "<td>$orderId</td>";
        echo "<td>$customeraddress</td>";
        echo "<td>$orderDate</td>";
        echo "<td>$orderTotal</td>";
        echo "<td>";
        if ($row['status'] == 1) {
            echo "Pending";}
        elseif ($row['status'] == 2) {
            echo "Accept";
        } elseif ($row['status'] == 3) {
            echo "Out to Delivery";
        } elseif ($row['status'] == 4) {
            echo "Delivered";
        } elseif ($row['status'] == 5) {
            echo "Reject";
        }
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    
    
} else {
    echo "No orders found for this user.";
}

// Free the result set
mysqli_free_result($result);
include 'footer.php';
    ?>
</body>
</html>