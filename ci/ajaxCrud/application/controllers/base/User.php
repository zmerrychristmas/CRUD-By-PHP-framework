<?php
require_once APPPATH . 'controllers/Base_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

    protected static $_prefix =  'base/';
    protected $limit = 3;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->data['menu_one_lines'] = [
            'Create user' => '/index.php/base/user/create',
            'Users list' => '/index.php/base/user',
        ];

        /* load styles and script */
        $this->layoutStyle([
            'bootstrap.css',
            'style.css'
        ]);
        $this->layoutScript([
            'jquery.min.js',
            'bootstrap.min.js',
            'custom_script.js'
        ]);
    }
    /**
    * List user
     */
    public function index($index = 0)
    {
        /* Prepare vars */
        $this->content = self::$_prefix . 'index';
        $this->load->model('User_Model');
        $users = $this->User_Model->get($this->limit, $index);
        $total = $users['total'];
        $users = $users['data'];
        $stt = $index;
        $this->data['users'] = $users;
        $this->data['stt'] = $stt;
        if ($this->input->get('ajax')) {
            header('Content-Type: application/json');
            echo json_encode([
                'data'  =>  $users,
                'stt'   =>  $stt,
                'editUrl'   => '/index.php/base/user/edit',
                'deleteUrl' =>  '/index.php/base/user/del'
            ]);
            die();
        }
        /* pagination */
        $this->load->library('pagination'); // load pagination
        $config['base_url'] = '/index.php/base/user/index';
        $config += self::paginationConfig($total, $this->limit, 4);
        $this->pagination->initialize($config);
        /* load layout */
        $this->data['pagination'] = $this->pagination->create_links();
        $this->layout();
    }

    public function create()
    {
        /* Load Model */
        $this->load->model('User_Model');
        /* Load helper */
        $this->load->helper(array('url', 'form'));

        /* Load form validation library */
        $this->load->library('form_validation');
        /* Set validation rule for name field in the form */
        $this->form_validation->set_rules('user_name', 'Name', 'required');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|is_unique[users.user_email]');
        /* if is ajax request */
        $is_ajax = $this->input->post('ajax');
        $result = [];
        $result['action']   = 'create';
        if ($this->form_validation->run() != false) {
            $user_name = $this->input->post('user_name');
            $user_email = $this->input->post('user_email');
            $this->User_Model->create(['user_name' => $user_name, 'user_email' => $user_email]);
            if ($is_ajax) {
                $result['status'] = '1';
                $result['messages'] = 'Successfull create user!';
            }
        } else if ($is_ajax) {
                $result['status'] = '0';
                $result['messages'] = validation_errors();
        }
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }
        /* Prepare vars */
        $this->content = self::$_prefix . 'create';
        $url = '/index.php/base/user/create';
        /* Layout page */
        $this->data['url'] = $url;
        $this->data['action'] = 'Create User';
        $this->data['title'] = 'Create User';
        $this->layout();
    }

    public function del($id = NULL)
    {
        if (!isset($id)) {
            show_404();
        }
        /* Load Model */
        $this->load->model('User_Model');
        $result = $this->User_Model->delete($id);
        if ($this->input->get('ajax')) {
            header('Content-Type: application/json');
            echo json_encode([
                'result' => $id
            ]);
            die();
        } else {
            $this->load->helper(array('url'));
            redirect('/base/user','refresh');
        }
    }

    public function edit($id = NULL)
    {
        if (!isset($id)) {
            show_404();
        }
        /* Load Model */
        $this->load->model('User_Model');
        /* Load helper */
        $this->load->helper(array('url', 'form'));
        /* Get user */
        $user = $this->User_Model->findById($id);
        if (! $user) {
            // redirect to create method
            redirect('/base/user/create','refresh');
        }
        $user = $user[0];
        /* Load form validation library */
        $this->load->library('form_validation');
        /* Set validation rule for name field in the form */
        $this->form_validation->set_rules('user_name', 'Name', 'required');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|callback__unique_user_email['.$user->user_email.']');
        /* if is ajax request */
        $is_ajax = $this->input->post('ajax');
        $result = [];
        $result['action']   = 'update';
        if ($this->form_validation->run() != false) {
            $user_name = $this->input->post('user_name');
            $user_email = $this->input->post('user_email');
            if ($this->User_Model->update($user->user_id, ['user_name' => $user_name, 'user_email' => $user_email]));
            $user->user_name = $user_name;
            $user->user_email = $user_email;
            if ($is_ajax) {
                $result['status'] = '1';
                $result['messages'] = 'Successfull create user!';
            }
        } else if ($is_ajax) {
                $result['status'] = '0';
                $result['messages'] = validation_errors();
        }
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }
        /* Prepare vars */
        $this->content = self::$_prefix . 'create';
        $url = '/index.php/base/user/edit/' . $user->user_id;

        /* Layout page */
        $this->data['url'] = $url;
        $this->data['action'] = 'Update User';
        $this->data['title'] = 'Update User';
        $this->data['user'] = $user;
        $this->layout();
    }

    public function _unique_user_email($email, $old_email)
    {
        /* Check old email */
        if ($email == $old_email) {
            return true;
        }

        /* Check email exists */
        if ($this->User_Model->userEmailExists($email)) {
            $this->form_validation->set_message('_unique_user_email', 'Email exists!');
            return false;
        }
        return true;
    }
}
