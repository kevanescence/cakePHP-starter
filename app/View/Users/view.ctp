<ul class="nav nav-tabs container" role="tablist">
    <h2> Welcome to <?= $user['User']['username']?>'s page</h2>
    <li class="<?php if ($tab === "infos") echo "active " ?>">
        <a href="#infos" role="tab" data-toggle="tab">Infos</a>
    </li>
</ul>
<div class="tab-content">   
    <div class="tab-pane <?php if ($tab === "infos") echo "active "; ?>
         container" id="infos">
         <div class="col-lg-6 col-lg-offset-1">
         <?= $this->element("Users/information", array('user' => $user, 
                                                       'settable' => false)); ?>
             </div>
    </div>    
</div>

