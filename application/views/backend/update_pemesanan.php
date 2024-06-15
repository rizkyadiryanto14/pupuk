<?php $this->load->view('templates/header') ?>

<?php $this->load->view('templates/navbar') ?>

<?php $this->load->view('templates/sidebar') ?>


<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Update Pemesanan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Pemesanan</li>
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
							<h2 class="card-title">Form Update Pemesanan</h2>
						</div>
						<form action="<?= base_url('') ?>" method="post">
							<div class="card-body">
								<div class="form-group">
									<label for="id_users">Users</label>
									<select name="id_users" id="id_users" class="form-control">
										<option selected disabled> Pilih Users</option>
										<?php foreach ($data_users as $item) { ?>
											<option value="<?= $item->id_penduduk ?>"><?= $item->nama ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_penduduk">Pupuk</label>
									<select name="id_penduduk" id="id_penduduk" class="form-control">
										<option selected disabled> Pilih Pupuk</option>
										<?php foreach ($data_pupuk as $item) { ?>
											<option value="<?= $item->id_pupuk ?>"><?= $item->nama_pupuk ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="jumlah">Jumlah</label>
									<input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $data_pemesanan['jumlah'] ?>">
								</div>
							</div>
							<div class="card-footer">
								<a href="<?= base_url('pemesanan') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
