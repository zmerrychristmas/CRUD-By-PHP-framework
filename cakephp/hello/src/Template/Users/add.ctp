<?php
   echo $this->Form->create("Users",array('url'=>'/users/add'));
   echo $this->Form->input('username');
   echo $this->Form->input('password');
   echo $this->Form->button('Submit');
   echo $this->Form->end();
?>
