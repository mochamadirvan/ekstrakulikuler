<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    
    public function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        $this->load->model('UserModel','user'); 
    }

	public function index()
	{
		$this->load->view('layouts/header');
        $this->load->view('login');
        $this->load->view('layouts/footer');
	}
    
    public function signin()
	{
		  $query = array(
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password'))
          );
            
        
        $result = $this->crud->get('user',$query);
        
        if($result->num_rows() == 1){
            $this->user->session($result);
            
        } else  {
            $this->session->set_flashdata('notify','<font color="red">Username atau Password Salah</font>');
            redirect('login');
        }
            
        
	}
    
    function signout(){
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('role');

        redirect('login');

    }


	var $message;

	function create(){
		$this->validation();
		if($this->form_validation->run() == FALSE){

			$this->message = "Komponen Siswa Wajib Diisi !";
	        $this->session->set_flashdata('warning',$this->message);            
	        redirect('login');

		} else {

			$query = array(
				'nis' => $this->input->post('nis'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'kelas' => $this->input->post('kelas'),
				'jurusan' => $this->input->post('jurusan'),
				'rombel' => $this->input->post('rombel'),
				
			);
			$this->crud->insert('siswa',$query);
			$this->message = "Pendafataran Berhasil, Username & Password. Mohon tunggu sekitar 5- 10 menit kedepan sistem akan melakukan validasi akun secara otomatis ";
	        $this->session->set_flashdata('success',$this->message);            
	        redirect('login');

		}
		

	}

	function get($id){
		$query = array(
			'id_siswa' => $id
		);

		$result = $this->crud->get('siswa',$query)->row();
		echo json_encode($result);
	}

	function update(){
		$query = array(
			'nis' => $this->input->post('nis'),
			'nama_siswa' => $this->input->post('nama_siswa'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'kelas' => $this->input->post('kelas'),
			'jurusan' => $this->input->post('jurusan'),
			'rombel' => $this->input->post('rombel'),
			
		);
		$this->crud->update('siswa',$query,'id_siswa',$this->input->post('id_siswa'));
		$this->message = "Data Siswa Berhasil Diubah !";
        $this->session->set_flashdata('success',$this->message);            
        redirect('login');
	}

	function destroy($id){
		$this->crud->delete('siswa','id_siswa',$id);
		$this->message = "Data Siswa Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
        redirect('login');


	}

	function validation(){
        $this->form_validation->set_rules('nis','','required|min_length[7]|max_length[7]|numeric');
        $this->form_validation->set_rules('nama_siswa','','required');
        $this->form_validation->set_rules('tempat_lahir','','required');
        $this->form_validation->set_rules('tanggal_lahir','','required');
        $this->form_validation->set_rules('alamat','','required');
        $this->form_validation->set_rules('kelas','','required');
        $this->form_validation->set_rules('jurusan','','required');
        $this->form_validation->set_rules('rombel','','required');
        
    }

    
}
