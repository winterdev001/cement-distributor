<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $product_name = $product->product_name;
  $quantity = $product->product_qty;
  $amount = $product->product_price;
  $category_id = $product->product_cat;
  $fineness = $product->fineness;
  $strength = $product->strength;
  $color = $product->color;
  $weight = $product->weight;
  $application = $product->usage;
  $packaging = $product->packaging;
  $manufacturer = $product->manufacturer;

  $sql = "INSERT INTO products (product_name,quantity,amount,manufacturer,category_id)
   VALUES ('".$product_name."','".$quantity."','".$amount."','".$manufacturer."','".$category_id."')";
  $result = mysqli_query($conn,$sql);
  
  if ($result) {
    $sql1 = "SELECT id FROM products order by id desc LIMIT 1";
    $result1 = mysqli_query($conn,$sql1);
    $data = mysqli_fetch_assoc($result1);
    $fetchedId= $data['id'];

    $sql2 = "INSERT INTO product_specifications (product_id,compressive_strength,color,weight,fineness,application,packaging_type)
    VALUES ('".$fetchedId."','".$strength."','".$color."','".$weight."','".$fineness."','".$application."','".$packaging."')";
    $result2 = mysqli_query($conn,$sql2);
    if( $result2){
      echo ("done");
    }else {
      echo "failed";
    }
  }

  
?>