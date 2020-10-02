<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  $name = $user->username;  

  $get_admin = "select * from admin where username = '$name'";
  $get_admin_res = mysqli_query($conn,$get_admin); 
  

  if($get_admin_res){
    if(mysqli_num_rows($get_admin_res) != 0){
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($get_admin_res))
    $data[]=$row;
    echo json_encode($data); 
  }else {
    echo 'empty';
  }
}else {
    echo "failed";
  }
  
  
?>