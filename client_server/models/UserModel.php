<?php

use LDAP\Result;

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_model {


function checkemail($email)
{
$this->db->select('*');
$this->db->from('users');
$this->db->where('user_email', $email);
$query = $this->db->get(); 
$result = $query->result();  
//echo $this->db->last_query();      
return $result;

}

function insertdata($info){
    
    $this->load->database();
    $this->db->insert('users', $info);    
    $insert_id = $this->db->insert_id();    
    //echo $this->db->last_query();
    return $insert_id;
}

function resetPasswordUser($data,$id)
{
    
    $this->db->where('ID', $id);
    $this->db->update('users', $data);
    //echo $this->db->last_query();
    
    return TRUE;
}


function checkActivationDetails( $token)
{
    $this->db->select('BaseTbl.user_email,BaseTbl.resetTok');
    $this->db->from('users as BaseTbl');
    $this->db->where('resetTok', $token);
    $query = $this->db->get();
    //echo $this->db->last_query();
     return $query->row();
}



function checkrole($email, $password )
{



$this->db->select('user_role,id');
$this->db->from('users');
$this->db->where('user_email', $email);
$this->db->where('user_password', $password);

$query = $this->db->get(); 
$result = $query->result();  
//echo $this->db->last_query();      
return $result;

}


function login($id ,$role){


    $this->db->select('*');
    $this->db->from('users');
    
    if($role == 3){
    
        $this->db->join('customer_meta', 'customer_meta.reg_id = users.id');

     }
     elseif($role == 1)
     {
        $this->db->join('customer_meta', 'customer_meta.reg_id = users.id');
     }
     else
     {
        $this->db->join('artist_meta', 'artist_meta.reg_id = users.id');
    
     }
    $this->db->where('users.id', $id);
    $this->db->where('users.user_role', $role);

    $query = $this->db->get(); 


    //echo $this->db->last_query();
    if ($query->num_rows() > 0){
  
    $row = $query->row_array();
   
 
        return $row;
       

    } else {

        return false;

    }

    
    
    
  


}
function createPasswordUser($token, $data)
{
    $this->db->where('resetTok', $token);
    $this->db->update('users', $data);
    
    
    //echo $this->db->last_query();
   return TRUE;
}
function check_profile ($profile_id)
{





$this->db->select('profile_image');
$this->db->from('customer_meta');
$this->db->where('reg_id', $profile_id);
$query = $this->db->get();
$result = $query->result(); 
//echo $this->db->last_query();      
 return $result;


}

function update_activetoken($data)
{
    
    $this->db->where('id', $data['id']);
    $this->db->update('users', $data);
    //echo $this->db->last_query();
    
   return TRUE;
   
}
function checkActivationToken($token)
{
    $this->db->select('user_email');
    $this->db->from('users');
    $this->db->where('active_token', $token);
    $query = $this->db->get(); 
    if ($query->num_rows() > 0){
  
    $row = $query->row_array();
   
 
        return $row;

    } else {

        return false;

    }

}
function remove_activetoken($data,$token)
{
    
    $this->db->where('active_token', $token);
    $this->db->update('users', $data);
    //echo $this->db->last_query();
    
   return TRUE;
   
}





}