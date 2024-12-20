<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                        
    $mail->Host = 'smtp.gmail.com';             
    $mail->SMTPAuth = true;                    
    $mail->Username = 'sweatshirtsucks@gmail.com';
    $mail->Password = 'vtwfgjdqadfvzyvf';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;                          

    // Recipients
    $mail->setFrom('sweatshirtsucks@gmail.com', 'Evan');
    $mail->addAddress('dnfisjelly@gmail.com', 'dnf email');

    // Content
    $code = rand(100000, 999999);
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body = '<h1>Verification code it490</h1><p>Your verification code is ' . $code . '</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML email clients';

    // Send the email
    $mail->send();
    echo 'Message has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

