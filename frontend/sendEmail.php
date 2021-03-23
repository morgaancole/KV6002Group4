<?php
/*
*Action file which takes user input from contact form and communicates with backend
*@author - Morgan Wheatman
*/
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();

	if(isset($_POST['btn_contact'])){
		$errors = array();
		
		//Takes information from the contact form for it to be used by script
		$name = filter_has_var(INPUT_POST, 'name') ? $_POST['name']: null;
		$email = filter_has_var(INPUT_POST, 'email') ? $_POST['email']: null;	
		$phone = filter_has_var(INPUT_POST, 'phone') ? $_POST['phone']: null;	
		$subject = filter_has_var(INPUT_POST, 'subject') ? $_POST['subject']: null;		
		$message = filter_has_var(INPUT_POST, 'message') ? $_POST['message']: null;
		$consent = filter_has_var(INPUT_POST, 'consent') ? $_POST['consent']: null;

		//Trimming inputs from user
		$name = trim($name);
		$email = trim($email);
		$phone = trim($phone);
		$subject = trim($subject);
		$message = trim($message);
		$consent = trim($consent);

		if (!empty($name)  && !empty($email)  && !empty($phone) && !empty($subject) && !empty($message) && !empty($consent)) {
			//If user consents to their data being stored, calling function to store it
			//Sends messages regardless
			if($consent === "yes"){
				echo storeMessage($name, $email, $phone, $message);
			}
		}else{
			$errors[] = "Something was left empty";
			header("Location: contactForm.php");
		}

		//Creating variables to use in sending emails
		$send = "Hi " . $name . "\nThanks for your message!\n\nHenderson Contractors will be in touch as soon as possible!\n";
		$send .= "\nHere's what you sent:\n";
		$send .= "\n" . $message;

		$headers = "From: morgan.wheatman@northumbria.ac.uk";
		$sender = "From: " . $email;

		$name= trim($name);
		$email = trim($email);	
		
		//Sending to developer
		mail("morgan.wheatman@northumbria.ac.uk",$subject ,$message, $sender);

		//Sending to user	
		mail($email, $subject ,$send, $headers);
	
	}else{
		header("Location: contactForm.php");
	}
?>

<body>
<h3 class="title">Contact Us</h3>
  <div class="container">  
		<?php
			//Displaying message to user after their email has been sent
			echo "<h2 class='title'>Thanks for your message " . $name . "</h2>";
			echo "<h3>Send <a href='contactForm.php'>Another?</a></h3>";
		?>
  </div>
      
</body>

<?php
echo makeFooter();
echo endMain();
echo makePageEnd();
?>