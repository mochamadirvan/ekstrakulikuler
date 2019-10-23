<div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/klorofil-common.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/select2.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/main.js');?>"></script>
<script src="<?php echo base_url('assets/js/toastr.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.timepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/dropzone.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.js');?>"></script>
<script type="text/javascript">
     <?php if($this->session->flashdata('success')){?>
        toastr.success("<?php echo $this->session->flashdata('success');?>");
     <?php } else if($this->session->flashdata('danger')){ ?>
        toastr.error("<?php echo $this->session->flashdata('danger');?>");
     <?php } else if($this->session->flashdata('warning')){ ?>
        toastr.warning("<?php echo $this->session->flashdata('warning');?>");
     <?php } else if($this->session->flashdata('info')){ ?>
        toastr.info("<?php echo $this->session->flashdata('info');?>");

     <?php } ?>
    //script untuk jadwal kegiatan 
    $(document).ready(function(){
        $("#jenis-kegiatan").select2();
        $("#partisipan").select2();
         $("#tanggal-mulai").datepicker({
              dateFormat: "yy-mm-dd"
         });
        $("#tanggal-selesai").datepicker({
             dateFormat: "yy-mm-dd"
        });
        $("#jam_mulai").timepicker({
            timeFormat:'H:i:s',
        })
        $("#jam_selesai").timepicker({
            timeFormat:'H:i:s',
        })
       
        $('[name="confirm"]').keyup(function(e){
            
            e.preventDefault();
            
            var confirm = $('[name="confirm"]').val();
            var password = $('[name="password"]').val();
            
            if(confirm == ''){
                $('#notif-confirm').text('*Sesuaikan Dengan Password Diatas').css({'color':'red','font-weight':'bold'});
                $("#button-disabled").attr('disabled','disabled');
            } else {
                
                if(confirm != password){
                    $('#notif-confirm').text(' Tidak Sesuai Dengan Password Diatas').css('color','red');
                    $("#button-disabled").attr('disabled','disabled');
                
                } else {
                   $('#notif-confirm').text(' Telah Sesuai Dengan Password Diatas').css('color','green');
                   $("#button-disabled").removeAttr('disabled','disabled');

                }
                
            }
        }); 

        // Dropzone.autoDiscover = false;

        // var maxImageWidth = 400,
        // maxImageHeight = 350;

        Dropzone.options.myAwesomeDropzone = {
            url: '<?php echo site_url('dokumentasi/upload')?>',
            parallelUploads: 100,
            acceptedFiles: '.jpg, .jpeg, .png',
            addRemoveLinks: true, // add a remove link underneath each image to 

            init: function() 
            {
                var image_array     = [];
                var image           = $('#image').val();
                var images_folder   = $('#images_folder').val();

                this.on("success", function(file, response) 
                {
                    file.image_name = response;
                    image_array.push(file.image_name);

                    document.getElementById("image").value = image_array;
                    // document.getElementById("primary_image").value = image_array[0];
                });

                // remove image
                this.on("removedfile", function(file) 
                {
                    // remove image from path temp
                    if(file.image_name)
                    {
                        var image = file.image_name.replace(/['"]+/g, '');
                        console.log(image);
                        $.ajax({
                            // headers: { 'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value, },
                            url: "<?php echo base_url()?>dokumentasi/remove/" + encodeURI(image),
                            type: "GET",
                            success : function(data){
                                console.log(decodeURI(data));
                            }
                        });

                    //     image_array.splice( image_array.indexOf(file.image_name), 1 );
                    //     // document.getElementById("button_merchandise").disabled = true;
                    //     document.getElementById("image").value = image_array;
                    //     document.getElementById("primary_image").value = image_array[0];
                    }

                    // remove image from path merchandise
                    // else if(file.name)
                    // {
                    //     $.ajax({
                    //         headers: { 'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value, },
                    //         url: '/remove/'+file.name+'/'+images_folder,
                    //         type: "GET",
                    //     });

                    //     image_array.splice( image_array.indexOf(file.name), 1 );
                    //     document.getElementById("image").value = image_array;
                    //     document.getElementById("primary_image").value = image_array[0];
                    
                    //     window.onbeforeunload = function(){
                    //       return 'Are you sure you want to leave, leave this page will still delete the image ?';
                    //     };
                    // }
                });
            },
        };
    });

    $.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

    $('#form-siswa').validate({
        rules: {
            nis : {
                digits: true,
                minlength:7,
                maxlength:7
            },
            nama_siswa: {
                alphabetsnspace: true
            },
            tempat_lahir : {
                alphabetsnspace: true
            }
        },
        messages: {
            nis: {
                digits : "Hanya boleh angka.",
                required: "NIS harus diisi.",
                minlength: "NIS harus terdiri dari 7 angka."
            },
            nama_siswa:{
                alphabetsnspace: "Hanya boleh huruf"
            },
            tempat_lahir : {
                alphabetsnspace: "Hanya boleh huruf"
            }
        }
    });

    $('#form-guru').validate({
        rules: {
            nik : {
                digits: true,
                minlength:16,
                maxlength:16
            },
            nama_guru:{
                alphabetsnspace: true
            },
            tempat_lahir : {
                alphabetsnspace: true
            }
        },
        messages: {
            nik: {
                digits : "Hanya boleh angka.",
                required: "NIK harus diisi.",
                minlength: "NIK harus terdiri dari 16 angka."
            },
            nama_guru:{
                alphabetsnspace: "Hanya boleh huruf"
            },
            tempat_lahir : {
                alphabetsnspace: "Hanya boleh huruf"
            }
        }
    });
</script>


</body>
</html>


