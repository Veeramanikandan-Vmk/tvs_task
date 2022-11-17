<?php 
class Customer_model extends CI_Model {

    public function add_customer($data)
    {
        $query = $this->db->query('call add_customer("'.implode('","',$data).'")');
        $this->db->close();
        return $query;
    } 
    public function update_customer($data)
    {
        $query = $this->db->query('call update_customer("'.implode('","',$data).'")');
        $this->db->close();
        return $query;
    } 
    public function delete_customer($data)
    {
        $query = $this->db->query('call delete_customer("'.implode('","',$data).'")');
        $this->db->close();
        return $query;
    } 
    public function undo_delete_customer($data)
    {
        $query = $this->db->query('call undo_delete_customer("'.implode('","',$data).'")');
        $this->db->close();
        return $query;
    } 
    public function deleteprofileimg($data)
    {
        $query = $this->db->query('call delete_customer_img("'.implode('","',$data).'")');
        $this->db->close();
        return $query;
    } 
    public function get_customer_data($data)
    {
        $query = $this->db->query('call get_customers("'.implode('","',$data).'")');
        
        $res = $query->result();
        $this->db->close();
        return $res;
    } 
    public function get_customer_data_by_customerid($data)
    {
        $query = $this->db->query('call get_customer_by_customerid("'.implode('","',$data).'")');
        
        $res = $query->row();
        $this->db->close();
        return $res;
    }
    public function get_total_no_customers()
    {
        $query = $this->db->query('call get_total_customers()');
       
        $res = $query->row();
        $this->db->close();
        return $res;
    }
    public function get_count_filtered_customers($data)
    {
        $query = $this->db->query('call get_count_filtered_customers("'.implode('","',$data).'")');
        $res = $query->row();
        $this->db->close();
        return $res;
    }
}