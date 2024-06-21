<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuth extends CI_Controller {






	 public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CustomerModel');
		$this->load->model('ArtistModel');
         $this->load->helper('string');

	}

	
	function index()
	{
	  $this->isLoggedIn();
	}

	
	function isLoggedIn()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
			redirect('signin');
		}
		else
		{
			redirect('request_form');
		}
	}


	function artist()

	{
		$user_role = $this->session->userdata('user_role');
		
		if(!isset($user_role) || $user_role != 2)
		{
			redirect('signin');

		}
		else
		{
			redirect('art_paint_request');
		}
	}

	function admin()
	{
		$user_role = $this->session->userdata('user_role');
		
		if(!isset($user_role) || $user_role != 1)
		{
			redirect('signin');
		}
		else
		{
			redirect('request_form');
		}
	}

	
	public function signin()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
		$this->global['signin_page_name'] = 'signin';
		$this->global['title'] = 'Sign in';
		$this->global['page_title'] = 'Sign in | Paint Bending';


			$this->load->view('signin',$this->global);

		}
		else
		{
			redirect('request_form');
		}
	}

	 public function auth()
	 {

	
		if(isset($_POST))
		{
	            $username = $this->input->post('username');
		        $useremail = $this->input->post('useremail');
		        $userpassword = $this->input->post('userpassword');

				
		        $info = array(
		            'user_name' => $username,
		            'user_email' => $useremail,
		            'user_password' => md5($userpassword),
					'user_role' => 3,
				   
				);	
				
				
                $result = $this->UserModel->checkemail($useremail);
			
			    if($result){
				
					    $this->session->set_flashdata('error','User already exist');
						$this->session->set_flashdata('return','signup');
						$this->global['signup_page_name'] = 'signup';
						$this->global['title'] = 'Sign in';
						$this->global['page_title'] = 'Sign in | Paint Bending';

						redirect('signin',$this->global);
						}
						else{
						$result1 = $this->UserModel-> insertdata($info);
						
						$meta_id = array(
							
							'reg_id' => $result1,
							"profile_image" => "man-icon_jpg.png",
							'first_name' => $username
						);
							
						$customer_id =  $this->CustomerModel-> insertid_meta($meta_id);


						 $email = $useremail;
						
						
			
					
							$data =  array(
								'id'=>$result1,
								'active_token' => random_string('alnum',10)
							);
							
							$user = $this->UserModel->update_activetoken($data);
							if($user){
								   
							$result = base_url() . "active_token/" . $data['active_token'] ;
							$this->send_activation_email($useremail, $result, $username);
							$firstThreeChars = substr($useremail, 0, 2);

							
							$this->session->set_flashdata('success', 'Activation code was just sent to '.$firstThreeChars.'...@gmail.com Please check your email to confirm and activate your account.');
							redirect('signin',$this->global);
						

							}
							
						
					
						}
		}
		else{

		}
	
		 }
		 private function send_activation_email($useremail, $result, $username) {
			$this->load->library('phpmailer_lib');
    
			$mail = $this->phpmailer_lib->load();
			
			$mail->isSMTP();
			$mail->Host     = 'smtp.office365.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'info@good-times.ca';
			$mail->Password = 'Bunny1997$$';
			$mail->SMTPSecure = 'tls';
			$mail->Port     = 587;
			
			$mail->setFrom('info@good-times.ca', 'Paint Bending');
			$mail->addReplyTo('info@good-times.ca', 'Paint Bending');
			
		
			$mail->addAddress($useremail);
			
		
			$mail->Subject = 'Account activation';
			
		
			$mail->isHTML(true);
			
			
			$mailContent = 
		
				'<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="data">
        <table style="margin:0px auto;font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;">
            <tr>
                <td style="background-color: #a6a4d1; text-align: left;">
                    <img src="https://influocial.co/staging-pb/assets/images/logo-3.png" alt="Good Times">
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%;border: 1px solid #ccc;padding: 20px;">
                        <tr>
                            <td style="font-size: 22px;padding: 18px 0px;"><p>Hi '.''.$username.',</p></td>
                        </tr>
                        <tr>
                            <td style="font-size: 22px;"> You recently requested for activation of your <b>Paint Bending</b> account. <br> Click on the link below to proceed</td>
                        </tr>
                        
                        <tr>
                        <tr> <td style="text-align: center;font-size: 22px;">'.$result.'.</td></tr>
                        </tr>
                        <tr>
                            <td style="font-size: 22px;">If you did not request for activation, please ignore this email, or  contact us immediately at <br><a href="#">support@paintbending.com</a></td>
                        </tr>
                        <tr>
                            <td style="font-size: 22px;padding: 18px 0px;">Thank you,</td>
                        </tr>
                        <tr>
                            <td style="font-size: 22px;padding-bottom: 38px;">The Paint Bending Team</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; text-align: center; background-color: #333333;border-collapse: collapse;">
                     
                        <tr>
                            <td style="background-color: #000000;color:#fff;padding:20px 0px; font-size: 12px;">&copy; 2023 Paint Bending, All Rights Reserved.</td>
                            <td style="background-color: #000000;color:#fff;font-size: 12px;"><a href="#" style="color: #fff; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: #fff; text-decoration: none;">Terms and Conditions</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>';
			$mail->Body = $mailContent;
			
			if(!$mail->send()){
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}else{
			}
		}
		
		
	
		 
function artist_register()
{


	$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
		
		$this->global['title'] = 'Sign in';
		$this->global['page_title'] = 'Artist Register | Paint Bending';


			$this->load->view('artist_signup',$this->global);

		}
		else
		{
			redirect('request_form');
		}

}
function artist_auth()
{
	$username = $this->input->post('name');
	$useremail = $this->input->post('email');
	$userpassword = $this->input->post('password');

	
	$info = array(
		'user_name' => $username,
		'user_email' => $useremail,
		'user_password' => md5($userpassword),
		'user_role' => 2,
	);	
	
	
	$result = $this->UserModel->checkemail($useremail);

	if($result){
				
		$this->session->set_flashdata('error','User already exist');
		
		redirect('artist_register');
		
		}
		else{

			
		 $result1 = $this->UserModel-> insertdata($info);

		 
		
		  $meta_id = array(
		  	'reg_id' => $result1,
		 	"profile_image" => "man-icon_jpg.png",
			'artist_fname' => $username
		  );
			
		 $artist_id =  $this->ArtistModel-> insertid_meta($meta_id);
	


		  $email = $useremail;

		

		 	$data =  array(
		 		'id'=>$result1,
		 		'active_token' => random_string('alnum',10)
		 	);
			
		 	$user = $this->UserModel->update_activetoken($data);
		 	if($user){
				   
		 	$result = base_url() . "active_token/" . $data['active_token'] ;
		 	echo $result;
			 $this->send_activation_email($useremail, $result, $username);
			 $firstThreeChars = substr($useremail, 0, 2);
			 $this->session->set_flashdata('success', 'Activation code was just sent to '.$firstThreeChars.'...@gmail.com Please check your email to confirm and activate your account.');
			 redirect('artist_register',$this->global);
		 	}
	
		}
}
function active_token()
{
   $token = $this->uri->segment(2);
   $is_correct = $this->UserModel->checkActivationToken($token);
	if($is_correct)
	{
	 $data = array(
		'active_token'=>"",
		'user_status'=> 1
	
	); 
	$user = $this->UserModel->remove_activetoken($data,$token);
	
	$this->session->set_flashdata('success', 'Account activation completed successfully');

	
		$this->global['title'] = 'Sign in';

		redirect('signin',$this->global);
	} 
	else
	{
	 echo "Sorry, Your token is expired.";
	}
}

public function login()
		 {
				 $email = $this->input->post('email');
				 if(!empty($email) == true)
				 {
				
				 $password = md5($this->input->post('password'));
				
				 $check = $this->UserModel->checkrole($email, $password);
			

				 if ($check && is_array($check)  ) {
				 $role = $check[0]->user_role;
				 $id = $check[0]->id;
				 $result = $this->UserModel->login($id,$role);
				
				 if ($result && is_array($result)  ) {
					if($result['user_status']==1)
					{
           
						$data = array(
							'user_role'
						);
						$sessionArray = array(
							'email' => $email,
							'isLoggedIn' => TRUE,
							'user_role' => $result['user_role'],
							'id' => $result['id'],
							'profile_image' => $result['profile_image'],
							'user_name' => $result['user_name']
						);
				
					 if ($result['user_role'] == 1) {
						 $this->session->set_userdata($sessionArray);
						 $this->session->set_userdata($profile_image);
						 $this->admin();
					 } elseif($result['user_role'] == 2) {
						
						$this->session->set_userdata($sessionArray);
						$this->session->set_userdata($profile_image);
						$this->artist();
						
					 }else
					 {
						$this->session->set_userdata($sessionArray);
						$this->session->set_userdata($profile_image);
				  
						 $this->index();
						 $this->iscustomer();
					 }
					
					}
					 else{
						$sessionArray['user_role'] = false;
						$this->session->set_flashdata('signinError', 'Your account is not active yet.  
						Please check your email and confirm your email address.');
						

						$this->global['signin_page_name'] = 'signin';
						$this->global['title'] = 'Sign in';
						$this->session->set_flashdata('return','signin');
						$this->global['page_title'] = 'Sign in | Paint Bending'; 
						redirect('signin', $this->global);
					 }
					
				 } else {
					 $sessionArray['user_role'] = false;
					 $this->session->set_flashdata('signinError', 'Incorrect email or password');
					 $this->global['signin_page_name'] = 'signin';
					 $this->global['title'] = 'Sign in';
					 $this->session->set_flashdata('return','signin');
					 $this->global['page_title'] = 'Sign in | Paint Bending';
					 redirect('signin', $this->global);
				 }

				}
				else {
					$sessionArray['user_role'] = false;
					$this->session->set_flashdata('signinError', 'Incorrect email or password');
					$this->global['signin_page_name'] = 'signin';
					$this->session->set_flashdata('return','signin');
					$this->global['title'] = 'Sign in';
					$this->global['page_title'] = 'Sign in | Paint Bending';

					redirect('signin', $this->global);
				}
		}
    else{

		redirect('request_form');

        }


		 }
		 
public function forgotPassword()
{
	$isLoggedIn = $this->session->userdata('isLoggedIn');
	if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
	{
		$this->global['title'] = 'Forgot password';
		$this->global['page_title'] = 'Forgot password | Paint Bending';

		$this->load->view('forgotpassword',$this->global);
	}
	else
	{
		redirect('request_form');

	}
}
function resetPasswordUser()
{
    $status = '';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    if ($this->form_validation->run() == FALSE) {
        $this->forgotPassword();
    } else {
        $email = $this->input->post('email');
        $result =  $this->UserModel->checkemail($email);
		$id = $result[0]->id;
		$encoded_email = urlencode($email);
        $data['user_email'] = $email;
		$data['resetTok'] = random_string('alnum',15);
		$save = $this->UserModel->resetPasswordUser($data, $id); 
		if($save)
        {
            $data2['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['resetTok'];
		   $Token = $data2['reset_link'];
			$this->send_passTok_email($email, $Token);

		}
		$this->session->set_flashdata('success','Please check your email to reset your password.');
		$this->global['title'] = 'Forgot password';
		$this->global['page_title'] = 'Forgot password | Paint Bending';

		$this->load->view('forgotpassword',$this->global);
    }
}
private function send_passTok_email($email, $Token) {
	$this->load->library('phpmailer_lib');

	// PHPMailer object
	$mail = $this->phpmailer_lib->load();
	
	// SMTP configuration
	$mail->isSMTP();
	$mail->Host     = 'smtp.office365.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'info@good-times.ca';
	$mail->Password = 'Bunny1997$$';
	$mail->SMTPSecure = 'tls';
	$mail->Port     = 587;
	
	$mail->setFrom('info@good-times.ca', 'Paint Bending');
	$mail->addReplyTo('info@good-times.ca', 'Paint Bending');
	
	// Add a recipient
	$mail->addAddress($email);
	

	
	// Email subject
	$mail->Subject = 'Account activation';
	
	// Set email format to HTML
	$mail->isHTML(true);
	
	// Email body content
	$mailContent = '<!doctype html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="data">
			<table style="margin:0px auto;font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;">
				<tr>
					<td style="background-color: #a6a4d1; text-align: left;">
						<img src="https://influocial.co/staging-pb/assets/images/logo-3.png" alt="Good Times">
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%;border: 1px solid #ccc;padding: 20px;">
							<tr>
								<td style="font-size: 22px;padding: 18px 0px;"><p>Hi '.''.$email.',</p></td>
							</tr>
							<tr>
							
								<td style="font-size: 22px;"> You have requested a password reset for your <b>Paint Bending</b> account.<br> Click on the link  below to proceed</td>
							</tr>
							
							<tr>
							<tr> <td style="text-align: center;font-size: 22px;">'.$Token.'.</td></tr>
							</tr>
							<tr>
								<td style="font-size: 22px;">If you did not request for reset password, please ignore this email, or  contact us immediately at <br><a href="#">support@paintbending.com</a></td>
							</tr>
							<tr>
								<td style="font-size: 22px;padding: 18px 0px;">Thank you,</td>
							</tr>
							<tr>
								<td style="font-size: 22px;padding-bottom: 38px;">The Paint Bending Team</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: 100%; text-align: center; background-color: #333333;border-collapse: collapse;">
						 
							<tr>
								<td style="background-color: #434343;color:#fff;padding:20px 0px; font-size: 12px;">&copy; 2023 Paint Bending, All Rights Reserved.</td>
								<td style="background-color: #434343;color:#fff;font-size: 12px;"><a href="#" style="color: #fff; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: #fff; text-decoration: none;">Terms and Conditions</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
	</html>';
	$mail->Body = $mailContent;
	
	// Send email
	if(!$mail->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}else{
		//echo 'Message has been sent';
	}
}

function resetPasswordConfirmUser()
{
	$isLoggedIn = $this->session->userdata('isLoggedIn');
	if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
	{
  $token = $this->uri->segment(2);

   $is_correct = $this->UserModel->checkActivationDetails( $token);
	if($is_correct)
	{
	 //$data['email'] = $email;
	 $data['resetTok'] =  $token;

		$this->global['title'] = 'Reset password';
		$this->global['page_title'] = 'Reset password | Paint Bending';


	 $this->load->view('resetpassword', array_merge($this->global, $data));
	} 
	else
	{
		echo "Sorry, Your token is expired.";
	}
}
	else
	{
		redirect('request_form');

	}
}
function createPasswordUser()
{
   $token = $this->input->post("token");
	$this->load->library('form_validation');
	$this->form_validation->set_rules('pass','Enter New Password','max_length[20]');
	$this->form_validation->set_rules('cpass','Confirm Password','trim|matches[pass]|max_length[20]');
	if($this->form_validation->run() == FALSE)
	{   
		$this->session->set_flashdata('error','New Password and Confirm Password does not match , Please try again.');	
		
		$this->load->view('forgotpassword');
	}
	else
	{
		    $password = md5($this->input->post('pass'));
		    $cpassword = md5($this->input->post('cpass'));
			 $is_correct = $this->UserModel->checkActivationDetails($token);
			if($is_correct)
			{
				$data = array(
					'user_password'=>$password,
					'resetTok'=>""
					
				); 
				  $this->UserModel->createPasswordUser($token, $data);
				

				 $this->index();
			}
			else
			{
			
				 $this->index();
			}
	}
}
function iscustomer(){
	$data['user_role'] = $this->session->set_userdata('user_role');
	if($user_role == 0){
		$iscustomer = true;
	}
	else{
		$iscustomer = false;
	}
}

}


 