<?php
	$input = array();
	$errors = array();
	
	//Takes information from the contact form for it to be used by script
	$name = filter_has_var(INPUT_POST, 'name') ? $_POST['name']: null;
	$email = filter_has_var(INPUT_POST, 'email') ? $_POST['email']: null;	
	$subject = filter_has_var(INPUT_POST, 'subject') ? $_POST['subject']: null;		
	$message = filter_has_var(INPUT_POST, 'message') ? $_POST['message']: null;

	//Creating variables to use in sending emails
	$send = "Hi " . $name . "\nThanks for your message!\nHenderson Contractors will be in touch as soon as possible!";
	$headers = "From: morgan.wheatman@northumbria.ac.uk";
	$sender = "From: " . $email;

	$name= trim($name);
	$email = trim($email);	
	
	//Using inbuilt PHP function to send emails to the user & the NE Dons email
	mail("morgan.wheatman@northumbria.ac.uk",$subject ,$message, $sender);	
	mail($email, $subject ,$send, $headers);
	
?>
<html>
<body>
<div>
	<div>
		<?php
			//Displaying message to user after their email has been sent
			echo "<html><h1>Thanks for your message " . $name . "</h1></html>";
			echo "<html><h3>Send <a href='contactForm.php'>Another</a><html></h3>";
		?>
	</div>
	</div>
</body>
</html>