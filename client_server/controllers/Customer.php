<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Customer extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('CustomerModel');
		$this->load->model('UserModel');
		$this->load->model('ArtistModel');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	public function customer_profile()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {

			redirect('signin');
		} else {

			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {

				$ID =  $this->session->userdata('id');

				$data['custInfo'] = $this->CustomerModel->fetch_info($ID);
				$this->global['title'] = 'My Profile';
				$this->global['page_title'] = 'My Profile | Customer | Paint Bending';
				$this->loadViews('customer_profile', $this->global, $data);
			} else {
				redirect('request_form');
			}
		}
	}
	public function editcustomer_profile()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');


			if (isset($user_role) || $user_role == 3) {



				$ID =  $this->session->userdata('id');

				$data['custInfo'] = $this->CustomerModel->fetch_info($ID);

				$this->global['title'] = 'My Profile';
				$this->global['page_title'] = 'Edit Profile | Customer | Paint Bending';



				$this->loadViews('editcustomer_profile', $this->global, $data);
			} else {

				redirect('request_form');
			}
		}
	}
	public function artists_list()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role == 2 || $user_role == 3) {
				$title = $this->input->post('hiddentitle');

				$search = $this->input->get('search');

				$config['base_url'] = base_url('Customer/artists_list');
				$config['total_rows'] = $this->CustomerModel->count_total_artists($search);
				// $config['per_page'] = 6;
				//$config['num_links'] = 5;
				//$this->pagination->initialize($config);
				$offset = $this->uri->segment(3);
				// $limit = $config['per_page'];
				if ($search > 0) {
					if (!empty($title)) {
						$data['artistInfo'] = $this->CustomerModel->search_category($title, $offset);
					} else {
						$data['artistInfo'] = $this->CustomerModel->artist_info($search, $offset);
					}
					$this->global['title'] = 'Artists';
					$this->global['page_title'] = 'Artists List | Customer | Paint Bending';

					$this->loadViews('artists_list', $this->global, $data);
				} else {
					$search = '';
					if (!empty($title)) {
						$data['artistInfo'] = $this->CustomerModel->search_category($title, $offset);
					} else {
						$data['artistInfo'] = $this->CustomerModel->artist_info($search, $offset);
					}
					$this->global['title'] = 'Artists';
					$this->global['page_title'] = 'Artists List | Customer | Paint Bending';
					$this->loadViews('artists_list', $this->global, $data);
				}
			} else {

				redirect('request_form');
			}
		}
	}


	public function search_category()
	{

		$category = $this->input->post('title');

		if ($category) {

			$data['artistInfo'] = $this->CustomerModel->search_category($category);
			$this->global['title'] = 'Artists';
			$this->global['page_title'] = 'Artists List | Customer | Paint Bending';
			$this->loadViews('artists_list', $this->global, $data);
		} else {
			redirect('artists_list');
		}
	}


	public function getcategorynamebyid($paintingID)
	{

		return $data = $this->CustomerModel->fetch_category($paintingID);
	}
	public function getpaintingcategorynamebyid($paintingID)
	{

		return $data = $this->CustomerModel->fetch_paintingcategory($paintingID);
	}
	public function getall_category()
	{

		return $data = $this->CustomerModel->fetch_all_category();
	}

	public function artist_details()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {
				$ID = $this->uri->segment(2);


				$data['artistdetails'] = $this->CustomerModel->artist_data($ID);

				$customer_id = $this->session->userdata('id');
				$data['check_review'] = $this->CustomerModel->check_artistreview($customer_id, $ID);

				if ($data['check_review']) {
					$data['check_review'] = 'true';
				} else {
					$data['check_review'] = 'false';
				}
				$this->global['title'] = 'Artist Info';
				$this->global['page_title'] = 'Artist Info | Customer | Paint Bending';



				$this->loadViews('artist_details', $this->global, $data);
			} else {

				redirect('request_form');
			}
		}
	}


	public function submit_artistreview()
	{
		$write_review = $this->input->post('write_review');
		$clicked_stars = $this->input->post('clicked_stars');

		$customer_id = $this->session->userdata('id');
		$artist_id = $this->input->post('artist_id');;

		$check_artistreview = $this->CustomerModel->check_artistreview($customer_id, $artist_id);

		if ($check_artistreview) {

			$this->session->set_flashdata('error', 'Review already submitted.');
			redirect('artist_details/' . $artist_id);
		} else {
			$submit_review = array(
				'customer_id' => $customer_id,
				'artist_id' => $artist_id,
				'description' => $write_review,
				'rating' => $clicked_stars
			);

			$add_artistreview = $this->CustomerModel->add_artistreview($submit_review);

			if ($add_artistreview) {

				$this->session->set_flashdata('success', 'Review submitted successfully.');
				redirect('artist_details/' . $artist_id);
			} else {
				$this->session->set_flashdata('error', 'Failed to submit review.');
				redirect('artist_details/' . $artist_id);
			}
		}
	}



	public function artistPaintingsData($id)
	{
		$offset = $this->input->post('offset');
		$result = $this->CustomerModel->getartistPaintingsData($id, $offset);
		return $result;
	}
	public function individualpainting()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {



				$this->global['title'] = ' ';
				$this->global['page_title'] = 'Ambrosius Bosschaert | Customer | Paint Bending';
				$painting_id = $this->uri->segment(2);
				$data['rand_paintings'] = $this->CustomerModel->random_paintings();

				$data['customer_buypainting'] = $this->CustomerModel->customer_buypainting($painting_id);


				$this->loadViews('individualpainting', $this->global, $data);
			} else {
				redirect('request_form');
			}
		}
	}
	public function buyNow()
	{
		$painting_id = $this->uri->segment(2);

		$data['customer_buypainting'] = $this->CustomerModel->customer_buypainting($painting_id);
		$paint_id = $data['customer_buypainting'][0]->ID;
		$artistID = $data['customer_buypainting'][0]->artistID;
		$painting_price = $data['customer_buypainting'][0]->painting_price;
		$cus_id = $this->session->userdata('id');

		$orders = array(
			"artist_id" => $artistID,
			"cus_id" => $cus_id,
			"painting_id" => $paint_id,
			"price" => $painting_price
		);

		$insert_order = $this->CustomerModel->insert_order($orders);

		if ($insert_order) {
			redirect('my_purchases');
		} else {

			redirect('individualpainting/' . $painting_id);
		}
	}
	public function individual_purchase()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {

				$painting_id = $this->uri->segment(2);


				$this->global['page_title'] = 'Purchased Painting | Customer | Paint Bending';
				$data['purchase_painting'] = $this->CustomerModel->purchase_painting($painting_id);
				$this->global['title'] = $data['purchase_painting'][0]->painting_name;

				$customer_id = $this->session->userdata('id');
				$data['check_reviews'] = $this->CustomerModel->check_review($customer_id, $painting_id);
				$check_cate = $this->CustomerModel->createdAt($this->uri->segment(2));

				if ($check_cate[0]->category == 1) {
					$data['check_req'] = $this->CustomerModel->check_req($painting_id);
				}




				if ($data['check_reviews']) {
					$data['check_reviews'] = 'true';
				} else {
					$data['check_reviews'] = 'false';
				}
				$this->loadViews('individual_purchase', $this->global, $data);
			} else {

				redirect('request_form');
			}
		}
	}


	public function submit_review()
	{
		$write_review = $this->input->post('write_review');
		$customer_id = $this->session->userdata('id');
		$star = $this->input->post('selected_rating');
		$paint_id = $this->input->post('paint_id');


		$check_review = $this->CustomerModel->check_review($customer_id, $paint_id);

		if ($check_review) {
			echo "error: Review already submitted.";
		} else {
			$submit_review = array(
				'customer_id' => $customer_id,
				'painting_id' => $paint_id,
				'description' => $write_review,
				'rating' => $star
			);

			$add_review = $this->CustomerModel->add_review($submit_review);


			if ($add_review) {
				$this->session->set_flashdata('success', 'Review submitted successfully.');
				redirect('individual_purchase/' . $paint_id);
			} else {
				$this->session->set_flashdata('error', 'Failed to submit review.');
				redirect('individual_purchase/' . $paint_id);
			}
		}
	}




	public function pastsubmittedrequests()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role == 2 || $user_role == 3) {
				$this->global['title'] = 'Submitted Requests';
				$this->global['page_title'] = 'Past Requests | Customer | Paint Bending';


				$ID =  $this->session->userdata('id');

				$data['reqdata'] = $this->CustomerModel->fetch_reqdata($ID);
				//echo"<pre>"; print_r($data);
				$this->loadViews('pastsubmittedrequests', $this->global, $data);
			} else {

				redirect('request_form');
			}
		}
	}

	public function getartist_details($id)
	{
		return $this->CustomerModel->artistInfo($id);
	}





	public function submitrequest_customer()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {
				$this->global['title'] = 'Painting Request';
				$this->global['page_title'] = 'Painting Request | Customer | Paint Bending';
				$ID =  $this->uri->segment(3);
				//print_r($ID);
				$data['artistdata'] = $this->CustomerModel->fetch_artistreqdata($ID);
				$this->loadViews('submitrequest_customer', $this->global, $data);
			} else {
				redirect('request_form');
			}
		}
	}
	public function customer_logout()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {

			$this->session->sess_destroy();
			redirect('signin');
		}
	}
	public function dashboard()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$data['title'] = 'Dashboard';

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {

			if ($this->session->userdata('user_role') == "2") {
				$this->global['title'] = 'Dashboard';

				$this->global['page_title'] = 'Dashboard | Artist | Paint Bending';
				$this->loadViews('request_form', $this->global);
			} elseif ($this->session->userdata('user_role') == "1") {
				$this->global['title'] = ' Dashboard';
				$this->global['page_title'] = 'Dashboard | Admin | Paint Bending';
				$this->loadViews('dashboard', $this->global);
			} else {
				$this->global['title'] = 'Dashboard';
				$this->global['page_title'] = 'Dashboard | Customer | Paint Bending';
				$this->loadViews('request_form', $this->global);
			}
		}
	}
	public function request_form()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {
				$this->global['title'] = 'Request a Painting';

				$this->global['page_title'] = 'Request a Painting | Customer | Paint Bending';

				$this->loadViews('request_form', $this->global);
			} else {

				redirect('request_form');
			}
		}
	}
	public function customer_chatwithartist()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {

				$this->global['title'] = 'Chat with Artist';
				$this->global['page_title'] = 'Customer Chat With Artist | Customer | Paint Bending';
				$this->loadViews('customer_chatwithartist', $this->global);
			} else {
				redirect('request_form');
			}
		}
	}

	public function submitchat()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			if (!empty($this->input->post('chat'))) {
				$req_id = $this->uri->segment(2);
				$artist_id = $this->uri->segment(3);
				$chat = $this->input->post('chat');
				$cus_id =  $this->session->userdata('id');

				$data =  array(
					'req_id' => $req_id,
					'sender' => $cus_id,
					'cud_id' => $cus_id,
					'artist_id' => $artist_id,
					'description' => $chat,
				);
				$submitchat = $this->CustomerModel->submitchat($data);
				$this->global['title'] = 'Chat with Artist';
				$this->global['page_title'] = 'Customer Chat With Artist | Customer | Paint Bending';
				$this->loadViews('customer_chatwithartist', $this->global);
			} else {
				$this->global['title'] = 'Chat with Artist';
				$this->global['page_title'] = 'Customer Chat With Artist | Customer | Paint Bending';
				$this->loadViews('customer_chatwithartist', $this->global);
			}
		}
	}

	public function updateprofile_image()
	{
		$config = array(
			'upload_path' => "./assets/customer_image/",
			'allowed_types' => "jpg|png|jpeg|gif",
			'max_size' => "1024000",
		);



		$this->load->library('upload', $config);
		$this->upload->initialize($config);


		if ($this->upload->do_upload('image')) {
			$data['image'] = $this->upload->data('file_name');

			$ID =  $this->session->userdata('id');
			$image_data = array(
				'profile_image' => $data['image']

			);

			$this->CustomerModel->update_image($ID, $image_data);
			$this->session->unset_userdata('profile_image');

			$this->session->set_userdata($image_data);
			$this->session->set_flashdata('success', 'Profile Image Updated Successfully');
			redirect('customer_profile');
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', 'Profile Image size should be jpg , jpeg , png');
			redirect('editcustomer_profile');
		}
	}
	public function deletecustprofile_image()
	{
		$ID =  $this->session->userdata('id');
		$del_img = array(
			'profile_image' => 'man-icon_jpg.png'

		);
		$check = $this->CustomerModel->checkimage($ID, $del_img);

		if ($check) {

			redirect('editcustomer_profile');
		} else {
			$result = $this->CustomerModel->deleteprofile_image($ID, $del_img);

			if ($result) {
				$this->session->unset_userdata('profile_image');
				$this->session->set_userdata($del_img);
				$this->session->set_flashdata('success', 'Profile Image Removed Successfully');
				redirect('customer_profile');
			} else {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', 'Failed to Delete Profile Image!');
			}
		}
	}
	function update_personalinfo()
	{
		$ID =  $this->session->userdata('id');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');

		$address1 = $this->input->post('address1');
		$address2 = $this->input->post('address2');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$zip = $this->input->post('zip');
		$aboutme = $this->input->post('aboutme');

		$update_info = array(
			'first_name' => $fname,
			'last_name' => $lname,
			'mobile' => $mobile,
			'email' => $email,
			'address1' => $address1,
			'address2' => $address2,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'zip' => $zip,
			'about_me' => $aboutme


		);
		$result = $this->CustomerModel->update_personalinfo($ID, $update_info);
		if ($result) {

			$this->session->set_flashdata('success', 'Profile Updated Successfully');
			redirect('customer_profile');
		} else {

			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
			redirect('editcustomer_profile');
		}
	}
	function CustomerResetPass()
	{
		$this->form_validation->set_rules('pass', 'New Password', 'required|max_length[20]');
		$this->form_validation->set_rules('cpass', 'Confirm Password', 'trim|required|matches[pass]|max_length[20]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('passworderror', 'Passwords does not Match');
			//echo " wrong";
			$ID =  $this->session->userdata('id');
			$data['custInfo'] = $this->CustomerModel->fetch_info($ID);

			$this->global['title'] = 'My Profile';
			$this->loadViews('editcustomer_profile', $this->global, $data);
		} else {
			$ID =  $this->session->userdata('id');
			$password = md5($this->input->post('pass'));
			$cpassword = md5($this->input->post('cpass'));

			$data = array(
				'user_password' => $password,

			);
			$this->CustomerModel->CustomerResetPass($ID, $data);

			$this->session->set_flashdata('success', 'Password Updated Successfully');
			$data['custInfo'] = $this->CustomerModel->fetch_info($ID);
			$this->global['title'] = 'My Profile';

			redirect('customer_profile', $this->global);
		}
	}

	public function my_purchases()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {

				$this->global['title'] = 'My Purchases';
				$customer_id = $this->session->userdata('id');
				$data['purchases_painting'] = $this->CustomerModel->purchases_painting($customer_id);
				$this->global['page_title'] = 'My Purchases | Customer | Paint Bending';

				$this->loadViews('my_purchases', $this->global, $data);
			} else {

				redirect('request_form');
			}
		}
	}





	public function totalpainting($id)
	{

		return $result = $this->CustomerModel->TotalPAnting($id);
	}

	public function getRating_review($id)
	{

		return $result = $this->CustomerModel->getRating_review($id);
	}


	public function Artistall_DAta()
	{

		return $result = $this->CustomerModel->Artistall_DAta();
	}
	public function getreviewnumber($artistID)
	{

		$result['five'] = $this->CustomerModel->fivestar($artistID);

		$result['four'] = $this->CustomerModel->fourstar($artistID);

		$result['three'] = $this->CustomerModel->threestar($artistID);

		$result['two'] = $this->CustomerModel->twostar($artistID);

		$result['one'] = $this->CustomerModel->onestar($artistID);
		return $result;
	}
	public function Totalpaint($id)
	{

		return $result = $this->CustomerModel->TotalPAnting($id);
	}

	public function getindividualreview($id)
	{

		return $result = $this->CustomerModel->getindividualreview($id);
	}

	public function customer_DATA($id)
	{

		$result = $this->CustomerModel->customer_DATA($id);

		return $result;
	}
	public function getindividualRating($id, $artistID)
	{

		$result = $this->CustomerModel->getindividualRating($id, $artistID);
		return $result;
	}


	public function getloggedin_name($id)
	{
		$getloggedin_name = $this->CustomerModel->getloggedin_name($id);
		return $getloggedin_name;
	}

	public function getcustomerchat($id)
	{
		$getcustomerchat = $this->CustomerModel->getcustomerchat($id);
		return $getcustomerchat;
	}
	public function artistImage($id)
	{
		$artistImage = $this->CustomerModel->artistImage($id);
		return $artistImage;
	}

	public function get_artist_name($id)
	{
		return $get_artist_name = $this->CustomerModel->get_artist_name($id);
	}
	public function getpainting_review($id)
	{

		return $result = $this->CustomerModel->getpainting_review($id);
	}
	public function getartist_review($id)
	{

		return $result = $this->CustomerModel->getartist_review($id);
	}
	public function totalreviews($id)
	{

		return $result = $this->CustomerModel->totalreviews($id);
	}

	public function getmore_images()
	{
		$artist_id = $this->input->post('artist_id');
		$limit = $this->input->post('limit');


		$TotalPAnting = $this->CustomerModel->TotalPAnting($artist_id);


		$artistPaintings = $this->CustomerModel->getmore_gallery_images($artist_id, $limit);



		$html = "<div class=''>
              <div class='gallery-container-section mt-4 posts-container'>";
		if (isset($artistPaintings)) {

			foreach ($artistPaintings as $row) {
				$fullname = $row->painting_name;
				$maxLength = 38;
				if (strlen($fullname) > $maxLength) {
					$shortenedText = substr($fullname, 0, $maxLength) . '...';
				} else {
					$shortenedText = $fullname;
				}
				$images = explode(',', $row->painting_image);
				foreach ($images as $img) {

					$image =  base_url('/assets/artist_paintings/') . trim($img);


					break;
				}
				$html .= "<div class='box'>
                    <div class='border-0 bg-transparent' data-bs-toggle='modal' data-bs-target='#exampleModal-{$row->ID}'>
					
                  
                                    
                                        <img class='w-100' src=" . $image . "
                                            alt=" . ">
                                   
                                 
                </div>
                <div class=' img-box-text justify-content-between'>
				   <div class='d-none'></div>



				   
				   <p class='d-flex  justify-content-between px-2'><span> $shortenedText </span> <small>$ {$row->painting_price} </small></p>
				   <h6 class='ps-2'> Painting: {$row->painting_size}</h6>
			   </div>
            </div>";

				if (isset($row->ID)) {
					$totalreviews = $this->CustomerModel->totalreviews($row->ID);
					if ($totalreviews['total'] > 0) {
						$totalDisplay = $totalreviews['total'];
					} else {
						$totalDisplay = "0";
					}

					$getpainting_review =  $this->CustomerModel->getpainting_review($row->ID);
					if ($getpainting_review['totalreview'] > 0) {
						$totalpaintingreviewDisplay = $getpainting_review['totalreview'];
					} else {
						$totalpaintingreviewDisplay = "0";
					}


					$paintingstars = round($getpainting_review['avgrat']);
					$rempaintingstar = 5 - $paintingstars;
				}



				if (isset($row->painting_description)) {
					$description = $row->painting_description;
					$maxLength = 200;
					if (strlen($description) > $maxLength) {
						$shortenedDescription = substr($description, 0, $maxLength) . "...";
					} else {
						$shortenedDescription = $description;
					}
					$shortenedDescription;
				}

				$html .= "<div class='modal fade' id='exampleModal-{$row->ID}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered modal-xl'>
        <div class='modal-content'>

            <div class='modal-body'>
                <div class='text-end'>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                        <img src='" . base_url() . "assets/images/close (4).png' alt=''>
                    </button>
                </div>

                <h2 class='text-center painting-heading'>{$row->painting_name}</h2>
                <img style='height: 700px;' class='w-100 pb-4' src=" . $image . ">

                <p class='painting-para'>Painting  : {$row->painting_size}</p>
                <p class='painting-para'>$shortenedDescription</p>

                <div class='review-info'>
                    <span class='star-icons align-top ps-3'>";

				for ($i = 1; $i <= $paintingstars; $i++) {
					$html .= '<i class="bi bi-star-fill pe-2"></i>';
				}
				for ($i = 1; $i <= $rempaintingstar; $i++) {
					$html .= '<i class="bi bi-star pe-2"></i>';
				}


				$html .=   "<b class='ps-3 align-bottom text-dark'>({$totalDisplay})</b>
                    </span>
                </div>
                <h1>$ {$row->painting_price}</h1>

                <div class='modal-btn text-center'>
                    <a href='" . base_url('individualpainting/') . "{$row->ID}' class='btn btn-primary'>Buy Now</a>
                </div>
            </div>

        </div>
    </div>
</div>";
			}
		}

		$html .= "</div>
    </div>";
		$data = array(
			'html' => $html,
			'totalPainting' => $TotalPAnting->paintings
		);
		$jsonData = json_encode($data);
		header('Content-Type: application/json');
		echo $jsonData;
	}



	public function painting_data($id)
	{
		return $result = $this->CustomerModel->painting_data($id);
	}
	public function artist_name($id)
	{
		return $result = $this->CustomerModel->artist_name($id);
	}

	public function getRating_review_painting($id)

	{

		return $result = $this->CustomerModel->getRating_review_painting($id);
	}
	public function individualpainting_review($id)

	{

		$result = $this->CustomerModel->individualpainting_review($id);
		return $result;
		//print_r($result);
	}
	public function TotalPantingReview($id)

	{

		$result = $this->CustomerModel->TotalPantingReview($id);
		return $result;
	}
	public function paintreviewnumber($ID)
	{

		$result['five'] = $this->CustomerModel->paintingfivestar($ID);

		$result['four'] = $this->CustomerModel->paintingfourstar($ID);

		$result['three'] = $this->CustomerModel->paintingthreestar($ID);

		$result['two'] = $this->CustomerModel->paintingtwostar($ID);

		$result['one'] = $this->CustomerModel->paintingonestar($ID);

		return $result;
	}
	public function individualcustomerReview($id)
	{

		return $result = $this->CustomerModel->individualcustomerReview($id);
	}
	public function individualPaintingRating($id, $paintingID)
	{

		$result = $this->CustomerModel->individualPaintingRating($id, $paintingID);
		return $result;
	}
	public function createdAt($paintingID)
	{

		$result = $this->CustomerModel->createdAt($paintingID);
		return $result;
	}
	public function Artistname($artistID)
	{

		$result = $this->CustomerModel->artist_data($artistID);
		return $result;
	}
	public function contact_us()
	{
		$artist_id = $this->uri->segment(2);
		$customer_id = $this->session->userdata('id');
		$customer_name = $this->input->post('cust_name');
		$customer_email = $this->input->post('cust_email');
		$message = $this->input->post('cust_msg');
		$data = array(
			'customer_ID' => $customer_id,
			'artist_ID' => $artist_id,
			'customer_name' => $customer_name,
			'customer_email' => $customer_email,
			'message' => $message

		);
		$contact_us = $this->CustomerModel->contect_us($data);
		if ($contact_us) {

			$this->session->set_flashdata('success', 'Your message has been sent successfully.');
			redirect('artist_details/' . $artist_id);
		} else {
			$this->session->set_flashdata('error', 'Your message has not been sent.');
			redirect('artist_details/' . $artist_id);
		}
	}

	public function submit_Request_form()
	{

		$description = implode(",", $this->input->post('description'));
		$IMAGEDATA =  $this->input->post('IMAGEDATA');

		$directoryPath = './assets/canvas_image';
		$randomName = uniqid();
		$imagePath = $directoryPath . '/' . $randomName . '.jpg';
		$base64Image = str_replace("data:image/png;base64,", "", "$IMAGEDATA");
		$base64Image = str_replace('"', "", "$base64Image");
		$binaryImage = base64_decode($base64Image);

		if ($binaryImage !== false) {
			if (file_put_contents($imagePath, $binaryImage) !== false) {
			} else {
			}
		} else {
		}
		$tag = $this->input->post('tag');
		$painting_title = $this->input->post('painting_title');
		$userfile = $this->input->post('userfile');
		$script = $this->input->post('lineData');

		$digits = 5;
		$genrate_token =  str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		$frame_upload_success = array();
		//---------------------------------------------------------------------------------------------



		//$canvasimage =  explode("HR2023",$this->input->post('canvasimage'));
		// 	$canvasimage = $this->input->post('canvasimage');
		// 	echo "<pre>";
		// 	print_r($canvasimage);
		// $result = substr($canvasimage, 0, 4);
		// echo"<pre>";
		// print_r($result);
		//foreach($canvasimage as $row)
		//{
		// print_r($row);
		// $base64Image = str_replace("data:image/jpeg;base64,","","$row");
		// $base64Image = str_replace("data:image/png;base64,","","$base64Image");
		// $base64Image = str_replace('"' ,"" ,"$base64Image");
		//print_r($base64Image);
		// $data = array(
		//   "images"=> $base64Image
		// );
		// $insert_image_base64 = $this->CustomerModel->insert_image_base64($data);
		//$base64Image = str_replace('"' ,"" ,"$base64Image");
		// print_r($base64Image);
		//}
		//-----------------------------------------------------------------------------------------------
		if (!empty($_FILES)) {
			$config['upload_path'] = './assets/request_painting/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 2048;


			$this->load->library('upload', $config);


			foreach ($_FILES['userfile']['name'] as $key => $value) {
				$_FILES['uploaded_file']['name'] = $_FILES['userfile']['name'][$key];
				$_FILES['uploaded_file']['type'] = $_FILES['userfile']['type'][$key];
				$_FILES['uploaded_file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$key];
				$_FILES['uploaded_file']['error'] = $_FILES['userfile']['error'][$key];
				$_FILES['uploaded_file']['size'] = $_FILES['userfile']['size'][$key];

				$this->upload->initialize($config);

				if ($this->upload->do_upload('uploaded_file')) {
					$frame_upload_success[] = $this->upload->data('file_name');
				} else {
					$error = array('error' => $this->upload->display_errors());
				}
			}
		}


		//-------------------------------------------------------------------------------------------------------------
		// Upload Reference Video
		if (!empty($_FILES)) {
			$this->load->helper('string');
			$config['upload_path'] = './assets/reference_video/';
			$configVideo['upload_path'] = './assets/reference_video/';
			$configVideo['max_size'] = '102400';
			$configVideo['allowed_types'] = 'mp4';
			$configVideo['overwrite'] = FALSE;
			$configVideo['remove_spaces'] = TRUE;

			$original_filename = $_FILES['videoupload']['name'];
			$configVideo['file_name'] = $original_filename;

			$this->load->library('upload', $configVideo);
			$this->upload->initialize($configVideo);

			if (!$this->upload->do_upload('videoupload')) {
				# Upload Failed
				$this->session->set_flashdata('error', $this->upload->display_errors());
			} else {
				# Upload Successfull
				$url = './assets/reference_video/' . $original_filename;
			}
		}
		$cus_id = $this->session->userdata('id');

		$check_token = $this->CustomerModel->check_token($genrate_token);
		
		if($check_token)
		{

			$digits = 5;
			$genrate_tokenrandom =  str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

			$Request_form = array(
				"customer_id" => $this->session->userdata('id'),
				"tag" => $tag,
				"painting_title" => $painting_title,
				"script" => $script,
				"token" => $genrate_tokenrandom,
				"canvas_image" => $randomName . ".jpg"
	
			);

		}else{

			$Request_form = array(
				"customer_id" => $this->session->userdata('id'),
				"tag" => $tag,
				"painting_title" => $painting_title,
				"script" => $script,
				"token" => $genrate_token,
				"canvas_image" => $randomName . ".jpg"
	
			);
	
		}


		$submit_Request_form = $this->CustomerModel->submit_Request_form($Request_form);
      
				// canvas all images
				$image_name = $this->input->post('image_name');
				foreach ($image_name as $row) {
					// print_r($row);
				}

				$canvasimage =  $this->input->post('canvasimage');
				
				$k = 0;
				foreach ($canvasimage as $row) {
					$base64Image = str_replace("data:image/jpeg;base64,", "", "$row");
					$base64Image = str_replace("data:image/png;base64,", "", "$base64Image");
					$base64Image = str_replace('"', "", "$base64Image");
					// print_r($base64Image);
					$cus_id =  $this->session->userdata('id');
					$data = array(
						"cus_id" => $submit_Request_form,
						"images" => $base64Image,
						"image_name" => $image_name[$k]
					);
					$insert_image_base64 = $this->CustomerModel->insert_image_base64($data);
					$k++;
				}
		if ($submit_Request_form) {
			redirect('request_details/' . $submit_Request_form);
		} else {
			redirect('request_form');
		}
	}

	public function script_data()
	{

		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {

			redirect('signin');
		} else {

			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role != 2) {
				$id = $this->uri->segment(2);
				$data['request_data'] = $this->CustomerModel->script_data($id);

				$this->global['title'] = 'Here Is My Code';
				$this->global['page_title'] = 'Request Detail | Customer | Paint Bending';

				$this->loadViews('request_details', $this->global, $data);
			} else {
				//print_r("hello");
				redirect('request_form');
			}
		}
	}
	public function artist_selection()
	{
		$reg_id = $this->uri->segment(2);
		$artist_select = ($this->input->post('checkoption'));

		//print_r($artist_select);

		$fetch_request_data = $this->CustomerModel->fetch_request_data($reg_id);
		// echo "<pre>";
		// print_r($fetch_request_data);
		$cus_id = $fetch_request_data[0]->customer_id;
		$painting_title = $fetch_request_data[0]->painting_title;
		$tag = $fetch_request_data[0]->tag;
		$canvas_image = $fetch_request_data[0]->canvas_image;
		$script = $fetch_request_data[0]->script;
		$temp_id = $fetch_request_data[0]->id;

		//foreach ($artist_select as $artist_id) {
		//print_r($artist_id);
		$data = array(
			"tem_paint_id" => $temp_id,
			"artist_Id" => $artist_select,
			"customer_id" => $cus_id,
			"painting_title" => $painting_title,
			"tag" => $tag,
			"script" => $script,
			"canvas_image" => $canvas_image,
			"selected_artist" => $artist_select
			//	"selected_artist" => implode(",", ($this->input->post('checkoption')))

		);

		//echo "<pre>";print_r($data);
		$insert_temp_to_req = $this->CustomerModel->insert_temp_to_req($data);

		$artist = array(
			"selected_artist" => $artist_select
		);

		$update_artist_in_temp_req = $this->CustomerModel->update_artist_in_temp_req($reg_id, $artist);
		//	}

		redirect('pastsubmittedrequests');
	}
	public function myrequest_detail()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('signin');
		} else {
			$user_role = $this->session->userdata('user_role');

			if (!isset($user_role) || $user_role == 2 || $user_role == 3) {

				$this->global['title'] = 'My Request Detail';
				$this->global['page_title'] = 'My Request Detail | Customer | Paint Bending';
				$id = $this->uri->segment(2);
				$data['request_data'] = $this->CustomerModel->allreq_data($id);
				$this->loadViews('myrequest_detail', $this->global, $data);
			} else {
				redirect('request_form');
			}
		}
	}
	public function selected_artist_data($artistID)
	{

		$result = $this->CustomerModel->artistInfo($artistID);
		return $result;
	}

	public function getartist_name($id)
	{
		return	$result = $this->CustomerModel->getartist_name($id);
	}
	public function getcust_name($id)
	{
		return	$result = $this->CustomerModel->getcust_name($id);
	}
	public function check_role($id)
	{
		return	$result = $this->CustomerModel->check_role($id);
	}


	public function submitimgdata($temp_id, $id)
	{
		return	$result = $this->CustomerModel->submitimgdata($temp_id, $id);
	}

	public function submitreview()
	{
		
		$tem_paint_id =  $this->uri->segment(2);
		$review =  $this->input->post('write_review');
		$artistID =  $this->input->post('artist_id');
		$clicked_stars =  $this->input->post('stars');

		$data = array(
			"reviews" => $review,
			"rating" => $clicked_stars

		);
		//echo "<pre>";print_r($data);

		$submitreview = $this->CustomerModel->submitreview($artistID, $data, $tem_paint_id);
	   $getRating_reviewartist = $this->ArtistModel->getRating_reviewartist($artistID);

	   $reviews =  $getRating_reviewartist['totalreview'];
	   $rating = $getRating_reviewartist['avgrat'];
	  
	   
	   $result = array(
		'rating'=> $rating,
		'reviews' => $reviews,
	   );
	   
	   $ratingString = (string) $result['rating'];
	   $reviewsString = (string) $result['reviews'];


	   $update_rating_artistmeta = $this->ArtistModel->update_rating($artistID, $ratingString);

		if ($submitreview) {
			//$this->session->set_flashdata('success', 'Reviews submitted successfully.');
			redirect('myrequest_detail/' . $tem_paint_id);
		} else {
			//$this->session->set_flashdata('error', 'Reviews submitted successfully.');
			redirect('myrequest_detail/' . $tem_paint_id);
		}
	}

	public function canvasview()
	{

		$this->global['title'] = 'Here Is My Code';
		$this->global['page_title'] = 'Request Detail | Customer | Paint Bending';
		$this->loadViews('canvasview', $this->global);
	}

	public function copy_request_form()
	{

		$this->global['title'] = 'Here Is My Code';
		$this->global['page_title'] = 'Request Detail | Customer | Paint Bending';
		$this->loadViews('copy_request_form', $this->global);
	}
	public function copy2()
	{
		//print_r("hello");
		$this->global['title'] = 'Here Is My Code';
		$this->global['page_title'] = 'Request Detail | Customer | Paint Bending';
		$this->loadViews('copy2', $this->global);
	}

	public function canvas_image_data($cus_id)
	{
		return $canvas_image_data = $this->CustomerModel->canvas_image_data($cus_id);
	}
	public function painting_demensions($artist_id)
	{
		return $result = $this->CustomerModel->painting_demensions($artist_id);
	}

	public function get_artist_id($temp_id)
	{
		return $get_artist_id = $this->CustomerModel->get_artist_id($temp_id);
	}

	public function accept_painting()
	{
		$accept = $this->uri->segment(2);
		$temp_id = $this->uri->segment(3);
		$data = array(
          "tem_paint_id" => $temp_id,
		  "painting_status" => $accept
		);

	   $accept_painting = $this->CustomerModel->accept_painting($temp_id, $data);

	   $update_accept_painting = array(
		"painting_status" => $accept
	  );
	  $accept_painting = $this->CustomerModel->update_accept_painting($temp_id, $update_accept_painting);

	   redirect('submit_painting/'.  $this->uri->segment(3));
	}

	public function reject_painting()
	{
		$reject = $this->uri->segment(2);
		$temp_id = $this->uri->segment(3);

		$data = array(
          "tem_paint_id" => $temp_id,
		  "painting_status" => $reject
		);

	   $reject_painting = $this->CustomerModel->reject_painting($temp_id, $data);
	   $update_accept_painting = array(
		"painting_status" => $reject
	  );
	  $accept_painting = $this->CustomerModel->update_accept_painting($temp_id, $update_accept_painting);
	   redirect('submit_painting/'.  $this->uri->segment(3));
	}

	public function check_status($temp_id)
	{
		return $check_status = $this->CustomerModel->check_status($temp_id);
	}

	public function check_status_in_paitng_req($temp_id)
	{
		return $check_status = $this->CustomerModel->check_status_in_paitng_req($temp_id);
	}

	public function get_category_name($cat_id)
	{
		return $get_category_name = $this->CustomerModel->get_category_name($cat_id);
	}


	public function getbase_pricePAINTING($id)
	{
		return $result = $this->CustomerModel->getbase_pricePAINTING($id);
		//  $result->painting_price;
	}

	public function get_created_at($id)
	{
		return $get_created_at = $this->CustomerModel->get_created_at($id);
		//  $result->painting_price;
	}
	public function get_num_rows_chat($id)
	{
		return $get_num_rows_chat = $this->CustomerModel->get_num_rows_chat($id);
	}

	public function get_create_date($ID)
	{
		return $result = $this->CustomerModel->get_create_date($ID);
	}

	public function reject_artist_name($ID)
	{
		return $result = $this->CustomerModel->reject_artist_name($ID);
	}

	public function reject_artistNAME($ID)
	{
		return $result = $this->CustomerModel->reject_artistNAME($ID);
	}

	public function check_statusTEMP($ID)
	{
		return $result =  $this->CustomerModel->check_statusTEMP($ID);
	}

	public function update_approve()
	{
		$temp_id =  $this->uri->segment(2);
		$data =array(
           "approve" =>"1"
		);

		 $update_approve =  $this->CustomerModel->update_approve($temp_id, $data);
		 redirect('myrequest_detail/'.$temp_id);
	}

	public function check_approve_status($id)
	{
		return $check_approve_status =  $this->CustomerModel->check_approve_status($id);
	}

	public function shipping_status()
	{
		$temp_id = $this->uri->segment(2);
		
		$track_num = $this->input->post('track_num');
		$shipping = $this->input->post('shipping');
		

		 $data = array(
			    "track_num" => $track_num,
                "shipping_status" => $shipping
		);

		$update_shipping_status =  $this->CustomerModel->update_shipping_status($temp_id, $data);
		redirect('submit_painting/'.$temp_id);
	}

	public function check_shipping_status($temp_id)
	{
		return $check_shipping_status =  $this->CustomerModel->check_shipping_status($temp_id);
	}


	
}
