<?php $this->load->view('templates/header') ?>

<?php $this->load->view('templates/navbar') ?>

<?php $this->load->view('templates/sidebar') ?>


<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pupuk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Pupuk</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Form Update Data <?= $data_usaha_dagang['kode_kios'] ?></h3>
						</div>
						<form action="<?= base_url('usaha_dagang/update_logic/' . $data_usaha_dagang['id_usaha_dagang']) ?>" method="post">
							<div class="card-body">
								<div class="form-group">
									<label for="nama_kios">Nama Kios</label>
									<input type="text" name="nama_kios" id="nama_kios" class="form-control" value="<?= $data_usaha_dagang['nama_kios'] ?>">
								</div>
								<div class="form-group">
									<label for="kode_kios">Kode Kios</label>
									<input type="text" name="kode_kios" id="kode_kios" class="form-control" value="<?= $data_usaha_dagang['kode_kios'] ?>">
								</div>
								<div class="form-group">
									<label for="subsektor">Subsektor</label>
									<input type="text" name="subsektor" id="subsektor" class="form-control" value="<?= $data_usaha_dagang['subsektor'] ?>">
								</div>
							</div>
							<div class="card-footer">
								<a href="<?= base_url('usaha_dagang') ?>" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
								<button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>
