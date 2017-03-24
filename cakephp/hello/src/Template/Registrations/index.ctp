<?php
   echo $this->Form->create("Registrations",array('url'=>'/register'));
   echo $this->Form->input('username');
   echo $this->Form->input('password');
   echo $this->Form->input('password');
   echo '<label for="country">Country</label>';
   echo $this->Form->select('country',$country);
   echo '<label for="gender">Gender</label>';
   echo $this->Form->radio('gender',$gender);
   echo '<label for="address">Address</label>';
   echo $this->Form->textarea('address');
   echo $this->Form->file('profilepic');
   echo '<div>'.$this->Form->checkbox('terms').
      '<label for="country">Terms &Conditions</label></div>';
   echo $this->Form->button('Submit');
   echo $this->Form->end();
?>