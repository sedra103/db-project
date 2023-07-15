<?php 
include 'myfunctions.php';
include 'config.php';
$sql = "SELECT * FROM food_item";
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
            flex: 1;
      padding-bottom: 5px;
        }

        li {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
        }

        img {
            max-width: 100px;
            margin-right: 10px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 5px;
        }

        p {
            margin: 0;
            margin-bottom: 5px;
        }

        .product-info {
            flex-grow: 1;
        }

        .add-to-cart-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .add-to-cart-btn i {
            margin-right: 5px;
        }

        .add-to-cart-btn:hover {
            background-color: #45a049;
        }

.d-flex {
  display: flex;
  align-items: center;
}

    </style>
</head>
<body>
    <h1>Product List</h1>
<?php
$id = $_GET['restaurant_id'];
$query = "SELECT * FROM food_item WHERE rst_id = '$id'";
$run_query = mysqli_query($conn,$query);
            // Check if there are any menus
            if (mysqli_num_rows($run_query) > 0){
                  foreach($run_query as $item){
                    ?>
    <ul>
        <li>
        <form action="cart1.php?user_id=<?php echo $_GET['user_id'];?>&item_id=<?php echo $item['id']; ?>" method="post">

            <img src="pic_forApp/menus/<?= $item['image_name'];?>" alt="<?= $item['title'];?>">
            <div class="product-info">
                <h2>Menu: <?= $item['title'];?> </h2>
                <p> Product Category: <?php $t = $item['category_id'];
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
                      }?></p>
                <p>Price: <?= $item['price'];?> TL</p>
                <br>
            <input type="hidden" name="title" value="<?= $item['title'] ?>">
            <input type="hidden" name="category" value="<?= $item['category_id'] ?>">
            <input type="hidden" name="price" value="<?= $item['price'] ?>">
            <input type="number" name="quantity" value="1" class="form-control">
            <br>
            <div class="input-container">
            <button class="add-to-cart-btn" name="add_to_cart" value="<?= $item['id']; ?>">
              <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
        </form>

                
            </div>

            
            
        </li>
        
    </ul>
        <?php  
              }
             }
           ?>
        
    <?php include 'footer.php';?>


   
</body>
</html>


