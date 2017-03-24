<?php
defined('BASEPATH') OR exit('No direct script access allowed');
abstract class Base_Controller extends CI_Controller {
    protected $template = [];
    protected $data = [];
    protected static $_prefix =  '';

    public function __construct()
    {
        parent::__construct();
        $this->data['title'] =  'Code Igniter';
        $this->data['link'] =   ['style' => [], 'script' => []];
    }

    protected function layoutStyle($styles = [])
    {
        $this->data['link']['style'] = $styles;
    }

    protected function layoutScript($script = [])
    {
        $this->data['link']['script'] = $script;
    }

    /**
     * layout page
     */
    protected function layout($name = 'template/master_layout')
    {

        $this->template['header'] = $this->load->view('template/header', $this->data, true);
        $this->template['left'] = $this->load->view('template/left', $this->data, true);
        $this->template['link'] = $this->load->view('template/link', $this->data, true);
        $this->template['content'] = $this->load->view($this->content, $this->data, true);
        $this->template['footer'] = $this->load->view('template/footer', $this->data, true);
        $this->load->view($name, $this->template);
    }

    /**
     * Debug function: var_dump(); die();
     */
    protected static function dd($var)
    {
        var_dump($var);
        die();
    }

    /**
     * Pagination links
     */
    public static function paginationConfig($total, $perPage, $segment, $linkClass = 'paginationLink')
    {
        $config = [];
        $config['total_rows'] = $total;
        $config['per_page'] = $perPage;
        $config["uri_segment"] = $segment;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination pull-right" data-nums="' . $config['num_links'] . '" >';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#" class="'.$linkClass.'">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        return $config;
    }
}
