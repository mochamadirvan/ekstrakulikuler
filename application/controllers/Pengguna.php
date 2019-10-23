<?php
if(defined('basepath')) exit ('No direct access script allowed');

class Pengguna extends CI_Controller{
    
    var $message;
    
    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
        $this->load->model('UserModel','user');
        $this->load->library('email');
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
    }
    
    function create(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Komponen Akun Siswa Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/akunSiswa');
        } else {
            
            $query = array(
               
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password')),
                'id_users' => $this->input->post('id_users'),
                'role' => '0'            
            );

            $data = array(
                'id_siswa' => (int)$this->input->post('id_users')
            );
        

            $result = $this->crud->get('siswa',$data)->row();
            
             $this->crud->insert('user',$query);
            $this->message = "Akun Siswa Baru Berhasil Disimpan :)";
         $this->session->set_flashdata('success',$this->message);
         redirect('admin/akunSiswa');
}

}
    
    function get($id){
        
        $data = array(
            'id_user' => $id
        );
        
        $result = $this->crud->get('user',$data)->row();
        echo json_encode($result);
        
    }
    
    function update(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Komponen Akun Siswa Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/akunSiswa');
        } else {
            $query = array(
                'username' => $this->input->post('username'),
            );
            
            $this->crud->update('user',$query,'id_user',$this->input->post('id_user'));
            $this->message = "Akun Siswa Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/akunSiswa');
        }
    }
    
    function destroy($id){
        $this->message = "Akun Siswa berhasil dihapus :)";
        $this->crud->delete('user','id_user',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/akunSiswa');
        
    }
    
    function reset_password(){       
            $old_password = $this->user->reset($this->input->post('id_user'));
            if($old_password == sha1($this->input->post('password'))){
                
                $query = array(
                    'password' => sha1($this->input->post('new_password'))
                );
                
                $this->crud->update('user',$query,'id_user',$this->input->post('id_user'));
                $this->message = 'Password berhasil diubah';
                $this->session->set_flashdata('success',$this->message);
                redirect('admin/akunSiswa');
                
            } else {
                
                $this->message = 'Password baru tidak sesuai!';
                $this->session->set_flashdata('danger',$this->message);
                redirect('admin/akunSiswa');
            }  
    }

    function createGuru(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Komponen Guru Siswa Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/akunGuru');
        } else {
            $query = array(
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password')),
                'id_users' => $this->input->post('id_users'),
                'role' => 2
            );
            
            $this->crud->insert('user',$query);
            $this->message = "Akun Guru Baru Berhasil Disimpan :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/akunGuru');
            //var_dump($query);exit();
        }
    }

    function getGuru($id){
        
        $data = array(
            'id_user' => $id
        );
        
        $result = $this->crud->get('user',$data)->row();
        echo json_encode($result);
        
    }
    
    function updateGuru(){
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $this->message = "Komponen Akun Siswa Wajib Diisi !";
            $this->session->set_flashdata('warning',$this->message);            
            redirect('admin/akunSiswa');
        } else {
            $query = array(
                'username' => $this->input->post('username'),
            );
            
            $this->crud->update('user',$query,'id_user',$this->input->post('id_user'));
            $this->message = "Akun Guru Berhasil Diubah :)";
            $this->session->set_flashdata('success',$this->message);
            redirect('admin/akunGuru');
        }
    }
    
    function destroyGuru($id){
        $this->message = "Akun Guru berhasil dihapus :)";
        $this->crud->delete('user','id_user',$id);
        $this->session->set_flashdata('success',$this->message);
        redirect('admin/akunGuru');
        
    }
    
    function reset_password_guru(){       
            $old_password = $this->user->reset($this->input->post('id_user'));
            if($old_password == sha1($this->input->post('password'))){
                
                $query = array(
                    'password' => sha1($this->input->post('new_password'))
                );
                
                $this->crud->update('user',$query,'id_user',$this->input->post('id_user'));
                $this->message = 'Password berhasil diubah';
                $this->session->set_flashdata('success',$this->message);
                redirect('admin/akunGuru');
                
            } else {
                
                $this->message = 'Password baru tidak sesuai!';
                $this->session->set_flashdata('danger',$this->message);
                redirect('admin/akunGuru');
            }  
    }
    
    function validation(){
        $this->form_validation->set_rules('username','','required');
        $this->form_validation->set_rules('password','','required');
        $this->form_validation->set_rules('id_users','','required');
    }
    
}