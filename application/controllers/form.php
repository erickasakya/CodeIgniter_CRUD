<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
                //$this->load->helper('url');
                $this->load->model('form_model');
        }

	public function index()
	{
	
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password','Password', 'required');

		if ($this->form_validation->run() === FALSE)
		    {
		    	$data = array(
            'email' => form_error('email'),
            'username' => form_error('username'),
            'password' => form_error('password')
                  );

		    	foreach ($data as $key => $val) {
					   echo $val;
					}
			}else
		    {
		        $this->form_model->insert_data();
		        
		        echo "1";
		    }
	}
}
