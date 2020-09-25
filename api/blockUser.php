<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  if($user->action == 'block'){
    $customer_id = $user->customer_id;  

    $sql = "UPDATE customers SET blocked = 1 WHERE id = $customer_id";
    $result = mysqli_query($conn,$sql);
    
    if ($result) {    
      echo 'done';
    }else {
      echo 'failed ';
    }
  }else{
    $customer_id = $user->customer_id;  

    $sql = "UPDATE customers SET blocked = 0 WHERE id = $customer_id";
    $result = mysqli_query($conn,$sql);
    
    if ($result) {    
      echo 'done';
    }else {
      echo 'failed ';
    }
  }  

  
?>