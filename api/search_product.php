<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $gerdata = file_get_contents('php://input');
  $search = json_decode($gerdata);

  $query = $search->query;  

  $sql = "select * from products where product_name like '%".$query."%' limit 5";
  $result = mysqli_query($conn,$sql); 
  if(mysqli_num_rows($result) == 0){
    $sql1 = "select id from categories where category_name like '%".$query."%' limit 1";
    $result1 = mysqli_query($conn,$sql1);
    $all_res = mysqli_fetch_assoc($result1);
    $cat_id = $all_res['id'];
    
    $filtered_product = "select * from products where category_id = '$cat_id' limit 10";
    $filtered_product_res = mysqli_query($conn,$filtered_product); 

    if($filtered_product_res){
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($filtered_product_res))
      $data[]=$row;
      echo json_encode($data); 
    }
  } else {
    if ($result ) {    
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($result))
      $data[]=$row;
      echo json_encode($data);    
    }
  }
  
  
?>