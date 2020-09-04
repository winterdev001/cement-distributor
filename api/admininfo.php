<?php
  @session_start();
  $user_id=$_SESSION['USER_ID'];
  $conn=mysqli_connect('localhost','root','','kiku');
  if(!$conn)
  {
    die('connection failed'.mysql_error());
  }
  $r="SELECT * FROM admin where id='$user_id'";
  $q=mysqli_query($conn,$r);
  header("Content-Type: application/json");
  while($row=mysqli_fetch_array($q))
    $data[]=$row;
    echo json_encode($data);
?>