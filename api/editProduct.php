<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $pid = $product->id;  

  $sql = "select p.id ,p.product_name,p.amount,p.quantity,p.manufacturer,
    p.category_id,ps.compressive_strength, ps.color, ps.weight, ps.fineness,
    ps.application, ps.packaging_type from products as p
    join product_specifications as ps on p.id = ps.product_id where p.id = $pid";
    $result = mysqli_query($conn,$sql);  

  
  if ($result ) {    
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($result))
    $data[]=$row;
    echo json_encode($data);    
  }

  
?>