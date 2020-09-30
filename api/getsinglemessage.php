<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getmessage = file_get_contents('php://input');
  $message = json_decode($getmessage);

  $id = $message->mid;  
  
  $sql = "select * from messages where id = '$id'";
  $result = mysqli_query($conn,$sql);  

  if(mysqli_num_rows($result) > 0){
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($result))
    $data[]=$row;
    echo json_encode($data); 
  }else {
    echo 'failed';
  }  
  
?>