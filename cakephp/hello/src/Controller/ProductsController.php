<?php
   namespace App\Controller;
   use App\Controller\AppController;
   
   class ProductsController extends AppController{
      public function view(){
         $this->set('Product_Name','XYZ');
      }
   }
?>