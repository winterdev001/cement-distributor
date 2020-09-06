<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');  

  $sql1 = "SELECT sum(amount*quantity) as total from order_cart";
  $result1 = mysqli_query($conn,$sql1);
  $data = mysqli_fetch_assoc($result1);
  echo $data['total'];
  
?>