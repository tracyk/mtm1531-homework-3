<?php

$possible_radio = array(
	'English'
	,'French'
	,'Spanish'
);

$name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING); 
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$radio = filter_input(INPUT_POST, 'radio', FILTER_SANITIZE_STRING);
$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
$checkbox = filter_input(INPUT_POST, 'checkbox', FILTER_SANITIZE_STRING);



if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Checks to see if the form has been submitted before validating
	if (empty($name)) {
		$errors['name']=true;
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  //FILTER_VALIDATE_EMAIL checks to see if the email is valid
		$errors['email']=true;
	}
	
	if(mb_strlen($text) < 25) { 
		$errors['text']=true;
	}
	
	if (!in_array($password, $password_subjects)) { //hard to show an error, but still important to validate it
		$errors['subject']=true;
    }
	
	if (!in_array($radio, $radio_subjects)) { 
		$errors['radio']=true;
    }
	
	if(mb_strlen($notes) < 25) { 
		$errors['notes']=true;
	}
	
	if (!isset($checkbox)) { 
		$errors['checkbox']=true;
    }	
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registration Form</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>

	<div class="signin">
		<p> Already have an account? Sign In </p>
	</div>	
	
	<h2> Sign up </h2>

<form method="post" action="index.php">
    	<div>
        	<label for="name">Name <?php if (isset($errors['name'])) : ?> <strong>is required</strong><?php endif; ?></label>
            <input id="name" name="name" value="<?php echo $name; ?>">            
        </div>
		
        <div>
        	<label for="email">E-mail Address <?php if (isset($errors['email'])) : ?> <strong>is required</strong><?php endif; ?></label>
            <input id="email" name="email" value="<?php echo $email; ?>">
        </div>
		
		<div>
        	<label for="text">Username <?php if (isset($errors['text'])) : ?> <?php endif; ?></label>
            <input id="text" name="text" value="<?php echo $text; ?>">
        </div>
		
		<div>
        	<label for="password">Password <?php if (isset($errors['password'])) : ?> <strong>is required</strong><?php endif; ?></label>
            <input id="password" name="password" value="<?php echo $password; ?>">
        </div>
		
		 <div>
        	<label for="radio">Preferred Language</label>
            <select id="radio" name="radio">
            <?php foreach ($possible_radio as $current_radio) : ?>	
                <option <?php if ($current_radio == $radio) { echo 'selected'; }?>><?php echo $current_radio; ?></option> 
            <?php endforeach; ?>    

            </select>
        </div>
		
		<div>
        	<label for="notes">Notes <?php if (isset($errors['notes'])) : ?> <?php endif; ?></label>
            <input id="notes" name="notes" value="<?php echo $notes; ?>">
        </div>
		
		<div>
        	<label for="checkbox">Terms and Conditions <?php if (isset($errors['checkbox'])) : ?> <strong> Please accept the Terms and Conditions</strong><?php endif; ?></label>
            <input type="checkbox" name="checkbox" value="<?php echo $checkbox; ?>">
        </div>
		
		<div>
        	<button type="submit">Submit Form</button>
        </div>
		
		<?php
		if (!$errors['email'] && isset($checkbox) && isset($name)) {
			$to = $email;
			$subject = "Hi!";
			$body = "Hi,\n\nHow are you?";
			if (mail($to, $subject, $body)) {
				echo("<p>Message successfully sent!</p>");
				echo("<p>Thank you for using this form!</p>");
			} else {
				echo("<div class='sendemail'>Message delivery failed...</div>");
			}
		}
		?>











</body>
</html>