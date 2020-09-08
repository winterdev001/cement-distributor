<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');  

  $sql = "DELETE  FROM order_cart ";
  $result = mysqli_query($conn,$sql);

  if ($result) {    
      echo 'done';        
  }else {
    echo 'failed to delete all product from cart';
  }

  
?>