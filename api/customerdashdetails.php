<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  $customer_name = $user->customer_name;  

  $get_info = "select * from customers where username = '$customer_name'";
  $get_info_res = mysqli_query($conn,$get_info);
  // $select = mysqli_fetch_array($get_id_res);
  // $selectedID = $select['id'];  
  
    if($get_info_res){
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($get_info_res))
    $data[]=$row;
    echo json_encode($data); }
  
  
?>