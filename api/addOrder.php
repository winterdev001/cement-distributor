<?php
  // require 'db_config.php';
  session_start();
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);

  $cname = $order->company;
  $country = $order->country;
  $province = $order->province;
  $district = $order->district;
  $sector = $order->sector;
  $cell = $order->cell;
  $village = $order->village;
  $street = $order->street;
  $shipping = $order->shipping;
  $grandtot = $order->grandtot;
  $customer_id = $_SESSION['USER_ID'];
  $status = 'unfulfilled';
  $payment = 'CoD';
 

  $sql = "INSERT INTO orders (customer_id,status,payment,grand_total)
   VALUES ('".$customer_id."','".$status."','".$payment."','".$grandtot."')";
  $result = mysqli_query($conn,$sql);
  
  if ($result) {
    $sql1 = "SELECT id FROM orders order by id desc LIMIT 1";
    $result1 = mysqli_query($conn,$sql1);
    $data = mysqli_fetch_assoc($result1);
    $orderId= $data['id'];

    $sql2 = "INSERT INTO order_details (order_id,product_id,quantity,amount,shipping,total)
    SELECT $orderId,product_id,quantity,amount,$shipping,((amount*quantity) + (quantity*$shipping))
    FROM order_cart";
    $result2 = mysqli_query($conn,$sql2);
    if($result2) {
      $clear_cart = "DELETE FROM order_cart";
      $clear_cart_res = mysqli_query($conn,$clear_cart);

      $sql3 = "INSERT INTO customer_details (customer_id,company,country,province,district,sector,cell,village,street) VALUES ('".$customer_id."','".$cname."', '".$country."', '".$province."',
      '".$sector."', '".$cell."', '".$village."', '".$street."' ";
       $result3 = mysqli_query($conn,$sql3);
    }    
    
    if( $result2 && $result3){
      echo ("done");
    }else {
      echo "failed";
    }
  }else {
    echo "failed";
  }

  
?>