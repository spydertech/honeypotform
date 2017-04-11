<?php 

// If the form is submitted, send the message.
require_once('./include/phpmailer/class.phpmailer.php');
if (isset($_POST['submit_contact_form']) && empty($_POST['honeypot']))
{
    $mail  = new PHPMailer();
    $mail -> IsHTML         (true);
    $mail -> From           = $_POST['email'];
    $mail -> FromName       = ucwords($_POST['name']);
    $mail -> Subject        = 'Contact Form Submission';
    $mail -> Body           = 'Name: '.$_POST['name'].'<br />Email: '.$_POST['email'].'<br />Phone: '.$_POST['phone'].'<br />Description of Job:'.$_POST['message'];
    $mail -> AddAddress     ('contact@youremail.com');

    if ($mail -> send()) {
        header('Location: ./thank-you.html');
        die();
    } 
    else {
        echo '<p>Your message could not be delivered.</p>';
        echo '<pre>';
        echo 'Error: '. $mail->ErrorInfo;
        echo '</pre>';
        echo '<p>To go back to the contact form please click <a href="contact.html">here</a>.';    
        die();
    }
}

?>
