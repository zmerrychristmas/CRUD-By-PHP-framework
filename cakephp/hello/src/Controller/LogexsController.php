<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Log\Log;

   class LogexsController extends AppController{
      public function index(){
         /*The first way to write to log file.*/
         Log::write('debug',"Something didn't work.");
         
         /*The second way to write to log file.*/
         $this->log("Something didn't work.",'debug');
      }
   }
?>
