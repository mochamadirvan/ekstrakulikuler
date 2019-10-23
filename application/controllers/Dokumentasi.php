<?php 
if(defined('basepath')) exit ('No direct access script allowed');

class Dokumentasi extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('GlobalCrud','crud');
    }

    function create(){
        $this->validation();
        if($this->form_validation->run() == FALSE){

            $this->message = "Komponen Ekskul Wajib Diisi";
            $this->session->set_flashdata('warning', $this->message); 

            if($this->session->userdata('role') == 1){
                redirect('admin/ekskul');
            }

            if($this->session->userdata('role') == 2){

                redirect('guru/ekskul');
            } 
        }else{
            $images         = explode(',', $this->input->post('image'));
            for ($i=0; $i < count($images) ; $i++) { 
                $str = str_replace('"','',$images[$i]);
                rename("files/temp/" . $str, "files/". $str);
                $query = array(
                    'id_ekskul' => $this->input->post('id_ekskul'),
                    'description' => $this->input->post('description'),
                    'image' => $str,
                );

                $this->crud->insert('dokumentasi',$query);
            }

            if($this->session->userdata('role') == 1){
                redirect('admin/ekskul');
            }

            if($this->session->userdata('role') == 2){

                redirect('guru/ekskul');
            }
        }
    }

    function upload(){
        $tempFile = $_FILES['file']['tmp_name'];
        $fileName = date('YmdHis');
        
        $targetPath = 'files/temp/';
        $file = $_FILES['file']['name'];
        $ext = pathinfo($file,PATHINFO_EXTENSION);
            
        $targetFile = $fileName.".".$ext;
        
        move_uploaded_file($tempFile, $targetPath . $targetFile);
        
        echo json_encode($targetFile);
    }

    /**
     * Image Remove Code
     *
     * @return void
     */
    public function remove($image_name)
    {
        $targetPath = 'files/temp/';
        unlink($targetPath . $image_name);
    }

    function validation(){
        $this->form_validation->set_rules('description','','required');
    }
}