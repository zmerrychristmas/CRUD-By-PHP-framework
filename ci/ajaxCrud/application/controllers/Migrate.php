<?php

class Migrate extends CI_Controller
{

        public function index()
        {
                $this->load->library('migration');
                $this->load->helper('url');

                if ($this->migration->current() === FALSE)
                {
                        show_error($this->migration->error_string());
                } else {
                    redirect('/base/user');
                }
        }

}