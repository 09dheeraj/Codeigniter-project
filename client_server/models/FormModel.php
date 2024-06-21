<?php

use LDAP\Result;

defined('BASEPATH') OR exit('No direct script access allowed');

class FormModel extends CI_model {


function checkemail($email)
{
$this->db->select('email');
$this->db->from('form');
$this->db->where('email', $email);
$query = $this->db->get(); 
$result = $query->result();  
//echo $this->db->last_query();      
return $result;

}

function insertdata($data){

    $this->db->insert('form', $data);    
    $insert_id = $this->db->insert_id();    
//    echo $this->db->last_query();
    return $insert_id;
}
function fetch()
{
$this->db->select('*');
$this->db->from('form');
$query = $this->db->get(); 
$result = $query->result();  
$this->db->last_query();      
return $result;

}
function update($ID)
{
$this->db->select('*');
$this->db->from('form');
$this->db->where('ID', $ID);
$query = $this->db->get(); 
$result = $query->result();  
//echo $this->db->last_query();      
return $result;

}
function updatedata($ID,$data){
    $this->db->where('ID', $ID);
    $result = $this->db->update('form', $data);
   // echo $this->db->last_query();	
    return $result; 


}
function delete($ID){
    $this->db->where('ID', $ID);
    return $this->db->delete('form');


}
function login($email,$password){
    $this->db->select('*');
    $this->db->from('form');
    $this->db->where('email', $email);
    $this->db->where('password', $password);
    $query = $this->db->get(); 
    $result = $query->result();
  
     return $result;


//  echo $this->db->last_query();  
}
}