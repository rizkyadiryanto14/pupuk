<?php $this->load->view('templates/header') ?>

<?php $this->load->view('templates/navbar') ?>

<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Detail Pupuk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Detail Pupuk</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Edit Data Pupuk</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="nama_pupuk">Nama Pupuk</label>
						<input type="text" name="nama_pupuk" id="nama_pupuk" class="form-control" value="<?= $data_id_pupuk['nama_pupuk'] ?>">
					</div>
					<div class="form-group">
						<label for="jenis_pupuk">Jenis Pupuk</label>
						<input type="text" name="jenis_pupuk" id="jenis_pupuk" class="form-control" value="<?= $data_id_pupuk['jenis_pupuk'] ?>">
					</div>
					<div class="form-group">
						<label for="harga_pupuk">Harga Pupuk</label>
						<input type="text" name="harga_pupuk" id="harga_pupuk" class="form-control" value="<?= $data_id_pupuk['harga_pupuk'] ?>">
					</div>
					<div class="form-group">
						<label for="status_pupuk">Status</label>
						<select name="status_pupuk" id="status_pupuk" class="form-control" required>
							<option selected disabled> Pilih Status</option>
							<option value="1">Masuk</option>
							<option value="0">Keluar</option>
						</select>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary" type="submit">Update Pupuk</button>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>
