<?php echo $this->Form->create('User',array(
                                       
                                        "role" => "form",
                                        'inputDefaults' => array(
                                            'class' => 'form-control',                                            
                                            'div' => array('class' => 'form-group')),
                                        "action" => "login")); ?>
<fieldset>
    <legend> Log in</legend>
    <?php
      
    echo $this->Form->input('username',array('placeholder'=>'Email','label'=>'Your username*'));    
    echo $this->Form->input('password',array('placeholder'=>'Password','label'=>'Your password*'));    
    $options = array(
        'label' => 'Log in',
        'class' => 'btn btn-success',
        'div' => false
    );
    echo $this->Form->end($options); ?>
</fieldset>
