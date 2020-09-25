<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);

  $order_id = $order->order_id; 
  
    $get_details = "select o.id,od.quantity, p.product_name,p.quantity as stock,p.id as pid from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id  where od.order_id = $order_id  ";

    $get_details_res = mysqli_query($conn,$get_details);
    
    if($get_details_res){
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($get_details_res))
      $data[]=$row;
      echo json_encode($data); 
    }    
    else{
      echo 'failed';
    }  
  
?>