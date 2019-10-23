<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                <a href="#" class="act-btn" data-toggle="modal" data-target="#myModal">+</a>
				    <?php echo $this->session->flashdata('notify');?>
                    <?php echo validation_errors();?>
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data Guru</h3>
							<p class="panel-subtitle">Admin / Data Guru</p>
						</div>
						<div class="panel-body">
						   <div class="table-responsive">
							<table class="display" id="data">
							    <thead>
							        <tr>
                                        
                                        <th>NIK</th>
							            <th>Nama Guru</th>
                                        <th>Golongan</th>
							            <th>Tempat Tanggal Lahir</th>
							            <th>Alamat</th>
                                        <th>Opsi</th>
							        </tr>
							    </thead>
							    <tbody>
							        
                                    <?php  foreach($set as $row){ ?>
                                    <?php $date = date_create($row->tanggal_lahir);
                                          $new_date = date_format($date,"d-F-Y"); ?>    
                                    <tr>
                                        
                                        <td><?php echo $row->nik;?></td>
							            <td><?php echo $row->nama_guru;?></td> 
                                        <th><?php echo $row->golongan;?></th>
							            <th><?php echo $row->tempat_lahir;?>, <?php echo $new_date;?></th>
                                        <th><?php echo $row->alamat;?></th>
							            <td>
							                <button class="btn btn-warning" onclick="edit_supplier(<?php echo $row->id_guru;?>)"><i class="fa fa-edit"></i> Edit</button>   
							                 
							                 <?php echo anchor('tambahguru/destroy/'.$row->id_guru,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>');?>

							            </td>
							            </tr>
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

<script>
    
 

    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form-guru')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('tambahguru/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_guru"]').val(data.id_guru);
            $('[name="nik"]').val(data.nik);
            $('[name="nama_guru"]').val(data.nama_guru);
            $('[name="tempat_lahir"]').val(data.tempat_lahir);
            $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
            $('[name="alamat"]').val(data.alamat);
            $('[name="golongan"]').val(data.golongan);
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Guru'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form-guru').attr('action','<?php echo site_url('tambahguru/update');?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
    }
    
   
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Guru</h4>
        </div>
        <div class="modal-body">
            <?php echo form_open('tambahguru/create',array('id' => 'form-guru'));?>
            <div class="row">
                <div class="col-md-6" style="margin-top: 10px;">
                    <input type="hidden"  name="id_guru"/>
                    <div class="form-group" id="pengguna">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" maxlength="16">
                    </div>
                    <div class="form-group" id="email">
                        <label>Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Golongan</label>
                        <input name="golongan" id="" class="form-control">           
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 10px;">
                    <div class="form-group" id="tempat_lahir">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control">
                    </div>
                    <div class="form-group" id="tanggal_lahir">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control">
                    </div>
                    <div class="form-group" id="alamat">
                        <label>Alamat </label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success" id="button-disabled">
            <?php echo form_close();?>
        </div>
    </div>
  </div>
</div>

