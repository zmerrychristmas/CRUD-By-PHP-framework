<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Core\Exception\Exception;

   class ExpsController extends AppController{
      public function index($arg1,$arg2){
         try{
            $this->set('argument1',$arg1);
            $this->set('argument2',$arg2);
            
            if(($arg1 < 1 || $arg1 > 10) || ($arg2 < 1 || $arg2 > 10))
            throw new Exception("One of the number is out of range[1-10].");
         }catch(\Exception $ex){
            echo $ex->getMessage();
         }
      }
   }
?>