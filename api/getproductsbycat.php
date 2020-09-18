<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $id = $product->cat_id;  

  $sql = "select * from products where category_id = $id";
  $result = mysqli_query($conn,$sql);  

  if(mysqli_num_rows($result) > 0){
    if ($result ) {    
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($result))
      $data[]=$row;
      echo json_encode($data);    
    }
  } else{    
    
  }
  
?>