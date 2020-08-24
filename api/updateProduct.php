<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $product_id = $product->product_id;
  $product_name = $product->edit_product_name;
  $quantity = $product->edit_product_qty;
  $amount = $product->edit_product_price;
  $category_id = $product->edit_product_cat;
  $fineness = $product->edit_fineness;
  $strength = $product->edit_strength;
  $color = $product->edit_product_color;
  $weight = $product->edit_weight;
  $application = $product->edit_product_usage;
  $packaging = $product->edit_product_pkging;
  $manufacturer = $product->edit_manufacturer;

  $sql = "UPDATE  products SET product_name = '$product_name',quantity = '$quantity',amount= '$amount',manufacturer = '$manufacturer',category_id='$category_id'
   WHERE id = '$product_id'";
  $result = mysqli_query($conn,$sql);
  
  if ($result) {   

    $sql2 = "UPDATE  product_specifications SET compressive_strength = '$strength',color='$color',weight='$weight',fineness='$fineness',application='$application',packaging_type='$packaging'
    WHERE product_id = '$product_id'";
    $result2 = mysqli_query($conn,$sql2);
    if( $result2){
      echo ("done");
    }else {
      echo "failed";
    }
  }

  
?>