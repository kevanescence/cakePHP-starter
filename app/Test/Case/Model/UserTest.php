<?php
class UserTest extends CakeTestCase {
    public $fixtures = array('app.user');
    
    //Initialize good values for all required fields
    private $baseData = Array('User' => Array('username' => 'dummyuser',
                                              'role' => 'basic',
                                              'password'=> 'password'));
    
    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('User');
    }

    public function testUsernameConsistency() {
        $this->User->create();
        
        $badData = $this->baseData;        
        //Specify unauthorized value and check that an error is detected
        $badData['User']['username'] = '';
        $this->assertFalse($this->User->save($badData),'username must be specified');
        $badData['User']['username'] = 'user1';
        $this->assertFalse($this->User->save($badData),'username must be unique');
        $badData['User']['username'] = 'abcd';
        $this->assertFalse($this->User->save($badData),'username length must be at least 5');
        $badData['User']['username'] = 'abcdefghijklmnop';
        $this->assertFalse($this->User->save($badData),'username length must be at most 15');
        $badData['User']['username'] = 'goodusername';
        $this->assertNotEquals(false,$this->User->save($badData),'a good user can be saved');                
    }
    
    public function testPasswordConsistency() {
        $this->User->create(); 
        
        $badData = $this->baseData;
        
        //Specify unauthorized value and check that an error is detected
        $badData['User']['password'] = '';
        $this->assertFalse($this->User->save($badData),'password must be specified');
        $badData['User']['password'] = 'abcd';
        $this->assertFalse($this->User->save($badData),'password lenght must be at least 5');
    }
    
    public function testPasswordEncryption() {
        $user = $this->User->create();
                
        $oldUser = $this->User->find('first', 
                                    array('order' => 'id DESC', 
                                          'fields' => array('id', 'password')));
        $oldId = $oldUser['User']['id'];
        
        //Secondary test to be sure we test the good field
        $this->assertNotEquals(false,$this->User->save($this->baseData),
                               'Be sure a new user has been saved');
        $savedUser = $this->User->find('first', 
                                        array('order' => 'id DESC', 
                                              'fields' => array('id', 'password')))['User'];
        $this->assertNotEquals($oldId, $savedUser['id'],
                               'Be sure we retrieve the good id');
        
        //Main test to be sure password has been crypted
        $this->assertNotEquals('password',$savedUser['password'],
                               'password is encrypted');
    }
}
