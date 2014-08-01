<?php
/**
* This class is to use as a default EMAIL class, because godaddy does not allow gmail SMTP
*/
class Email extends AppModel
{
	public function sendEmail($to, $subject, $message, $from = null){		

		if (!empty($from)) {
			$headers = 	"From: $from" . "\r\n" .
   					"Reply-To: $from" . "\r\n" .
   					'X-Mailer: PHP/' . phpversion();
		} else {
			$headers = 	'From: Stylebooth <admin@stylebooth.mx>' . "\r\n" .
   					'Reply-To: Stylebooth <admin@stylebooth.mx>' . "\r\n" .
					'Content-Type: text/html; charset=UTF-8' . "\r\n" .
   					'X-Mailer: PHP/' . phpversion();
		}

		mail($to, $subject, $message, $headers);
	}
}
