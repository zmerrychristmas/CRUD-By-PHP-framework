<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\ORM\TableRegistry;
   use Cake\Datasource\ConnectionManager;
   use Cake\Auth\DefaultPasswordHasher;

   class UsersController extends AppController{
      public function add(){
         if($this->request->is('post')){
            $username = $this->request->data('username');
            $hashPswdObj = new DefaultPasswordHasher;
            $password = $hashPswdObj->hash($this->request->data('password'));
            $users_table = TableRegistry::get('users');
            $users = $users_table->newEntity();
            $users->username = $username;
            $users->password = $password;
         
            if($users_table->save($users))
            echo "User is added.";
         }
      }
      public function index(){
         $users = TableRegistry::get('users');
         $query = $users->find();
         $this->set('results',$query);
      }

      public function edit($id){
         if($this->request->is('post')){
            $username = $this->request->data('username');
            $password = $this->request->data('password');
            $users_table = TableRegistry::get('users');
            $users = $users_table->get($id);
            $users->username = $username;
            $users->password = $password;
         
            if($users_table->save($users))
            echo "User is udpated";
            $this->setAction('index');
         } else {
            $users_table = TableRegistry::get('users')->find();
            $users = $users_table->where(['id'=>$id])->first();
            $this->set('username',$users->username);
            $this->set('password',$users->password);
            $this->set('id',$id);
         }
      }

      public function delete($id){
         $users_table = TableRegistry::get('users');
         $users = $users_table->get($id);
         $users_table->delete($users);
         echo "User deleted successfully.";
         $this->setAction('index');
      }
   }
?>