<?php
    $con=mysqli_connect('localhost','root','','kiku');
    $r="select * from messages ";
    $q=mysqli_query($con,$r);
    if(mysqli_num_rows($q) != 0){
      header("Content-Type: application/json");  
      while($row=mysqli_fetch_array($q))
      $data[]=$row;
      echo json_encode($data);
    }else {
      echo "no messages found";
    }    
?>