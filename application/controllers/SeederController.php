<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeederController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seeder_users');
    }

    public function index()
    {
        $this->seeder_users->run();
        echo "Seeder executed successfully!";
    return;
    }
}
