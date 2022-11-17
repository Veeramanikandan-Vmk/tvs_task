<?php 
class Accounts_model extends CI_Model {

    public function get_user_account_by_username($data)
    {
        $query = $this->db->query('call get_user_account_by_username("'.implode('","',$this->db->escape_str($data)).'")');
        return $query->row();
    }
}