<?php
  require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
  abstract class FunctionalTestCase extends PHPUnit_Extensions_Selenium2TestCase {
 
    protected function assertIsLocation($url,$message = '') {
      $this->assertEquals($this->getLocation(),$url,$message);
    }
 
    protected function assertHasNotErrorMessages($message = '') {
      $this->assertTextNotPresent('Fatal Error','Fatal Error '.$message);
      $this->assertTextNotPresent('error','error '.$message);
      $this->assertTextNotPresent('warning','warning '.$message);
      $this->assertTextNotPresent('Notice','notice '.$message);
    }
 
    protected function assertIsElementPresent($locator,$message='') {
      $this->assertTrue($this->isElementPresent($locator),'unable to find '.$locator.' '.$message);
    }
 
  }