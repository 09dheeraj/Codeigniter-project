<?php 

class Admin_model extends CI_Model
{
  
    public function customer_data()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_role',3);
        $this->db->where('isdelete',0);
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        // echo $this->db->last_query();      
        return $result;
    }

    public function Artist_data()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_role',2);
        $this->db->where('isdelete',0);
        $query = $this->db->get();
        $result = $query->result();
        $num_rows = $query->num_rows();
        // echo $this->db->last_query();      
        return $result;
    }

    function setStatus($artID, $status)
    {
        $data = array(
            "user_status" => $status
        );
         $this->db->where('id', $artID);
         $result = $this->db->update('users', $data);
             
        return $result;
    }

    public function soft_deleteArt($art_id, $status)
    {
        $data = array(
            "user_status" => $status,
            "isdelete" => 1
        );
        
        $this->db->where('id', $art_id);
        $result = $this->db->update('users', $data);
        return $result;
    }





 

   
}