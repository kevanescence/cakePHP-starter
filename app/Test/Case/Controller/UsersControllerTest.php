<?php
class UsersControllerTest extends ControllerTestCase {
    public $autoMock = true;
    public $fixtures = array('app.user');
    
    public function setUp() {       
       parent::setUp();
    }
    
    public function testLogin() {               
        /***********    The authentication form is accessible *****************/
        $this->testAction('/users/login', 
                                    array('return' => 'contents', 
                                          'method' => 'get'));
        $this->assertRegExp('/<html/', $this->contents);
        $this->assertRegExp('/<form/', $this->view);
        $this->assertContains( 'id="UserLoginForm"', $this->view);
        
        /****************** Bad authentication is detected *******************/
        $data = array();
        $data['User']['username'] = 'user1';
        $data['User']['password'] = 'surelyABadPwd';

        $this->testAction('/users/login',
                           array('data' => $data, 'method' => 'post')
        );
        $this->testAction('/users/view/1', array('return' => 'contents'));
        $this->assertContains( '/users/login', $this->headers['Location']);
        
        /****************** Good authentication works *************************/
        //create user data array with valid info
        $this->mockUser(1, "user1");        
        $this->testAction('/users/login',array('method' => 'get'));        
        //User should not be redirected to the login form. It produces a null result
        $this->assertNull($this->view);                                
    }
    
    public function testView() {
              
        /************* The profile view require authentication ****************/
        $result = $this->testAction('/users/view/1', 
                                    array('return' => 'contents'));
        $this->assertNull( $result);
        
        /********** A regular user cannot access to an other user page ********/
        //TODO  
        
        /********** A regular user can access to its own page *****************/
        $this->mockUser(1, 'user1');
        //Default call
        $this->testAction('/users/view/', array('return' => 'contents'));
        $this->assertNotContains('id="UserLoginForm"', $this->view);
        $this->assertContains("user1", $this->view);
        $this->mockUser(1, 'user1');

        //With id specified
        $this->testAction('/users/view/1', array('return' => 'contents'));
        $this->assertNotContains('id="UserLoginForm"', $this->view);
        $this->assertContains("user1", $this->view);

        /************* admin can access to all user pages *********************/
        //TODO
    }
        
    function mockUser($id, $username){
        $this->Controller = $this->generate('Users', array(
            'components' => array(
                'Auth'
            )
        ));
        $this->Controller->Auth
                         ->staticExpects($this->any())
                         ->method('user')
                         ->will($this->returnValue(array(
                            'id' => $id,
                            'username' => $username                         
        )));
    }
}