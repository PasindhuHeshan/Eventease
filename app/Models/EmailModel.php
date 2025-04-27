<?php
namespace App\Models;

use phpmailer\phpmailer\PHPMailer;
use phpmailer\phpmailer\SMTP;
use phpmailer\phpmailer\Exception;

require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';

class EmailModel {
    private $smtp_server;
    private $port;
    private $username;
    private $password;
    private $errorInfo; // Property to store error information

    public function __construct() {
        $config = require __DIR__ . '/email_config.php';
        $this->smtp_server = $config['smtp_server'];
        $this->port = $config['port'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->errorInfo = null; // Initialize errorInfo
    }

    public function sendEmail($recipient_email, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = $this->smtp_server;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->username;
            $mail->Password   = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $this->port;

            //Recipients
            $mail->setFrom($this->username, 'Eventease Admin');
            $mail->addAddress($recipient_email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            $this->errorInfo = null;
            return [true, null];
        } catch (Exception $e) {
            $this->errorInfo = $mail->ErrorInfo;
            return [false, $this->errorInfo];
        }
    }

    public function getErrorInfo() {
        return $this->errorInfo;
    }

    public function sendBulkEmail($recipient_emails, $subject, $body) {
        $mail = new PHPMailer(true);
        $this->errorInfo = null; // Reset error info

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = $this->smtp_server;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->username;
            $mail->Password   = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $this->port;

            // Recipients
            $mail->setFrom($this->username, 'Eventease Admin');
            foreach ($recipient_emails as $email) {
                $mail->addBCC($email);
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return [true, null];
        } catch (Exception $e) {
            $this->errorInfo = $mail->ErrorInfo;
            return [false, $this->errorInfo];
        }
    }
}
?>