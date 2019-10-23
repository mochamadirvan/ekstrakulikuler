<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class guru extends CI_Controller {
    
    protected $table;
    
    function __construct(){
       parent::__construct();
       
       $this->load->model('GlobalCrud','crud');
       $this->load->model('UserModel','user');
       if($this->session->userdata('role') != 2 ){
           redirect('login');
       }
    }
    
    function dashboard(){
        $data = array(
           'set_siswa' => $this->crud->count_table('siswa'),
           'set_ekskul' => $this->crud->count_table('ekskul'),
           'set_akun' => $this->crud->count_table('user'),
           'set_pendaftar' => $this->crud->count_table('registrasi')
           
        );
        
        $this->load->view('layouts/header');
        $this->load->view('guru/nav');
        $this->load->view('guru/dashboard',$data);
        $this->load->view('layouts/footer');
    }
    
    function siswa(){
        $data = array(
            'set' => $this->crud->all('siswa')->result()
        );

        $this->load->view('layouts/header');
        $this->load->view('guru/nav');
        $this->load->view('guru/siswa/kelola',$data);
        $this->load->view('layouts/footer');
    }


    function ekskul(){
        $data = array(
            'set' => $this->crud->all('ekskul')->result(),


        );

        $this->load->view('layouts/header');
        $this->load->view('guru/nav');
        $this->load->view('guru/ekskul/kelola',$data);
        $this->load->view('layouts/footer');
    }

    function galeri(){
        $data = array(
            'set' => $this->crud->twoTablesFusion('dokumentasi','ekskul','*','dokumentasi.id_ekskul=ekskul.id_ekskul')->result()
        );

        $this->load->view('layouts/header');
        $this->load->view('guru/nav');
        $this->load->view('galeri/kelola',$data);
        $this->load->view('layouts/footer');
    }

    


}
