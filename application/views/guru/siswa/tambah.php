<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				    <?php echo $this->session->flashdata('notify');?>
				    <?php echo validation_errors();?>
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data Siswa</h3>
							<p class="panel-subtitle">Guru / Data Siswa / Tambah Siswa</p>
						</div>
						<div class="panel-body">
                <form action="create" method="post" id="form-siswa">
				
                <input type="hidden"  name="id_siswa"/>

                <div class="form-group" id="pengguna">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control" maxlength="7">
                </div>
               
                <div class="form-group" id="email">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control">
                </div>
                 
                <div class="form-group" id="email">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                </div>

                <div class="form-group" id="email">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>

                <div class="form-group" id="email">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
           
                <div class="form-group" id="email">
                    <label>Alamat </label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Kelas</label>
                    <select name="kelas" id="" class="form-control">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jurusan</label>
                    <select name="jurusan" id="" class="form-control">
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Rombongan Belajar</label>
                    <select name="rombel" id="" class="form-control">
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                        <option value="e">E</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                
                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                    
                </div>

            </form>
						</div>
                        </div>
					</div>
				
			<!-- END MAIN CONTENT -->
		</div>
    </div>
</div>

    
 

  

