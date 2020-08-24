<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $pid = $product->id;  

  $sql = "SELECT * FROM product_specifications WHERE product_id = $pid";
  $result = mysqli_query($conn,$sql);
  
  if ($result) {    
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($result))
    $data[]=$row;
    echo json_encode($data);
  }
  
?>