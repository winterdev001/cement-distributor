<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $getuser = file_get_contents('php://input');
  $user = json_decode($getuser);

    $customer_name = $user->customer_name;  
    $country = $user->country;
    $province = $user->province;
    $district = $user->district;
    $sector = $user->sector;
    $cell = $user->cell;
    $village = $user->village;
    $street = $user->street;
    $fname = $user->fname; 
    $lname = $user->lname; 
    $uname = $user->uname; 
    $phone = $user->phone; 
    $email = $user->email; 
    $company_name = $user->company_name; 

  $get_id = "select id from customers where username = '$customer_name'";
  $get_id_res = mysqli_query($conn,$get_id);
  $select = mysqli_fetch_array($get_id_res);
  $selectedID = $select['id'];  
  
  if($selectedID){
    $sql = "update customers set Fname = '$fname',Sname = '$lname',phone = '$phone', email = '$email', username= '$uname' where id = '$selectedID'";
    $result = mysqli_query($conn,$sql);  

    $sql1 = "update customer_details set company = '$company_name',country = '$country',province = '$province', district = '$district', sector= '$sector' , cell = '$cell', village = '$village', street = '$street' where customer_id = '$selectedID'";
    $result1 = mysqli_query($conn,$sql1);  

    if($result && $result1){
      echo $customer_name;
    }else {
      echo 'failed';
    }
  }else{
    echo 'failed';
  }  
  
?>