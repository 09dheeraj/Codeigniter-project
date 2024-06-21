<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'PaintBending/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Auth routs-----------------------------------------------------------------------------------------------------

//$route['home'] =  'PaintBending/home';
$route['mission'] =  'PaintBending/mission';
$route['about'] =  'PaintBending/about';
$route['join'] =  'PaintBending/join';
$route['commission'] =  'PaintBending/commission';
$route['contact'] =  'PaintBending/contact';

//Customer-------------------------------------------------------------------------------------------------------
//$route['dashboard'] =  'Customer/dashboard'; 
$route['customer_chatwithartist/(:any)/(:any)'] =  'Customer/customer_chatwithartist'; 
$route['submitchat/(:any)/(:any)'] =  'Customer/submitchat'; 
$route['my_purchases'] =  'Customer/my_purchases'; 
$route['individual_purchase/(:any)'] =  'Customer/individual_purchase'; 
$route['buy/(:any)'] = 'Customer/buyNow';




// Admin ----------------------------------------------------------------------------------------------------
$route['customer'] =  'Admin/customer_list'; 
$route['artist_list'] =  'Admin/artist_list'; 
$route['browse_artist/(:any)'] =  'Admin/browse_artist'; 
$route['admin_profile'] =  'Admin/admin_profile'; 

//Artist-----------------------------------------------------------------------------------------------------
$route['artist_gallery'] =  'Artist/artist_gallery'; 
$route['edit_painting/(:any)'] =  'Artist/edit_painting'; 
$route['art_paint_request'] =  'Artist/painting_request'; 
$route['painting_description/(:any)/(:any)'] =  'Artist/painting_description'; 
$route['purchase_requests'] =  'Artist/purchase_requests'; 
$route['individual_chat'] =  'Artist/individual_chat'; 






//Chat
$route['artist_chatwithCustomer/(:any)/(:any)'] =  'Artist/artist_chatwithCustomer'; 
$route['artistsubmitchat/(:any)/(:any)'] =  'Artist/submitchat'; 
$route['get_more_posts'] = 'Artist/artist_gallery';


//-------------------------------------------------------------------------------------------------------------------




// 2nd phase----------------------------------------------------


$route['signin'] =  'UserAuth/signin';
$route['artist_register'] =  'UserAuth/artist_register';
$route['artist_auth'] =  'UserAuth/artist_auth';
$route['auth'] =  'UserAuth/auth';
$route['login'] =  'UserAuth/login';
$route['forgotpassword'] =  'UserAuth/forgotPassword'; 
$route['resetPasswordUser'] =  'UserAuth/resetPasswordUser'; 
$route['resetPasswordConfirmUser/(:any)'] =  'UserAuth/resetPasswordConfirmUser'; 
$route['createPasswordUser'] =  'UserAuth/createPasswordUser'; 
$route['iscustomer'] =  'UserAuth/iscustomer';
$route['active_token/(:any)'] =  'UserAuth/active_token';
$route['mail'] = 'Email/send';



// 2nd phase customer------------------------------------------------
$route['customer_profile'] =  'Customer/customer_profile'; 
$route['request_form'] =  'Customer/request_form'; 
$route['customer_logout'] =  'Customer/customer_logout'; 
$route['editcustomer_profile'] =  'Customer/editcustomer_profile'; 
$route['artists_list'] =  'Customer/artists_list'; 
$route['artists_list/(:any)'] =  'Customer/artists_list'; 
$route['artist_details/(:any)'] =  'Customer/artist_details'; 
$route['artist_details/(:any)/(:any)'] = 'Customer/artist_details';
$route['individualpainting/(:any)'] =  'Customer/individualpainting'; 
$route['pastsubmittedrequests'] =  'Customer/pastsubmittedrequests'; 
$route['submitrequest_customer/(:any)/(:any)'] =  'Customer/submitrequest_customer'; 
$route['updateprofile_image'] =  'Customer/updateprofile_image'; 
$route['deletecustprofile_image'] =  'Customer/deletecustprofile_image'; 
$route['update_personalinfo'] =  'Customer/update_personalinfo'; 
$route['fetch_info'] =  'Customer/fetch_info'; 
$route['CustomerResetPass'] =  'Customer/CustomerResetPass'; 
$route['contact/(:any)'] = 'Customer/contact_us';
$route['get_more_img'] = 'Customer/artistPaintingsData';
$route['submit_review'] = 'Customer/submit_review';
$route['submit_artistreview'] = 'Customer/submit_artistreview';
$route['artist_selection/(:any)'] = 'Customer/artist_selection';
//request form
$route['submit_Request_form'] = 'Customer/submit_Request_form';
$route['request_details/(:any)'] = 'Customer/script_data';
$route['myrequest_detail/(:any)'] = 'Customer/myrequest_detail';


// artist---------------------------------------
$route['art_submit_form'] = 'Artist/art_submit_form';
$route['random_request'] =  'Artist/random_request'; 
$route['profile_management'] =  'Artist/profile_management'; 
$route['ArtistResetPass'] =  'Artist/ArtistResetPass'; 
$route['update_artistpersonalinfo'] =  'Artist/update_personalinfo'; 
$route['updateartistprofile_image'] =  'Artist/updateprofile_image'; 
$route['deleteprofile_image'] =  'Artist/deleteprofile_image'; 
$route['updatecoverprofile_image'] =  'Artist/updatecoverprofile_image';
$route['insert_randomreq'] =  'Artist/insert_randomreq';
$route['cancel_custreq/(:any)'] =  'Artist/cancel_custreq'; 
$route['add_painting'] =  'Artist/add_painting'; 
$route['addPainting'] =  'Artist/addPainting'; 
$route['updatePainting/(:any)'] =  'Artist/updatePainting'; 
$route['paint_view/(:any)'] = 'Artist/artist_view';
$route['delete_Paint/(:any)'] = 'Artist/delete_Paint/$1';
$route['art_painting_request'] = 'Artist/script_data';
$route['script_data/(:any)'] = 'Artist/script_data';
$route['assign_artist/(:any)'] = 'Artist/assign_to_artist';
$route['generate_random_request'] =  'Artist/generate_random_request'; 
$route['Requested_Painting'] = 'Artist/request_painting';
$route['submit_painting/(:any)'] = 'Artist/artist_submit_painting';
$route['submit_artist_painting/(:any)'] = 'Artist/submit_artist_painting';
$route['artist_submit_painting/(:any)'] = 'Artist/artist_submit_painting';
$route['paintingData'] = 'Artist/paintingData';
$route['deletePainting'] = 'Artist/deletePainting';
$route['Reject_Submitted_Painting/(:any)'] = 'Artist/RejectPainting_artist';
$route['painting_status'] = 'Artist/check_painting_status';
$route['delete_canvas_image/(:any)/(:any)'] = 'Artist/delete_canvas_image';
$route['payment'] = 'Artist/submit_payment';
$route['buy_now/(:any)/(:any)/(:any)'] = 'Artist/buy_now';
$route['transaction'] = "Artist/all_transaction";
$route['random-request'] = "Artist/insert_random_request";

// Review
$route['submitreview/(:any)'] = 'Customer/submitreview';

//Accept painting 
$route['accept_painting/(:any)/(:any)'] = 'Customer/accept_painting';
// Reject painting
$route['reject_painting/(:any)/(:any)'] = 'Customer/reject_painting';
//Approve status
$route['update_approve/(:any)'] = 'Customer/update_approve';
//Shipping Status
$route['shipping_status/(:any)'] = 'Customer/shipping_status';









