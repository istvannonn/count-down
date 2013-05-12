<?php
require_once('edit.php');

function process_contact_form(){

	// Define message variable wich collect all the messages
	$msg = "";

	// Check if is submitted
	if(isset($_POST['send'])) {
		
		// Verify each filled was completed
		if(empty($_POST['name']) || ($_POST['name'])=="name") {
			$msg .= '<p class="error">Fill out with your real name.</p>';
		}
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", ($_POST['email']))) {
			$msg .= '<p class="error">Your e-mail address seems to be wrong. Try with your real e-mail address.</p>';
		}
		if(empty($_POST['message']) || empty($_POST['message']) == "message") {
			$msg .= '<p class="error">Leave us a nice message, please.</p>';
		}
		
		// Check if $msg variable is empty, then prepare e-mail and send
		if(empty($msg)) {
			// collect filled value
			$name = $_POST['name']; // required
			$subject = "One Page Contact Form"; // required
			$email = $_POST['email']; // required
			$formmessage = $_POST['message']; // required
			
			// add your e-mail address or multiple recipients
			$to  = EMAIL;
			
			// message
			$message = '
			<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			  <p>Numele: <strong>'.$name.'</strong></p>
			  <p>E-mail: <strong>'.$email.'</strong></p>
			  <p>Mesaj: <strong>'.$formmessage.'</strong></p>
			</body>
			</html>
			';
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'To: '.$to.'' . "\r\n";
			$headers .= 'From: '.$email.'' . "\r\n";
			
			// Mail it and get a success message
			mail($to, $subject, $message, $headers);
			$msg .= '<p class="success">We catched your message. Thank you.</p>';

		}
	}
	// Display errors messages
	if( $msg != NULL ) echo $msg;
}

function add_subscriber(){

	// Define message variable wich collect all the messages
	$msg = "";

	// Check if is submitted
	if(isset($_POST['submit'])) {
		
		isset($_POST['newsletter']) ? $email = $_POST['newsletter'] : $email = "";
		echo $email;
		if(isset($_POST['js'])) $js = $_POST['js'];
		
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
			$msg = '<p class="error">Your e-mail address seems to be wrong. Try again.</p>';
			if(isset($js)) $msg = 'Your e-mail address seems to be wrong. Try again.';
		}
		
		// Check if $msg variable is empty, then prepare e-mail and send
		if(empty($msg)) {
			$data = $email . ';' . date("D, d M Y") . " at " . date("H:i:s") . "\n";

			if($fp = fopen("subscribers.csv","r")) { // Open the CSV file for reading
				$check = 0;
				while (($row = fgetcsv($fp, 0, ";")) !== FALSE) {
					if ($row[0] == $email) {
						$msg = '<p class="success">We already have your e-mail address.</p>';
						if(isset($js)) $msg = 'We already have your e-mail address.';
						$check = 1;
						fclose($fp); // Close the file
						break;
					}
				}
				if($check == 0){
					$fp = fopen("subscribers.csv","a"); // Open the CSV file and go to the end of the list
					fwrite($fp,$data); // Write information to the file
					fclose($fp); // Close the file
					$msg = '<p class="success">We catched your e-mail address. Thank you.</p>';
					if(isset($js)) $msg = 'We catched your e-mail address. Thank you.';
				}
			}
		}
	}
	// Display errors messages
	if( $msg != NULL ) {
		echo $msg;
	}
	if(isset($js)) add_subscriber();
}
?>