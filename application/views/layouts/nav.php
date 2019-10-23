<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#"><b>Sistem Informasi Ekstrakurikuler </b></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
			
			
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								
								<li><a href="<?php echo base_url('login/signout');?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		
	<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
                        <?php if($this->session->userdata('role') == 1){ ?>
					    
						<li><a href="<?php echo site_url('admin');?>" ><i class="fa fa-home fa-lg"></i> <span>Dashboard</span></a></li>
						
						<li><a href="<?php echo site_url('admin/siswa');?>" ><i class="fa fa-users fa-lg"></i> <span>Data Siswa</span></a></li>

						<li><a href="<?php echo site_url('admin/tambahguru');?>" ><i class="fa fa-book fa-lg"></i> <span>Data Guru</span></a></li>
						<li>
							<a href="#subDataUser" data-toggle="collapse" class="collapsed"><i class="fa fa-user"></i> <span>Data User</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subDataUser" class="collapse ">
								<ul class="nav">
									<li><a href="<?php echo site_url('admin/akunSiswa');?>" ><i class="fa fa-user-circle-o"></i>Akun Siswa</a></li>
									<li><a href="<?php echo site_url('admin/akunGuru');?>" ><i class="fa fa-user-circle"></i>Akun Guru</a></li>
								</ul>
							</div>
						</li>

						<li><a href="<?php echo site_url('admin/ekskul');?>" ><i class="fa fa-tags fa-lg"></i><span>Data Ekstra Kulikuler</span></a></li>
						
						<li><a href="<?php echo site_url('admin/galeri');?>" ><i class="fa fa-image fa-lg"></i><span>Galeri Ekstra Kulikuler</span></a></li>
						
                        <?php } else if($this->session->userdata('role') == 2) { ?>
                            
                            <li><a href="<?php echo site_url('user/register');?>"><i class="fa fa-list fa-lg"></i><span>Data Ekstra Kulikuler</span></a></li>
                           	<li><a href="<?php echo site_url('user/galeri');?>"><i class="fa fa-image fa-lg"></i><span>Galeri Ekstra Kulikuler</span></a></li>
                            
                        <?php } else { ?>
							<li><a href="<?php echo site_url('user/register');?>"><i class="fa fa-list fa-lg"></i><span>Registrasi Ekstra Kulikuler</span></a></li>
                           	<li><a href="<?php echo site_url('user/galeri');?>"><i class="fa fa-image fa-lg"></i><span>Galeri Ekstra Kulikuler</span></a></li>
                           	<li><a href="<?php echo site_url('user/absen');?>"><i class="fa fa-list fa-lg"></i><span>Absen</span></a></li>

                        <?php } ?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->