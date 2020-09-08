<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  $product_id = $product->pid;
  $product_name = $product->pname;
  $quantity = $product->qty;
  $amount = $product->price; 
  $new_qty = 1; 

  $ct_status = "select * from order_cart";
  $ct_status_res = mysqli_query($conn,$ct_status);

  if(mysqli_num_rows($ct_status_res) === 0){
    $sql = "INSERT INTO order_cart (product_id,product_name,quantity,amount)
    VALUES ('".$product_id."','".$product_name."','".$quantity."','".$amount."')";
    $result = mysqli_query($conn,$sql);
    
    if ($result) {     
        echo ("done"); }
    else {
        echo "failed";
      } 
  }else {
    $ct = "select * from order_cart where product_id = $product_id";
    $ct_res = mysqli_query($conn,$ct);

    if(mysqli_num_rows($ct_res) === 0){
      $sql1 = "INSERT INTO order_cart (product_id,product_name,quantity,amount)
      VALUES ('".$product_id."','".$product_name."','".$quantity."','".$amount."')";
      $result1 = mysqli_query($conn,$sql1);
      
      if ($result1) {     
          echo ("done"); }
      else {
          echo "failed";
        } 
    }else {
      $all_data = mysqli_fetch_assoc($ct_res);
      $qty = $all_data['quantity'];
      $new_qty += $qty;

      $new_ct = "update order_cart set quantity ='$new_qty' where product_id = '$product_id'";
      $new_ct_res = mysqli_query($conn,$new_ct);
      if ($new_ct_res) {     
        echo ("done"); }
      else {
          echo "failed";
        } 
    }
  }

   
?>