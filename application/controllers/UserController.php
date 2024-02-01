<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('users');
        $this->load->model('transactions');
    }
    
    public function indexUser(){
        $user=new Users();
        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        if($userDetails){
            $data['userDetails'] = $user->getUser($userDetails['id']);
            $data['userDetails']->password=null;
            $data['userDetails']->inActive=null;
            return $this->load->view('users/user',$data);
        }
        return $this->load->view('errors/error');
    }
    
    public function indexAdmin(){
        $CI = &get_instance();
        if( $CI->session->userdata('isLoggedIn') !== true){
            redirect(('//localhost/signUp'));
        }
        $userDetails = $CI->session->userdata('userdetails');
        
        if ($userDetails && isset($userDetails['role']) && in_array($userDetails['role'], ['admin','superadmin'])) {
            $users=$this->getUsers();
            $data['users']=$users;
            $this->load->view('admin',$data);
            return;
        }
        else{
            return redirect(('//localhost/users'));
        }
    }

    public function createUser(){
        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        $data = array(
            'username' => isset($_POST['username']) ? $_POST['username'] : '',
            'Full_Name' => isset($_POST['FullName']) ? $_POST['FullName'] : '',
            'email' => isset($_POST['Email']) ? $_POST['Email'] : '',
            'role' => isset($_POST['role']) ? $_POST['role'] : '',
            'phone_number' => isset($_POST['Phone']) ? $_POST['Phone'] : '',
            'password' => isset($_POST['password']) ? $_POST['password'] : '',
            'limiti_borxhit'=>isset($_POST['limit_borxhi'])?$_POST['limit_borxhi']:0
        );

        $user=new Users();

        if(($userDetails['role']==='admin' && $data['role']==='superadmin')||($userDetails['role']==='admin' && $data['role']==='admin')|| $data['role']==='superadmin'){
            throw new Error('you cant perform this action');
            return;
        }
        if($data['role']==='admin'||$data['role']==='superadmin'){
            $data['limiti_borxhit']=0;
        }
        if($data['role']==='superadmin'){
            throw new Error('You cant add superadmin!');
        return;
        }
        if($user->createUser($data)){
            $this->indexAdmin();
            return;
        }
        return null;
    }

    public function editUser($userId){
        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        $inputStream = $this->input->raw_input_stream;
        $user=new Users();
        $data = json_decode($inputStream, true);
        $User=$user->getUser($userId);
        if(($userDetails['role']==='admin' && $User->role==='superadmin')|| ($userDetails['role']==='admin' && $User->role==='admin')){
            throw new Error('you cant perform this action');
            return;
        }
        if ($data === null) {
            $response = array('error' => 'Invalid JSON data');
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }
        
        $data['id']=$userId;
        if($User->role==='superadmin'||$User->role==='admin'){
            $data['limiti_borxhit']=0;
        }
        if($data['role']==='superadmin'){
            throw new Error('You cant add superadmin!');
        return;
        }
        $user->updateUsers($data);
        return $this->indexAdmin();  
    }

    public function getUsers(){
        $users=new Users();
        return $users->getUsers();
    }

    public function Search($someone){
        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        if( $CI->session->userdata('isLoggedIn') !== true){
            redirect(('//localhost/signUp'));
        }
        $user=new Users();
        $User=$user->findByUsername($someone);  
       
        if(!$User){
            redirect(('//localhost/notFound'));
            return;
        }

        if($User){
            $User->password = null;
            $data['userDetails'] = $User;
        }
        
        $CI = &get_instance();
        
        if( $data['userDetails']->username === $userDetails['username']){
            redirect(('//localhost/users'));        
            return;
        }
       
        if(($User->role === 'superadmin' || $User->role === 'admin')&&($userDetails['role']!=='admin' && $userDetails['role']!=='superadmin')){
            redirect(('//localhost/notFound'));
            return;
        }    

        $this->load->view('users/userSearch', $data);
    }

    function indexnotFound(){
        $this->load->view('errors/error');
    }

    function transaction($username){
        $user = new Users();
        $User = $user->findByUsername($username);

        $bilanci = $this->input->post('bilanci');
        $receiverId = $User->id;

        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        $senderId = $userDetails['id'];

        if($user->transaction($senderId,$receiverId,$bilanci)){
            echo "Transaction with success";
            return;
        }
        throw new Error("transaction didnt succeed!");
    }

    function deleteUser($userId){
        $user=new Users();
        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        $User=$user->getUser($userId);
        if($userDetails['role']==='admin' && $User['role']==='superadmin'){
            throw new Error('you cant perform this action');
            return;
        }
        $user->deleteUser($userId);
        $this->indexAdmin();
    }

    public function indexTransaction() {
        $transactions = new Transactions();
        $users = new Users();
        $transactionData = $transactions->getTransactions();

        foreach ($transactionData as $transaction) {
            $sender = $users->getUser($transaction->senderId);
            $receiver = $users->getUser($transaction->receiverId);

            $transaction->senderId = $sender ? $sender->username : 'Unknown';
            $transaction->receiverId = $receiver ? $receiver->username : 'Unknown';
        } 

        $data['transactions'] = $transactionData;
        $this->load->view('transaction', $data);
    }
}
