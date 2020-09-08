<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $id = $product->id;  
  $quantity = $product->qty;

  $sql = "update order_cart set quantity = '$quantity' where id = '$id'";
  $result = mysqli_query($conn,$sql);

  if ($result) {    
      echo 'done';       
  }else {
    echo 'failed';
  }

  
?>