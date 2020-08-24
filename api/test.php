<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  // $getproduct = file_get_contents('php://input');
  // $product = json_decode($getproduct);

  // $product_name = $product->product_name;
  // $quantity = $product->product_qty;
  // $amount = $product->product_price;
  // $category_id = $product->product_cat;
  // $manufacturer = "Cimerwa";
  // $specification_id = 2;

  // $sql = "INSERT INTO products (product_name,quantity,amount,specification_id,manufacturer,category_id)
  //  VALUES ('".$product_name."','".$quantity."','".$amount."','".$specification_id."','".$manufacturer."','".$category_id."')";
  // $result = mysqli_query($conn,$sql);

  $sql1 = "SELECT id FROM products order by id desc LIMIT 1";
  $result1 = mysqli_query($conn,$sql1);
  $data = mysqli_fetch_assoc($result1);
  echo $data['id'];
  
?>