<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class PaintBending extends BaseController {
	 public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		
		$this->load->model('UserModel');

	}

	public function home()
	{

		$this->load->view('home');
	}


	

	
	
}
