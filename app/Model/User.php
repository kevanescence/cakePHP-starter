<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * CakePHP User
 * @author kremy
 */
class User extends AppModel {
        

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'This username is already used'
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
                'message' => 'The username must be between 5 and 15'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'The password length must be at least 5'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'basic')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}
