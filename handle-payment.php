<?php
  include 'dbconn.php';
  include 'Razorpay/Razorpay.php';

  $event_name = $_POST['evt_name'];
  $event_name = str_replace("'", "''", $event_name);

  use Razorpay\Api\Api;

  $api = new Api('rzp_test_R8DYN4gfYSznyT', 'SBWRydgN44floyWgbMpt8uZQ');
  $payment_id = $_POST['payment_id'];
  $payment = $api->payment->fetch($payment_id);

  $notes = $payment['notes'];
  $name = $notes['name'];
  $college = $notes['college'];
  $email = $notes['email'];
  $phone = $notes['phone'];

  $sql_query = "SELECT * from event WHERE Title = '$event_name'";
  $result = mysqli_query($conn, $sql_query);
  if (mysqli_num_rows($result) > 0)
  {
  	$row = mysqli_fetch_assoc($result);

  	$event_fee = intval($row['RegFees']);
  	$pay_amount = $event_fee * 100; // Amount for razorpay is specified in paise.
  	$response = $payment->capture(array('amount' => $pay_amount));

  	if ($response['captured'])
  	{
  		$stmt = $conn->prepare('INSERT INTO registration (id, email, name, college, phone, txn_id, fee) VALUES (?, ?, ?, ?, ?, ?, ?)');
		$stmt->bind_param('isssssi', $row['ID'], $email, $name, $college, $phone, $payment_id, $event_fee);
		$stmt->execute();

		$num_reg = intval($row['Num_Reg']) + 1;
		$e_id = intval($row['ID']);

		$update_query = "UPDATE event SET Num_Reg = $num_reg WHERE ID = $e_id";
		$update_result = mysqli_query($conn, $update_query);

  		echo 	"<div class='modal-content'>";

  		echo 		"<h3>Your payment was successful!</h3>
  						<b style='font-size: 20px'>Details</b>
  						<p>";

  		echo 				"<b>Name: </b>";
  		echo 				$name;
  		echo 				"<br/>";

  		echo 				"<b>Email: </b>";
  		echo 				$email;
  		echo 				"<br/>";

  		echo 				"<b>College: </b>";
  		echo 				$college;
  		echo 				"<br/>";

  		echo 				"<b>Phone: </b>";
  		echo 				$phone;
  		echo 				"<br/>";


  		echo			"</p>";

  		echo 	"</div>";

  		echo 	"<div class='modal-footer'>
            		<div class='center-align'>
              			<a href='#!'' class='modal-action modal-close waves-effect waves-green'>Close</a>
	            	</div>
	          	</div>";
  	}
  }
?>