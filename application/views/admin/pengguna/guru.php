<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                <a href="#" class="act-btn" onclick="add_supplier() ">+</a>

				    <?php echo $this->session->flashdata('notify');?>
				    <?php echo validation_errors();?>
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Akun Guru</h3>
							<p class="panel-subtitle">Admin / Akun Guru</p>
						</div>
						<div class="panel-body">
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        <th>NIK</th>
							            <th>Username</th>
							            <th>Password</th>
							            <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php  foreach($set as $row){ ?>
                                    <tr>
                                        <td><?php echo $row->nik;?></td>
							            <td><?php echo $row->username;?></td> 
							            <th><?php echo $row->password;?></th>
							            <td>
							                <button class="btn btn-warning" onclick="edit_supplier(<?php echo $row->id_user;?>)"><i class="fa fa-edit"></i> Edit</button>  
                                               
							                 <button class="btn btn-info" onclick="reset(<?php echo $row->id_user;?>)"><i class="fa fa-undo"></i> Reset Password</button> 
							                 <?php echo anchor('pengguna/destroyGuru/'.$row->id_user,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>');?>

							            </td>
							            </tr>
							         <?php } ?>   
							        
							    </tbody>
							</table>
						</div>
					</div>
				
			<!-- END MAIN CONTENT -->
		</div>
    </div>
</div>

<script>
    
   function add_supplier(){
        $('#form')[0].reset();
        $("#myModal").modal('show');
        $('.modal-title').text('Tambah Akun Guru'); // Set title to Bootstrap modal title
        $('#passwordnew').css('display','none');
        $('#password').show();
        $('#pengguna').show();
        $('#pegawai').show();
        $('#email').show();  
        $('#password label').text('Password'); 
        $('[name=role]').val('Level').show();
        $('[name=submit]').val('Tambah').show();
        $('#form').attr('action','<?php echo site_url('pengguna/createGuru');?>');
        $('.modal-footer').show();
    }

    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('pengguna/getGuru')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_user"]').val(data.id_user);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('#password').css('display','none');
            $('#passwordnew').css('display','none');
            $('#confirm').css('display','none');
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pengguna'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('pengguna/updateGuru');?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
    }
    
    function reset(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('pengguna/getGuru')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_user"]').val(data.id_user);
            $('#pengguna').css('display','none');
            $('#username').css('display','none');
            $('#password').show();
            $('#password label').text('Password Lama');
            $('#passwordnew').show();
            $('#confirm').css('display','none');
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Reset Password'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Reset').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('pengguna/reset-password-guru');?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
    } 
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Jenis Kegiatan</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('pengguna/createGuru',array('id' => 'form'));?>
        <input type="hidden"  name="id_user"/>

        <div class="form-group" id="pengguna">
            <label>NIK</label>
            <select name="id_users" id="id_users" class="form-control">
                <?php foreach($set_guru as $row_guru){ ?>
                    <option value="<?php echo $row_guru->id_guru;?>"><?php echo $row_guru->nik;?>-<?php echo $row_guru->nama_guru;?></option>
                <?php } ?>
            </select>
            
        </div>
       
        <div class="form-group" id="username">
            <label>Username</label>
            <input type="username" name="username" class="form-control">
        </div>
        <div class="form-group" id="password">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        
        <div class="form-group" id="passwordnew">
            <label>Password Baru</label>
            <input type="password" name="new_password"  class="form-control" id="new_password" >
        </div>
        <div class="form-group" id="confirm">
            <label>Konfirmasi Password</label> <small id="notif-confirm"></small>
            <input type="password" name="confirm"  class="form-control">
        </div>

       
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success" id="button-disabled">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>

