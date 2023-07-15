<?php 
include 'message.php';
include 'myfunctions.php';
include 'config.php';
// Check if the 'id' parameter is set in the URL
  $id = $_GET['id'];
  
  // Action when clicking the "Add Menu" button
  if (isset($_POST['add_menu'])) {
      // Perform the desired action here
      echo "Add Menu button clicked for ID: " . $id;
      
  // Redirect to addMenu.php with the ID parameter
  header('Location: addMenu.php?id=' . $id);
  }

  // Check if the form is submitted and the 'id_to_delete' parameter is set
if (isset($_POST['delete']) && isset($_POST['id_to_delete'])) {
  // Get the 'id_to_delete' value
  $id_to_delete = $_POST['id_to_delete'];
  $deleteid = mysqli_real_escape_string($conn,$id_to_delete);
  $q = 'DELETE FROM `food_item` WHERE `id` = '. $deleteid.'';
  $del = mysqli_query($conn,$q);
  if($del){  
    header('Location: admin.php?id=' . $id);
    exit();}
  }

   //Get Update id and status  
 if (isset($_GET['Order_id']) && isset($_GET['status']) && isset($_GET['id'])) {  
  $Orderid = $_GET['Order_id'];
  $id=$_GET['id'];  
  $status=$_GET['status'];  
  mysqli_query($conn,"update cart set status='$status' where id='$Orderid'");  
  header('location:admin.php?id=' . $id);  
  die();  
}  

?>

<!DOCTYPE html>
<html>
  <?php include 'header.php';?>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,viewport-fit=cover">
  <title>Food Delivery Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    /* CSS styling for the dashboard */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    
    .table {
      width: 100%;
      border-collapse: collapse;
    }
    
    .table th, .table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    .table th {
      background-color: #f5f5f5;
    }
    
    .table tr:hover {
      background-color: #f5f5f5;
    }
    .navbar{
      background-color:#e3f2fd;
    }
    .nav-link{
      color:black;
    }
  </style>
<body>
  <div class="container">    
  
<nav class="navbar">
  <div class="container-fluid">
    
  <form method="POST">
        <input type="submit" name="add_menu" value="Add Menu" class="btn btn-secondary btn-lg">
    </form>
    </div>
   
</nav>

<br>
<section id="orders">
    <h2>Orders</h2>
    <table class="table">
      <thead class="table-light">
        <tr>
          <th>Order ID</th>
          <th>Order Detail</th>
          <th>Order Date</th>
          <th>Order Total</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Assuming you have already established a database connection

        // Retrieve the orders from the cart table
        $query = "SELECT * FROM cart";
        $result = mysqli_query($conn, $query);

        // Loop through the rows and generate table rows dynamically
        while ($row = mysqli_fetch_assoc($result)) {
            $orderId = $row['id'];
            $orderDetail = $row['title'];
            $orderDate = $row['created_at'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $orderTotal = $price * $quantity;

            echo "<tr>";
            echo "<td>$orderId</td>";
            echo "<td>$orderDetail</td>";
            echo "<td>$orderDate</td>";
            echo "<td>$orderTotal TL</td>";
            echo "<td>$quantity</td>";
            echo "<td>";
            if ($row['status'] == 1) {  
                echo "Pending";} 
            elseif ($row['status'] == 2) {  
              echo "Accept";  
            } elseif ($row['status'] == 3) {  
              echo "out to Delivery";  
            }elseif ($row['status'] == 4) {  
              echo "Delivered";  
            }elseif ($row['status'] == 5) {  
              echo "Reject";  
            }
          echo "</td>";
            
          echo "<td>
          <select onchange=\"status_update(this.options[this.selectedIndex].value, " . $row['id'] . ", " . $id . ")\">
              <option value=\"\">Update Status</option>
              <option value=\"1\">Pending</option>
              <option value=\"2\">Accept</option>
              <option value=\"3\">out to Delivery</option>
              <option value=\"4\">Delivered</option>
              <option value=\"5\">Reject</option>
          </select>
        </td>";
        echo "</tr>";
  
        }

        // Free the result set
        mysqli_free_result($result);

        ?>
      </tbody>
    </table>
</section>

  <section id="customers">
  <table class="table">
  <h2>Customers</h2>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Date</th>
            <th>Order Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Assuming you have already established a database connection

        // Retrieve the orders from the cart table
        $query = "SELECT cart.id, cart.userid, cart.created_at, cart.price, cart.quantity, cart.status, registration.Firstname, registration.Lastname
                  FROM cart
                  INNER JOIN registration ON cart.userid = registration.id";
        $result = mysqli_query($conn, $query);

        // Loop through the rows and generate table rows dynamically
        while ($row = mysqli_fetch_assoc($result)) {
            $orderId = $row['id'];
            $customerName = $row['Firstname'] . ' ' . $row['Lastname'];
            $orderDate = $row['created_at'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $orderTotal = $price * $quantity;
            $status = $row['status'];

            echo "<tr>";
            echo "<td>$orderId</td>";
            echo "<td>$customerName</td>";
            echo "<td>$orderDate</td>";
            echo "<td>$orderTotal TL</td>";
            echo "<td>";
            if ($row['status'] == 1) {  
                echo "Pending";} 
            elseif ($row['status'] == 2) {  
              echo "Accept";  
            } elseif ($row['status'] == 3) {  
              echo "out to Delivery";  
            }elseif ($row['status'] == 4) {  
              echo "Delivered";  
            }elseif ($row['status'] == 5) {  
              echo "Reject";  
            }
            echo "</tr>";
        }

        // Free the result set
        mysqli_free_result($result);

        ?>
    </tbody>
</table>

  </section>

  <section id="menus">
    <h2>Menus</h2>
    <table class="table table-striped border-primary">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $fooditem = getAll('food_item');
            // Check if there are any menus
            if (mysqli_num_rows($fooditem) > 0){
                  foreach($fooditem as $item){
                    ?>
                    <tr>
                      <td> <?= $item['title'];?></td>
                      <td> <?= 
                      $t = $item['category_id'];
                      if ($t == "0") {
                        echo "Keto";
                      } elseif ($t == "1") {
                        echo "Gluten-free";
                      } 
                      elseif ($t == "2") {
                        echo "Sugar-free";
                      }elseif ($t == "3") {
                        echo "Vegan";
                      }else {
                        echo "Low-carb";
                      }?></td>
                      <td> <?= $item['price'];?> TL </td>
                      <td> 
                        <img src="pic_forApp/menus/<?= $item['image_name'];?>"  width=50px height=50px alt="<?= $item['title'];?>">
                      </td>
                      <td>
                          <form action="" method="POST">
                            <input type="hidden" name="id_to_delete" value="<?php echo $item['id'];?>">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                          </form>
                      </td>
                    <tr>
                      
                <?php  
              }
             }
           ?>

        </tbody>
    </table>
</section>


  <section id="reports">
    <h2>Reports</h2>
    <!-- Add your report-related content here -->
  </section>

  <footer>
    <p>&copy; 2023 Food Delivery Admin Dashboard. All rights reserved.</p>
  </footer>
    
  </div>
  <script type="text/javascript">
    function status_update(value, id, userId) {
        let url = "http://localhost/Lab1/admin.php";
        window.location.href = url + "?Order_id=" + id + "&status=" + value + "&id=" + userId;
    }
</script>  

</body>
</html>
