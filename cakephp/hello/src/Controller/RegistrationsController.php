<?php
   namespace App\Controller;
   use App\Controller\AppController;

   class RegistrationsController extends AppController{
      public function index(){
         $country = array('India','United State of America','United Kingdom');
         $this->set('country',$country);
         $gender = array('Male','Female');
         $this->set('gender',$gender);
      }
   }
?>