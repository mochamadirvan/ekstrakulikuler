<?php 
if(defined('basepath')) exit ('No direct access script allowed');

class Tambahguru extends CI_Controller {

	var $message;

	function __construct(){
		parent::__construct();
		$this->load->model('GlobalCrud','crud');

	}

	function create(){  
		$this->validation();
		if($this->form_validation->run() == FALSE){    
			$this->message = "Komponen Guru Wajib Diisi dan NIK Terdiri Dari 16 Angka!";
	  		$this->session->set_flashdata('warning', $this->message);
	        if($this->session->userdata('role') == 1){
	            redirect('admin/tambahguru', $this->message);
	        }

		}else{      
			$query = array(
				'nik' => $this->input->post('nik'),
				'nama_guru' => $this->input->post('nama_guru'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'golongan' => $this->input->post('golongan')
			);

			$this->crud->insert('guru',$query);
			$this->message = "Data Guru Berhasil Disimpan !";
	        $this->session->set_flashdata('success',$this->message);            
	        redirect('admin/tambahguru');
	    }
	}
		
	function get($id){
		$query = array(
			'id_guru' => $id
		);

		$result = $this->crud->get('guru',$query)->row();
		echo json_encode($result);
	}

	function update(){
		$this->validation();
		if($this->form_validation->run() == FALSE){    
			$this->message = "Komponen Guru Wajib Diisi dan NIK Terdiri Dari 16 Angka!";
	  		$this->session->set_flashdata('warning', $this->message);
			if($this->session->userdata('role') == 1){
	            redirect('admin/tambahguru');
	        }

		}else{
			$query = array(
				'nik' => $this->input->post('nik'),
				'nama_guru' => $this->input->post('nama_guru'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'golongan' => $this->input->post('golongan')
			);
			$this->crud->update('guru',$query,'id_guru',$this->input->post('id_guru'));
			$this->message = "Data Guru Berhasil Diubah !";
	        $this->session->set_flashdata('success',$this->message);            
	        redirect('admin/tambahguru');
	    }
	}

	function destroy($id){
		$this->crud->delete('guru','id_guru',$id);
		$this->message = "Data Guru Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
        redirect('admin/tambahguru');
	}

	function validation(){
        $this->form_validation->set_rules('nik','','required|min_length[16]|max_length[16]|numeric');
        $this->form_validation->set_rules('nama_guru','','required');
        $this->form_validation->set_rules('tempat_lahir','','required');
        $this->form_validation->set_rules('tanggal_lahir','','required');
        $this->form_validation->set_rules('alamat','','required');
        $this->form_validation->set_rules('golongan','','required');
    }
}