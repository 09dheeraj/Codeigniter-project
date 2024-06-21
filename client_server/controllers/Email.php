<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
    }
    
    function send(){
        $this->load->library('phpmailer_lib');
        
        $mail = $this->phpmailer_lib->load();
        
        $mail->isSMTP();
        $mail->Host     = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@good-times.ca';
        $mail->Password = 'Bunny1997$$';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        
        $mail->setFrom('info@good-times.ca', 'Paint Bending');
        $mail->addReplyTo('info@good-times.ca', 'Paint Bending');
        
        $mail->addAddress('dheeraj.tradeit@gmail.com');
        
        $mail->addCC('dheeraj.tradeit@gmail.com');
        $mail->addBCC('dheeraj.tradeit@gmail.com');
        
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        $mail->isHTML(true);
        
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
    
}