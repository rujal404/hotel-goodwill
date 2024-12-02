<?php
require_once("class.phpmailer.php");
require_once("class.smtp.php");

$usermail = "info@hotelgoodwill.com";
// $usermail = "sahas@longtail.info";
$sitename = "BHOJ GHAR";
$ccusermail = "sahas@longtail.info";

//for contact page
if($_POST['action']=="forContact"):

	foreach($_POST as $key=>$val){$$key=$val;}

	$body = '
	<html>
	<head>Email</head>
	<body>
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p>
		</td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Enquiry message</span><br />
		  The details provided are:</p>
		  <p><strong>Fullname</strong> : '.$name.'<br />		
		  <strong>Subject</strong>: '.$subject.'<br />
		  <strong>E-mail Address</strong>: '.$email.'<br />

		  <strong>Message</strong>: '.$message.'<br />
		  </p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		'.$name.'
		</p></td>
	  </tr>
	</table>
	</body>
	</html>
	';
	
	/*
	* mail info
	*/

	$mail = new PHPMailer(); // defaults to using php "mail()"
	
	$mail->SetFrom($email, $name);
	$mail->AddReplyTo($email,$name);
	
	$mail->AddAddress($usermail, $sitename);
	// if add extra email address on back end
	if(!empty($ccusermail)){
		$rec = explode(';', $ccusermail);
		if($rec){
			foreach($rec as $row){
				$mail->AddCC($row,$sitename);
			}		
		}
	}
	
// 	$mail->IsSMTP();
//     $mail->SMTPAuth     = true;
//     $mail->SMTPSecure   = "ssl";
//     $mail->Host         = "mail.mayurstay.com";
//     $mail->Port         = "465";
//     $mail->Username     = 'smtp@mayurstay.com';
//     $mail->Password     = 'UdE*5B^YxzHb';
//     $mail->SMTPDebug    = 2;
	
	$mail->Subject    = 'Enquiry mail from '.$name;
	
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
		echo json_encode(array("action"=>"unsuccess","message"=>"We could not sent your message at the time. Please try again later."));
	}else{
		echo json_encode(array("action"=>"success","message"=>"Your message has been successfully sent."));
	}
endif;




?>