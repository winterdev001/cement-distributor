<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $pid = $product->product_id;  

  $sql = "DELETE FROM products WHERE id = $pid";
  $result = mysqli_query($conn,$sql);

  $sql = "DELETE FROM product_specifications WHERE product_id = $pid";
  $result2 = mysqli_query($conn,$sql);
  
  if ($result && $result2) {    
    echo 'done';
  }else {
    echo 'failed to delete this product';
  }

  
?>