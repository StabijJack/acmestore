<?php

namespace App\Classes;
use PHPMailer\PHPMailer;

class Mail
{
    protected $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer;
        $this->SetUp()
    }
    public function setUp()
    {
        $this->mail->isSMTP();
        $this->mail->Mailer = 'smtp';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';

        $this->mail->Host = getenv('SMTP_HOST');
        $this->mail->Port = getenv('SMTP_PORT');
        
        $environment = getenv(' APP_ENV');
        if ($environment === 'local') {$this->mail->SMTPDebug = 2;}

        $this->mai->Username = getenv('MAIL_USERNAME');
        $this->mai->Paasword = getenv('MAIL_PASSWORD');

        $this->mail->isHTML(true);
        $this->mail->SingleTo = true;

        $this->mail->From = getenv('ADMIN_EMAIL');
        $this->mail->FromName = 'ACME Store';
    }
    public function send($data)
    {       
        $this->mail->addAddress($data['to'], $data['name']);
        $this->mail->Subject = $data['subject'];
    }
}