<?php
  // require 'db_config.php';
  $conn=mysqli_connect('localhost','root','','kiku');
  $order_id = 1;
  // $shipping = 2000;
  
  // $q = "INSERT INTO test (order_id,product_id,quantity,amount,shipping,total)
  // SELECT $order_id,product_id,quantity,amount,$shipping,((amount*quantity) + (quantity*$shipping))
  // FROM order_cart";
  // $r = mysqli_query($conn,$q);

  // if($r){
  //   echo "done";
  // }else {
  //   echo "fail";
  // }

  $new_stock = "select  p.product_name,p.quantity as stock from products as p   join order_details as od on p.id = od.product_id join orders as o on od.order_id = o.id   where od.order_id = $order_id  ";
  $new_stock_res = mysqli_query($conn,$new_stock);
  if($new_stock_res){
    header("Content-Type: application/json");  
    while($row=mysqli_fetch_array($new_stock_res))
    $data[]=$row;
    echo json_encode($data); 
  }

  // email confirmation
  // include('Mailin.php');
  // use Sendinblue\Mailin;
  // $customer_name = 'Snow';
  // $orderId = 3;
  // $api_key = '2FpIE6gqcKXkxVZy';
  // $from_email = 'bahatipatrick05@gmail.com';
  // $from_name = 'TEST';

  // $to_email = 'snowdevin.sd@gmail.com';
  // $to_name = $customer_name;
  // $subject = 'Order Placed Successfully!';
  // $message = '
  //       <h1><span style="border:5px solid #00c292;margin: 0 auto;padding: 3px;">KIKU</span></h1>
  //       <h2>It’s ordered!</h2>
  //       <p>Hi "'.$customer_name.'",<br>
  //       Thanks for your order!. It has been delivered so get ready to welcome it at your place soon.</p>
  //       <p>
  //       The following number will be used fulfilling the order with our delivery team<br>,
  //       Order number :  #000"'.$orderId.'",<br>
  //       </p>  
  //       <p>If there is anything we can do to make your experience better, do not hesitate to drop us a line at kiku@gmail.com. We are here to help you anytime! :)</p>
  //       <p>Thanks,<br>
  //       The KIKU team<p>';
  // $mailin = new Mailin('https://api.sendinblue.com/v2.0',$api_key);
  // $data = array( 
  //   "to" => array($to_email=>$to_name),
  //   "from" => array($from_email,$from_name),
  //   "subject" => $subject,
  //   "html" => $message,
  //   "attachment" => array()
  // );
  // $response = $mailin->send_email($data);
  // if(isset($response['code']) && $response['code']=='success'){
  //   echo 'Email Sent';
  // }else{
  //   echo 'Email not sent';
  // }
  // exit;



  
?>


