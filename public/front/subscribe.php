<?php

$admin_email = "example@site.com";
$from_name   = "Website Name"; 



if(isset($_POST['subscriberemail'])) {
    
	$subscriber_email = strip_tags($_POST['subscriberemail']);
	$to  	   	= $admin_email; 
	$subject 	= "Email Suscriber Information";
	$message	= "Email Address: $subscriber_email";

	$headers	= "Content-type: text/html; charset=utf-8\r\n";
	$headers	.= "From:$from_name <$admin_email>";

	echo $subscriber_email;
    if (mail($to, $subject, $message, $headers)) {
        echo "1";
    } else {
        echo "0";
    }
}


?>