<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);

  $all_ids = $order->idz;
  $new_stock = $order->new_stock;  
  $order_id = $order->order_id;  

  // echo count($new_stock);
  for ($i=0; $i <count($all_ids) ; $i++) { 
    $sql = "UPDATE products SET quantity = $new_stock[$i] where id = $all_ids[$i]";
    $sql_res = mysqli_query($conn,$sql);
  }
  if($sql_res){
    $change_status = "UPDATE orders SET status = 'fulfilled' where id = $order_id";
    $change_status_res = mysqli_query($conn,$change_status);

    if($change_status_res){
      $new_stock = "select  p.product_name,p.quantity as stock from products as p   join order_details as od on p.id = od.product_id join orders as o on od.order_id = o.id   where od.order_id = $order_id ";
      $new_stock_res = mysqli_query($conn,$new_stock);
      if($new_stock_res){
        header("Content-Type: application/json");  
        while($row=mysqli_fetch_array($new_stock_res))
        $data[]=$row;
        echo json_encode($data); 
      }else{
      echo 'failed';}
    }else{
    echo 'failed';
    }
  }else {
    echo 'failed';
  } 

  
?>
