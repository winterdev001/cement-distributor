<?php
    $con=mysqli_connect('localhost','root','','kiku');
    $r="select p.product_name,sum(od.total) as total from products as p join order_details as od on od.product_id = p.id group by p.product_name order by total desc limit 5";
    $q=mysqli_query($con,$r);
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($q))
    $data[]=$row;
    echo json_encode($data);
?>