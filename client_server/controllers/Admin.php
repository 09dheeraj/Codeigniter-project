<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Admin extends BaseController {

	 public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('Admin_model');

	}


	public function customer_list()
	{
		
		$this->global['title'] = 'Customers List';
		$this->global['page_title'] = 'Customers| Customers List | Paint Bending';
		$data['Customers_list'] = $this->Admin_model->customer_data();
		$this->loadViews('customer_list',$this->global,$data);  
	}



	public function artist_list()
	{
		
		$this->global['title'] = 'Artist List';
		$this->global['page_title'] = 'Artist| Artist List | Paint Bending';
		$data['Artist_data'] = $this->Admin_model->Artist_data();
		$this->loadViews('artistlistView',$this->global,$data);   
	}



	public function setStatus()
    {
        $artID = $this->input->post('artID');
        $status = $this->input->post('status');
		
        $result = $this->Admin_model->setStatus($artID, $status);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


	public function delete_artist()
	{
		
		$art_id = $this->input->get('art_id');
   		$status = 0;
		$result = $this->Admin_model->soft_deleteArt($art_id, $status);
		if($result)
		{
			echo "Artist delete Successfully";
			//$art = $this->Admin_model->isdeleteArt($art_id);
		}
		else
		{
			return false;
		}

		
	}
	public function browse_artist()
	{
  
		$ID = $this->uri->segment(2);

		$this->loadViews('browse_artist');  
	}



	public function admin_profile()
	{
      
		$this->loadViews('admin_profile');   
	}
	
	


	
}
