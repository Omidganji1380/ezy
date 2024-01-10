<?php

$admin_email = "example@site.com";
$from_name   = "Website Name"; 



$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['note'];
	
// create email body and send it	

$email_subject = "درخواست تماس جدید توسط:  $name";
$email_body = "شما یک پیغام جدید دریافت کرده اید.<br/>".
			  "جزئیات درخواست: <br/><br/> نام: $name <br/><br> ".
		      "ایمیل: $email_address <br/><br/> متن پیام: <br/> $message";

$headers	= "Content-type: text/html; charset=utf-8\r\n";
$headers    .= "From:$from_name <$email_address>";
	
if($email_address != "") {
	mail($to,$email_subject,$email_body,$headers);
	return true;
}

?>