<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);

  $oid = $order->order_id;  

  $sql = "DELETE FROM orders WHERE id = $oid";
  $result = mysqli_query($conn,$sql);

  $sql = "DELETE FROM order_details WHERE order_id = $oid";
  $result2 = mysqli_query($conn,$sql);
  
  if ($result && $result2) {    
    echo 'done';
  }else {
    echo 'failed to delete this order';
  }

  
?>