<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'composer\vendor\autoload.php';

$sentUser     = 'cis470test@yahoo.com';
$sentPassword = 'tset074sic';

try {
    $mail = new PHPMailer(TRUE);
    $mail->IsHTML(true);
    $mail->isSMTP();
    $mail->Host = "smtp.mail.yahoo.com";
    /* Use SMTP authentication. */
    $mail->SMTPAuth = true;
    
    $mail->SMTPSecure = 'tls';

    /* SMTP authentication username. */
    $mail->Username = $sentUser;
    /* SMTP authentication password. */
    $mail->Password = $sentPassword;

    /* Set the SMTP port. */
    $mail->Port = 587;
    
/*    $mail->SMTPDebug = 3;*/
    
    $mail->setFrom('cis470test@yahoo.com', 'Test User');
    $mail->addAddress('cis470test@yahoo.com');
    $mail->Subject = 'Test';

    
    $mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        </head>
                        <body>
                          <h1>This is a test.</h1>
                          <div>
                              <p>This is a test of the email system. It obviously worked.</p>
                          </div>                        
                          </body>
                        </html>';;
    
$mail->send();
} catch (Exception $e) {
    /* PHPMailer exception. */
    echo $e->errorMessage();
} catch (\Exception $e) {
    /* PHP exception (note the backslash to select the global namespace Exception class). */
    echo $e->getMessage();
}

$sent = TRUE;
?>