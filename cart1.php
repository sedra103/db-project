<?php
session_start();
include 'config.php';

// Check if the 'cart' key exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Initialize an empty array for the cart
}

// Check if the 'add_to_cart' form has been submitted
if (isset($_POST['add_to_cart'])) {
    // Retrieve the quantity value from the form
    $product_quantity = $_POST['quantity'];

    // Assuming you have retrieved the product details from your database or other source
    $product_id = $_GET['item_id'];
    $product_title = $_POST['title'];
    $product_price = $_POST['price'];

    // Add the product to the cart with the quantity
    $_SESSION['cart'][] = array(
        'id' => $product_id,
        'title' => $product_title,
        'price' => $product_price,
        'quantity' => $product_quantity
    );

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cart</title>
</head>
<style>
</style>
<body>
    <br />
    <div class="container table-responsive">
    <div class="d-flex justify-content-end">
    
    <h3 align="center">Shopping Cart</h3><br />
</div>
<?php 

if (!empty($_SESSION['cart'])) {
    $total = 0;

    echo "<table class='table table-bordered table-striped'>";

    echo "<tr>";
    echo "<th>Product ID</th>";
    echo "<th>Product Title</th>";
    echo "<th>Price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Total Price</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    foreach ($_SESSION['cart'] as $key => $product) {
        echo "<tr>";
        echo "<td>" . (isset($product['id']) ? $product['id'] : '') . "</td>";
        echo "<td>" . (isset($product['title']) ? $product['title'] : '') . "</td>";
        echo "<td>" . (isset($product['price']) ? $product['price'] : '') . "</td>";
        echo "<td>" . (isset($product['quantity']) ? $product['quantity'] : '') . "</td>";
        
        if (isset($product['id']) && isset($product['quantity'])) {
            $productTotal = $product['price'] * $product['quantity'];
            echo "<td>" . number_format($productTotal, 2) . "</td>";
        } else {
            echo "<td></td>";
        }
        
        echo "<td><a href='cart1.php?action=remove&user_id=" .$_GET['user_id'] . "&item_id=" .$_GET['item_id'] . "'>Remove</a></td>";
        echo "</tr>";

        if (isset($product['quantity']) && isset($product['price'])) {
            $total += $product['quantity'] * $product['price'];
        }
    }

    echo "<tr>";
    echo "<td colspan='3'></td>";
    echo "<td><b>Total Price</b></td>";
    echo "<td>" . number_format($total, 2) . "</td>";
    echo "<td> <a href='cart1.php?action=clear&user_id=" .$_GET['user_id'] . "&item_id=" .$_GET['item_id'] . "' class='btn btn-warning'>Clear All</a>
    </td>";
    echo "</tr>";

    echo "</table>";
    echo "</div>";
} else {
    echo "Your cart is empty.";
}

if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    // Clear the entire cart by unsetting the 'cart' key in the session
    unset($_SESSION['cart']);

}


if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['item_id'])) {
    $removeProductId = $_GET['item_id'];
    
    // Loop through the cart and remove one quantity of the item with the matching product ID
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['id'] === $removeProductId) {
            // If the product quantity is greater than 1, decrement the quantity by 1
            if ($product['quantity'] > 1) {
                $_SESSION['cart'][$key]['quantity'] -= 1;
            } else {
                // If the product quantity is 1, remove the item from the cart
                unset($_SESSION['cart'][$key]);
            }
            header("Location:cart1.php?user_id=". $_GET['user_id'] . "&item_id=" . $_GET['item_id']);
            break; // Stop looping once the item is found and updated/removed
        }
    }
}
    
?>
<a href="checkout.php?user_id=<?php echo $_GET['user_id'];?>" class="btn btn-primary">Proceed to Checkout</a>
<?php include'footer.php';?>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>