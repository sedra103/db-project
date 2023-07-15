<?php
//Database conn
$conn = new mysqli('localhost','root','','food ordering system');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>