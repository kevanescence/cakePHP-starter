<?php
class UserFixture extends CakeTestFixture {

    public $import='User';    

    public function init() {
        $this->records = array(
             array(
                'id' => 1,
                'username' => 'user1',
                'password' => 'user1',
                'role' => 'basic',
                'created' => '2015-02-18 10:39:23',
                'updated' => '2015-02-22 10:41:31'
            ),
            array(
                'id' => 2,
                'username' => 'user2',
                'password' => 'user2',
                'role' => 'basic',
                'created' => '2007-03-18 10:41:23',
                'updated' => '2009-03-18 10:43:31'
            ),
            array(
                'id' => 3,
                'username' => 'user3',
                'password' => 'user3',
                'role' => 'basic',
                'created' => '2011-03-18 10:41:23',
                'updated' => '2013-03-18 10:43:31'
            ),
            array(
                'id' => 4,
                'username' => 'admin',
                'password' => 'admin',
                'role' => 'admin',
                'created' => '2007-03-18 10:41:23',
                'updated' => '2007-03-18 10:43:31'
            ) 
        );
        parent::init();
    }
}