<?php

include('class.phpmailer.php');

class Mail {

  private $mail;

  function __construct() {
    $this->mail = new PHPMailer();
    $this->mail->IsSMTP();
    $this->mail->Host = 'smtp.industriafox.com';
    $this->mail->SMTPAuth = true;
    $this->mail->SMTPDebug  = 1;
    //$this->mail->SMTPSecure = SMTPSECURE;            
    $this->mail->Port = '587';
    $this->mail->Username = 'gabriela.marcolino@industriafox.com';
    $this->mail->Password = 'neissa01';
    $this->mail->From = 'gabriela.marcolino@industriafox.com';
    $this->mail->FromName = 'Gabriela Morelli';
    $this->mail->IsHTML(true);
    $this->mail->CharSet = 'utf-8';
  }

  function Send($to_list, $subject, $body, $addbcc = array()) {

    $this->mail->ClearAddresses();

    foreach ($to_list as $to) {
      $this->mail->AddAddress($to["email"], $to["nome"]);
    }
    foreach ($addbcc as $bbc) {
      $this->mail->AddBcc($bbc["email"]);
    }
    $this->mail->Subject = $subject;
    $this->mail->Body = $body;

    if (!$this->mail->Send()) {
      return false;
    }
    return true;
  }

}

