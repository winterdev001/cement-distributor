<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);

  $oid = $order->order_id;  

  $sql = "update orders set status = 'cancelled'  WHERE id = $oid";
  $result = mysqli_query($conn,$sql);  
  
  if ($result ) {    
    echo 'done';
  }else {
    echo 'failed to cancel this order';
  }

  
?>