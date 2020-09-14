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
  
  if($selectedID){
    $sql = "select * from customer_details where customer_id = '$selectedID'";
    $result = mysqli_query($conn,$sql);  

    if(mysqli_num_rows($result) > 0){
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($result))
      $data[]=$row;
      echo json_encode($data); 
    }else {
      echo 'empty';
    }
  }else{
    echo 'failed';
  }  
  
?>