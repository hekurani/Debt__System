<?php 

class Users extends CI_Model{
    public function register($data){
        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users',$data);
    }
    public function logIn($data){
        $this->db->select('*');
        $this->db->where('email',$data['email']);
        $this->db->from('users');
        $this->db->limit(1);
        $query=$this->db->get();
        if($query->num_rows()==1){
            $user= $query->row();
            if (password_verify($data['password'], $user->password)) {
            
                return $user;
            }
            return null;
        }
        else{
            return null;
        }
    }
    public function createUser($data){
        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
        if( $this->db->insert('users',$data)){

        $last_insert_id = $this->db->insert_id();
    return $last_insert_id;    
    }
        else{
return null;
        }
    }

    public function getUsers(){
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return array();
        }
    }
    public function updateUsers($data) {
        $userId = $data['id'];
        unset($data['id']);
        
        $this->db->where('id', $userId);
        $this->db->update('users', $data);
    
        return $this->db->affected_rows() > 0;
    }
    function deleteUser($userId){
        $this->db->where('id', $userId);
        $this->db->update('users', array(
            'inActive'=>1
        ));
        return $this->db->affected_rows() > 0;
    }
    public function getUser($userId) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $userId);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->row(); 
        } else {
            return null; 
        }
    }
    public function findByUsername($username)
    {
        
        $query = $this->db->select('*')
            ->from('users')
            ->where('username', $username)
            ->where('inActive', 0) 
            ->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    public function transaction($senderId,$receiverId,$bilanci){
      $sender=$this->getUser($senderId);
      $receiver=$this->getUser($receiverId);
      if($sender && $receiver){
        if(($sender->role==='admin'||$sender->role==='superadmin')||$receiver->role==='admin'||$recevier->role=='superadmin'){
            return null;
        }
if($sender->bilanci-$bilanci+$sender->limiti_borxhit<0){
return null;      
}
else {
    $this->db->set('bilanci',$sender->bilanci-$bilanci , false);
    $this->db->where('id', $senderId);
    $this->db->update('users');

    $this->db->set('bilanci', $receiver->bilanci + $bilanci, false);
    $this->db->where('id', $receiverId);
    $this->db->update('users');

    $this->db->insert('transaksioni', array(
        'senderId' => $senderId,
        'receiverId' => $receiverId,
        'Shuma' => $bilanci
    ));
    return true;
}
} 

      
        return null;
      
    }
}