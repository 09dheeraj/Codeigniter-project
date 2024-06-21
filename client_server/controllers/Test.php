<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Test extends BaseController {
	 public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('CustomerModel');
		$this->load->model('UserModel');
		$this->load->library('form_validation');
		
		

	}




	public function html()
	{
		$req_id = $this->security->xss_clean($this->input->post('req_id'));
		$artist_id = $this->security->xss_clean($this->input->post('artist_id'));
		
		$customerchat = $this->CustomerModel->getcustomerchat($req_id);
		$loggedin = $this->session->userdata('id');
		$artistImage = $this->CustomerModel->artistImage($artist_id);
		$image = $artistImage[0]->profile_image;
	

$htmlContent = "<div class='chat-box mb-5'>";

foreach ($customerchat as $chat) {
    $senderid = $chat->sender;
    if ($senderid == $loggedin) {
        $htmlContent .= "
        <div class='direct-chat-messages d-flex justify-content-end'>
            <div class='direct-chat-text'>
                <p>" . $chat->description . "</p>
                <span>";

        $timestamp = strtotime($chat->created_at);
        $formattedDate = date('d, F, Y, h:i a', $timestamp);
        
        $htmlContent .= $formattedDate . "</span>
            </div>
            <div class='direct-chat-img'>
                <img src='" . base_url('/assets/customer_image/') . $this->session->userdata('profile_image') . "' alt=''>
            </div>
        </div>";
    } else {
       

        $htmlContent .= "
        <div class='direct-chat-messages msg-box-2 d-flex'>
            <div class='direct-chat-img'>
                <img src='" . base_url('/assets/artist_image/') . $image . "' alt=''>
            </div>
            <div class='direct-chat-text'>
                <p>" . $chat->description . "</p>
                <span>";

        $timestamp = strtotime($chat->created_at);
        $formattedDate = date('d, F, Y, h:i a', $timestamp);
        
        $htmlContent .= $formattedDate . "</span>
            </div>
        </div>";
    }
}

$htmlContent .= "
    <form action='" . base_url('submitchat/' . $req_id . '/' . $artist_id) . "' method='POST'>
        <div class='row mt-5'>
            <div class='col-sm-12'>
                <div class='form-group'>
                    <input type='text' class='form-control' name='chat' placeholder='Reply Here....'>
                    <div class='send-btn'>
                        <button class='bg-transparent border-0'><i class='bi bi-paperclip'></i></button>
                        <button class='bg-transparent border-0'><i class='bi bi-send'></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>";

echo $htmlContent;
				
		
	}


	public function getmore_chat()
	{
		$req_id = $this->security->xss_clean($this->input->post('req_id'));
		
		$artist_id = $this->security->xss_clean($this->input->post('artist_id'));
		$offset = $this->security->xss_clean($this->input->post('offset'));
		$customerchat = $this->CustomerModel->getmore_chat($req_id,$offset);
		//print_r($customerchat);
		
		$loggedin = $this->session->userdata('id');
		$artistImage = $this->CustomerModel->artistImage($artist_id);
		$image = $artistImage[0]->profile_image;	


		$htmlContent = "<div class='mb-5'>";
		foreach ($customerchat as $chat) {
			$senderid = $chat->sender;
			if ($senderid == $loggedin) {
				$htmlContent .= "
				<div class='direct-chat-messages d-flex justify-content-end'>
					<div class='direct-chat-text'>
						<p>" . $chat->description . "</p>
						<span>";
		
				$timestamp = strtotime($chat->created_at);
				$formattedDate = date('d, F, Y, h:i a', $timestamp);
				
				$htmlContent .= $formattedDate . "</span>
					</div>
					<div class='direct-chat-img'>
						<img src='" . base_url('/assets/customer_image/') . $this->session->userdata('profile_image') . "' alt=''>
					</div>
				</div>";
			} else {
			   
		
				$htmlContent .= "
				<div class='direct-chat-messages msg-box-2 d-flex'>
					<div class='direct-chat-img'>
						<img src='" . base_url('/assets/artist_image/') . $image . "' alt=''>
					</div>
					<div class='direct-chat-text'>
						<p>" . $chat->description . "</p>
						<span>";
		
				$timestamp = strtotime($chat->created_at);
				$formattedDate = date('d, F, Y, h:i a', $timestamp);
				
				$htmlContent .= $formattedDate . "</span>
					</div>
				</div>";
			}
		}
		
		$htmlContent .= "</div>";
		
		echo $htmlContent;
		
	}

	
	public function get_artist_more_chat()
	{
		$req_id = $this->security->xss_clean($this->input->post('req_id'));
		$artist_id = $this->security->xss_clean($this->input->post('artist_id'));
		$offset = $this->security->xss_clean($this->input->post('offset'));
		
		$customerchat = $this->CustomerModel->getmore_chat($req_id,$offset);
		//print_r($customerchat);
		$loggedin = $this->session->userdata('id');
		$artistImage = $this->CustomerModel->artistImage($artist_id);
		$image = $artistImage[0]->profile_image;
			


		$htmlContent = "<div class='mb-5'>";
		foreach ($customerchat as $chat) {
			$senderid = $chat->sender;
			if ($senderid == $loggedin) {
				$htmlContent .= "
				<div class='direct-chat-messages d-flex justify-content-end'>
					<div class='direct-chat-text'>
						<p>" . $chat->description . "</p>
						<span>";
		
				$timestamp = strtotime($chat->created_at);
				$formattedDate = date('d, F, Y, h:i a', $timestamp);
				
				$htmlContent .= $formattedDate . "</span>
					</div>
					<div class='direct-chat-img'>
						<img src='" . base_url('/assets/customer_image/') . $this->session->userdata('profile_image') . "' alt=''>
					</div>
				</div>";
			} else {
			   
		
				$htmlContent .= "
				<div class='direct-chat-messages msg-box-2 d-flex'>
					<div class='direct-chat-img'>
						<img src='" . base_url('/assets/artist_image/') . $image . "' alt=''>
					</div>
					<div class='direct-chat-text'>
						<p>" . $chat->description . "</p>
						<span>";
		
				$timestamp = strtotime($chat->created_at);
				$formattedDate = date('d, F, Y, h:i a', $timestamp);
				
				$htmlContent .= $formattedDate . "</span>
					</div>
				</div>";
			}
		}
		
		$htmlContent .= "</div>";
		
		echo $htmlContent;
		
	}

	public function appenddiv()
	{
		$div = "<div class='row align-items-center newappend my-3'> 
				<div class='col-12 col-lg-12 description-section'>
				<div class='form-group d-flex position-relative'> 
				<input type='text' class='form-control' id='dataInput' name = 'description[]' placeholder='Add a description...'>
				<div class='edit-section'>
				<button id='adddiv'><i class='bi bi-plus'></i></button>
				</div>
				</div>
				</div>
				</div>";

		echo $div;
	} 


	public function canvas()
	{
		$this->global['title'] = 'My Profile';
		$this->global['page_title'] = 'Edit Profile | Customer | Paint Bending';
		$this->loadViews('canvasview',$this->global);
	}
}