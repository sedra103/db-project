<?php include 'config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    
  .footer {
    background-color: #333;
    color: #28666e;
    padding: 20px;
    text-align: center;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
  }

  .footer-nav {
    display: flex;
    justify-content: space-around;
    align-items: center;
  }

  .footer-nav a {
    color: #fff;
    text-decoration: none;
  }
</style>
<body>
<footer class="footer">
    <nav class="footer-nav">
      <a href="index1.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : $_GET['user_id']; ?>">Home</a>
      <a href="MyOrders.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : $_GET['user_id']; ?>">My Orders</a>
      <a href="profilePage.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : $_GET['user_id']; ?>">Profile</a>
    </nav>
  </footer>
</body>
</html>