<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  $customer_id = $user->customer_id;  

  $sql = "DELETE FROM customers WHERE id = $customer_id";
  $result = mysqli_query($conn,$sql);

  $sql = "DELETE FROM customer_details WHERE customer_id = $customer_id";
  $result2 = mysqli_query($conn,$sql);
  
  if ($result && $result2) {    
    echo 'done';
  }else {
    echo 'failed to delete user';
  }

  
?>