<?php
error_reporting(0);
$getdata=file_get_contents("php://input");
$data=json_decode($getdata);
$uname=$data->Uname;
$fname=$data->Fname;
$sname=$data->Sname;
$uemail=$data->email;
$cntct=$data->phone;
// $type=$data->type;
$password=$data->password;
$conn=mysqli_connect('localhost','root','','kiku');
if(!$conn)
{
  die('connection failed'.mysql_error());
}
$r="SELECT email,username FROM customers WHERE email='$uemail' OR username='$uname'";
$q=mysqli_query($conn,$r);
$row=mysqli_fetch_array($q);
if($row['username']==$uname)
{
	echo 'The user_name is taken';
}
elseif($row['email']==$uemail){
  echo'The email provided is already in use';
}
elseif($uname==null || $fname==null || $sname==null || $uemail==null || $cntct==null || $password==null){
  echo'Fill them all First';
}
else{
  $ins="INSERT INTO `customers`(`username`,`Fname`,`Sname`,`phone`,`email`,`password`) VALUES ('$uname','$fname','$sname','$cntct','$uemail','$password')";
  $ibq=mysqli_query($conn,$ins);  
  if($ibq){
    $r="SELECT id FROM customers WHERE email='$uemail' OR username='$uemail' AND password='$password'";
    $q=mysqli_query($conn,$r);
    $row=mysqli_fetch_array($q);
    // $i="UPDATE customers SET count=count+1 WHERE email='$uemail'";
    // $dbq=mysqli_query($conn,$i);
    if($q){
      @session_start();
      $_SESSION['USER_ID']=$row['id'];
      $id=$_SESSION['USER_ID'];
      echo 'registered';
    }
  }
  else{
    echo'not registered'.mysqli_error($conn);
  }
}
?>