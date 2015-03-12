<?php
$this->append("css", $this->Html->css("Users/information"));
$this->append("script", $this->Html->script("Users/information"));
$hasRight = AuthComponent::user('id') == $user['User']['id'] 
            || AuthComponent::user('role') == 'admin';
?>
<div class="col-lg-5 user-badge-section">
    <?= $this->element('Users/badge', array('id' => $user['User']['id'],
                                            'cssClass' => "col-lg-12 col-md-12 col-sm-12 col-xs-12",
                                            'username' => $user['User']['username']));?> 
</div>
<div class="col-md-7">
<?php

if ($hasRight) {
    echo $this->Form->create('User', array(
                                        'role' => 'form',
                                        'inputDefaults' => array(
                                            'class' => 'form-control',
                                            'div' => array('class' => 'form-group')),
                                        'url' => array('controller' => 'users',
                                        'action' => 'edit',
                                        $user['User']['id'])));
    if($settable) {
        echo "<fieldset>" . $this->Html->tag('legend', 'Modificaitons des informations');    
    }
    echo $this->Form->input('id', array('type' => 'hidden', 
                                        'value' => $user['User']['id']));
}
?>

<div class = "input-group">
    <span class="input-group-addon  glyphicon glyphicon-user"></span>
    <?php
    if($hasRight) {        
        echo $this->Form->input("User.username", array('label' => false,
                                                       'class' => 'form-control',
                                                       'placeholder' => 'Pseudo',
                                                       'value' => $user['User']['username']));
    } else {
        echo $this->Html->tag("span", $user['User']['username']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<?php    
    if($hasRight) {
        echo $this->Html->link('Cancel' , array('controller' => 'users',
                                                 'action' => 'view', 
                                                 $user['User']['id'] ),
                                           array('class' => 'btn btn-danger'
                                               . ' col-lg-4 col-lg-offset-1'
                                               . ' col-sm-4 col-sm-offset-1'
                                               . ' col-md-4 col-md-offset-1'
                                               . ' col-xs-4 col-xs-offset-1',
                                                 'id' => 'btn-cancel'));
        echo $this->Form->end(array("label" => "Save",
                                    "id" => "btn-save-info",
                                     'div' => false,
                                    "class" => "btn btn-md btn-success "
                                                . "col-lg-4 col-lg-offset-2"
                                                ." col-sm-4 col-sm-offset-2"
                                                .' col-md-4 col-md-offset-2'
                                                ." col-xs-4 col-xs-offset-2"));
    }
 ?>
    </fieldset>
</div>