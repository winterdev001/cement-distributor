<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getproduct = file_get_contents('php://input');
  $product = json_decode($getproduct);

  // $pid = $product->id;  
  if($product->cat_id == 0){
    if($product->sort_by == 'new_first'){
        $order = 'DESC';
        $column = 'created_at';
      }elseif ($product->sort_by == 'high_first') {
        $order = 'DESC';
        $column = 'amount';
      }elseif ($product->sort_by == 'ztoa') {
        $order = 'DESC';
        $column = 'product_name';
      }elseif ($product->sort_by == 'old_first') {
        $order = 'ASC';
        $column = 'created_at';
      }elseif ($product->sort_by == 'low_first') {
        $order = 'ASC';
        $column = 'amount';
      }else {
        $order = 'ASC';
        $column = 'product_name';
      }
    $sql = "select * from products order by $column $order";
    $result = mysqli_query($conn,$sql);  
  } else {
    if($product->sort_by == 'new_first'){
        $order = 'DESC';
        $column = 'created_at';
      }elseif ($product->sort_by == 'high_first') {
        $order = 'DESC';
        $column = 'amount';
      }elseif ($product->sort_by == 'ztoa') {
        $order = 'DESC';
        $column = 'product_name';
      }elseif ($product->sort_by == 'old_first') {
        $order = 'ASC';
        $column = 'created_at';
      }elseif ($product->sort_by == 'low_first') {
        $order = 'ASC';
        $column = 'amount';
      }else {
        $order = 'ASC';
        $column = 'product_name';
      }
    $id = $product->cat_id;
    $sql = "select * from products where category_id = '$id' order by $column $order";
    $result = mysqli_query($conn,$sql);  
  }

  
  if ($result ) {    
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($result))
    $data[]=$row;
    echo json_encode($data);    
  }
  
?>