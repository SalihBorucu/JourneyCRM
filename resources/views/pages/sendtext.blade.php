<?php
	include '/composer/autoload_real.php';

	if(isset($_POST['mobile'])  && isset($_POST['msg'])){

		$sid =  getenv('TWILIO_ACCOUNT_SID');
       	$token =  getenv('TWILIO_AUTH_TOKEN');
       	$client = new Twilio\Rest\Client($id, $token);
       	$message = $client->message->create(
       		$_POST['mobile'], array(
       			'from' => getenv('TWILIO_NUMBER'),
       			'body' => $_POST['msg']

       		)
       	);

       	if($message->sid){

       		echo "Message sent!";
       	}
	}

	?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Sending SMS</h1>

	<form action="" method="POST">
		<input type="text" placeholder="mobile" name="mobile">

		<br><br>

		<textarea name="msg" id="" cols="30" rows="10">Message</textarea>
		
		<input type="submit" value="Send">



	</form>
	
</body>
</html>