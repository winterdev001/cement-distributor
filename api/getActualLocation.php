<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getData = file_get_contents('php://input');
  $address = json_decode($getData);

  $name = $address->name;
  // $prov = '';
  // $dist = '';  
  
  if($name == 'district'){
    $prov = $address->prov;
    $sql = "SELECT district from locations where province = '$prov' group by district";
    $result = mysqli_query($conn,$sql);    
  }elseif ($name == 'sector') {
    $prov = $address->prov;
    $dist = $address->dist;
    $sql = "SELECT sector from locations where province = '$prov' and district ='$dist' group by sector";
    $result = mysqli_query($conn,$sql);
  }elseif ($name == 'cell'){
    $prov = $address->prov;
    $dist = $address->dist;
    $sect = $address->sect;
    $sql = "SELECT cell from locations where province = '$prov' and district ='$dist' and sector ='$sect' group by cell";
    $result = mysqli_query($conn,$sql);
  }else {
    $prov = $address->prov;
    $dist = $address->dist;
    $sect = $address->sect;
    $cell = $address->cell;
    $sql = "SELECT name from locations where province = '$prov' and district ='$dist' and sector ='$sect' and cell = '$cell'  group by name";
    $result = mysqli_query($conn,$sql);
  }  
  
  if ($result) {    
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($result))
    $data[]=$row;
    echo json_encode($data);
  }
  
?>

