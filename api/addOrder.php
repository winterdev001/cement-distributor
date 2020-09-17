<?php
  // require 'db_config.php';
  @session_start();
  $conn=mysqli_connect('localhost','root','','kiku');
  $getorder = file_get_contents('php://input');
  $order = json_decode($getorder);
  $stat = $order->stat;

  $get_email = "select email from customers where username = '$order->customer_name'";
  $get_email_res = mysqli_query($conn,$get_email);
  $email = mysqli_fetch_assoc($get_email_res);
  $user_email = $email['email'];

  // email
    include('Mailin.php');
    use Sendinblue\Mailin;
    $api_key = '2FpIE6gqcKXkxVZy';
    $from_email = 'snowdevin.sd@gmail.com';
    $from_name = 'KIKU';

    $to_email = $user_email;
    $to_name = $order->customer_name ;
    $subject = 'Order Placed Successfully!';

  if($stat == 'firstTime'){
    // new customers
    $cname = $order->cname;
    $country = $order->country;
    $province = $order->province;
    $district = $order->district;
    $sector = $order->sector;
    $cell = $order->cell;
    $village = $order->village;
    $street = $order->street;
    $shipping = $order->shipping;
    $grandtot = $order->grandtot;
    $customer_name = $order->customer_name;
    // $customer_id = $_SESSION['USER_ID'];
    $status = 'unfulfilled';
    $payment = 'CoD';

    $get_id = "select id from customers where username = '$customer_name'";
    $get_id_res = mysqli_query($conn,$get_id);
    $select = mysqli_fetch_array($get_id_res);
    $customer_id = $select['id'];  

    $sql = "INSERT INTO orders (customer_id,status,payment,grand_total)
    VALUES ('".$customer_id."','".$status."','".$payment."','".$grandtot."')";
    $result = mysqli_query($conn,$sql);
    
    if ($result) {
      $sql1 = "SELECT id FROM orders order by id desc LIMIT 1";
      $result1 = mysqli_query($conn,$sql1);
      $data = mysqli_fetch_assoc($result1);
      $orderId= $data['id'];

      $sql2 = "INSERT INTO order_details (order_id,product_id,quantity,amount,shipping,total)
      SELECT $orderId,product_id,quantity,amount,$shipping,((amount*quantity) + (quantity*$shipping))
      FROM order_cart";
      $result2 = mysqli_query($conn,$sql2);
      if($result2) {
        $clear_cart = "DELETE FROM order_cart";
        $clear_cart_res = mysqli_query($conn,$clear_cart);

        $sql3 = "INSERT INTO customer_details (customer_id,company,country,province,district,sector,cell,village,street)
        VALUES ('".$customer_id."','".$cname."', '".$country."', '".$province."','".$district."','".$sector."', '".$cell."', '".$village."', '".$street."') ";
        $result3 = mysqli_query($conn,$sql3);
      }    
      
      if( $result2 && $result3){        
        $message = "<h1><span style='border:5px solid #00c292;margin: 0 auto;padding: 3px;'>KIKU</span></h1>
        <h2>It’s ordered!</h2>
        <p>Hi $customer_name,<br>
        Thanks for your order!. It has been delivered so get ready to welcome it at your place soon.</p>
        <p>
        The following number will be used fulfilling the order with our delivery team<br>,
        Order number :  #000$orderId,<br>
        </p>  
        <p>If there is anything we can do to make your experience better, do not hesitate to drop us a line at kiku@gmail.com. We are here to help you anytime! :)</p>
        <p>Thanks,<br>
        The KIKU team<p>";
        $mailin = new Mailin('https://api.sendinblue.com/v2.0',$api_key);
        $data = array( 
          "to" => array($to_email=>$to_name),
          "from" => array($from_email,$from_name),
          "subject" => $subject,
          "html" => $message,
          "attachment" => array()
        );
        $response = $mailin->send_email($data);
        if(isset($response['code']) && $response['code']=='success'){
          echo 'Email Sent';
        }else{
          echo 'Email not sent';
        }
        exit;

      }else {
        echo "failed";
      }
    }else {
      echo "failed";
    }
  }
  else {
    // not new customers    
    $shipping = $order->shipping;
    $grandtot = $order->grandtot;
    $customer_name = $order->customer_name;
    // $customer_id = $_SESSION['USER_ID'];
    $status = 'unfulfilled';
    $payment = 'CoD';

    $get_id = "select id from customers where username = '$customer_name'";
    $get_id_res = mysqli_query($conn,$get_id);
    $select = mysqli_fetch_array($get_id_res);
    $customer_id = $select['id'];  

    $sql = "INSERT INTO orders (customer_id,status,payment,grand_total)
    VALUES ('".$customer_id."','".$status."','".$payment."','".$grandtot."')";
    $result = mysqli_query($conn,$sql);
    
    if ($result) {
      $sql1 = "SELECT id FROM orders order by id desc LIMIT 1";
      $result1 = mysqli_query($conn,$sql1);
      $data = mysqli_fetch_assoc($result1);
      $orderId= $data['id'];

      $sql2 = "INSERT INTO order_details (order_id,product_id,quantity,amount,shipping,total)
      SELECT $orderId,product_id,quantity,amount,$shipping,((amount*quantity) + (quantity*$shipping))
      FROM order_cart";
      $result2 = mysqli_query($conn,$sql2);
      if($result2) {
        $clear_cart = "DELETE FROM order_cart";
        $clear_cart_res = mysqli_query($conn,$clear_cart);
      }    
      
      if( $result2 ){
        $message = "<h1><span style='border:5px solid #00c292;margin: 0 auto;padding: 3px;'>KIKU</span></h1>
        <h2>It’s ordered!</h2>
        <p>Hi $customer_name,<br>
        Thank you again for your order!. It has been delivered so get ready to welcome it at your place soon.</p>
        <p>
        The following number will be used fulfilling the order with our delivery team<br>,
        Order number :  #000$orderId,<br>
        </p>  
        <p>If there is anything we can do to make your experience better, do not hesitate to drop us a line at kiku@gmail.com. We are here to help you anytime! :)</p>
        <p>Thanks,<br>
        The KIKU team<p>";
        $mailin = new Mailin('https://api.sendinblue.com/v2.0',$api_key);
        $data = array( 
          "to" => array($to_email=>$to_name),
          "from" => array($from_email,$from_name),
          "subject" => $subject,
          "html" => $message,
          "attachment" => array()
        );
        $response = $mailin->send_email($data);
        if(isset($response['code']) && $response['code']=='success'){
          echo 'Email Sent';
        }else{
          echo 'Email not sent';
        }
        exit;
      }else {
        echo "failed";
      }
    }else {
      echo "failed";
    }
  } 

  
?>