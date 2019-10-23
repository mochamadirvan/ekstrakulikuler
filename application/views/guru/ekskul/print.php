<div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    <div class="panel panel-headline">
                        <h2 class="text-center">Data Report Ekstrakurikuler




                         </h2>
                           <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Nilai</th>      
                                       
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

                                       
                                        
                                        </tr>
                                     <?php } ?>   
                                    
                                </tbody>

                            </table>
                        </div>
                        </div>
                        <h4 style="margin-top: 20px;">Tertanda</h4>
                    
                    <p style="margin-top: 20px">...................</p>
                    </div>

            <!-- END MAIN CONTENT -->
        </div>
    </div>
</div>

<script>


        document.title='Rekap Data Nilai Ekstrakurikuler Siswa';

        window.print();
    </script>


