<?php
    $con=mysqli_connect('localhost','root','','kiku');
    $r="select * from products ";
    $q=mysqli_query($con,$r);
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($q))
    $data[]=$row;
    echo json_encode($data);
?>