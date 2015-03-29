<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://localhost/");
  }

  public function testMyTestCase()
  {
    $this->open("/cakePHP-starter/users/login");
    $this->assertTrue($this->isElementPresent("css=form"));
    $this->assertTrue($this->isElementPresent("css=input[type=\"password\"]"));
    $this->assertTrue($this->isElementPresent("css=input[type=\"text\"]"));
    $this->assertTrue($this->isElementPresent("css=input[type=\"submit\"]"));
    //$this->click("css=input.btn.btn-success");
    //$this->waitForPageToLoad("30000");
  }
}
?>