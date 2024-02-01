<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder_users extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function run()
    {
        $data = array(
            array(
                'Full_Name' => 'User1',
                'username' => 'user1',
                'password' => password_hash('password1', PASSWORD_DEFAULT), 
                'email' => 'user1@example.com',
                'role' => 'superadmin',
                'inActive' => 0,
                'limiti_borxhit' => 0,
                'bilanci' => 0,
            ),
            array(
                'Full_Name' => 'User2',
                'username' => 'user2',
                'password' => password_hash('password2', PASSWORD_DEFAULT), 
                'email' => 'user2@example.com',
                'role' => 'admin',
                'inActive' => 0,
                'limiti_borxhit' => 0,
                'bilanci' => 0,
            ),
            array(
                'Full_Name' => 'User3',
                'username' => 'user3',
                'password' => password_hash('password3', PASSWORD_DEFAULT), 
                'email' => 'user3@example.com',
                'role' => 'admin',
                'inActive' => 0,
                'limiti_borxhit' => 0,
                'bilanci' => 0,
            ),
            array(
                'Full_Name' => 'User5',
                'username' => 'user4',
                'password' => password_hash('password4', PASSWORD_DEFAULT), 
                'email' => 'user4@example.com',
                'role' => 'user',
                'inActive' => 0,
                'limiti_borxhit' => 0,
                'bilanci' => 0,
            ),
            array(
                'Full_Name' => 'User Five',
                'username' => 'user5',
                'password' => password_hash('password5', PASSWORD_DEFAULT), 
                'email' => 'user5@example.com',
                'role' => 'user',
                'inActive' => 0,
                'limiti_borxhit' => 0,
                'bilanci' => 0,
            ),
        );

        $this->db->insert_batch('users', $data); 
    }
}
?>
