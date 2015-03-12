<?php
class UsersControllerTest extends ControllerTestCase {
    public $autoMock = true;
    public $fixtures = array('app.user');
    
    public function setUp() {
       ;
       parent::setUp();
    }
    
    private function loginRegularUser($username, $password){
        $this->Users = $this->generate( 'Users', array(
                'components' => array(
                    'Auth' => array('user'),
                    'Security' => array( '_validatePost' ),
                )
            ) );
        $data = array();
        $data['User']['username'] = $username;
        $data['User']['password'] = $password;

        $result = $this->testAction(
            '/users/login',
            array('data' => $data, 'method' => 'post')
        );
    }
    
    private function logoutUser(){
        $this->Users->Auth->logout();
    }
    
    public function testLogin() {
         
        //Mock a user
        $this->Users = $this->generate( 'Users', array(
                'components' => array(
                    'Auth' => array('user'),
                    'Security' => array( '_validatePost' ),
                )
            ) );
        //log out an eventual previous user
        $this->Users->Auth->logout();        

        /***********    The authentication form is accessible *****************/
        $result = $this->testAction('/users/login', 
                                    array('return' => 'contents', 
                                          'method' => 'get'));
        $this->assertRegExp('/<html/', $this->contents);
        $this->assertRegExp('/<form/', $this->view);
        $this->assertContains( 'id="UserLoginForm"', $this->view);
        
        /****************** Bad authentication is detected *******************/
        $data = array();
        $data['User']['username'] = 'user1';
        $data['User']['password'] = 'surelyABadPwd';

        $result = $this->testAction(
            '/users/login',
            array('data' => $data, 'method' => 'post')
        );
        $this->testAction('/users/view/1', array('return' => 'contents'));;
        $this->assertContains( '/users/login', $this->headers['Location']);
        
        /****************** Good authentication works *************************/
        //create user data array with valid info
        $data = array();
        $data['User']['username'] = 'user1';
        $data['User']['password'] = 'user1';

        $result = $this->testAction(
            '/users/login',
            array('data' => $data, 'method' => 'post')
        );
        $result = $this->testAction('/users/view/1', array('return' => 'contents'));        
        $this->assertNotContains( 'id="UserLoginForm"', $this->view);                        
        
        //Log out the mocked user
        $this->Users->Auth->logout();        
    }
    
    public function testView() {
       
       /************* The profile view require authentication *****************/
       $result = $this->testAction('/users/view/2', array('return' => 'contents'));        
       $this->assertContains( '/users/login', $this->headers['Location']);                               
       /********** A regular user cannot access to an other user page *********/
       $this->loginRegularUser('user2', 'user2');
       $result = $this->testAction('/users/view/3', array('return' => 'contents'));        
       $this->assertContains( '/users/login', $this->headers['Location']);                               
       
       /********** A regular can access to its own page **********************/
       $result = $this->testAction('/users/view/2', array('return' => 'contents'));        
       $this->assertNotContains( 'id="UserLoginForm"', $this->view);
       $this->logoutUser();       
       
       /************* admin can access to all user pages **********************/
       $this->loginRegularUser('admin', 'admin');
       $result = $this->testAction('/users/view/2', array('return' => 'contents'));
       $this->assertNotContains( 'id="UserLoginForm"', $this->view);                        

       $this->logoutUser();
    }
}