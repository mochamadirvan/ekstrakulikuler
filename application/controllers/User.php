<?php 

if(defined('basepath')) exit ('No direct access script allowed');

class User extends CI_Controller {
    
    var $message;

    function __construct(){
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('GlobalCrud','crud');
        date_default_timezone_set('Asia/Jakarta');
        
        if($this->session->userdata('role') != '0'){
            redirect('login','refresh');
        }
    }
    
    function register(){


        $count = array(
            'id_siswa' => $this->session->userdata('id_users')
        );

        $data = array(
            'set' => $this->crud->all('ekskul')->result(),
            'set_siswa' => $this->crud->twoTablesFusionCondition('user','siswa','*','user.id_users = siswa.id_siswa','id_siswa',$this->session->userdata('id_users'))->result(),
            'set_ekskul' => $this->crud->twoTablesFusionCondition('registrasi','ekskul','*','registrasi.id_ekskul= ekskul.id_ekskul','id_siswa',$this->session->userdata('id_users'))->result(),
            'set_nilai' => $this->crud->threeTablesFusionCondition('nilai','registrasi','ekskul','*','nilai.id_registrasi=registrasi.id_registrasi','registrasi.id_ekskul= ekskul.id_ekskul','id_siswa',$this->session->userdata('id_users'))->result(),
            'total_ekskul' => $this->crud->get('registrasi',$count)->num_rows()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('user/register',$data);
        $this->load->view('layouts/footer');
    }

    function registered($id_ekskul){

        $cek = array(
            'id_siswa'  => $this->session->userdata('id_users'),
            'id_ekskul' => $id_ekskul      
        );

        $result = $this->crud->get('registrasi',$cek)->num_rows();
        if($result > 0){
            $this->message = 'Anda tidak bisa mengikuti ekskul yang sama lebih dari satu';
            $this->session->set_flashdata('warning',$this->message);
            redirect('user/register');

        } else {

            $count = array(
                 'id_siswa' => $this->session->userdata('id_users')     
            );

            $total = $this->crud->get('registrasi',$count)->num_rows();

            if($total >= 3){

                $this->message = 'Anda tidak bisa mengikuti ekskul lebih dari 3, Hubungi Administrator untuk pindah ekskul';
                $this->session->set_flashdata('warning',$this->message);
                redirect('user/register');

            } else {

                $query = array(
                    'id_ekskul' => $id_ekskul,
                    'id_siswa'  => $this->session->userdata('id_users'),
                    'tanggal_daftar' => date('Y-m-d')
                );

                $this->crud->insert('registrasi',$query);
                $tamp = $this->crud->get_desc('registrasi');

                $nilai = array(
                    'nilai'     => "",
                    'id_ekskul' => $tamp->id_ekskul,
                    'id_registrasi' => $tamp->id_registrasi
                );

                $this->crud->insert('nilai', $nilai);
                $this->message = 'Anda berhasil mengikuti ekskul :)';
                $this->session->set_flashdata('success',$this->message);
                redirect('user/register');
            }

        }

      
    }

    function galeri(){
        $data = array(
            'set' => $this->crud->twoTablesFusion('dokumentasi','ekskul','*','dokumentasi.id_ekskul=ekskul.id_ekskul')->result()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('galeri/kelola',$data);
        $this->load->view('layouts/footer');
    }
    
    function profile(){

        $data = array(
                'set' => $this->crud->all('siswa')->result(),
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('user/profile',$data);
        $this->load->view('layouts/footer');
    }
    
    function download($id){
        $siswa = $this->crud->twoTablesFusionCondition('user','siswa','*','user.id_users = siswa.id_siswa','id_siswa',$id)->result();
        $ekskul = $this->crud->twoTablesFusionCondition('registrasi','ekskul','*','registrasi.id_ekskul= ekskul.id_ekskul','id_siswa',$id)->result();
        $nilai = $this->crud->threeTablesFusionCondition('nilai','registrasi','ekskul','*','nilai.id_registrasi=registrasi.id_registrasi','registrasi.id_ekskul= ekskul.id_ekskul','id_siswa',$id)->result();

        $no = 1;
        $i = 1;

        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->SetX(25);
        $pdf->Cell(190,7,'SMA PGRI 109 Tangerang',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $pdf->Ln();
        
        foreach ($siswa as $row_siswa){
             $date = date_create($row_siswa->tanggal_lahir); $new_date = date_format($date,"d-F-Y");
             $pdf->SetFont('Arial','',9);
             $pdf->setX(10,10);
             $pdf->Cell(20,0,'Nama', 0, '0', 'L');
             $pdf->Cell(10,0,':', 0, '0', 'C');
             $pdf->Cell(20,0,$row_siswa->nama_siswa, 0, '0', 'L');
             $pdf->Ln(5);
             $pdf->setX(10,40);
             $pdf->Cell(20,0,'Kelas', 0, '0', 'L');
             $pdf->Cell(10,0,':', 0, '0', 'C');
             $pdf->Cell(20,0,$row_siswa->kelas, 0, '0', 'L');
             $pdf->Ln(5);
             $pdf->setX(10,20);
             $pdf->Cell(20,0,'TTL', 0, '0', 'L');
             $pdf->Cell(10,0,':', 0, '0', 'C');
             $pdf->Cell(20,0, $row_siswa->tempat_lahir  . ', ' .  $new_date, 0, '0', 'L');
             $pdf->Ln(5);
             $pdf->setX(10,25);
             $pdf->Cell(20,0,'NIS', 0, '0', 'L');
             $pdf->Cell(10,0,':', 0, '0', 'C');
             $pdf->Cell(20,0, $row_siswa->nis, 0, '0', 'L');
        }
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(80,6,'Nama Ekstrakurikuler',1,0);
        $pdf->Cell(100,6,'Lokasi',1,0);
        $pdf->Cell(60,6,'Jadwal',1,1);
        $pdf->SetFont('Arial','',10);
        foreach ($ekskul as $row){
            $pdf->Cell(10,6,$no,1,0);
            $pdf->Cell(80,6,$row->nama_ekskul,1,0);
            $pdf->Cell(100,6,$row->lokasi,1,0);
            $pdf->Cell(60,6,$row->hari . ',' . $row->jam_mulai . ' - ' . $row->jam_selesai ,1,1);
            $no++; 
        }

        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'No',1,0);
        $pdf->Cell(60,6,'Nama Ekstrakurikuler',1,0);
        $pdf->Cell(60,6,'Nilai',1,1);
        foreach ($nilai as $row){
            $pdf->Cell(20,6,$i,1,0);
            $pdf->Cell(60,6,$row->nama_ekskul,1,0);
            $pdf->Cell(60,6,$row->nilai,1,1);
            $i++; 
        }
        $pdf->Output('I', 'Laporan Ekstrakurikuler.pdf');
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
                $id_ekskul)->result());


        $this->load->view('layouts/header');
        $this->load->view('layouts/nav');
        $this->load->view('user/pendaftar',$data);
        $this->load->view('layouts/footer');
     
    }
    
}