<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getmessage = file_get_contents('php://input');
  $message = json_decode($getmessage);

  $id = $message->mid;  
  
  $sql = "update messages set status = 1 where id = '$id'";
  $result = mysqli_query($conn,$sql);  

  if($result){
    echo "done";
  }else {
    echo 'failed';
  }  
  
?>