<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getmessage = file_get_contents('php://input');
  $message = json_decode($getmessage);

  $uname = $message->uname;  
  $email = $message->email;
  $content = $message->message;
  $stat = 0;

  $get_info = "INSERT INTO messages(content,username,sender_email,status) VALUES('".$content."','".$uname."','".$email."','".$stat."')";
  $get_info_res = mysqli_query($conn,$get_info);
  
  if($get_info_res){
    echo "done";
  }else {
    echo "Failed to send message";
  }
  
  
?>