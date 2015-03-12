<?php

class UsersControllerTest extends ControllerTestCase {
    public $autoMock = true;
    public $fixtures = array('app.user');
    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('User');
    }
    public function testLogin() {
        $result = $this->testAction('/users/login', array('return' => 'contents'));        
        $this->assertRegExp('/<html/', $this->contents);
        $this->assertRegExp('/<form/', $this->view);
                
        $this->Users = $this->generate( 'Users', array(
                'components' => array(
                    'Auth' => array('user'),
                    'Security' => array( '_validatePost' ),
                )
            ) );
//        $this->Users->logout();
        //create user data array with valid info
        $data = array();
        $data['User']['username'] = 'admin';
        $data['User']['password'] = 'admin';

        $result = $this->testAction(
            '/users/login',
            array('data' => $data, 'method' => 'post')
        );
//        debug($result);

        $result = $this->testAction('/users/view/1', array('return' => 'contents'));
        debug($this->headers['Location'] );
         $oldUser = $this->User->find('all', 
                                    array('order' => 'id DESC', 
                                          'fields' => array('id', 'username')));
        $this->assertNotNull( $this->headers['Location'] );
        $foo[] = $this->view;
        debug($oldUser);
    }
    
//    public function testView() {
//       / $result = $this->testAction('/users/view', array('return' => 'contents'));
//    }
}