<?php 

class Transactions extends CI_Model{
    public function getTransactions()
    {
        $query = $this->db->get('transaksioni');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }

}