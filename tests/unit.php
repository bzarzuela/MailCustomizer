<?php 

include_once 'bootstrap.php';

class MailCustomizerTest extends PHPUnit_Framework_TestCase
{
  protected $_custom_headers = array(
    'X-Customized-By' => 'Bryan Zarzuela',
    'X-Zend-Version' => '1.10.x',
  );
  
  /**
   * This is free because Zend_Config implements ArrayAccess. yay!
   *
   * @return void
   * @author Bryan Zarzuela
   */
  public function testCustomizeViaZendConfig()
  {
    $config = new Zend_Config($this->_custom_headers);
    
    $bmc = new Boz_MailCustomizer;
    
    $mail = $bmc->customize($config);
    
    $mail_headers = $mail->getHeaders();
    
    foreach ($this->_custom_headers as $key => $value) {
      $this->assertEquals($value, $mail_headers[$key][0]);
    }
  }
  
  public function testCustomizeViaArray()
  {
    $custom_headers = $this->_custom_headers;
    
    $bmc = new Boz_MailCustomizer;

    $mail = $bmc->customize($custom_headers);
    
    $mail_headers = $mail->getHeaders();
    
    $this->assertEquals($mail_headers['X-Customized-By'][0], $custom_headers['X-Customized-By']);
    $this->assertEquals($mail_headers['X-Zend-Version'][0], $custom_headers['X-Zend-Version']);
  }
  
  public function testCustomizeExistingObject()
  {
    $mail = new Zend_Mail;
    $mail->addHeader('X-Existing', 'foobar');
    
    $config = new Zend_Config(array(
      'headers' => $this->_custom_headers,
      'mail_instance' => $mail,
    ));
    
    $bmc = new Boz_MailCustomizer;
    
    $customized = $bmc->customize($config);
    
    $mail_headers = $customized->getHeaders();
    
    $this->assertEquals('foobar', $mail_headers['X-Existing'][0]);
    
    foreach ($this->_custom_headers as $key => $value) {
      $this->assertEquals($value, $mail_headers[$key][0]);
    }
  }
}