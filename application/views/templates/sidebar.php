<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="#" class="brand-link">
		<img src="<?= base_url() ?>assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">UD WAHYU</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?=$this->session->userdata('nama') ?></a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<?php if ($this->session->userdata('role') == 'admin') { ?>
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('pupuk') ?>" class="nav-link">
						<i class="nav-icon fas fa-globe"></i>
						<p>
							Pupuk
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('pengiriman') ?>" class="nav-link">
						<i class="nav-icon fas fa-car-alt"></i>
						<p>
							Penyaluran
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('pemesanan') ?>" class="nav-link">
						<i class="nav-icon fas fa-money-bill"></i>
						<p>
							Pemesanan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('subsidi') ?>" class="nav-link">
						<i class="nav-icon fas fa-money-bill"></i>
						<p>
							Subsidi
						</p>
					</a>
				</li>
			</ul>
			<?php }elseif ($this->session->userdata('role') == 'user'){ ?>
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="<?= base_url('dashboard') ?>" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								Dashboard
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('pupuk') ?>" class="nav-link">
							<i class="nav-icon fas fa-globe"></i>
							<p>
								Pupuk
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('pengiriman') ?>" class="nav-link">
							<i class="nav-icon fas fa-car-alt"></i>
							<p>
								Penyaluran
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('pemesanan') ?>" class="nav-link">
							<i class="nav-icon fas fa-money-bill"></i>
							<p>
								Pemesanan
							</p>
						</a>
					</li>
				</ul>
			<?php } ?>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
