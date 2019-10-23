<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <div class="panel-title">Data Ekskul</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php foreach ($set_siswa as $row_siswa) { ?>
                                        <?php $date = date_create($row_siswa->tanggal_lahir); $new_date = date_format($date,"d-F-Y"); ?>

                                            <label>Nama : </label> <?php echo $row_siswa->nama_siswa;?> <br/>
                                            <label>Kelas : </label> <?php echo $row_siswa->kelas;?><?php echo $row_siswa->jurusan;?><?php echo $row_siswa->rombel;?> <br/>
                                            <label>TTL  : </label> <?php echo $row_siswa->tempat_lahir;?>, <?php echo $new_date;?> <br/>
                                            <label for="nis">NIS :</label> <?php echo $row_siswa->nis;?>
                                        <?php } ?>        
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <label>Total Ekskul yang Diikuti: </label> <font color="red"><?php echo $total_ekskul;?></font>/3<br/>
                                        
                                    </div>
                                </div>
                                <?php if(empty($set_ekskul)) { ?>
                                    <div class="alert alert-danger">
                                        Anda belum mengikuti ekstrakurikuler satu pun
                                    </div>

                                <?php } else { ?>

                                    <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Ekstrakurikuler</th>
                                        <th>Lokasi</th>
                                        <th>Jadwal Ekskul</th>
                                        <th>Tanggal Daftar</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach($set_ekskul as $row_ekskul) { ?>
                                            <tr>
                                                <td><?php echo $no++;?></td>
                                                <td><?php echo $row_ekskul->nama_ekskul;?></td>
                                                <td><?php echo $row_ekskul->lokasi;?></td>
                                                <td><?php echo $row_ekskul->hari;?>, <?php echo $row_ekskul->jam_mulai;?> - <?php echo $row_ekskul->jam_selesai;?></td>
                                                <td><?php echo date('d-m-Y', strtotime($row_ekskul->tanggal_daftar));?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                <div class="row">
                                <div class=" col-sm-4 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Ekstrakurikuler</th>
                                        <th>Nilai</th>
                                    
                                        
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach($set_nilai as $row_nilai) { ?>
                                            <tr class="success">
                                                <td><?php echo $no++;?></td>
                                                <td><?php echo $row_nilai->nama_ekskul;?></td>
                                                <td><?php echo $row_nilai->nilai;?></td> 
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                                <?php } ?>
                                <div class="btn-group pull-left">
                                    <a href="<?php echo site_url('user/download/' . $this->session->userdata('id_users'));?>" class="btn btn-success btn-sm">Print</a>
                                  </div>
                            </div>
                        </div>
                    </div>
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Registrasi Ekskul</h3>
							<p class="panel-subtitle">User / Registrasi Ekskul</p>
						</div>
						<div class="panel-body">
						   <div class="table-responsive">
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>Nama Ekstrakurikuler</th>
							            <th>Penanggung Jawab</th>
							            <th>Lokasi Ekskul</th>
							            <th>Jadwal Ekskul</th>      
                                        <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
                                    <?php  foreach($set as $row){ ?>
                                     
                                    <tr>
                                        <td><?php echo $row->nama_ekskul;?></td>
							            <td><?php echo $row->penanggung_jawab;?></td> 
							            <td><?php echo $row->lokasi;?></td>
                                        <td><?php echo $row->hari;?>, <?php echo $row->jam_mulai;?> - <?php echo $row->jam_selesai;?></td>
                                       
							            <td>
							                 <?php echo anchor('user/registered/'.$row->id_ekskul,'<button class="btn btn-danger"><i class="fa fa-check"></i> Registrasi</button>',array('onclick' => "return confirmDialog();"));?> 
                                             <?php echo anchor('user/data-pendaftar/'.$row->id_ekskul,'<button class="btn btn-primary"><i class="fa fa-list"></i> Lihat Pendaftar</button>');
                                             ?>

							            </td>
							            </tr>
                                       <script>
function confirmDialog() {
 return confirm('Apakah anda yakin memilih ekstrakurikuler ini?')
}
</script>
							         <?php } ?>   
							        
							    </tbody>
							</table>
						</div>
                        </div>
					</div>
				
			<!-- END MAIN CONTENT -->
		</div>
    </div>
</div>