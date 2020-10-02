<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getdata = file_get_contents('php://input');
  $admin = json_decode($getdata);

  $id = $admin->id;
  $username = $admin->username;  
  $password = $admin->password;
  $image = $admin->image;

  $sql = "update admin set username = '$username' ,password = '$password' ,image = '$image' where id = '$id'";
  $result = mysqli_query($conn,$sql);

  if ($result) {    
      echo 'done';       
  }else {
    echo 'failed';
  }

  
?>