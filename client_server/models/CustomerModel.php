<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerModel extends CI_model
{



    function update_image($ID, $image_data)
    {


        $this->db->where('reg_id', $ID);
        $result = $this->db->update('customer_meta', $image_data);
        // echo $this->db->last_query();	
        return $result;
    }
    function insertid_meta($meta_id)
    {

        $this->db->insert('customer_meta', $meta_id);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }
    function deleteprofile_image($ID, $del_img)
    {


        $this->db->where('reg_id', $ID);
        $result = $this->db->update('customer_meta', $del_img);
        // $this->db->last_query();	
        return $result;
    }
    function update_personalinfo($ID, $update_info)
    {
        $this->db->where('reg_id', $ID);
        $result = $this->db->update('customer_meta', $update_info);
        //echo $this->db->last_query();
        //die;	
        return $result;
    }
    function fetch_info($ID)
    {
        $this->db->select('*');
        $this->db->from('customer_meta');
        $this->db->where('reg_id', $ID);
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        // echo $this->db->last_query();      
        return $result;
    }

    function CustomerResetPass($ID, $data)
    {
        $this->db->where('id', $ID);
        $result = $this->db->update('users', $data);
        // $this->db->last_query();	
        return $result;
    }

    public function count_total_artists($search)
    {
        $this->db->select('users.id');
        $this->db->from('users');
        $this->db->join('artist_meta', 'users.id = artist_meta.reg_id', 'left');
        $this->db->where('user_status', 1);
        $this->db->where('user_role', 2);
        if ($search != '') {
            $this->db->like('artist_fname', $search);
        }
        //  echo $this->db->last_query(); 
        return $this->db->count_all_results();
    }

    function artist_info($search, $offset)
    {
        $this->db->distinct();
        $this->db->select('users.*, artist_meta.*');
        $this->db->from('users');
        $this->db->order_by("rating", "desc");
        $this->db->join('artist_meta', 'users.id = artist_meta.reg_id', 'left');
        $this->db->where('user_status', 1);
        $this->db->where('user_role', 2);
        //$this->db->where('reg_id' != $id);

        if ($search != '') {
            $this->db->like('artist_fname', $search);
        }
        $this->db->limit($offset);
        $query = $this->db->get();
        // echo $this->db->last_query();      

        return $query->result();
    }
    function artist_data($ID)
    {
        $this->db->select('*');
        $this->db->from('artist_meta');
        $this->db->where('reg_id', $ID);
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        //echo $this->db->last_query();      
        return $result;
    }
    function checkimage($ID, $del_img)
    {
        $this->db->select('profile_image');
        $this->db->from('customer_meta');
        $this->db->where('reg_id', $ID);
        $this->db->where('profile_image', $del_img['profile_image']);

        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check;
    }
    function fetch_reqdata($ID)
    {

        $this->db->select('*');
        $this->db->from('temp_painting_request');
        $this->db->where('customer_id', $ID);
        $this->db->order_by("date", "desc");
        // $this->db->group_by('tem_paint_id');
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        //echo $this->db->last_query();      
        return $result;
    }

    function fetch_artistreqdata($ID)
    {


        $this->db->select('*');
        $this->db->from('painting_requests');
        $this->db->where('artist_id', $ID);
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        //echo $this->db->last_query();      
        return $result;
    }

    function artistInfo($artistID)
    {
        $this->db->select('*');
        $this->db->from('artist_meta');
        $this->db->where('reg_id', $artistID);

        $this->query =  $this->db->get();
        //echo $this->db->last_query();

        return $this->query->result();
    }



    public function totalpainting($id)
    {

        $this->db->select('*');
        $this->db->from('painting_requests');
        $this->db->where('artist_Id', $id);
        $this->db->where('req_status', 1);
        $query =  $this->db->get();
        return  $result = $query->num_rows();
    }

    // public function getRating_review($id)
    // {

    //     $this->db->select_avg('rating', 'avgrat');
    //     $this->db->select('COUNT(ID) as totalreview');
    //     $this->db->where('artist_Id', $id);
    //     $this->db->where('sub_by_artist!=', ' ');
    //     $this->db->where('rating!=', ' ');

    //     $query = $this->db->get('painting_requests');
    //    // $this->db->order_by('rating', 'DESC');
    //     $result = $query->row();
    //     $avgrat = $result->avgrat;
    //     $totalreview = $result->totalreview;
    //     //echo  $this->db->last_query(); 
    //     return array('avgrat' => $avgrat, 'totalreview' => $totalreview);
    // }
    public function getRating_review($id)
    {
        $this->db->select_avg('rating', 'avgrat');
        $this->db->select('COUNT(ID) as totalreview');
        $this->db->where('artist_Id', $id);
        $this->db->where('sub_by_artist !=', ' ');
        $this->db->where('rating !=', ' ');
       //$this->db->where('rating IS NOT NULL');
        $this->db->from('painting_requests');
        $this->db->order_by('rating', 'DESC');
        $query = $this->db->get();
        $result = $query->row();
        $avgrat = $result->avgrat;
        $totalreview = $result->totalreview;
        //echo  $this->db->last_query(); 
        return array('avgrat' => $avgrat, 'totalreview' => $totalreview);
    }


    public function Artistall_DAta()
    {

        $this->db->select('users.*, artist_meta.*');
        $this->db->from('users');
        $this->db->join('artist_meta', 'users.id = artist_meta.reg_id', 'left');
        $this->db->where('user_status', 1);
        $this->db->where('user_role', 2);
        $query = $this->db->get();
        return $query->result();
    }


    function fetch_category($paintingID)
    {
        $this->db->select('title');
        $this->db->from('artist_category');
        $this->db->where('ID ', $paintingID);

        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        return $this->query->result();
    }
    function fetch_paintingcategory($paintingID)
    {
        $this->db->select('title');
        $this->db->from('painting_category');
        $this->db->where('ID ', $paintingID);

        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        return $this->query->result();
    }


    function fetch_all_category()
    {
        $this->db->select('*');
        $this->db->from('artist_category');
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        return $this->query->result();
    }
    function fivestar($artistID)
    {
        $this->db->select('COUNT(id) as five');
        $this->db->from('artist_reviews');
        $this->db->where('artist_id ', $artistID);
        $this->db->where('rating ', 5);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->five;
    }
    function fourstar($artistID)
    {
        $this->db->select('COUNT(id) as four');
        $this->db->from('artist_reviews');
        $this->db->where('artist_id ', $artistID);
        $this->db->where('rating ', 4);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();

        $reviews = $this->query->result();
        return $reviews[0]->four;
    }
    function threestar($artistID)
    {
        $this->db->select('COUNT(id) as three');
        $this->db->from('artist_reviews');
        $this->db->where('artist_id ', $artistID);
        $this->db->where('rating ', 3);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->three;
    }
    function twostar($artistID)
    {
        $this->db->select('COUNT(id) as two');
        $this->db->from('artist_reviews');
        $this->db->where('artist_id ', $artistID);
        $this->db->where('rating ', 2);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->two;
    }
    function onestar($artistID)
    {
        $this->db->select('COUNT(id) as one');
        $this->db->from('artist_reviews');
        $this->db->where('artist_id ', $artistID);
        $this->db->where('rating ', 1);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->one;
    }
    public function TotalPAnting($id)
    {

        $this->db->select('COUNT(ID) as paintings');
        $this->db->from('painting_requests');
        $this->db->where('artist_Id', $id);
        $this->db->where('sub_by_artist!=', " ");

        $query =  $this->db->get();
        //echo $this->db->last_query();
        $result =  $query->row();
        return $result;
    }

    public function search_category($title)

    {


        $this->db->select('users.*, artist_meta.*');
        $this->db->from('users');
        $this->db->join('artist_meta', 'users.id = artist_meta.reg_id', 'left');
        $this->db->where('user_status', 1);
        $this->db->where('user_role', 2);
       // $this->db->order_by("rating", "DESC");
        // $this->db->where('category', $category);
        $this->db->where('find_in_set("' . $title . '", category) <> 0');
        $query = $this->db->get();
        // echo $this->db->last_query();      
        return $query->result();
    }

    public function getindividualreview($id)
    {

        $this->db->select('*');
        $this->db->from('artist_reviews');
        $this->db->where('artist_id', $id);
        $query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $query->row();

        return  $query->result();
    }

    public function customer_DATA($id)
    {

        $this->db->select('*');
        $this->db->from('customer_meta');
        $this->db->where('reg_id', $id);
        $query =  $this->db->get();
        //echo $this->db->last_query();  

        return  $query->result();
    }
    public function getindividualRating($id, $artistID)
    {

        $this->db->select('rating');
        $this->db->where('customer_id', $id);
        $this->db->where('artist_id', $artistID);
        $query = $this->db->get('artist_reviews');
        //echo $this->db->last_query();  
        $result = $query->row();
        return  $query->result();
    }

    public function submitchat($data)
    {
        $this->db->insert('chat', $data);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }

    public function getcustomerchat($req_id)
    {
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where('req_id', $req_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        $result = $query->result();
        $result = array_reverse($result);
        return $result;
    }

    public function getloggedin_name($id)
    {
        $this->db->select('user_name');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function artistImage($id)
    {
        $this->db->select('profile_image');
        $this->db->from('artist_meta');
        $this->db->where('reg_id', $id);
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query();  

        return $result;
    }
    public function getartistPaintingsData($id, $offset)
    {

        $limit = 12;
        $this->db->select('*');
        $this->db->from('painting_requests')->limit($limit, $offset);
        $this->db->where('artist_Id', $id);
        $this->db->order_by('ID', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        //echo $this->db->last_query();   
        return $result;
    }

    public function get_artist_name($id)
    {
        $this->db->select('*');
        $this->db->from('artist_meta');
        $this->db->where('reg_id', $id);
        $query = $this->db->get();
        $result = $query->result();
       // echo  $this->db->last_query(); 
        return $result;
    }
    public function getpainting_review($id)
    {

        $this->db->select_avg('rating', 'avgrat');
        $this->db->select('COUNT(id) as totalreview');
        $this->db->where('painting_id', $id);
        $query = $this->db->get('painting_reviews');
        $result = $query->row();
        $avgrat = $result->avgrat;
        $totalreview = $result->totalreview;
        //echo  $this->db->last_query(); 
        return array('avgrat' => $avgrat, 'totalreview' => $totalreview);
    }
    public function totalreviews($id)
    {


        $this->db->select('COUNT(id) as total');
        $this->db->where('painting_id', $id);
        $query = $this->db->get('painting_reviews');
        $result = $query->row();

        $total = $result->total;
        //echo  $this->db->last_query(); 
        return array('total' => $total);
    }


    public function customer_buypainting($painting_id)
    {
        $this->db->select('*');
        $this->db->from('artist_paintings');
        $this->db->where('ID', $painting_id);
        $this->query =  $this->db->get();
        $result =  $this->query->result();
        return  $result;
    }

    function random_paintings()
    {
        $this->db->select('ID,painting_image');
        $this->db->from('artist_paintings');
        $this->db->order_by('RAND()');
        $this->db->limit(6);
        $this->query = $this->db->get();
        //echo $this->db->last_query();

        return $this->query->result();
    }


    public function getartist_review($id)
    {

        $this->db->select_avg('rating', 'avgrat');
        $this->db->select('COUNT(id) as totalreview');
        $this->db->where('artist_id', $id);
        $query = $this->db->get('artist_reviews');
        $result = $query->row();
        $avgrat = $result->avgrat;
        $totalreview = $result->totalreview;
        //echo  $this->db->last_query(); 
        return array('avgrat' => $avgrat, 'totalreview' => $totalreview);
    }
    public function getmore_chat($req_id, $offset)
    {
        $limit = 5;
        $this->db->select('*');
        $this->db->from('chat')->limit($offset);
        $this->db->where('req_id', $req_id);
        $this->db->order_by('ID', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        $result = array_reverse($result);
       // echo $this->db->last_query();     
        return $result;
    }

    public function insert_order($data)
    {
        $this->db->insert('orders', $data);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }

    public function getmore_gallery_images($id, $limit)
    {
        $this->db->select('*');
        $this->db->from('artist_paintings')->limit($limit);
        $this->db->where('artistID', $id);
        $this->db->order_by('ID', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        //echo $this->db->last_query();   
        return $result;
    }



    public function check_review($customer_id, $paint_id)
    {
        $this->db->select('*');
        $this->db->from('painting_reviews');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('painting_id', $paint_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add_review($submit_review)
    {
        return $this->db->insert('painting_reviews', $submit_review);
    }




    public function check_artistreview($customer_id, $artist_id)
    {
        $this->db->select('*');
        $this->db->from('artist_reviews');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('artist_id', $artist_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add_artistreview($submit_review)
    {
        return $this->db->insert('artist_reviews', $submit_review);
    }


    public function getRating_review_painting($id)
    {

        $this->db->select_avg('rating', 'avgrat');
        $this->db->select('COUNT(id) as totalreview');
        $this->db->where('painting_id', $id);
        $query = $this->db->get('painting_reviews');
        $result = $query->row();
        $avgrat = $result->avgrat;
        $totalreview = $result->totalreview;
        //  echo  $this->db->last_query(); 
        return array('avgrat' => $avgrat, 'totalreview' => $totalreview);
    }


    public function purchases_painting($customer_id)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('cus_id', $customer_id);
        $this->db->order_by('id', 'desc');
        // $this->db->group_by('painting_id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


    public function painting_data($id)
    {

        $this->db->select('*');
        $this->db->from('artist_paintings');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function artist_name($id)
    {

        $this->db->select('artist_fname,artist_lname');
        $this->db->from('artist_meta');
        $this->db->where('reg_id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function purchase_painting($painting_id)
    {
        $this->db->select('*');
        $this->db->from('artist_paintings');
        $this->db->where('ID', $painting_id);
        $this->query =  $this->db->get();
        $result =  $this->query->result();
        return  $result;
    }
    public function individualpainting_review($id)
    {

        $this->db->select_avg('rating', 'avgrat');
        $this->db->select('COUNT(id) as totalreview');
        $this->db->where('painting_id', $id);
        $query = $this->db->get('painting_reviews');
        $result = $query->row();
        if ($result) {
            $avgrat = $result->avgrat;
            $totalreview = $result->totalreview;
        } else {
            $avgrat = 0;
            $totalreview = 0;
        }



        //  echo  $this->db->last_query(); 
        return array('avgrat' => $avgrat, 'totalreview' => $totalreview);
    }
    function TotalPantingReview($ID)
    {
        $this->db->select('COUNT(id) as total');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id ', $ID);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews;
    }
    function paintingfivestar($ID)
    {
        $this->db->select('COUNT(id) as five');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id ', $ID);
        $this->db->where('rating ', 5);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->five;
    }
    function paintingfourstar($ID)
    {
        $this->db->select('COUNT(id) as four');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id ', $ID);
        $this->db->where('rating ', 4);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();

        $reviews = $this->query->result();
        return $reviews[0]->four;
    }
    function paintingthreestar($ID)
    {
        $this->db->select('COUNT(id) as three');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id ', $ID);
        $this->db->where('rating ', 3);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->three;
    }
    function paintingtwostar($ID)
    {
        $this->db->select('COUNT(id) as two');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id ', $ID);
        $this->db->where('rating ', 2);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->two;
    }
    function paintingonestar($ID)
    {
        $this->db->select('COUNT(id) as one');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id ', $ID);
        $this->db->where('rating ', 1);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();
        $reviews = $this->query->result();
        return $reviews[0]->one;
    }
    public function individualcustomerReview($id)
    {

        $this->db->select('*');
        $this->db->from('painting_reviews');
        $this->db->where('painting_id', $id);
        $query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $query->row();

        return  $query->result();
    }
    public function individualPaintingRating($id, $paintingID)
    {

        $this->db->select('rating');
        $this->db->where('customer_id', $id);
        $this->db->where('painting_id', $paintingID);
        $query = $this->db->get('painting_reviews');
        //echo $this->db->last_query();  
        $result = $query->row();
        return  $query->result();
    }
    public function check_req($painting_id)
    {
        $this->db->select('*');
        $this->db->from('painting_requests');
        $this->db->where('ID', $painting_id);
        $this->query =  $this->db->get();
        $this->db->group_by('painting_id');
        //echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }
    public function createdAt($painting_id)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('painting_id', $painting_id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }

    public function contect_us($data)
    {
        $this->db->insert('contact_me', $data);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }

    public function submit_Request_form($data)
    {
        $this->db->insert('temp_painting_request', $data);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }

    public function script_data($id)
    {
        $this->db->select('*');
        $this->db->from('temp_painting_request');
        $this->db->where('id', $id);
        $this->query =  $this->db->get();
        //echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }

    function artist_selection($data)
    {
        $this->db->insert('painting_requests', $data);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }

    function fetch_request_data($id)
    {
        $this->db->select('*');
        $this->db->from('temp_painting_request');
        $this->db->where('id', $id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }

    function insert_temp_to_req($data2)
    {
        $this->db->insert('painting_requests', $data2);
        $insert_id = $this->db->insert_id();
        $this->db->last_query();
        return $insert_id;
    }

    public function allreq_data($id)
    {
        $this->db->select('*');
        $this->db->from('temp_painting_request');
        $this->db->where('id', $id);
        $this->db->group_by('customer_id');
        $this->query =  $this->db->get();
        //echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }


    public function submitimgdata($temp_id, $id)
    {
        $this->db->select('*');
        $this->db->from('painting_requests');
        $this->db->where('artist_Id', $id);
        $this->db->where('tem_paint_id', $temp_id);
        $this->db->group_by('customer_id');
        $this->query =  $this->db->get();
        //echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }

    function update_artist_in_temp_req($painting_id, $data)
    {
        $this->db->where('id', $painting_id);
        $result = $this->db->update('temp_painting_request', $data);
        // $this->db->last_query();	
        return $result;
    }

    public function getartist_name($id)
    {
        $this->db->select('*');
        $this->db->from(' artist_meta');
        $this->db->where('reg_id', $id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }
    public function getcust_name($id)
    {
        $this->db->select('*');
        $this->db->from(' customer_meta');
        $this->db->where('reg_id', $id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }
    public function check_role($id)
    {
        $this->db->select('user_role');
        $this->db->from('users');
        $this->db->where('id', $id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }

    public function submitreview($artistID, $data, $tem_paint_id)
    {
        // $this->db->where('tem_paint_id', $tem_paint_id);
        $this->db->where('artist_Id', $artistID);
        $this->db->where('tem_paint_id', $tem_paint_id);
        $result = $this->db->update('painting_requests', $data);
        // $this->db->last_query();	
        return $result;
    }

    public function insert_image_base64($data)
    {
        $this->db->insert('canvas_images', $data);
        $insert_id = $this->db->insert_id();
        // $this->db->last_query();
        return $insert_id;
    }


    public function getbase_pricePAINTING($id)
    {
        $this->db->select('painting_price');
        $this->db->from('painting_price');
        $this->db->where('artist_id', $id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;
    }

    public function canvas_image_data($temp_id)
    {
        $this->db->select('*');
        $this->db->from('canvas_images');
        $this->db->where('cus_id', $temp_id);
        $this->query =  $this->db->get();
        // echo $this->db->last_query();  
        $result =  $this->query->result();
        return  $result;  
    }

    
    public function painting_demensions($artist_id)
    {
        $this->db->select('*');
        $this->db->from('painting_price');
        $this->db->where('artist_id', $artist_id);
        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check;
    }
    public function get_artist_id($temp_id)
    {
        $this->db->select('*');
        $this->db->from('painting_requests');
        $this->db->where('tem_paint_id', $temp_id);
       // $this->db->where('painting_status', 1);
       $this->db->order_by('ID', 'desc');

        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check; 
    }
    public function accept_painting($temp_id, $data)
    {
        $this->db->where('tem_paint_id', $temp_id);
        $result = $this->db->update('painting_requests', $data);
        // echo $this->db->last_query();	
        return $result;

    }

    public function reject_painting($temp_id, $data)
    {
        $this->db->where('tem_paint_id', $temp_id);
        $result = $this->db->update('painting_requests', $data);
        // echo $this->db->last_query();	
        return $result;
    }

    public function check_status($temp_id)
    {
        $this->db->select('painting_status,selected_artist');
        $this->db->from('temp_painting_request');
        $this->db->where('id', $temp_id);
        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check;   
    }

    public function check_status_in_paitng_req($temp_id)
    {
        $this->db->select('painting_status,artist_Id,customer_id');
        $this->db->from('painting_requests');
        $this->db->where('tem_paint_id', $temp_id);
        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check; 
    }  
    public function update_accept_painting($temp_id, $update_accept_painting)
    {
        $this->db->where('id', $temp_id);
        $result = $this->db->update('temp_painting_request', $update_accept_painting);
        // echo $this->db->last_query();	
        return $result; 
    }

    public function get_category_name($cat_id)
    {
        $this->db->select('*');
        $this->db->from('artist_category');
        $this->db->where('ID', $cat_id);
        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check; 
    }

    public function get_created_at($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $check = $query->result();
        //echo $this->db->last_query();      
        return $check;  
    }
     public function get_num_rows_chat($req_id)
     {
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where('req_id', $req_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        $result = $query->num_rows(); 

        return $result;
     }

     public function get_create_date($ID)
     {
        $this->db->select('created_at');
        $this->db->from('users');
        $this->db->where('id', $ID);
        $query = $this->db->get();
        $result = $query->result();
        return $result;

     }

     public function reject_artist_name($ID)
     {
         $this->db->select('painting_status,artist_Id');
         $this->db->from('painting_requests');
         $this->db->where('tem_paint_id', $ID);
         $query = $this->db->get();
         $result = $query->result(); 
         return $result;
     }

     
     public function reject_artistNAME($ID)
     {
         $this->db->select('*');
         $this->db->from('artist_meta');
         $this->db->where('reg_id', $ID);
         $query = $this->db->get();
         $result = $query->result(); 
         return $result;
     }

     public function check_statusTEMP($ID)
     {
         $this->db->select('*');
         $this->db->from('temp_painting_request');
         $this->db->where('id', $ID);
         $query = $this->db->get();
         $result = $query->result(); 
         return $result;
     }

     
    function update_approve($temp_id, $data)
    {
        $this->db->where('id', $temp_id);
        $result = $this->db->update(' temp_painting_request', $data);
        // echo $this->db->last_query();	
        return $result;
    }

    public function check_approve_status($id)
    {
        $this->db->select('approve');
         $this->db->from('temp_painting_request');
         $this->db->where('id', $id);
         $query = $this->db->get();
         $result = $query->result(); 
         return $result; 
    }

    public function update_shipping_status($temp_id, $data)
    {
        $this->db->where('id', $temp_id);
        $result = $this->db->update('temp_painting_request', $data);
        // echo $this->db->last_query();	
        return $result;  
    }

    public function check_shipping_status($temp_id)
    {
        $this->db->select('shipping_status, track_num');
        $this->db->from('temp_painting_request');
        $this->db->where('id', $temp_id);
        $query = $this->db->get();
        $result = $query->result(); 
        return $result;    
    }


    public function check_token($genrate_token)
    {
        //$this->db->from('temp_painting_request');
        $this->db->where('token',$genrate_token);
        $query = $this->db->get('temp_painting_request');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }


    }

  
}
