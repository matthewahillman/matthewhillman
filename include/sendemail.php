<?php

require_once('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->SMTPDebug = 3; //verbode debug
$mail->IsSMTP();
$mail->SMTPDebug = 4;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "info@branconsulting.co.uk";
$mail->Password = "VOG#1966";

if( isset( $_POST['contactform-submit'] ) AND $_POST['contactform-submit'] == 'submit' ) {
    if( $_POST['contactform-name'] != '' AND $_POST['contactform-email'] != '' AND $_POST['contactform-message'] != '' ) {

        $name = $_POST['contactform-name'];
        $email = $_POST['contactform-email'];
        $phone = $_POST['contactform-phone'];
        $message = $_POST['contactform-message'];

        $subject = isset($subject) ? $subject : 'New Message From Your Contact Form';

        $botcheck = $_POST['contactform-botcheck'];

        $toemail = 'info@branconsulting.co.uk'; // Your Email Address
        $toname = 'Robert Woolcock'; // Your Name

        if( $botcheck == '' ) {

            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );

            $name = isset($name) ? "Name: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $phone = isset($phone) ? "Phone: $phone<br><br>" : '';
            $message = isset($message) ? "Message: $message<br><br>" : '';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $phone $message $referrer";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ):
                echo '<p class="alert alert-success">We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.</p>';
            else:
                echo '<p class="alert alert-warning">Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '</p>';
            endif;
        } else {
            echo 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
        }
    } else {
        echo 'Please <strong>Fill up</strong> all the Fields and Try Again.';
    }
} else {
    echo 'An <strong>unexpected error</strong> occured. Please Try Again later.';
}

?>
