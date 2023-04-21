<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once '../models/respone.php';
include_once '../models/verification-code.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once '../vendor/autoload.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
$mail = new PHPMailer();

$data = json_decode(file_get_contents("php://input"));
$response = Response::getDefaultInstance();

if (isset($data->email)) {
    $listCodes = [];

    $rand_code = random_int(1000, 9999);

    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'd661433d20cd95';
    $mail->Password = '9be21f7e199414';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;
    $mail->setFrom('info@mailtrap.io', 'Mailtrap');
    $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
    $mail->addAddress($data->email);
    $mail->addAddress('info@mailtrap.io');
    $mail->isHTML(true);
    $mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>
    <p>Verification code: .$rand_code</p>";
    $mail->Body = $mailContent;

    if (!$mail->send()) {
        $response->setMessage("Message could not be sent: " . $mail->ErrorInfo);
        $response->setError(true);
        $response->setResponeCode(6);
    } else {
        $verificationcode = new Verification($rand_code);
        array_push($listCodes, $verificationcode);
        $response->setMessage("Message sent successfully");
        $response->setError(false);
        $response->setResponeCode(1);
        $response->setData($verificationcode);
    }
    echo json_encode($response);
}
