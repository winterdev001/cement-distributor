<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $order_id = 1;
  $shipping = 2000;
  
  $q = "INSERT INTO test (order_id,product_id,quantity,amount,shipping,total)
  SELECT $order_id,product_id,quantity,amount,$shipping,((amount*quantity) + (quantity*$shipping))
  FROM order_cart";
  $r = mysqli_query($conn,$q);

  if($r){
    echo "done";
  }else {
    echo "fail";
  }
?>