<?php
   echo $this->Form->create("Users",array('url'=>'/users/edit/'.$id));
   echo $this->Form->input('username',['value'=>$username]);
   echo $this->Form->input('password',['value'=>$password]);
   echo $this->Form->button('Submit');
   echo $this->Form->end();
?>