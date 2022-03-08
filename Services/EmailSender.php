<?php
namespace Services;
use Models\Users\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class EmailSender
{
    public static function send(User $receiver, string $subject, string $templateName, $templateVars) : void
    {
        extract ($templateVars);

        ob_start();
        require __DIR__ . "/../Templates/Mail/" . $templateName;
        $body = ob_get_contents();
        ob_clean();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->isHTML = true;
        $mail->SMTPSecure='ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = "465";
        $mail->setFrom ("Sofocl@gmail.com");
        $mail->Username = "xpencpodlivom@gmail.com";
        $mail->Password = "Pfkegf25cv";
        $mail->Subject = "$subject";
        $mail->Body = $body;
        $mail->addAddress ($receiver->getEmail());
        $mail->send();

    }
}


?>