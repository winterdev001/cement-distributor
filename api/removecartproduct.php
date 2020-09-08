<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $id = $product->id;  

  $sql = "DELETE FROM order_cart WHERE id = $id";
  $result = mysqli_query($conn,$sql);

  if ($result) {  
    $q = "select * from order_cart";
    $q_res = mysqli_query($conn,$q);
    if(mysqli_num_rows($q_res) === 0){
      echo "no data left";
    } else {
      echo 'done';
    }     
  }else {
    echo 'failed to delete this product from cart';
  }

  
?>