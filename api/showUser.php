<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

  $uid = 1;  

  $sql = "SELECT c.id,c.username,c.Fname,c.Sname,c.email,c.phone,c.blocked,c.created_at,
  cd.company,cd.province,cd.district,cd.sector,cd.cell,cd.village,cd.street 
  FROM customers AS c JOIN customer_details AS cd on c.id = cd.customer_id 
  WHERE cd.customer_id = $uid";
  $result = mysqli_query($conn,$sql);
  
  if ($result) {  
    if(mysqli_num_rows($result) != 0){  
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($result))
      $data[]=$row;
      echo json_encode($data);
    }else{
      echo 'no details yet';
    }
  }else {
    echo 'failed';
  }
  
?>