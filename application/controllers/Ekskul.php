<?php 

if(defined('basepath')) exit ('no direct access script allowed');

class Ekskul extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('GlobalCrud','crud');
        $this->load->library('pdf');
	}

	function create(){
		$this->validation();
		if($this->form_validation->run() == FALSE){

			$this->message = "Komponen Ekskul Wajib Diisi !";
	        $this->session->set_flashdata('warning',$this->message);            
	       if($this->session->userdata('role') == 1){
            redirect('admin/ekskul');

        }

        if($this->session->userdata('role') == 2){

            redirect('guru/ekskul');
        }


         else {
            redirect('user/register');
        }

		} else {

			$query = array(
				'nama_ekskul' => $this->input->post('nama_ekskul'),
				'penanggung_jawab' => $this->input->post('penanggung_jawab'),
				'lokasi' => $this->input->post('lokasi'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai')
				
			);
			$this->crud->insert('ekskul',$query);
			$this->message = "Data Ekskul Berhasil Disimpan !";
	        $this->session->set_flashdata('success',$this->message);  

	        if($this->session->userdata('role') == 1){
            redirect('admin/ekskul');

        }

        if($this->session->userdata('role') == 2){

            redirect('guru/ekskul');
        }


         else {
            redirect('user/register');
        }

		}
		

	}

	function get($id){
		$query = array(
			'id_ekskul' => $id
		);

		$result = $this->crud->get('ekskul',$query)->row();
		echo json_encode($result);
	}

	function update(){
		$query = array(
				'nama_ekskul' => $this->input->post('nama_ekskul'),
				'penanggung_jawab' => $this->input->post('penanggung_jawab'),
				'lokasi' => $this->input->post('lokasi'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
			);
		$this->crud->update('ekskul',$query,'id_ekskul',$this->input->post('id_ekskul'));
		$this->message = "Data Ekskul Berhasil Diubah !";
        $this->session->set_flashdata('success',$this->message);            
        if($this->session->userdata('role') == 1){
            redirect('admin/ekskul');

        }

        if($this->session->userdata('role') == 2){

            redirect('guru/ekskul');
        }


         else {
            redirect('user/register');
        };
	}

	function destroy($id){
		$this->crud->delete('ekskul','id_ekskul',$id);
		$this->message = "Data Ekskul Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
        if($this->session->userdata('role') == 1){
            
            redirect('admin/ekskul');

        }

        if($this->session->userdata('role') == 2){

            redirect('guru/ekskul');
        }


         else {
            redirect('user/register');
        }
	}

	function data_pendaftar($id_ekskul){
		$data = array(
			'set' => $this->crud->fourTablesFusionCondition(
				'registrasi',
				'ekskul',
				'siswa',
				'nilai',
				'siswa.id_siswa as id_siswa,
				 siswa.nama_siswa as nama,
				 siswa.nis as nis,
				 siswa.kelas as kelas,
				 siswa.jurusan as jurusan,
				 siswa.rombel as rombel,
				 registrasi.tanggal_daftar as tanggal,
				 ekskul.id_ekskul as id_ekskul,
				 nilai.nilai as nilai,
				 nilai.id_nilai as id_nilai,
				 registrasi.id_registrasi as id_registrasi
				',
				'ekskul.id_ekskul=registrasi.id_ekskul',
				'siswa.id_siswa=registrasi.id_siswa',
				'nilai.id_registrasi=registrasi.id_registrasi',
				'registrasi.id_ekskul',
				$id_ekskul)->result()

		);
		if($this->session->userdata('role') == 1){

        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('admin/ekskul/pendaftar',$data);
        $this->load->view('layouts/footer');

        }

        else {
        $this->load->view('layouts/header');
        $this->load->view('guru/nav');
        $this->load->view('guru/ekskul/pendaftar',$data);
        $this->load->view('layouts/footer');
        }		
	}

	function hapus_pendaftar($id_registrasi){
		$this->crud->delete_nilai($id_registrasi);
		$this->crud->delete_pendaftar($id_registrasi);
		$this->message = "Data Pendaftar Berhasil Dihapus !";
        $this->session->set_flashdata('success',$this->message);            
       	if($this->session->userdata('role') == 1){
            redirect('admin/ekskul');
        }

        if($this->session->userdata('role') == 2){
            redirect('guru/ekskul');
        }

        else {
            redirect('user/register');
        }

	}

	function validation(){
        $this->form_validation->set_rules('nama_ekskul','','required');
        $this->form_validation->set_rules('penanggung_jawab','','required');
        $this->form_validation->set_rules('lokasi','','required');
        $this->form_validation->set_rules('hari','','required');
        $this->form_validation->set_rules('jam_mulai','','required');
 		$this->form_validation->set_rules('jam_selesai','','required');
	}

     function cetak($id_ekskul){
        $data = array(
            'set' => $this->crud->fourTablesFusionCondition(
                'registrasi',
                'ekskul',
                'siswa',
                'nilai',
                'siswa.id_siswa as id_siswa,
                 siswa.nama_siswa as nama,
                 siswa.nis as nis,
                 siswa.kelas as kelas,
                 siswa.jurusan as jurusan,
                 siswa.rombel as rombel,
                 registrasi.tanggal_daftar as tanggal,
                 ekskul.id_ekskul as id_ekskul,
                 nilai.nilai as nilai,
                 nilai.id_nilai as id_nilai,
                 registrasi.id_registrasi as id_registrasi
                ',
                'ekskul.id_ekskul=registrasi.id_ekskul',
                'siswa.id_siswa=registrasi.id_siswa',
                'nilai.id_registrasi=registrasi.id_registrasi',
                'registrasi.id_ekskul',
                $id_ekskul)->result()

        );
        if($this->session->userdata('role') == 1){

        $this->load->view('layouts/header');
        $this->load->view('admin/ekskul/print',$data);
        $this->load->view('layouts/footer');

        }

        else {
        $this->load->view('layouts/header');
        $this->load->view('guru/ekskul/print',$data);
        $this->load->view('layouts/footer');
        }       
    }

		function download(){
		$ekskul = $this->crud->groupByRegister()->result();
		$no = 1;
        $i = 1;

        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->SetX(25);
        $pdf->Cell(190,7,'Ekstrakurikuler SMA PGRI 109 Tangerang',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $pdf->Ln();
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(80,6,'Nama Ekstrakurikuler',1,0);
        $pdf->Cell(100,6,'Jumlah Siswa',1,1);
        $pdf->SetFont('Arial','',10);
        foreach ($ekskul as $row){
            $pdf->Cell(10,6,$no,1,0);
            $pdf->Cell(80,6,$row->ekskul,1,0);
            $pdf->Cell(100,6,$row->jumlah_siswa,1,1);
            $no++; 
        }

        $pdf->Output('I', 'Laporan Jumlah Siswa Ekskul.pdf');
	}

	function downloadEkskul($id){
		$ekskul = $this->crud->groupByEkskul($id)->result();
		$no = 1;
        $i = 1;

        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->SetX(25);
        $pdf->Cell(190,7,'Ekstrakurikuler SMA PGRI 109 Tangerang',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $pdf->Ln();
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(80,6,'Nama Ekstrakurikuler',1,0);
        $pdf->Cell(100,6,'Nama Siswa',1,1);
        $pdf->SetFont('Arial','',10);
        
        foreach ($ekskul as $row){
            $pdf->Cell(10,6,$no,1,0);
            $pdf->Cell(80,6,$row->ekskul,1,0);
            $pdf->Cell(100,6,$row->siswa,1,1);
            $no++; 
        }

        $pdf->Output('I', 'Laporan Nama Siswa dan Nama Ekskul.pdf');
	}

}