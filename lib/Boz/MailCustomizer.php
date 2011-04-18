<?php 

/**
* 
*/
class Boz_MailCustomizer
{
  public function customize($options)
  {
    if ($options instanceof Zend_Config) {
      $options = $options->toArray();
    }
    
    if (isset($options['mail_instance']) && $options['mail_instance'] instanceof Zend_Mail) {
      $mail = $options['mail_instance'];
      $options = $options['headers'];
    } else {
      $mail = new Zend_Mail;
    }
    
    foreach ($options as $key => $value) {
      $mail->addHeader($key, $value);
    }
    
    return $mail;
  }
}
