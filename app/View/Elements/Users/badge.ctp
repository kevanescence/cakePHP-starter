<?php
/** parameter lists:
 *          - $username     : the username
 *          - $id           : the user id
 *          - $isFriend     : [null|true|false] determines if the element has to
 *                              display a delete friend or add friend link.
 */
?>
<?php

?>
<div class="<?= $cssClass ?> user-badge">
    <img src="http://lorempixel.com/150/150/" alt="" />   
    <?= $this->Html->link($username,
                            array('controller' => 'Users',
                                'action' => 'view',
                                 $id),
                            array('class' => 'username'));?>        
</div>