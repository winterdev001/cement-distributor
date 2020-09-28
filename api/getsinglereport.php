<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getinfo = file_get_contents('php://input');
  $info = json_decode($getinfo);

  if($info->for == 'Products'){

    $get_info = "select * from products";
    $get_info_res = mysqli_query($conn,$get_info);    
    
      if(mysqli_num_rows($get_info_res)!=0){
        if($get_info_res){
        header("Content-Type: application/json");  
        while($row=mysqli_fetch_array($get_info_res))
        $data[]=$row;
        echo json_encode($data); }
      }else{
        echo "no data";
      }
  }elseif($info->for == 'Customers') {
    $get_info = "select * from customers";
    $get_info_res = mysqli_query($conn,$get_info);    
    
      if(mysqli_num_rows($get_info_res)!=0){
        if($get_info_res){
        header("Content-Type: application/json");  
        while($row=mysqli_fetch_array($get_info_res))
        $data[]=$row;
        echo json_encode($data); }
      }else{
        echo "no data";
      }
  }elseif($info->for == 'Orders') {
    if($info->status  == 'all'){
      $get_info = "select o.id,o.grand_total,o.status,o.payment,o.created_at,od.amount,od.quantity,od.total,od.shipping, p.product_name,c.email from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id join customers as c on c.id = o.customer_id ";
      $get_info_res = mysqli_query($conn,$get_info); 
    }else{
      $status = $info->status;
      $get_info = "select o.id,o.grand_total,o.status,o.payment,o.created_at,od.amount,od.quantity,od.total,od.shipping, p.product_name,c.email from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id join customers as c on c.id = o.customer_id where o.status = '$status' ";
      $get_info_res = mysqli_query($conn,$get_info); 
    }       
    
      if(mysqli_num_rows($get_info_res)!=0){
        if($get_info_res){
        header("Content-Type: application/json");  
        while($row=mysqli_fetch_array($get_info_res))
        $data[]=$row;
        echo json_encode($data); }
      }else{
        echo "no data";
      }
  }elseif ($info->for == 'interval_order') {
    $start = $info->start_date;
    $end = $info->end_date;
    if($info->status == 'all'){
      $get_info = "SELECT o.id,o.grand_total,o.status,o.payment,o.created_at,od.amount,od.quantity,od.total,od.shipping, p.product_name,c.email from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id join customers as c on c.id = o.customer_id WHERE o.created_at BETWEEN '$start' AND  '$end'";
      $get_info_res = mysqli_query($conn,$get_info);
    }else {
      $status = $info->status;
      $get_info = "SELECT o.id,o.grand_total,o.status,o.payment,o.created_at,od.amount,od.quantity,od.total,od.shipping, p.product_name,c.email from orders as o join order_details as od on od.order_id = o.id join products as p on p.id = od.product_id join customers as c on c.id = o.customer_id WHERE o.status = '$status' AND o.created_at BETWEEN '$start' AND  '$end'";
      $get_info_res = mysqli_query($conn,$get_info);
    }        
    
      if(mysqli_num_rows($get_info_res)!=0){
        if($get_info_res){
        header("Content-Type: application/json");  
        while($row=mysqli_fetch_array($get_info_res))
        $data[]=$row;
        echo json_encode($data); }
      }else{
        echo "no data";
      }
  }
  
  
?>