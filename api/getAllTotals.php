<?php
    $con=mysqli_connect('localhost','root','','kiku');
    $r="SELECT sum(amount*quantity) as total_price, sum(quantity) as total_qty from order_cart ";
    $q=mysqli_query($con,$r);
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($q))
        $data[]=$row;
        echo json_encode($data);
?>