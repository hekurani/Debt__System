<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');

        $this->load->model('users');
    }

    public function indexsignUp(){
        $this->load->view('auth/signUp');
    }

    public function signUp(){
        try {
            $this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
            $this->form_validation->set_rules("password", "Password", "required|min_length[8]");
            $this->form_validation->set_rules("phone", "Phone Number", "required|regex_match[/^\+?[0-9()\-\s]+$/]");
            $this->form_validation->set_rules("username", "Username", "required|min_length[8]|max_length[24]|is_unique[users.username]|regex_match[/^\S+$/]");            $this->form_validation->set_rules("Full_Name", "Full Name", "required|min_length[5]|max_length[40]");

            $config['allowed_types']='jpg|png';
            $config['file_name'] = 'user_profile_image_' . uniqid(); 
            $config['upload_path']='./profile/';
            $this->load->library('upload',$config);
            $image=null;
            if($this->upload->do_upload('image')){
                $image=$this->upload->data();
                $image=$image['file_name'];
            }

            if($this->form_validation->run() == FALSE){
                echo validation_errors();
                echo "Something Wrong";
                $this->indexsignUp();
            } else {
                $data = array(
                    'Full_Name' => $this->input->post('Full_Name'),
                    'password' => $this->input->post('password'),
                    'email' => $this->input->post('email'),
                    'phone_number'=> $this->input->post('phone'),
                    'image'=>$image?$image:null,
                    'username'=>$this->input->post('username')
                );

                $users = new Users();
                $result = $users->register($data);

                if($result){
                    $data['role']='user';
                    $auth_userdetails=[
                        'FullName'=>$data['Full_Name'],
                        'role'=>'user',
                        'id'=>$result,
                        'username'=>$data['']       
                    ];
                    $this->session->set_flashdata('status','Registration Successful');
                    $this->session->set_userdata('isLoggedIn',true);
                    $this->session->set_userdata('userdetails',$auth_userdetails);
                    redirect(('//localhost/users'));
                    return; 
                }
            }
        } catch(Exception $e){
            echo "Something unexpected happened: " . $e->getMessage();
        }
    }

    public static function isLoggedIn(){
        $CI = &get_instance();
        if( $CI->session->userdata('isLoggedIn') !== true){
            $this->indexlogIn();
        }
    }

    static function restrictRoles($roles=[]){
        $CI = &get_instance();
        $userDetails = $CI->session->userdata('userdetails');
        
        if ($userDetails && isset($userDetails['role']) && in_array($userDetails['role'], $roles)) {
            return true;
        }
        return false;
    }

    public function indexlogIn(){
        $this->load->view('auth/logIn');
    }

    public function logIn(){
        $data=[
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password')
        ];
        print_r($data);
        $users=new Users();
        $result=$users->logIn($data);
        if($result&& !$result->inActive){
            $auth_userdetails=[
                'FullName'=>$result->Full_Name,
                'role'=>$result->role,
                'id'=>$result->id,
                'username'=>$result->username       
            ];
            $this->session->set_userdata('isLoggedIn',true);
            $this->session->set_userdata('userdetails',$auth_userdetails);
            $this->session->set_flashdata('status', "User successfuly logged In");
            switch($result->role) {
                case 'user':
                    redirect(('//localhost/users'));
                    break;
                case 'admin':
                case 'superadmin':
                    redirect('//localhost/admin');
                    break;
            }
        }
        else{
            $this->session->set_flashdata('status','Invalid email or password, please try again');
            $this->indexlogIn();
        }
    }

    public function logOut(){
        $this->session->set_userdata('isLoggedIn',false);
        $this->session->set_userdata('userdetails',null);
        $this->session->set_flashdata('status', null);
        redirect(('//localhost/logIn'));
    }
}
