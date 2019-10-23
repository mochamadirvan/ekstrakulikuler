    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="<?php echo base_url();?>assets/img/images.png" alt="Logo SMA PGRI 109 Tangerang" width="50" height="50"></div>
                                <p class="lead">Login to your account</p>
                                <?php echo $this->session->flashdata('notify');?>
                            </div>
                            <?php echo form_open('login/signin',array('class' => 'form-auth-small'));?>
                                
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Username</label>
                                    <input type="text" class="form-control" id="signin-email" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password" placeholder="Password">
                                </div>
                                
                                <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Login to..">
                                
                                
                            <?php echo form_close();?>
                            <br>
                            <a href="#" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Daftar</a>
                            
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">Sistem Informasi Ekstrakurikuler </h1>
                            <p>SMA PGRI 109 Tangerang</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

                

<?php echo validation_errors();?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Daftar</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('login/create',array('id' => 'form-siswa'));?>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden"  name="id_siswa"/>

                <div class="form-group" id="pengguna">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control" maxlength="7">
                </div>
               
                <div class="form-group" id="email">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control">
                </div>
                 
                <div class="form-group" id="tempat_lahir">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                </div>

                <div class="form-group" id="tanggal_lahir">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>
                
                
            </div>
            <div class="col-md-6">
                <div class="form-group" id="alamat">
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
                        <option value="AKUTANSI">AKUTANSI</option>
                        
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
            </div>
        </div>
        
        
        <div class="modal-footer">
            <input type="submit" name="submit" value="Daftar" class="btn btn-success" id="button-disabled">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>


    