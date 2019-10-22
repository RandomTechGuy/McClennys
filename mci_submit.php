<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'composer\vendor\autoload.php';

  $name    = filter_input(INPUT_POST, "custName");
  $street  = filter_input(INPUT_POST, "custStreet");
  $street2 = filter_input(INPUT_POST, "custStreet2");
  $city    = filter_input(INPUT_POST, "custCity");
  $state   = filter_input(INPUT_POST, "custState");
  $zip     = filter_input(INPUT_POST, "custZip");
  $phone   = filter_input(INPUT_POST, "custPhone");
  $email   = filter_input(INPUT_POST, "custEmail");
  $note    = filter_input(INPUT_POST, "note");

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
    
/*  $mail->SMTPDebug = 3;*/
    
    $mail->setFrom('cis470test@yahoo.com', 'Test User');
    $mail->addAddress('jjhenry84@gmail.com');
    $mail->Subject = 'Inquiry';
    
    $mail->Body = buildBody($name, $street, $street2, $city, $state, $zip, $phone, $email, $note);
    
if($mail->send()){
    $message = $name.' your inquiry has been successfully sent.';
} else{
    $message = 'We are sorry. There was a problem. Please try again later or call us directly.';   
}
} catch (Exception $e) {
    /* PHPMailer exception. */
    echo $e->errorMessage();
} catch (\Exception $e) {
    /* PHP exception (note the backslash to select the global namespace Exception class). */
    echo $e->getMessage();
}

include 'mci_contact.html';

function buildBody($name, $street, $street2, $city, $state, $zip, $phone, $email, $note){
      $bodyString = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
                     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        </head>
                        <body>
                          <h2>An inquiry has been made by:</h2>
                          <div>
                              <p>'. $name .'<br>'.
                                    $street.'<br>'.
                                    $street2.'<br>'.
                                    $city.', '. 
                                    $state .' '. 
                                    $zip.'<br><br>'.
                                '<a href="tel:+'.$phone.'">'.$phone.'</a><br>'.
                                $email.'</p>
                              
                          <h2>For the following services:</h2>
                              <p>'.$note.'</p>
                          </div>
                          </body>
                        </html>';
      return $bodyString;
}
?>
