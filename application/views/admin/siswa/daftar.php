<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
        <a href="#" class="act-btn" data-toggle="modal" data-target="#myModal">+</a>
		    <?php echo $this->session->flashdata('notify');?>
		    <?php echo validation_errors();?>
</div>
<script>
    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('siswa/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_siswa"]').val(data.id_siswa);
            $('[name="nis"]').val(data.nis);
            $('[name="nama_siswa"]').val(data.nama_siswa);
            $('[name="tempat_lahir"]').val(data.tempat_lahir);
            $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
            $('[name="alamat"]').val(data.alamat);

            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('siswa/update');?>');
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
        <h4 class="modal-title">Daftar</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('siswa/create',array('id' => 'form'));?>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden"  name="id_siswa"/>

                <div class="form-group" id="pengguna">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control">
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
            </div>
            <div class="col-md-6">
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
            </div>
        </div>
        
        
        <div class="modal-footer">
            <input type="submit" name="submit" value="Tambah" class="btn btn-success" id="button-disabled">
            <?php echo form_close();?>
        </div>
      </div>
      
    </div>

  </div>
</div>

