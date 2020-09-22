<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  $customer_name = $user->customer_name;  

  $get_email = "select email from customers where username = '$customer_name'";
  $get_email_res = mysqli_query($conn,$get_email);
  $select = mysqli_fetch_array($get_email_res);
  $selectedEmail = $select['email'];  
  
  if($get_email_res){
    $sql = "select * from messages where sender_email = '$selectedEmail'";
    $result = mysqli_query($conn,$sql);  

    if(mysqli_num_rows($result) != 0){
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