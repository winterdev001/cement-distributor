<?php
    $con=mysqli_connect('localhost','root','','kiku');
    $r="select * from order_cart ";
    $q=mysqli_query($con,$r);
    header("Content-Type: application/json");  
    if(mysqli_num_rows($q) === 0){
      echo "No data";
    }else {
      while($row=mysqli_fetch_array($q))
      $data[]=$row;
      echo json_encode($data);
    }
    
?>