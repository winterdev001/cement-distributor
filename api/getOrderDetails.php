<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);

  $order_id = $order->order_id;  

  // $get_id = "select id from customers where username = '$customer_name'";
  // $get_id_res = mysqli_query($conn,$get_id);
  // $select = mysqli_fetch_array($get_id_res);
  // $selectedID = $select['id'];  
  // echo $selectedID;
  
  if($order_id){    
    $get_details = "select o.id,o.grand_total,o.status,od.amount,od.quantity,od.total,od.shipping, p.product_name,c.email,c.fname,c.sname,c.username from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id join customers as c on c.id = o.customer_id where od.order_id = $order_id  ";

    $get_details_res = mysqli_query($conn,$get_details);
    
    if(mysqli_num_rows($get_details_res) > 0){
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($get_details_res))
      $data[]=$row;
      echo json_encode($data); 
    }
  else {
      echo 'No details';
    }
  }
  else{
    echo 'failed';
  }  
  
?>