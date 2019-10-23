<div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">

                    <?php echo $this->session->flashdata('notify');?>
                    <?php echo validation_errors();?>
                    <!-- OVERVIEW -->
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Pendaftar</h3>
                            <p class="panel-subtitle">Admin / Data Ekstrakurikuler / Lihat Pendaftar</p>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                            <table class="display" id="data">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Nilai</th>      
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php  foreach($set as $row){ ?>
                                     
                                    <tr>
                                        <td><?php echo $row->nis;?></td>
                                        <td><?php echo $row->nama;?></td> 
                                        <td><?php echo $row->kelas.$row->jurusan.$row->rombel;?></td>
                                        <td><?php echo date('d-m-Y', strtotime($row->tanggal));?></td>
                                        <td><?php echo $row->nilai;?></td>
                                       
                                        <td>

                                            
                                            
                                             <?php echo anchor('ekskul/hapus-pendaftar/'.$row->id_registrasi,'<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Pendaftar</button>');
                                             ?>
                                            
                                            <button class="btn btn-warning" onclick="edit_supplier(<?php echo $row->id_nilai;?>)"><i class="fa fa-edit"></i> Masukan Nilai</button>
                                                                                       

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

<!--Tambah Nilai eskul -->

<script>
    
 

    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('siswa/get_nilai')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_nilai"]').val(data.id_nilai);
            $('[name="nilai"]').val(data.nilai);            

            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Nilai'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Masukan').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('siswa/nilai');?>');
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
                <h4 class="modal-title">Tambah Nilai</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('siswa/nilai',array('id' => 'form'));?>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden"  name="id_nilai"/>
                        <div class="form-group">
                            <label for="">Masukan Nilai</label>
                            <select name="nilai" id="nilai" class="form-control">
                                <option value="-">-</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
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

