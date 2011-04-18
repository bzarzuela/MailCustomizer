<?php 

/**
* 
*/
class Boz_MailCustomizer
{
  public function customize($options)
  {
    $mail = new Zend_Mail;
    
    foreach ($options as $key => $value) {
      $mail->addHeader($key, $value);
    }
    
    return $mail;
  }
}
