<?php 

// If the form is submitted, send the message.
require_once('./include/phpmailer/class.phpmailer.php');
if (isset($_POST['submit_contact_form']) && empty($_POST['honeypot']))
{
    $mail  = new PHPMailer();
    $mail -> IsHTML         (true);
    $mail -> From           = $_POST['email'];
    $mail -> FromName       = ucwords($_POST['name']);
    $mail -> Subject        = 'New England Asphalt Contact Form';
    $mail -> Body           = 'Name: '.$_POST['name'].'<br />Email: '.$_POST['email'].'<br />Phone: '.$_POST['phone'].'<br />Description of Job:'.$_POST['message'];
    $mail -> AddAddress     ('contact@newenglandasphalt.com');

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

if (isset($_POST['submit_request_form']) && empty($_POST['honeypot']))
{
    $mail  = new PHPMailer();
    $mail -> IsHTML         (true);
    $mail -> From           = $_POST['email'];
    $mail -> FromName       = ucwords($_POST['name']);
    $mail -> Subject        = 'New England Asphalt Quote Request Form';
    $mail -> Body           = 'Name: '.$_POST['name'].'<br />Email: '.$_POST['email'].'<br />Phone: '.$_POST['phone'].'<br />Type of Project: '.$_POST['project_type'].'<br />Description of Job:'.$_POST['message'];
    $mail -> AddAddress     ('contact@newenglandasphalt.com');

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
    
if (isset($_POST['submit_employment_form']) && empty($_POST['honeypot']))
{

    $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name']));

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        require './include/phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail -> IsHTML         (true);
        $mail->From = $_POST['email'];
        $mail->addAddress('contact@newenglandasphalt.com');
        $mail->Subject = 'New England Asphalt Employment Form';
        $mail->Body = 'Name: '.$_POST['name'].'<br />Email: '.$_POST['email'].'<br />Phone: '.$_POST['phone'].'<br />Address: '.$_POST['address'].'<br />City: '.$_POST['city'].'<br />State: '.$_POST['state'].'<br />Zipcode: '.$_POST['zipcode'].'<br />Position: '.$_POST['position'].'<br />Comments: '.$_POST['message'];
        // Attach the uploaded file
        $mail->addAttachment($uploadfile);
        if (!$mail->send()) {
            echo '<p>Your message could not be delivered.</p>';
            echo '<pre>';
            echo 'Error: ' . $mail->ErrorInfo;
            echo '</pre>';
            echo '<p>To go back to the contact form please click <a href="contact.html">here</a>.';    
            die();
        } else {
            header('Location: ./thank-you.html');
            die();
        }
    } else {
        echo 'Failed to move file to ' . $uploadfile;
        echo '<p>To go back to the contact form please click <a href="employment.html">here</a>.';    
        die();
    }

}

?>