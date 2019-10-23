<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar extends CI_Controller {
    
    
    public function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        $this->load->model('UserModel','user'); 
    }

	public function index()
	{
		$this->load->view('layouts/header');
        $this->load->view('daftar');
        $this->load->view('layouts/footer');

     }
     

    public function create(){

        

    }    

}