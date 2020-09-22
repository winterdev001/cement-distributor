<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  $customer_name = $user->customer_name;  

  $get_id = "select id from customers where username = '$customer_name'";
  $get_id_res = mysqli_query($conn,$get_id);
  $select = mysqli_fetch_array($get_id_res);
  $selectedID = $select['id'];  
  // echo $selectedID;
  
  if($selectedID){    
    $get_details = "select o.id,o.grand_total,o.status,od.amount,od.quantity,od.total, p.product_name,cd.province from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id join customer_details as cd on cd.customer_id = $selectedID where o.customer_id = $selectedID ";

    $get_details_res = mysqli_query($conn,$get_details);
    
    if(mysqli_num_rows($get_details_res) > 0){
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($get_details_res))
      $data[]=$row;
      echo json_encode($data); 
    }
  else {
      echo 'No orders Yet';
    }
  }
  else{
    echo 'failed';
  }  
  
?>