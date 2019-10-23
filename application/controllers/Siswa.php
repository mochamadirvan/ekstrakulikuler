<?php 
if(defined('basepath')) exit ('No direct access script allowed');

class Siswa extends CI_Controller {

	var $message;

	function __construct(){
		parent::__construct();
		$this->load->model('GlobalCrud','crud');

	}

	function tambah(){
		if($this->session->userdata('role') == 1){
	        $this->load->view('layouts/header');
	        $this->load->view('layouts/nav');
	        $this->load->view('admin/siswa/tambah');
	        $this->load->view('layouts/footer');
        }
        else {
	        $this->load->view('layouts/header');
	        $this->load->view('guru/nav');
	        $this->load->view('guru/siswa/tambah');
	        $this->load->view('layouts/footer');
		}

	}

	function create(){
		$this->validation();
		if($this->form_validation->run() == FALSE){

			$this->message = "Komponen Siswa Wajib Diisi dan NIS Terdiri Dari 7 Angka!";
	  		$this->session->set_flashdata('warning', $this->message);                  
	        if($this->session->userdata('role') == 1){
	            redirect('siswa/tambah');
	        }

	        if($this->session->userdata('role') == 2){

	            redirect('guru/siswa');
	        }

         	else {
	            redirect('user/register');
	        }

		}else {

			$query = array(
				'nis' => $this->input->post('nis'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'kelas' => $this->input->post('kelas'),
				'jurusan' => $this->input->post('jurusan'),
				'rombel' => $this->input->post('rombel'),
				'email'	 => $this->input->post('email')
			);

			$this->crud->insert('siswa',$query);
			$this->message = "Data Siswa Berhasil Disimpan !";
	        $this->session->set_flashdata('success',$this->message);            
	        if($this->session->userdata('role') == 1){
	            redirect('admin/siswa');

	        }

	        if($this->session->userdata('role') == 2){

	            redirect('guru/siswa');
	        }

	        else {
	            redirect('user/register');
	        }
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
		$this->validation();
		if($this->form_validation->run() == FALSE){
			$this->message = "Komponen Siswa Wajib Diisi dan NIS Terdiri Dari 7 Angka!";
	  		$this->session->set_flashdata('warning', $this->message);            
	        if($this->session->userdata('role') == 1){
	            redirect('admin/siswa');
	        }
		}else{
			$query = array(
				'nis' => $this->input->post('nis'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'kelas' => $this->input->post('kelas'),
				'jurusan' => $this->input->post('jurusan'),
				'rombel' => $this->input->post('rombel'),
				'email'	 => $this->input->post('email')
			);
			
			$this->crud->update('siswa',$query,'id_siswa',$this->input->post('id_siswa'));
			$this->message = "Data Siswa Berhasil Diubah !";
	        $this->session->set_flashdata('success',$this->message);            
	        if($this->session->userdata('role') == 1){
	            redirect('admin/siswa');

	        }

	        if($this->session->userdata('role') == 2){

	            redirect('guru/siswa');
	        }


	        else {
	            redirect('user/register');
	        }
	    }
	}

	function destroy($id){
		$this->crud->delete('siswa','id_siswa',$id);
		$this->message = "Data Siswa Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
        redirect('admin/siswa');


	}

	function validation(){
        $this->form_validation->set_rules('nis','NIS','required|min_length[7]|max_length[7]|numeric');
        $this->form_validation->set_rules('nama_siswa','Nama Siswa','required');
        $this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
        $this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('kelas','Kelas','required');
        $this->form_validation->set_rules('jurusan','Jurusan','required');
        $this->form_validation->set_rules('rombel','Rombel','required');
        $this->form_validation->set_rules('email','Email','required');
    }

   function nilai(){
		$query = array('nilai' => $this->input->post('nilai'));
		$this->crud->update('nilai',$query,'id_nilai',$this->input->post('id_nilai'));
		$this->message = "Data Nilai Berhasil Diubah !";
        $this->session->set_flashdata('success',$this->message);            
        if($this->session->userdata('role') == 1){
            redirect('admin/ekskul/pendaftar');

        }

        if($this->session->userdata('role') == 2){

            redirect('guru/ekskul/pendaftar');
        }


         else {
            redirect('user/register');
        }
   	}

   	function get_nilai($id){
		$query = array(
			'id_nilai' => $id
		);

		$result = $this->crud->get('nilai',$query)->row();
		echo json_encode($result);
	}
}