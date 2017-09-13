<?php
	$status = array(
		'type'=>'success',
		'message'=>'Cảm ơn vì sự đóng góp ý kiến của bạn.Chúng tôi sẽ hồi âm cho bạn sớm nhất.'
	);

    $name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'cuongit95@gmail.com';

    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

    $success = mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    echo json_encode($status);
?>