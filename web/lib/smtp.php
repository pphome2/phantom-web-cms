<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #



	global	$SMTP_HOST,
			$SMTP_PORT,
			$SMTP_USER,
			$SMTP_PASSWORD,
			$SMTP_FROM,
			$SMTP_BCC,
			$SMTP_SUBJECT,
			$SMTP_MESSAGE,
			$SMTP_HEADERS;


    function smtp_mail($to,$mess){
	global	$SMTP_HOST,
			$SMTP_PORT,
			$SMTP_USER,
			$SMTP_PASSWORD,
			$SMTP_FROM,
			$SMTP_BCC,
			$SMTP_SECURE,
			$SMTP_SUBJECT,
			$SMTP_MESSAGE,
			$SMTP_HEADERS,
			$PORTAL_NAME;

	$res=FALSE;
	$mail = new KM_Mailer($SMTP_HOST,$SMTP_PORT,$SMTP_USER,$SMTP_PASSWORD,$SMTP_SECURE);
	if ($mail->isLogin) {
	    #$mail->send('username@mydomain.com', 'recipent@somedomain.com', 'test email 1', 'This is a <b>multipart email</b>!');
	    /* more emails can be sent on the same connection: */
	    #$mail->send('UserName <username@mydomain.com>', 'Recipient <recipent@somedomain.com>', 'test email 2', 'This is a <b>multipart email</b>!');
	    /* add more recipients */
	    #$mail->addRecipient('New Recipient <newrecipient@somedomain.com>');
	    /* add CC recipient */
	    #$mail->addCC('CC Recipient <ccrecipient@somedomain.com>');
	    /* add BCC recipient */
	    #$mail->addBCC('CC Recipient <bccrecipient@somedomain.com>');
	    /* add attachment */
	    #$mail->addAttachment('pathToFileToAttach');
	    /* send multipart email with different plain text part */
	    #$mail->altBody = "This is an alternate body for multiipart emails.";
	    #$mail->send('UserName <username@mydomain.com>', 'Recipient <recipent@somedomain.com>', 'test email 3', 'This is a multipart email with a <b>different plain text part</b>!');
	    /* send just a plain text email and test if it was sent successfully */
	    #$mail->contentType = "text/plain";
	    if (!$mail->send($SMTP_FROM,$to,$SMTP_SUBJECT,$mess)) {
		$res=FALSE;
	    } else {
		$res=TRUE;
	    }
	    /* clear recipients and attachments */
	    $mail->clearRecipients();
	    $mail->clearCC();
	    $mail->clearBCC();
	    $mail->clearAttachments();
	} else {
	    $res=FALSE;
	}
	return($res);
    }



	function smtp_server_wait($socket,$code){
		$serverstring="";
		socket_set_timeout($socket,2);
		$i=0;
		while ((substr($serverstring,0,3)!=$code)and($i<=1)){
				$serverstring=@fgets($socket,256);
			if ($serverstring<>""){
				# for debug ...
				#echo("$serverstring<br />");
			}
			$i++;
		}
	}



	function smtp_mail_sendto($to,$mess){
		global	$SMTP_HOST,
				$SMTP_PORT,
				$SMTP_USER,
				$SMTP_PASSWORD,
				$SMTP_FROM,
				$SMTP_TO,
				$SMTP_SUBJECT,
				$SMTP_MESSAGE,
				$SMTP_HEADERS,
				$SMTP_SECURE;

		smtp_mail_send_2($SMTP_USER,$SMTP_PASSWORD,$SMTP_HOST,$SMTP_PORT,$SMTP_FROM,$to,$SMTP_SUBJECT,$mess,$SMTP_HEADERS,$SMTP_SECURE);
	}



	function smtp_mail_system_message($mess){
		global	$SMTP_HOST,
				$SMTP_PORT,
				$SMTP_USER,
				$SMTP_PASSWORD,
				$SMTP_FROM,
				$SMTP_TO,
				$SMTP_SUBJECT,
				$SMTP_MESSAGE,
				$PORTAL_NAME,
				$SMTP_HEADERS,
				$SMTP_SECURE,
				$PORTAL_ADMIN_MAIL;

		smtp_mail_send_2($SMTP_USER,$SMTP_PASSWORD,$SMTP_HOST,$SMTP_PORT,$SMTP_FROM,$PORTAL_ADMIN_MAIL,$PORTAL_NAME,$mess,$SMTP_HEADERS,$SMTP_SECURE);
	}



	function smtp_mail_send(){
		global	$SMTP_HOST,
				$SMTP_PORT,
				$SMTP_USER,
				$SMTP_PASSWORD,
				$SMTP_FROM,
				$SMTP_TO,
				$SMTP_SUBJECT,
				$SMTP_MESSAGE,
				$SMTP_HEADERS,
				$SMTP_SECURE;

		smtp_mail_send_2($SMTP_USER,$SMTP_PASSWORD,$SMTP_HOST,$SMTP_PORT,$SMTP_FROM,$SMTP_TO,$SMTP_SUBJECT,$SMTP_MESSAGE,$SMTP_HEADERS,$SMTP_SECURE);
	}



	function smtp_mail_send_2($user,$pass,$ser,$port,$from,$to,$subject,$message,$headers,$sec){
		$recipients=$to;
		$dom=explode('@',$from);
		$domain=$dom[1];
		$pass=$pass;
		$smtp_host=$ser;
		$ready=false;
		$smtp_port=$port;
		if (!($socket=fsockopen($smtp_host,$smtp_port,$errno,$errstr,15))){
			echo("$smtp_host ($errno) ($errstr)<br />");
		}else{
			socket_set_timeout($socket,2);
			smtp_server_wait($socket,"220",false);
			fwrite($socket,"EHLO ".$domain."\r\n");
			smtp_server_wait($socket,"250",false);
			if ($sec=="tls"){
			    fwrite($socket,"STARTTLS \r\n");
			    smtp_server_wait($socket,"250",false);
			}
			if ($user<>""){
				fwrite($socket,"AUTH LOGIN \r\n");
				smtp_server_wait($socket, "334");
				fwrite($socket,base64_encode($user)."\r\n");
				smtp_server_wait($socket,"334");
				fwrite($socket,base64_encode($pass)."\r\n");
				smtp_server_wait($socket,"235");
			}
			fwrite($socket,"MAIL FROM: <".$from."> \r\n");
			smtp_server_wait($socket,"250",false);
			fwrite($socket,"RCPT TO: <".$recipients."> \r\n");
			smtp_server_wait($socket,"250",false);
			fwrite($socket,"DATA \r\n");
			smtp_server_wait($socket,"354",true);
			fwrite($socket,"Subject: $subject\r\nTo: <".$recipients.">\r\n$headers\r\n\r\n$message\r\n");
			fwrite($socket,".\r\n");
			smtp_server_wait($socket,"250",false);
			fwrite($socket,"QUIT \r\n");
			fclose($socket);
			$ready=true;
		}
		return($ready);
	}

?>
