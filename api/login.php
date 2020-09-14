<?php
$getdata=file_get_contents("php://input");
$data=json_decode($getdata);
$uemail=$data->email;
$pass=$data->password;
$con=mysqli_connect('localhost','root','');
if(!$con)
{
  die('connection failed'.mysql_error());
}
if($uemail==null || $pass==null){
  echo'fill them all first';
}
mysqli_select_db($con,'kiku');
$r="SELECT * FROM customers WHERE email='$uemail' OR username='$uemail' AND password='$pass'";
$q=mysqli_query($con,$r);
$row=mysqli_fetch_array($q);
if($row['email']==$uemail || $row['username']==$uemail){
  if($row['blocked']==1){
    echo "Your account have been blocked,please contact us(0711223344) for more informarion!";
  }
  if($row['password']==$pass){    
    @session_start();
    $_SESSION['username']=$row['username'];
    echo $_SESSION['username'];     
  }
  else{
    echo"Email or password is Incorrect";
  }
}
elseif($row['email']!=$uemail || $row['username']!=$uemail){
  $r1="SELECT * FROM admin WHERE  username='$uemail' AND password='$pass'";
  $q1=mysqli_query($con,$r1);
  $row1=mysqli_fetch_array($q1);
  if($row1['password']==$pass){    
    @session_start();
    $_SESSION['username']=$row1['username'];
    echo $_SESSION['username'];     
  }
  else{
    echo"Email or password is Incorrect";
  }
}
else{
  echo"Email or password is Incorrect";
}
?>